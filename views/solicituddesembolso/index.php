<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\AprobacionDesembolso;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudDesembolsoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Solicitud Desembolsos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-desembolso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if(Yii::$app->user->identity->id_perfil == 2)
    {
    ?>
    <p>
        <?= Html::a(Yii::t('app', 'Solicitar Nuevo Desembolso'), ['desembolsodetalle/index'], ['class' => 'btn btn-success','id'=>'nuevo_desembolso']) ?>
    </p>
    <?php } ?>
    <div class="col-md-1"></div>
   <div class="col-md-11">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'id_user',
            //'total',
            'fecha_solicitud',
            [
                'label'=>'Fecha Respuesta',
                'attribute' => 'fecha_aprobacion',
                'format'=>'raw',
                'value'=>function($data) {
                    
                    if($data->fecha_aprobacion == null)
                    {
                        return "";
                    }
                    return $data->fecha_aprobacion;
                
                    
                },
                
            ],
            [
                //'label'=>'Total',
                'attribute' => 'total',
                'format'=>'raw',
                'value'=>function($data) {
                    return 'S/. '.$data->total;
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                //'label'=>'Total',
                'attribute' => 'total',
                'format'=>'raw',
                'value'=>function($data) {
                    return 'S/. '.$data->total_pendiente;
                    
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
                    $nivelApro = 0;
                    if($data->estado == 3 ){return "<span style='color:red;'><strong>Rechazado</strong><span>"; }
                    if($data->estado == 2 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
                    if($data->estado == 1 ){return "<span style='color:orange;'><strong>Por Rendir</strong><span>"; }
                    
                    if(Yii::$app->user->identity->id_perfil == 2)
                    {
                        if($data->estado == 0 ){return "<span style='color:blue;'><strong>Solicitado</strong><span>"; }
                    }
                    
                    if($data->estado == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 5)
                    { $nivelApro = 3; }
                    
                    if(Yii::$app->user->identity->id_perfil == 6)
                    { $nivelApro = 4; }
                    
                    $aprobacion = AprobacionDesembolso::find()->where('estado = 1 and id_solicitud = :id_solicitud and id_nivelaprobacion = :id_nivelaprobacion',[':id_solicitud'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Por Rendir</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:blue;'><strong>Solicitado</strong><span>";  
                    }
                    
                        
                    }
 
                    
                    
                
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
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
    <div class="col-md-1"></div>
</div>
<?php

    $desembolsos_pendientes= Yii::$app->getUrlManager()->createUrl('desembolsodetalle/desembolso_pendiente');
?>
<script>
    
$("#nuevo_desembolso").click(function()
    {
    var valor = null;
        $.ajax({
                    url: '<?= $desembolsos_pendientes ?>',
                    type: 'GET',
                    async: false,
                    data: {id_user:<?= Yii::$app->user->identity->id; ?>},
                    success: function(data){
                         valor = jQuery.parseJSON(data);
                      
                    }
                });
        
        if (valor.estado > 0) {
           $.notify({
                message: valor.mensaje 
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