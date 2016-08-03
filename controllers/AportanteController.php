<?php

namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\web\Session;
use yii\web\NotFoundHttpException;
use app\models\Aportante;
use app\models\Desembolso;
use app\models\Maestros;
use app\models\Proyecto;

class AportanteController extends Controller
{
    public function actionIndex()
    {
        $situacion = $_REQUEST["situation"];
        $evento = $_REQUEST["event"];
        
        $this->layout='principal';
        $session = Yii::$app->session;
        $aportante=new Aportante;
        
        if($aportante->load(Yii::$app->request->post()) )
        {
            
            if(isset($aportante->aporte_nomonetario))
            {
                $countAportantess=count(array_filter($aportante->aporte_nomonetario));           
                for($i=0;$i<$countAportantess;$i++)
                {  
                    if(!empty($aportante->aportante_ids[$i]))
                    {
                        $aportanteupdate=Aportante::findOne($aportante->aportante_ids[$i]);
                        $aportanteupdate->monetario=$aportante->aporte_monetario[$i];
                        $aportanteupdate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportanteupdate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportanteupdate->update(); 
                    }
                }
            }
            
            /*
            $countAportantess=count(array_filter($aportante->aporte_tipo));
                for($i=0;$i<$countAportantess;$i++)
                {

                    if(!empty($aportante->aportante_ids[$i]))
                    {
                        $aportanteupdate=Aportante::findOne($aportante->aportante_ids[$i]);
                        $aportanteupdate->id_proyecto=$aportante->proyecto_id;
                        //$aportanteupdate->colaborador=$aportante->aporte_colaborador[$i];
                        $aportanteupdate->tipo=$aportante->aporte_tipo[$i];
                        $aportanteupdate->monetario=$aportante->aporte_monetario[$i];
                        $aportanteupdate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportanteupdate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportanteupdate->update(); 
                    }
                    else
                    {
                        $aportantecreate=new Aportante;
                        $aportantecreate->id_proyecto=$aportante->proyecto_id;
                        //$aportantecreate->colaborador=$aportante->aporte_colaborador[$i];
                        $aportantecreate->tipo=$aportante->aporte_tipo[$i];
                        $aportantecreate->monetario=$aportante->aporte_monetario[$i];
                        $aportantecreate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportantecreate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportantecreate->save(); 
                    }
                }*/
            return $this->refresh();
        }
        else
        {
            
        $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                        ->one();
                        
        $aportante12=Aportante::find()
                    ->where('tipo <> 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        $aportante3=Aportante::find()
                    ->where('tipo = 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        
        $aportante=Aportante::find()
                    ->where('id_proyecto =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        $desembolsos=Desembolso::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                                ->all();
        $nro_desembolso = Maestros::find()
                                ->where('id_padre = 48 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $meses = Maestros::find()
                                ->where('id_padre = 57 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        }
        
        return $this->render('index',['proyecto'=>$proyecto,'aportante3'=>$aportante3,'aportante12'=>$aportante12,'aportante'=>$aportante,'proyecto_id'=>$session['proyecto_id'],'desembolsos'=>$desembolsos,'nro_desembolso'=>$nro_desembolso,'meses'=>$meses,'evento'=>$evento]);
    }
    
    public function actionDesembolso()
    {
        $this->layout='principal';
        $session = Yii::$app->session;
        $aportante=new Aportante;
        
        if($aportante->load(Yii::$app->request->post()) )
        {
            $countDesembolso=count(array_filter($aportante->desembolsos_nro));
            //var_dump($countAportantess); die;
             /*aportantes*/
                for($i=0;$i<$countDesembolso;$i++)
                {
                    //var_dump($aportante); die;
                    if(isset($aportante->desembolsos_ids[$i]))
                    {
                        $desembolsoupdate=Desembolso::findOne($aportante->desembolsos_ids[$i]);
                        $desembolsoupdate->id_proyecto=$aportante->proyecto_id;
                        $desembolsoupdate->nro_desembolso=$aportante->desembolsos_nro[$i];
                        $desembolsoupdate->mes=$aportante->desembolsos_mes[$i];
                        $desembolsoupdate->anio=$aportante->desembolsos_anio[$i];
                        $desembolsoupdate->monto=$aportante->desembolsos_montos[$i];
                        $desembolsoupdate->porcentaje=$aportante->desembolsos_porcentaje[$i];
                        $desembolsoupdate->update(); 
                    }
                    else
                    {
                        $desembolsocreate=new Desembolso;
                        $desembolsocreate->id_proyecto=$aportante->proyecto_id;
                        $desembolsocreate->nro_desembolso=$aportante->desembolsos_nro[$i];
                        $desembolsocreate->mes=$aportante->desembolsos_mes[$i];
                        $desembolsocreate->anio=$aportante->desembolsos_anio[$i];
                        $desembolsocreate->monto=$aportante->desembolsos_montos[$i];
                        $desembolsocreate->porcentaje=$aportante->desembolsos_porcentaje[$i];
                        $desembolsocreate->save(); 
                    }
                }
            return $this->refresh();
        }
        return $this->render('desembolso',['proyecto_id'=>$session['proyecto_id']]);
    }
    
    public function actionEliminardesembolso($id)
    {
        $mesaje = "";
        $estado = 0;

            Desembolso::findOne($id)->delete();
            $estado = 1;
            $mesaje = "Se elimino el Desembolso Correctamente.";
        
        
        
        $array = array('mensaje'=>$mesaje,'estado'=>$estado);
            echo json_encode($array);
    }
    
    public function actionEliminaraportante($id)
    {
        $mesaje = "";
        $estado = 0;

            Aportante::findOne($id)->delete();
            $estado = 1;
            $mesaje = "Se elimino el Colaborador Correctamente.";
        
        
        
        $array = array('mensaje'=>$mesaje,'estado'=>$estado);
            echo json_encode($array);
    }

}
