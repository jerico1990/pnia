<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model app\models\RegistroMeta */

$this->title = Yii::t('app', 'Registrar Meta - '.($id_tipo == 1?'Indicador':'Actividad'));


$meta = [];
$ejecutado = [];

?>
<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>

<div class="modal fade" id="modalobs_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Lista de Metas Ejecutadas</h4>
            </div>
            <div class="modal-body" id="lista_indact">
                
                
            </div>
            <div class="clearfix"></div><br/><br/>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="registro-meta-create">

    <br/><h2><?= Html::encode($this->title) ?></h2><br/><br/>
    <?php if($id_tipo == 1){ ?>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <?php } ?>
<div class="col-xs-12 col-sm-7 col-md-3" >
                <input type="hidden" name="RegistroMeta[tipo]" value="<?= $id_tipo ?>" />
                <div class="form-group field-registrometa-id_objetivo required">
                <label for="registrometa-id_objetivo">Objetivo:</label>
                <select class="form-control" id="registrometa-id_objetivo" name="RegistroMeta[id_objetivo]" >
                <?php
                            $array1 = [];
                           foreach($objetivos as $objetivo)
                            {
                                $array1[] = $objetivo->id;
                ?>
                                <option value="<?= $objetivo->id; ?>" > <?= $objetivo->descripcion ?></option>;
                    <?php    } ?>

                 
                </select>
                </div>
</div>
<div class="col-xs-12 col-sm-7 col-md-3" >
                <div class="form-group field-registrometa-id_indicador required">
                <label for="registrometa-id_indicador">Indicador:</label>
                <select class="form-control" id="registrometa-id_indicador" name="RegistroMeta[id_indicador]" >
                <?php
                            $array2 = [];
                           foreach($indicadores as $indicador)
                            {
                                if($indicador->id_oe == $array1[0])
				{
                                    $array2[] = $indicador->id;
                                    if($id_tipo == 1){
                                    $meta[] = $indicador->meta;
                                    $ejecutado[] = $indicador->ejecutado;
                                    }
                ?>
                                <option value="<?= $indicador->id; ?>" > <?= $indicador->descripcion ?></option>;
                    <?php    }} ?>

                 
                </select>
                </div>
</div>
<?php if($id_tipo == 2){ ?>
<div class="col-xs-12 col-sm-7 col-md-3" >
                <div class="form-group field-registrometa-id_actividad required">
                <label for="registrometa-id_actividad">Actividad:</label>
                <select class="form-control" id="registrometa-id_actividad" name="RegistroMeta[id_actividad]" >
                <?php
                            $array3 = [];
                           foreach($actividades as $actividad)
                            {
                                if($actividad->id_ind == $array2[0])
				{
                                    $array3[] = $actividad->id;
                                    if($id_tipo == 2){
                                    $meta[] = $actividad->meta;
                                    $ejecutado[] = $actividad->ejecutado;
                                    }
                ?>
                                <option value="<?= $actividad->id; ?>" > <?= $actividad->descripcion ?></option>;
                    <?php    }} ?>

                 
                </select>
                </div>
</div>
<?php } ?>
<div class="col-xs-12 col-sm-7 col-md-1" >
                <div class="form-group field-registrometa-meta required">
                <label for="registrometa-meta">Meta:</label>
                <input class="form-control" type="text" value="<?= $meta[0] - $ejecutado[0] ?>"  id="registrometa-meta" name="RegistroMeta[meta]"  Disabled/>
                </div>
</div>

<div class="col-xs-12 col-sm-7 col-md-2" >
    <div class="form-group field-registrometa-meta required">
    <br/><label></label>
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalobs_">
          <span class="glyphicon glyphicon-th-list"></span> List <?= ($id_tipo == 1)?'Ind.':'Act.' ?>
        </button>
    </div>
</div>
<div class="clearfix"></div>
<?php if($id_tipo == 1){ ?>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
    <?php } ?>
<div class="col-xs-12 col-sm-7 col-md-10 text-center" >
    <div class="form-group field-registrometa-meta text-left">
    <label for="registrometa"></label><br/>
<button type="button" id="btnagregar" class="btn btn-success ">Agregar</button>
    </div>
</div>

