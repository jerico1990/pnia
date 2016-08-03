<?php
namespace app\widgets\zonaaccion;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\ZonaAccion;
use app\models\Usuario;
use app\models\Ubigeo;

class ZonaAccionWidget extends Widget
{
    public $proy_zonaaccion_id;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //var_dump($this->id);die;
        $departamentos = Ubigeo::find(['department_id', 'department'])
                        ->groupBy('department_id')
                        ->orderBy('department')
                        ->all();
                        
        $provincias = Ubigeo::find('province_id, province')
                        ->groupBy('province_id')
                        ->orderBy('province')
                        ->all();
        
        $distritos = Ubigeo::find('district_id, district')
                        ->groupBy('district_id')
                        ->orderBy('district')
                        ->all();
        
        $zonaaccion=ZonaAccion::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->proy_zonaaccion_id])
                                ->all();
        //var_dump($objetivosespecificos);die;
        //if ($actividad->load(\Yii::$app->request->post())) {
            
            //1return \Yii::$app->getResponse()->refresh();
        //}
        
        return $this->render('zona_accion',['zonaaccion'=>$zonaaccion,'proy_zonaaccion_id'=>$this->proy_zonaaccion_id,'departamentos'=>$departamentos,'provincias'=>$provincias,'distritos'=>$distritos]
                             );
    }
}