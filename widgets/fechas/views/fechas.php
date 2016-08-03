

<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#fechas<?= $act ?>_" id="fechas">Fechas</button>
<!--Lista de Objetivos Especificos -->
<div class="modal fade" id="fechas<?= $act ?>_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fechas <?= $act ?></h4>
            </div>
            <div class="modal-body">
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-7 col-md-12">
                    <table class="table table-bordered table-hover" id="fechas_tabla_<?= $act ?>">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                    Fecha Inicio
                                </th>
				<th class="text-center">
                                    Fecha Fin
                                </th>
                                <th>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
			    <?php if($actividades){ ?>
				
				    <tr>
					<td>
					<?= ($act+1) ?>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_finicio_<?= $act ?> required">
						<input type="month" id="proyecto-actividades_finicio_<?= $act ?>" class="form-control" name="Proyecto[actividades_finicio][]" placeholder="Mes" value="<?= $actividades->fecha_inicio ?>" />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ffin_<?= $act ?> required">
						<input type="month" id="proyecto-actividades_ffin_<?= $act ?>" class="form-control" name="Proyecto[actividades_ffin][]" placeholder="Mes" value="<?= $actividades->fecha_fin ?>" />
					    </div>
					</td>
					<td>
						<!--<input type="hidden" name="Proyecto[actividades_ids][]" value="<?= $actividades->id ?>" />-->

					</td>
				    </tr>
			    <?php }else{ ?>
				<tr>
				    <td>
				    <?= ($act+1) ?>
				    </td>
				    <td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_finicio_<?= $act ?> required">
						<input type="month" id="proyecto-actividades_finicio_<?= $act ?>" class="form-control" name="Proyecto[actividades_finicio][]" placeholder="Mes"  />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ffin_<?= $act ?> required">
						<input type="month" id="proyecto-actividades_ffin_<?= $act ?>" class="form-control" name="Proyecto[actividades_ffin][]" placeholder="Mes"  />
					    </div>
					</td>
				    <td>

				    </td>
				</tr>
				<?php $act=1; ?>
			    <?php } ?>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!--<button type="button" id="btn_actividades" class="btn btn-primary" data-dismiss="modal">Guardar</button>-->
            </div>
        </div>
    </div>
</div>
