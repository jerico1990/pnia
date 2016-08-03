<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>

<style>
   .accordion-toggle:hover {
      text-decoration: none;
    } 
    
</style>

<ul class="tabs">
    <li><a href="#tab5" >Recursos</a></li>
    <?php if($observaciones > 0){ ?>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/observaciones?id='.$proyecto->id.'&event='.$evento.'') ?>" >Observaciones</a></li>
    <?php } ?>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab5">
        <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
	<?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'Proyecto','titulo'=>'Descripcion de la Modificación:','tipo'=>'0']); ?> 
        <?php
	$ver_act = json_decode($ver_actividad);
	$ver_peso_act = json_decode($ver_peso_actividad);
	$ver_co_apor = json_decode($ver_co_aporte);
	//var_dump($ver_act->estado);die;
	$denegado = 0;
	if(($ver_obj_ind == 0) && ($ver_act->estado == 0) && ($ver_co_apor->estado == 0) ){
	   $denegado = 1; 
	    ?>
	<div class="alert alert-danger" id="warning">
	   
	    </div>
        <div class="col-xs-12 col-sm-7 col-md-1" >
	    <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" /> 
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Objetivo Especifico:</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control" name="Proyecto[id_objetivo]" id="proyecto-id_objetivo">
		<?php
                        $array1 = [];
                        $i = 0;
                           foreach($objetivosespecificos as $objetivoespecifico)
                            {
                                if($flat_ob_esp == '')
				{
                                $array1[$i] = $objetivoespecifico->id;
				}
				else
				{
				  $array1[$i]  = $flat_ob_esp;
				}
                    ?>
                               <option value="<?= $objetivoespecifico->id; ?>" <?= ($objetivoespecifico->id == $flat_ob_esp)?'Selected':'' ?>> <?= $objetivoespecifico->descripcion ?></option>
                    <?php  $i++; } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Indicador:</h5>
                
            <select class="form-control" name="Proyecto[id_indicador]" id="proyecto-id_indicador">
		<?php
                        $array2 = [];
                       // $i = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
				    if($flat_ind == '')
				    {
				    $array2[] = $indicadores2->id;
				    }
				    else
				    {
				      $array2[]  = $flat_ind;
				    }
                    ?>
                               <option value="<?= $indicadores2->id; ?>" <?= ($indicadores2->id == $flat_ind)?'Selected':'' ?>> <?= $indicadores2->descripcion ?></option>
                    <?php  //$array2[] = $indicadores2->id;
		    
				}
				//$i++;
			    } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div><br/><br/>
        
	<div class="col-xs-12 col-sm-7 col-md-12"  id="form_act" >
                <label>Actividades:</label>
                <div class="panel-group" id="accordion">
               <?php
	       $array =[];
               $i = 0;
               if($actividades)
               {
		  /*$evento3 = 1;
		  if($proyecto->situacion == 2)
		  {
		     $evento3 = 2;
		  }*/
		  
                foreach($actividades as $actividades2)
                {
                    if($actividades2->id_ind == $array2[0])
		    {
			$array[] = $actividades2->id;
			
                ?>
                  <div class="panel panel-primary">
                      <div class="panel-heading" style="height: 45px;padding:5px">
                        <div id="divactividad" >
		<?php //if($objetivoespecifico) {?>
                <div class="col-xs-12 col-sm-9 col-md-12" id="proyecto-div_id_<?= $i; ?>" >
		    <input type="hidden" value="<?= $actividades2->id?>" id="proyecto-id_actividad_<?= $i; ?>" name="Proyecto[id_actividad][]" />
		    <input type="hidden" value="<?= $actividades2->descripcion;?>" id="proyecto-act_descripcion_<?= $i; ?>" name="Proyecto[act_descripcion]" /> 
		    <!--<div class="col-md-1" >
			<?= ($i+1); ?>
		    </div>-->
		    <div class="col-md-1" >
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i; ?>" aria-expanded="true">
			     <span style="color:black" class="glyphicon glyphicon-minus"></span>
			</a>
			</div>
		    <div class="col-xs-10 col-sm-10 col-md-9" >
			<div class="form-group field-proyecto-objetivos_descripciones_<?= $i; ?> required">
			    <label for="proyecto-obj_descripcion_<?= $i; ?>"><?= $actividades2->descripcion;?></label>
			</div> 
		    </div>
		    <div class="col-xs-12 col-sm-9 col-md-2" >
			<div class="form-group field-proyecto-objetivos_peso_<?= $i; ?> required">
			    
			</div>    
		    </div>
                    
                    <br>
                </div>
		
		<?php // } else {?>
		
		<?php //} ?>
                <div class="clearfix"></div>
	    </div>

                      </div>
                      <div id="collapse<?= $i; ?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?= \app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$actividades2->id,'vigencia'=>$proyecto->vigencia,'id_proyecto'=>$proyecto->id,'evento'=>$evento,'correlativo'=>$i]); ?> 
                        </div>
                      </div>
                  </div>
		  
                    
                    
                     
                
                <?php
		
		
                $i++;
		    }}
		    
		    
		    ?>
                
                <!--<div class="col-xs-12 col-sm-7 col-md-12" id="proyecto-div_id_<?= $i; ?>" >
		</div>
		<div id="objetivo_row_1-" class="btn btn-default pull-left" value="1" ng-click="addRow()">Agregar</div>
              -->
              <?php }
               else
               {
                //echo \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>'','correlativo'=>$i]);    
                //$i= 1;
               }
               ?> 
            </div>
            </div>
            
        <div class="clearfix"></div><br/>

	<?php if($proyecto->situacion == 0) {?>
	<div class="clearfix"><br/>
	    <div class="col-xs-12 col-sm-7 col-md-12">
	    <button type="submit" id="btnguardar" class="btn btn-primary pull-right" >Guardar</button>   
            <button style="" type="button" id="btnobservar" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalobs_">Finalizar</button>
	    </div>
	<div class="col-xs-12 col-sm-7 col-md-12 checkbox">
            <label><input type="checkbox" name="Proyecto[cerrar_recurso]" id="proyecto-cerrar_recurso" ><strong>Doy por completo el registro de mi proyecto y Autorizo su revisión.</strong></label>
        </div>
	<?php } }else{   ?>
	    <div class="alert alert-warning" id="warning">
		<?= $ver_act->mensaje.$ver_peso_act->mensaje.$ver_co_apor->mensaje ?>
		<!--<strong>¡Error!</strong> Verificar los Indicadores y Actividades para continuar.-->
	    </div>
	<?php } ?>
	<div class="clearfix"></div><br/><br/><br/>
 <?php ActiveForm::end(); ?>
    </article>
    
  </section>
  
 </div>       
  <?php
    $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
    $obteneractividad = Yii::$app->getUrlManager()->createUrl('proyecto/obteneractividad');
    $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
    $refrescarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarrecursos');
    $verificar_programado = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_programado');
    $verf_presupuesto = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_presupuesto');
    
