
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-7 col-md-12">
    <h5>Recursos</h5>
                    <table class="table table-bordered table-hover" id="recurso_tabla" name="Proyecto[recurso_tabla][]">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Clasificador
                                </th>
                                <th class="text-center">
                                    Descripción
                                </th>
				<th class="text-center">
                                    Fuente
                                </th>
                                <th class="text-center">
                                    Unidad
                                </th>
                                <th class="text-center">
                                    Cantidad
                                </th>
				<?php if($event == 2){ ?>
				<th class="text-center">
                                    Ejecutado
                                </th>
				<?php } ?>
                                <th class="text-center">
                                    Monto
                                </th>
				<th>
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $re=0; ?>
			    <?php if($recursos){ ?>
				
				<?php foreach($recursos as $recursos2){ ?>
				    <?php //if($objetivo->id==$proyecto->objetivo_especifico_1_id){ ?>
				    <tr id='recurso_addr_1_<?= $re ?>'>
					<td>
					<?= ($re+1) ?>
                                        <input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_<?= $re; ?>" value="<?= $re; ?>" />
					</td>
					<td>
                                        <div class="form-group field-proyecto-recurso_clasificador_<?= $re; ?> required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_<?= $re; ?>" name="Proyecto[recurso_clasificador][]" >
                                                <option value="0">--Clasificador--</option>
                                                <?php
                                                       foreach($clasificador as $clasificador2)
                                                        {
                                                ?>
                                                           <option value="<?= $clasificador2->id; ?>" <?=($clasificador2->id == $recursos2->clasificador_id)?'selected':'' ?>> <?= $clasificador2->descripcion ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
                                        <td class="col-xs-3"  >
                                            <div class="form-group field-proyecto-recurso_descripcion_<?= $re; ?> required">
                                                <input class="form-control " value="<?= $recursos2->detalle ?>" type="text"  placeholder="..." id="proyecto-recurso_descripcion_<?= $re; ?>" name="Proyecto[recurso_descripcion][]"/>
                                            </div>
                                        </td>
					<td>
                                        <div class="form-group field-proyecto-recurso_fuente_<?= $re; ?> required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_<?= $re; ?>" name="Proyecto[recurso_fuente][]" >
                                                <option value="0">--Fuente--</option>
                                                <?php
                                                       foreach($fuentes as $fuentes2)
                                                        {
							    echo '<script>
								    console.log('.json_encode($fuentes2->id.' '.$recursos2->fuente).');
								</script>';
                                                ?>
                                                           <option value="<?= $fuentes2->id; ?>" <?=($fuentes2->id == $recursos2->fuente)?'selected':'' ?>> <?= $fuentes2->colaborador ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_unidad_<?= $re; ?> required">
                                                <input class="form-control " value="<?= $recursos2->unidad_medida ?>" type="text"  placeholder="..." id="proyecto-recurso_unidad_<?= $re; ?>" name="Proyecto[recurso_unidad][]"/>
                                            </div>
                                        </td>
                                        <td class="col-xs-1">
                                            <div class="form-group field-proyecto-recurso_cantidad_<?= $re; ?> required">
                                                <input  class="form-control " value="<?= $recursos2->cantidad ?>" class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_<?= $re; ?>" name="Proyecto[recurso_cantidad][]" Disabled>
                                            </div>
                                        </td>
					<?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_<?= $re ?> required">
						<input type="text" id="proyecto-recurso_ejecutado_<?= $re ?>" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder="" value="<?= $recursos2->ejecutado ?>" Disabled>
					    </div>
					    </td>
					<?php } ?>
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_preciototal_<?= $re; ?> required">
                                                <input class="form-control " value="<?= $recursos2->precio_total ?>" class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_<?= $re; ?>" name="Proyecto[recurso_preciototal][]" Disabled>
                                            </div>
                                        </td>
					<td>
					    <div>
					    <?= \app\widgets\programado\ProgramadoWidget::widget(['recurso_id'=>$recursos2->id,'re'=>$re,'vigencia'=>$vigencia,"evento"=>$event]); ?> 
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" id="proyecto-recurso_ids_<?= $re; ?>" name="Proyecto[recurso_ids][]" value="<?= $recursos2->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $re++; ?>
				    <?php //}?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='recurso_addr_1_0'>
				    <td>
				    <?= ($re+1) ?>
                                    <input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_<?= $re; ?>" value="<?= $re; ?>" />
				    </td>
				    <td class="col-xs-2" >
					<div class="form-group field-proyecto-recurso_clasificador_0 required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_0" name="Proyecto[recurso_clasificador][]" >
                                                <option value="0">--Clasificador--</option>
                                                <?php
                                                       foreach($clasificador as $clasificador2)
                                                        {
                                                ?>
                                                           <option value="<?= $clasificador2->id; ?>" > <?= $clasificador2->descripcion ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
					</div>
				    </td>
                                    <td class="col-xs-3"  >
					<div class="form-group field-proyecto-recurso_descripcion_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_descripcion_0" name="Proyecto[recurso_descripcion][]"/>
					</div>
				    </td>
				    <td>
                                        <div class="form-group field-proyecto-recurso_fuente_0 required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_0" name="Proyecto[recurso_fuente][]" >
                                                <option value="0">--Fuente--</option>
                                                <?php
                                                       foreach($fuentes as $fuentes2)
                                                        {
                                                ?>
                                                           <option value="<?= $fuentes2->id; ?>" > <?= $fuentes2->colaborador ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
                                    <td class="col-xs-2">
					<div class="form-group field-proyecto-recurso_unidad_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_unidad_0" name="Proyecto[recurso_unidad][]"/>
					</div>
				    </td>
                                    <td class="col-xs-1">
					<div class="form-group field-proyecto-recurso_cantidad_0 required">
					    <input  class="form-control " class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_0" name="Proyecto[recurso_cantidad][]" Disabled>
					</div>
				    </td>
				    <?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_0 required">
						<input type="text" id="proyecto-recurso_ejecutado_0" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder=""  Disabled>
					    </div>
					    </td>
					<?php } ?>
                                    <td class="col-xs-2">
					<div class="form-group field-proyecto-recurso_preciototal_0 required">
					    <input class="form-control " class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_0" name="Proyecto[recurso_preciototal][]" Disabled>
					</div>
				    </td>
				    <td>
					    <div>
					    <?= \app\widgets\programado\ProgramadoWidget::widget(['recurso_id'=>'','re'=>'0','vigencia'=>$vigencia,"evento"=>$event]); ?> 
					    </div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					    
					</span>
				    </td>
				</tr>
				<?php $re=1; ?>
			    <?php } ?>
                            <tr id='recurso_addr_1_<?= $re ?>'></tr>
                        </tbody>
                    </table>
                    <div id="recurso_row_1" class="btn btn-default pull-left btn_hide" value="1">Agregar</div>
                    <br>
                </div>
        <div id="control_boton">
                <button type="submit" id="btn_recursos" class="btn btn-primary btn_hide" >Guardar</button>
        </div>
<?php
    $eliminarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/eliminarrecurso');
    $refrescarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarrecursos');
    $cargarmesesanio = Yii::$app->getUrlManager()->createUrl('proyecto/cargarmesesanio');
    $grabarprogramado = Yii::$app->getUrlManager()->createUrl('proyecto/grabarprogramado');
    $verificar_saldo = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_presupuesto');
    $verificar_recursos = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_recursos');
    $verificar_programado = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_programado');
    $verificar_actividades = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_actividades');
    $verificar_peso_actividades = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_peso_actividades');
    $ver_programado = Yii::$app->getUrlManager()->createUrl('proyecto/ver_programado');

?>
<script>
 
 var re = <?= $re; ?>
 
 var evento = <?= $event; ?>
 
 $(document).ready(function(){
    moneda_recurso();
 });
 
 $("#recurso_row_1").click(function(){
	
	var error = '';
        var clasificador=($('input[name=\'Proyecto[recurso_descripcion][]\']').length);
        var valor=($('input[name=\'Proyecto[recurso_numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++) {
            if(($('#proyecto-recurso_clasificador_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_descripcion_'+(valor[i].value)).val())=='') || ($('#proyecto-recurso_fuente_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_unidad_'+(valor[i].value)).val())=='') )
            {
                error=error+'Complete todos los Campos del Recurso #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
        }
       
	/*var clasificador = $('#proyecto-recurso_clasificador_'+(re-1));
	var descripcion = $('#proyecto-recurso_descripcion_'+(re-1));
	var unidad = $('#proyecto-recurso_unidad_'+(re-1));
	var cantidad = $('#proyecto-recurso_cantidad_'+(re-1));
        var precioun = $('#proyecto-recurso_precioun_'+(re-1));
	
       
        if(clasificador.val()=='0')
        {
            error += "Ingrese Clasificador Nro "+re+" <br>";
	    $('.field-proyecto-recurso_clasificador_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_clasificador_'+(re-1)).removeClass('has-error');
	}
	
	if($.trim(descripcion.val())=='')
        {
            error += "Ingrese Detalle Nro "+re+" <br>";
	    $('.field-proyecto-recurso_descripcion_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_descripcion_'+(re-1)).removeClass('has-error');
	}
	
	if($.trim(unidad.val())=='')
        {
            error += "Ingrese la Unidad de Medida Nro "+re+" <br>";
	    $('.field-proyecto-recurso_unidad_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_unidad_'+(re-1)).removeClass('has-error');
	}
        
        if($.trim(cantidad.val())=='')
        {
            error += "Ingrese la Cantidad Nro "+re+" <br>";
	    $('.field-proyecto-recurso_cantidad_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_cantidad_'+(re-1)).removeClass('has-error');
	}
        
        if($.trim(precioun.val())=='')
        {
            error += "Ingrese el Precio Unitario Nro "+re+" <br>";
	    $('.field-proyecto-recurso_precioun_'+(re-1)).addClass('has-success');
            $('.field-proyecto-recurso_precioun_'+(re-1)).removeClass('has-error');
	}*/
	
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
            $('#recurso_addr_1_'+re).html('<td>'+(re+1)+'<input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_'+re+'" value="'+re+'" /></td><td class="col-xs-2" ><div class="form-group field-proyecto-recurso_clasificador_'+re+' required"><select  class="form-control " id="proyecto-recurso_clasificador_'+re+'" name="Proyecto[recurso_clasificador][]" ><option value="0">--Clasificador--</option><?php foreach($clasificador as $clasificador2) { ?> <option value="<?= $clasificador2->id; ?>" > <?= $clasificador2->descripcion ?></option>; <?php   } ?></select></div></td><td class="col-xs-3"  ><div class="form-group field-proyecto-recurso_descripcion_'+re+' required"><input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_descripcion_'+re+'" name="Proyecto[recurso_descripcion][]"/></div></td><td><div class="form-group field-proyecto-recurso_fuente_'+re+' required"> <select  class="form-control " id="proyecto-recurso_fuente_'+re+'" name="Proyecto[recurso_fuente][]" > <option value="0">--Fuente--</option> <?php foreach($fuentes as $fuentes2){ ?> <option value="<?= $fuentes2->id; ?>" > <?= $fuentes2->colaborador ?></option>; <?php   } ?></select></div></td><td class="col-xs-2"><div class="form-group field-proyecto-recurso_unidad_'+re+' required"><input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_unidad_'+re+'" name="Proyecto[recurso_unidad][]"/></div></td><td class="col-xs-1"><div class="form-group field-proyecto-recurso_cantidad_'+re+' required"><input  class="form-control " class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_'+re+'" name="Proyecto[recurso_cantidad][]" Disabled></div></td><?php if($event == 2){ ?> <td class="col-xs-1">  <div class="form-group field-proyecto-recurso_ejecutado_'+re+' required"> <input type="text" id="proyecto-recurso_ejecutado_'+re+'" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder=""  Disabled>  </div> </td> <?php } ?><td><div class="form-group field-proyecto-recurso_preciototal_'+re+' required"><input class="form-control " class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_'+re+'" name="Proyecto[recurso_preciototal][]" Disabled></div></td><td><div><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#programado'+re+'_" id="btn_programado" onclick="cargartitulos('+re+')">Detalle</button></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
            $('#recurso_tabla').append('<tr id="recurso_addr_1_'+(re+1)+'"></tr>');
            re++;
	    moneda_recurso();
        return true;
    
        }
        
        
    });
 
 
 $("#recurso_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
        var mensaje = '';
	var id=$(this).children().val();
	var valor = null;
	if (r == true) {
	if (evento == 2)
	{
	    if (id) {
	   $.ajax({
                    url: '<?= $ver_programado ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			valor = jQuery.parseJSON(data);
                        
			if (valor.estado == 1) {
			    
			    $.notify({
					    message: valor.mensaje 
					},{
					    type: 'danger',
					    z_index: 1000000,
					    placement: {
						from: 'bottom',
						align: 'right'
					    },
					});
			}
			else
			{
			    
				    
					 $.ajax({
					     url: '<?= $eliminarrecurso ?>',
					     type: 'GET',
					     async: false,
					     data: {id:id},
					     success: function(data){
						 
						 mensaje = data;
						 
						 
						 
						 $.notify({
							message: mensaje 
						    },{
							type: 'danger',
							z_index: 1000000,
							placement: {
							    from: 'bottom',
							    align: 'right'
							},
						    });
					     }
					 });
					 	
				     
				     
				     
				     
				     
				     
				 }
			    	
			    
			
			
			
                    }
                });
	   
		    if (valor.estado == 0) {
			$(this).parent().parent().remove();s
		    }
	    }
	    else
				     {
					 $(this).parent().parent().remove();
					 
					 mensaje = "Se elimino el Recurso Correctamente";
					 
					 $.notify({
					    message: mensaje 
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
	else
	{
	    
				     if (id) {
					 $.ajax({
					     url: '<?= $eliminarrecurso ?>',
					     type: 'GET',
					     async: false,
					     data: {id:id},
					     success: function(data){
						 
						 mensaje = data;
					     }
					 });
					 $(this).parent().parent().remove();	
				     }
				     else
				     {
					 $(this).parent().parent().remove();
					 
					 mensaje = "Se elimino el Recurso Correctamente";
				     }
				     
				     
				     $.notify({
					    message: mensaje 
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
	
    });
    
    $("#btn_recursos").click(function(event){
        
        	
	var error='';
        var clasificador=($('input[name=\'Proyecto[recurso_descripcion][]\']').length);
        var valor=($('input[name=\'Proyecto[recurso_numero][]\']').serializeArray());
        
        //console.log(valor);
        //console.log('-'+clasificador);
        //alert(clasificador);
        
        for (var i=0; i<clasificador; i++) {
            
            
           // console.log(valor[i].value);
            if(($('#proyecto-recurso_clasificador_'+(valor[i].value)).val()=='0') || ($.trim($('#proyecto-recurso_descripcion_'+(valor[i].value)).val())=='') ||($('#proyecto-recurso_fuente_'+(valor[i].value)).val()=='0')|| ($.trim($('#proyecto-recurso_unidad_'+(valor[i].value)).val())=='') )
            {
                error=error+'Complete todos los Campos del Recurso #'+((parseInt(valor[i].value)) + 1)+' <br>';
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
           
            return true;
        }
    });
    
 function cargartitulos(re) {
    
    var r_id = $('#proyecto-recurso_ids_'+re).val();
    if(r_id)
    {
   $("#obj_programado_"+re).html($("#proyecto-id_objetivo option:selected").html());
   $("#ind_programado_"+re).html($("#proyecto-id_indicador option:selected").html());
   $("#act_programado_"+re).html($("#proyecto-id_actividad option:selected").html());
   }
   else
   {
    $.notify({
                message: "El Recurso "+(re+1)+" no se encuentra registrado por favor Guardar el recurso." 
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
}


function cargaranio(re,anios,meses) {
    
    var p_anio = $("#proyecto-programa_anio_"+re);
    var id_recurso = $("#proyecto-id_recurso_"+re);
    //console.log();
    $.ajax({
                    url: '<?= $cargarmesesanio ?>',
                    type: 'GET',
                    async: true,
                    data: {id:p_anio.val(),anios:anios,meses:meses,id_recurso:id_recurso.val(),re:re},
                    success: function(data){
                        $("#registro_meses_"+re).html(data);
                    }
                });
    
    
    
    
}

function grabarrecurso(rei,i) {
    
    var ii = 0;
    
    var p_anio = $("#proyecto-programa_anio_"+rei);
    var id_recurso = $("#proyecto-id_recurso_"+rei);
    var nro_td = $("#programado_tabla_"+rei+" tr:last td").length;
    var precio_unit = $("#proyecto-precio_unit_"+rei);
    
    if(precio_unit.val() != '')
    {
    var id = new Array(parseInt(nro_td));
    var cantidad = new Array(parseInt(nro_td));
    var mes = new Array(parseInt(nro_td));
    var suma_cantidad = 0;
    for (ii=0;ii<nro_td;ii++)
    {
	mes[ii] = $("#proyecto-programado_mes_"+rei+"_"+(ii+1)).val();
	cantidad[ii] = $("#proyecto-programado_cantidad_"+rei+"_"+(ii+1)).val();
	
	suma_cantidad += $("#proyecto-programado_cantidad_"+rei+"_"+(ii+1)).val();
	
	if ($("#proyecto-programado_id_"+rei+"_"+(ii+1)).val()) {
	    id[ii] = $("#proyecto-programado_id_"+rei+"_"+(ii+1)).val();
	}
	else
	{
	   id[ii] = null; 
	}
    }
    if (evento == 1) {
	
	$.ajax({
                    url: '<?= $grabarprogramado ?>',
                    type: 'POST',
                    async: true,
                    data: {anio:p_anio.val(),id:id,mes:mes,cantidad:cantidad,id_recurso:id_recurso.val(),precio_unit:precio_unit.val()},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			$("#proyecto-recurso_cantidad_"+rei).val(valor.cantidad);
			$("#proyecto-recurso_preciototal_"+rei).val(valor.monto);
			
			
			jsRemoveWindowLoad();
			
			avisos(<?= $id_proyecto;?>);
			
                       $.notify({
			    message: valor.mensaje
			},{
			    type: 'danger',
			    z_index: 1000000,
			    placement: {
				from: 'bottom',
				align: 'right'
			    },
			});		
                    },
		     beforeSend: function(){
			jsShowWindowLoad('Procesando nueva Modificación...');
		     }
                });
    }
    if (evento == 2) {
	if (suma_cantidad > $("#proyecto-recurso_ejecutado_"+rei).val())
	{
    
	    $.ajax({
                    url: '<?= $grabarprogramado ?>',
                    type: 'POST',
                    async: true,
                    data: {anio:p_anio.val(),id:id,mes:mes,cantidad:cantidad,id_recurso:id_recurso.val(),precio_unit:precio_unit.val()},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			$("#proyecto-recurso_cantidad_"+rei).val(valor.cantidad);
			$("#proyecto-recurso_preciototal_"+rei).val(valor.monto);
			
			
			jsRemoveWindowLoad();
			
			avisos(<?= $id_proyecto;?>);
			
                       $.notify({
			    message: valor.mensaje
			},{
			    type: 'danger',
			    z_index: 1000000,
			    placement: {
				from: 'bottom',
				align: 'right'
			    },
			});		
                    },
		     beforeSend: function(){
			jsShowWindowLoad('Procesando nueva Modificación...');
		     }
                });
	}
	else
	{
	    $.notify({
			    message: "La Cantidad no puede ser menor que el Ejecutado."
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
    else
    {
	
	//$('#programado'+rei+'_').modal().Constructor.DEFAULTS.backdrop = 'static';
	
	$.notify({
			    message: "Ingresar el Precio Unitario."
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


function verificar_saldo(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verificar_saldo ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   
   return array
   
}


function verificar_recursos(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verificar_recursos ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   
   return array
   
}


function verificar_actividades(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verificar_actividades ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   
   return array
   
}

function verificar_peso_actividades(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verificar_peso_actividades ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   
   return array
   
}


function verificar_programado(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verificar_programado ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			 
			array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   return array
   
}

function avisos(id) {
    var saldo = monto_presupuesto(id);
    var recursos = verificar_recursos(id);
    var programado = verificar_programado(id);
    
    
    if ((saldo[0] > 1) || (recursos[0] > 0) || (programado[0] != 0)) {
	   $('#warning').html(saldo[1]+recursos[1]+programado[1]);
	   $('#warning').show();
	}
	else
	{
	   $('#warning').hide();
	}
}

function moneda_recurso()
{
   var count=($('input[name=\'Proyecto[recurso_numero][]\']').length);
   
   for (var i=0;i<count;i++)
   {
    var total = $("#proyecto-recurso_preciototal_"+i);
    if (total.val() == '')
    {
        total.val(parseFloat(0).toFixed(2));
    }

    moneda_soles("#proyecto-recurso_preciototal_"+i);
   }
   
}

</script>