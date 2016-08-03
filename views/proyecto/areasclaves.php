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





<!--<form class="contact_form" action="#" id="contact_form" runat="server">-->

    <?php $form = ActiveForm::begin(['options' => ['class' => 'contact_form', ]]); ?>
    <div><a name="general" ></a>
        <ul>
            <li>
                <h2 name="general">2. Áreas Claves</h2>
                <span class="required_notification">* Datos requeridos</span>
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" />
            </li>

            
            <li>
                <h4>   2.1 Cultivo o Crianza priorizado en su Proyecto</h4>
                
                <input type="hidden" value="<?= $cultivo->id?>" id="proyecto-idcc" name="Proyecto[idcc]" /> 
                <label for="proyecto-tipocc">Cultivo o Crianza:</label>
                <select id="proyecto-tipocc" name="Proyecto[tipocc]" style="width:200px;">
                 <option value="0">--Seleccione--</option>   
                 <?php
                 
                    $maestro = Maestros::find()
                                ->where('id_padre = 1 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($maestro as $maestros)
                            {
                ?>
                                <option value="<?= $maestros->id; ?>" <?=($maestros->id == $cultivo->tipo)?'selected':'' ?> > <?= $maestros->descripcion ?></option>;
                    <?php   } ?>
                      
                        
                    
                 
                    
                </select>
                
                
            </li>
            <li id="descripcioncc">
                <label for="proyecto-descripcioncc">Especifique:</label>
                <input type="text" value="<?= $cultivo->descripcion; ?>" placeholder="..." id="proyecto-descripcioncc" name="Proyecto[descripcioncc]" />
                
            </li>
            <li>
                <h4>2.2 Señale una Acción Transversal de Áreas Temáticas Específicas</h4>
                
                <label for="proyecto-idat">Acción Transversal:</label>
                <select id="proyecto-idat" name="Proyecto[idat]" style="width:200px;">
                    <option value="0">--Seleccione--</option>
                <?php
                 
                    $accionTrans = Maestros::find()
                                ->where('id_padre = 10 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($accionTrans as $accionTransv)
                            {
                ?>
                                <option value="<?= $accionTransv->id; ?>" <?=($accionTransv->id == $AccionT->id_accion_transversal)?'selected':'' ?> > <?= $accionTransv->descripcion ?></option>;
                    <?php    } ?>

                 
                </select>
                
                
            </li>
            <li id="especifiqueAT">
                <label for="proyecto-otrosat">Especifique:</label>
                <input type="text" value="<?= $AccionT->otros; ?>" placeholder="..." id="proyecto-otrosat" name="Proyecto[otrosat]"/>
                
            </li>
            <li>
                <h4>2.3 Señale el Tipo de Proyecto</h4>
                
                <label for="proyecto-id_tipo_proyecto">Invetigación:</label>
                <select id="proyecto-id_tipo_proyecto" name="Proyecto[id_tipo_proyecto]" style="width:200px;">
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoInv = Maestros::find()
                                ->where('id_padre = 16 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoInv as $tipoInvs)
                            {
                    ?>
                               <option value="<?= $tipoInvs->id; ?>" <?=($tipoInvs->id == $proyecto->id_tipo_proyecto)?'selected':'' ?> > <?= $tipoInvs->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                
                
            </li>
            <li>
                <label for="proyecto-desc_tipo_proy">Descripción:</label>
                <textarea type="text" placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 100px;" id="proyecto-desc_tipo_proy" name="Proyecto[desc_tipo_proy]"  required><?= $proyecto->desc_tipo_proy?></textarea>
                
                
            </li>
                <li>
                <button type="submit" id="btnproyecto" class="btn btn-primary">Guardar</button>
                </li>
             <li>
                
                
            </li>
        
        </ul>
    </div>
    
    
    
    
 <?php ActiveForm::end(); ?>


<?php

    $urlproyectoExiste= Yii::$app->getUrlManager()->createUrl('proyecto/existeproyecto');
    $urlresponsable= Yii::$app->getUrlManager()->createUrl('responsable/guardar');
    /*$validarintegrante2= Yii::$app->getUrlManager()->createUrl('equipo/validarintegrante2');
    $existeequipo=Yii::$app->getUrlManager()->createUrl('equipo/existeequipo');*/
?>


<script type="text/javascript">
$(document).ready(function(){
 
if($.trim($('select[id=proyecto-tipocc]').val())=='0')
        { $("#descripcioncc").hide();}
else    {$("#descripcioncc").show();;}

if($.trim($('select[id=proyecto-idat]').val())!='15')
        { $("#especifiqueAT").hide();}
else    {$("#especifiqueAT").show();;}


});

$('#proyecto-tipocc').change(function(){ 
     var valor = $('#proyecto-tipocc').val(); 
     
     if (valor != 0) {
       $("#descripcioncc").show();;
     }
     else
     {
      $("#descripcioncc").hide();  
     }
     //saludo(nombre); 
});

$('#proyecto-idat').change(function(){ 
     var valor2 = $('#proyecto-idat').val(); 
     
     if (valor2 == 15) {
       $("#especifiqueAT").show();
     }
     else
     {
      $("#especifiqueAT").hide();  
     }
    // saludo(valor2); 
});

$("#btnproyecto").click(function( ) {
    
    var error='';

     if($.trim($('select[id=proyecto-tipocc]').val())=='0')
        {
            error=error+'Seleccione Cultivo O Crianza<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
     if($.trim($('select[id=proyecto-idat]').val())=='0')
        {
            error=error+'Seleccione Acción Transversal<br>';
            $('#proyecto-idat').addClass('has-error');
            //alert('hola');
        }
    if($.trim($('select[id=proyecto-id_tipo_proyecto]').val())=='0')
        {
            error=error+'Seleccione el Tipo de Investigación<br>';
            $('#proyecto-tipoInvestigacion').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-desc_tipo_proy').val())=='')
        {
            error=error+'Ingrese la Descripción del Proyecto<br>';
            $('#proyecto-desc_tipo_proy').addClass('has-error');
            //alert('hola');
        }
    
    /*if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }*/
        
                 
        
    if(error!='')
        {
            $.notify({
                message: error 
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
        
       /* var id = $('#proyecto-id').val();
        var titulo = $('#proyecto-id').val();
        var direccion_linea = $('#proyecto-direccion_linea').val();
        var estacion_exp = $('#proyecto-estacion_exp').val();
        var sub_estacion_exp = $('#proyecto-sub_estacion_exp').val();
        var nombres = $('#responsable-nombres').val();
        var apellidos = $('#responsable-apellidos').val();
        var telefono = $('#responsable-telefono').val();
        var celular = $('#responsable-celular').val();
        var correo = $('#responsable-correo').val();*/
        
  /*  var validarproyecto=$.ajax({
                url: '<? $urlproyecto ?>',
                type: 'POST',
                async: false,
                data: {'Proyecto[id]':id,'Proyecto[titulo]':titulo,'Proyecto[direccion_linea]':direccion_linea,'Proyecto[estacion_exp]':estacion_exp,'Proyecto[sub_estacion_exp]':sub_estacion_exp},
                success: function(data){
                    
                }
            });    */
        
        
        
    
    return true;
});




</script>

