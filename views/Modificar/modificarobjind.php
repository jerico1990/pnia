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


<style>
   .accordion-toggle:hover {
      text-decoration: none;
    } 
    
</style>



<div id="form1">
    
<div class="alert alert-danger" id="warning">
	   
</div>
<ul class="tabs">
    <li><a href="#tab2" >Objetivos e Indicadores</a></li>
    <?php if($observaciones > 0){ ?>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/observaciones?id='.$proyecto->id.'&event='.$evento.'') ?>" >Observaciones</a></li>
    <?php } ?>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab2">
       <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>    
	 <?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'Proyecto','titulo'=>'Descripcion de la Modificación:','tipo'=>'0']); ?> 
            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-objetivo_general required">
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" /> 
                <label for="proyecto-objetivo_general">Objetivo General:</label>
                <textarea class="form-control" type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 100%; height: 40px;" id="proyecto-objetivo_general" name="Proyecto[objetivo_general]"  required><?= $proyecto->objetivo_general; ?></textarea>
                </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <label>Objetivos Especificos:</label>
                <div class="panel-group" id="accordion">
               <?php 
               $i = 0;
               if($objetivos)
               {
               
                foreach($objetivos as $objetivo)
                {
                     
                ?>
                    <div class="panel panel-primary">
                      <div class="panel-heading" style="height: 45px;padding:5px">
                        <?= \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>$objetivo->id,'correlativo'=>$i]) ?>
                        <!--<h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Collapsible Group 1</a>
                        </h4>-->
                      </div>
                      <div id="collapse<?= $i; ?>" class="panel-collapse collapse <?=($i == 0)?'in':'' ?>">
                        <div class="panel-body">
                            <?= \app\widgets\indicadores\IndicadoresWidget::widget(['objetivo_id'=>$objetivo->id,'correlativo'=>$i,'gestion'=>$objetivo->gestion,'evento'=>$evento]); ?> 
                        </div>
                      </div>
                    </div>
                    
                    
                     
                
                <?php
                $i++;
                }?>
                </div>
                <!--<div class="col-xs-12 col-sm-7 col-md-12" id="proyecto-div_id_<?= $i; ?>" >
		</div>
		<div id="objetivo_row_1-" class="btn btn-default pull-left" value="1" ng-click="addRow()">Agregar</div>
              -->
              <?php }
               else
               {
                echo \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>'','correlativo'=>$i]);    
                $i= 1;
               }
               ?> 
            </div>
            
            <div class="clearfix"><br></div>
            <div class="col-xs-12 col-sm-7 col-md-12" >
            <button type="submit" id="btnguardar" class="btn btn-primary pull-right" >Guardar</button>   
            <button style="" type="button" id="btnobservar" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalobs_">Finalizar</button>
            </div>
	    <div class="clearfix"></div>
	    <div class="col-xs-12 col-sm-7 col-md-12 checkbox text-right" style="">
		<input type="checkbox" name="Proyecto[cerrar_modificacion]" id="proyecto-cerrar_modificacion" class="pull-right"><label><strong>He terminado de realizar mis cambios.</strong></label>
	    </div>
        
    <?php ActiveForm::end(); ?>
    </article>
    
  </section>
  
 </div> 

<?php

    $urlproyectoExiste= Yii::$app->getUrlManager()->createUrl('proyecto/existeproyecto');
    $urlresponsable= Yii::$app->getUrlManager()->createUrl('responsable/guardar');
    $urlDependencia= Yii::$app->getUrlManager()->createUrl('maestros/dependencia');
    $obtenerprovincia = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerprovincia');
    $obtenerdistrito = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerdistrito');
?>


<script type="text/javascript">
 
 $("#btnobservar").hide(); 
    
$(document).ready(function(){
$('.tb_indicador  th:eq(6)').hide();
$('.tb_indicador  td:nth-child(7)').hide();
    
 $('ul.tabs li:nth-child(2)').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });

 $(".collapse").on('show.bs.collapse',function(e){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");


});
 
var msj_incial = verificar_peso_obj();
var mensaje_ind = verificar_peso_inds();

if ((msj_incial != '')||(mensaje_ind != '')) {
   $('#warning').html(msj_incial+mensaje_ind);
   $('#warning').show();
}
else
{
   $('#warning').hide();
}



