<?php
/*$indicadores_opciones='';
foreach($indicadores as $indicador)
{
    $indicadores_opciones=$indicadores_opciones.'<option value="'.$indicador->id.'">'.$indicador->descripcion.'</option>';
}
*/
?>

<div>
   
            <div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
		   
                    <table class="table table-hover" id="actividades_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Actividad
                                </th>
				<th class="text-center">
                                    Id. BID
                                </th>
				<th class="text-center">
                                    Peso
                                </th>
				<th class="text-center">
                                    Unidad de Medida
                                </th>
				<th class="text-center">
                                    Meta
                                </th>
				<?php if($event == 2){ ?>
				<th class="text-center">
                                    Ejecutado
                                </th>
				<?php } ?>
				<th>
                                    
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
					<input type="hidden" name="Proyecto[actividades_numero][]" id="proyecto-actividades_numero_<?= $act; ?>" value="<?= $act; ?>" />
					</td>
					<td class="col-xs-3">
					    <div class="form-group field-proyecto-actividades_descripciones_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_descripciones_<?= $act ?>" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder="Descripción #<?= $act ?>" value="<?= $actividad->descripcion ?>" />
					    </div>
					</td>
					<td class="col-xs-2">
                                        <div class="form-group field-proyecto-actividades_indicadorbid_<?= $act; ?> required">
                                            <select  class="form-control " id="proyecto-actividades_indicadorbid_<?= $act; ?>" name="Proyecto[actividades_indicadorbid][]" >
                                                <option value="0">--Indicador BID--</option>
                                                <?php
                                                       foreach($indicadorBID as $indicadorBID2)
                                                        {
                                                ?>
                                                           <option value="<?= $indicadorBID2->id; ?>" <?=($indicadorBID2->id == $actividad->id_bid)?'selected':'' ?>> <?= $indicadorBID2->descripcion ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_pesos_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_pesos_<?= $act ?>" class="form-control entero" name="Proyecto[actividades_pesos][]" placeholder="Peso" value="<?= $actividad->peso ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_unidad_medidas_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_unidad_medidas_<?= $act ?>" class="form-control" name="Proyecto[actividades_unidad_medidas][]" placeholder="Unidad de Medida" value="<?= $actividad->unidad_medida ?>" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_metas_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_metas_<?= $act ?>" class="form-control entero" name="Proyecto[actividades_metas][]" placeholder="" value="<?= $actividad->meta ?>" />
					    </div>
					</td>
					<?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ejecutado_<?= $act ?> required">
						<input type="text" id="proyecto-actividades_ejecutado_<?= $act ?>" class="form-control" name="Proyecto[actividades_ejecutado][]" placeholder="" value="<?= $actividad->ejecutado ?>" Disabled>
					    </div>
					    </td>
					<?php } ?>
					<td>
					    <div>
					    <?= \app\widgets\fechas\FechasWidget::widget(['actividad_id'=>$actividad->id,'act'=>$act]); ?> 
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
					<input type="hidden" name="Proyecto[actividades_numero][]" id="proyecto-actividades_numero_<?= $act; ?>" value="<?= $act; ?>" />
					</td>
					<td class="col-xs-4">
					    <div class="form-group field-proyecto-actividades_descripciones_0 required">
						<input type="text" id="proyecto-actividades_descripciones_0" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder="Descripción #<?= $act ?>"  />
					    </div>
					</td>
					<td class="col-xs-1">
                                        <div class="form-group field-proyecto-actividades_indicadorbid_0 required">
                                            <select  class="form-control " id="proyecto-actividades_indicadorbid_0" name="Proyecto[actividades_indicadorbid][]" >
                                                <option value="0">--Indicador BID--</option>
                                                <?php
                                                       foreach($indicadorBID as $indicadorBID2)
                                                        {
                                                ?>
                                                           <option value="<?= $indicadorBID2->id; ?>" > <?= $indicadorBID2->descripcion ?></option>;
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
					    
                                            </div>    
                                        </td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_pesos_0 required">
						<input type="text" id="proyecto-actividades_pesos_0" class="form-control entero" name="Proyecto[actividades_pesos][]" placeholder="" " />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_unidad_medidas_0 required">
						<input type="text" id="proyecto-actividades_unidad_medidas_0" class="form-control" name="Proyecto[actividades_unidad_medidas][]" placeholder=""  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-actividades_metas_0 required">
						<input type="text" id="proyecto-actividades_metas_0" class="form-control entero" name="Proyecto[actividades_metas][]" placeholder="" />
					    </div>
					</td>
					<?php if($event == 2){ ?>
					    <td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ejecutado_0 required">
						<input type="text" id="proyecto-actividades_ejecutado_0" class="form-control" name="Proyecto[actividades_ejecutado][]" placeholder=""  Disabled>
					    </div>
					    </td>
					<?php } ?>
					<td>
					    <div>
					    <?= \app\widgets\fechas\FechasWidget::widget(['actividad_id'=>'','act'=>$act]); ?> 
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
                    <div id="actividades_row_1" class="btn btn-default pull-left btn_hide" value="1">Agregar</div>
                    <br>
                </div>
                <div class="clearfix"></div>
		<div id="control_boton">
                <button type="submit" id="btn_actividades" class="btn btn-primary btn_hide" >Guardar</button>
        </div>
            </div>

</div>

<?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminaractividad');
    $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
    $verAct= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_actividades');
    $verPesoAct= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_peso_actividades');
?>
<script>
   var act = <?= $act; ?>

$(document).ready(function(){

avisos2();

});

 $("#actividades_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
	//var valor = null;
        if (r == true) {
            id=$(this).children().val();
	    //alert(id);
            if (id) {
		$.ajax({
                    url: '<?= $eliminaractividad ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			
			valor = jQuery.parseJSON(data);
			estado2 = valor.estado ;
			mensaje = valor.mensaje;

			
				
                    }
                });
		
		if (estado2 == 1)
		    {
		    $(this).parent().parent().remove();
		    }
		    
		$.notify({
					    message: mensaje 
					},{
					    type: 'danger',
					    z_index: 1000000,
					    placement: {
						from: 'top',
						align: 'right'
					    },
					});	
	    }
	    else
	    {
		$(this).parent().parent().remove();
		$.notify({
					    message: "Se elimino la Actividad Correctamente"
					},{
					    type: 'danger',
					    z_index: 1000000,
					    placement: {
						from: 'top',
						align: 'right'
					    },
					});

	    }
	    
	    
        }
	
	var ver_act = verificar_actividades(<?= $id_proyecto; ?>);
	if((ver_act[0] != 0))
	   {
	    $('#warning').html(ver_act[1]);
	    $('#warning').show();
	   }

    }); 
    
    
    
    $("#actividades_row_1").click(function(){

        var error = '';
        var cantidadregistros=($('input[name=\'Proyecto[actividades_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[actividades_numero][]\']').serializeArray());
        
        for (var i=0; i<cantidadregistros; i++) {
            if(($.trim($('#proyecto-actividades_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_indicadorbid_'+(valor[i].value)).val())=='0') || ($.trim($('#proyecto-actividades_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_metas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_finicio_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_ffin_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos de la Actividad #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }

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

            $('#actividad_addr_1_'+act).html('<td>'+(act+1)+'<input type="hidden" name="Proyecto[actividades_numero][]" id="proyecto-actividades_numero_'+act+'" value="'+act+'" /></td><td class="col-xs-3"><div class="form-group field-proyecto-actividades_descripciones_'+act+' required"><input type="text" id="proyecto-actividades_descripciones_'+act+'" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder="" /></div></td><td class="col-xs-1"><div class="form-group field-proyecto-actividades_indicadorbid_'+act+' required"><select  class="form-control " id="proyecto-actividades_indicadorbid_'+act+'" name="Proyecto[actividades_indicadorbid][]" ><option value="0">--Indicador BID--</option><?php foreach($indicadorBID as $indicadorBID2){ ?> <option value="<?= $indicadorBID2->id; ?>" > <?= $indicadorBID2->descripcion ?></option>; <?php   } ?> </select></div></td><td class="col-xs-1"><div class="form-group field-proyecto-actividades_pesos_'+act+' required"><input type="text" id="proyecto-actividades_pesos_'+act+'" class="form-control entero" name="Proyecto[actividades_pesos][]" placeholder=""  /></div></td><td><div class="form-group field-proyecto-actividades_unidad_medidas_'+act+' required"><input type="text" id="proyecto-actividades_unidad_medidas_'+act+'" class="form-control" name="Proyecto[actividades_unidad_medidas][]" placeholder=""  /></div></td><td><div class="form-group field-proyecto-actividades_metas_'+act+' required"><input type="text" id="proyecto-actividades_metas_'+act+'" class="form-control entero" name="Proyecto[actividades_metas][]" placeholder=""  /></div></td><?php if($event == 2){ ?> <td class="col-xs-1"> <div class="form-group field-proyecto-actividades_ejecutado_'+act+' required"><input type="text" id="proyecto-actividades_ejecutado_'+act+'" class="form-control" name="Proyecto[actividades_ejecutado][]" placeholder=""  Disabled> </div></td>	<?php } ?><td><div id="ruta_'+act+'"></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
	    
	    
	    $('#ruta_'+act).html('<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#fechas'+act+'_" id="fechas">Fechas</button>'+
'<div class="modal fade" id="fechas'+act+'_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">'+
    '<div class="modal-dialog" role="document">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<h4 class="modal-title" id="myModalLabel">Fechas</h4>'+
            '</div><div class="modal-body"><div class="clearfix"></div>'+
                '<div class="col-xs-12 col-sm-7 col-md-12"><table class="table table-bordered table-hover" id="fechas_tabla">'+
                        '<thead><tr><th class="text-center">#</th><th class="text-center">Fecha Inicio</th>'+
				'<th class="text-center">Fecha Fin</th><th></th></tr></thead><tbody><tr>'+
					'<td>'+(act+1)+'</td><td class="col-xs-1"><div class="form-group field-proyecto-actividades_finicio_'+act+' required">'+
					'<input type="month" id="proyecto-actividades_finicio_'+act+'" class="form-control" name="Proyecto[actividades_finicio][]" placeholder="Mes" />'+
					 '</div></td><td class="col-xs-1"><div class="form-group field-proyecto-actividades_ffin_'+act+' required">'+
					'<input type="month" id="proyecto-actividades_ffin_'+act+'" class="form-control" name="Proyecto[actividades_ffin][]" placeholder="Mes" />'+
					 '</div></td><td></td></tr></tbody></table><br></div><div class="clearfix"></div></div>'+
            '<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>'+
                     '</div></div></div></div>');
	    
	    
	    
	    $('#actividades_tabla').append('<tr id="actividad_addr_1_'+(act+1)+'"></tr>');
            act++;
        }
        
        ejecutar_numeric();
        return true;
    });
    
  $("#btn_actividades").click(function(event){
	var error = '';
        var cantidadregistros=($('input[name=\'Proyecto[actividades_descripciones][]\']').length);
        var valor=($('input[name=\'Proyecto[actividades_numero][]\']').serializeArray());
        
        for (var i=0; i<cantidadregistros; i++) {
            if(($.trim($('#proyecto-actividades_descripciones_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_indicadorbid_'+(valor[i].value)).val())=='0') || ($.trim($('#proyecto-actividades_pesos_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_unidad_medidas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_metas_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_finicio_'+(valor[i].value)).val())=='') || ($.trim($('#proyecto-actividades_ffin_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos de la Actividad #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
	    
	    error=error+verificar_ejecutado(i);

        }
	
	var verf_act = verificar_peso_actividades();
	
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
	    if((verf_act!= ''))
	   {
	    $('#warning').html(verf_act);
	    $('#warning').show();
	    return false;
	   }
	   else
	   {	    
            return true;
	   }
        }
    });  
    
   function verificar_peso_actividades()
    {
      var rowCount = 0;
      var total = 0;
      var resultado = '';
      //var count_tablas=($('table[name=\'Proyecto[indicadores_tabla][]\']').length);
      
      
      
      //for (i=0;i<count_tablas;i++)
      //{
	 rowCount= parseInt($('#actividades_tabla > tbody >tr').length) -1;
	 
	 for (e=0;e<rowCount;e++) {
	    
	  total = total +  parseInt($('#proyecto-actividades_pesos_'+e).val());
	 }
	 
	 if (total != 100){
	    resultado = resultado+"<strong>¡Cuidado!</strong> EL peso de las Actividades no suman 100% <br/>";
	 }
	 
	 //total = 0;
      //}
      
      return resultado;
    }
    
    
    function avisos2() {
	
	var verf_act = verificar_peso_actividades(<?= $id_proyecto; ?>);
	var ver_act = verificar_actividades(<?= $id_proyecto; ?>);
	if ((verf_act[0] != 0) || (ver_act[0] != 0)) {
	   $('#warning').html(verf_act[1]+ver_act[1]);
	   $('#warning').show();
	}
	else
	{
	   $('#warning').hide();
	}	
	
    }
    
function verificar_actividades(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verAct ?>',
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
                    url: '<?= $verPesoAct ?>',
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

function verificar_ejecutado(tr) {
    var evento = <?= $event; ?>;
    
    if (evento == 2)
    {
	var meta = $("#proyecto-actividades_metas_"+tr);
	var ejecutado = $("#proyecto-actividades_ejecutado_"+tr);
	
	if (ejecutado.val() > meta.val())
	{
	    
	    return "<strong>¡Cuidado!</strong> La meta de la Actividad #"+(tr+1)+" no puede ser menor a lo ejecutado <br/>";
	}
    }
    
    return "";
}
</script>