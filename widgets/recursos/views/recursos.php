
<div class="clearfix"></div>

<div class="col-xs-12 col-sm-7 col-md-12">
    <h5>Recursos</h5>
                    <table class="table table-bordered table-hover" id="recurso_tabla_<?= $correlativo; ?>" name="Proyecto[recurso_tabla][]">
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
				    <tr id='recurso_addr_<?= $correlativo; ?>_<?= $re ?>'>
					<td>
					<?= ($re+1) ?>
					
                                        <input type="hidden" name="Proyecto[recurso_act_ids][]" id="proyecto-recurso_act_ids_<?= $re; ?>" value="<?= $actividad_id; ?>" />
					<input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_<?= $re; ?>" value="<?= $re; ?>" />
					</td>
					<td>
                                        <div class="form-group field-proyecto-recurso_clasificador_<?= $correlativo; ?>_<?= $re; ?> required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_clasificador][]" >
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
                                            <div class="form-group field-proyecto-recurso_descripcion_<?= $correlativo; ?>_<?= $re; ?> required">
                                                <input class="form-control " value="<?= $recursos2->detalle ?>" maxlength="2980" type="text"  placeholder="..." id="proyecto-recurso_descripcion_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_descripcion][]"/>
                                            </div>
                                        </td>
					<td>
                                        <div class="form-group field-proyecto-recurso_fuente_<?= $correlativo; ?>_<?= $re; ?> required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_fuente][]" >
                                                <option value="0">--Fuente--</option>
                                                <?php
                                                       foreach($fuentes as $fuentes2)
                                                        {
							    echo '<script>
								    //console.log('.json_encode($fuentes2->id.' '.$recursos2->fuente).');
								</script>';
                                                ?>
                                                           <option value="<?= $fuentes2->id; ?>" <?=($fuentes2->id == $recursos2->fuente)?'selected':'' ?>> <?= $fuentes2->colaborador ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_unidad_<?= $correlativo; ?>_<?= $re; ?> required">
                                                <input class="form-control " value="<?= $recursos2->unidad_medida ?>" type="text"  placeholder="..." id="proyecto-recurso_unidad_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_unidad][]"/>
                                            </div>
                                        </td>
                                        <td class="col-xs-1">
                                            <div class="form-group field-proyecto-recurso_cantidad_<?= $correlativo; ?>_<?= $re; ?> required">
                                                <input  class="form-control " value="<?= $recursos2->cantidad ?>" class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_cantidad][]" Disabled>
                                            </div>
                                        </td>
					<?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_<?= $correlativo; ?>_<?= $re ?> required">
						<input type="text" id="proyecto-recurso_ejecutado_<?= $correlativo; ?>_<?= $re ?>" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder="" value="<?= $recursos2->ejecutado ?>" Disabled>
					    </div>
					    </td>
					<?php } ?>
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_preciototal_<?= $correlativo; ?>_<?= $re; ?> required">
                                                <input value="<?= $recursos2->precio_total ?>" class="form-control soles"  type="text"  placeholder="..." id="proyecto-recurso_preciototal_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_preciototal][]" Disabled>
                                            </div>
                                        </td>
					<td>
					    <div>
					    <?= \app\widgets\programado\ProgramadoWidget::widget(['recurso_id'=>$recursos2->id,'re'=>$re,'tabla'=>$correlativo,'vigencia'=>$vigencia,"evento"=>$event]); ?> 
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign" onclick="eliminarind(<?= $correlativo; ?>,<?= $re ?>)" id="eliminar_<?= $correlativo; ?>_<?= $re; ?>">
						<input type="hidden" id="proyecto-recurso_ids_<?= $correlativo; ?>_<?= $re; ?>" name="Proyecto[recurso_ids][]" value="<?= $recursos2->id ?>" />
					    </span>
					</td>
				    </tr>
				    <?php $re++; ?>
				    <?php //}?>
				<?php } ?>
			    <?php }else{ ?>
				<tr id='recurso_addr_<?= $correlativo; ?>_0'>
				    <td>
				    <?= ($re+1) ?>
				    <input type="hidden" name="Proyecto[recurso_act_ids][]" id="proyecto-recurso_act_ids_<?= $re; ?>" value="<?= $actividad_id; ?>" />
                                    <input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_<?= $re; ?>" value="<?= $re; ?>" />
				    </td>
				    <td class="col-xs-2" >
					<div class="form-group field-proyecto-recurso_clasificador_<?= $correlativo; ?>_0 required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_<?= $correlativo; ?>_0" name="Proyecto[recurso_clasificador][]" >
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
					<div class="form-group field-proyecto-recurso_descripcion_<?= $correlativo; ?>_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_descripcion_<?= $correlativo; ?>_0" maxlength="2980" name="Proyecto[recurso_descripcion][]"/>
					</div>
				    </td>
				    <td>
                                        <div class="form-group field-proyecto-recurso_fuente_<?= $correlativo; ?>_0 required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_<?= $correlativo; ?>_0" name="Proyecto[recurso_fuente][]" >
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
					<div class="form-group field-proyecto-recurso_unidad_<?= $correlativo; ?>_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_unidad_<?= $correlativo; ?>_0" name="Proyecto[recurso_unidad][]"/>
					</div>
				    </td>
                                    <td class="col-xs-1">
					<div class="form-group field-proyecto-recurso_cantidad_<?= $correlativo; ?>_0 required">
					    <input  class="form-control " class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_<?= $correlativo; ?>_0" name="Proyecto[recurso_cantidad][]" Disabled>
					</div>
				    </td>
				    <?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_<?= $correlativo; ?>_0 required">
						<input type="text" id="proyecto-recurso_ejecutado_<?= $correlativo; ?>_0" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder=""  Disabled>
					    </div>
					    </td>
					<?php } ?>
                                    <td class="col-xs-2">
					<div class="form-group field-proyecto-recurso_preciototal_<?= $correlativo; ?>_0 required">
					    <input class="form-control soles" class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_<?= $correlativo; ?>_0" name="Proyecto[recurso_preciototal][]" Disabled>
					</div>
				    </td>
				    <td>
					    <div>
					    <?= \app\widgets\programado\ProgramadoWidget::widget(['recurso_id'=>'','re'=>'0','tabla'=>$correlativo,'vigencia'=>$vigencia,"evento"=>$event]); ?> 
					    </div>
				    </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign" onclick="eliminarind(<?= $correlativo; ?>,0)" id="eliminar_<?= $correlativo; ?>_0">
					    
					</span>
				    </td>
				</tr>
				<?php $re=1; ?>
			    <?php } ?>
                            <tr id='recurso_addr_<?= $correlativo; ?>_<?= $re ?>'></tr>
                        </tbody>
                    </table>
                    <div id="recurso_row__1" class="btn btn-default pull-left btn_hide" value="1" onclick="agregarind(<?= $correlativo; ?>,<?= $re ?>,<?= $actividad_id; ?>)">Agregar</div>
                    <br>
                </div>
        <!--<div id="control_boton">
                <button type="submit" id="btn_recursos" class="btn btn-primary btn_hide" >Guardar</button>
        </div>-->
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
 
 var evento = <?= $event; ?>
 
  var re = [];
 $(document).ready(function(){
    moneda_recurso();
    
    moneda_soles(".soles");
    
    
 });
 

 
     
 //   });
 
 
 //$("#recurso_tabla").on('click','.eliminar',function(){

