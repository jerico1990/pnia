<a href="#" data-toggle="modal" data-target="#institucion_" id="instituciones">
    Lista de Instituciones Asociadas
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="institucion_" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Lista de Instituciones asociadas</h4>
            </div>
            <div class="modal-body">
                <div id="agrupador"  class="panel-group" id="accordion">
		    <?php $inst=0; ?>
		    <?php if($alianzas){ ?>
		    	<?php foreach($alianzas as $alianza){ ?>
			    <div id="alianza_addr_<?= $inst ?>" class="panel panel-default">
				<div class="panel-heading">
				    <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $inst ?>">
					Institución Colaboradora #<?= ($inst+1) ?></a>
				    </h4>
				</div>
				<div id="collapse<?= $inst ?>" class="panel-collapse collapse">
				    <div class="col-xs-12 col-sm-7 col-md-12" >
					<div class="form-group field-proyecto-alianza_institucion_<?= $inst ?> required">
					    <h5 for="proyecto-alianza_institucion_<?= $inst ?>">Institución:</h5>
					    <input type="text" id="proyecto-alianza_institucion_<?= $inst ?>" name="Proyecto[alianzas_instituciones][]" class="form-control" placeholder="Institución" value="<?= $alianza->institucion ?>">
					</div>
				    </div>
				    <div class="clearfix"></div>
				    <div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group field-proyecto-alianza_descripcion_<?= $inst ?> required">
					    <label for="proyecto-alianza_descripcion_<?= $inst ?>">Resumen:</label>
					    <textarea id="proyecto-alianza_descripcion_<?= $inst ?>" name="Proyecto[alianzas_descripciones][]" class="form-control" placeholder="Resumen"><?= $alianza->descripcion ?></textarea>
					</div>
				    </div>
				    <div class="clearfix"></div>
				    <div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group field-proyecto-alianza_nombres_<?= $inst ?> required">
					    <label for="proyecto-alianza_nombres_<?= $inst ?>">Nombres:</label>
					    <input type="text" id="proyecto-alianza_nombres_<?= $inst ?>" name="Proyecto[alianzas_nombres][]" class="form-control" placeholder="Nombres" value="<?= $alianza->nombres ?>">
					</div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group field-proyecto-alianza_apellidos_<?= $inst ?> required">
					    <label for="proyecto-alianza_apellidos_<?= $inst ?>">Apellidos:</label>
					    <input type="text" id="proyecto-alianza_apellidos_<?= $inst ?>" name="Proyecto[alianzas_apellidos][]" class="form-control" placeholder="Apellidos" value="<?= $alianza->apellidos ?>">
					</div>
				    </div>
				    <div class="clearfix"></div>
				    <div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group field-proyecto-alianza_correo_<?= $inst ?> required">
					    <label for="proyecto-alianza_correo_<?= $inst ?>">Correo:</label>
					    <input type="email" id="proyecto-alianza_correo_<?= $inst ?>" name="Proyecto[alianzas_correos][]" class="form-control" placeholder="Email" value="<?= $alianza->correo ?>">
					</div>
				    </div>
				    <div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group field-proyecto-alianza_telefono_<?= $inst ?> required">
					    <label for="proyecto-alianza_telefono_<?= $inst ?>">Telefono:</label>
					    <input type="text" id="proyecto-alianza_telefono_<?= $inst ?>" name="Proyecto[alianzas_telefonos][]" class="form-control" placeholder="Telefono" value="<?= $alianza->telefono ?>">
					</div>
				    </div>
				    <input type="hidden" name="Proyecto[alianzas_ids][]" value="<?= $alianza->id ?>" />
				    <div class="clearfix"></div>
				</div>
			    </div>
			    <?php $inst++; ?>
			<?php }?>
		    <?php }else{?>
		    <div id="alianza_addr_0" class="panel panel-default">
			<div class="panel-heading">
			    <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapse0">
				Collapsible Group 0</a>
			    </h4>
			</div>
			<div id="collapse0" class="panel-collapse collapse in">
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_institucion_0 required">
				    <label for="proyecto-alianza_institucion_0">Institución:</label>
				    <input type="text" id="proyecto-alianza_institucion_0" name="Proyecto[alianzas_instituciones][]" class="form-control" placeholder="Institución">
				</div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_descripcion_0 required">
				    <label for="proyecto-alianza_descripcion_0">Resumen:</label>
				    <textarea id="proyecto-alianza_descripcion_0" name="Proyecto[alianzas_descripciones][]" class="form-control" placeholder="Resumen"></textarea>
				</div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_nombres_0 required">
				    <label for="proyecto-alianza_nombres_0">Nombres:</label>
				    <input type="text" id="proyecto-alianza_nombres_0" name="Proyecto[alianzas_nombres][]" class="form-control" placeholder="Nombres">
				</div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_apellidos_0 required">
				    <label for="proyecto-alianza_apellidos_0">Apellidos:</label>
				    <input type="text" id="proyecto-alianza_apellidos_0" name="Proyecto[alianzas_apellidos][]" class="form-control" placeholder="Apellidos">
				</div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_correo_0 required">
				    <label for="proyecto-alianza_correo_0">Correo:</label>
				    <input type="email" id="proyecto-alianza_correo_0" name="Proyecto[alianzas_correos][]" class="form-control" placeholder="Email">
				</div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group field-proyecto-alianza_telefono_0 required">
				    <label for="proyecto-alianza_telefono_0">Telefono:</label>
				    <input type="text" id="proyecto-alianza_telefono_0" name="Proyecto[alianzas_telefonos][]" class="form-control" placeholder="Telefono">
				</div>
			    </div>
			    
			    
			    <div class="clearfix"></div>
			</div>
		    </div>
		    <?php $inst=1; ?>
		    <?php } ?>
		    <?php if($inst!=3){ ?>
		    <div id="alianza_addr_<?= $inst ?>" class="panel panel-default"></div>
		    <?php } ?>
		</div>
		
		
		<div class="clearfix"></div>
		<div id="alianza_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
		<div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_alianzas"  class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarobjetivoespecifico');
