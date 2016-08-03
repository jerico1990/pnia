

<?php if($gestion == 0){ ?>
            
		<div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table borderless table-hover tb_indicador" name="Proyecto[indicadores_tabla][]" id="indicadores_tabla_<?= $correlativo; ?>" border="0">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Indicador
                                </th>
				<th class="text-center">
                                    Peso
                                </th>
				<th class="text-center">
                                    Unidad de Medida
                                </th>
				<th class="text-center">
                                    Meta
                                </th>
				<?php if($event == 2){ ?>
				<th class="text-center">
                                    Ejecutado
                                </th>
				<?php } ?>
                                <th>
                                </th>
                            </tr>
                        </thead>
		    
                        <tbody>
                            <?php $ind=0; ?>
			    <?php if($indicadores){ ?>
				
				<?php foreach($indicadores as $indicador){?>
				    <tr id='indicador_addr_<?= $correlativo; ?>_<?= $ind ?>'>
					<td>
					<?= ($ind+1) ?>
	    
					<input type="hidden" name="Proyecto[indicadores_oe_ids][]" id="proyecto-indicadores_oe_ids_<?= $ind; ?>" value="<?= $objetivosind; ?>" />
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_<?= $ind; ?>" value="<?= $ind; ?>" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_<?= $correlativo; ?>_<?= $ind ?>  required ">
						<!--<input type="text" id="proyecto-indicadores_descripciones_<?= $correlativo; ?>_<?= $ind ?>" maxlength="1980" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #<?= ($ind+1) ?>" value="<?= $indicador->descripcion ?>" />-->
						<textarea rows="2" id="proyecto-indicadores_descripciones_<?= $correlativo; ?>_<?= $ind ?>" maxlength="1980" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #<?= ($ind+1) ?>"><?= $indicador->descripcion ?></textarea>   
					</div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_<?= $correlativo; ?>_<?= $ind ?>  required">
						<input type="text" id="proyecto-indicadores_pesos_<?= $correlativo; ?>_<?= $ind ?>" class="form-control entero text-center" maxlength="3" name="Proyecto[indicadores_pesos][]" placeholder="Peso" value="<?= $indicador->peso ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_<?= $correlativo; ?>_<?= $ind ?> required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_<?= $correlativo; ?>_<?= $ind ?>" class="form-control" maxlength="190" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida " value="<?= $indicador->unidad_medida ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_meta_<?= $correlativo; ?>_<?= $ind ?> required">
						<input type="text" <?php if($event == 2){ ?> onkeyup="ver_meta_ind(<?= $correlativo; ?>,<?= $ind ?>)" <?php } ?> id="proyecto-indicadores_meta_<?= $correlativo; ?>_<?= $ind ?>" maxlength="30" class="form-control entero text-center" name="Proyecto[indicadores_meta][]" placeholder="Meta" value="<?= $indicador->meta ?>" />
					    </div>
					</td>
					<?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_ejecutado_<?= $correlativo; ?>_<?= $ind ?> required">
						<input  type="text" id="proyecto-indicadores_ejecutado_<?= $correlativo; ?>_<?= $ind ?>" maxlength="30" class="form-control entero text-center" name="Proyecto[indicadores_ejecutado][]" placeholder="" value="<?= $indicador->ejecutado ?>" Disabled>
					    </div>
					    </td>
					<?php } ?>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign" onclick="eliminarind(<?= $correlativo; ?>,<?= $ind ?>)">
						<input type="hidden" id="indicadores_ids_<?= $correlativo; ?>_<?= $ind ?>" name="Proyecto[indicadores_ids][]" value="<?= $indicador->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $ind++; ?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='indicador_addr_<?= $correlativo; ?>_0'>
				    <td>
					<?= ($ind+1) ?>
					<input type="hidden" name="Proyecto[indicadores_oe_ids][]" id="proyecto-indicadores_oe_ids_<?= $ind; ?>" value="<?= $objetivosind; ?>" />
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_0" value="<?= $ind; ?>" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_<?= $correlativo; ?>_0  required ">
						<input type="text" id="proyecto-indicadores_descripciones_<?= $correlativo; ?>_0" maxlength="1980" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #<?= ($ind+1) ?>"  />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_<?= $correlativo; ?>_0  required">
						<input type="text" id="proyecto-indicadores_pesos_<?= $correlativo; ?>_0" maxlength="3" class="form-control entero text-center" name="Proyecto[indicadores_pesos][]" placeholder="Peso"  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_<?= $correlativo; ?>_0 required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_<?= $correlativo; ?>_0" maxlength="190" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida "  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_meta_<?= $correlativo; ?>_0 required">
						<input type="text" id="proyecto-indicadores_meta_<?= $correlativo; ?>_0" class="form-control entero text-center" maxlength="30" name="Proyecto[indicadores_meta][]" placeholder="Meta"  />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign" onclick="eliminarind(<?= $correlativo; ?>,<?= $ind ?>)">
					    <input type="hidden" id="indicadores_ids_<?= $correlativo; ?>_0" name="Proyecto[indicadores_ids][]" value="" />
					    </span>
					</td>
				</tr>
				<?php $ind=1; ?>
			    <?php } ?>
                            <tr id='indicador_addr_<?= $correlativo; ?>_<?= $ind ?>'></tr>
                        </tbody>
                    </table>
                    <div id="indicadores_row_1" onclick="agregarind(<?= $correlativo; ?>,<?= $ind ?>,<?= $objetivosind; ?>)" class="btn btn-default pull-left btn_hide" value="1">Agregar</div>
                    <br/>
                </div>
                <div class="clearfix"></div><br/><br/>
		<!--<div id="control_boton">
                <button type="submit" id="btn_indicadores" class="btn btn-primary" >Guardar</button>
		</div>
            </div>-->
<?php } else { ?>
<div class="clearfix"></div>
<div class="col-xs-12" ></div>
<?php }?>


