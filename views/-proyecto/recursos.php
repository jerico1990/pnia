<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>

<div >

	<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div>
                
            <h3><strong>    Mi Proyecto | </strong><span style=" font-size: medium">Recursos</span></h3>
            
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
                        $i = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
                    ?>
                               <option value="<?= $indicadores2->id; ?>" > <?= $indicadores2->descripcion ?></option>;
                    <?php  $array2[$i] = $indicadores2->id;
		    
				}
				$i++;
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
			    $array[$i] = $actividades2->id;
			    }
			    $i++; } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="clearfix"></div><br/><br/>
	<div class="col-xs-12 col-sm-7 col-md-12" >
        <?= \app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$array[0]]); ?> 
        
        
        </div>
  
 <?php ActiveForm::end(); ?>
</div>      
  <?php
    $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
    $obteneractividad = Yii::$app->getUrlManager()->createUrl('proyecto/obteneractividad');
    $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
    $refrescarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarrecursos');
    
?>
  
  <script>

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
					    data: {id:id_actividad},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#recurso_tabla').append(valor.html);
					       re = valor.contador;
					       console.log(re);
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
					    data: {id:id_actividad},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#recurso_tabla').append(valor.html);
					       re = valor.contador;
					       console.log(re);
					    }
				    });
			    
			    
			    }
			    });
			
        }
 });


 
  </script>