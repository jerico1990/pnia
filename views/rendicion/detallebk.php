<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<h3>Nueva Rendición</h3>
<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<div >

<div>
    <div class="clearfix"></div>
    <div class="col-xs-12 col-sm-7 col-md-12">
	<table class="table borderless table-hover" name="DetalleRendicion[detalle_tabla]" id="detalle_tabla" border="0">
	    <thead>
		<tr>
		    <th class="text-center">
			Clasificador
		    </th>
		    <th class="text-center">
			Descripción
		    </th>
		    <th class="text-center">
			Año
		    </th>
		    <th class="text-center">
			Mes
		    </th>
		    <th class="text-center">
			P. Unitario
		    </th>
		    <th class="text-center">
			Cantidad
		    </th>
		    <th class="text-center">
			Ruc
		    </th>
		    <th class="text-center">
			Razón
		    </th>
		    <th class="text-center">
			Total
		    </th>
		    <th>
		    </th>
		</tr>
	    </thead>
	    <tfoot>
		<tr>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		  <td>
		    Total:
		  </td>
		  <td>
		    <div class="form-group field-aportante-totaltotal required">
				<input type="text" id="totales" class="form-control decimal"  placeholder="" value="0.00" disabled/>
		    </div>
		  </td>
		  <td></td>
		</tr>
	  </tfoot>
	    <tbody>
		<?php $det=0; ?>
		
		    <tr id='detalle_addr_0'>
			    <td>
				<input type="hidden" name="DetalleRendicion[numero][]" id="detallerendicion-numero_<?= $det; ?>" value="<?= $det; ?>" />
				<div class="form-group field-detallerendicion-id_clasificador_0  required ">
				    <select onchange="descripcion(<?= $det; ?>)" class="form-control" id="detallerendicion-id_clasificador_0" name="DetalleRendicion[clasificador_id][]" >
					<option value="0" >-Seleccionar-</option>
					<?php foreach($clasificadores as $clasif){ ?>
					    
					    <option value="<?= $clasif->clasificador_id ?>" ><?= $clasif->descripcion ?></option>
					    
					<?php } ?>
				    </select>
				</div>
				
			</td>

			    <td class="col-xs-1">
				<div class="form-group field-detallerendicion-descripcion_0  required ">
				    <select onchange="anio(<?= $det; ?>)" class="form-control" id="detallerendicion-descripcion_0" name="DetalleRendicion[descripcion][]" >
					<option value="0" >-Seleccionar-</option>
				    </select>
				</div>
			    </td>
			    <td class="col-xs-1">
				<div class="form-group field-detallerendicion-anio_0  required ">
				    <select onchange="mes(<?= $det; ?>)" class="form-control" id="detallerendicion-anio_0" name="DetalleRendicion[anio][]" >
					<option value="0" >-Seleccionar-</option>
				    </select>
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-mes_0  required ">
				    <select onchange="precio_cantidad(<?= $det; ?>)" class="form-control" id="detallerendicion-mes_0" name="DetalleRendicion[mes][]" >
					<option value="0" >-Seleccionar-</option>
				    </select>
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-precio_unit_0 required">
				    <input onkeyup="calcular_total(<?= $det; ?>)" type="text" id="detallerendicion-precio_unit_0" class="form-control decimal" name="DetalleRendicion[precio_unit][]" placeholder=""  />
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-cantidad_0 required">
				    <input onkeyup="calcular_total(<?= $det; ?>)" type="text" id="detallerendicion-cantidad_0" class="form-control entero" name="DetalleRendicion[cantidad][]" placeholder=""  />
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-ruc_0 required">
				    <input type="text" id="detallerendicion-ruc_0" class="form-control entero" name="DetalleRendicion[ruc][]" placeholder=""  />
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-razon_social_0 required">
				    <input type="text" id="detallerendicion-razon_social_0" class="form-control" name="DetalleRendicion[razon_social][]" placeholder=""  />
				</div>
			    </td>
			    <td>
				<div class="form-group field-detallerendicion-total_0 required">
				    <input type="text" id="detallerendicion-total_0" class="form-control" name="DetalleRendicion[total][]" placeholder=""  Disabled>
				</div>
			    </td>
			    <td>
				<span class="eliminar glyphicon glyphicon-minus-sign" >
				<input type="hidden" id="detalle_ids_0" name="DetalleRendicion[detalle_ids][]" value="" />
				</span>
			    </td>
		    </tr>
		    <?php $det=1; ?>
		<?php //} ?>
		<tr id='detalle_addr_<?= $det ?>'></tr>
	    </tbody>
	</table>
	<div id="agregar_registro" onclick="" class="btn btn-default pull-left btn_hide" value="1">Agregar</div>
	<br>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
	<table class="table borderless table-hover" id="detalle_tabla_archivo" border="0">
	    <thead>
		<th>Archivo</th>
		<th></th>
	    </thead>
	    <tbody>
		<?php $arc=0; ?>
		<tr>
		    <td>
			<input type="file" name="DetalleRendicion[archivos][]">
		    </td>
		    <td>
			<span class="eliminar glyphicon glyphicon-minus-sign" >
			    <input type="hidden" id="detalle_ids_0" name="DetalleRendicion[detalle_ids][]" value="" />
			</span>
		    </td>
		</tr>
		<?php $arc=1; ?>
		<tr id='archivo_addr_<?= $arc ?>'></tr>
	    </tbody>
	</table>
	<div id="agregar_registro_archivo" onclick="" class="btn btn-default pull-left btn_hide" value="1">Agregar</div>
	<br>
    </div>
    <div class="clearfix"></div><br/><br/>
    <div id="control_boton">
    <button type="submit" id="btndetalle" class="btn btn-primary" >Guardar</button>
    </div>


