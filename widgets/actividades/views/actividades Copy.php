<?php
$indicadores_opciones='';
foreach($indicadores as $indicador)
{
    $indicadores_opciones=$indicadores_opciones.'<option value="'.$indicador->id.'">'.$indicador->descripcion.'</option>';
}

?>
<a href="#" data-toggle="modal" data-target="#actividades_" id="actividades">
    Lista de actividades
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="actividades_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actividades</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="actividades_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Objetivo especifico
                                </th>
				<th class="text-center">
                                    Actividad
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $act=0; ?>
			    <?php if($actividades){ ?>
				
				<?php foreach($actividades as $actividad){?>
				    <tr id='actividad_addr_1_<?= $act ?>'>
					<td>
					<?= ($act+1) ?>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_ind_ids_<?= $act ?> required">
						<select type="text" id="proyecto-actividades_ind_ids_<?= $act ?>" class="form-control" name="Proyecto[actividades_ind_ids][]" >
						    <option value>Seleccionar</option>
						    <?php foreach($indicadores as $indicador) 
						    { ?>
							<option value="<?= $indicador->id ?>" <?= ($indicador->id==$actividad->id_ind)?'selected':'' ?> ><?= $indicador->descripcion?> </option>;
						    <?php
						    }
						    ?>
						</select>
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_descripciones_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_descripciones_<?= $act ?>" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder="Descripción #<?= $act ?>" value="<?= $actividad->descripcion ?>" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[actividades_ids][]" value="<?= $actividad->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $act++; ?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='actividad_addr_1_0'>
				    <td>
				    <?= ($act+1) ?>
				    </td>
				    <td>
					
					<div class="form-group field-proyecto-actividades_ind_ids_0 required">
					    <select type="text" id="proyecto-actividades_ind_ids_0" class="form-control" name="Proyecto[actividades_ind_ids][]" >
						<option value>Seleccionar</option>
						<?= $indicadores_opciones ?>
					    </select>
					</div>
				    </td>
				    <td>
					<div class="form-group field-proyecto-actividades_descripciones_0 required">
					    <input type="text" id="proyecto-actividades_descripciones_0" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder="Descripción #1"  />
					</div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>
				<?php $act=1; ?>
			    <?php } ?>
                            <tr id='actividad_addr_1_<?= $act ?>'></tr>
                        </tbody>
                    </table>
                    <div id="actividades_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_actividades" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminaractividad');
?>
<script>
    var indicadores_opciones='<?= $indicadores_opciones ?>';
    var act=<?= $act ?>;
    $("#actividades_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro?");
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminaractividad ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id},
                    success: function(data){
                        
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
    
    
    $("#actividades_row_1").click(function(){
        var error='';
        
        var objetivo=$('input[name=\'Proyecto[actividades_descripciones][]\']').length;
        if($('#proyecto-actividades_ind_ids_'+(act-1)).val()=='')
        {
            var error=error+'seleccione un objetivo #'+act+' <br>';
            $('.field-proyecto-actividades_ind_ids_'+(act-1)).addClass('has-error');
            
        }
	else
	{
	    $('.field-proyecto-actividades_ind_ids_'+(act-1)).addClass('has-success');
	    $('.field-proyecto-actividades_ind_ids_'+(act-1)).removeClass('has-error');
	}
	
	if($('#proyecto-actividades_descripciones_'+(act-1)).val()=='')
        {
            var error=error+'ingrese la actividad #'+act+' <br>';
            $('.field-proyecto-actividades_descripciones_'+(act-1)).addClass('has-error');
            
        }
        else
	{
	    $('.field-proyecto-actividades_descripciones_'+(act-1)).addClass('has-success');
	    $('.field-proyecto-actividades_descripciones_'+(act-1)).removeClass('has-error');
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
            $('#actividad_addr_1_'+act).html("<td>"+ (act+1) +"</td>"+
				 "<td><div class='form-group field-proyecto-actividades_ind_ids_"+act+" required'><select id='proyecto-actividades_ind_ids_"+act+"' name='Proyecto[actividades_ind_ids][]' class='form-control'><option value>Seleccionar</option>"+indicadores_opciones+"</select></div></td>"+
				 "<td><div class='form-group field-proyecto-actividades_descripciones_"+act+" required'><input id='proyecto-actividades_descripciones_"+act+"' name='Proyecto[actividades_descripciones][]' type='text' placeholder='Descripción #"+(act+1)+"' class='form-control'  /></div></td>"+
				 "<td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
            $('#actividades_tabla').append('<tr id="actividad_addr_1_'+(act+1)+'"></tr>');
            act++;
        }
        
        
        return true;
    });
    
    $("#btn_actividades").click(function(event){
	var error='';
        var objetivos=$('input[name=\'Proyecto[actividades_ind_ids][]\']').length;
	var actividades=$('input[name=\'Proyecto[actividades_descripciones][]\']').length;
        
	
	for (var i=0; i<actividades; i++) {
	    if($('#proyecto-actividades_ind_ids_'+i).val()=='')
            {
                error=error+'seleccione un objetivo #'+i+'  <br>';
                $('.field-proyecto-actividades_ind_ids_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-actividades_ind_ids_'+i).addClass('has-success');
                $('.field-proyecto-actividades_ind_ids_'+i).removeClass('has-error');
            }
	    
            if($('#proyecto-actividades_descripciones_'+i).val()=='')
            {
                error=error+'ingrese una actividad #'+i+'  <br>';
                $('.field-proyecto-actividades_descripciones_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-actividades_descripciones_'+i).addClass('has-success');
                $('.field-proyecto-actividades_descripciones_'+i).removeClass('has-error');
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
	    $( "#w0" ).submit();
            return true;
        }
    });
    
    $("#actividades").click(function( ) {
	var proyecto_id='<?= $proyecto_id ?>';
	var indicadores=<?= $CountIndicadores ?> ;
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
	if (indicadores==0) {
	    $.notify({
                message: 'No existe indicadores listados'
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