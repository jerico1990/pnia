<?php
namespace app\widgets\desembolsos;


use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Desembolso;
use app\models\Maestros;
use app\models\Aportante;

class DesembolsosWidget extends Widget
{
    public $id_proyecto;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //var_dump($this->id);die;
        $desembolsos=Desembolso::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$this->id_proyecto])
                                ->all();
        
        $aportante=Aportante::find()
                    ->select('total')
                    ->where('tipo = 1 and id_proyecto =:id_proyecto',[':id_proyecto'=>$this->id_proyecto])
                    ->one();
                                
        //var_dump($objetivosespecificos);die;
        //if ($actividad->load(\Yii::$app->request->post())) {
            
            //1return \Yii::$app->getResponse()->refresh();
        //}

        
        $nro_desembolso = Maestros::find()
                                ->where('id_padre = 48 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $meses = Maestros::find()
                                ->where('id_padre = 57 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        
        
        return $this->render('desembolsos',['desembolsos'=>$desembolsos,'proyecto_id'=>$this->id_proyecto,'nro_desembolso'=>$nro_desembolso,'meses'=>$meses,'aportante'=>$aportante]
                             );
    }
}