<a href="#" data-toggle="modal" data-target="#objetivos_especificos" id="objetivos-especificos">
    Lista Objetos Especificos
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="objetivos_especificos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Objetivos especificos</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="objetivos_especificos_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Objetivo especifico
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $oe=0; ?>
			    <?php if($objetivosespecificos){ ?>
				
				<?php foreach($objetivosespecificos as $objetivoespecifico){ ?>
				    <?php //if($objetivo->id==$proyecto->objetivo_especifico_1_id){ ?>
				    <tr id='objetivo_addr_1_<?= $oe ?>'>
					<td>
					<?= ($oe+1) ?>
					</td>
					<td>
					    <div class="form-group field-proyecto-objetivos_descripciones_<?= $oe ?> required">
						
						<input type="text" id="proyecto-objetivos_descripciones_<?= $oe ?>" class="form-control" name="Proyecto[objetivos_descripciones][]" placeholder="Descripción #<?= $oe ?>" value="<?= $objetivoespecifico->descripcion ?>" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[objetivos_ids][]" value="<?= $objetivoespecifico->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $oe++; ?>
				    <?php //}?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='objetivo_addr_1_0'>
				    <td>
				    <?= ($oe+1) ?>
				    </td>
				    <td>
					<div class="form-group field-proyecto-objetivos_descripciones_0 required">
					    <input type="text" id="proyecto-objetivos_descripciones_0" class="form-control" name="Proyecto[objetivos_descripciones][]" placeholder="Descripción #0"  />
					</div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>
				<?php $oe=1; ?>
			    <?php } ?>
                            <tr id='objetivo_addr_1_<?= $oe ?>'></tr>
                        </tbody>
                    </table>
                    <div id="objetivo_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_objetivos_especificos" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarobjetivoespecifico');
?>
<script>
    var oe=<?= $oe ?>;
    
    $("#objetivos_especificos_tabla").on('click','.eliminar',function(){
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
    
    
    $("#objetivo_row_1").click(function(){
       console.log(oe);
        if($('#proyecto-objetivos_descripciones_'+(oe-1)).val()=='')
        {
            var error='ingrese el objetivo #'+oe+' <br>';
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
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
        
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-success');
            $('.field-proyecto-objetivos_descripciones_'+(oe-1)).removeClass('has-error');
            $('#objetivo_addr_1_'+oe).html("<td>"+ (oe+1) +"</td><td><div class='form-group field-proyecto-objetivos_descripciones_"+oe+" required'><input id='proyecto-objetivos_descripciones_"+oe+"' name='Proyecto[objetivos_descripciones][]' type='text' placeholder='Descripción #"+(oe+1)+"' class='form-control'  /></div></td><td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
            $('#objetivos_especificos_tabla').append('<tr id="objetivo_addr_1_'+(oe+1)+'"></tr>');
            oe++;
        
        
        
        return true;
    });
    
    $("#btn_objetivos_especificos").click(function(event){
	var error='';
        var objetivo1=$('input[name=\'Proyecto[objetivos_descripciones][]\']').length;
        for (var i=0; i<objetivo1; i++) {
            if($('#proyecto-objetivos_descripciones_'+i).val()=='')
            {
                error=error+'ingrese el objetivo especifico #'+i+'  <br>';
                $('.field-proyecto-objetivos_descripciones_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-objetivos_descripciones_'+i).addClass('has-success');
                $('.field-proyecto-objetivos_descripciones_'+i).removeClass('has-error');
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
    
    $("#objetivos-especificos").click(function( ) {
	var id='<?= $proyecto_id ?>';
	console.log(id);
	if (id=='') {
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
	return true;
    });
    
</script>