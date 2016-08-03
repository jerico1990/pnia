
<?php if($recursos){ ?>
<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#programado_<?= $correlativo ?>_<?= $re ?>_" id="btn_programado" onclick="cargartitulos(<?= $correlativo ?>, <?= $re ?>)">Detalle</button>

<div class="modal fade bs-example-modal-lg" id="programado_<?= $correlativo ?>_<?= $re ?>_" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle <?= ($re+1) ?></h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                   <label>Objetivo: <span id="obj_programado_<?= $correlativo ?>_<?= $re ?>"></span></label> 
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                    <label>Indicador: <span id="ind_programado_<?= $correlativo ?>_<?= $re ?>"></span></label> 
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                    <label>Actividad: <span id="act_programado_<?= $correlativo ?>_<?= $re ?>"></span></label> 
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-xs-12 col-sm-7 col-md-3">
                    <label>Año</label>
		    <?php
			if(fmod($vigencia,12) == 0)
			    {
				$años[$re] = (int)($vigencia/12);
				$meses[$re] = 12;
			    }
			    else
			    {
				$años[$re] = intval(($vigencia/12));
				
				$meses[$re] = $vigencia -($años[$re]*12);
			    }
		    ?>
                    <select onchange="cargaranio(<?= $correlativo ?>,<?= $re ?>,<?= $años[$re] ?>,<?= $meses[$re] ?>)" id="proyecto-programa_anio_<?= $correlativo ?>_<?= $re ?>" class="form-control" name="Proyecto[programa_anio]">
		    <?php
			    
			if($años[$re] > 0)
			{
			for($i=1;$i<=$años[$re];$i++)
			{
			    switch ($i) {
					    case 1:
						echo '<option value="1" selected>2016</option>';
						break;
					    case 2:
						echo '<option value="2" >2017</option>';
						break;
					    case 3:
						echo '<option value="3" >2018</option>';
						break;
					}

			}
			    if($meses[$re] != 12)
			    {
				echo '<option value="'.$i.'" >'.($i == 2 ? '2017' : '2018' ).'</option>';
			    }
			
			}
			else
			{	
			  echo '<option value="1" selected>2016</option>';
			}
		    
		    ?>

		    
                    </select>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-3">
                    <label>Precio Unitario (S/.)</label>
                    <input type="text" id="proyecto-precio_unit_<?= $correlativo ?>_<?= $re ?>" class="form-control decimal" name="Proyecto[precio_unit]" placeholder="" value="<?= $recursos->precio_unit; ?>" />
                </div>
                <div class="clearfix"></div><br/
                <div class="col-xs-12 col-sm-7 col-md-12">
                 <input type="hidden" id="proyecto-id_recurso_<?= $correlativo ?>_<?= $re ?>" class="form-control" name="Proyecto[id_recurso_prog]" placeholder="" value="<?= $rec_prog_id ?>" />   
                    <table class="table table-bordered table-hover" id="programado_tabla_<?= $correlativo ?>_<?= $re ?>">

                        <tbody>
                            <tr id ="registro_meses_<?= $correlativo ?>_<?= $re ?>">
			    <?php if($programado){
                                $mes = [];
                                $cantidad = [];
                                $id = [];
				$estado = [];
                                
                                foreach($programado as $programado2)
                                {
                                    $mes[] = $programado2->mes;
                                    $cantidad[] = $programado2->cantidad;
                                    $id[] = $programado2->id;
				    $estado[] = $programado2->estado;
                                }
                                for($i=1; $i<=count($mes); $i++)
                                {
				    switch($i) {
						    case 1 : $var_mes = "ENE";
									    break;
						    case 2 : $var_mes = "FEB";
									    break;
						    case 3 : $var_mes = "MAR";
									    break;
						    case 4 : $var_mes = "ABR";
									    break;
						    case 5 : $var_mes = "MAY";
									    break;
						    case 6 : $var_mes = "JUN";
									    break;
						    case 7 : $var_mes = "JUL";
									    break;
						    case 8 : $var_mes = "AGO";
									    break;
						    case 9 : $var_mes = "SEP";
									    break;
						    case 10 : $var_mes = "OCT";
									    break;
						    case 11 : $var_mes = "NOV";
									    break;
						    case 12 : $var_mes = "DIC";
						    }
                            ?>        
                                  <td><label><?= $var_mes; ?></label>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control decimal" name="Proyecto[programado_cantidad][]" placeholder="" value="<?= $cantidad[($i-1)]; ?>"  <?php if($evento == 2){ if($estado[($i-1)] > 0){ echo 'Disabled';}} ?>>
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="<?= $mes[($i-1)] ?>" />
                                                <input type="hidden" id="proyecto-programado_id_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Proyecto[programado_id][]" placeholder="" value="<?= $id[($i-1)] ?>" />
					    </div>
                                    </td>  
                            <?php
                                }
                            }else{
                                
				if($años[$re] > 0)$contador = 12; else $contador = $meses;
				
                                for($i=1; $i<=$contador; $i++)
                                {
				    switch($i) {
						    case 1 : $var_mes = "ENE";
									    break;
						    case 2 : $var_mes = "FEB";
									    break;
						    case 3 : $var_mes = "MAR";
									    break;
						    case 4 : $var_mes = "ABR";
									    break;
						    case 5 : $var_mes = "MAY";
									    break;
						    case 6 : $var_mes = "JUN";
									    break;
						    case 7 : $var_mes = "JUL";
									    break;
						    case 8 : $var_mes = "AGO";
									    break;
						    case 9 : $var_mes = "SEP";
									    break;
						    case 10 : $var_mes = "OCT";
									    break;
						    case 11 : $var_mes = "NOV";
									    break;
						    case 12 : $var_mes = "DIC";
						    }
                            ?>        
                                  <td><label><?= $var_mes; ?></label>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control decimal" name="Proyecto[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="<?= $i; ?>" />
					    </div>
                                    </td>  
                            <?php
                                }

				}
                            ?>
				
				</tr>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="clearfix"></div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button  onclick="grabarrecurso(<?= $correlativo ?>,<?= $re ?>,<?= $i ?>)" type="button" id="btn_grabar" class="btn btn-primary btn_hide" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#programado_<?= $correlativo ?>_<?= $re ?>_" id="btn_programado" onclick="cargartitulos(<?= $correlativo ?>,<?= $re ?>)">Detalle</button>
<?php } ?>