<div class="clearfix"></div><br/><br/>
                <div class="col-xs-12 col-sm-7 col-md-2"></div>
                <div class="col-xs-12 col-sm-7 col-md-8">
		   
                    <table class="table table-hover" id="ejecutado_table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                 <?= ($id_tipo == 1)?'Indicador':'Actividad' ?>
                                </th>
				<th class="text-center">
                                    Ejecutado
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            <tr id='ejecutado_addr_0'></tr>
                        </tbody>
                    </table>
                    <br/><br/>
                <div class="col-xs-12 col-sm-7 col-md-2"></div>
                <div class="clearfix"></div>
		<div class="col-xs-12 col-sm-7 col-md-1"></div>
		<div id="control_boton" class="col-xs-12 col-sm-7 col-md-6">
                <button type="submit" id="btn_guardar" class="btn btn-primary" >Guardar</button>
		</div>
		<div class="col-xs-12 col-sm-7 col-md-3"></div>
		<div class="clearfix"></div>

</div>
 <?php ActiveForm::end(); ?>
 
<?php
  $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
  $obteneractividad = Yii::$app->getUrlManager()->createUrl('proyecto/obteneractividad');
  $obtenermeta = Yii::$app->getUrlManager()->createUrl('proyecto/obtenermeta');
  $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
  $verificar_obj_ind= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_obj_ind');
  $ver_meta= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_meta');
  $cargar_lista= Yii::$app->getUrlManager()->createUrl('registrometa/cargar_lista');
  
  
?>
<script>

var tr = <?= $i ?>;
var id_tipo = <?= $id_tipo ?>;