/*
var inicialdependencia = <?= $proyecto-> id_dependencia_inia;?>;
if (inicialdependencia != '')
{
    var dependencia = $("#proyecto-id_dependencia_inia");
     var unidad = $("#proyecto-id_unidad_ejecutora");
     
     if(unidad.val() != '0')
        {
        $.ajax({
                    url: '<?= $urlDependencia ?>',
                    type: 'GET',
                    async: true,
                    data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        dependencia.find('option').remove();
                        dependencia.append(data);
                        $("#proyecto-id_dependencia_inia option[value="+inicialdependencia+"]").attr('selected','selected');
                        dependencia.prop('disabled', false);
                    }
                });
        }
}
else
{
$("#proyecto-id_dependencia_inia").prop('disabled', true);
}
    
$("#proyecto-id_unidad_ejecutora").change(function(){
    
     var dependencia = $("#proyecto-id_dependencia_inia");
     var unidad = $(this);
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $urlDependencia ?>',
                    type: 'GET',
                    async: true,
                    data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        dependencia.find('option').remove();
                        dependencia.append(data);
                        dependencia.prop('disabled', false);
                    }
                });
        }
        else
        {
            dependencia.find('option').remove();
            dependencia.append('<option value="0">--Seleccione--</option>');
            dependencia.prop('disabled', true);
        }
 });
*/
 
 
 
 
var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;


    //$('#form1').find('input, textarea, button, select').prop('disabled', true);
    //$('.table  th:eq(5)').hide();
    //$('.table  td:nth-child(6)').hide();
    $('.btn_hide').hide(); 
 
 
 //   $('#form1').find('input, textarea, button, select').prop('disabled', true);
 //   $('#form_colaborador').find('input, textarea, button, select').prop('disabled', false);

 
 
 
});



function provincia(valor) {
	
	var departamento = $('#proyecto-departamento');
	var provincia = $('#proyecto-provincia');
	var distrito = $('#proyecto-distrito');
	
     if(departamento.val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerprovincia ?>',
                    type: 'GET',
                    async: true,
                    data: {id:departamento.val()},
                    success: function(data){
                        provincia.find('option').remove();
                        provincia.append(data);
                        provincia.prop('disabled', false);
                        distrito.find('option').remove();
                        distrito.append('<option value="0">--Seleccione--</option>');
                        distrito.prop('disabled', true);
                    }
                });
        }
        else
        {
            provincia.find('option').remove();
            provincia.append('<option value="0">--Seleccione--</option>');
	    provincia.prop('disabled', true);
	    distrito.find('option').remove();
            distrito.append('<option value="0">--Seleccione--</option>');
            distrito.prop('disabled', true);
        }

    }


function distrito(identificador) {
	var provincia = $('#proyecto-provincia');
	var distrito = $('#proyecto-distrito');
	
     if(provincia.val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerdistrito ?>',
                    type: 'GET',
                    async: true,
                    data: {id:provincia.val()},
                    success: function(data){
                        distrito.find('option').remove();
                        distrito.append(data);
                        distrito.prop('disabled', false);
                    }
                });
        }
        else
        {
	    distrito.find('option').remove();
            distrito.append('<option value="0">--Seleccione--</option>');
            distrito.prop('disabled', true);
        }
    }

