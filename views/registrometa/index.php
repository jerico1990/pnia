<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegistroMetaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Registro Metas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-meta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    if(Yii::$app->user->identity->id_perfil == 2) 
        { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Registrar Meta'), ['accion'], ['class' => 'btn btn-success','id'=>'registrar_meta']) ?>
    </p>
    <?php } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'label'=>'Tipo',
                'attribute' => 'id_tipo',
                'format'=>'raw',
                'value'=>function($data) {
                   if($data->id_tipo == 2 ){return "<span><strong>Actividad</strong><span>"; }
                    if($data->id_tipo == 1 ){return "<span><strong>Indicador</strong><span>"; }
                    
                    },
                //'contentOptions'=>['style'=>'width: 420px; font-size: x-small;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                
            ],
            [
                'label'=>'Fecha',
                'attribute' => 'fecha',
                'format'=>'raw',
                'value'=>'fecha',
                'contentOptions'=>['class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                
            ],
            [
                'label'=>'Fecha de Aprobación',
                'attribute' => 'fecha_aprobacion',
                'format'=>'raw',
                'value'=>'fecha_aprobacion',
                'contentOptions'=>['class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                
            ],
            
            // 'id_user',
            // 'id_user_obs',
            // 'observacion',
             [
                'label'=>'Estado',
                'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($data) {
                   if($data->estado == 3 ){return "<span style='color:red;'><strong>Rechazado</strong><span>"; }
                    if($data->estado == 2 ){return "<span style='color:green;'><strong>Aprobado</strong><span>"; }
                    if($data->estado == 0 ){return "<span style='color:blue;'><strong>Registrado</strong><span>"; }
                    
                    },
                'contentOptions'=>['class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                
            ],

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}',
             'buttons' => [
                'view' => function ($url, $model) {
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
<?php

    $verificar_pendientes= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_registros_pendientes');
?>
<script>
    
    $("#registrar_meta").click(function() {
       //alert("llego");
       var valor1 = 0;
       var valor2 = null; 
        $.ajax({
                    url: '<?= $verificar_pendientes ?>',
                    type: 'GET',
                    async: false,
                    //data: {unidadejecutora:unidad.val()},
                    success: function(data){
                      valor1 = data;
                    }
                });
        
        if (valor1 > 0) {
           
           $.notify({
                message: "<strong>No es posible esta Acción: </strong>Tiene un Registro de Cambio Pendiente." 
            },{
                type: 'danger',
                offset: 20,
                spacing: 10,
                z_index: 1031,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
           
           return false;
        }
        
        return true;
        
    });
    
    
</script>