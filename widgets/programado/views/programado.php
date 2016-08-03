
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
				
				$años[$re] = ($años[$re] + 1);
			    }
		    ?>
                    
                <div class="col-xs-12 col-sm-7 col-md-3">
                    <label>Precio Unitario (S/.)</label>
                    <input type="text" id="proyecto-precio_unit_<?= $correlativo ?>_<?= $re ?>" class="form-control decimal" name="Proyecto[precio_unit]" placeholder="" value="<?= $recursos->precio_unit; ?>" />
                </div>
                <div class="clearfix"></div><br/>
                <div class="col-xs-12 col-sm-7 col-md-12">
                 <input type="hidden" id="proyecto-id_recurso_<?= $correlativo ?>_<?= $re ?>" class="form-control" name="Proyecto[id_recurso_prog]" placeholder="" value="<?= $rec_prog_id ?>" />   
                    <table class="table table-bordered table-hover" id="programado_tabla_<?= $correlativo ?>_<?= $re ?>">
			<thead>
                            <tr>
                                <th class="text-center">
                                    Año
                                </th>
                                <th class="text-center">
                                    ENE
                                </th>
                                <th class="text-center">
                                    FEB
                                </th>
				<th class="text-center">
                                    MAR
                                </th>
                                <th class="text-center">
                                    ABR
                                </th>
                                <th class="text-center">
                                    MAY
                                </th>
				<th class="text-center">
                                    JUN
                                </th>
                                <th class="text-center">
                                    JUL
                                </th>
				<th class="text-center">
                                    AGO
                                </th>
                                <th class="text-center">
                                    SEP
                                </th>
				<th class="text-center">
                                    OCT
                                </th>
				<th class="text-center">
                                    NOV
                                </th>
				<th class="text-center">
                                    DIC
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
			    <?php if($programado){
                                $mes = [];
                                $cantidad = [];
                                $id = [];
				$estado = [];
                                
                                foreach($programado as $programado2)
                                {
                                    $mes[] = $programado2->mes;
				    $anio[] = $programado2->anio;
                                    $cantidad[] = $programado2->cantidad;
                                    $id[] = $programado2->id;
				    $estado[] = $programado2->estado;
                                }
			    
			    $e = 1;
			    
			    switch ($e) {
					    case 1:
						$var_anio = '2016';
						break;
					    case 2:
						$var_anio = '2017';
						break;
					    case 3:
						$var_anio = '2018';
						break;
					}
				?>
				
			    <tr id ="registro_meses_<?= $correlativo ?>_<?= $re ?>_<?= $e ?>">
			    <td>
				<div class="form-group field-proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
				    <label><?= $var_anio ?></label>
				</div>
			    </td>
                            <?php    for($i=1; $i<=count($mes); $i++)
                                {
				    
                            ?>        
                                  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="<?= $cantidad[($i-1)]; ?>"  <?php if($evento == 2){ if($estado[($i-1)] > 0){ echo 'Disabled';}} ?>>
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $mes[($i-1)] ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $anio[($i-1)] ?>" />
                                                <input type="hidden" id="proyecto-programado_id_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?>" class="form-control" name="Programado[programado_id][]" placeholder="" value="<?= $id[($i-1)] ?>" />
					    </div>
                                    </td>  
                            <?php
				    if(count($mes) == $i)
				    { ?>
					</tr>
			    <?php   }
				    else
				    {
				    if(($i == 12) || ($i == 24) || ($i == 36))
				    {
					$e++;
					
				    
				    switch ($e) {
					    case 1:
						$var_anio = '2016';
						break;
					    case 2:
						$var_anio = '2017';
						break;
					    case 3:
						$var_anio = '2018';
						break;
					}
					
					?>
					
					</tr>
					<tr id ="registro_meses_<?= $correlativo ?>_<?= $re ?>_<?= $e ?>">
					<td>
					    <div class="form-group field-proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<label><?= $var_anio ?></label>
					    </div>
					</td>
			    <?php    }
				    }
			    
                                }
				
			    	
                            }else{
                                
				
				
				for($i=1;$i<=$años[$re];$i++)
				{
				    switch ($i) {
					    case 1:
						$var_anio = '2016';
						break;
					    case 2:
						$var_anio = '2017';
						break;
					    case 3:
						$var_anio = '2018';
						break;
					}
				    
				    ?>
				<tr id ="registro_meses_<?= $correlativo ?>_<?= $re ?>_<?= $i ?>">
					    <td>
					    <div class="form-group field-proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $i; ?> required">
						<label><?= $var_anio ?></label>
					    </div>
					    </td>
				<?php    if($i == 1)
				    {
				    if($i == $años[$re])
				    {
					for($e=1;$e<=$meses[$re];$e++)
					{ ?>
					
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>
					  
				    <?php }
				    }
				    else
				    {
					//$countmeses = ($i*12);
					for($e=1;$e<=12;$e++)
					{ ?>
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>
					
				    <?php
					}
				    }
				    
				    }
				    
				    
				    if($i == 2)
				    {
				    if($i == $años[$re])
				    {
					for($e=13;$e<=(12+$meses[$re]);$e++)
					{ ?>
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>   
				    <?php }
				    }
				    else
				    {
					//$countmeses = ($i*12);
					for($e=13;$e<=24;$e++)
					{ ?>
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>
					
				    <?php
					}
				    }
				    
				    }
				    
				    if($i == 3)
				    {
				    if($i == $años[$re])
				    {
					for($e=25;$e<=(24+$meses[$re]);$e++)
					{ ?>
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>   
				    <?php }
				    }
				    else
				    {
					//$countmeses = ($i*12);
					for($e=25;$e<=36;$e++)
					{ ?>
					  <td>
					    <div class="form-group field-proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control decimal" name="Programado[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_mes][]" placeholder="" value="<?= $e; ?>" />
						<input type="hidden" id="proyecto-programado_anio_<?= $correlativo ?>_<?= $re ?>_<?= $e; ?>" class="form-control" name="Programado[programado_anio][]" placeholder="" value="<?= $i; ?>" />
					    </div>
					    </td>
					
				    <?php
					}
				    }
				    
				    }
				    
				    
				    ?>
				 </tr>   
			    <?php }
			    
				}
			    ?>
				
				
				
				
				
				
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="clearfix"></div>
                
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button  onclick="grabarrecurso(<?= $correlativo ?>,<?= $re ?>,<?= $años[$re] ?>,<?= $vigencia ?>)" type="button" id="btn_grabar" class="btn btn-primary btn_hide" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#programado_<?= $correlativo ?>_<?= $re ?>_" id="btn_programado" onclick="cargartitulos(<?= $correlativo ?>,<?= $re ?>)">Detalle</button>
<?php } ?>