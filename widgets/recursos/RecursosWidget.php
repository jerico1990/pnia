<?php
namespace app\widgets\recursos;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Usuario;
use app\models\Recurso;
use app\models\Maestros;
use app\models\Aportante;

class RecursosWidget extends Widget
{
    public $actividad_id;
    public $vigencia;
    public $id_proyecto;
    public $evento;
    public $correlativo;
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        
        $recursos=Recurso::find()
                                ->where('actividad_id=:actividad_id',[':actividad_id'=>$this->actividad_id])
                                ->all();
        
        $fuentes=Aportante::find()
                                ->select('id, colaborador')
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->id_proyecto])
                                ->orderBy('tipo')
                                ->all();
                                
        $clasificador = Maestros::find()
                                ->where('id_padre = 32 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        //var_dump($objetivosespecificos);die;
        //if ($actividad->load(\Yii::$app->request->post())) {
            
            //1return \Yii::$app->getResponse()->refresh();
        //}
        
        return $this->render('recursos',['recursos'=>$recursos,'clasificador'=>$clasificador,'vigencia'=>$this->vigencia,'fuentes'=>$fuentes,'id_proyecto'=>$this->id_proyecto,'event'=>$this->evento,'correlativo'=>$this->correlativo,'actividad_id'=>$this->actividad_id]
                             );
    }
}