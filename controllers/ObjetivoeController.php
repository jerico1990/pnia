<?php

namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\helpers\BaseArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Usuarios;
use app\models\Proyecto;
use app\models\Responsable;
use app\models\ObjetivoEspecifico;

class ObjetivoeController extends Controller
{
    public $proyecto_id;
    
    public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['grabar'],
                'rules' => [
                    [
                        'actions' => ['grabar'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];

    }
    
    public function actionIndex()
    {
        /*$outp ='';
        $objGeneral=Proyecto::find('objetivo_general')
                                ->where('user_propietario=:user_id',[':user_id'=>Yii::$app->user->identity->id])
                                ->one();
         
         */

        $proyecto_id = $id_proyecto = $_GET['val'];
        
        $objetivosespecificos=ObjetivoEspecifico::find('objetivo_especifico.id, objetivo_especifico.descripcion,objetivo_especifico.id_proyecto')
                                //->innerJoin('proyecto','proyecto.id = objetivo_especifico.id_proyecto')
                                ->where('objetivo_especifico.id_proyecto =:id_proyecto',[':id_proyecto'=>$id_proyecto])
                                ->all();
        
        $datos = array();
        
       /* if($objGeneral)
        {
            
            
          //  $array = array("objetivo_general"=>$objGeneral->objetivo_general);
            //$arrayobject = ArrayHelper::map($array, 'objetivo_general');
            //$arrayobject = new ArrayObject($array);
            //$arrayobject = (object)array_map(function($item) { return is_array($item) ? (object)$item :  $item;  }, $array);
            //array_push($datos,$arrayobject);
            
        }*/
        
        
        if($objetivosespecificos)
        {
           // $outp .= '[ ';
        
                                   
                                   
                                   
        foreach($objetivosespecificos as $obje)
       /* {
            $outp .= '{ id:"'. $obje->id . '",descripcion":'. $obje->descripcion .'"},';
        }
         $outp = substr($outp, 0, -1);
         $outp .=']';
        */
        //while($row = $objetivosespecificos)
        {
          //$array[] = array('id'=>$obje->id,'descripcion'=>$obje->descripcion); 
            array_push($datos,$obje->attributes);
            //array_unshift($datos,array("row" => "$i"));
           // $datos[] = $obje;
        }
       /* 
        $array2 = array('dato1' => array('objetivo_general'=>$objGeneral->objetivo_general),
                  'dato2' => array($array));
        $arrayobject = (object)array_map(function($item) { return is_array($item) ? (object)$item :  $item;  }, $array);
        */
        }
        
      /*  $array2 = array('dato1' => array('objetivo_general'=>$objGeneral->objetivo_general),
                  'dato2' => array($array));
        $arrayobject = (object)array_map(function($item) { return is_array($item) ? (object)$item :  $item;  }, $array);
      */
       // $outp ='{"records":'.$outp.'}';
        

        //var_dump($datos);
        echo json_encode($datos);  
        //echo '{objetivo_general:"hola mundo"}';
       
    }
    
    
    public function actionObteneog()
    {
        $datos = array();
       
       //$objGeneral = new Proyecto();
       $id_proyecto = $_GET['val'];
       
      $objGeneral=Proyecto::find('objetivo_general')
                                ->where('id=:id',[':id'=>$id_proyecto])
                                ->one();
         
        // var_dump($objGeneral); 
                                
        if($objGeneral)
        {
            
            $datos["objetivo_general"] = $objGeneral->objetivo_general;
        //    $outp .= '[ ';
       /* foreach($objGeneral as $obGe)
        {
            //$datos[] = $obGe->titulo;
           array_push($datos,$obGe->attributes);
            //array_unshift($datos,array("row" => "$i"));
           // $datos[] = $obje;
        }*/
        
        }
        
        //$outp ='{"records":'.$outp.'}';
        

        //var_dump($datos);
        echo json_encode($datos);                        
    }
    public function actionGrabar()
    {
        
        $this->layout='principal';
        $objDatos = json_decode(file_get_contents("php://input"));
        
        //var_dump($objDatos);
        //return "hola";
        //$model = new Proyecto();
      /*  $model=Proyecto::find()
                    ->select('proyecto.id, proyecto.titulo, proyecto.presupuesto')
                    ->where('estado=1')
                    ->all();*/
                    
            //var_dump($countIntituciones);
        return $this->render('grabar');
    }
    
    
    public function actionRespuesta()
    {
        
        $this->layout='principal';
        //$order_list_input = json_decode(Input::get('order_list'));
        
        $myData = json_decode($_POST['order_list']);
        echo $myData->nombre;

        //var_dump($objDatos);
        //return "hola";
        //$model = new Proyecto();
      /*  $model=Proyecto::find()
                    ->select('proyecto.id, proyecto.titulo, proyecto.presupuesto')
                    ->where('estado=1')
                    ->all();*/
                    
          //  var_dump($objDatos);
       // echo $order_list_input->nombre;
    }
    
    public function actionRegistrar()
    {
        $valor = '';
        $data_obj = json_decode($_POST['obj_esp']);
        
        $id_proyecto = Proyecto::find('id')
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
                        
        foreach($data_obj as $d_obj)
        {
                if($d_obj->id != '')
                    {
                        $objetivosespecificos=ObjetivoEspecifico::findOne($d_obj->id);
                        $objetivosespecificos->id_proyecto=$d_obj->id_proyecto;
                        $objetivosespecificos->descripcion=$d_obj->descripcion;
                        $objetivosespecificos->update(); 
                    }
                    else
                    {
                        $objetivosespecificos=new ObjetivoEspecifico;
                        $objetivosespecificos->id_proyecto=$id_proyecto->id;
                        $objetivosespecificos->descripcion=$d_obj->descripcion;
                        $objetivosespecificos->save(); 
                    }
            
        //echo $data_obj->descripcion['0'];
        //$valor .= $d_obj->id." - ";
        }
        
        echo $valor;
        //var_dump($objDatos);
        //return "hola";
        //$model = new Proyecto();
      /*  $model=Proyecto::find()
                    ->select('proyecto.id, proyecto.titulo, proyecto.presupuesto')
                    ->where('estado=1')
                    ->all();*/
                    
          //  var_dump($objDatos);
       // echo $order_list_input->nombre;
    }
    
}