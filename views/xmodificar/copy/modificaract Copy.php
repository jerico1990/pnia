<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>

<ul class="tabs">
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Datos Generales</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>" >Financiamiento</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Objetivos e Indicadores</a></li>
    <li><a href="#tab4">Actividades</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Recursos</a></li>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab4">
       <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>  
        <?php if($ver_obj_ind == 0){ ?>
	<div class="alert alert-warning" id="warning">
	    
	    </div>
        <div class="col-xs-12 col-sm-7 col-md-1" >
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
                    <?php  $i++; }
		    
		    ?>    
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
                        //$e = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
				    $array2[] = $indicadores2->id;
                    ?>
                               <option value="<?= $indicadores2->id; ?>" > <?= $indicadores2->descripcion ?></option>;
                    <?php  
				
				}
				//$e++;
			    }
			    
			    ?>  
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div><br/><br/>
        <div class="col-xs-12 col-sm-7 col-md-12" id="form1">
    
        <?= \app\widgets\actividades\ActividadesWidget::widget(['indicador_id'=>$array2[0],'id_proyecto'=>$proyecto->id,'evento'=>$evento]); ?>
        </div>
        <div class="clearfix"><br/>
        <div class="col-xs-12 col-sm-7 col-md-12 checkbox">
            <label><input type="checkbox" name="Proyecto[cerrar_actividad]" id="proyecto-cerrar_actividad" ><strong>Ya no quiero realizar más cambios en el Formulario de Actividades.</strong></label>
        </div>
	<?php }else{?>
	    <div class="alert alert-warning" id="warning">
		<strong>¡Error!</strong> Hay Objetivos sin Indicadores no puede continuar.
	    </div>
	<?php } ?>
    <?php ActiveForm::end(); ?>
    </article>
    
  </section>
  
 </div>        
<?php
  $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
  $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
  $verificar_obj_ind= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_obj_ind');
?>
  <script>
 var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;

 $(document).ready(function(){ 
$('ul.tabs li:nth-child(4)').addClass('active');
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
  
 /*if((situacion_proyecto == 1) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('.table  th:eq(7)').hide();
    $('.table  td:nth-child(8)').hide();
    $('.btn_hide').hide();  
 }*/
 
     $('#proyecto-cerrar_actividad').change(function() {
        if($(this).is(":checked")) {
            var ver_act = verificar_actividades(<?= $proyecto->id; ?>);
            var ver_peso_act = verificar_peso_actividades(<?= $proyecto->id; ?>);
            
            
            if ((ver_act[0] != 0) || (ver_peso_act[0])) {
               $.notify({
                message: ver_act[1]+ver_peso_act[1]
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
                    $("#btn_actividades").html('Guardar y Continuar >>');  
                }
                else
                {
                    $(this).attr("checked", false);
                }
            }   
        
            
        }
        else
        {
          $("#btn_actividades").html('Guardar');    
        }
      
    });
 
 
 });
$("#proyecto-id_objetivo").change(function(){
    
     var indicador = $("#proyecto-id_indicador");
     var objetivo = $(this);
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: false,
                    data: {id:objetivo.val()},
                    success: function(data){
                        indicador.find('option').remove();
                        indicador.append(data);
			
			
			
			var id_indicador = indicador.val();
			$('#actividades_tabla > tbody > tr').remove();
        
			$.ajax({
				    url: '<?= $refrescaractividad ?>',
				    type: 'GET',
				    async: false,
				    data: {id:id_indicador,evento:<?= $evento; ?>},
				    success: function(data){
					var valor = jQuery.parseJSON(data);
					$('#actividades_tabla').append(valor.html);
				       act = valor.contador;
				       console.log(situacion_proyecto);
				       avisos();
				    if((situacion_proyecto == 1) && (evento == 1))
					{
					   $('#form1').find('input, textarea, select').prop('disabled', true);
					   $('.table  th:eq(7)').hide();
					   $('.table  td:nth-child(8)').hide();
					   $('.btn_hide').hide(); 
					}   
				    }
				});
			
			
			
			
                    }
                });
        }
	
ejecutar_numeric();
 });

 $( "#proyecto-id_indicador" ).change(function() {
    
  var id_indicador = $(this).val();
  $('#actividades_tabla > tbody > tr').remove();
        
        $.ajax({
                    url: '<?= $refrescaractividad ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id_indicador,evento:<?= $evento; ?>},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#actividades_tabla').append(valor.html);
                       act = valor.contador;
                       console.log(act);
		       avisos();
		       if((situacion_proyecto == 1) && (evento == 1))
					{
					   $('#actividades_tabla').find('input, textarea, select').prop('disabled', true);
					   $('#actividades_tabla  th:eq(7)').hide();
					   $('#actividades_tabla  td:nth-child(8)').hide();
					   $('.btn_hide').hide(); 
					}
                    }
                });
  
  
  ejecutar_numeric();
});


    
  </script>