function eliminarind(ntabla,ntr)
    { 
        var r = confirm("Estas seguro de Eliminar?");
        var mensaje = '';
	var eliminar = $("#eliminar_"+ntabla+"_"+ntr);
	var id= eliminar.children().val();
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
			eliminar.parent().parent().remove();s
		    }
	    }
	    else
				     {
					 eliminar.parent().parent().remove();
					 
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
					 eliminar.parent().parent().remove();	
				     }
				     else
				     {
					 eliminar.parent().parent().remove();
					 
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

 }	
 //   });
    
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
    
 function cargartitulos(ntabla,re) {
    
    var r_id = $('#proyecto-recurso_ids_'+ntabla+'_'+re).val();
    //alert(r_id);
    if(r_id)
    {
   $("#obj_programado_"+ntabla+"_"+re).html($("#proyecto-id_objetivo option:selected").html());
   $("#ind_programado_"+ntabla+"_"+re).html($("#proyecto-id_indicador option:selected").html());
   $("#act_programado_"+ntabla+"_"+re).html($("#proyecto-act_descripcion_"+re).val());
   }
   else
   {
    $.notify({
                message: "El Recurso "+(re+1)+" de la Actividad "+(ntabla+1)+" no se encuentra registrado por favor Guardar el recurso." 
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


function cargaranio(ntabla,re,anios,meses) {
    var p_anio = $("#proyecto-programa_anio_"+ntabla+"_"+re);
    var id_recurso = $("#proyecto-id_recurso_"+ntabla+"_"+re);
    
    $.ajax({
                    url: '<?= $cargarmesesanio ?>',
                    type: 'GET',
                    async: true,
                    data: {id:p_anio.val(),anios:anios,meses:meses,id_recurso:id_recurso.val(),re:re,tabla:ntabla},
                    success: function(data){
			$("#registro_meses_"+ntabla+"_"+re).find('td').remove();
                        $("#registro_meses_"+ntabla+"_"+re).html(data);
                    }
                });
    
    
    
    
}

function grabarrecurso(ntabla,rei,i,meses) {
    
    var ii = 0;
    
    //var p_anio = $("#proyecto-programa_anio_"+ntabla+"_"+rei);
    var id_recurso = $("#proyecto-id_recurso_"+ntabla+"_"+rei);
    //var nro_td = $("#programado_tabla_"+ntabla+"_"+rei+" tr:last td").length;
    var precio_unit = $("#proyecto-precio_unit_"+ntabla+"_"+rei);
    //alert(nro_td);
    if(precio_unit.val() != '')
    {
    var id = [];
    var cantidad = [];
    var mes = [];
    var anio = [];
    var suma_cantidad = 0;
    
    for (ii=0;ii<meses;ii++)
    {
	mes[ii] = $("#proyecto-programado_mes_"+ntabla+"_"+rei+"_"+(ii+1)).val();
	anio[ii] = $("#proyecto-programado_anio_"+ntabla+"_"+rei+"_"+(ii+1)).val();
	cantidad[ii] = getNum($("#proyecto-programado_cantidad_"+ntabla+"_"+rei+"_"+(ii+1)).val());
	
	suma_cantidad += $("#proyecto-programado_cantidad_"+ntabla+"_"+rei+"_"+(ii+1)).val();
	
	if ($("#proyecto-programado_id_"+ntabla+"_"+rei+"_"+(ii+1)).val()) {
	    id[ii] = $("#proyecto-programado_id_"+ntabla+"_"+rei+"_"+(ii+1)).val();
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
                    data: {anio:anio,id:id,mes:mes,cantidad:cantidad,id_recurso:id_recurso.val(),precio_unit:precio_unit.val()},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			$("#proyecto-recurso_cantidad_"+ntabla+"_"+rei).val(valor.cantidad);
			$("#proyecto-recurso_preciototal_"+ntabla+"_"+rei).val(valor.monto);
			
			
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
		       moneda_soles(".soles");
		       
		       $("#w0").submit();
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
			$("#proyecto-recurso_cantidad_"+ntabla+"_"+rei).val(valor.cantidad);
			$("#proyecto-recurso_preciototal_"+ntabla+"_"+rei).val(valor.monto);
			
			
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

/*
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
*/
function avisos(id) {
    var saldo = monto_presupuesto(id);
    var recursos = verificar_recursos(id);
    var programado = verificar_programado(id,"<?= $verificar_programado ?>");
    
    
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