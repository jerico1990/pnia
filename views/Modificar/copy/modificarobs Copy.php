<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use app\models\Maestros;

//use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $nuevo app\models\TblPersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>


<div id="form1" >
    <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div class="text-center">
                
            <h3><strong>    Solo falta un paso </strong><span style=" font-size: medium">para Terminar con sus cambios.</span></h3>
            
            </div>
            <div class="clearfix"></div>
            <br/>
            <br/>   
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group required">
                <input type="hidden" value="<?= $id_proyecto?>" id="proyecto-id" name="Proyecto[id]" /> 
                <label>Para terminar esta solicitud de cambio en su proyecto, se requiere como ultima actividad describir de forma textual las modificaciones que realizo.</label>
                
                </div>
             
                
            </div>
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-descripcion required">
                <label for="proyecto-vigencia">Detalle los cambios Realizados:</label>
                <textarea rows="15" class="form-control" type="text" id="proyecto-descripcion" name="Proyecto[descripcion]"  required/></textarea> <!-- required-->
                </div>    
            </div>
            
            <div class="clearfix"></div>
            <br/>

            <div class="col-xs-12 col-sm-7 col-md-12" >
            <button type="submit" id="btnproyecto" class="btn btn-primary pull-right">Finalizar</button>   
            </div>
        

    
    
 <?php ActiveForm::end(); ?>
</div>

<script>
    
 $('#btnproyecto').click(function( ) {
    
    var descripcion = $('#proyecto-descripcion').val();
    if ($.trim(descripcion) != '') {
        
        /*$.notify({
                message: "Sus Cambios han sido registrados Correctamente." 
            },{
                allow_dismiss: false,
                type: 'info',
                offset: 300,
                spacing: 10,
                z_index: 1031,
                placement: {
                    from: 'top',
                    align: 'center'
                },
            })*/
        
        jsShowWindowLoad("Sus Cambios han sido registrados Correctamente.");
        
        return true;
    }
    
    $.notify({
                message: "Por Favor Ingrese la descripción del Cambio." 
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
    
    
    return false
    });   
</script>