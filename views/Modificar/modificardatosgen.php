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




<div id="form1">
    
<div class="alert alert-danger" id="warning">
	   
</div>
<ul class="tabs">
    <li><a href="#tab1">Datos Generales</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/modificarfinanciamiento?id='.$proyecto->id.'&event='.$evento.'') ?>" >Financiamiento</a></li>
    <!--<li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Objetivos e Indicadores</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Actividades</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Recursos</a></li>-->
    <?php if($observaciones > 0){ ?>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/observaciones?id='.$proyecto->id.'&event='.$evento.'') ?>" >Observaciones</a></li>
    <?php } ?>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab1">
    <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
    <?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'Proyecto','titulo'=>'Descripcion de la Modificación:','tipo'=>'0']); ?> 
            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-titulo required">
                  <?php  if($id == 0)
                    { ?>
                        <input type="hidden" value="<?= $id; ?>" id="proyecto-id" name="Proyecto[id]" />
                   <?php }
                     else
                    {?>
                        <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" />
                  <?php  }?>
                
                <label for="proyecto-titulo">Título del Proyecto:</label>
                <input class="form-control" type="text" value="<?= $proyecto->titulo?>" placeholder="Nombre del Proyecto" id="proyecto-titulo" name="Proyecto[titulo]"  required/> <!-- required-->
                </div>
             
                
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-vigencia required">
                <label for="proyecto-vigencia">Vigencia (En Meses):</label>
                <input class="form-control entero" type="text" id="proyecto-vigencia" value="<?= $proyecto->vigencia?>" placeholder="Vigencia del Proyecto en Meses" name="Proyecto[vigencia]"  required/> <!-- required-->
                </div>    
            </div>
            
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_tipo_proyecto required">
                    <label for="proyecto-id_tipo_proyecto">Invetigación:</label>
                <select class="form-control" id="proyecto-id_tipo_proyecto" name="Proyecto[id_tipo_proyecto]" >
                    <option value="0">--Seleccione--</option>
                    <?php                    
                           foreach($tipoInv as $tipoInvs)
                            {
                    ?>
                               <option value="<?= $tipoInvs->id; ?>" <?=($tipoInvs->id == $proyecto->id_tipo_proyecto)?'selected':'' ?> > <?= $tipoInvs->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_direccion_linea required">
                <label for="proyecto-id_direccion_linea">Dirección en Linea:</label>
                <select  class="form-control" id="proyecto-id_direccion_linea" name="Proyecto[id_direccion_linea]" >
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoDireccion = Maestros::find()
                                ->where('id_padre = 21 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoDireccion as $tipoDireccion2)
                            {
                    ?>
                               <option value="<?= $tipoDireccion2->id; ?>" <?=($tipoDireccion2->id == $proyecto->id_direccion_linea)?'selected':'' ?> required> <?= $tipoDireccion2->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
             </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_unidad_ejecutora required">
                <label for="proyecto-id_unidad_ejecutora">Unidad Ejecutora:</label>
                <select class="form-control" id="proyecto-id_unidad_ejecutora" name="Proyecto[id_unidad_ejecutora]" >
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoUnidadEj = Maestros::find()
                                ->where('id_padre = 25 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoUnidadEj as $tipoUnidadEj2)
                            {
                    ?>
                               <option value="<?= $tipoUnidadEj2->id; ?>" <?=($tipoUnidadEj2->id == $proyecto->id_unidad_ejecutora)?'selected':'' ?> required> <?= $tipoUnidadEj2->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_dependencia_inia required">
                <label for="proyecto-id_dependencia_inia">Dependencia del INIA :</label>
                <select class="form-control" name="Proyecto[id_dependencia_inia]" id="proyecto-id_dependencia_inia" >
                    <option value="0">--Seleccione--</option>

                </select>
                
            </div>    
            </div>

            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-departamento required">
                <label for="proyecto-departamento">Departamento:</label>
                <select class="form-control" onchange="provincia(1)" id="proyecto-departamento" name="Proyecto[departamento][]"  >
                                                <option value="0">--Departamento--</option>
                                                <?php
                                                       foreach($departamentos as $departamentos2)
                                                        {
                                                ?>
                                                           <option value="<?= $departamentos2->department_id; ?>" <?=($departamentos2->department_id == substr($proyecto->ubigeo,0,2))?'selected':'' ?> > <?= $departamentos2->department ?></option>
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-provincia required">
                    <label for="proyecto-provincia">Provincia:</label>
                    <select class="form-control" onchange="distrito(1)" id="proyecto-provincia" name="Proyecto[provincia]" >
                                                <option value="0">--Provincia--</option>
                    <?php
                    if ($proyecto->ubigeo) {
                        
                        foreach($provincias as $provincias2)
                        {
                            echo '<option value="'.$provincias2->province_id.'" '.($provincias2->province_id == substr($proyecto->ubigeo,0,4) ? 'selected="selected"' : '' ).'> '.$provincias2->province .'</option>';
                        }
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-distrito required">
                    <label for="proyecto-distrito">Distrito:</label>
                    <select class="form-control" id="proyecto-distrito" name="Proyecto[distrito]" >
                                                <option value="0">--Distrito--</option>
                    <?php
                    if ($proyecto->ubigeo) {
                        
                        foreach($distritos as $distritos2)
                        {
                            echo '<option value="'.$distritos2->district_id.'" '.($distritos2->district_id == $proyecto->ubigeo ? 'selected="selected"' : '' ).'> '.$distritos2->district .'</option>';
                        }
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_programa required">
                    <label for="proyecto-id_programa">Programa:</label>
                    <select onchange="cultivo(1)" class="form-control" id="proyecto-id_programa" name="Proyecto[id_programa]" >
                                                <option value="0">--Programa--</option>
                    <?php
                    $prog = null;
                    if ($proyecto->ubigeo) {
                        
                        foreach($programa as $programa2)
                        {
                            echo '<option value="'.$programa2->id.'" '.($programa2->id == $proyecto->id_programa ? 'selected="selected"' : '' ).'> '.$programa2->descripcion .'</option>';
                            if($programa2->id == $proyecto->id_programa)
                            {
                                $prog = $programa2->id;
                            }
                        }
                       
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            <!--<div class="col-xs-12 col-sm-7 col-md-4" >
            <div class="form-group field-proyecto-id_cultivo required">
            <label for="proyecto-id_cultivo">Cultivo o Crianza:</label>
            <div class="multiselect" id="multiselect">
                 <?php
                   if($prog){
                    $maestro = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$prog])
                                ->orderBy('orden')
                                ->all();

                           foreach($maestro as $maestros)
                            {
                ?>
                                <b <?php foreach($cultivo as $cul){ ?> <?=($maestros->id == $cul->tipo)?'class="multiselect-on"':'' ?> <?php }?> ><input type="checkbox" id="proyecto-id_cultivo" name="Proyecto[id_cultivo][]" value="<?= $maestros->id; ?>" <?php foreach($cultivo as $cul){ ?> <?=($maestros->id == $cul->tipo)?'checked':'' ?> <?php }?>> <?= $maestros->descripcion ?></b><br/>
                    <?php   } }?>
                      
                        
                    
                 
                    
                </div>
            
            </div>
            </div>-->
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_cultivo required">
                    
                 
                <label for="proyecto-id_cultivo">Cultivo o Crianza:</label>
                <select onchange="especie(1)" class="form-control" id="proyecto-id_cultivo" name="Proyecto[id_cultivo]" >
                 <option value="0">--Seleccione--</option>   
                 <?php
                    $cul = null;
                    $maestro = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$prog])
                                ->orderBy('orden')
                                ->all();

                           foreach($maestro as $maestros)
                            {
                ?>
                                <option value="<?= $maestros->id; ?>" <?=($maestros->id == $proyecto->id_cultivo)?'selected':'' ?> > <?= $maestros->descripcion ?></option>;
                                
                                
                    
                    <?php
                                if($maestros->id == $proyecto->id_cultivo)
                                    {
                                        $cul = $maestros->id;
                                    }    
                    } ?>
                      
                        
                    
                 
                    
                </select>   
                    
                            
                </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_especie required">
                    
                 
                <label for="proyecto-id_especie">Especie:</label>
                <select class="form-control" id="proyecto-id_especie" name="Proyecto[id_especie]" >
                 <option value="0">--Seleccione--</option>   
                 <?php
                 
                    if($cul)
                    {
                    $especie = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$cul])
                                ->orderBy('orden')
                                ->all();

                           foreach($especie as $especie2)
                            {
                ?>
                                <option value="<?= $especie2->id; ?>" <?=($especie2->id == $proyecto->id_especie)?'selected':'' ?> > <?= $especie2->descripcion ?></option>;
                    
                                
                    <?php   } } ?>
                      
                        
                    
                 
                    
                </select>   
                    
                            
                </div>    
            </div>
            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-id_areatematica required">
                <label for="proyecto-id_areatematica">Programa Transversal:</label>
                <select class="form-control" id="proyecto-id_areatematica" name="Proyecto[id_areatematica]" >
                    <option value="0">--Seleccione--</option>
                <?php
                 
                    $accionTrans = Maestros::find()
                                ->where('id_padre = 10 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($accionTrans as $accionTransv)
                            {
                ?>
                                <option value="<?= $accionTransv->id; ?>" <?=($accionTransv->id == $proyecto->id_areatematica)?'selected':'' ?> > <?= $accionTransv->descripcion ?></option>;
                    <?php    } ?>

                 
                </select>
                </div></div>
            <div class="col-xs-12 col-sm-7 col-md-12" id="div_colaboradores" >
                <?= \app\widgets\colaboradores\ColaboradoresWidget::widget(['id'=>$proyecto->id]); ?>   
            </div>
            <div class="clearfix"></div>
            <br/>
            <br/>

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
    $ver_aportes = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_colaborador_aporte');
?>


<script type="text/javascript">
    $("#btnobservar").hide(); 
$(document).ready(function(){
$(".multiselect").multiselect();
avisos_dg(<?= $proyecto->id; ?>);
    
$('ul.tabs li:nth-child(1)').addClass('active');
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
                        //dependencia.prop('disabled', false);
                    }
                });
        }
}
else
{
$("#proyecto-id_dependencia_inia").prop('disabled', true);
}
    
var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;


    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('#colaboradores_tabla  th:eq(4)').hide();
    $('#colaboradores_tabla  td:nth-child(5)').hide();
    $('#div_colaboradores').find('input, textarea,button, select').prop('disabled', false);
    $('#proyecto-id').prop('disabled', false);
    $('#proyecto-observacion').prop('disabled', false);
     $('#proyecto-cerrar_modificacion').prop('disabled', false);
    
    //$('#btnproyecto').hide();
    //$('#colcaborador_row_2').hide(); 

 
 //   $('#form1').find('input, textarea, button, select').prop('disabled', true);
 //   $('#form_colaborador').find('input, textarea, button, select').prop('disabled', false);
});


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


