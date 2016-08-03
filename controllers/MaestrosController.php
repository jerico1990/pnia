<?php

namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Usuarios;
use app\models\Proyecto;
use app\models\Responsable;
use app\models\ObjetivoEspecifico;
use app\models\Actividad;
use app\models\Cronograma;
use app\models\CultivoCrianza;
use app\models\AccionTransversal;
use app\models\Indicador;
use app\models\AlianzaEstrategica;
use app\models\Colaborador;
use app\models\Maestros;

class MaestrosController extends Controller
{
    public function actionDependencia($unidadejecutora)
    {
        $option = '<option value="0">--Seleccione--</option>';
        //$unidad_ejecutora = $_GET['unidadEjecutora'];
        
        $dependencia = Maestros::find('id, descripcion')
                                ->where('id_padre = :id_padre  and estado = 1',[':id_padre'=>$unidadejecutora])
                                ->orderBy('orden')
                                ->all();
                                
        foreach($dependencia as $dependencia2)
        {
           $option .= '<option value="'.$dependencia2->id.'" >'.$dependencia2->descripcion.'</option>';
        }
        
        echo $option;  
    }
    
}