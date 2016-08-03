<?php
$actividades_opciones='';
foreach($actividades as $actividad)
{
    $actividades_opciones=$actividades_opciones.'<option value="'.$actividad->id.'">'.$actividad->descripcion.'</option>';
}

?>
<a href="#" data-toggle="modal" data-target="#cronogramas_" id="cronogramas">
    Cronograma
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="cronogramas_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cronograma</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="cronogramas_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Actividad
                                </th>
				<th class="text-center">
                                    Mes
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cro=0; ?>
			    <?php if($cronogramas){ ?>
				
				<?php foreach($cronogramas as $cronograma){?>
				    <tr id='cronograma_addr_1_<?= $cro ?>'>
					<td>
					<?= ($cro+1) ?>
					</td>
					<td>
					    <div class="form-group field-proyecto-cronogramas_actividad_ids_<?= $cro ?> required">
						<select type="text" id="proyecto-cronogramas_actividad_ids_<?= $cro ?>" class="form-control" name="Proyecto[cronogramas_actividad_ids][]" >
						    <option value>Seleccionar</option>
						    <?php foreach($actividades as $actividad) 
						    { ?>
							<option value="<?= $actividad->id ?>" <?= ($actividad->id==$cronograma->id_actividad)?'selected':'' ?> ><?= $actividad->descripcion?> </option>
						    <?php
						    }
						    ?>
						</select>
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-cronogramas_meses_<?= $cro ?> required">
						<input type="month" id="proyecto-cronogramas_meses_<?= $cro ?>" class="form-control" name="Proyecto[cronogramas_meses][]" placeholder="Mes #<?= $cro ?>" value="<?= $cronograma->mes ?>" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[cronogramas_ids][]" value="<?= $cronograma->id ?>" />
						
					    </span>
					</td>
				    </tr>
				    <?php $cro++; ?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='cronograma_addr_1_0'>
				    <td>
				    <?= ($cro+1) ?>
				    </td>
				    <td>
					
					<div class="form-group field-proyecto-cronogramas_actividad_ids_0 required">
					    <select type="text" id="proyecto-cronogramas_actividad_ids_0" class="form-control" name="Proyecto[cronogramas_actividad_ids][]" >
						<option value>Seleccionar</option>
						<?= $actividades_opciones ?>
					    </select>
					</div>
				    </td>
				    <td>
					<div class="form-group field-proyecto-cronogramas_meses_0 required">
					    <input type="month" id="proyecto-cronogramas_meses_0" class="form-control" name="Proyecto[cronogramas_meses][]" placeholder="Mes #1"  />
					</div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>
				<?php $cro=1; ?>
			    <?php } ?>
                            <tr id='cronograma_addr_1_<?= $cro ?>'></tr>
                        </tbody>
                    </table>
                    <div id="cronogramas_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_cronogramas" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $eliminarcronograma= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarcronograma');
?>
<script>
    var actividades_opciones='<?= $actividades_opciones ?>';
    var cro=<?= $cro ?>;
    $("#cronogramas_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro?");
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminarcronograma ?>',
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
    
    
    $("#cronogramas_row_1").click(function(){
        var error='';
        
        if($('#proyecto-cronograma_actividad_ids_'+(cro-1)).val()=='')
        {
            var error=error+'seleccione una actividad #'+cro+' <br>';
            $('.field-proyecto-cronograma_actividad_ids_'+(cro-1)).addClass('has-error');
            
        }
	else
	{
	    $('.field-proyecto-cronograma_actividad_ids_'+(cro-1)).addClass('has-success');
	    $('.field-proyecto-cronograma_actividad_ids_'+(cro-1)).removeClass('has-error');
	}
	
	if($('#proyecto-cronogramas_meses_'+(cro-1)).val()=='')
        {
            var error=error+'ingrese el mes #'+cro+' <br>';
            $('.field-proyecto-cronogramas_meses_'+(cro-1)).addClass('has-error');
            
        }
        else
	{
	    $('.field-proyecto-cronogramas_meses_'+(cro-1)).addClass('has-success');
	    $('.field-proyecto-cronogramas_meses_'+(cro-1)).removeClass('has-error');
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
            $('#cronograma_addr_1_'+cro).html("<td>"+ (cro+1) +"</td>"+
				 "<td><div class='form-group field-proyecto-cronogramas_actividad_ids_"+cro+" required'><select id='proyecto-cronogramas_actividad_ids_"+cro+"' name='Proyecto[cronogramas_actividad_ids][]' class='form-control'><option value>Seleccionar</option>"+actividades_opciones+"</select></div></td>"+
				 "<td><div class='form-group field-proyecto-cronogramas_meses_"+cro+" required'><input id='proyecto-cronogramas_meses_"+cro+"' name='Proyecto[cronogramas_meses][]' type='month'  class='form-control'  /></div></td>"+
				 "<td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
            $('#cronogramas_tabla').append('<tr id="cronograma_addr_1_'+(cro+1)+'"></tr>');
            cro++;
        }
        
        
        return true;
    });
    
    $("#btn_cronogramas").click(function(event){
	var error='';
        
	
        var meses=$('input[name=\'Proyecto[cronogramas_meses][]\']').length;
	
	for (var i=0; i<meses; i++) {
	    if($('#proyecto-cronograma_actividad_ids_'+i).val()=='')
            {
                error=error+'seleccione una actividad #'+i+'  <br>';
                $('.field-proyecto-cronograma_actividad_ids_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-cronograma_actividad_ids_'+i).addClass('has-success');
                $('.field-proyecto-cronograma_actividad_ids_'+i).removeClass('has-error');
            }
	    
            if($('#proyecto-cronogramas_meses_'+i).val()=='')
            {
                error=error+'ingrese el mes #'+i+'  <br>';
                $('.field-proyecto-cronogramas_meses_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-cronogramas_meses_'+i).addClass('has-success');
                $('.field-proyecto-cronogramas_meses_'+i).removeClass('has-error');
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
    
    $("#cronogramas").click(function( ) {
	var proyecto_id='<?= $proyecto_id ?>';
	var actividades=<?= $CountActividades ?> ;
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
	if (actividades==0) {
	    $.notify({
                message: 'No existe listados de actividades'
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