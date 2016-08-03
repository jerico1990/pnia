
<div >

            <div>
		<div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
		    <h5>Indicadores</h5>
                    <table class="table table-bordered table-hover" id="indicadores_tabla" border="0">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Descripción
                                </th>
				<th class="text-center">
                                    Peso
                                </th>
				<th class="text-center">
                                    Unidad de Medida
                                </th>
				<th class="text-center">
                                    Cant. Programada
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ind=0; ?>
			    <?php if($indicadores){ ?>
				
				<?php foreach($indicadores as $indicador){?>
				    <tr id='indicador_addr_1_<?= $ind ?>'>
					<td>
					<?= ($ind+1) ?>
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_<?= $ind; ?>" value="<?= $ind; ?>" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_<?= $ind ?>  required ">
						<input type="text" id="proyecto-indicadores_descripciones_<?= $ind ?>" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #<?= ($ind+1) ?>" value="<?= $indicador->descripcion ?>" />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_<?= $ind ?>  required">
						<input type="text" id="proyecto-indicadores_pesos_<?= $ind ?>" class="form-control" name="Proyecto[indicadores_pesos][]" placeholder="Peso" value="<?= $indicador->peso ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_<?= $ind ?> required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_<?= $ind ?>" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida " value="<?= $indicador->unidad_medida ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_programados_<?= $ind ?> required">
						<input type="text" id="proyecto-indicadores_programados_<?= $ind ?>" class="form-control" name="Proyecto[indicadores_programados][]" placeholder="Programado" value="<?= $indicador->programado ?>" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[indicadores_ids][]" value="<?= $indicador->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $ind++; ?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='indicador_addr_1_0'>
				    <td>
					<?= ($ind+1) ?>
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_0" value="<?= $ind; ?>" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_0  required ">
						<input type="text" id="proyecto-indicadores_descripciones_0" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #<?= ($ind+1) ?>"  />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_0  required">
						<input type="text" id="proyecto-indicadores_pesos_0" class="form-control" name="Proyecto[indicadores_pesos][]" placeholder="Peso"  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_0 required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_0" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida "  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_programados_0 required">
						<input type="text" id="proyecto-indicadores_programados_0" class="form-control" name="Proyecto[indicadores_programados][]" placeholder="Programado"  />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
					    </span>
					</td>
				</tr>
				<?php $ind=1; ?>
			    <?php } ?>
                            <tr id='indicador_addr_1_<?= $ind ?>'></tr>
                        </tbody>
                    </table>
                    <div id="indicadores_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
		<div id="control_boton">
                <button type="submit" id="btn_indicadores" class="btn btn-primary" >Guardar</button>
        </div>
            </div>

</div>

<?php
    $eliminarindicador= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarindicador');
    $refrescarindicador = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarindicadores');
?>
<script>
    
 var ind = <?= $ind; ?>
 
 $( "#proyecto-id_indicador" ).change(function() {
    
  var id_objetivo = $(this).val();
  $('#indicadores_tabla > tbody > tr').remove();
        
        $.ajax({
                    url: '<?= $refrescarindicador ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id_objetivo},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#indicadores_tabla').append(valor.html);
                       ind = valor.contador;
                       console.log(ind);
                    }
                });
  
  
  
});
 
    $("#indicadores_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminarindicador ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			 valor = jQuery.parseJSON(data);
			estado2 = valor.estado ;
			mensaje = valor.mensaje;

                        
                    }
                });
		
		if (estado2 == 1)
		    {
		    $(this).parent().parent().remove();
		    }
	    }
	    else
	    {
		$(this).parent().parent().remove();
		
		mensaje: "Se elimino el Indicador Correctamente";
	    }
	    
	    $.notify({
					    message: mensaje 
					},{
					    type: 'danger',
					    z_index: 1000000,
					    placement: {
						from: 'top',
						align: 'right'
					    },
					});
	    
	    
        }
	
					
    });
    
    
    $("#indicadores_row_1").click(function(){

        var error = '';
        var clasificador=($('input[name=\'Proyecto[indicadores_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++) {
            if(($.trim($('#proyecto-indicadores_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_programados_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }

        }
	
        if(error!='')
        {
            //var error='ingrese el objetivo #'+i+' <br>';
            //$('.field-proyecto-actividades_descripciones_'+(i-1)).addClass('has-error');
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
            $('#indicador_addr_1_'+ind).html('<td>'+(ind+1)+'<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_'+ind+'" value="'+ind+'" /></td><td class="col-xs-6"><div class="form-group field-proyecto-indicadores_descripciones_'+ind+' required "><input type="text" id="proyecto-indicadores_descripciones_'+ind+'" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #'+(ind+1)+'"  /></div></td><td class="col-xs-1"><div class="form-group field-proyecto-indicadores_pesos_'+ind+'  required"><input type="text" id="proyecto-indicadores_pesos_'+ind+'" class="form-control" name="Proyecto[indicadores_pesos][]" placeholder="Peso"  /></div></td><td><div class="form-group field-proyecto-indicadores_unidad_medidas_'+ind+' required"><input type="text" id="proyecto-indicadores_unidad_medidas_'+ind+'" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida "  /></div></td><td><div class="form-group field-proyecto-indicadores_programados_'+ind+' required"><input type="text" id="proyecto-indicadores_programados_'+ind+'" class="form-control" name="Proyecto[indicadores_programados][]" placeholder="Programado"  /></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
            $('#indicadores_tabla').append('<tr id="indicador_addr_1_'+(ind+1)+'"></tr>');
            ind++;
        }
        
        
        return true;
    });
    
    $("#btn_indicadores").click(function(event){
	var error='';
	var indicadores=($('input[name=\'Proyecto[indicadores_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray());
        
	
	for (var i=0; i<indicadores; i++) {
            if(($.trim($('#proyecto-indicadores_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_programados_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }

        }
	
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
            return true;
        }
    });
    
    /*$("#indicadores").click(function( ) {
	var proyecto_id='<? //$proyecto_id ?>';
	var objetivos=<? //$CountObjetivos ?> ;
	if (proyecto_id=='') {
	    $.notify({
                message: 'No existe proyecto registrado'
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
	if (objetivos==0) {
	    $.notify({
                message: 'No existe objetivos listados'
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
    });*/
    
</script>