$(document).ready(function(){ 

if (id_tipo == 1)
{
  var valor = $("#registrometa-id_indicador").val();  
}

if (id_tipo == 2)
{
  var valor = $("#registrometa-id_actividad").val();  
}

cargarLista(valor);

});
$("#registrometa-id_objetivo").change(function(){
    
     var indicador = $("#registrometa-id_indicador");
     var actividad = $("#registrometa-id_actividad");
     var meta = $("#registrometa-meta");
     var objetivo = $(this);
     var val = null;
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: false,
                    data: {id:objetivo.val()},
                    success: function(data){
                        val = jQuery.parseJSON(data);
			
                        indicador.find('option').remove();
                        indicador.append(val.option);
                        var id_indicador = indicador.val();
                        if (id_tipo == 2)
                        {
                            
                        $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:id_indicador},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
                                
                                var id_actividad = actividad.val();
                                cargarLista(id_actividad);
                                
                                $.ajax({
                                    url: '<?= $obtenermeta ?>',
                                    type: 'GET',
                                    async: false,
                                    data: {tipo:id_tipo,id:id_actividad},
                                    success: function(data){
                                        meta.val(data);
                                    }
                                }); 
                            }
                        });
                        }
                        else
                        {
                            cargarLista(id_indicador);
                           $.ajax({
			    url: '<?= $obtenermeta ?>',
			    type: 'GET',
			    async: false,
			    data: {tipo:id_tipo,id:id_indicador},
			    success: function(data){
				meta.val(data);
                            }
                        }); 
                        }
			
                    }
                });
        }
	
 });

 
 $("#registrometa-id_indicador").change(function(){
    
     var indicador = $("#registrometa-id_indicador");
     var actividad = $("#registrometa-id_actividad");
     var meta = $("#registrometa-meta");
     var objetivo = $(this);
     var val = null;
     if($(this).val() != '0')
        {
                        var id_indicador = indicador.val();
                        if (id_tipo == 2)
                        {
                        
                        $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:id_indicador},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
                                
                                var id_actividad = actividad.val();
                                cargarLista(id_actividad);
                                $.ajax({
                                    url: '<?= $obtenermeta ?>',
                                    type: 'GET',
                                    async: false,
                                    data: {tipo:id_tipo,id:id_actividad},
                                    success: function(data){
                                        meta.val(data);
                                    }
                                }); 
                            }
                        });
                        }
                        else
                        {
                            cargarLista(id_indicador);
                           $.ajax({
			    url: '<?= $obtenermeta ?>',
			    type: 'GET',
			    async: false,
			    data: {tipo:id_tipo,id:id_indicador},
			    success: function(data){
				meta.val(data);
                            }
                        }); 
                        }
			
        }
	
 });

 $("#registrometa-id_actividad").change(function(){
    
     var actividad = $("#registrometa-id_actividad");
     var meta = $("#registrometa-meta");
     var objetivo = $(this);
     var val = null;
     if($(this).val() != '0')
        {

                                var id_actividad = actividad.val();
                                cargarLista(id_actividad);
                                $.ajax({
                                    url: '<?= $obtenermeta ?>',
                                    type: 'GET',
                                    async: false,
                                    data: {tipo:id_tipo,id:id_actividad},
                                    success: function(data){
                                        meta.val(data);
                                    }
                                }); 
			
        }
	
 });
 
 
 $("#ejecutado_table").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
	//var valor = null;
        if (r == true) {
            id=$(this).children().val();
	    //alert(id);
            if (id) {
		/*$.ajax({
                    url: '<?php // $eliminaractividad ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
			
			valor = jQuery.parseJSON(data);
			estado2 = valor.estado ;
			mensaje = valor.mensaje;

			
				
                    }
                });*/
		
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
	
	//var ver_act = verificar_actividades(<?php // $id_proyecto; ?>);
	/*if((ver_act[0] != 0))
	   {
	    $('#warning').html(ver_act[1]);
	    $('#warning').show();
	   }*/

    }); 

 $('#btnagregar').click(function(){
    
    if(id_tipo == 1){
    var valor_ind = $("#registrometa-id_indicador").val();
    var desc_ind = $("#registrometa-id_indicador option:selected").html();
    }
    
    if(id_tipo == 2){
    var valor_ind = $("#registrometa-id_actividad").val();
    var desc_ind = $("#registrometa-id_actividad option:selected").html();
    }
    
    $('#ejecutado_addr_'+tr).html('<td>'+(tr+1)+'<input type="hidden" name="RegistroMeta[ejecutado_numero][]" id="registrometa-ejecutado_numero_'+tr+'" value="'+tr+'" /></td><td><input class="form-control" type="hidden" value="'+valor_ind+'"  id="registrometa-id_indact_'+tr+'" name="RegistroMeta[id_indact][]"  /><input class="form-control" type="hidden" value="'+desc_ind+'"  id="registrometa-des_indact_'+tr+'" name="RegistroMeta[des_indact][]"  /><input class="form-control" type="text" value="'+desc_ind+'"  id="registrometa-indicador_desc_'+tr+'" name="RegistroMeta[indicador_desc][]"  Disabled/></td><td><input class="form-control entero" type="text"  id="registrometa-cantidad_'+tr+'" name="RegistroMeta[cantidad][]" /></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
    $('#ejecutado_table').append('<tr id="ejecutado_addr_'+(tr+1)+'"></tr>');
    tr++;
    $('.entero').numeric(false); 
});
 

 $("#btn_guardar").click(function(event){
	jsShowWindowLoad("Procesando..");
        var array = [];
        var array1 = [];
        var array2 = [];
	var error = '';
        var cantidadregistros=($('input[name=\'RegistroMeta[id_indact][]\']').length);
        var valor=($('input[name=\'RegistroMeta[ejecutado_numero][]\']').serializeArray());
        
        for (var i=0; i<cantidadregistros; i++) {
            if(($.trim($('#registrometa-id_indact_'+(valor[i].value)).val())=='') || (($.trim($('#registrometa-cantidad_'+(valor[i].value)).val())=='') || ($.trim($('#registrometa-cantidad_'+(valor[i].value)).val()) * 1) =='0'))
            {
                error=error+'Ingrese la Meta ejecutada en el Registro #'+((parseInt(valor[i].value)) + 1)+' <br>';
               // $('.field-proyecto-descripciones_'+i).addClass('has-error');
            }
            
            
            array[i] = $('#registrometa-id_indact_'+(valor[i].value)).val();
	    
	    $.ajax({
                    url: '<?= $ver_meta ?>',
                    type: 'GET',
                    async: false,
                    data: {tipo:id_tipo,id:$('#registrometa-id_indact_'+(valor[i].value)).val(),cantidad:$.trim($('#registrometa-cantidad_'+(valor[i].value)).val())},
                    success: function(data){
                        
                        if (data == 1) {
                            error = error+'La Meta del Registro #'+((parseInt(valor[i].value)) + 1)+' es mayor a la Meta Pendiente <br/>';
                            //break;
                        }

                    }
                });
            

        }
	
	//var verf_act = verificar_peso_actividades();
        
        array1 = array;
        if(id_tipo == 1){var tipo_eje = 'Indicadores';}else{var tipo_eje = 'Actividades';}
        for (var e=0;e<array1.length;e++) {
            array2 = array.slice(0);
            //console.log(array2);
            array2.splice($.inArray(array2[e], array2), 1 );
            //array1.remove(array[e]);
            //console.log(array);
            if (array2.indexOf(array[e]) >= 0)
            {
                
                error = error+"No puede tener "+tipo_eje+" duplicados con la misma Transacción <br>";
                break;
            }
            //console.log(array);
            array2=[];
            //array2 = array;
        }
        
	
	if (error!='') {
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
 
function cargarLista(id)
{
    var popup = $("#lista_indact");
    $.ajax({
                    url: '<?= $cargar_lista ?>',
                    type: 'GET',
                    async: false,
                    data: {tipo:id_tipo,id:id},
                    success: function(data){
                        
                      popup.html(data);  

                    }
                });
}
    
</script>