$("#btnguardar").click(function( ) {
    
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
    
    var objetivo1=$('input[name=\'Proyecto[aportante_numero][]\']').length;
    var valor=($('input[name=\'Proyecto[aportante_numero][]\']').serializeArray());

        for (var i=0; i<objetivo1; i++) {
            if(($('#proyecto-aportante_colaborador_'+(valor[i].value)).val()==''))
            {
                error=error+'Complete todos los Campos del Colaborador #'+(parseInt(valor[i].value)+1)+' <br/>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
        }
     
   /* var colaborador=$('input[name=\'Proyecto[nombresc][]\']').length;
        for (var i=0; i<colaborador; i++) {
            
            if(($('#proyecto-nombresc_'+i).val()=='') || ($('#proyecto-apellidosc_'+i).val()=='') || ($('#proyecto-funcionesc_'+i).val()==''))
            {
                error=error+'Complete todos los Campos del Colaborador #'+(i+1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
        }*/
    /*if($.trim($('#proyecto-resumen_ejecutivo').val())=='')
        {
            error=error+'Ingrese el Resumen Ejecutivo<br>';
            $('#proyecto-resumen_ejecutivo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-relevancia').val())=='')
        {
            error=error+'Ingrese La Relevancia del Proyecto<br>';
            $('#proyecto-relevancia').addClass('has-error');
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
        
        
        
    jsShowWindowLoad('Procesando nueva Modificación...');
    return true;
});


function avisos_dg(id)
{
  var ver_aportes = verificar_aportes(id,"<?= $ver_aportes; ?>");
  if(ver_aportes[0] != 0){
    
	$('#warning').html(ver_aportes[1]);
	$('#warning').show();
    }
    else
    {
	$('#warning').hide();
    }

}

$('#proyecto-cerrar_modificacion').change(function() {
        if($(this).is(":checked")) {
            
            var ver_aportes = verificar_aportes(<?= $proyecto->id; ?>,"<?= $ver_aportes; ?>");
            
            
            if ((ver_aportes[0] != 0)) {
               $.notify({
                message: ver_aportes[1]
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

