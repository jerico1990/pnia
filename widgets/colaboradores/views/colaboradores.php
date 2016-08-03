<!--<a href="#" data-toggle="modal" data-target="#colaboradores" id="proyecto-colaboradores" >
        Lista de Colaboradores
</a>

<div class="modal fade bs-example-modal-lg" id="colaboradores" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Colaboradores</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>-->
		<div class="clearfix"></br></div>
                <div class="col-xs-12 col-sm-7 col-md-12" id="form_colaborador">
                    <table class="table table-bordered table-hover" id="colaboradores_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Colaborador
                                </th>
                                <th class="text-center">
                                    Regimen
                                </th>
                                <th class="text-center">
                                    Tipo
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $co=0; ?>
			    <?php if($colaborador){ ?>
				
				<?php foreach($colaborador as $colaborador2){?>
				    <?php //if($objetivo->id==$proyecto->objetivo_especifico_1_id){ ?>
				    <tr id='colaborador_addr_1_<?= $co ?>'>
					<td>
					<?= ($co+1) ?>
					<input type="hidden" name="Proyecto[aportante_numero][]" id="proyecto-aportante_numero_<?= $co; ?>" value="<?= $co; ?>" />
					</td>
					<td class="col-xs-5">
					    <div class="form-group field-proyecto-aportante_colaborador_<?= $co ?> required">
						<input type="text" id="proyecto-aportante_colaborador_<?= $co ?>" class="form-control" name="Proyecto[aportante_colaborador][]" placeholder="" value="<?= $colaborador2->colaborador ?>" />
					    </div>
					</td>
                                        <td>
					<div class="form-group field-proyecto-aportante_regimen_<?= $co ?> required">
					    <select id="proyecto-aportante_regimen_<?= $co ?>" class="form-control " name="Proyecto[aportante_regimen][]">
							    <?php

								   foreach($regimen as $regimen2)
								    {?>
									<option value="<?= $regimen2->id; ?>" <?=($regimen2->id == $colaborador2->regimen)?'selected':'' ?> > <?= $regimen2->descripcion ?></option>
							    <?php    } ?>
						</select>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-aportante_tipo_inst_<?= $co ?> required">
					    <select id="proyecto-aportante_tipo_inst_<?= $co ?>" class="form-control " name="Proyecto[aportante_tipo_inst][]">
							    <?php

								   foreach($tipo_inst as $tipo_inst2)
								    {?>
									<option value="<?= $tipo_inst2->id; ?>" <?=($tipo_inst2->id == $colaborador2->tipo_inst)?'selected':'' ?> > <?= $tipo_inst2->descripcion ?></option>
							    <?php    } ?>
						</select>
					</div>
				    </td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[colaboradores_ids][]" value="<?= $colaborador2->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $co++; ?>
				    <?php //}?>
				<?php } ?>
			    <?php }else{ ?>
				<!--<tr id='colaborador_addr_1_0'>
				    <td>
				    <?= ($co+1) ?>
				    <input type="hidden" name="Proyecto[aportante_numero][]" id="proyecto-aportante_numero_0" value="0" />
				    </td>
				    <td class="col-xs-5">
					<div class="form-group field-proyecto-aportante_colaborador_0 required">
					    <input type="text" id="proyecto-aportante_colaborador_0" class="form-control" name="Proyecto[aportante_colaborador][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-aportante_regimen_0 required">
					    <select id="proyecto-aportante_regimen_0" class="form-control " name="Proyecto[aportante_regimen][]">
							    <?php

								   foreach($regimen as $regimen2)
								    {?>
									<option value="<?= $regimen2->id; ?>" > <?= $regimen2->descripcion ?></option>
							    <?php    } ?>
						</select>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-aportante_tipo_inst_0 required">
					    <select id="proyecto-aportante_tipo_inst_0" class="form-control " name="Proyecto[aportante_tipo_inst][]">
							    <?php

								   foreach($tipo_inst as $tipo_inst2)
								    {?>
									<option value="<?= $tipo_inst2->id; ?>" > <?= $tipo_inst2->descripcion ?></option>
							    <?php    } ?>
						</select>
					</div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>-->
				<?php //$co=1; ?>
			    <?php } ?>
                            <tr id='colaborador_addr_1_<?= $co ?>'></tr>
                        </tbody>
                    </table>
                    <div>
					<button type="button" class="btn btn-default pull-left" id="colcaborador_row_2">Agregar Colaborador</button>
					</div>
                    <br>
                </div>
                <!--<div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_colaboradores" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>-->

