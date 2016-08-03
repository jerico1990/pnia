<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
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

    
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <div class="col-xs-12 col-sm-7 col-md-8" >
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
             'options' => ['style' => 'width:50px;']],

            [
                'label'=>'Año',
                'attribute' => 'anio',
                'format'=>'raw',
                'value'=>function($data) {
                    return $data->anio.'<input type="hidden" value="'.$data->anio.'" id="proyecto-id" name="Proyecto[anio][]" />';
                
                    
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
                        case 1: return 'Enero<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 2: return 'Febrero<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 3: return 'Marzo<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 4: return 'Abril<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 5: return 'Mayo<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 6: return 'Junio<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 7: return 'Julio<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 8: return 'Agosto<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 9: return 'Setiembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 10: return 'Octubre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 11: return 'Noviembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
                        case 12: return 'Diciembre<input type="hidden" value="'.$data->mes.'" id="proyecto-id" name="Proyecto[mes][]" />';
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
                    return 'S/. '.$data->cantidad.'<input type="hidden" value="'.$data->cantidad.'" id="proyecto-id" name="Proyecto[cantidad][]" />';
                
                    
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
            [
                'label'=>'',
                //'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($data) {
                    return '<input type="checkbox" value="'.$data->cantidad.'" name="Proyecto[solicita][]" id="proyecto-cerrar_actividad" >';
                
                    
                },
                //'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            
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
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <div class="col-xs-12 col-sm-7 col-md-8 text-right" >
        <button type="submit" id="btnSolicitar" class="btn btn-success pull-right">Realizar Solicitud</button>
        
    </div>
    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    
    <?php ActiveForm::end(); ?>
    
</div>

<script>
//$('.proyecto-seleccion').removeAttr("name");
//$('.proyecto-seleccion').attr("name","Proyecto[solicita]");
$(".pagination").hide();

$("#btnSolicitar").click(function(){
    //var clasificador= $('.table').find('input[name=\'Proyecto[solicita][]\']').length;
            var valor=$('.table').find('input[name=\'Proyecto[solicita][]\']').serializeArray();
    
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

    
    return true;
});

</script>