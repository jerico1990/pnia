<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SolicitudDesembolsoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cierre Desembolso');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-desembolso-index">
    <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if(Yii::$app->user->identity->id_perfil == 2)
    {
    ?>
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
                //'label'=>'Estado',
                'attribute' => 'total',
                'format'=>'raw',
                'value'=>function($data) {
                    return $data->total."<input type='hidden'  id='total' name='SolicitudDesembolso[total]' value='".$data->total."' />";
                
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                //'label'=>'Estado',
                'attribute' => 'total_pendiente',
                'format'=>'raw',
                'value'=>function($data) {
                    return $data->total_pendiente."<input type='hidden'  id='total_pendiente' name='SolicitudDesembolso[total_pendiente]' value='".$data->total_pendiente."' />";
                
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
                    if($data->estado == 3 ){return "<span style='color:red;'><strong>Rechazado</strong><span>"; }
                    if($data->estado == 2 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
                    if($data->estado == 1 ){return "<span style='color:orange;'><strong>Por Rendir</strong><input type='hidden'  id='id_sol' name='SolicitudDesembolso[id_sol]' value='".$data->id."' /><span>"; }
                    if($data->estado == 0 ){return "<span style='color:blue;'><strong>Solicitado</strong><span>"; }
                
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
    <div class="clearfix"></div><br/><br/>
		<div class="col-xs-12 col-sm-7 col-md-4" ></div>
                <div class="col-xs-12 col-sm-7 col-md-8 col-centered" >
                    
                    <button style="" type="button" id="btncerrar" class="btn btn-success " data-toggle="modal" data-target="#modalobs_">Cerrar Solicitud Desembolso</button>  
		</div>

                
                
    <div class="modal fade" id="modalobs_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Confirmación Cierre de Desembolso</strong></h4>
                </div>
                <div class="modal-body">
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-7 col-md-12">
                     <strong>Nota:</strong>   
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-7 col-md-12">
                     <label id="mensaje"></label>   
                    </div>
                    <div id="mensajeobs" ></div>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
                    <div class="col-xs-12 col-sm-7 col-md-6 col-centered" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btn_observacion" class="btn btn-success" >Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>
<?php

    $desembolsos_pendientes= Yii::$app->getUrlManager()->createUrl('desembolsodetalle/desembolso_pendiente');
?>
<script>

$(document).ready(function(){
    var total = $("#total").val();
   if(!total)
   {
     $('#btncerrar').hide();
   }
});
    
$('#btncerrar').click(function(){
    
    var mensaje = '';
    var total = $("#total").val();
    var total_pendiente = $("#total_pendiente").val();
    //var diferencia = total - total_pendiente;
    
    if (total_pendiente > 0)
    {
        mensaje = '<br/>Usted Cuenta con sun saldo a favor S/. '+total_pendiente+' al cerrar el Desembolso, esta diferencia sera descontado del siguiente Desembolso solicitado.<br/><br/> De click en Aceptar para dar como concluido el Desembolso<br/><br/>';
       
    }
    else
    {
       mensaje = '<br/>Usted a cumplido con el Desembolso asignado. <br/><br/> De click en Aceptar para dar como concluido el Desembolso.<br/><br/>'; 
    }
    $("#mensaje").html(mensaje) 
    
});


$("#btn_observacion").click(function( ) {
   
          jsShowWindowLoad('Procesando...');
          
          return true;

}); 
    
</script>