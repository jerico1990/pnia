<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\web\JsExpression;

?>


<div id="form1">
    
<div class="alert alert-danger" id="warning">
	   
</div>
<ul class="tabs">
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/modificardatosgen?id='.$proyecto->id.'&event='.$evento.'') ?>">Datos Generales</a></li>
    <li><a href="#tab2" >Financiamiento</a></li>
    <!--<li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Objetivos e Indicadores</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Actividades</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Recursos</a></li>-->
    <?php if($observaciones > 0){ ?>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/observaciones?id='.$proyecto->id.'&event='.$evento.'') ?>" >Observaciones</a></li>
    <?php } ?>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab2">
       <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>    
	<?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'Aportante','titulo'=>'Descripcion de la Modificación:','tipo'=>'0']); ?> 	
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <input type="hidden" id ="aportante-id" name="Aportante[proyecto_id]" value="<?= $proyecto->id; ?>" />
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
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante121->monetario; ?>"  disabled/>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante121->no_monetario; ?>" disabled/>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_<?= $co; ?> required">
                                            <?php //if($aportante121->total){?>
					    <input type="text" id="aportante-aporte_total_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  value="<?= $aportante121->total; ?>" disabled>
                                            <?php //}else{ ?>
                                            
                                            <?php // } ?>
					</div>
				    </td>
                                    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_<?= $co; ?>"  value="<?= $aportante121->id; ?>" />    

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
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_monetario_0" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_0 required">
					    <input onkeyup="sumatotal(0)" type="text" id="aportante-aporte_nomonetario_0" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_0 required">
					    <input type="text" id="aportante-aporte_total_0" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  disabled>
					</div>
				    </td>
				    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_0" value="" />    
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
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_1" value="" />   
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
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal aportante_monetario" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante2->monetario; ?>"  >
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal aportante_nomonetario" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante2->no_monetario; ?>" >
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_total_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  value="<?= $aportante2->total; ?>" disabled>
					</div>
				    </td>
                                    <td>
                                         
                                         <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_<?= $co; ?>" class="aportante_ids" value="<?= $aportante2->id; ?>" />   
					  
				    
				    </td>
				</tr>
                                
				    
				    <?php $co++; ?>
				<?php } ?>
			    <?php }else{ ?>
				
                                
			    <?php } ?>
                            <!--<tr id='aportante_addr_<?= $co ?>'></tr>-->
                        </tbody>
                    </table>
                    <!--<div id="aportante_row_1" class="btn btn-default pull-left" value="1">Agregar Colaborador</div>-->
                    <br>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-12" >
            <button type="submit" id="btnguardar" class="btn btn-primary pull-right">Guardar</button>   
            <button style="" type="button" id="btnobservar" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalobs_">Finalizar</button>
		</div>
    
    <!--
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
                </div>-->
	<div class="clearfix"></div>
        <div class="col-xs-12 col-sm-7 col-md-12 checkbox text-right" style="">
            <input type="checkbox" name="Aportante[cerrar_modificacion]" id="aportante-cerrar_modificacion" class="pull-right"><label><strong>He terminado de realizar mis cambios.</strong></label>
        </div>
    <?php ActiveForm::end(); ?>
    </article>
    
  </section>
  
 </div> 
    
    

<?php
    $eliminaraportante= Yii::$app->getUrlManager()->createUrl('aportante/eliminaraportante');
    $ver_aportes = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_colaborador_aporte');
?>
<script>
 
 $("#btnobservar").hide();   
var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;    
    
 var ultimo = <?= $co ?>


 $(document).ready(function(){
    
    moneda_soles("#aportante-aporte_monetario_0");
    moneda_soles("#aportante-aporte_nomonetario_0");
    moneda_soles("#aportante-aporte_monetario_1");
    moneda_soles("#aportante-aporte_nomonetario_1");
    
    avisos_dg(<?= $proyecto->id; ?>);
    
 $('ul.tabs li:nth-child(2)').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });
  
    var valor = '';
     $('#form1').find('input, textarea, select').prop('disabled', true);
    $('.aportante_ids').prop('disabled', false);
    $('.aportante_nomonetario').prop('disabled', false);
    $('.aportante_monetario').prop('disabled', false);
    
    $('#aportante-cerrar_modificacion').prop('disabled', false);
    $('#aportante-observacion').prop('disabled', false);
    var esnull =''
    $("#aportante_tabla tbody tr").each(function () {
        
         esnull = $(this).find('td:eq(3)').children().children('input').val();
        
        if (esnull == 0)
        {
            
            $(this).find('td:eq(1)').children().children('input').prop('disabled', false);
            $(this).find('td:eq(2)').children().children('input').prop('disabled', false);
	    //	$(this).find('td:eq(4)').children('input').prop('disabled', false);
        }
    });
    $('#aportante-id').prop('disabled', false);
    /*var rowCount= parseInt($('#aportante_tabla > tbody >tr').length) -1;
    alert(rowCount);
    for (e=1;e<=rowCount;e++) {
	  
         valor =  $('#aportante_tabla > tbody').find("tr:gt('"+e+"')").find('td:eq(4)').children('input').val();
	  alert(valor);
          
	 }*/
         
    //$('#aportante_tabla').find('input, textarea, select').prop('disabled', true);
    
    //$('button').hide();
    
    
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


$('#aportante-cerrar_modificacion').change(function() {
        if($(this).is(":checked")) {
            
            var ver_aportes = verificar_aportes(<?= $proyecto->id; ?>,"<?= $ver_aportes; ?>");
            
            
            if ((ver_aportes[0] != 0)) {
               $.notify({
                message: ver_aportes[1]
                },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
               $(this).attr("checked", false);
            }
            else
            {
               
               var returnVal = confirm("Esta seguro de Finalizar con el Formulario?");
                if (returnVal == true)
                {
                    $("#btnguardar").hide();
		    $("#btnobservar").show();  
		    
                }
                else
                {
                    $(this).attr("checked", false);
                }
            }   
        
            
        }
        else
        {
          $("#btnguardar").show();
	    $("#btnobservar").hide();   
        }
      
    });

    $("#btnguardar").click(function(){
	
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