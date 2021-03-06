

<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#programado<?= $re ?>_" id="btn_programado" onclick="cargartitulos(<?= $re ?>)">Detalle</button>

<div class="modal fade bs-example-modal-lg" id="programado<?= $re ?>_" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle <?= ($re+1) ?></h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                   <label>Objetivo: <span id="obj_programado_<?= $re ?>"></span></label> 
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                    <label>Indicador: <span id="ind_programado_<?= $re ?>"></span></label> 
                </div>
                <div class="col-xs-12 col-sm-7 col-md-8">
                    <label>Actividad: <span id="act_programado_<?= $re ?>"></span></label> 
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
                    <select onchange="cargaranio(<?= $re ?>,<?= $años[$re] ?>,<?= $meses[$re] ?>)" id="proyecto-programa_anio_<?= $re ?>" class="form-control" name="Proyecto[programa_anio]">
		    <?php
			    
			if($años[$re] > 0)
			{
			for($i=1;$i<=$años[$re];$i++)
			{
			    switch ($i) {
					    case 1:
						echo '<option value="1" selected>Primer Año</option>';
						break;
					    case 2:
						echo '<option value="2" >Segundo Año</option>';
						break;
					    case 3:
						echo '<option value="3" >Tercer Año</option>';
						break;
					}

			}
			    if($meses[$re] != 12)
			    {
				echo '<option value="'.$i.'" >'.($i == 2 ? 'Segundo' : 'Tercero' ).' Año</option>';
			    }
			
			}
			else
			{	
			  echo '<option value="1" selected>Primer Año</option>';
			}
		    
		    ?>

		    
                    </select>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-3">
                    <label>Precio Unitario</label>
                    <input type="text" id="proyecto-precio_unit_<?= $re ?>" class="form-control" name="Proyecto[precio_unit]" placeholder="" value="<?= $recursos->precio_unit ?>" />
                </div>
                <div class="clearfix"></div><br/
                <div class="col-xs-12 col-sm-7 col-md-12">
                 <input type="hidden" id="proyecto-id_recurso_<?= $re ?>" class="form-control" name="Proyecto[id_recurso_prog]" placeholder="" value="<?= $rec_prog_id ?>" />   
                    <table class="table table-bordered table-hover" id="programado_tabla_<?= $re ?>">

                        <tbody>
                            <tr id ="registro_meses_<?= $re ?>">
			    <?php if($programado){
                                $mes = [];
                                $cantidad = [];
                                $id = [];
                                
                                foreach($programado as $programado2)
                                {
                                    $mes[] = $programado2->mes;
                                    $cantidad[] = $programado2->cantidad;
                                    $id[] = $programado2->id;
                                }
                                for($i=1; $i<=count($mes); $i++)
                                {
                            ?>        
                                  <td><label>Mes <?= $i; ?></label>
					    <div class="form-group field-proyecto-programado_mes_<?= $re ?>_<?= $i; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $re ?>_<?= $i; ?> " class="form-control entero" name="Proyecto[programado_cantidad][]" placeholder="" value="<?= $cantidad[($i-1)]; ?>"  />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $re ?>_<?= $i; ?> " class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="<?= $mes[($i-1)] ?>" />
                                                <input type="hidden" id="proyecto-programado_id_<?= $re ?>_<?= $i; ?> " class="form-control" name="Proyecto[programado_id][]" placeholder="" value="<?= $id[($i-1)] ?>" />
					    </div>
                                    </td>  
                            <?php
                                }
                            }else{
                                
				if($años[$re] > 0)$contador = 12; else $contador = $meses;
				
                                for($i=1; $i<=$contador; $i++)
                                {
                            ?>        
                                  <td><label>Mes <?= $i; ?></label>
					    <div class="form-group field-proyecto-programado_mes_<?= $re ?>_<?= $i; ?> required">
						<input type="text" id="proyecto-programado_cantidad_<?= $re ?>_<?= $i; ?>" class="form-control entero" name="Proyecto[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_<?= $re ?>_<?= $i; ?>" class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="<?= $i; ?>" />
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
                <button  onclick="grabarrecurso(<?= $re ?>,<?= $i ?>)" type="button" id="btn_grabar" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>