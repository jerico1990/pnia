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
                <h2 name="general">4. Otros</h2>
                <span class="required_notification">* Datos requeridos</span>
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" />
            </li>
            
            <li>
                <h4>4.1 Lugar de acción donde se ejecutará el trabajo de Investigación</h4>
                <?= \app\widgets\zonaaccion\ZonaAccionWidget::widget(['proy_zonaaccion_id'=>$proyecto->id]); ?> 
                
            </li>
            <li>
                <h4>4.2 Plan de Trabajo</h4>
                <label for="proyecto-plan_trabajo">Descripción:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 300px;" id="proyecto-plan_trabajo" name="Proyecto[plan_trabajo]"  required><?= $proyecto->plan_trabajo?></textarea>

                
            </li>
            <li>
                <h4>4.3 Resultados Esperados en Innovación Agraria o Transferencia de Tecnología</h4>
                <label for="proyecto-resultados_esperados">Descripción:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 200px;" id="proyecto-resultados_esperados" name="Proyecto[resultados_esperados]"  required><?= $proyecto->resultados_esperados?></textarea>

            </li>
            <li>
                <h4>4.4 Presupuesto del Proyecto</h4>
                <label for="proyecto-presupuesto">Monto Total:</label>
                <input type="text" value="<?= $proyecto->presupuesto?>" placeholder="Presupuesto"  id="proyecto-presupuesto" name="Proyecto[presupuesto]"  required/>
                
            </li>
            <li>
                <h4>4.5 Lista de Referencias Bibliográficas</h4>
                <label for="proyecto-referencias_bibliograficas">Señale las Referencias:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 200px;" id="proyecto-referencias_bibliograficas" name="Proyecto[referencias_bibliograficas]"  required><?= $proyecto->referencias_bibliograficas?></textarea>

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

$('#proyecto-presupuesto').keydown(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
          });


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
    if($.trim($('#proyecto-titulo').val())=='')
        {
            error=error+'Ingrese Nombre del Proyecto<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-direccion_linea').val())=='')
        {
            error=error+'Señale la Dirección en Linea<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-estacion_exp').val())=='')
        {
            error=error+'Señale la Estación Experimental<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-sub_estacion_exp').val())=='')
        {
            error=error+'Señale la Sub Estación Experimental<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-nombres').val())=='')
        {
            error=error+'Ingrese Nombres del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-apellidos').val())=='')
        {
            error=error+'Ingrese Apellidos del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-telefono').val())=='')
        {
            error=error+'Ingrese Nro Teléfonico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-celular').val())=='')
        {
            error=error+'Ingrese Nombre Nro Celular del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }

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


$("#proyecto-colaboradores").click(function( ) {
    var existe=$.ajax({
                url: '<?= $urlproyectoExiste ?>',
                type: 'POST',
                async: false,
                //data: {},
                success: function(data){
                    
                }
            });
    if(existe.responseText!=1)
        {
            $.notify({
                message: existe.responseText
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
});

</script>

