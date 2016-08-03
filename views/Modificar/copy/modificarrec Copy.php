<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>

<ul class="tabs">
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Datos Generales</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>" >Financiamiento</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Objetivos e Indicadores</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Actividades</a></li>
    <li><a href="#tab5">Recursos</a></li>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab5">
        <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>  
        <?php
	$ver_act = json_decode($ver_actividad);
	$ver_peso_act = json_decode($ver_peso_actividad);
	$denegado = 0;
	if(($ver_obj_ind == 0) && ($ver_act->estado == 0) && ($ver_peso_act->estado == 0) ){
	   $denegado = 1; 
	    ?>
	<div class="alert alert-danger" id="warning">
	   
	    </div>
        <div class="col-xs-12 col-sm-7 col-md-1" >
	    <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" />
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Obejetivo Especifico:</h5>
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
                        //$i = 0;
                           foreach($actividades as $actividades2)
                            {
                                
				if($actividades2->id_ind == $array2[0])
				{
                    ?>
                               <option value="<?= $actividades2->id; ?>" > <?= $actividades2->descripcion ?></option>;
                    <?php
			    $array[] = $actividades2->id;
			    }
			   // $i++;
			   } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="clearfix"></div><br/><br/>
	<div class="col-xs-12 col-sm-7 col-md-12" id="form1">
        <?= \app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$array[0],'vigencia'=>$proyecto->vigencia,'id_proyecto'=>$proyecto->id,'evento'=>$evento]); ?> 
        
        
        </div>
        <div class="clearfix"><br/>
        <div class="col-xs-12 col-sm-7 col-md-12 checkbox">
            <label><input type="checkbox" name="Proyecto[cerrar_recurso]" id="proyecto-cerrar_recurso" ><strong>Ya no quiero realizar más cambios en el Formulario de Recursos.</strong></label>
        </div>
	<?php }else{   ?>
	    <div class="alert alert-warning" id="warning">
		<?= $ver_act->mensaje.$ver_peso_act->mensaje ?>
		<!--<strong>¡Error!</strong> Verificar los Indicadores y Actividades para continuar.-->
	    </div>
	<?php } ?>
<?php ActiveForm::end(); ?>
    </article>
    
  </section>
  
 </div>       
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
 
 <?php
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
 <?php } ?>
 
 
 
 $('#proyecto-cerrar_recurso').change(function() {
        if($(this).is(":checked")) {
            var ver_saldo = verificar_saldo(<?= $proyecto->id; ?>);
            var ver_recursos = verificar_recursos(<?= $proyecto->id; ?>);
            var ver_prog = verificar_programado(<?= $proyecto->id; ?>);
            
            if ((ver_saldo[0] > 1) || (ver_recursos[0] != 0) || (ver_prog[0] != 0)) {
               $.notify({
                message: ver_saldo[1]+ver_recursos[1]+ver_prog[1]
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
               
               var returnVal = confirm("Esta seguro de cerrar el Formulario?");
                if (returnVal == true)
                {
                    $("#btn_recursos").html('Guardar y Continuar >>');  
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
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: true,
                    data: {id:objetivo.val()},
                    success: function(data){
                        indicador.find('option').remove();
                        indicador.append(data);
			
			
			
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
					       
					       
					       if((situacion_proyecto == 1) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('#btn_grabar').hide();
						   
						   
						}
					    }
				    });
			    
			    
			    }
			    });
			
                    }
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
					       
					       if((situacion_proyecto == 1) && (evento == 1))
						{
						   $('#form1').find('input, textarea, select').prop('disabled', true);
						   $('.table  th:eq(8)').hide();
						   $('.table  td:nth-child(9)').hide();
						   $('#btn_recursos').hide();
						   $('#btn_grabar').hide();
						   
						   
						}
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
 
  </script>