</div>
<?php ActiveForm::end(); ?>
<?php

    $obt_des_recurso= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_descripcion_recurso');
    $obt_anio_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_anio_repro');
    $obt_mes_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_mes_repro');
    $obt_precio_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_precio_repro');
    $ver_cantidad= Yii::$app->getUrlManager()->createUrl('rendicion/verificar_cantidad_pro');
    $ver_saldo= Yii::$app->getUrlManager()->createUrl('rendicion/verificar_saldo_desembolso');
    $obt_clasificador= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_clasificador');
?>            
            
<script>
var det = <?= $det ?>;
var arc = <?= $arc ?>;
var user = <?= Yii::$app->user->identity->id ?>;
$( document ).ready(function() {
    
    
});
    
    function descripcion(tr)
    {
       var clasificador = $("#detallerendicion-id_clasificador_"+tr);
       var descripcion = $("#detallerendicion-descripcion_"+tr);
       var anio = $("#detallerendicion-anio_"+tr);
       var mes = $("#detallerendicion-mes_"+tr);
       var pre_unit = $("#detallerendicion-precio_unit_"+tr);
       var cantidad = $("#detallerendicion-cantidad_"+tr);
       var ruc = $("#detallerendicion-ruc_"+tr);
       var razon = $("#detallerendicion-razon_social_"+tr);
       var total = $("#detallerendicion-total_"+tr);
       
        
       if(clasificador.val() != 0)
       {
        $.ajax({
                    url: '<?= $obt_des_recurso ?>',
                    type: 'GET',
                    async: true,
                    data: {clasificador:clasificador.val(),user:user},
                    success: function(data){
                        descripcion.find('option').remove();
                        descripcion.append(data);
                        //provincia.prop('disabled', false);
                        //distrito.find('option').remove();
                        //distrito.append('<option value="0">--Seleccione--</option>');
                        //distrito.prop('disabled', true);
                    }
                });
        }
        else
        {
            descripcion.find('option').remove();
            descripcion.append('<option value="0">--Seleccione--</option>');
	    //provincia.prop('disabled', true);
	    //distrito.find('option').remove();
            //distrito.append('<option value="0">--Seleccione--</option>');
            //distrito.prop('disabled', true);
        }
        
        anio.find('option').remove();
            anio.append('<option value="0">--Seleccione--</option>');
            mes.find('option').remove();
            mes.append('<option value="0">--Seleccione--</option>');
            pre_unit.val('');
            cantidad.val('');
            ruc.val('');
            razon.val('');
            total.val('');
    }
    
    
    function anio(tr)
    {
       var clasificador = $("#detallerendicion-id_clasificador_"+tr);
       var descripcion = $("#detallerendicion-descripcion_"+tr);
       var anio = $("#detallerendicion-anio_"+tr);
       var mes = $("#detallerendicion-mes_"+tr);
       var pre_unit = $("#detallerendicion-precio_unit_"+tr);
       var cantidad = $("#detallerendicion-cantidad_"+tr);
       var ruc = $("#detallerendicion-ruc_"+tr);
       var razon = $("#detallerendicion-razon_social_"+tr);
       var total = $("#detallerendicion-total_"+tr);
       
        
       if(clasificador.val() != 0)
       {
        $.ajax({
                    url: '<?= $obt_anio_repro ?>',
                    type: 'GET',
                    async: true,
                    data: {id_des:descripcion.val(),clasificador:clasificador.val(),user:user},
                    success: function(data){
                        anio.find('option').remove();
                        anio.append(data);
                        //provincia.prop('disabled', false);
                        //distrito.find('option').remove();
                        //distrito.append('<option value="0">--Seleccione--</option>');
                        //distrito.prop('disabled', true);
                    }
                });
        }
        else
        {
            anio.find('option').remove();
            anio.append('<option value="0">--Seleccione--</option>');
	    //provincia.prop('disabled', true);
	    //distrito.find('option').remove();
            //distrito.append('<option value="0">--Seleccione--</option>');
            //distrito.prop('disabled', true);
        }
        
            mes.find('option').remove();
            mes.append('<option value="0">--Seleccione--</option>');
            pre_unit.val('');
            cantidad.val('');
            ruc.val('');
            razon.val('');
            total.val('');
    }
    
    
    function mes(tr)
    {
       var clasificador = $("#detallerendicion-id_clasificador_"+tr);
       var descripcion = $("#detallerendicion-descripcion_"+tr);
       var anio = $("#detallerendicion-anio_"+tr);
       var mes = $("#detallerendicion-mes_"+tr);
       var pre_unit = $("#detallerendicion-precio_unit_"+tr);
       var cantidad = $("#detallerendicion-cantidad_"+tr);
       var ruc = $("#detallerendicion-ruc_"+tr);
       var razon = $("#detallerendicion-razon_social_"+tr);
       var total = $("#detallerendicion-total_"+tr);
       
        
       if(clasificador.val() != 0)
       {
        $.ajax({
                    url: '<?= $obt_mes_repro ?>',
                    type: 'GET',
                    async: true,
                    data: {anio:anio.val(),id_des:descripcion.val(),clasificador:clasificador.val(),user:user},
                    success: function(data){
                        mes.find('option').remove();
                        mes.append(data);
                        //provincia.prop('disabled', false);
                        //distrito.find('option').remove();
                        //distrito.append('<option value="0">--Seleccione--</option>');
                        //distrito.prop('disabled', true);
                    }
                });
        }
        else
        {
            mes.find('option').remove();
            mes.append('<option value="0">--Seleccione--</option>');
	    //provincia.prop('disabled', true);
	    //distrito.find('option').remove();
            //distrito.append('<option value="0">--Seleccione--</option>');
            //distrito.prop('disabled', true);
        }
        
            pre_unit.val('');
            cantidad.val('');
            ruc.val('');
            razon.val('');
            total.val('');
    }
    
    function precio_cantidad(tr)
    {
        var valor = '';
       var clasificador = $("#detallerendicion-id_clasificador_"+tr);
       var descripcion = $("#detallerendicion-descripcion_"+tr);
       var anio = $("#detallerendicion-anio_"+tr);
       var mes = $("#detallerendicion-mes_"+tr);
       var pre_unit = $("#detallerendicion-precio_unit_"+tr);
       var cantidad = $("#detallerendicion-cantidad_"+tr);
       var ruc = $("#detallerendicion-ruc_"+tr);
       var razon = $("#detallerendicion-razon_social_"+tr);
       var total = $("#detallerendicion-total_"+tr);
       
        
       if(clasificador.val() != 0)
       {
        $.ajax({
                    url: '<?= $obt_precio_repro ?>',
                    type: 'GET',
                    async: false,
                    data: {mes:mes.val(),anio:anio.val(),id_des:descripcion.val(),clasificador:clasificador.val(),user:user},
                    success: function(data){
                        valor = jQuery.parseJSON(data);
                        pre_unit.val(valor.precio_unit);
                        cantidad.val(valor.cantidad);
                        //provincia.prop('disabled', false);
                        //distrito.find('option').remove();
                        //distrito.append('<option value="0">--Seleccione--</option>');
                        //distrito.prop('disabled', true);
                    }
                });
        }
        else
        {
            pre_unit.val('');
            cantidad.val('');
            total.val('');
	    //provincia.prop('disabled', true);
	    //distrito.find('option').remove();
            //distrito.append('<option value="0">--Seleccione--</option>');
            //distrito.prop('disabled', true);
        }
        
            
            ruc.val('');
            razon.val('');
            calcular_total(tr);
            
    }
    
    function calcular_total(tr)
    {
        var pre_unit = $("#detallerendicion-precio_unit_"+tr);
        var cantidad = $("#detallerendicion-cantidad_"+tr);
        var total = $("#detallerendicion-total_"+tr);
        var totales = 0;
        
        
        var precio_total = getNum(pre_unit.val()) * getNum(cantidad.val());
        total.val(precio_total.toFixed(2));
        
        
        
        var clasificador=($('select[name=\'DetalleRendicion[clasificador_id][]\']').length);
        var valor=($('input[name=\'DetalleRendicion[numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++)
        {
              
                totales += parseFloat($('#detallerendicion-total_'+(valor[i].value)).val());
            
        }
        
        $("#totales").val(totales.toFixed(2));
       
    }
    
    
    $("#agregar_registro").click(function(){
	
	var error = '';
        var clasificador=($('select[name=\'DetalleRendicion[clasificador_id][]\']').length);
        var valor=($('input[name=\'DetalleRendicion[numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++) {
            if(($('#detallerendicion-id_clasificador_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-descripcion_'+(valor[i].value)).val()=='0') || ($('#proyecto-recurso_fuente_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-anio_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-mes_'+(valor[i].value)).val()=='0') || ($.trim($('#detallerendicion-precio_unit_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-cantidad_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-ruc_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-razon_social_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-total_'+(valor[i].value)).val())==''))
            {
                error=error+'Complete todos los Campos de los Registros. <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
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
	    var option = null;
	    $.ajax({
                    url: '<?= $obt_clasificador ?>',
                    type: 'GET',
                    async: false,
                    //data: {mes:mes.val(),anio:anio.val(),id_des:descripcion.val(),clasificador:clasificador.val(),user:user},
                    success: function(data){
                        option = data;
                        //provincia.prop('disabled', false);
                        //distrito.find('option').remove();
                        //distrito.append('<option value="0">--Seleccione--</option>');
                        //distrito.prop('disabled', true);
                    }
                });
	    
            $('#detalle_addr_'+det).html('<td><input type="hidden" name="DetalleRendicion[numero][]" id="detallerendicion-numero_'+det+'" value="'+det+'" /><div class="form-group field-detallerendicion-id_clasificador_'+det+'  required "> <select onchange="descripcion('+det+')" class="form-control" id="detallerendicion-id_clasificador_'+det+'" name="DetalleRendicion[clasificador_id][]" > <option value="0" >-Seleccionar-</option>'+option+' </select></div></td><td class="col-xs-1"><div class="form-group field-detallerendicion-descripcion_'+det+'  required "><select onchange="anio('+det+')" class="form-control" id="detallerendicion-descripcion_'+det+'" name="DetalleRendicion[descripcion][]" ><option value="0" >-Seleccionar-</option> </select></div></td><td class="col-xs-1"><div class="form-group field-detallerendicion-anio_'+det+'  required "><select onchange="mes('+det+')" class="form-control" id="detallerendicion-anio_'+det+'" name="DetalleRendicion[anio][]" ><option value="0" >-Seleccionar-</option></select></div></td><td><div class="form-group field-detallerendicion-mes_'+det+'  required "><select onchange="precio_cantidad('+det+')" class="form-control" id="detallerendicion-mes_'+det+'" name="DetalleRendicion[mes][]" ><option value="0" >-Seleccionar-</option></select></div></td><td><div class="form-group field-detallerendicion-precio_unit_'+det+' required"><input onkeyup="calcular_total('+det+')" type="text" id="detallerendicion-precio_unit_'+det+'" class="form-control decimal" name="DetalleRendicion[precio_unit][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-cantidad_'+det+' required"><input onkeyup="calcular_total('+det+')" type="text" id="detallerendicion-cantidad_'+det+'" class="form-control entero" name="DetalleRendicion[cantidad][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-ruc_'+det+' required"><input type="text" id="detallerendicion-ruc_'+det+'" class="form-control entero" name="DetalleRendicion[ruc][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-razon_social_'+det+' required"><input type="text" id="detallerendicion-razon_social_'+det+'" class="form-control" name="DetalleRendicion[razon_social][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-total_'+det+' required"><input type="text" id="detallerendicion-total_'+det+'" class="form-control" name="DetalleRendicion[total][]" placeholder=""  Disabled></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign" ><input type="hidden" id="detalle_ids_'+det+'" name="DetalleRendicion[detalle_ids][]" value="" /></span></td>');
            $('#detalle_tabla').append('<tr id="detalle_addr_'+(det+1)+'"></tr>');
            $('.decimal').numeric({ decimalPlaces: 2 });
            $('.entero').numeric(false); 
            det++;
        return true;
    
        }
        
        
    });
    
    
    $("#btndetalle").click(function(event){
        jsShowWindowLoad("Procesando...");
        var totales = 0;
        var array = [];
        var array1 = [];
        var array2 = [];
	var error = '';
        var clasificador=($('select[name=\'DetalleRendicion[clasificador_id][]\']').length);
        var valor=($('input[name=\'DetalleRendicion[numero][]\']').serializeArray());
        
        for (var i=0; i<clasificador; i++) {
            if(($('#detallerendicion-id_clasificador_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-descripcion_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-anio_'+(valor[i].value)).val()=='0') || ($('#detallerendicion-mes_'+(valor[i].value)).val()=='0') || ($.trim($('#detallerendicion-precio_unit_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-total_'+(valor[i].value)).val())==0) || ($.trim($('#detallerendicion-cantidad_'+(valor[i].value)).val())=='0') || ($.trim($('#detallerendicion-ruc_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-razon_social_'+(valor[i].value)).val())=='') || ($.trim($('#detallerendicion-total_'+(valor[i].value)).val())==''))
            {
                               
                error=error+'Complete todos los Campos de los Registros. <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            else
            {
                $.ajax({
                    url: '<?= $ver_cantidad ?>',
                    type: 'GET',
                    async: false,
                    data: {id_recurso:$('#detallerendicion-descripcion_'+(valor[i].value)).val(),mes:$('#detallerendicion-mes_'+(valor[i].value)).val(),anio:$('#detallerendicion-anio_'+(valor[i].value)).val(),cant:$.trim($('#detallerendicion-cantidad_'+(valor[i].value)).val())},
                    success: function(data){
                        
                        if (data == 1) {
                            error = error+'La cantidad del Registro #'+((parseInt(valor[i].value)) + 1)+' es mayor a lo pendiente por rendir. <br>';
                            //break;
                        }

                    }
                });
                
                totales += parseFloat($('#detallerendicion-total_'+(valor[i].value)).val());
                array[i] = $('#detallerendicion-descripcion_'+(valor[i].value)).val()+$('#detallerendicion-anio_'+(valor[i].value)).val()+$('#detallerendicion-mes_'+(valor[i].value)).val();
                //array1[i] = $('#detallerendicion-anio_'+(valor[i].value)).val();
                //array2[i] = $('#detallerendicion-mes_'+(valor[i].value)).val();
               // $('.field-proyecto-descripciones_'+i).addClass('has-success');
               // $('.field-proyecto-descripciones_'+i).removeClass('has-error');
            }
        }
       
       
       console.log(totales);
        $.ajax({
                    url: '<?= $ver_saldo ?>',
                    type: 'GET',
                    async: false,
                    data: {monto:totales,id_user:user},
                    success: function(data){
                        var valor = jQuery.parseJSON(data);
                        console.log(valor.estado);
                        if (valor.estado == 1) {
                            error = error+valor.mensaje;
                            //break;
                        }

                    }
                });
	
        array1 = array;
        for (var e=0;e<array1.length;e++) {
            array2 = array.slice(0);
            //console.log(array2);
            array2.splice($.inArray(array2[e], array2), 1 );
            //array1.remove(array[e]);
            //console.log(array);
            if (array2.indexOf(array[e]) >= 0)
            {
                error = error+"No puede tener Recursos duplicados con el mismo programa <br>";
                break;
            }
            //console.log(array);
            array2=[];
            //array2 = array;
        }
        
        
        
	//return false;
	if (error != '') {
            
            jsRemoveWindowLoad();
	    
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
        return true;
    
        }
    });
    
    
    $("#detalle_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
        var mensaje = '';
        if (r == true) {
            jsShowWindowLoad("Procesando...");
            id=$(this).children().val();
            if (id != '') {
		/*$.ajax({
                    url: '<?php // $eliminarrecurso ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			
                        mensaje = data;
                    }
                });
		$(this).parent().parent().remove();*/	
	    }
	    else
	    {
		$(this).parent().parent().remove();
                
                mensaje = "Se elimino el Registro Correctamente";
	    }
            jsRemoveWindowLoad();
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
    });
    
    
    $("#detalle_tabla_archivo").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
        var mensaje = '';
        if (r == true) {
            jsShowWindowLoad("Procesando...");
            id=$(this).children().val();
            if (id != '') {
	    }
	    else
	    {
		$(this).parent().parent().remove();
                
                mensaje = "Se elimino el Registro Correctamente";
	    }
            jsRemoveWindowLoad();
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
    });
    
    
    $("#agregar_registro_archivo").click(function(){
	
	var error = '';
	
	
	if (error != '') {
	    
	    
            return false;
	}
	else
        {
	    var option = null;
            $('#archivo_addr_'+arc).html(
					    '<td>'+
						'<input type="file" name="DetalleRendicion[archivos][]">'+
					    '</td>'+
					    '<td>'+
						'<span class="eliminar glyphicon glyphicon-minus-sign" >'+
						    '<input type="hidden" id="detalle_ids_'+arc+'" name="DetalleRendicion[detalle_ids][]" value="" />'+
						'</span>'+
					    '</td>');
            $('#detalle_tabla_archivo').append('<tr id="archivo_addr_'+(arc+1)+'"></tr>');
            arc++;
        return true;
    
        }
        
        
    });
</script>