<?php
    $eliminarindicador= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarindicador');
    $refrescarindicador = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarindicadores');
?>
<script>
    
 var ind = [];
 $(document).ready(function(){
    
 var counttablas =($('table[name=\'Proyecto[indicadores_tabla][]\']').length);
 
 for (var x=0;x<counttablas;x++)
 {
    ind[x] = $('#indicadores_tabla_'+x).find('input[name=\'Proyecto[indicadores_descripciones][]\']').length;
 }
 console.log(ind);
 
 });
 
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
 
 /*   $("#indicadores_tabla").on('click','.eliminar',function(){
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
	
					
    });*/
    
    function eliminarind(ntabla,ntr)
    {
	
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
        if (r == true)
	{
            id= $('#indicadores_tabla_'+ntabla).find('#indicadores_ids_'+ntabla+'_'+ntr).val();
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
		$('#indicador_addr_'+ntabla+'_'+ntr).remove();
		//$('#indicadores_tabla_'+ntabla).children().eq(ntr).remove();
		  //  $(this).parent().parent().remove();
		   }
	    }
	    else
	    {
		//alert("llego vacio");
		
		//$(this).parent().parent().remove();
		$('#indicador_addr_'+ntabla+'_'+ntr).remove();
		mensaje = "Se elimino el Indicador Correctamente";
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
    }
    
    
    
 function agregarind(ntabla,ntr,obj){  

	

	var clasificador= $('#indicadores_tabla_'+ntabla).find('input[name=\'Proyecto[indicadores_descripciones][]\']').length;
       // ind[ntabla] = clasificador;
	var error = '';
        var valor=$('#indicadores_tabla_'+ntabla).find('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray();

        for (var i=0; i<clasificador; i++) {
            if(($.trim($('#proyecto-indicadores_descripciones_'+ntabla+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+ntabla+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+ntabla+'_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_meta_'+ntabla+'_'+(valor[i].value)).val())==''))
	    {
                error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' <br>';

            }

        }
	
        if(error!='')
        {
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
            $('#indicador_addr_'+ntabla+'_'+ind[ntabla]).html('<td>'+(ind[ntabla]+1)+'<input type="hidden" name="Proyecto[indicadores_oe_ids][]" id="proyecto-indicadores_oe_ids_'+ind[ntabla]+'" value="'+obj+'" /><input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_'+ind[ntabla]+'" value="'+ind[ntabla]+'" /></td><td class="col-xs-6"><div class="form-group field-proyecto-indicadores_descripciones_'+ntabla+'_'+ind[ntabla]+' required "><input type="text" maxlength="1980" id="proyecto-indicadores_descripciones_'+ntabla+'_'+ind[ntabla]+'" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #'+(ind[ntabla]+1)+'"  /></div></td><td class="col-xs-1"><div class="form-group field-proyecto-indicadores_pesos_'+ntabla+'_'+ind[ntabla]+'  required"><input type="text" maxlength="3" id="proyecto-indicadores_pesos_'+ntabla+'_'+ind[ntabla]+'" class="form-control text-center" name="Proyecto[indicadores_pesos][]" placeholder="Peso"  /></div></td><td><div class="form-group field-proyecto-indicadores_unidad_medidas_'+ntabla+'_'+ind[ntabla]+' required"><input type="text" maxlength="190" id="proyecto-indicadores_unidad_medidas_'+ntabla+'_'+ind[ntabla]+'" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida "  /></div></td><td><div class="form-group field-proyecto-indicadores_meta_'+ntabla+'_'+ind[ntabla]+' required"><input type="text" id="proyecto-indicadores_meta_'+ntabla+'_'+ind[ntabla]+'" class="form-control text-center" maxlength="30" name="Proyecto[indicadores_meta][]" placeholder="Meta"  /></div></td><td><span onclick="eliminarind('+ntabla+','+ind[ntabla]+')" class="eliminar glyphicon glyphicon-minus-sign"><input type="hidden" id="indicadores_ids_'+ntabla+'_'+ind[ntabla]+'" name="Proyecto[indicadores_ids][]" value="" /></span></td>');
            //$('#indicador_addr_'+ntabla+'_'+ind).html('<td>'+(ind+1)+'<input type="hidden" name="Proyecto[indicadores_oe_ids][]" id="proyecto-indicadores_oe_ids_'+ind+'" value="'+obj+'" /><input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_'+ind+'" value="'+ind+'" /></td><td class="col-xs-6"></td><td class="col-xs-1"></td><td></td><td></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
	    $('#indicadores_tabla_'+ntabla).append('<tr id="indicador_addr_'+ntabla+'_'+(ind[ntabla]+1)+'"></tr>');
	    ind[ntabla] = (ind[ntabla] +1);
        }
        
        
        return true;
  
 }
    
    $("#btn_indicadores").click(function(event){
	var error='';
	var tablas=($('table[name=\'Proyecto[indicadores_tabla][]\']').length);
	//alert(tablas);
	
	/*var indicadores=($('input[name=\'Proyecto[indicadores_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[indicadores_numero][]\']').serializeArray());
        
	
	for (var i=0; i<indicadores; i++) {
            if(($.trim($('#proyecto-indicadores_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-indicadores_programados_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Indicador #'+((parseInt(valor[i].value)) + 1)+' <br>';
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
        }*/
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
    
    
    function ver_meta_ind(a,b)
    {
      var meta = $("#proyecto-indicadores_meta_"+a+"_"+b);
      var ejecutado = $("#proyecto-indicadores_ejecutado_"+a+"_"+b);
      if (ejecutado.val() > 0) {
	 
	 if (meta.val() < ejecutado.val()) {
	    
	    meta.val('');
	    $.notify({
                message: "La Meta no puede ser Menor que ek ejecutado" 
            },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
            });
	    
	    
	 }
	 
	 
      }
    }
    
</script>