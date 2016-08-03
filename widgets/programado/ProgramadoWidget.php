<?php
namespace app\widgets\programado;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Recurso;
use app\models\ObjetivoEspecifico;
use app\models\Proyecto;
use app\models\RecursoProgramado;
use app\models\Maestros;

class ProgramadoWidget extends Widget
{
    public $recurso_id;
    public $re;
    public $vigencia;
    public $evento;
    public $tabla;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //$proyecto=Proyecto::findOne($this->proyecto_id);
        /*$CountIndicadores=Indicador::find()
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->proyecto_id])
                                ->count();
        $objetivos=ObjetivoEspecifico::find()->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->proyecto_id])->all();
        
        $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$this->proyecto_id])
                                ->all();*/
        $programado = RecursoProgramado::find()
                                ->where('id_recurso = :id_recurso',[':id_recurso'=>$this->recurso_id])
                                ->orderBy('mes')
                                ->all();
        
        $recursos=Recurso::find()
                                ->select('precio_unit')
                                ->where('id=:id',[':id'=>$this->recurso_id])
                                ->one();
        
        return $this->render('programado',['programado'=>$programado,
                                            're'=>$this->re,
                                            'vigencia'=>$this->vigencia,
                                            'recursos'=>$recursos,
                                            'rec_prog_id'=>$this->recurso_id,
                                            'evento'=>$this->evento,
                                            'correlativo'=>$this->tabla
                                            ]);
    }
}