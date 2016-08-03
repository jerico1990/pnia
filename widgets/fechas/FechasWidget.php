<?php
namespace app\widgets\fechas;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Actividad;
use app\models\ObjetivoEspecifico;
use app\models\Proyecto;
use app\models\PlanPresupuestal;
use app\models\Integrante;
use app\models\Equipo;
use app\models\Estudiante;
use app\models\Usuario;
use app\models\Cronograma;
use app\models\Indicador;
use app\models\Maestros;

class FechasWidget extends Widget
{
    public $actividad_id;
    public $act;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        
        $actividades=Actividad::find()
                                ->where('id=:id',[':id'=>$this->actividad_id])
                                ->one();
        /*if($this->act != 0){
        var_dump($this->act);die;}*/
        
        return $this->render('fechas',['actividades'=>$actividades,
                                            'act'=>$this->act
                                            //'indicadores'=>$indicadores
                                            ]);
    }
}