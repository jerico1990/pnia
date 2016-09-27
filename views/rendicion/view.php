<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\Usuarios;
use app\models\DetalleRendicion;
use app\models\RecursoProgramado;
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css">

<script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
  
<h3>Nueva Rendición</h3>
<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
<?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'DetalleRendicion','titulo'=>'Motivo del Rechazo:','tipo'=>'1']); ?>

            <input type="hidden"  id="id" name="DetalleRendicion[id_ren]" value="<?= $rendicion->id; ?>" />
            <input type="hidden" value="" id="detallerendicion-respuesta_aprob" name="DetalleRendicion[respuesta_aprob]" /> 
            
	    <div>
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
		    <?php /*$recursos = RecursoProgramado::find()
				->select('detalle_rendicion.id as detalle_id,detalle_rendicion.fecha,detalle_rendicion.tipo_documento,detalle_rendicion.observacion_descripcion,detalle_rendicion.nro_documento,detalle_rendicion.razon_social,detalle_rendicion.ruc,objetivo_especifico.descripcion obj_des,actividad.descripcion act_des,recurso.id as recurso_id, recurso.detalle,recurso_programado.anio,recurso_programado.mes,recurso_programado.precio_unit, (recurso_programado.cantidad - recurso_programado.cant_rendida) as cantidad')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
				->innerJoin('detalle_rendicion','detalle_rendicion.id_recurso=recurso.id')
                                ->where('detalle_rendicion.id_rendicion='.$rendicion->id.' and proyecto.estado = 1 and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id',[':clasificador_id'=>$clasificador->clasificador_id])
                                ->groupBy('recurso_id,recurso.detalle,recurso_programado.anio,recurso_programado.mes')
                                ->all();*/
				
			    /*$recursos=  DetalleRendicion::find()
				->select('detalle_rendicion.*,recurso.id recurso_id,recurso.detalle,objetivo_especifico.descripcion obj_des,actividad.descripcion act_des')
                                ->innerJoin('recurso','recurso.id=detalle_rendicion.id_recurso')
				->innerJoin('maestros','maestros.id=detalle_rendicion.id_clasificador')
				->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
				->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
				->innerJoin('recurso_programado','recurso.id=recurso_programado.id_recurso')
                                ->where('proyecto.estado = 1 and aportante.tipo = 1 and recurso_programado.cantidad > 0 and recurso_programado.estado = 1 and detalle_rendicion.id_rendicion='.$rendicion->id.' and detalle_rendicion.id_clasificador = :clasificador_id',[':clasificador_id'=>$clasificador->id_clasificador])
                                ->all();*/
			    
			    $recursos=  DetalleRendicion::find()
				->select('detalle_rendicion.*,recurso.id recurso_id,recurso.detalle,objetivo_especifico.descripcion obj_des,actividad.descripcion act_des')
                                ->innerJoin('recurso','recurso.id=detalle_rendicion.id_recurso')
				->innerJoin('maestros','maestros.id=detalle_rendicion.id_clasificador')
				->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
				->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
				->innerJoin('recurso_programado','recurso.id=recurso_programado.id_recurso')
                                ->where('detalle_rendicion.id_rendicion='.$rendicion->id.' and detalle_rendicion.id_clasificador = :clasificador_id',[':clasificador_id'=>$clasificador->id_clasificador])
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
			    <input type="hidden" name="DetalleRendicion[detalle_ids][]" value="<?= $recurso->id; ?>" />
			    <input type="hidden" name="DetalleRendicion[clasificador_id][]" value="<?= $clasificador->clasificador_id ?>">
			    <input type="hidden" name="DetalleRendicion[anio][]" value="<?= $recurso->anio ?>">
			    <?php //var_dump($recurso->anio);die; ?>
			    <td><?= $i; ?></td>
			    <td>
			    <span class="popover1" data-type='html' style="cursor: pointer" data-content="Objetivo: <?= $recurso->obj_des ?><br> Actividad: <?= $recurso->act_des ?>" data-placement="top"><?= $recurso->detalle ?></span>
			    
			    <input type="hidden" name="DetalleRendicion[recursos][]" value="<?= $recurso->recurso_id ?>"></td>
			    
			    <td><?= $model->GetMes($recurso->mes) ?> <input type="hidden" name="DetalleRendicion[mes][]" value="<?= $recurso->mes ?>"></td>
			    <td><input onkeyup="calcular_total('<?= $cont.'_'.$a ?>')" type="text" id="detallerendicion-precio_unit_<?= $cont.'_'.$a ?>" class="form-control decimal" name="DetalleRendicion[precio_unit][]" placeholder="" value="<?= $recurso->precio_unit ?>" disabled /></td>
			    <td><input onkeyup="calcular_total('<?= $cont.'_'.$a ?>')" type="text" id="detallerendicion-cantidad_<?= $cont.'_'.$a ?>" class="form-control entero" name="DetalleRendicion[cantidad][]" placeholder=""  value="<?= $recurso->cantidad ?>" disabled/></td>
			    <td><input type="text" id="detallerendicion-ruc_<?= $cont.'_'.$a ?>" class="form-control entero numerico" name="DetalleRendicion[ruc][]" placeholder=""  maxlength="12" value="<?= $recurso->ruc ?>" disabled /></td>
			    <td><input type="text" id="detallerendicion-razon_social_<?= $cont.'_'.$a ?>" class="form-control texto" name="DetalleRendicion[razon_social][]" placeholder=""  value="<?= $recurso->razon_social ?>" disabled /></td>
			    <td><select class="form-control" name="DetalleRendicion[tipos_documentos][]" disabled>
				<option value></option>
				<option value=1 <?= ($recurso->tipo_documento==1)?'selected':''; ?>>Factura</option>
				<option value=2 <?= ($recurso->tipo_documento==2)?'selected':''; ?>>Boleta</option>
				<option value=3 <?= ($recurso->tipo_documento==3)?'selected':''; ?>>Planilla</option>
				<option value=4 <?= ($recurso->tipo_documento==4)?'selected':''; ?>>Otras</option>
				</select>
			    </td>
			    <td>
				<input type="text" class="numerico form-control" name="DetalleRendicion[nros_documentos][]" maxlength="20" value="<?= $recurso->nro_documento ?>" disabled>
			    </td>
			    <td>
				<input type="text" class="datepicker form-control" name="DetalleRendicion[fechas][]" value="<?= date('d-m-Y',strtotime($recurso->fecha)) ?>" disabled>
			    </td>
			    <td><input type="text" id="detallerendicion-total_<?= $cont.'_'.$a ?>" class="form-control" name="DetalleRendicion[total][]" placeholder=""  disabled value="<?= $recurso->cantidad*$recurso->precio_unit ?>"></td>
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
					<textarea class="form-control" name="DetalleRendicion[observaciones][]" maxlength="5000"><?= $recurso->observacion_descripcion ?></textarea>
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
                
                <?php
                    if($rendicion->observacion != null){
                        $datos_user = Usuarios::find()
                                        ->select('usuarios.Name,perfil.descripcion,usuarios.id_perfil')
                                            ->innerJoin('perfil','perfil.id=usuarios.id_perfil')
                                            ->where('usuarios.id=:id_user',[':id_user'=>$rendicion->id_user_obs])
                                            ->one();
                        ?>
                        <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
                    <div class="col-xs-12 col-sm-7 col-md-8" >
                            <div class="panel panel-<?= ($datos_user->id_perfil == 2) ? 'info':'danger' ?>">
                                
                                <div class="panel-heading">
                                  <h4 class="panel-title"><?= $datos_user->Name; ?>(<?= $datos_user->descripcion; ?>) - <?= $rendicion->fecha_aprobacion; ?></h4>
                                </div>
                                
                                <div class="panel-body">
                                 <?= $rendicion->observacion; ?>
                                </div>
                                
                            </div>  
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
                    
                    <?php } ?>
                
                <?php
                if(Yii::$app->user->identity->id_perfil == 2)
                {
                    ?>
                <div class="clearfix"></div><br/><br/>
                
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                <div class="col-xs-12 col-sm-7 col-md-6" >
                        <table class="table  " border=1 name="DetalleRendicion[detalle_tabla]" id="detalle_tabla" border="0">
                        <thead>
                            <tr class="info">
                                <th class="text-center" >
                                    #
                                </th>
                                <th class="text-center" >
                                    Usuario Aprobador
                                </th>
                                <th class="text-center">
                                    Estado
                                </th>
                        </thead>
                        <tbody>
                            
                            <tr class="text-center">
                                <td>1</td>
                                <td><?= $user_aprueba ?></td>
                                <td><?= $estado_aprueba ?></td>
                            </tr>
                            
                        </tbody>
                        </table>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                
                <?php } ?>
                
                <div class="clearfix"></div><br/><br/>
		<div class="col-xs-12 col-sm-7 col-md-4" ></div>
                <div class="col-xs-12 col-sm-7 col-md-8 col-centered" >
                <?php
                if(Yii::$app->user->identity->id_perfil != 2)
                {
                    if($rendicion->estado == 0){
                ?>
                    
                    <button style="" type="button" id="btnrechaza" class="btn btn-danger " data-toggle="modal" data-target="#modalobs_">Rechazar</button>  
                    <button type="submit" id="btnaceptar" class="btn btn-success ">Aceptar</button>
                    <a class="btn btn-primary" href="index?id=<?= $rendicion->id_user; ?>" role="button">Regresar</a>
                <?php }else{ ?>
                     <a class="btn btn-primary" href="index" role="button">Regresar</a>
                <?php }}else{ ?>
                
                    <a class="btn btn-primary" href="index" role="button">Regresar</a>
                <!--<button type="submit" id="btndetalle" class="btn btn-primary" >Guardar</button>-->
                
                <?php } ?>
		</div>
                

