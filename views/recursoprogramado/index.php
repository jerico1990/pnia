<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecursoProgramadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Desembolso del Proyecto');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recurso-programado-index text-center">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Create Recurso Programado'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <div class="col-xs-12 col-sm-7 col-md-8" >
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'options' => ['style' => 'width:50px;']],
            //'id',
            //'id_recurso',
            [
                'label'=>'Año',
                'attribute' => 'anio',
                'format'=>'raw',
                'value'=>'anio',
                'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                'label'=>'Mes',
                'attribute' => 'mes',
                'format'=>'raw',
                'value'=>function($data) {
                    switch($data->mes)
                    {
                        case 1: return "Enero";
                        case 2: return "Febrero";
                        case 3: return "Marzo";
                        case 4: return "Abril";
                        case 5: return "Mayo";
                        case 6: return "Junio";
                        case 7: return "Julio";
                        case 8: return "Agosto";
                        case 9: return "Setiembre";
                        case 10: return "Octubre";
                        case 11: return "Noviembre";
                        case 12: return "Diciembre";
                    }
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                'label'=>'Monto (S/.)',
                'attribute' => 'cantidad',
                'format'=>'raw',
                'value'=>function($data) {
                   return '<label class="soles">'.number_format($data->cantidad,2).'</label>';
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                'label'=>'Estado',
                'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($data) {
                    if($data->estado == 2 ){return "<span style='color:blue;'><strong>Completo</strong><span>"; }
                    if($data->estado == 1 ){return "<span style='color:orange;'><strong>Por Rendir</strong><span>"; }
                    if($data->estado == 0 ){return "<span style='color:green;'><strong>Disponible</strong><span>"; }
                
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    
</div>

<script>

 $(document).ready(function(){
    moneda_soles(".soles");
 });

 
 
 
</script>