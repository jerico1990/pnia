<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>


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
                                    Aporte Monetario
                                </th>
                                <th class="text-center">
                                    Aporte No Monetario
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
                                ?>
                              <td>Total:</td>
                              <td>
                                <div class="form-group field-aportante-totalmonetario required">
					    <input type="text" id="aportante-totalmonetario" class="form-control decimal"  placeholder="" value="<?= $total_monetario; ?>" disabled/>
				</div>
                              </td>
                              <td>
                                <div class="form-group field-aportante-totalnomonetario required">
					    <input type="text" id="aportante-totalnomonetario" class="form-control decimal"  placeholder="" value="<?= $total_nomonetario; ?>" disabled/>
				</div>
                              </td>
                              <td>
                                <div class="form-group field-aportante-totaltotal required">
					    <input type="text" id="aportante-totaltotal" class="form-control decimal"  placeholder="" value="<?= $total_total; ?>" disabled/>
				</div>
                              </td>
                            </tr>
                      </tfoot>
                        <tbody>
                            <?php $co=0; ?>
                            
                            <?php if($aportante12){ ?>
                            <?php foreach($aportante12 as $aportante121){?>
                            
                                    <tr id='aportante_addr_<?= $co; ?>'>
				    <td class="col-md-5">
				    <div class="form-group field-aportante-aporte_colaborador_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_colaborador_<?= $co; ?>" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="<?= $aportante121->colaborador; ?>" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_<?= $co; ?>" value="<?= $aportante121->tipo; ?>" />
                                    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_<?= $co; ?>" value="<?= $co; ?>" />
				    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante121->monetario; ?>"  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante121->no_monetario; ?>" disabled>
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
				    <td class="col-md-5">
				    <div class="form-group field-aportante-aporte_colaborador_0 required">
					    <input type="text" id="aportante-aporte_colaborador_0" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="PNIA" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_0" value="1" />
				    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_0" value="0" />
                                    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_0 required">
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_monetario_0" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""  disabled>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_0 required">
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_nomonetario_0" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  disabled>
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
					    <input onkeyup="sumatotal(1)" type="text" id="aportante-aporte_monetario_1" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_1 required">
					    <input onkeyup="sumatotal(1)" type="text" id="aportante-aporte_nomonetario_1" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  />
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
				    <td class="col-md-5">
				    <div class="form-group field-aportante-aporte_colaborador_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_colaborador_<?= $co; ?>" class="form-control " name="Aportante[aporte_colaborador][]" placeholder="" value="<?= $aportante2->colaborador; ?>" disabled>
				    </div>
                                    <input type="hidden" name="Aportante[aporte_tipo][]" id="aportante-aporte_tipo_<?= $co; ?>" value="<?= $aportante2->tipo; ?>" />
                                    <input type="hidden" name="Aportante[aporte_numero][]" id="aportante-aporte_numero_<?= $co; ?>" value="<?= $co; ?>" />
				    </td>
				    <td>
					<div class="form-group field-aportante-aporte_monetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante2->monetario; ?>"  required>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante2->no_monetario; ?>" required>
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
				
                                <tr id="aportante_addr_2">
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
				</tr>
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
    
    
    <div>
		<div class="clearfix"></div>
		<div class="col-xs-12 col-sm-7 col-md-1">
		</div>
                <div class="col-xs-12 col-sm-7 col-md-9">
                    <table class="table table-bordered table-hover" id="desembolsos_tabla" border="0" >
                        <thead>
                            <tr>
                                <th class="text-center">
                                    Desmbolso
                                </th>
                                <th class="text-center">
                                    Mes
                                </th>
				<th class="text-center">
                                    Año
                                </th>
				<th class="text-center">
                                    Monto
                                </th>
				<th class="text-center">
                                    %
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $des=0; ?>
			    <?php if($desembolsos){ ?>
				
				<?php foreach($desembolsos as $desembolso){?>
				    <tr id='desembolsos_addr_<?= $des ?>'>
					<td class="col-xs-2" >
                                            <div class="form-group field-aportante-desembolsos_nro_<?= $des ?>  required ">
						
						<select id="aportante-desembolsos_nro_<?= $des ?>" class="form-control " name="Aportante[desembolsos_nro][]" Disabled>
							    <?php

								   foreach($nro_desembolso as $nro_desembolso2)
								    {?>
									<option value="<?= $nro_desembolso2->id; ?>" <?=($nro_desembolso2->id == $desembolso->nro_desembolso)?'selected':'' ?> > <?= $nro_desembolso2->descripcion ?></option>
							    <?php    } ?>
						</select>	    
						</div>
					<input type="hidden" name="Aportante[desembolsos_numero][]" id="aportante-desembolsos_numero_<?= $des; ?>" value="<?= $des; ?>" Disabled>
                                        </td>

					<td class="col-xs-3">
					    <div class="form-group field-aportante-desembolsos_mes_<?= $des ?>  required ">
						
						<select id="aportante-desembolsos_mes_<?= $des ?>" class="form-control " name="Aportante[desembolsos_mes][]" Disabled>
							    <?php

								   foreach($meses as $mes)
								    {?>
									<option value="<?= $mes->id; ?>" <?=($mes->id == $desembolso->mes)?'selected':'' ?> > <?= $mes->descripcion ?></option>
							    <?php    } ?>
						</select>
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_anio_<?= $des ?>  required">
						<input type="text" id="aportante-desembolsos_anio_<?= $des ?>" class="form-control entero" name="Aportante[desembolsos_anio][]" placeholder="" value="<?= $desembolso->anio ?>" Disabled>
					    </div>
					</td>
					<td>
					    <div class="form-group field-aportante-desembolsos_montos_<?= $des ?> required">
						<input type="text" id="aportante-desembolsos_monto_<?= $des ?>" class="form-control decimal" name="Aportante[desembolsos_monto][]" placeholder="" value="<?= $desembolso->monto ?>" Disabled>
						<input type="hidden" id="aportante-desembolsos_montos_<?= $des ?>" class="form-control decimal" name="Aportante[desembolsos_montos][]" placeholder="" value="<?= $desembolso->monto ?>" >
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-aportante-desembolsos_porcentaje_<?= $des ?> required">
						<input onkeyup="calcularMonto(<?= $des ?>)" type="text" id="aportante-desembolsos_porcentaje_<?= $des ?>" class="form-control entero" name="Aportante[desembolsos_porcentaje][]" placeholder="" value="<?= $desembolso->porcentaje ?>" Disabled>
					    </div>
					</td>
				    </tr>
				    <?php $des++; ?>
				<?php } ?>
			    <?php }?>
				
                        </tbody>
                    </table>
                    <br>
                </div>
		<div class="col-xs-12 col-sm-7 col-md-2">
		</div>
                <div class="clearfix"></div>
            </div>

</div>
    
    
                
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

    avisos_dg(<?= $proyecto->id; ?>);
    
 if((situacion_proyecto > 0) && (evento == 1))
 {
    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('button').hide();
    
    
 }
 
 });
 
function sumatotal(posicion)
{
    var monetario = $("#aportante-aporte_monetario_"+posicion);
    var no_monetario =  $("#aportante-aporte_nomonetario_"+posicion);
    var total =  $("#aportante-aporte_total_"+posicion);
     var _total = parseFloat(getNum(monetario.val()))+parseFloat(getNum(no_monetario.val()));
     total.val(_total.toFixed(2));
     
     sumavertical();
    
}



function sumavertical()
{
    var total_monetario = 0;
    var total_no_monetario = 0;
    var total_total = 0;
    
    
    var countaportanete=$('input[name=\'Aportante[aporte_monetario][]\']').length;
    
        for (var i=0; i<countaportanete; i++) {
            
            total_monetario += parseFloat(getNum($("#aportante-aporte_monetario_"+i).val()));
            total_no_monetario +=  parseFloat(getNum($("#aportante-aporte_nomonetario_"+i).val()));
            total_total +=  parseFloat(getNum($("#aportante-aporte_total_"+i).val()));   
        }
        
        $("#aportante-totalmonetario").val(total_monetario.toFixed(2));
        $("#aportante-totalnomonetario").val(total_no_monetario.toFixed(2));
        $("#aportante-totaltotal").val(total_total.toFixed(2));
        
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