<?php ActiveForm::end(); ?>
<?php

    $obt_des_recurso= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_descripcion_recurso');
    $obt_anio_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_anio_repro');
    $obt_mes_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_mes_repro');
    $obt_precio_repro= Yii::$app->getUrlManager()->createUrl('rendicion/obtener_precio_repro');
    $ver_cantidad= Yii::$app->getUrlManager()->createUrl('rendicion/verificar_cantidad_pro');
    $ver_saldo= Yii::$app->getUrlManager()->createUrl('rendicion/verificar_saldo_desembolso');
    $eliminar_ren_det= Yii::$app->getUrlManager()->createUrl('rendicion/eliminar_rendicion_detalle');
?>            
            
<script>
var det = <?= $det ?>;
var user = <?= Yii::$app->user->identity->id ?>;
var perfil = <?= Yii::$app->user->identity->id_perfil ?>;
$( document ).ready(function() {
    
  $('#detalle_tabla th:eq(9)').hide();
$('#detalle_tabla  td:nth-child(10)').hide();  
    
 calcular_total(0);
 
 //$('#w0').find('input, textarea, select').prop('disabled', true);
    $('.hiden_cls').prop('disabled', false);
    $('#id').prop('disabled', false);
    $('#detallerendicion-respuesta_aprob').prop('disabled', false);
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
        console.log(valor);
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
            $('#detalle_addr_'+det).html('<td><input type="hidden" name="DetalleRendicion[numero][]" id="detallerendicion-numero_'+det+'" value="'+det+'" /><div class="form-group field-detallerendicion-id_clasificador_'+det+'  required "> <select onchange="descripcion('+det+')" class="form-control" id="detallerendicion-id_clasificador_'+det+'" name="DetalleRendicion[clasificador_id][]" > <option value="0" >-Seleccionar-</option> <?php foreach($clasificadores as $clasif){ ?> <option value="<?= $clasif->clasificador_id ?>" ><?= $clasif->descripcion ?></option> <?php } ?> </select></div></td><td class="col-xs-1"><div class="form-group field-detallerendicion-descripcion_'+det+'  required "><select onchange="anio('+det+')" class="form-control" id="detallerendicion-descripcion_'+det+'" name="DetalleRendicion[descripcion][]" ><option value="0" >-Seleccionar-</option> </select></div></td><td class="col-xs-1"><div class="form-group field-detallerendicion-anio_'+det+'  required "><select onchange="mes('+det+')" class="form-control" id="detallerendicion-anio_'+det+'" name="DetalleRendicion[anio][]" ><option value="0" >-Seleccionar-</option></select></div></td><td><div class="form-group field-detallerendicion-mes_'+det+'  required "><select onchange="precio_cantidad('+det+')" class="form-control" id="detallerendicion-mes_'+det+'" name="DetalleRendicion[mes][]" ><option value="0" >-Seleccionar-</option></select></div></td><td><div class="form-group field-detallerendicion-precio_unit_'+det+' required"><input onkeyup="calcular_total('+det+')" type="text" id="detallerendicion-precio_unit_'+det+'" class="form-control decimal" name="DetalleRendicion[precio_unit][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-cantidad_'+det+' required"><input onkeyup="calcular_total('+det+')" type="text" id="detallerendicion-cantidad_'+det+'" class="form-control entero" name="DetalleRendicion[cantidad][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-ruc_'+det+' required"><input type="text" id="detallerendicion-ruc_'+det+'" class="form-control entero" name="DetalleRendicion[ruc][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-razon_social_'+det+' required"><input type="text" id="detallerendicion-razon_social_'+det+'" class="form-control" name="DetalleRendicion[razon_social][]" placeholder=""  /></div></td><td><div class="form-group field-detallerendicion-total_'+det+' required"><input type="text" id="detallerendicion-total_'+det+'" class="form-control" name="DetalleRendicion[total][]" placeholder=""  Disabled></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign" ><input type="hidden" id="detalle_ids_'+det+'" name="DetalleRendicion[detalle_ids][]" value="" /></span></td>');
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
            if ($('#detalle_ids_'+(valor[i].value)).val() == '')
            {
            
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
    
    $("#btnaceptar").click(function( ) {
   
   var respuesta = confirm('Esta seguro de Aprobar este Desembolso?');
   
   if (respuesta == true) {
     
     $('#detallerendicion-respuesta_aprob').val(1);
     jsShowWindowLoad('Procesando...');
     return true;
   }
    
    return false;
    });
    
    $("#detalle_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
        var mensaje = '';
        if (r == true) {
            jsShowWindowLoad("Procesando...");
            id=$(this).children().val();
            if (id != '') {
		$.ajax({
                    url: '<?= $eliminar_ren_det ?>',
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
    $('.popover1').webuiPopover();
    
    $(document).ready(function(){
    $(".collapse").on('show.bs.collapse',function(e){
	$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
    }).on('hidden.bs.collapse', function(){
	$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
    });
    });
</script>