?>
<script>
    var inst=<?= $inst ?>;
    
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
    
    
    $("#alianza_row_1").click(function(){
       var alianzas_instituciones=$('input[name=\'Proyecto[alianzas_instituciones][]\']').length;
       var error='';
       for (var i=0; i<alianzas_instituciones; i++) {
            if($('#proyecto-alianza_institucion_'+i).val()=='')
            {
                error=error+'ingrese la institución #'+i+'  <br>';
                $('.field-proyecto-alianza_institucion_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_institucion_'+i).addClass('has-success');
                $('.field-proyecto-alianza_institucion_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_descripcion_'+i).val()=='')
            {
                error=error+'ingrese la descripción #'+i+'  <br>';
                $('.field-proyecto-alianza_descripcion_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_descripcion_'+i).addClass('has-success');
                $('.field-proyecto-alianza_descripcion_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_nombres_'+i).val()=='')
            {
                error=error+'ingrese los nombres #'+i+'  <br>';
                $('.field-proyecto-alianza_nombres_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_nombres_'+i).addClass('has-success');
                $('.field-proyecto-alianza_nombres_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_apellidos_'+i).val()=='')
            {
                error=error+'ingrese el apellido #'+i+'  <br>';
                $('.field-proyecto-alianza_apellidos_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_apellidos_'+i).addClass('has-success');
                $('.field-proyecto-alianza_apellidos_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_correo_'+i).val()=='')
            {
                error=error+'ingrese el correo #'+i+'  <br>';
                $('.field-proyecto-alianza_correo_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_correo_'+i).addClass('has-success');
                $('.field-proyecto-alianza_correo_'+i).removeClass('has-error');
            }
	    
	    
	    if($('#proyecto-alianza_telefono_'+i).val()=='')
            {
                error=error+'ingrese el telefono #'+i+'  <br>';
                $('.field-proyecto-alianza_telefono_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_telefono_'+i).addClass('has-success');
                $('.field-proyecto-alianza_telefono_'+i).removeClass('has-error');
            }
        }
	
	if (inst==3) {
	    error=error+'No se puede agregar mas Alianzas <br>';
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
	   $('#alianza_addr_'+inst).html('<div class="panel panel-default">'+
				       '<div class="panel-heading">'+
				       '<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'+inst+'">Collapsible Group '+inst+'</a></h4>'+
				       '</div>'+
				       '<div id="collapse'+inst+'" class="panel-collapse collapse in">'+
				       '<div class="col-xs-12 col-sm-12 col-md-12">'+
					    '<div class="form-group field-proyecto-alianza_institucion_'+inst+' required">'+
						'<label for="proyecto-alianza_institucion_'+inst+'">Institución:</label>'+
						'<input type="text" id="proyecto-alianza_institucion_'+inst+'" name="Proyecto[alianzas_instituciones][]" class="form-control" placeholder="Institución">'+
					   ' </div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="col-xs-12 col-sm-12 col-md-12">'+
					   '<div class="form-group field-proyecto-alianza_descripcion_'+inst+' required">'+
						'<label for="proyecto-alianza_descripcion_'+inst+'">Resumen:</label>'+
						'<textarea id="proyecto-alianza_descripcion_'+inst+'" name="Proyecto[alianzas_descripciones][]" class="form-control" placeholder="Resumen"></textarea>'+
					    '</div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="col-xs-12 col-sm-12 col-md-12">'+
					    '<div class="form-group field-proyecto-alianza_nombres_'+inst+' required">'+
						'<label for="proyecto-alianza_nombres_'+inst+'">Nombres:</label>'+
						'<input type="text" id="proyecto-alianza_nombres_'+inst+'" name="Proyecto[alianzas_nombres][]" class="form-control" placeholder="Nombres">'+
					    '</div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="col-xs-12 col-sm-12 col-md-12">'+
					    '<div class="form-group field-proyecto-alianza_apellidos_'+inst+' required">'+
						'<label for="proyecto-alianza_apellidos_'+inst+'">Apellidos:</label>'+
						'<input type="text" id="proyecto-alianza_apellidos_'+inst+'" name="Proyecto[alianzas_apellidos][]" class="form-control" placeholder="Apellidos">'+
					    '</div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="col-xs-12 col-sm-12 col-md-12">'+
					    '<div class="form-group field-proyecto-alianza_correo_'+inst+' required">'+
						'<label for="proyecto-alianza_correo_'+inst+'">Correo:</label>'+
						'<input type="email" id="proyecto-alianza_correo_'+inst+'" name="Proyecto[alianzas_correos][]" class="form-control" placeholder="Email">'+
					    '</div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
					'<div class="col-xs-12 col-sm-12 col-md-12">'+
					    '<div class="form-group field-proyecto-alianza_telefono_'+inst+' required">'+
						'<label for="proyecto-alianza_telefono_'+inst+'">Telefono:</label>'+
						'<input type="text" id="proyecto-alianza_telefono_'+inst+'" name="Proyecto[alianzas_telefonos][]" class="form-control" placeholder="Telefono">'+
					    '</div>'+
					'</div>'+
					'<div class="clearfix"></div>'+
				       '</div>'+
				       '</div>');
	    if ((inst+1)<3) {
		$('#agrupador').append('<div id="alianza_addr_'+(inst+1)+'" class="panel panel-default"></div>');
		inst++;
	    }
            
        }
	
            
        
        
        
        return true;
    });
    
    $("#btn_alianzas").click(function(event){
	var alianzas_instituciones=$('input[name=\'Proyecto[alianzas_instituciones][]\']').length;
	var error='';
	for (var i=0; i<alianzas_instituciones; i++) {
            if($('#proyecto-alianza_institucion_'+i).val()=='')
            {
                error=error+'ingrese la institución #'+i+'  <br>';
                $('.field-proyecto-alianza_institucion_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_institucion_'+i).addClass('has-success');
                $('.field-proyecto-alianza_institucion_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_descripcion_'+i).val()=='')
            {
                error=error+'ingrese la descripción #'+i+'  <br>';
                $('.field-proyecto-alianza_descripcion_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_descripcion_'+i).addClass('has-success');
                $('.field-proyecto-alianza_descripcion_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_nombres_'+i).val()=='')
            {
                error=error+'ingrese los nombres #'+i+'  <br>';
                $('.field-proyecto-alianza_nombres_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_nombres_'+i).addClass('has-success');
                $('.field-proyecto-alianza_nombres_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_apellidos_'+i).val()=='')
            {
                error=error+'ingrese el apellido #'+i+'  <br>';
                $('.field-proyecto-alianza_apellidos_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_apellidos_'+i).addClass('has-success');
                $('.field-proyecto-alianza_apellidos_'+i).removeClass('has-error');
            }
	    
	    if($('#proyecto-alianza_correo_'+i).val()=='')
            {
                error=error+'ingrese el correo #'+i+'  <br>';
                $('.field-proyecto-alianza_correo_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_correo_'+i).addClass('has-success');
                $('.field-proyecto-alianza_correo_'+i).removeClass('has-error');
            }
	    
	    
	    if($('#proyecto-alianza_telefono_'+i).val()=='')
            {
                error=error+'ingrese el telefono #'+i+'  <br>';
                $('.field-proyecto-alianza_telefono_'+i).addClass('has-error');
            }
            else
            {
                $('.field-proyecto-alianza_telefono_'+i).addClass('has-success');
                $('.field-proyecto-alianza_telefono_'+i).removeClass('has-error');
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
    
    
    $("#instituciones").click(function( ) {
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