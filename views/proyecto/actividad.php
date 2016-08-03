<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>
<?php $evento3 = 1; if($indicadores){?>
<div>

      <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div>
                
            <h3><strong>    Mi Proyecto | </strong><span style=" font-size: medium">Actividades</span></h3>
            
            </div>
        <?php if($ver_obj_ind == 0){ ?>
	<div class="alert alert-warning" id="warning">
	    
	    </div>
        <div class="col-xs-12 col-sm-7 col-md-1" >
	    
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
                               <option value="<?= $objetivoespecifico->id; ?>" <?= ($objetivoespecifico->id == $flat_ob_esp)?'Selected':'' ?>> <?= $objetivoespecifico->descripcion ?></option>;
                    <?php  $i++; }
		    echo '<script>
    console.log('.json_encode($array1).');</script>';
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
				    if($flat_ind == '')
				    {
				    $array2[] = $indicadores2->id;
				    }
				    else
				    {
				      $array2[]  = $flat_ind;
				    }
                    ?>
                               <option value="<?= $indicadores2->id; ?>" <?= ($indicadores2->id == $flat_ind)?'Selected':'' ?>> <?= $indicadores2->descripcion ?></option>;
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
	<?php
		
		  if($proyecto->situacion == 2)
		  {
		     $evento3 = 2;
		  }
	
	?>
        <?= \app\widgets\actividades\ActividadesWidget::widget(['indicador_id'=>$array2[0],'id_proyecto'=>$proyecto->id,'evento'=>$evento3]); ?>
        </div>
	<div class="clearfix"></div><br/><br/>
	<?php }else{?>
	    <div class="alert alert-warning" id="warning">
		Por favor registrar los Indicadores antes de Ingresar a esta Opción.
	    </div>
	<?php } ?>
         <?php ActiveForm::end(); ?>
   
 </div>
<?php } else { ?>
<div class="clearfix"></div><br/><br/><br/>
<div class="alert alert-warning" id="warning">
   Por favor registrar los Indicadores antes de Ingresar a esta Opción.	    
</div>
<?php } ?>
<?php
  $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
  $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
  $verificar_obj_ind= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_obj_ind');
?>
  <script>
 var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;
var evento3 = <?= $evento3; ?>;
 $(document).ready(function(){ 

 if((situacion_proyecto > 0) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    
    if (evento3 == 2) {
    $('.table  th:eq(7)').hide();
    $('.table  td:nth-child(8)').hide();
      
    }
    else{
    $('.table  th:eq(6)').hide();
    $('.table  td:nth-child(7)').hide();
    }
    $('.btn_hide').hide();  
 }
 

 
 });
$("#proyecto-id_objetivo").change(function(){
    
     var indicador = $("#proyecto-id_indicador");
     var objetivo = $(this);
     var val = null;
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: false,
                    data: {id:objetivo.val()},
                    success: function(data){
                        val = jQuery.parseJSON(data);
			
                        indicador.find('option').remove();
                        indicador.append(val.option);
			
			
			
			var id_indicador = indicador.val();
			$('#actividades_tabla > tbody > tr').remove();
        
			$.ajax({
				    url: '<?= $refrescaractividad ?>',
				    type: 'GET',
				    async: false,
				    data: {id:id_indicador,evento:<?= $evento3; ?>},
				    success: function(data){
					var valor = jQuery.parseJSON(data);
					$('#actividades_tabla').append(valor.html);
				       act = valor.contador;
				       console.log(situacion_proyecto);
				       avisos2();
				       
				    if((situacion_proyecto > 0) && (evento == 1))
					{
					   $('#actividades_tabla').find('input, textarea, select').prop('disabled', true);
					   if (evento3 == 2) {
					    $('.table  th:eq(7)').hide();
					    $('.table  td:nth-child(8)').hide();
					      
					    }
					    else{
					    $('.table  th:eq(6)').hide();
					    $('.table  td:nth-child(7)').hide();
					    }
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
                    data: {id:id_indicador,evento:<?= $evento3; ?>},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#actividades_tabla').append(valor.html);
                       act = valor.contador;
                       console.log(act);
		       avisos2();
		       if((situacion_proyecto > 0) && (evento == 1))
					{
					   $('#actividades_tabla').find('input, textarea, select').prop('disabled', true);
					   if (evento3 == 2) {
					    $('.table  th:eq(7)').hide();
					    $('.table  td:nth-child(8)').hide();
					      
					    }
					    else{
					    $('.table  th:eq(6)').hide();
					    $('.table  td:nth-child(7)').hide();
					    }
					   $('.btn_hide').hide(); 
					}
                    }
                });
  
  
  ejecutar_numeric();
});


    
  </script>