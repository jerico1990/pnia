<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Usuarios;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DesembolsoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Solicitud de Desembolso');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="recurso-programado-index text-center">
    <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'SolicitudDesembolso','titulo'=>'Motivo del Rechazo:','tipo'=>'1']); ?>  
    <div class="col-xs-12 col-sm-7 col-md-1" >
        <input type="hidden" name="SolicitudDesembolso[id_sol]" value="<?= $id; ?>" />
        <input type="hidden" value="" id="solicituddesembolso-respuesta_aprob" name="SolicitudDesembolso[respuesta_aprob]" /> 
    </div>
    <div class="col-xs-12 col-sm-7 col-md-11" >
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'showFooter'=>TRUE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'options' => ['style' => 'width:50px;']],

            [
                'label'=>'Año',
                'attribute' => 'anio',
                'format'=>'raw',
                'value'=>function($data) {
                    return $data->anio.'<input type="hidden" value="'.$data->anio.'" id="proyecto-id" name="RecursoProgramado[anio][]" />';
                
                    
                },
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
                        case 1: return 'Enero<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 2: return 'Febrero<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 3: return 'Marzo<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 4: return 'Abril<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 5: return 'Mayo<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 6: return 'Junio<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 7: return 'Julio<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 8: return 'Agosto<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 9: return 'Setiembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 10: return 'Octubre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 11: return 'Noviembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                        case 12: return 'Diciembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="RecursoProgramado[mes][]" />';
                    }
                    
                },
                'footer'=>"<strong>Total Desembolso:</strong>",
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                'label'=>'Monto (S/.)',
                'attribute' => 'monto',
                'format'=>'raw',
                'value'=>function($data){
                    return 'S/. '.$data->monto.'<input type="hidden" value="'.$data->monto.'" id="recursoprogramado-id" name="RecursoProgramado[cantidad2][]" />';
                
                    
                },
                'footer'=>'<strong>S/. '.$total.'</strong>',
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
                    if($data->estado == 1 ){return "<span style='color:orange;'><strong>Por Rendir</strong><span>"; }
                    if($data->estado == 0 ){return "<span style='color:blue;'><strong>Disponible</strong><span>"; }
                
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            /*[
                'label'=>'',
                //'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($model, $key, $index, $column) {
                    return '<input type="checkbox" value="'.$index.'" name="RecursoProgramado[solicita][]" >';
                
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],*/
            
            /*[
            'class' => 'yii\grid\CheckboxColumn',
            //'header' => Html::checkBox('selection', false, ['class' => 'select-on-check-all yourClass']),
            'checkboxOptions' => function($model, $key, $index, $column) {
                  return ['value' => $index,'class'=>'proyecto-seleccion','name'=>'Proyecto[solicita]'];
            
            }

        ],*/

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <div class="clearfix"></div>
    <?php
    if($solicitud->observacion != null)
    {
            $datos_user = Usuarios::find()
            ->select('usuarios.Name,perfil.descripcion,usuarios.id_perfil')
            ->innerJoin('perfil','perfil.id=usuarios.id_perfil')
            ->where('usuarios.id=:id_user',[':id_user'=>$solicitud->id_user_obs])
            ->one();
     ?>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
        <div class="col-xs-12 col-sm-7 col-md-8" >
                <div class="panel panel-<?= ($datos_user->id_perfil == 2) ? 'info':'danger' ?>">
                    
                    <div class="panel-heading">
                      <h4 class="panel-title"><?= $datos_user->Name; ?>(<?= $datos_user->descripcion; ?>) - <?= $solicitud->fecha_aprobacion; ?></h4>
                    </div>
                    
                    <div class="panel-body">
                     <?= $solicitud->observacion; ?>
                    </div>
                    
                </div>  
        </div>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <?php } ?>
    
    
    <?php
                if(Yii::$app->user->identity->id_perfil == 2)
                {
                    ?>
                <div class="clearfix"></div><br/><br/>
                
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                <div class="col-xs-12 col-sm-7 col-md-6" >
                        <table class="table  " border=1 name="DetalleRendicion[detalle_tabla]" id="detalle_tabla" border="0">
                        <thead>
                            <tr class="info">
                                <th class="text-center" >
                                    #
                                </th>
                                <th class="text-center" >
                                    Usuario Aprobador
                                </th>
                                <th class="text-center">
                                    Estado
                                </th>
                        </thead>
                        <tbody>
                            <?php for($i=0;$i < count($user_aprueba);$i++){ ?>
                            <tr class="text-center">
                                <td><?= ($i+1) ?></td>
                                <td><?= $user_aprueba[$i] ?></td>
                                <td><?= $estado_aprueba[$i] ?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                        </table>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                
                <?php } ?>
    
    
    <div class="clearfix"></div>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <div class="col-xs-12 col-sm-7 col-md-8 col-centered" >
        <?php
    if(Yii::$app->user->identity->id_perfil != 2)
    {
    ?>
        <button style="" type="button" id="btnrechaza" class="btn btn-danger " data-toggle="modal" data-target="#modalobs_">Rechazar</button>  
        <button type="submit" id="btnaceptar" class="btn btn-success ">Aceptar</button>   
    <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    
    <?php ActiveForm::end(); ?>
    
</div>

<script>
    
var requiere_aprobar = <?= $requiere_aprobar; ?>;
 if(requiere_aprobar == 0)
 {
    $('#btnrechaza').hide();
    $('#btnaceptar').hide();
 }
$(".pagination").hide();

$("#btnSolicitar").click(function(){
    //var clasificador= $('.table').find('input[name=\'Proyecto[solicita][]\']').length;
            var valor=$('.table').find('input[name=\'RecursoProgramado[solicita][]\']').serializeArray();
    
    if ($.isEmptyObject(valor)) {
        $.notify({
                message: "Por favor Seleccione un Desembolso" 
            },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
        
        return false;
    }

    jsShowWindowLoad("Procesando Solicitud...");
    return true;
});


$("#btnaceptar").click(function( ) {
   
   var respuesta = confirm('Esta seguro de Aprobar este Desembolso?');
   
   if (respuesta == true) {
     
     $('#solicituddesembolso-respuesta_aprob').val(1);
     jsShowWindowLoad('Procesando...');
     return true;
   }
    
    return false;
});

</script>