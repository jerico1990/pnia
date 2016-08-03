<?php
namespace app\widgets\actividades;


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

class ActividadesWidget extends Widget
{
    public $indicador_id;
    public $id_proyecto;
    public $evento;
    
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
        $indicadorBID = Maestros::find()
                                ->where('id_padre = 38 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        
        $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$this->indicador_id])
                                ->all();
        
        return $this->render('actividades',['actividades'=>$actividades,
                                            'indicadorBID'=>$indicadorBID,
                                            'id_proyecto'=>$this->id_proyecto,
                                            'event'=>$this->evento
                                            //'indicadores'=>$indicadores
                                            ]);
    }
}