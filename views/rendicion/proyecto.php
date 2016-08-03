<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RendicionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rendiciones por Aprobar');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendicion-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label'=>'Nombre del Proyecto',
                'attribute' => 'titulo',
                'format'=>'raw',
                'value'=>'titulo',
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
               //'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            
            [
                'label'=>'Cantidad de Rendiciones',
                'attribute' => 'cantidad',
                'format'=>'raw',
                'value'=>'cantidad',
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
               //'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            
            //'id_user',
            //'id_user',
            
            /*[
                'label'=>'Estado',
                'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($data) {
                    
                    if($data->estado == 1 ){return "<span style='color:green;'><strong>COmpleto</strong><span>"; }
                    if($data->estado == 0 ){return "<span style='color:blue;'><strong>Registrado</strong><span>"; }
                            
                    
                },
                'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],*/

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{index}',
             'buttons' => [
                'index' => function ($url, $model) {
                    return Html::a('<span class="fa fa-search">Ver</span>', $url, [
                                'title' => Yii::t('app', 'Ver Desembolso'),
                                'class'=>'btn btn-primary btn-xs ver',
                                
                    ]);
                }
              ]
             
             ],
        ],
    ]); ?>

</div>