?>
  
<script>

var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;

 $(document).ready(function(){
    
$(".collapse").on('show.bs.collapse',function(e){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});
    
$('ul.tabs li:nth-child(5)').addClass('active');
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
  
 if((situacion_proyecto == 1) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('.table  th:eq(8)').hide();
    $('.table  td:nth-child(9)').hide();
    $('#btn_recursos').hide();
    $('#btn_grabar').hide();
    
    
 }
 
 if(evento == 2)
 {
    $('#btn_recursos').hide();
    $('#btnobservar').hide();
 }
 
 <?php
 
    if($actividades){
	if($denegado == 1)
	{
	$valor = json_decode($ver_monto_total);
	$valor_recursos = json_decode($ver_recursos);
	
    ?>
    var ver_prog = verificar_programado(<?= $proyecto->id; ?>,"<?= $verificar_programado ?>");
    var estado_monto = <?= $valor->estado; ?>;
    var mensaje_monto = "<?= $valor->mensaje; ?>";
    var estado_recurso = <?= $valor_recursos->estado; ?>;
    var mensaje_recurso = "<?= $valor_recursos->mensaje; ?>";
 
 if ((estado_monto > 1) || (estado_recurso > 0) || (ver_prog[0] != 0)) {
	   $('#warning').html(mensaje_monto+mensaje_recurso+ver_prog[1]);
	   $('#warning').show();
	}
	else
	{
	   $('#warning').hide();
	}
 <?php }
 
    }?>
 
 
 $('#proyecto-cerrar_recurso').change(function() {
        if($(this).is(":checked")) {
            var ver_saldo = verificar_saldo(<?= $proyecto->id; ?>);
            var ver_recursos = verificar_recursos(<?= $proyecto->id; ?>);
            var ver_prog = verificar_programado(<?= $proyecto->id; ?>,"<?= $verificar_programado ?>");
	    var ver_act = verificar_actividades(<?= $proyecto->id; ?>);
	    var ver_peso_act = verificar_peso_actividades(<?= $proyecto->id; ?>);
            
            if ((ver_saldo[0] > 1) || (ver_recursos[0] != 0) || (ver_prog[0] != 0) || (ver_act[0] != 0) || (ver_peso_act[0] != 0)) {
               $.notify({
                message: ver_saldo[1]+ver_recursos[1]+ver_prog[1]+ver_act[1]+ver_peso_act[1]
                },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
            });
               $(this).attr("checked", false);
            }
            else
            {
               
               var returnVal = confirm("Esta seguro de dar por concluido el registro del Proyecto?");
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
 
    
    var counttablas =($('table[name=\'Proyecto[recurso_tabla][]\']').length);
 
 for (var x=0;x<counttablas;x++)
 {
    re[x] = $('#recurso_tabla_'+x).find('input[name=\'Proyecto[recurso_descripcion][]\']').length;
 }
 console.log(re);
 
 });
 
 
 $("#btnguardar").click(function(event){
        
        jsShowWindowLoad('Procesando...');	
	var error='';
	var tablas=($('table[name=\'Proyecto[recurso_tabla][]\']').length);
        
        //console.log(valor);
        //console.log('-'+clasificador);
        //alert(clasificador);
        for (var e=0; e<tablas; e++)
	{
	  var clasificador= $('#recurso_tabla_'+e).find('input[name=\'Proyecto[recurso_descripcion][]\']').length;  
	    var valor=$('#recurso_tabla_'+e).find('input[name=\'Proyecto[recurso_numero][]\']').serializeArray();
	for (var i=0; i<clasificador; i++) {
            
         
           // console.log(valor[i].value);
            if(($('#proyecto-recurso_clasificador_'+e+'_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_descripcion_'+e+'_'+(valor[i].value)).val())=='') || ($('#proyecto-recurso_fuente_'+e+'_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_unidad_'+e+'_'+(valor[i].value)).val())=='') )
            {
                error=error+'Complete todos los Campos de la Actividad '+(e + 1)+' del Recurso #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }

	  
        }
	
	}
	
	if (error!='') {
	    jsRemoveWindowLoad();
            $.notify({
                message: error 
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
        else
        {
           
            return true;
        }
    });
 
  $("#proyecto-id_objetivo").change(function(){
    
     var indicador = $("#proyecto-id_indicador");
     var actividad = $("#proyecto-id_actividad");
     var objetivo = $(this);
     var val = null;
     
	indicador.show();
	//actividad.show();
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: true,
                    data: {id:objetivo.val()},
                    success: function(data){
			
			
			 val = jQuery.parseJSON(data);
			
                        indicador.find('option').remove();
                        indicador.append(val.option);
			
			
			
			var id_indicador = indicador.val();
			
			   /* $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:id_indicador},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
				$('#recurso_tabla > tbody > tr').remove();*/
				$.ajax({
					    url: '<?= $refrescarrecurso ?>',
					    type: 'GET',
					    async: true,
					    data: {id:id_indicador,id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#form_act').find('div').remove();
						$('#form_act').append(valor.html);
					       re = valor.contador;
					       //console.log(re);
					       
					       
					       if((situacion_proyecto > 0) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
					    moneda_recurso();
					    
					    $(".collapse").on('show.bs.collapse',function(e){
					    $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
					    }).on('hidden.bs.collapse', function(){
					    $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
					    });
					    
					    moneda_soles(".soles");
					    re = [];
					    
					    var counttablas =($('table[name=\'Proyecto[recurso_tabla][]\']').length);
 
					    for (var x=0;x<counttablas;x++)
					    {
					       re[x] = $('#recurso_tabla_'+x).find('input[name=\'Proyecto[recurso_descripcion][]\']').length;
					    }
					    console.log(re);
					    
					    $('.decimal').numeric({ decimalPlaces: 2 });
					    }
				    });
			    
			    
			    /*}
			    });*/
			    
			if (val.estado == 1)
			{
			    indicador.hide();
			    //actividad.hide();
			}
			
                    }//
                });
        }
 });


$("#proyecto-id_indicador").change(function(){
    
     var actividad = $("#proyecto-id_actividad");
     var indicador = $(this);
     
     if($(this).val() != '0')
        {
        
			
			    /*$.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:indicador.val()},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
				$('#recurso_tabla > tbody > tr').remove();*/
				
				$.ajax({
					    url: '<?= $refrescarrecurso ?>',
					    type: 'GET',
					    async: true,
					    data: {id:indicador.val(),id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#form_act').find('div').remove();
						$('#form_act').append(valor.html);
					       re = valor.contador;
					      // console.log(re);
					       
					       if((situacion_proyecto > 0) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
						moneda_recurso();
						
						$(".collapse").on('show.bs.collapse',function(e){
					    $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
					    }).on('hidden.bs.collapse', function(){
					    $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
					    });
						moneda_soles(".soles");
						
						re = [];
					    
					    var counttablas =($('table[name=\'Proyecto[recurso_tabla][]\']').length);
 
					    for (var x=0;x<counttablas;x++)
					    {
					       re[x] = $('#recurso_tabla_'+x).find('input[name=\'Proyecto[recurso_descripcion][]\']').length;
					    }
					    console.log(re);
					    
					    $('.decimal').numeric({ decimalPlaces: 2 });
						
						
					    }
				    });
			    
			    
			    /*}
			    });*/
			
        }
 });

$( "#proyecto-id_actividad" ).change(function() {
    
  var id_actividad = $(this).val();
  $('#recurso_tabla > tbody > tr').remove();
        
        $.ajax({
                    url: '<?= $refrescarrecurso ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id_actividad,id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#recurso_tabla').append(valor.html);
                       re = valor.contador;
                       console.log(re);
		       
		       
		       if((situacion_proyecto == 1) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
                    }
                });
  
  
  
});

function monto_presupuesto(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verf_presupuesto ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
		        array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   return array
}


function agregarind(ntabla,ntr,act){
 //$("#recurso_row_1").click(function(){
	
	var error = '';
	var clasificador= $('#recurso_tabla_'+ntabla).find('input[name=\'Proyecto[recurso_descripcion][]\']').length;
	var valor=$('#recurso_tabla_'+ntabla).find('input[name=\'Proyecto[recurso_numero][]\']').serializeArray();
        
        for (var i=0; i<clasificador; i++) {
            if(($('#proyecto-recurso_clasificador_'+ntabla+'_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_descripcion_'+ntabla+'_'+(valor[i].value)).val())=='') || ($('#proyecto-recurso_fuente_'+ntabla+'_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_unidad_'+ntabla+'_'+(valor[i].value)).val())=='') )
            {
                error=error+'Complete todos los Campos de la Actividad '+(ntabla + 1)+' del Recurso #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
        }
       
	/*var clasificador = $('#proyecto-recurso_clasificador_'+(re-1));
	var descripcion = $('#proyecto-recurso_descripcion_'+(re-1));
	var unidad = $('#proyecto-recurso_unidad_'+(re-1));
	var cantidad = $('#proyecto-recurso_cantidad_'+(re-1));
        var precioun = $('#proyecto-recurso_precioun_'+(re-1));
	
       
        if(clasificador.val()=='0')
        {
            error += "Ingrese Clasificador Nro "+re+" <br>";
	    $('.field-proyecto-recurso_clasificador_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_clasificador_'+(re-1)).removeClass('has-error');
	}
	
	if($.trim(descripcion.val())=='')
        {
            error += "Ingrese Detalle Nro "+re+" <br>";
	    $('.field-proyecto-recurso_descripcion_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_descripcion_'+(re-1)).removeClass('has-error');
	}
	
	if($.trim(unidad.val())=='')
        {
            error += "Ingrese la Unidad de Medida Nro "+re+" <br>";
	    $('.field-proyecto-recurso_unidad_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_unidad_'+(re-1)).removeClass('has-error');
	}
        
        if($.trim(cantidad.val())=='')
        {
            error += "Ingrese la Cantidad Nro "+re+" <br>";
	    $('.field-proyecto-recurso_cantidad_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_cantidad_'+(re-1)).removeClass('has-error');
	}
        
        if($.trim(precioun.val())=='')
        {
            error += "Ingrese el Precio Unitario Nro "+re+" <br>";
	    $('.field-proyecto-recurso_precioun_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_precioun_'+(re-1)).removeClass('has-error');
	}*/
	
	if (error != '') {
	    
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
            $('#recurso_addr_'+ntabla+'_'+re[ntabla]).html('<td>'+(re[ntabla]+1)+'<input type="hidden" name="Proyecto[recurso_act_ids][]" id="proyecto-recurso_act_ids_'+re[ntabla]+'" value="'+act+'" /><input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_'+ntabla+'_'+re[ntabla]+'" value="'+re[ntabla]+'" /></td><td class="col-xs-2" ><div class="form-group field-proyecto-recurso_clasificador_'+ntabla+'_'+re[ntabla]+' required"><select  class="form-control " id="proyecto-recurso_clasificador_'+ntabla+'_'+re[ntabla]+'" name="Proyecto[recurso_clasificador][]" ><option value="0">--Clasificador--</option><?php foreach($clasificador as $clasificador2) { ?> <option value="<?= $clasificador2->id; ?>" > <?= $clasificador2->descripcion ?></option>; <?php   } ?></select></div></td><td class="col-xs-3"  ><div class="form-group field-proyecto-recurso_descripcion_'+ntabla+'_'+re[ntabla]+' required"><input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_descripcion_'+ntabla+'_'+re[ntabla]+'" maxlength="2980" name="Proyecto[recurso_descripcion][]"/></div></td><td><div class="form-group field-proyecto-recurso_fuente_'+ntabla+'_'+re[ntabla]+' required"> <select  class="form-control " id="proyecto-recurso_fuente_'+ntabla+'_'+re[ntabla]+'" name="Proyecto[recurso_fuente][]" > <option value="0">--Fuente--</option> <?php foreach($fuentes as $fuentes2){ ?> <option value="<?= $fuentes2->id; ?>" > <?= $fuentes2->colaborador ?></option>; <?php   } ?></select></div></td><td class="col-xs-2"><div class="form-group field-proyecto-recurso_unidad_'+ntabla+'_'+re[ntabla]+' required"><input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_unidad_'+ntabla+'_'+re[ntabla]+'" name="Proyecto[recurso_unidad][]"/></div></td><td class="col-xs-1"><div class="form-group field-proyecto-recurso_cantidad_'+ntabla+'_'+re[ntabla]+' required"><input  class="form-control " class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_'+ntabla+'_'+re[ntabla]+'" name="Proyecto[recurso_cantidad][]" Disabled></div></td><?php if($evento == 2){ ?> <td class="col-xs-1">  <div class="form-group field-proyecto-recurso_ejecutado_'+ntabla+'_'+re[ntabla]+' required"> <input type="text" id="proyecto-recurso_ejecutado_'+ntabla+'_'+re[ntabla]+'" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder=""  Disabled>  </div> </td> <?php } ?><td><div class="form-group field-proyecto-recurso_preciototal_'+ntabla+'_'+re[ntabla]+' required"><input class="form-control " class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_'+ntabla+'_'+re[ntabla]+'" name="Proyecto[recurso_preciototal][]" Disabled></div></td><td><div><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#programado_'+ntabla+'_'+re[ntabla]+'_" id="btn_programado" onclick="cargartitulos('+re[ntabla]+')">Detalle</button></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign" onclick="eliminarind('+ntabla+','+re[ntabla]+')" id="eliminar_'+ntabla+'_'+re[ntabla]+'"></span></td>');
            $('#recurso_tabla_'+ntabla).append('<tr id="recurso_addr_'+ntabla+'_'+(re[ntabla]+1)+'"></tr>');
            re[ntabla] = (re[ntabla]+1);
	    moneda_recurso();
        return true;
    
        }
        
 
 }   
 
  </script>