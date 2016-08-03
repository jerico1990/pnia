<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>
<?php if($actividades){?>
<div >

	<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div>
                
            <h3><strong>    Mi Proyecto | </strong><span style=" font-size: medium">Recursos</span></h3>
            
            </div>
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
                                $array1[$i] = $objetivoespecifico->id;
                    ?>
                               <option value="<?= $objetivoespecifico->id; ?>" > <?= $objetivoespecifico->descripcion ?></option>;
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
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control" name="Proyecto[id_indicador]" id="proyecto-id_indicador">
		<?php
                        $array2 = [];
                       // $i = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
                    ?>
                               <option value="<?= $indicadores2->id; ?>" > <?= $indicadores2->descripcion ?></option>;
                    <?php  $array2[] = $indicadores2->id;
		    
				}
				//$i++;
			    } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div>
        
        <div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
	    <h5>Actividad:</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control" name="Proyecto[id_actividad]" id="proyecto-id_actividad">
		<?php
                        $array = [];
                        $i = 0;
			
                           foreach($actividades as $actividades2)
                            {
                                
				if($actividades2->id_ind == $array2[0])
				{
                    ?>
                               <option value="<?= $actividades2->id; ?>" > <?= $actividades2->descripcion ?></option>;
                    <?php
			    $array[] = $actividades2->id;
			    $i++;
			    }
			   // $i++;
			   }
			   if($i == 0)
			   {$array[] = '';}
			   
			   ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="clearfix"></div><br/><br/>
	<div class="col-xs-12 col-sm-7 col-md-12" id="form1">
        <?= \app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$array[0],'vigencia'=>$proyecto->vigencia,'id_proyecto'=>$proyecto->id,'evento'=>$evento]); ?> 
        
        
        </div>
	<?php if($proyecto->situacion == 0) {?>
	<div class="clearfix"><br/>
        <div class="col-xs-12 col-sm-7 col-md-12 checkbox">
            <label><input type="checkbox" name="Proyecto[cerrar_recurso]" id="proyecto-cerrar_recurso" ><strong>Doy por completo el registro de mi proyecto y Autorizo su revisión.</strong></label>
        </div>
	<?php } }else{   ?>
	    <div class="alert alert-warning" id="warning">
		<?= $ver_act->mensaje.$ver_peso_act->mensaje.$ver_co_apor->mensaje ?>
		<!--<strong>¡Error!</strong> Verificar los Indicadores y Actividades para continuar.-->
	    </div>
	<?php } ?>
 <?php ActiveForm::end(); ?>
</div>
<?php } else { ?>
<div class="clearfix"></div><br/><br/><br/>
<div class="alert alert-warning" id="warning">
   Por favor registrar las Actividades antes de Ingresar a esta Opción.		    
</div>
<?php } ?>
  <?php
    $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
    $obteneractividad = Yii::$app->getUrlManager()->createUrl('proyecto/obteneractividad');
    $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
    $refrescarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarrecursos');
    $verf_presupuesto = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_presupuesto');
    
?>
  
<script>

var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;

 $(document).ready(function(){ 

 if((situacion_proyecto > 0) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('.table  th:eq(8)').hide();
    $('.table  td:nth-child(9)').hide();
    $('#btn_recursos').hide();
    $('.btn_hide').hide();
    
    
 }
 
 <?php
 
    if($actividades){
	if($denegado == 1)
	{
	$valor = json_decode($ver_monto_total);
	$valor_recursos = json_decode($ver_recursos);
	
    ?>
    var ver_prog = verificar_programado(<?= $proyecto->id; ?>);
    var estado_monto = <?= $valor->estado; ?>;
    var mensaje_monto = "<?= $valor->mensaje; ?>";
    var estado_recurso = "<?= $valor_recursos->estado; ?>";
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
            var ver_prog = verificar_programado(<?= $proyecto->id; ?>);
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
                    $("#btn_recursos").html('Finalizar');  
                }
                else
                {
                    $(this).attr("checked", false);
                }
            }   
        
            
        }
        else
        {
          $("#btn_recursos").html('Guardar');    
        }
      
    });
 
 
 
 });
 
  $("#proyecto-id_objetivo").change(function(){
    
     var indicador = $("#proyecto-id_indicador");
     var actividad = $("#proyecto-id_actividad");
     var objetivo = $(this);
     var val = null;
     
	indicador.show();
	actividad.show();
     
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
			
			    $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:id_indicador},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
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
					       
					       
					       if((situacion_proyecto > 0) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
					    moneda_recurso();
					    }
				    });
			    
			    
			    }
			    });
			    
			if (val.estado == 1)
			{
			    indicador.hide();
			    actividad.hide();
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
        
			
			    $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:indicador.val()},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
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
					       
					       if((situacion_proyecto > 0) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
						moneda_recurso();
					    }
				    });
			    
			    
			    }
			    });
			
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
		       
		       
		       if((situacion_proyecto > 0) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('.btn_hide').hide();
						   
						   
						}
			moneda_recurso();
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
 
  </script>