<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\RecursoProgramado;
?>
    
    
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css">

<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
  
<h3>Nueva Rendición</h3>
<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
<div >

<div>
    <div class="clearfix"></div>
    <div class="col-md-12">
	<div id="detalle">
	    
	</div>
    </div>
    <div class="clearfix"></div>
    <div class="panel-group" id="accordion">
	<?php $cont=0; ?>
	<?php $b=0; ?>
	<?php foreach($clasificadores as $clasificador){ ?>
	<div class="panel panel-primary">
	    <div class="panel-heading">
		<div class="col-md-1">
		    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $cont ?>" aria-expanded="false">
			<span style="color:black" class="glyphicon glyphicon-plus"></span>
		    </a>
		</div>
		<div class="col-md-8">
		    <?= $clasificador->descripcion ?>
		    <input type="hidden" name="">
		</div>
		<div class="clearfix"></div>
	    </div>
	    <div id="collapse<?= $cont ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
		<div class="panel-body">
		    <?php $recursos = RecursoProgramado::find()
                        ->select('objetivo_especifico.descripcion obj_des,actividad.descripcion act_des,recurso.id as recurso_id, recurso.detalle,recurso_programado.anio,recurso_programado.mes,recurso_programado.precio_unit, (recurso_programado.cantidad - recurso_programado.cant_rendida) as cantidad')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id',[':user_propietario'=>Yii::$app->user->identity->id,':clasificador_id'=>$clasificador->clasificador_id])
                                ->groupBy('recurso_id,recurso.detalle,recurso_programado.anio,recurso_programado.mes')
                                ->all();
		    ?>
		    <table class="table borderless table-hover">
			<thead>
			    <th>#</th>
			    <th>Recurso</th>
			    <th>Mes</th>
			    <th>P. Unitario</th>
			    <th>Cantidad</th>
			    <th>Ruc</th>
			    <th>Razón</th>
			    <th>Tipo de documento</th>
			    <th>Nro de documento</th>
			    <th>Fecha</th>
			    <th>Total</th>
			    <th>Obervación</th>
			</thead>
			
		    <?php $a=0; ?>
		    <?php $i=1+$b; ?>
		    <?php foreach($recursos as $recurso){ ?>
			<tr>
			    <input type="hidden" name="DetalleRendicion[clasificador_id][]" value="<?= $clasificador->clasificador_id ?>">
			    <input type="hidden" name="DetalleRendicion[anio][]" value="<?= $recurso->anio ?>">
			    <td><?= $i; ?></td>
			    <td>
			    <span class="popover1" data-type='html' style="cursor: pointer" data-content="Objetivo: <?= $recurso->obj_des ?><br> Actividad: <?= $recurso->act_des ?>" data-placement="top"><?= $recurso->detalle ?></span>
			    
			    <input type="hidden" name="DetalleRendicion[recursos][]" value="<?= $recurso->recurso_id ?>"></td>
			    
			    <td><?= $model->GetMes($recurso->mes) ?> <input type="hidden" name="DetalleRendicion[mes][]" value="<?= $recurso->mes ?>"></td>
			    <td><input onkeyup="calcular_total('<?= $cont.'_'.$a ?>')" type="text" id="detallerendicion-precio_unit_<?= $cont.'_'.$a ?>" class="form-control decimal" name="DetalleRendicion[precio_unit][]" placeholder="" value="<?= $recurso->precio_unit ?>" /></td>
			    <td><input onkeyup="calcular_total('<?= $cont.'_'.$a ?>')" type="text" id="detallerendicion-cantidad_<?= $cont.'_'.$a ?>" class="form-control entero" name="DetalleRendicion[cantidad][]" placeholder=""  value="<?= $recurso->cantidad ?>"/></td>
			    <td><input type="text" id="detallerendicion-ruc_<?= $cont.'_'.$a ?>" class="form-control entero numerico" name="DetalleRendicion[ruc][]" placeholder=""  maxlength="12"/></td>
			    <td><input type="text" id="detallerendicion-razon_social_<?= $cont.'_'.$a ?>" class="form-control texto" name="DetalleRendicion[razon_social][]" placeholder=""  /></td>
			    <td><select class="form-control" name="DetalleRendicion[tipos_documentos][]">
				<option value></option>
				<option value=1>Factura</option>
				<option value=2>Boleta</option>
				<option value=3>Planilla</option>
				<option value=4>Otras</option>
				</select>
			    </td>
			    <td>
				<input type="text" class="numerico form-control" name="DetalleRendicion[nros_documentos][]" maxlength="20">
			    </td>
			    <td>
				<input type="text" class="datepicker form-control" name="DetalleRendicion[fechas][]">
			    </td>
			    <td><input type="text" id="detallerendicion-total_<?= $cont.'_'.$a ?>" class="form-control" name="DetalleRendicion[total][]" placeholder=""  Disabled value="<?= $recurso->cantidad*$recurso->precio_unit ?>"></td>
			    <td>
				<!-- Button trigger modal -->
				<span style="cursor: pointer" class="glyphicon glyphicon-list-alt" data-toggle="modal" data-target="#myModal<?= $i?>"></span>
				
				<!-- Modal -->
				<div class="modal fade" id="myModal<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Observación</h4>
				      </div>
				      <div class="modal-body">
					<textarea class="form-control" name="DetalleRendicion[observaciones][]" maxlength="5000"></textarea>
				      </div>
				    </div>
				  </div>
				</div>
			    </td>
			</tr>
			<?php $a++; ?>
			<?php $b=$i;?>
			<?php $i++; ?>
			
		    <?php } ?>
		    
		    </table>
		</div>
	    </div>
	</div>
	<?php $cont++ ;?>
	
	<?php } ?>
    </div>
    
    <?php $det=1;?>
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
	<div id="agregar_registro_archivo" onclick="" class="btn btn-default pull-left btn_hide" value="1">Agregar archivo</div>
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
    
    
    $getRecurso= Yii::$app->getUrlManager()->createUrl('rendicion/get-recurso');
