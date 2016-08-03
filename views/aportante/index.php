<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>

<style>
input { 
    text-align: right; 
}    
    
</style>

<div id="form1">

	<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div>
                
            <h3><strong>    Mi Proyecto | </strong><span style=" font-size: medium">Financiamiento</span></h3>
            
            </div>
            <div class="alert alert-danger" id="warning">
	   
            </div>
		
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <input type="hidden" name="Aportante[proyecto_id]" value="<?= $proyecto_id; ?>" />
                    <table class="table table-hover" id="aportante_tabla">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    
                                </th>
                                <th class="text-center">
                                    Aporte Monetario (S/.)
                                </th>
                                <th class="text-center">
                                    Aporte No Monetario (S/.)
                                </th>
                                <th class="text-center">
                                    Total (S/.)
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                               <?php
                                $total_monetario = 0.00;
                                $total_nomonetario = 0.00;
                                $total_total = 0.00;
                                if($aportante)
                                {
                                    foreach($aportante as $aportantetotal)
                                    {
                                        $total_monetario += $aportantetotal->monetario;
                                        $total_nomonetario += $aportantetotal->no_monetario;
                                        $total_total += $aportantetotal->total;
                                    }
                                }
                                else
                                {
                                 $total_monetario = '0.00';
                                $total_nomonetario = '0.00';
                                $total_total = '0.00';   
                                }
                                ?>
                              <td>Total:</td>
                              <td>
                                <div class="form-group field-aportante-totalmonetario required">
					    <strong><input type="text" id="aportante-totalmonetario" class="form-control decimal"  placeholder="" value="<?= $total_monetario; ?>" disabled/></strong>
				</div>
                              </td>
                              <td>
                                <div class="form-group field-aportante-totalnomonetario required">
					<strong><input type="text" id="aportante-totalnomonetario" class="form-control decimal"  placeholder="" value="<?= $total_nomonetario; ?>" disabled/></strong>
				</div>
                              </td>
                              <td>
                                <div class="form-group field-aportante-totaltotal required">
					    <strong><input type="text" id="aportante-totaltotal" class="form-control decimal"  placeholder="" value="<?= $total_total; ?>" disabled/></strong>
				</div>
                              </td>
                            </tr>
                      </tfoot>
                        <tbody>
                            <?php $co=0; ?>
                            
                            <?php if($aportante12){ ?>
                            <?php foreach($aportante12 as $aportante121){?>
                            
                                    <tr id='aportante_addr_<?= $co; ?>'>
				    <td class="col-md-4">
				    <div class="form-group field-aportante-aporte_colaborador_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_colaborador_<?= $co; ?>" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="<?= $aportante121->colaborador; ?>" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_<?= $co; ?>" value="<?= $aportante121->tipo; ?>" />
                                    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_<?= $co; ?>" value="<?= $co; ?>" />
				    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" onload="convertSoles(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" autocomplete="off" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante121->monetario; ?>"  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" autocomplete="off" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante121->no_monetario; ?>" disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_total_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  value="<?= $aportante121->total; ?>" disabled>
					</div>
				    </td>
                                    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_<?= $co; ?>" value="<?= $aportante121->id; ?>" disabled>    

				    </td>
				</tr>
                            
                            <?php $co++; ?>
				<?php } ?>
			    <?php }else{ ?>
                            
                                    <tr id='aportante_addr_0'>
				    <td class="col-md-4">
				    <div class="form-group field-aportante-aporte_colaborador_0 required">
					    <input type="text" id="aportante-aporte_colaborador_0" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="PNIA" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_0" value="1" />
				    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_0" value="0" />
                                    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_0 required">
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_monetario_0" autocomplete="off" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_0 required">
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_nomonetario_0" autocomplete="off" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_0 required">
					    <input type="text" id="aportante-aporte_total_0" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  disabled>
					</div>
				    </td>
				    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_0" value="" disabled>    
				    </td>
				</tr>
                                <tr id='aportante_addr_1'>
				    <td>
				    <div class="form-group field-aportante-aporte_colaborador_1 required">
					    <input type="text" id="aportante-aporte_colaborador_1" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="INIA" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_1" value="2" />
				    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_1" value="1" />
                                    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_1 required">
					    <input onkeyup="sumatotal(1)" type="text" id="aportante-aporte_monetario_1" class="form-control decimal" autocomplete="off" name="Aportante[aporte_monetario][]" placeholder=""  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_1 required">
					    <input onkeyup="sumatotal(1)" type="text" id="aportante-aporte_nomonetario_1" class="form-control decimal" autocomplete="off" name="Aportante[aporte_nomonetario][]" placeholder="" disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_1 required">
					    <input type="text" id="aportante-aporte_total_1" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  disabled>
					</div>
				    </td>
				    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_1" value="" disabled>   
				    </td>
				</tr>
                            
                            <?php $co=2; ?>
			    <?php } ?>
                            
                            
                            
			    <?php if($aportante3){ ?>
                            
                                
				
				<?php foreach($aportante3 as $aportante2){?>
                                
                                <tr id='aportante_addr_<?= $co; ?>'>
				    <td class="col-md-4">
				    <div class="form-group field-aportante-aporte_colaborador_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_colaborador_<?= $co; ?>" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="<?= $aportante2->colaborador; ?>" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_<?= $co; ?>" value="<?= $aportante2->tipo; ?>" />
                                    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_<?= $co; ?>" value="<?= $co; ?>" />
				    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" autocomplete="off" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante2->monetario; ?>"  required>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" autocomplete="off" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante2->no_monetario; ?>" required>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_total_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  value="<?= $aportante2->total; ?>" disabled>
					</div>
				    </td>
                                    <td>
                                         
                                         <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_<?= $co; ?>" value="<?= $aportante2->id; ?>" />   
					  
				    
				    </td>
				</tr>
                                
				    
				    <?php $co++; ?>
				<?php } ?>
			    <?php }else{ ?>
				
                               <!-- <tr id="aportante_addr_2">
				    <td>
				    <div class="form-group field-aportante-aporte_colaborador_2 required">
					    <input type="text" id="aportante-aporte_colaborador_2" class="form-control " name="Aportante[aporte_colaborador][]" placeholder=""  disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_2" value="3" />
				    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_2" value="2" />
                                    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_2 required">
					    <input onkeyup="sumatotal(2)" type="text" id="aportante-aporte_monetario_2" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_2 required">
					    <input onkeyup="sumatotal(2)" type="text" id="aportante-aporte_nomonetario_2" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_2 required">
					    <input type="text" id="aportante-aporte_total_2" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  disabled>
					</div>
				    </td>
				    <td>
					<input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_3" value="" />   
				    </td>
				</tr>-->
				<?php $co=3; ?>
			    <?php } ?>
                            <tr id='aportante_addr_<?= $co ?>'></tr>
                        </tbody>
                    </table>
                    <!--<div id="aportante_row_1" class="btn btn-default pull-left" value="1">Agregar Colaborador</div>-->
                    <br>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-12" >
            <button type="submit" id="btnproyecto" class="btn btn-primary pull-right">Guardar</button>   
            </div>
                <div class="clearfix"></div><br/><br/>
    
    
    
    
    
                
 <?php ActiveForm::end(); ?>
</div>
<?php
    $eliminaraportante= Yii::$app->getUrlManager()->createUrl('aportante/eliminaraportante');
    $ver_aportes = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_colaborador_aporte');
?>
<script>
var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;    
    
 var ultimo = <?= $co ?>


 $(document).ready(function(){ 
    
    moneda_soles("#aportante-aporte_monetario_0");
    moneda_soles("#aportante-aporte_nomonetario_0");
    moneda_soles("#aportante-aporte_monetario_1");
    moneda_soles("#aportante-aporte_nomonetario_1");
    
    avisos_dg(<?= $proyecto->id; ?>);
    
 if((situacion_proyecto > 0) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('button').hide();
    
    
 }
 
 var count = $('input[name=\'Aportante[aporte_total][]\']').length;
 
 for (var i =0;i<count;i++) {
    
    var total = $("#aportante-aporte_total_"+i);
    if (total.val() == '') {
        total.val(parseFloat(0).toFixed(2));
    }

    
    
    moneda_soles("#aportante-aporte_total_"+i);
    
 }
 
    var totalmonetario =  $("#aportante-totalmonetario");
    var totalnomonetario =  $("#aportante-totalnomonetario");
    var totaltotal =  $("#aportante-totaltotal");
    
    var tmonetario = totalmonetario.val();
    var tnomonetario = totalnomonetario.val();
    var ttotal = totaltotal.val();

    totalmonetario.val(parseFloat(tmonetario).toFixed(2));
    totalnomonetario.val(parseFloat(tnomonetario).toFixed(2));
    totaltotal.val(parseFloat(ttotal).toFixed(2));
    
        moneda_soles("#aportante-totalmonetario");
        moneda_soles("#aportante-totalnomonetario");
        moneda_soles("#aportante-totaltotal");
 
 });
 
function sumatotal(posicion)
{
    var monetario = $("#aportante-aporte_monetario_"+posicion);
    var no_monetario =  $("#aportante-aporte_nomonetario_"+posicion);
    var total =  $("#aportante-aporte_total_"+posicion);
    
     var _total = parseFloat(getNum(monetario.val()))+parseFloat(getNum(no_monetario.val()));
     total.val(_total.toFixed(2));
     moneda_soles("#aportante-aporte_total_"+posicion);
     sumavertical();
    
}



function sumavertical()
{
    var total_monetario = 0;
    var total_no_monetario = 0;
    var total_total = 0.00;
    var no_monetario = '';
    var monetario = '';
    
    var countaportanete=$('input[name=\'Aportante[aporte_monetario][]\']').length;
    
        for (var i=0; i<countaportanete; i++) {
            no_monetario = $("#aportante-aporte_nomonetario_"+i).val();
            monetario =  $("#aportante-aporte_monetario_"+i).val();
            no_monetario = no_monetario.replace("S/. ","");
            monetario = monetario.replace("S/. ","");
            no_monetario = getNum(no_monetario.replace(",",""));
            monetario = getNum(monetario.replace(",",""));
            
            //alert(getNum(parseFloat(monetario)));break;
            
            total_monetario += getNum(parseFloat(monetario));
            total_no_monetario +=  getNum(parseFloat(no_monetario));
            
        }
        total_total +=  parseFloat(parseFloat(total_monetario)+parseFloat(total_no_monetario));
        //alert(total_total);
        $("#aportante-totalmonetario").val(total_monetario.toFixed(2));
        $("#aportante-totalnomonetario").val(total_no_monetario.toFixed(2));
        $("#aportante-totaltotal").val(total_total.toFixed(2));
        moneda_soles("#aportante-totalmonetario");
        moneda_soles("#aportante-totalnomonetario");
        moneda_soles("#aportante-totaltotal");
        
}

   // var co = <?= $co ?>;
 
 
    $("#aportante_row_1").click(function(){

        var error = '';
        var contar_col = 0;
        var countaportanete=$('input[name=\'Aportante[aporte_monetario][]\']').length;
        var valor=($('input[name=\'Aportante[aporte_numero][]\']').serializeArray());
        var tipo=($('input[name=\'Aportante[aporte_tipo][]\']').serializeArray());
        
        
        for (var i=0; i<countaportanete; i++)
        {
                if(tipo[i].value == '3')
                {
                    contar_col++;
                }
        }
        
        console.log(contar_col);
        /*for (var i=0; i<countaportanete; i++) {
            if(($.trim($('#Aportante-aporte_colaborador_'+(valor[i].value)).val())=='') || ($.trim($('#Aportante-aporte_monetario_'+(valor[i].value)).val())=='') || ($.trim($('#Aportante-aporte_nomonetario_'+(valor[i].value)).val())=='') )
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
        {*/
            if (contar_col == 3) {
                error = "Solo se Permite Ingresar 3 Colaboradores como Maximo."
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
            else{
            $('#aportante_addr_'+ultimo).html('<td class="col-md-5"><div class="form-group field-aportante-aporte_colaborador_'+ultimo+' required"><input type="text" id="aportante-aporte_colaborador_'+ultimo+'" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" /></div><input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_'+ultimo+'" value="3" /><input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_'+ultimo+'" value="'+ultimo+'" /></td><td><div class="form-group field-aportante-aporte_monetario_'+ultimo+' required"><input onkeyup="sumatotal('+ultimo+')" type="text" id="aportante-aporte_monetario_'+ultimo+'" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""   /></div></td><td><div class="form-group field-aportante-aporte_nomonetario_'+ultimo+' required"><input onkeyup="sumatotal('+ultimo+')" type="text" id="aportante-aporte_nomonetario_'+ultimo+'" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  /></div></td><td><div class="form-group field-aportante-aporte_total_'+ultimo+' required"><input type="text" id="aportante-aporte_total_'+ultimo+'" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""   disabled></div></td><td><span class="eliminar glyphicon glyphicon-minus-sign"></span></td>');
	    $('#aportante_tabla').append('<tr id="aportante_addr_'+(ultimo+1)+'"></tr>');
            ultimo++;
            }
            
         //   act++;
       // }
        
        
        return true;
    });
    
   $("#aportante_tabla").on('click','.eliminar',function(){
        var r = confirm("Estas seguro de Eliminar?");
	var mensaje = '';
	var estado2 = 0;
	var valor = null;
        if (r == true) {
            id=$(this).children().val();
            if (id) {
		$.ajax({
                    url: '<?= $eliminaraportante ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			 valor = jQuery.parseJSON(data);
			estado2 = valor.estado ;
			mensaje = valor.mensaje;

                        
                    }
                });
		
		if (estado2 == 1)
		    {
		    $(this).parent().parent().remove();
		    }
	    }
	    else
	    {
		$(this).parent().parent().remove();
		
		mensaje = "Se elimino el Colaborador Correctamente";
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
    });
   
  function avisos_dg(id)
{
  var ver_aportes = verificar_aportes(id,"<?= $ver_aportes; ?>");
  if(ver_aportes[0] != 0){
    
	$('#warning').html(ver_aportes[1]);
	$('#warning').show();
    }
    else
    {
	$('#warning').hide();
    }

}


$("#btnproyecto").click(function(){
	
	var error = '';
        var count = $('input[name=\'Aportante[aporte_total][]\']').length;
        
	for (var i=0; i<count; i++)
	{
	  if($('#aportante-aporte_total_'+i).val()==0)
	     {
		error = error+"<strong>¡Cuidado! </strong> El aportante <strong>"+$("#aportante-aporte_colaborador_"+i).val()+" </strong>no tiene asignado ningún aporte.<br/>";
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
                    align: 'left'
                },
            });
            return false;
        }
	jsShowWindowLoad('Procesando nueva Modificación...');
        return true;
    });

 /*    $("#colcaborador_row_1").click(function(){
        console.log(co);
        
       // var objetivo=$('input[name=\'Proyecto[descripciones][]\']').length;

        if(($('#proyecto-nombresc_'+(co-1)).val()!=''))
        {
		if (($('#proyecto-apellidosc_'+(co-1)).val()!=''))
		{
			if (($('#proyecto-funcionesc_'+(co-1)).val()!=''))
			{
				$('#colaborador_addr_1_'+co).html("<td>"+(co+1)+"</td><td><div class='form-group field-proyecto-nombresc_"+co+" required'> <input type='text' id='proyecto-nombresc_"+co+"' class='form-control' name='Proyecto[nombresc][]' placeholder='Nombres #"+(co+1)+"'  /></div></td><td><div class='form-group field-proyecto-aapellidosc_"+co+" required'><input type='text' id='proyecto-apellidosc_"+co+"' class='form-control' name='Proyecto[apellidosc][]' placeholder='Apellidos #"+(co+1)+"'  /></div></td><td><div class='form-group field-proyecto-funcionesc_"+co+" required'><input type='text' id='proyecto-funcionesc_"+co+"' class='form-control' name='Proyecto[funcionesc][]' placeholder='Función #"+(co+1)+"'  /></div></td><td><span class='eliminar glyphicon glyphicon-minus-sign'></span></td>");
				$('#colaboradores_tabla').append('<tr id="colaborador_addr_1_'+(co+1)+'"></tr>');
				co++;			
			}
			else
			{
				var error='Complete todos los Campos del Colaborador #'+co+' <br>';
					//$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
			    
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
			
		}
		else
		{
			var error='Complete todos los Campos del Colaborador #'+co+' <br>';
			//$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');
	    
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
            
            
        }
        else
        {
           var error='Complete todos los Campos del Colaborador #'+co+' <br>';
            //$('.field-proyecto-objetivos_descripciones_'+(oe-1)).addClass('has-error');

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
        
        
        return true;
    });
/*    
    $("#btn_colaboradores").click(function(event){
	var error='';
        var objetivo1=$('input[name=\'Proyecto[nombresc][]\']').length;
        for (var i=0; i<objetivo1; i++) {
            if(($('#proyecto-nombresc_'+i).val()=='') && ($('#proyecto-apellidosc_'+i).val()=='') && ($('#proyecto-funcionesc_'+i).val()==''))
            {
                error=error+'Complete todos los Campos del Colaborador #'+(i+1)+' <br>';
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
    
    
    $("#proyecto-colaboradores").click(function( ) {
	var id='<?php // $proyecto_id ?>';
	console.log(id);
	if (id=='') {
	    $.notify({
                message: 'No existe Proyecto Registrado.'
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
    });*/
</script>