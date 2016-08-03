<?php
namespace app\widgets\indicadores;


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
class IndicadoresWidget extends Widget
{
    public $objetivo_id;
    public $correlativo;
    public $gestion;
    public $evento;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //$proyecto=Proyecto::findOne($this->proyecto_id);
        //$CountObjetivos=ObjetivoEspecifico::find()->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->proyecto_id])->count();
        //$objetivosind=ObjetivoEspecifico::find()->where('id=:id',[':id'=>$this->objetivo_id])->one();
        $indicadores=Indicador::find()
                                ->where('id_oe=:objetivo_id',[':objetivo_id'=>$this->objetivo_id])
                                ->all();
        
        return $this->render('indicadores',['indicadores'=>$indicadores,'correlativo'=>$this->correlativo,
                                            ///'proyecto_id'=>$this->proyecto_id,
                                            //'CountObjetivos'=>$CountObjetivos,
                                            'objetivosind'=>$this->objetivo_id,
                                            'gestion'=>$this->gestion,
                                            'event'=>$this->evento
                                            ]);
    }
}