?>            
            
<script>
var det = <?= $det ?>;
var arc = <?= $arc ?>;
var user = <?= Yii::$app->user->identity->id ?>;
$( document ).ready(function() {
    
    
});
    function GetRecurso(clasificador)
    {
       if(clasificador != 0)
       {
        $.ajax({
                    url: '<?= $getRecurso ?>',
                    type: 'GET',
                    async: true,
                    data: {clasificador:clasificador,user:user},
                    success: function(data){
                        $("#detalle").html(data);
                        $('.numerico').keypress(function (e) {
			    tecla = (document.all) ? e.keyCode : e.which; // 2
			    if (tecla==8) return true; // 3
			    var reg = /^[0-9\s]+$/;
			    te = String.fromCharCode(tecla); // 5
			    return reg.test(te); // 6
				    
			});		
			    
			$('.texto').keypress(function(e) {
			    tecla = (document.all) ? e.keyCode : e.which; // 2
			    if (tecla==8) return true; // 3
			    var reg = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ'_\s]+$/;
			    te = String.fromCharCode(tecla); // 5
			    return reg.test(te); // 6
			});
                    }
                });
        }
    }
    
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
    
    $('.numerico').keypress(function (e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if (tecla==8) return true; // 3
        var reg = /^[0-9\s]+$/;
        te = String.fromCharCode(tecla); // 5
	return reg.test(te); // 6
		
    });		
	
    $('.texto').keypress(function(e) {
	tecla = (document.all) ? e.keyCode : e.which; // 2
	if (tecla==8) return true; // 3
        var reg = /^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ'_\s]+$/;
        te = String.fromCharCode(tecla); // 5
	return reg.test(te); // 6
    });
    $(document).ready(function(){
    $(".collapse").on('show.bs.collapse',function(e){
	$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hidden.bs.collapse', function(){
	$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });
    });
    $.datepicker.regional['es'] = {
      changeMonth: true,
      changeYear: true,
      closeText: 'Cerrar',
      prevText: 'Previo',
      nextText: 'Próximo',
      monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
      'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
      'Jul','Ago','Sep','Oct','Nov','Dic'],
      monthStatus: 'Ver otro mes',
      yearRange: '2014:2020',
      yearStatus: 'Ver otro año',
      dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
      dateFormat: 'dd/mm/yy', firstDay: 0,
      initStatus: 'Selecciona la fecha', isRTL: false};
      $.datepicker.setDefaults($.datepicker.regional['es']);
      
      
    $( ".datepicker" ).datepicker();
    
    $('.popover1').webuiPopover();
</script>