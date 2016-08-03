<?php
$objetivos_opciones='';
foreach($objetivos as $objetivo)
{
    $objetivos_opciones=$objetivos_opciones.'<option value="'.$objetivo->id.'">'.$objetivo->descripcion.'</option>';
}

?>
<a href="#" data-toggle="modal" data-target="#indicadores_" id="indicadores">
    Lista de Indicadores
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="indicadores_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Indicadores</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="indicadores_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Objetivo especifico
                                </th>
				<th class="text-center">
                                    Indicador
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
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_oe_ids_<?= $ind ?> required">
						<select type="text" id="proyecto-indicadores_oe_ids_<?= $ind ?>" class="form-control" name="Proyecto[indicadores_oe_ids][]" >
						    <option value>Seleccionar</option>
						    <?php foreach($objetivos as $objetivo) 
						    { ?>
							<option value="<?= $objetivo->id ?>" <?= ($objetivo->id==$indicador->id_oe)?'selected':'' ?> ><?= $objetivo->descripcion?> </option>;
						    <?php
						    }
						    ?>
						</select>
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_descripciones_<?= $ind ?> required">
						<input type="text" id="proyecto-indicadores_descripciones_<?= $ind ?>" class="form-control" name="Proyecto[indicadores_descripciones][]" placeholder="Descripción #<?= $ind ?>" value="<?= $indicador->descripcion ?>" />
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
				    </td>
				    <td>
					
					<div class="form-group field-proyecto-indicadores_oe_ids_0 required">
					    <select type="text" id="proyecto-indicadores_oe_ids_0" class="form-control" name="Proyecto[indicadores_oe_ids][]" >
						<option value>Seleccionar</option>
						<?= $objetivos_opciones ?>
					    </select>
					</div>
				    </td>
				    <td>
					<div class="form-group field-proyecto-indicadores_descripciones_0 required">
					    <input type="text" id="proyecto-indicadores_descripciones_0" class="form-control" name="Proyecto[indicadores_descripciones][]" placeholder="Descripción #1"  />
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_indicadores" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $eliminarindicador= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarindicador');
?>
<script>
    var objetivos_opciones='<?= $objetivos_opciones ?>';
    var ind=<?= $ind ?>;
    $("#indicadores_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro?");
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminarindicador ?>',
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
    
    
    $("#indicadores_row_1").click(function(){
        var error='';
        
        var objetivo=$('input[name=\'Proyecto[indicadores_descripciones][]\']').length;
        if($('#proyecto-indicadores_oe_ids_'+(ind-1)).val()=='')
        {
            var error=error+'seleccione un objetivo #'+ind+' <br>';
            $('.field-proyecto-indicadores_oe_ids_'+(ind-1)).addClass('has-error');
            
        }
	else
	{
	    $('.field-proyecto-indicadores_oe_ids_'+(ind-1)).addClass('has-success');
	    $('.field-proyecto-indicadores_oe_ids_'+(ind-1)).removeClass('has-error');
	}
	
	if($('#proyecto-indicadores_descripciones_'+(ind-1)).val()=='')
        {
            var error=error+'ingrese un indicador #'+ind+' <br>';
            $('.field-proyecto-indicadores_descripciones_'+(ind-1)).addClass('has-error');
            
        }
        else
	{
	    $('.field-proyecto-indicadores_descripciones_'+(ind-1)).addClass('has-success');
	    $('.field-proyecto-indicadores_descripciones_'+(ind-1)).removeClass('has-error');
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
            $('#indicador_addr_1_'+ind).html("<td>"+ (ind+1) +"</td>"+
				 "<td><div class='form-group field-proyecto-indicadores_oe_ids_"+ind+" required'><select id='proyecto-indicadores_oe_ids_"+ind+"' name='Proyecto[indicadores_oe_ids][]' class='form-control'><option value>Seleccionar</option>"+objetivos_opciones+"</select></div></td>"+
				 "<td><div class='form-group field-proyecto-indicadores_descripciones_"+ind+" required'><input id='proyecto-indicadores_descripciones_"+ind+"' name='Proyecto[indicadores_descripciones][]' type='text' placeholder='Descripción #"+(ind+1)+"' class='form-control'  /></div></td>"+
				 "<td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
            $('#indicadores_tabla').append('<tr id="indicador_addr_1_'+(ind+1)+'"></tr>');
            ind++;
        }
        
        
        return true;
    });
    
    $("#btn_indicadores").click(function(event){
	var error='';
        var objetivos=$('input[name=\'Proyecto[indicadores_oe_ids][]\']').length;
	var indicadores=$('input[name=\'Proyecto[indicadores_descripciones][]\']').length;
        
	
	for (var i=0; i<indicadores; i++) {
	    if($('#proyecto-indicadores_oe_ids_'+i).val()=='')
            {
                error=error+'seleccione un objetivo #'+i+'  <br>';
                $('.field-proyecto-indicadores_oe_ids_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-indicadores_oe_ids_'+i).addClass('has-success');
                $('.field-proyecto-indicadores_oe_ids_'+i).removeClass('has-error');
            }
	    
            if($('#proyecto-indicadores_descripciones_'+i).val()=='')
            {
                error=error+'ingrese un indicador #'+i+'  <br>';
                $('.field-proyecto-indicadores_descripciones_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-indicadores_descripciones_'+i).addClass('has-success');
                $('.field-proyecto-indicadores_descripciones_'+i).removeClass('has-error');
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
    
    $("#indicadores").click(function( ) {
	var proyecto_id='<?= $proyecto_id ?>';
	var objetivos=<?= $CountObjetivos ?> ;
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
    });
    
</script>