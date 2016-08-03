<a href="#" data-toggle="modal" data-target="#colaboradores" id="proyecto-colaboradores" >
        Lista de Colaboradores
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade bs-example-modal-lg" id="colaboradores" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Colaboradores</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="colaboradores_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Nombres
                                </th>
                                <th class="text-center">
                                    Apellidos
                                </th>
                                <th class="text-center">
                                    Función Técnica
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
					</td>
					<td>
					    <div class="form-group field-proyecto-descripciones_<?= $co ?> required">
						
						<input type="text" id="proyecto-descripciones_<?= $co ?>" class="form-control" name="Proyecto[nombresc][]" placeholder="Descripción #<?= $co ?>" value="<?= $colaborador2->nombres ?>" />
					    </div>
					</td>
                                        <td>
					<div class="form-group field-proyecto-aapellidosc_<?= $co ?> required">
					    <input type="text" id="proyecto-apellidosc_<?= $co ?>" class="form-control" name="Proyecto[apellidosc][]" placeholder="Apellidos #<?= $co ?>" value="<?= $colaborador2->apellidos ?>" />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-funcionesc_<?= $co ?> required">
					    <input type="text" id="proyecto-funcionesc_<?= $co ?>" class="form-control" name="Proyecto[funcionesc][]" placeholder="Función #<?= $co ?>"  value="<?= $colaborador2->funcion ?>"/>
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
				<tr id='colaborador_addr_1_0'>
				    <td>
				    <?= ($co+1) ?>
				    </td>
				    <td>
					<div class="form-group field-proyecto-nombresc_0 required">
					    <input type="text" id="proyecto-nombresc_0" class="form-control" name="Proyecto[nombresc][]" placeholder="Nombres #1"  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-aapellidosc_0 required">
					    <input type="text" id="proyecto-apellidosc_0" class="form-control" name="Proyecto[apellidosc][]" placeholder="Apellidos #1"  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-funcionesc_0 required">
					    <input type="text" id="proyecto-funcionesc_0" class="form-control" name="Proyecto[funcionesc][]" placeholder="Función #1"  />
					</div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>
				<?php $co=1; ?>
			    <?php } ?>
                            <tr id='colaborador_addr_1_<?= $co ?>'></tr>
                        </tbody>
                    </table>
                    <div id="colcaborador_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_colaboradores" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

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
    
    
    $("#colcaborador_row_1").click(function(){
        console.log(co);
        
       // var objetivo=$('input[name=\'Proyecto[descripciones][]\']').length;

        if(($('#proyecto-nombresc_'+(co-1)).val()!=''))
        {
		if (($('#proyecto-apellidosc_'+(co-1)).val()!=''))
		{
			if (($('#proyecto-funcionesc_'+(co-1)).val()!=''))
			{
				$('#colaborador_addr_1_'+co).html("<td>"+(co+1)+"</td><td><div class='form-group field-proyecto-nombresc_"+co+" required'> <input type='text' id='proyecto-nombresc_"+co+"' class='form-control' name='Proyecto[nombresc][]' placeholder='Nombres #"+(co+1)+"'  /></div></td><td><div class='form-group field-proyecto-aapellidosc_"+co+" required'><input type='text' id='proyecto-apellidosc_"+co+"' class='form-control' name='Proyecto[apellidosc][]' placeholder='Apellidos #"+(co+1)+"'  /></div></td><td><div class='form-group field-proyecto-funcionesc_"+co+" required'><input type='text' id='proyecto-funcionesc_"+co+"' class='form-control' name='Proyecto[funcionesc][]' placeholder='Función #"+(co+1)+"'  /></div></td><td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
				$('#colaboradores_tabla').append('<tr id="colaborador_addr_1_'+(co+1)+'"></tr>');
				co++;			
			}
			else
			{
				var error='Complete todos los Campos del Colaborador #'+co+' <br>';
					//$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
			    
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
			
		}
		else
		{
			var error='Complete todos los Campos del Colaborador #'+co+' <br>';
			//$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
	    
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
            
            
        }
        else
        {
           var error='Complete todos los Campos del Colaborador #'+co+' <br>';
            //$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');

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
        
        
        return true;
    });
    
    $("#btn_colaboradores").click(function(event){
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
    });
    
    
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