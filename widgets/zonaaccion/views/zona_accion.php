<a href="#" data-toggle="modal" data-target="#zona_accion" id="proyecto-zonaaccion">
    Locación Geográfica(UBIGEO)
</a>
<!--Lista de Objetivos Especificos -->
<div class="modal fade bs-example-modal-lg" id="zona_accion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Zona(s) de Acción</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="zona_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Departamento
                                </th>
                                <th class="text-center">
                                    Provincia
                                </th>
                                <th class="text-center">
                                    Distrito
                                </th>
                                <!--<th class="text-center">
                                    Zona
                                </th>-->	
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $za=0; ?>
			    <?php if($zonaaccion){ ?>
				
				<?php foreach($zonaaccion as $zonaaccion2){ ?>
				    <?php //if($objetivo->id==$proyecto->objetivo_especifico_1_id){ ?>
				    <tr id='zona_addr_1_<?= $za ?>'>
					<td>
					<?= ($za+1) ?>
					</td>
					<td>
					<div class="form-group field-proyecto-zona_departamento_<?= $za ?> required">
                                            <select onchange="provincia(<?= $za ?>);" id="proyecto-zona_departamento_<?= $za ?>" name="Proyecto[zona_departamento][]" style="width:200px;">
                                                <option value="0">--Departamento--</option>
                                                <?php
                                                       foreach($departamentos as $departamentos2)
                                                        {
                                                ?>
                                                           <option value="<?= $departamentos2->department_id; ?>" <?=($departamentos2->department_id == substr($zonaaccion2->id_distrito,0,2))?'selected':'' ?> > <?= $departamentos2->department ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-zona_provincia_<?= $za ?> required">
					    <select  onchange="distrito(<?= $za ?>);" id="proyecto-zona_provincia_<?= $za ?>" name="Proyecto[zona_provincia][]" style="width:200px;">
                                                <option value="0">--Provincia--</option>
						<?php
                                                       foreach($provincias as $provincias2)
                                                        {
                                                ?>
                                                           <option value="<?= $provincias2->province_id; ?>" <?=($provincias2->province_id == substr($zonaaccion2->id_distrito,0,4))?'selected':'' ?> > <?= $provincias2->province ?></option>;
                                                <?php   } ?>
                                            </select>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-zona_distrito_<?= $za ?> required">
					    <select  id="proyecto-zona_distrito_<?= $za ?>" name="Proyecto[zona_distrito][]" style="width:200px;">
                                                <option value="0">--Distrito--</option>
						<?php
                                                       foreach($distritos as $distritos2)
                                                        {
                                                ?>
                                                           <option value="<?= $distritos2->district_id; ?>" <?=($distritos2->district_id == $zonaaccion2->id_distrito)?'selected':'' ?> > <?= $distritos2->district ?></option>;
                                                <?php   } ?>
                                            </select>
					</div>
				    </td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[zona_ids][]" value="<?= $zonaaccion2->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $za++; ?>
				    <?php //}?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='zona_addr_1_0'>
				    <td>
				    <?= ($za+1) ?>
				    </td>
				    <td>
					<div class="form-group field-proyecto-zona_departamento_0 required">
                                            <select onchange="provincia(0);" id="proyecto-zona_departamento_0" name="Proyecto[zona_departamento][]" style="width:200px;">
                                                <option value="0">--Departamento--</option>
                                                <?php
                                                       foreach($departamentos as $departamentos2)
                                                        {
                                                ?>
                                                           <option value="<?= $departamentos2->department_id; ?>" > <?= $departamentos2->department ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-zona_provincia_0 required">
					    <select  onchange="distrito(0);" id="proyecto-zona_provincia_0" name="Proyecto[zona_provincia][]" style="width:200px;">
                                                <option value="0">--Provincia--</option>                                            
                                            </select>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-proyecto-zona_distrito_0 required">
					    <select  id="proyecto-zona_distrito_0" name="Proyecto[zona_distrito][]" style="width:200px;">
                                                <option value="0">--Distrito--</option>                                            
                                            </select>
					</div>
				    </td>
                                    <!--<td>
					<div class="form-group field-proyecto-zona_zona_0 required">
					    <input type="text" id="proyecto-zona_zona_0" class="form-control" name="Proyecto[zona_zona][]" placeholder="Zona #1"  />
					</div>
				    </td>-->
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					    
					</span>
				    </td>
				</tr>
				<?php $za=1; ?>
			    <?php } ?>
                            <tr id='zona_addr_1_<?= $za ?>'></tr>
                        </tbody>
                    </table>
                    <div id="ubigeo_row_1" class="btn btn-default pull-left" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_zona_accion" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $obtenerprovincia = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerprovincia');
    $obtenerdistrito = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerdistrito');
    $eliminarubigeo = Yii::$app->getUrlManager()->createUrl('proyecto/eliminarubigeo');
?>
<script>

$(document).ready(function(){
 
 
    


});

var za=<?= $za ?>;
    
    
    
    function provincia(identificador) {
	
	var departamento = $('#proyecto-zona_departamento_'+identificador);
	var provincia = $('#proyecto-zona_provincia_'+identificador);
	var distrito = $('#proyecto-zona_distrito_'+identificador);
	
     if(departamento.val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerprovincia ?>',
                    type: 'GET',
                    async: true,
                    data: {id:departamento.val()},
                    success: function(data){
                        provincia.find('option').remove();
                        provincia.append(data);
                        provincia.prop('disabled', false);
                    }
                });
        }
        else
        {
            provincia.find('option').remove();
            provincia.append('<option value="0">--Seleccione--</option>');
	    provincia.prop('disabled', true);
	    distrito.find('option').remove();
            distrito.append('<option value="0">--Seleccione--</option>');
            distrito.prop('disabled', true);
        }

    }
    
    function distrito(identificador) {
	var provincia = $('#proyecto-zona_provincia_'+identificador);
	var distrito = $('#proyecto-zona_distrito_'+identificador);
	
     if(provincia.val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerdistrito ?>',
                    type: 'GET',
                    async: true,
                    data: {id:provincia.val()},
                    success: function(data){
                        distrito.find('option').remove();
                        distrito.append(data);
                        distrito.prop('disabled', false);
                    }
                });
        }
        else
        {
	    distrito.find('option').remove();
            distrito.append('<option value="0">--Seleccione--</option>');
            distrito.prop('disabled', true);
        }
    }
    
   
    
    $("#ubigeo_row_1").click(function(){
	
	var error = '';
       console.log(za);
       
	var departamento = $('#proyecto-zona_departamento_'+(za-1));
	var provincia = $('#proyecto-zona_provincia_'+(za-1));
	var distrito = $('#proyecto-zona_distrito_'+(za-1));
	
	
       
        if(departamento.val()=='0')
        {
            error += "Ingrese Departamento del Registro Nro "+za+" <br>";
	    $('.field-proyecto-zona_departamento_'+(za-1)).addClass('has-success');
            $('.field-proyecto-zona_departamento_'+(za-1)).removeClass('has-error');
	}
	
	if(provincia.val()=='0')
        {
            error += "Ingrese Provincia del Registro Nro "+za+" <br>";
	    $('.field-proyecto-zona_provincia_'+(za-1)).addClass('has-success');
            $('.field-proyecto-zona_provincia_'+(za-1)).removeClass('has-error');
	}
	
	if(distrito.val()=='0')
        {
            error += "Ingrese Distrito del Registro Nro "+za+" <br>";
	    $('.field-proyecto-zona_distrito_'+(za-1)).addClass('has-success');
            $('.field-proyecto-zona_distrito_'+(za-1)).removeClass('has-error');
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
            $('#zona_addr_1_'+za).html('<td>'+za+'</td><td><div class="form-group field-proyecto-zona_departamento_'+za+' required"><select onchange="provincia('+za+');" id="proyecto-zona_departamento_'+za+'" name="Proyecto[zona_departamento][]" style="width:200px;"> <option value="0">--Departamento--</option> <?php foreach($departamentos as $departamentos2){ ?><option value="<?= $departamentos2->department_id; ?>" > <?= $departamentos2->department ?></option>;<?php   } ?></select></div></td><td><div class="form-group field-proyecto-zona_provincia_'+za+' required"><select  onchange="distrito('+za+');" id="proyecto-zona_provincia_'+za+'" name="Proyecto[zona_provincia][]" style="width:200px;"><option value="0">--Provincia--</option></select></div></td><td><div class="form-group field-proyecto-zona_distrito_'+za+' required"><select  id="proyecto-zona_distrito_'+za+'" name="Proyecto[zona_distrito][]" style="width:200px;"><option value="0">--Distrito--</option></select></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
            $('#zona_tabla').append('<tr id="zona_addr_1_'+(za+1)+'"></tr>');
            za++;
        return true;
    
        }
        
        
    });
    
    $("#zona_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro?");
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminarubigeo ?>',
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
    
    $("#proyecto-zonaaccion").click(function( ) {
	var id='<?= $proy_zonaaccion_id ?>';
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
    
    
    
    $("#btn_zona_accion").click(function(event){
	
	var error='';
        var departamentos=$('input[name=\'Proyecto[zona_departamento][]\']').length;
        for (var i=0; i<=departamentos; i++) {
            if(($('#proyecto-zona_departamento_'+i).val()=='0') && ($('#proyecto-zona_provincia_'+i).val()=='0') && ($('#proyecto-zona_distrito_'+i).val()=='0'))
            {
                error=error+'Complete todos los Campos de la Zona de Acción #'+(i+1)+' <br>';
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
    
</script>