<?php
    $eliminarColaborador= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarcolaborador');
?>
<script>
		
 
		
    var co = <?= $co ?>;
    
    $("#colaboradores_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro?");
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminarColaborador ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id},
                    success: function(data){
			
			$.notify({
					    message: data 
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
		$(this).parent().parent().remove();	
	    }
	    else
	    {
		$(this).parent().parent().remove();
	    }
        } 
    });
    
    
    $("#colcaborador_row_2").click(function(){
        
	var error = '';
		var count=$('input[name=\'Proyecto[aportante_numero][]\']').length;
        var clasificador=($('select[name=\'Proyecto[aportante_regimen][]\']').length);
        var valor=($('input[name=\'Proyecto[aportante_numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++) {
            if(($('#proyecto-aportante_colaborador_'+(valor[i].value)).val()=='') || ($.trim($('#proyecto-aportante_regimen_'+(valor[i].value)).val())=='0') || ($.trim($('#proyecto-aportante_tipo_inst_'+(valor[i].value)).val())=='0'))
            {
                error=error+'Complete todos los Campos del Colaborador #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }

        }
        
	
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
		if (count == 3) {
                error = "Solo se Permite Ingresar 3 Colaboradores como Maximo."
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
            else{
				console.log("prueba");
		$('#colaborador_addr_1_'+co).html(
								"<td>"+
										(co+1)+"<input type='hidden' name='Proyecto[aportante_numero][]' id='proyecto-aportante_numero_"+co+"' value='"+co+"' />"+
								"</td>"+
								'<td class="col-xs-5">'+
										'<div class="form-group field-proyecto-aportante_colaborador_'+co+' required">'+
												'<input type="text" id="proyecto-aportante_colaborador_'+co+'" class="form-control" name="Proyecto[aportante_colaborador][]" placeholder=".."  />'+
										'</div>'+
								'</td>'+
								'<td>'+
										'<div class="form-group field-proyecto-aportante_regimen_'+co+' required">'+
												'<select id="proyecto-aportante_regimen_'+co+'" class="form-control " name="Proyecto[aportante_regimen][]">'+
														<?php foreach($regimen as $regimen2) { ?>
																'<option value="<?= $regimen2->id; ?>" > <?= $regimen2->descripcion ?></option> '+
														<?php    } ?>
												'</select>'+
										'</div>'+
								'</td>'+
								'<td>'+
										'<div class="form-group field-proyecto-aportante_tipo_inst_'+co+' required">'+
												'<select id="proyecto-aportante_tipo_inst_'+co+'" class="form-control" name="Proyecto[aportante_tipo_inst][]">'+
														<?php foreach($tipo_inst as $tipo_inst2){?>
														'<option value="<?= $tipo_inst2->id; ?>" > <?= $tipo_inst2->descripcion ?></option>'+
														<?php    } ?>
												'</select>'+
										'</div>'+
								'</td>'+
								'<td>'+
										'<span class="eliminar glyphicon glyphicon-minus-sign"></span>'+
								'</td>');
		$('#colaboradores_tabla').append('<tr id="colaborador_addr_1_'+(co+1)+'"></tr>');
		co++;
		return true;
	    }
    
        }
	
       
    });
    
    /*$("#btn_colaboradores").click(function(event){
	var error='';
        var objetivo1=$('input[name=\'Proyecto[nombresc][]\']').length;
        for (var i=0; i<objetivo1; i++) {
            if(($('#proyecto-nombresc_'+i).val()=='') && ($('#proyecto-apellidosc_'+i).val()=='') && ($('#proyecto-funcionesc_'+i).val()==''))
            {
                error=error+'Complete todos los Campos del Colaborador #'+(i+1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
        }
	
	if (error!='') {
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
            $( "#w0" ).submit();
            return true;
        }
    });*/
    
    
    $("#proyecto-colaboradores").click(function( ) {
	var id='<?= $proyecto_id ?>';
	console.log(id);
	if (id=='') {
	    $.notify({
                message: 'No existe Proyecto Registrado.'
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
    });
</script>