<?php
namespace app\widgets\observacion;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Actividad;


class ObservacionWidget extends Widget
{
    public $maestro; //parametro golbal para el controller
    public $titulo; //titulo de popup
    public $tipo; //0:modificacion,1:aprobaciones
    
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        
    
        
        return $this->render('observacion',[//'actividades'=>$actividades,
                                            'maestro'=>$this->maestro,
                                            'titulo'=>$this->titulo,
                                            'tipo'=>$this->tipo,
                                            //'indicadores'=>$indicadores
                                            ]);
    }
}