$("#btnguardar").click(function(event){
	var error='';
        var clasificador = 0;
	var tablas=($('table[name=\'Proyecto[indicadores_tabla][]\']').length);
        
        if($.trim($('#proyecto-objetivo_general').val())=='')
        {
            error=error+'Ingrese Objetivo General <br>';
            $('#proyecto-objetivo_general').addClass('has-error');
            //alert('hola');
        }
        
        for(var t=0;t<tablas;t++) {
            
            if($.trim($('#proyecto-objetivos_descripciones_'+t).val())=='')
        {
            error=error+'Ingrese Objetivo Especifico '+(t+1)+'<br>';
            $('#proyecto-objetivos_descripciones_'+t).addClass('has-error');
            //alert('hola');
        }
        
        if($.trim($('#proyecto-objetivos_peso_'+t).val())=='')
        {
            error=error+'Ingrese el peso del Objetivo '+(t+1)+'<br>';
            $('#proyecto-objetivos_peso_'+t).addClass('has-error');
            //alert('hola');
        }
        
            clasificador= $('#indicadores_tabla_'+t).find('input[name=\'Proyecto[indicadores_descripciones][]\']').length;
            var valor=$('#indicadores_tabla_'+t).find('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray();

            for (var i=0; i<clasificador; i++)
            {
                if(($.trim($('#proyecto-indicadores_descripciones_'+t+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+t+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+t+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_meta_'+t+'_'+(valor[i].value)).val())==''))
                {
                    error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' de la Tabla '+(t+1)+' <br>';
                   // $('.field-proyecto-descripciones_'+i).addClass('has-error');
                }

            }
            
            
            
        }
        
	
	/*var indicadores=($('input[name=\'Proyecto[indicadores_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray());
        
	
	for (var i=0; i<indicadores; i++) {
            if(($.trim($('#proyecto-indicadores_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_programados_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' <br>';
            }

        }*/
	var mensaje = verificar_peso_obj();
	var mensaje_ind = verificar_peso_inds();
	if (error!='') {
	 
	 
            $.notify({
                message: error 
            },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
            });
            return false;
        }
        else
        {
	 
	   if((mensaje!= '') || (mensaje_ind!=''))
	   {
	    $('#warning').html(mensaje+mensaje_ind);
	    $('#warning').show();
	    return false;
	   }
	   else
	   {	    
            return true;
	   }
        }
    });

    
    function verificar_peso_obj()
    {
      var pesos = $('input[name=\'Proyecto[objetivos_peso][]\']').serializeArray();
      var count = $('input[name=\'Proyecto[objetivos_peso][]\']').length;
      var total_peso = 0;
      for(i=0; i<count; i++)
      {
	 total_peso = total_peso + parseInt(pesos[i].value);
      }
      //alert(total_peso);
      if (total_peso != 100)
      {
	 return "<strong>¡Cuidado!</strong> La suma de los pesos de los Objetivos no se encuentran al 100% <br/>";
      }
      else
      {
	 return "";	 
      }
    }
    
    function verificar_peso_inds()
    {
      var rowCount = 0;
      var total = 0;
      var resultado = '';
      var count_tablas=($('table[name=\'Proyecto[indicadores_tabla][]\']').length);
      console.log(count_tablas);
      
      for (var i=0;i<count_tablas;i++)
      {
	 var valor=$('#indicadores_tabla_'+i).find('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray();
	 
	 rowCount= parseInt($('#indicadores_tabla_'+i+' > tbody >tr').length -1);
	 //console.log(rowCount);
	 for (var e=0;e<rowCount;e++) {
	    
	  total = total +  parseInt($('#proyecto-indicadores_pesos_'+i+'_'+(valor[e].value)).val());
	 }
	 
	 if (total != 100){
	    resultado = resultado+"<strong>¡Cuidado!</strong> El peso de los Indicadores del Objetivo "+(i+1)+" no suman 100% <br/>";
	 }
	 
	 total = 0;
      }
      
      return resultado;
    }
    
    
/*$("#btnproyecto").click(function( ) {
    
    var error='';
    if($.trim($('#proyecto-titulo').val())=='')
        {
            error=error+'Ingrese Nombre del Proyecto<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-vigencia').val())=='')
        {
            error=error+'Ingrese la Vigencia del Proyecto<br>';
            $('#proyecto-vigencia').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-id_tipo_proyecto').val())=='0')
        {
            error=error+'Seleccione el Tipo de Investigación<br>';
            $('#proyecto-id_tipo_proyecto').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-departamento').val())=='0' || $.trim($('#proyecto-provincia').val())=='0' || $.trim($('#proyecto-distrito').val())=='0')
        {
            error=error+'Seleccione Ubigeo<br>';
            $('#proyecto-departamento').addClass('has-error');
            $('#proyecto-provincia').addClass('has-error');
            $('#proyecto-distrito').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-id_direccion_linea').val())=='0')
        {
            error=error+'Seleccione la Dirección en Linea<br>';
            $('#proyecto-id_direccion_linea').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-id_unidad_ejecutora').val())=='0')
        {
            error=error+'Seleccione La Unidad Ejecutora<br>';
            $('#proyecto-id_unidad_ejecutora').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-id_dependencia_inia').val())=='0')
        {
            error=error+'Seleccione la Dependencia INIA<br>';
            $('#proyecto-id_dependencia_inia').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-id_programa').val())=='0')
        {
            error=error+'Selecciones el Programa<br>';
            $('#proyecto-id_programa').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-id_cultivo').val())=='0')
        {
            error=error+'Seleccione el Cultivo o Crianza<br>';
            $('#proyecto-id_cultivo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-id_especie').val())=='0')
        {
            error=error+'Seleccione la Especie<br>';
            $('#proyecto-id_especie').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-id_areatematica').val())=='0')
        {
            error=error+'Selecciones la ÁREA Temática<br>';
            $('#proyecto-id_areatematica').addClass('has-error');
            //alert('hola');
        }
    
     
    var colaborador=$('input[name=\'Proyecto[nombresc][]\']').length;
        for (var i=0; i<colaborador; i++) {
            
            if(($('#proyecto-nombresc_'+i).val()=='') || ($('#proyecto-apellidosc_'+i).val()=='') || ($('#proyecto-funcionesc_'+i).val()==''))
            {
                error=error+'Complete todos los Campos del Colaborador #'+(i+1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
        }
     
        
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
        

        

        
        
        
    
    return true;
});
*/


$('#proyecto-cerrar_modificacion').change(function() {
        if($(this).is(":checked")) {
            
	    var ver_peso_obj = verificar_peso_obj();
            var ver_peso_ind = verificar_peso_inds();
            
            
            if ((ver_peso_obj != '') && (ver_peso_ind != '')) {
               $.notify({
                message: ver_peso_obj + ver_peso_ind
                },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
               $(this).attr("checked", false);
            }
            else
            {
               
               var returnVal = confirm("Esta seguro de Finalizar con el Formulario?");
                if (returnVal == true)
                {
                    $("#btnguardar").hide();
		    $("#btnobservar").show();  
		    
                }
                else
                {
                    $(this).attr("checked", false);
                }
            }   
        
            
        }
        else
        {
          $("#btnguardar").show();
	    $("#btnobservar").hide();   
        }
      
    });


</script>

