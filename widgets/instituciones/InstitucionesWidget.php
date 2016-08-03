<?php
namespace app\widgets\instituciones;


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
use app\models\AlianzaEstrategica;

class InstitucionesWidget extends Widget
{
    public $proyecto_id;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        
        $alianzas=AlianzaEstrategica::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->proyecto_id])
                                ->all();
        return $this->render('instituciones',['proyecto_id'=>$this->proyecto_id,'alianzas'=>$alianzas]);
    }
}