<?php
namespace app\widgets\colaboradores;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Aportante;
use app\models\Usuario;
use app\models\Maestros;

class ColaboradoresWidget extends Widget
{
    public $id;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //var_dump($this->id);die;
        $colaborador=Aportante::find()
                                ->where(' tipo = 3 and id_proyecto=:id_proyecto',[':id_proyecto'=>$this->id])
                                ->all();
        //var_dump($objetivosespecificos);die;
        //if ($actividad->load(\Yii::$app->request->post())) {
            
            //1return \Yii::$app->getResponse()->refresh();
        //}
        
        $tipo_inst = Maestros::find()
                                ->where('id_padre = 70 and estado = 1')
                                ->orderBy('orden')
                                ->all();
                                
        $regimen = Maestros::find()
                                ->where('id_padre = 74 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        return $this->render('colaboradores',['colaborador'=>$colaborador,'proyecto_id'=>$this->id,'tipo_inst'=>$tipo_inst,'regimen'=>$regimen]
                             );
    }
}