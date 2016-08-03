<br/><br/>
<div class="clearfix"></div>
<div class="col-xs-12 col-sm-7 col-md-2"></div>
<div class="col-xs-12 col-sm-7 col-md-4"><label >Total Aporte INIA: <strong> S/. <?= $aportante->total ?></strong></label></div>
<div class="clearfix"></div><br/><br/>
<div class="col-xs-12 col-sm-7 col-md-12" >

            <div>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-7 col-md-1">
		</div>
                <div class="col-xs-12 col-sm-7 col-md-10">
                    <table class="table table-bordered table-hover" id="desembolsos_tabla" border="0">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Desmbolso
                                </th>
                                <th class="text-center">
                                    Mes
                                </th>
				<th class="text-center">
                                    Año
                                </th>
				<th class="text-center">
                                    Monto
                                </th>
				<th class="text-center">
                                    %
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $des=0; ?>
			    <?php if($desembolsos){ ?>
				
				<?php foreach($desembolsos as $desembolso){?>
				    <tr id='desembolsos_addr_<?= $des ?>'>
					<td>
                                            <div class="form-group field-aportante-desembolsos_nro_<?= $des ?>  required ">
						
						<select id="aportante-desembolsos_nro_<?= $des ?>" class="form-control " name="Aportante[desembolsos_nro][]">
							    <?php

								   foreach($nro_desembolso as $nro_desembolso2)
								    {?>
									<option value="<?= $nro_desembolso2->id; ?>" <?=($nro_desembolso2->id == $desembolso->nro_desembolso)?'selected':'' ?> > <?= $nro_desembolso2->descripcion ?></option>
							    <?php    } ?>
						</select>	    
						</div>
					<input type="hidden" name="Aportante[desembolsos_numero][]" id="aportante-desembolsos_numero_<?= $des; ?>" value="<?= $des; ?>" />
                                        </td>

					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_mes_<?= $des ?>  required ">
						
						<select id="aportante-desembolsos_mes_<?= $des ?>" class="form-control " name="Aportante[desembolsos_mes][]">
							    <?php

								   foreach($meses as $mes)
								    {?>
									<option value="<?= $mes->id; ?>" <?=($mes->id == $desembolso->mes)?'selected':'' ?> > <?= $mes->descripcion ?></option>
							    <?php    } ?>
						</select>
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_anio_<?= $des ?>  required">
						<input type="text" id="aportante-desembolsos_anio_<?= $des ?>" class="form-control entero" name="Aportante[desembolsos_anio][]" placeholder="" value="<?= $desembolso->anio ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-aportante-desembolsos_montos_<?= $des ?> required">
						<input type="text" id="aportante-desembolsos_monto_<?= $des ?>" class="form-control decimal" name="Aportante[desembolsos_monto][]" placeholder="" value="<?= $desembolso->monto ?>" Disabled>
						<input type="hidden" id="aportante-desembolsos_montos_<?= $des ?>" class="form-control decimal" name="Aportante[desembolsos_montos][]" placeholder="" value="<?= $desembolso->monto ?>" >
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-aportante-desembolsos_porcentaje_<?= $des ?> required">
						<input onkeyup="calcularMonto(<?= $des ?>)" type="text" id="aportante-desembolsos_porcentaje_<?= $des ?>" class="form-control entero" name="Aportante[desembolsos_porcentaje][]" placeholder="" value="<?= $desembolso->porcentaje ?>" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Aportante[desembolsos_ids][]" value="<?= $desembolso->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $des++; ?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='desembolsos_addr_0'>
				    <td>
					<div class="form-group field-aportante-desembolsos_nro_0 required ">
						<select id="aportante-desembolsos_nro_0" class="form-control " name="Aportante[desembolsos_nro][]">
							    <?php

								   foreach($nro_desembolso as $nro_desembolso2)
								    {?>
									<option value="<?= $nro_desembolso2->id; ?>"  > <?= $nro_desembolso2->descripcion ?></option>
							    <?php    } ?>
						</select>
					    </div>
					<input type="hidden" name="Aportante[desembolsos_numero][]" id="aportante-desembolsos_numero_0" value="<?= $des; ?>" />
					</td>

					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_mes_0  required ">
						<select id="aportante-desembolsos_mes_0" class="form-control " name="Aportante[desembolsos_mes][]">
							    <?php

								   foreach($meses as $mes)
								    {?>
									<option value="<?= $mes->id; ?>" > <?= $mes->descripcion ?></option>
							    <?php    } ?>
						</select>
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_anio_0  required">
						<input type="text" id="aportante-desembolsos_anio_0" class="form-control entero" name="Aportante[desembolsos_anio][]" placeholder=""  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-aportante-desembolsos_montos_0 required">
						<input type="text" id="aportante-desembolsos_monto_0" class="form-control decimal" name="Aportante[desembolsos_monto][]" placeholder=""  Disabled>
						<input type="hidden" id="aportante-desembolsos_montos_0" class="form-control decimal" name="Aportante[desembolsos_montos][]" placeholder=""  >
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-aportante-desembolsos_porcentaje_0 required">
						<input onkeyup="calcularMonto(0)" type="text" id="aportante-desembolsos_porcentaje_0" class="form-control entero" name="Aportante[desembolsos_porcentaje][]" placeholder=""  />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
					    </span>
					</td>
				</tr>
				<?php $des=1; ?>
			    <?php } ?>
                            <tr id='desembolsos_addr_<?= $des ?>'></tr>
                        </tbody>
                    </table>
                    <div id="desembolsos_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
		<div class="col-xs-12 col-sm-7 col-md-1">
		</div>
                <div class="clearfix"></div>
		<div id="control_boton">
                <button type="submit" id="btn_desembolsos" class="btn btn-primary" >Guardar</button>
        </div>
            </div>

</div>

<?php
    $eliminardesembolso= Yii::$app->getUrlManager()->createUrl('aportante/eliminardesembolso');
?>
<script>
 
 var contar_des = <?= $des ?>   
 var total_proyecto = <?= $aportante->total ?>
 
 
 function calcularMonto(posicion)
 {
    var porcentaje = parseInt(getNum($('#aportante-desembolsos_porcentaje_'+posicion).val()));
    var monto = total_proyecto * (porcentaje / 100);
    $('#aportante-desembolsos_monto_'+posicion).val(monto.toFixed(2));
 }
 
 
    $("#desembolsos_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminardesembolso ?>',
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
		
		mensaje = "Se elimino el Desembolso Correctamente";
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
    
    
    $("#desembolsos_row_1").click(function(){

        var error = '';
        var countdesembolso=($('select[name=\'Aportante[desembolsos_nro][]\']').length);
        var valor=($('input[name=\'Aportante[desembolsos_numero][]\']').serializeArray());
	
        for (var i=0; i<countdesembolso; i++) {
            if(($.trim($('#aportante-desembolsos_nro_'+(valor[i].value)).val())=='0') || ($.trim($('#aportante-desembolsos_mes_'+(valor[i].value)).val())=='0') || ($.trim($('#aportante-desembolsos_anio_'+(valor[i].value)).val())=='') || ($.trim($('#aportante-desembolsos_monto_'+(valor[i].value)).val())=='') || ($.trim($('#aportante-desembolsos_porcentaje_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Desembolso #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-aportante-descripciones_'+i).addClass('has-error');
            }
        }
	

	
        if(error!='')
        {
            //var error='ingrese el objetivo #'+i+' <br>';
            //$('.field-aportante-actividades_descripciones_'+(i-1)).addClass('has-error');
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
            $('#desembolsos_addr_'+contar_des).html('<td><div class="form-group field-aportante-desembolsos_nro_'+contar_des+' required "><select id="aportante-desembolsos_nro_'+contar_des+'" class="form-control " name="Aportante[desembolsos_nro][]"> <?php foreach($nro_desembolso as $nro_desembolso2) {?> <option value="<?= $nro_desembolso2->id; ?>"  > <?= $nro_desembolso2->descripcion ?></option> <?php    } ?> </select></div><input type="hidden" name="Aportante[desembolsos_numero][]" id="aportante-desembolsos_numero_'+contar_des+'" value="'+contar_des+'" /></td><td class="col-xs-2"><div class="form-group field-aportante-desembolsos_mes_'+contar_des+'" ><select id="aportante-desembolsos_mes_'+contar_des+'" class="form-control " name="Aportante[desembolsos_mes][]"> <?php foreach($meses as $mes) {?> <option value="<?= $mes->id; ?>" > <?= $mes->descripcion ?></option> <?php    } ?> </select></div></td><td class="col-xs-2"><div class="form-group field-aportante-desembolsos_anio_'+contar_des+'  required"><input type="text" id="aportante-desembolsos_anio_'+contar_des+'" class="form-control entero" name="Aportante[desembolsos_anio][]" placeholder=""  /></div></td><td><div class="form-group field-aportante-desembolsos_montos_'+contar_des+' required"><input type="text" id="aportante-desembolsos_monto_'+contar_des+'" class="form-control decimal" name="Aportante[desembolsos_monto][]" placeholder=""  Disabled><input type="hidden" id="aportante-desembolsos_montos_'+contar_des+'" class="form-control decimal" name="Aportante[desembolsos_montos][]" placeholder=""  ></div></td><td class="col-xs-1"> <div class="form-group field-aportante-desembolsos_porcentaje_'+contar_des+' required"><input onkeyup="calcularMonto('+contar_des+')" type="text" id="aportante-desembolsos_porcentaje_'+contar_des+'" class="form-control entero" name="Aportante[desembolsos_porcentaje][]" placeholder=""  /></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
            $('#desembolsos_tabla').append('<tr id="desembolsos_addr_'+(contar_des+1)+'"></tr>');
	    contar_des++;
        }
        
        
        return true;
    });
    
    $("#btn_desembolsos").click(function(event){
	var error = '';
	var pasar_monto = 0;
	var total_porcentaje = 0;
        var countdesembolso=($('select[name=\'Aportante[desembolsos_nro][]\']').length);
        var valor=($('input[name=\'Aportante[desembolsos_numero][]\']').serializeArray());
	
        for (var i=0; i<countdesembolso; i++) {
            if(($.trim($('#aportante-desembolsos_nro_'+(valor[i].value)).val())=='0') || ($.trim($('#aportante-desembolsos_mes_'+(valor[i].value)).val())=='0') || ($.trim($('#aportante-desembolsos_anio_'+(valor[i].value)).val())=='') || ($.trim($('#aportante-desembolsos_monto_'+(valor[i].value)).val())=='') || ($.trim($('#aportante-desembolsos_porcentaje_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos del Desembolso #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-aportante-descripciones_'+i).addClass('has-error');
            }
	    else
	    {
	     pasar_monto = $('#aportante-desembolsos_monto_'+(valor[i].value)).val();
	     $('#aportante-desembolsos_montos_'+(valor[i].value)).val(pasar_monto);
	     pasar_monto = 0;
	     
	    total_porcentaje += parseInt(getNum($('#aportante-desembolsos_porcentaje_'+(valor[i].value)).val()));	
	    }
	    
	    console.log($('#aportante-desembolsos_montos_'+(valor[i].value)).val());
        }
	console.log(total_porcentaje);
	if (total_porcentaje != 100) {
		error = error+"El Desembolso no se encuentra programado al 100%";
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
    
    /*$("#desembolsos").click(function( ) {
	var aportante_id='<? //$aportante_id ?>';
	var objetivos=<? //$CountObjetivos ?> ;
	if (aportante_id=='') {
	    $.notify({
                message: 'No existe aportante registrado'
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