<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\widgets\Pjax;
use app\models\Maestros;

//use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $nuevo app\models\TblPersonaSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
   .accordion-toggle:hover {
      text-decoration: none;
    } 
    
</style>
<div id="form1" >
    <?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
    <?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'Proyecto','titulo'=>'Motivo de la Observación:','tipo'=>'1']); ?>   
<div class="alert alert-danger" id="warning">
	   
	    </div>
<ul class="tabs">
    <li><a href="#tab1">Datos Generales</a></li>
    <li><a href="#tab2">Financiamiento</a></li>
    <li><a href="#tab3">Objetivos e Indicadores</a></li>
    <li><a href="#tab4">Actividades</a></li>
    <li><a href="#tab5">Recursos</a></li>
  </ul>
  <div class="clr"></div>
  
  <section class="block">
    
    <article id="tab1">
        

            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-titulo required">
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" />
                <input type="hidden" value="" id="proyecto-respuesta_aprob" name="Proyecto[respuesta_aprob]" /> 
                <label for="proyecto-titulo">Título del Proyecto:</label>
                <input class="form-control" type="text" value="<?= $proyecto->titulo?>" placeholder="Nombre del Proyecto" id="proyecto-titulo" name="Proyecto[titulo]"  required/> <!-- required-->
                </div>
             
                
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-vigencia required">
                <label for="proyecto-vigencia">Vigencia (En Meses):</label>
                <input class="form-control entero" type="text" id="proyecto-vigencia" value="<?= $proyecto->vigencia?>" placeholder="Vigencia del Proyecto en Meses" name="Proyecto[vigencia]"  required/> <!-- required-->
                </div>    
            </div>
            
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_tipo_proyecto required">
                    <label for="proyecto-id_tipo_proyecto">Investigación:</label>
                <select class="form-control" id="proyecto-id_tipo_proyecto" name="Proyecto[id_tipo_proyecto]" >
                    <option value="0">--Seleccione--</option>
                    <?php                    
                           foreach($tipoInv as $tipoInvs)
                            {
                    ?>
                               <option value="<?= $tipoInvs->id; ?>" <?=($tipoInvs->id == $proyecto->id_tipo_proyecto)?'selected':'' ?> > <?= $tipoInvs->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_direccion_linea required">
                <label for="proyecto-id_direccion_linea">Dirección de Linea:</label>
                <select  class="form-control" id="proyecto-id_direccion_linea" name="Proyecto[id_direccion_linea]" >
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoDireccion = Maestros::find()
                                ->where('id_padre = 21 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoDireccion as $tipoDireccion2)
                            {
                    ?>
                               <option value="<?= $tipoDireccion2->id; ?>" <?=($tipoDireccion2->id == $proyecto->id_direccion_linea)?'selected':'' ?> required> <?= $tipoDireccion2->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
             </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_unidad_ejecutora required">
                <label for="proyecto-id_unidad_ejecutora">Unidad Ejecutora:</label>
                <select class="form-control" id="proyecto-id_unidad_ejecutora" name="Proyecto[id_unidad_ejecutora]" >
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoUnidadEj = Maestros::find()
                                ->where('id_padre = 25 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoUnidadEj as $tipoUnidadEj2)
                            {
                    ?>
                               <option value="<?= $tipoUnidadEj2->id; ?>" <?=($tipoUnidadEj2->id == $proyecto->id_unidad_ejecutora)?'selected':'' ?> required> <?= $tipoUnidadEj2->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_dependencia_inia required">
                <label for="proyecto-id_dependencia_inia">Unidad Operativa:</label>
                <select class="form-control" name="Proyecto[id_dependencia_inia]" id="proyecto-id_dependencia_inia" >
                    <option value="0">--Seleccione--</option>

                </select>
                
            </div>    
            </div>

            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-departamento required">
                <label for="proyecto-departamento">Departamento:</label>
                <select class="form-control" onchange="provincia(1)" id="proyecto-departamento" name="Proyecto[departamento][]"  >
                                                <option value="0">--Departamento--</option>
                                                <?php
                                                       foreach($departamentos as $departamentos2)
                                                        {
                                                ?>
                                                           <option value="<?= $departamentos2->department_id; ?>" <?=($departamentos2->department_id == substr($proyecto->ubigeo,0,2))?'selected':'' ?> > <?= $departamentos2->department ?></option>
                                                <?php   } ?>
                            
                                             
                            
                                            </select>
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-provincia required">
                    <label for="proyecto-provincia">Provincia:</label>
                    <select class="form-control" onchange="distrito(1)" id="proyecto-provincia" name="Proyecto[provincia]" >
                                                <option value="0">--Provincia--</option>
                    <?php
                    if ($proyecto->ubigeo) {
                        
                        foreach($provincias as $provincias2)
                        {
                            echo '<option value="'.$provincias2->province_id.'" '.($provincias2->province_id == substr($proyecto->ubigeo,0,4) ? 'selected="selected"' : '' ).'> '.$provincias2->province .'</option>';
                        }
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-distrito required">
                    <label for="proyecto-distrito">Distrito:</label>
                    <select class="form-control" id="proyecto-distrito" name="Proyecto[distrito]" >
                                                <option value="0">--Distrito--</option>
                    <?php
                    if ($proyecto->ubigeo) {
                        
                        foreach($distritos as $distritos2)
                        {
                            echo '<option value="'.$distritos2->district_id.'" '.($distritos2->district_id == $proyecto->ubigeo ? 'selected="selected"' : '' ).'> '.$distritos2->district .'</option>';
                        }
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_programa required">
                    <label for="proyecto-id_programa">Programa:</label>
                    <select onchange="cultivo(1)" class="form-control" id="proyecto-id_programa" name="Proyecto[id_programa]" >
                                                <option value="0">--Programa--</option>
                    <?php
                    $prog = null;
                    if ($proyecto->ubigeo) {
                        
                        foreach($programa as $programa2)
                        {
                            echo '<option value="'.$programa2->id.'" '.($programa2->id == $proyecto->id_programa ? 'selected="selected"' : '' ).'> '.$programa2->descripcion .'</option>';
                            if($programa2->id == $proyecto->id_programa)
                            {
                                $prog = $programa2->id;
                            }
                        }
                       
                        
                    }
                    ?>
                    
                    </select>
            </div>    
            </div>
            
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_cultivo required">
                    
                 
                <label for="proyecto-id_cultivo">Cultivo o Crianza:</label>
                <select onchange="especie(1)" class="form-control" id="proyecto-id_cultivo" name="Proyecto[id_cultivo]" >
                 <option value="0">--Seleccione--</option>   
                 <?php
                    $cul = null;
                    $maestro = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$prog])
                                ->orderBy('orden')
                                ->all();

                           foreach($maestro as $maestros)
                            {
                ?>
                                <option value="<?= $maestros->id; ?>" <?=($maestros->id == $proyecto->id_cultivo)?'selected':'' ?> > <?= $maestros->descripcion ?></option>;
                                
                                
                    
                    <?php
                                if($maestros->id == $proyecto->id_cultivo)
                                    {
                                        $cul = $maestros->id;
                                    }    
                    } ?>
                      
                        
                    
                 
                    
                </select>   
                    
                            
                </div>    
            </div>
            <div class="col-xs-12 col-sm-7 col-md-4" >
                <div class="form-group field-proyecto-id_especie required">
                    
                 
                <label for="proyecto-id_especie">Especie:</label>
                <select class="form-control" id="proyecto-id_especie" name="Proyecto[id_especie]" >
                 <option value="0">--Seleccione--</option>   
                 <?php
                 
                    if($cul)
                    {
                    $especie = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$cul])
                                ->orderBy('orden')
                                ->all();

                           foreach($especie as $especie2)
                            {
                ?>
                                <option value="<?= $especie2->id; ?>" <?=($especie2->id == $proyecto->id_especie)?'selected':'' ?> > <?= $especie2->descripcion ?></option>;
                    
                                
                    <?php   } } ?>
                      
                        
                    
                 
                    
                </select>   
                    
                            
                   
            </div>
            </div>
                <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-id_areatematica required">
                <label for="proyecto-id_areatematica">Programa Transversal:</label>
                <select class="form-control" id="proyecto-id_areatematica" name="Proyecto[id_areatematica]" >
                    <option value="0">--Seleccione--</option>
                <?php
                 
                    $accionTrans = Maestros::find()
                                ->where('id_padre = 10 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($accionTrans as $accionTransv)
                            {
                ?>
                                <option value="<?= $accionTransv->id; ?>" <?=($accionTransv->id == $proyecto->id_areatematica)?'selected':'' ?> > <?= $accionTransv->descripcion ?></option>;
                    <?php    } ?>

                 
                </select>
                </div></div>
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <?= \app\widgets\colaboradores\ColaboradoresWidget::widget(['id'=>$proyecto->id]); ?>   
            </div>
            <div class="clearfix"></div>
            <br/>
            <br/>

    </article>
    <article id="tab2">
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
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante121->monetario; ?>"  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante121->no_monetario; ?>"/>
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_total_<?= $co; ?> required">
					    <input type="text" id="aportante-aporte_total_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_total][]" placeholder=""  value="<?= $aportante121->total; ?>" disabled>
					</div>
				    </td>
                                    <td>
                                        <input type="hidden" name="Aportante[aportante_ids][]" id="aportante-aportante_ids_<?= $co; ?>" value="<?= $aportante121->id; ?>" />    

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
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_monetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_monetario][]" placeholder="" value="<?= $aportante2->monetario; ?>"  />
					</div>
				    </td>
                                    <td>
					<div class="form-group field-aportante-aporte_nomonetario_<?= $co; ?> required">
					    <input onkeyup="sumatotal(<?= $co; ?>)" type="text" id="aportante-aporte_nomonetario_<?= $co; ?>" class="form-control decimal" name="Aportante[aporte_nomonetario][]" placeholder=""  value="<?= $aportante2->no_monetario; ?>"/>
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

    </article>
    <article id="tab3">
        
        <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-objetivo_general required">
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" /> 
                <label for="proyecto-objetivo_general">Objetivo General:</label>
                <textarea class="form-control" type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 100%; height: 40px;" id="proyecto-objetivo_general" name="Proyecto[objetivo_general]"  required><?= $proyecto->objetivo_general; ?></textarea>
                </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="col-xs-12 col-sm-7 col-md-12" >
                <label>Objetivos Especificos:</label>
                <div class="panel-group" id="accordion">
               <?php 
               $i = 0;
               if($objetivos)
               {
               
                foreach($objetivos as $objetivo)
                {
                     
                ?>
                    <div class="panel panel-primary">
                      <div class="panel-heading" style="height: 45px;padding:5px">
                        <?= \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>$objetivo->id,'correlativo'=>$i]) ?>
                      </div>
                      <div id="collapse<?= $i; ?>" class="panel-collapse collapse <?=($i == 0)?'in':'' ?>">
                        <div class="panel-body">
                            <?= \app\widgets\indicadores\IndicadoresWidget::widget(['objetivo_id'=>$objetivo->id,'correlativo'=>$i]); ?> 
                        </div>
                      </div>
                    </div>
                
                <?php
                $i++;
                }?>
                </div>
              <?php }
               else
               {
                echo \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>'','correlativo'=>$i]);    
                $i= 1;
               }
               ?> 
            </div>
            
            <div class="clearfix"><br></div>
    
    </article>
    <article id="tab4">
        
        <div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Objetivo Especifico:</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control id_objetivo" name="Proyecto[id_objetivo]" id="proyecto-id_objetivo">
		<?php
                        $array1 = [];
                        $i = 0;
                           foreach($objetivosespecificos as $objetivoespecifico)
                            {
                                $array1[$i] = $objetivoespecifico->id;
                    ?>
                               <option value="<?= $objetivoespecifico->id; ?>" > <?= $objetivoespecifico->descripcion ?></option>;
                    <?php  $i++; } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Indicador:</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control id_indicador" name="Proyecto[id_indicador]" id="proyecto-id_indicador">
		<?php
                        $array = [];
                        $i = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
                    ?>
                               <option value="<?= $indicadores2->id; ?>" > <?= $indicadores2->descripcion ?></option>;
                    <?php  $array[$i] = $indicadores2->id;
		    
				}
				$i++;
			    } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div><br/><br/>
        <div class="col-xs-12 col-sm-7 col-md-12" id="form1">
            <?php //var_dump($proyecto->id);die; ?>
        <?= \app\widgets\actividades\ActividadesWidget::widget(['indicador_id'=>$array[0],'id_proyecto'=>$proyecto->id,'evento'=>$evento]); ?> 
        </div>
        
    </article>
    <article id="tab5">
        
        <?php
	$ver_act = json_decode($ver_actividad);
	$ver_peso_act = json_decode($ver_peso_actividad);
	$ver_co_apor = json_decode($ver_co_aporte);
	//var_dump($ver_act->estado);die;
	$denegado = 0;
	if(($ver_obj_ind == 0) && ($ver_act->estado == 0) && ($ver_co_apor->estado == 0) ){
	   $denegado = 1; 
	    ?>
	
        <div class="col-xs-12 col-sm-7 col-md-1" >
	    <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" /> 
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Objetivo Especifico:</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
            <select class="form-control id_objetivo" name="Proyecto[id_objetivo]"  id="proyecto-id_objetivo">
		<?php
                        $array1 = [];
                        $i = 0;
                           foreach($objetivosespecificos as $objetivoespecifico)
                            {
                                if($flat_ob_esp == '')
				{
                                $array1[$i] = $objetivoespecifico->id;
				}
				else
				{
				  $array1[$i]  = $flat_ob_esp;
				}
                    ?>
                               <option value="<?= $objetivoespecifico->id; ?>" <?= ($objetivoespecifico->id == $flat_ob_esp)?'Selected':'' ?>> <?= $objetivoespecifico->descripcion ?></option>;
                    <?php  $i++; } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
        <div class="col-xs-12 col-sm-7 col-md-10" >
            <h5>Indicador:</h5>
                
            <select class="form-control id_indicador" name="Proyecto[id_indicador]" id="proyecto-id_indicador">
		<?php
                        $array2 = [];
                       // $i = 0;
                           foreach($indicadores as $indicadores2)
                            {
                                
				if($indicadores2->id_oe == $array1[0])
				{
				    if($flat_ind == '')
				    {
				    $array2[] = $indicadores2->id;
				    }
				    else
				    {
				      $array2[]  = $flat_ind;
				    }
                    ?>
                               <option value="<?= $indicadores2->id; ?>" <?= ($indicadores2->id == $flat_ind)?'Selected':'' ?>> <?= $indicadores2->descripcion ?></option>;
                    <?php  //$array2[] = $indicadores2->id;
		    
				}
				//$i++;
			    } ?>    
		</select>    
        </div>
	<div class="col-xs-12 col-sm-7 col-md-1" >
	</div>
	<div class="clearfix"></div><br/><br/>
        
	<div class="col-xs-12 col-sm-7 col-md-12"  id="form_act" >
                <label>Actividades:</label>
                <div class="panel-group" id="accordion">
               <?php
	       $array =[];
               $i = 0;
               if($actividades)
               {
		  /*$evento3 = 1;
		  if($proyecto->situacion == 2)
		  {
		     $evento3 = 2;
		  }*/
		  
                foreach($actividades as $actividades2)
                {
                    if($actividades2->id_ind == $array2[0])
		    {
			$array[] = $actividades2->id;
			
                ?>
                  <div class="panel panel-primary">
                      <div class="panel-heading" style="height: 45px;padding:5px">
                        <div id="divactividad" >
		<?php //if($objetivoespecifico) {?>
                <div class="col-xs-12 col-sm-9 col-md-12" id="proyecto-div_id_<?= $i; ?>" >
		    <input type="hidden" value="<?= $actividades2->id?>" id="proyecto-id_actividad_<?= $i; ?>" name="Proyecto[id_actividad][]" />
		    <input type="hidden" value="<?= $actividades2->descripcion;?>" id="proyecto-act_descripcion_<?= $i; ?>" name="Proyecto[act_descripcion]" /> 
		    <!--<div class="col-md-1" >
			<?= ($i+1); ?>
		    </div>-->
		    <div class="col-md-1" >
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i; ?>" aria-expanded="true">
			     <span style="color:black" class="glyphicon glyphicon-minus"></span>
			</a>
			</div>
		    <div class="col-xs-10 col-sm-10 col-md-9" >
			<div class="form-group field-proyecto-objetivos_descripciones_<?= $i; ?> required">
			    <label for="proyecto-obj_descripcion_<?= $i; ?>"><?= $actividades2->descripcion;?></label>
			</div> 
		    </div>
		    <div class="col-xs-12 col-sm-9 col-md-2" >
			<div class="form-group field-proyecto-objetivos_peso_<?= $i; ?> required">
			    
			</div>    
		    </div>
                    
                    <br>
                </div>
		
		<?php // } else {?>
		
		<?php //} ?>
                <div class="clearfix"></div>
	    </div>

                      </div>
                      <div id="collapse<?= $i; ?>" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <?= \app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$actividades2->id,'vigencia'=>$proyecto->vigencia,'id_proyecto'=>$proyecto->id,'evento'=>$evento,'correlativo'=>$i]); ?> 
                        </div>
                      </div>
                  </div>
		  
                    
                    
                     
                
                <?php
		
		
                $i++;
		    }}
		    
		    
		    ?>
                
                <!--<div class="col-xs-12 col-sm-7 col-md-12" id="proyecto-div_id_<?= $i; ?>" >
		</div>
		<div id="objetivo_row_1-" class="btn btn-default pull-left" value="1" ng-click="addRow()">Agregar</div>
              -->
              <?php }
               else
               {
                //echo \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['objetivo_id'=>'','correlativo'=>$i]);    
                //$i= 1;
               }
               ?> 
            </div>
            </div>
            
        <div class="clearfix"></div><br/>

	<?php if($proyecto->situacion == 0) {?>
	<div class="clearfix"><br/>
	    <div class="col-xs-12 col-sm-7 col-md-12">
	    <button type="submit" id="btn_rec_save" class="btn btn-primary pull-right">Guardar</button> 
	    </div>
	<div class="col-xs-12 col-sm-7 col-md-12 checkbox">
            <label><input type="checkbox" name="Proyecto[cerrar_recurso]" id="proyecto-cerrar_recurso" ><strong>Doy por completo el registro de mi proyecto y Autorizo su revisión.</strong></label>
        </div>
	<?php } }else{   ?>
	    <div class="alert alert-warning" id="warning">
		<?= $ver_act->mensaje.$ver_peso_act->mensaje.$ver_co_apor->mensaje ?>
		<!--<strong>¡Error!</strong> Verificar los Indicadores y Actividades para continuar.-->
	    </div>
	<?php } ?>
	<div class="clearfix"></div><br/><br/><br/>

        
    </article>
 
  </section>
    <div class="col-xs-12 col-sm-7 col-md-12 col-centered" >
        <button style="" type="button" id="btnobservar" class="btn btn-warning " data-toggle="modal" data-target="#modalobs_">Observar</button> 
        <button type="submit" id="btnaceptar" class="btn btn-success ">Aceptar</button>   
    </div>
    <?php ActiveForm::end(); ?>
 </div>       
  <?php
    $urlDependencia= Yii::$app->getUrlManager()->createUrl('maestros/dependencia');
    $obtenerindicadores = Yii::$app->getUrlManager()->createUrl('proyecto/obtenerindicadores');
    $obteneractividad = Yii::$app->getUrlManager()->createUrl('proyecto/obteneractividad');
    $refrescaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/refrescaractividades');
    $refrescarrecurso = Yii::$app->getUrlManager()->createUrl('proyecto/refrescarrecursos');
    $verf_presupuesto = Yii::$app->getUrlManager()->createUrl('proyecto/verificar_presupuesto');
?>
  
  <script>

$(document).ready(function(){
 
 $(".multiselect").multiselect();   
$('ul.tabs li:nth-child(1)').addClass('active');
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

var inicialdependencia = <?= $proyecto->id_dependencia_inia;?>;
if (inicialdependencia != '')
{
    var dependencia = $("#proyecto-id_dependencia_inia");
     var unidad = $("#proyecto-id_unidad_ejecutora");
     
     if(unidad.val() != '0')
        {
        $.ajax({
                    url: '<?= $urlDependencia ?>',
                    type: 'GET',
                    async: true,
                    data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        dependencia.find('option').remove();
                        dependencia.append(data);
                        $("#proyecto-id_dependencia_inia option[value="+inicialdependencia+"]").attr('selected','selected');
                        //dependencia.prop('disabled', false);
                    }
                });
        }
}
else
{
$("#proyecto-id_dependencia_inia").prop('disabled', true);
}


$(".collapse").on('show.bs.collapse',function(e){
$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
}); 
    
$("#proyecto-id_unidad_ejecutora").change(function(){
    
     var dependencia = $("#proyecto-id_dependencia_inia");
     var unidad = $(this);
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $urlDependencia ?>',
                    type: 'GET',
                    async: true,
                    data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        dependencia.find('option').remove();
                        dependencia.append(data);
                        dependencia.prop('disabled', false);
                    }
                });
        }
        else
        {
            dependencia.find('option').remove();
            dependencia.append('<option value="0">--Seleccione--</option>');
            dependencia.prop('disabled', true);
        }
 });


    
var situacion_proyecto = <?= $proyecto->situacion; ?>;
var evento = <?= $evento; ?>;

    $('#form1').find('input, textarea, select').prop('disabled', true);
    $('#colaboradores_tabla  th:eq(4)').hide();
    $('#colaboradores_tabla  td:nth-child(5)').hide();
    $('.tb_indicador  th:eq(5)').hide();
    $('.tb_indicador  td:nth-child(6)').hide();
    $('#colcaborador_row_2').hide();
    $('.id_objetivo').prop('disabled', false);
    $('.id_indicador').prop('disabled', false);
    $('.id_actividad').prop('disabled', false);
    $('#proyecto-id').prop('disabled', false);
    $('#proyecto-respuesta_aprob').prop('disabled', false);
    $('#proyecto-observacion').prop('disabled', false);
    $('#actividades_tabla  th:eq(7)').hide();
   $('#actividades_tabla  td:nth-child(8)').hide();
    $('#recurso_tabla  th:eq(8)').hide();
   $('#recurso_tabla  td:nth-child(9)').hide();
    $('.btn_hide').hide();
    
    //$('#indicadores_row_1').hide();
  
    var requiere_aprobar = <?= $requiere_aprobar; ?>;
    <?php 
     $resultado = '';
     $ver_act = json_decode($ver_actividad); 
     $ver_pre = json_decode($ver_monto_total); 
     $ver_rec = json_decode($ver_recursos); 
     $ver_peso_ac = json_decode($ver_peso_actividad); 
     $ver_pro = json_decode($ver_programado);
     
     //$resultado = $ver_act->mensaje.$ver_pre->mensaje.$ver_rec->mensaje.$ver_peso_ac->mensaje.$ver_pro->mensaje;
     ?>
     var obj_ind = <?= $ver_obj_ind ?>;
     var ver_acte = <?= $ver_act->estado ?>;
     var ver_pree = <?= $ver_pre->estado ?>;
     var ver_rece = <?= $ver_rec->estado ?>;
     var ver_pese = <?= $ver_peso_ac->estado ?>;
     var ver_proe = <?= $ver_pro->estado ?>;
     
     var ver_actm = "<?= $ver_act->mensaje ?>";
     var ver_prem = "<?= $ver_pre->mensaje ?>";
     var ver_recm = "<?= $ver_rec->mensaje ?>";
     var ver_pesm = "<?= $ver_peso_ac->mensaje ?>";
     var ver_prom = "<?= $ver_pro->mensaje ?>";
    
     if(situacion_proyecto == 2)
    {
    $('#btnobservar').hide();
    $('#btnaceptar').hide();
    }else{
     if((obj_ind == 0) && (ver_acte == 0) && (ver_pree == 1) && (ver_rece == 0) && (ver_pese == 0) && (ver_proe == 0))
     {
        if(requiere_aprobar == 0)
        {
            $('#btnobservar').hide();
            $('#btnaceptar').hide();
        }
        
     }
     else
     { 

        $('#warning').html(ver_actm+ver_prem+ver_recm+ver_pesm+ver_prom);
        $('#warning').show();
	 $('#btnobservar').hide();
        $('#btnaceptar').hide();
     }
    }
 //   $('#form1').find('input, textarea, button, select').prop('disabled', true);
 //   $('#form_colaborador').find('input, textarea, button, select').prop('disabled', false);
});


$("#proyecto-id_objetivo").change(function(){
    
     var indicador = $("#proyecto-id_indicador");
     var objetivo = $(this);
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: true,
                    data: {id:objetivo.val()},
                    success: function(data){
                        indicador.find('option').remove();
                        indicador.append(data);
			
			
			
			var id_indicador = indicador.val();
			$('#actividades_tabla > tbody > tr').remove();
        
			$.ajax({
				    url: '<?= $refrescaractividad ?>',
				    type: 'GET',
				    async: true,
				    data: {id:id_indicador,evento:<?= $evento; ?>},
				    success: function(data){
					var valor = jQuery.parseJSON(data);
					$('#actividades_tabla').append(valor.html);
				       act = valor.contador;
				       
                                       
                                       $('#actividades_tabla').find('input, textarea, select').prop('disabled', true);
				    $('#actividades_tabla  th:eq(7)').hide();
                                    $('#actividades_tabla  td:nth-child(8)').hide();
                                    $('.btn_hide').hide();
				       
				    
				    }
				});
			
			 
			
			
                    }
                    
                    
                });
        
        
        }
	

 });

 
 $( "#proyecto-id_indicador" ).change(function() {
    
  var id_indicador = $(this).val();
  $('#actividades_tabla > tbody > tr').remove();
        
        $.ajax({
                    url: '<?= $refrescaractividad ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id_indicador,evento:<?= $evento; ?>},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#actividades_tabla').append(valor.html);
                       act = valor.contador;
                       console.log(act);
		       
		       
					   $('#actividades_tabla').find('input, textarea, select').prop('disabled', true);
					   $('#actividades_tabla  th:eq(7)').hide();
                                            $('#actividades_tabla  td:nth-child(8)').hide();
					   $('.btn_hide').hide(); 
					
                    }
                });
  
  
  
});



$("#proyecto-id_objetivo2").change(function(){
    
     var indicador = $("#proyecto-id_indicador2");
     var actividad = $("#proyecto-id_actividad2");
     var objetivo = $(this);
     
     if($(this).val() != '0')
        {
        $.ajax({
                    url: '<?= $obtenerindicadores ?>',
                    type: 'GET',
                    async: true,
                    data: {id:objetivo.val()},
                    success: function(data){
                        indicador.find('option').remove();
                        indicador.append(data);
			
			
			
			var id_indicador = indicador.val();
			
			    $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:id_indicador},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
				$('#recurso_tabla > tbody > tr').remove();
				
				$.ajax({
					    url: '<?= $refrescarrecurso ?>',
					    type: 'GET',
					    async: true,
					    data: {id:id_actividad,id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#recurso_tabla').append(valor.html);
					       re = valor.contador;
					       console.log(re);
					       
					       
					       
						$('#recurso_tabla').find('input, textarea, select').prop('disabled', true);
						$('#recurso_tabla  th:eq(8)').hide();
                                                $('#recurso_tabla  td:nth-child(9)').hide();
						$('.btn_hide').hide();   
						   
						
					    }
				    });
			    
			    
			    }
			    });
			
                    }
                });
        }
 });


$("#proyecto-id_indicador2").change(function(){
    
     var actividad = $("#proyecto-id_actividad2");
     var indicador = $(this);
     
     if($(this).val() != '0')
        {
        
			
			    $.ajax({
			    url: '<?= $obteneractividad ?>',
			    type: 'GET',
			    async: false,
			    data: {id:indicador.val()},
			    success: function(data){
				actividad.find('option').remove();
				actividad.append(data);
				
				var id_actividad = actividad.val();
				$('#recurso_tabla > tbody > tr').remove();
				
				$.ajax({
					    url: '<?= $refrescarrecurso ?>',
					    type: 'GET',
					    async: true,
					    data: {id:id_actividad,id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
					    success: function(data){
						var valor = jQuery.parseJSON(data);
						$('#recurso_tabla').append(valor.html);
					       re = valor.contador;
					       console.log(re);
					       
					       $('#recurso_tabla').find('input, textarea, select').prop('disabled', true);
						$('#recurso_tabla  th:eq(8)').hide();
                                                $('#recurso_tabla  td:nth-child(9)').hide();
						$('.btn_hide').hide(); 
					    }
				    });
			    
			    
			    }
			    });
			
        }
 });

 
$( "#proyecto-id_actividad2" ).change(function() {
    
  var id_actividad = $(this).val();
  $('#recurso_tabla > tbody > tr').remove();
        
        $.ajax({
                    url: '<?= $refrescarrecurso ?>',
                    type: 'GET',
                    async: true,
                    data: {id:id_actividad,id_proyecto:<?= $proyecto->id; ?>,evento:<?= $evento; ?>},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
                        $('#recurso_tabla').append(valor.html);
                       re = valor.contador;
                       console.log(re);
		       
		       
		    $('#recurso_tabla').find('input, textarea, select').prop('disabled', true);
		    $('#recurso_tabla  th:eq(8)').hide();
                    $('#recurso_tabla  td:nth-child(9)').hide();
		    $('.btn_hide').hide();
                    }
                });
});
                
$("#btnaceptar").click(function( ) {
   
   var respuesta = confirm('Esta seguro de Aprobar este Proyecto?');
   
   if (respuesta == true) {
     
     $('#proyecto-respuesta_aprob').val(1);
     jsShowWindowLoad('Procesando...');
     return true;
   }
    
    return false;
});

/*
$("#btn_observacion").click(function( ) {
   
   if($.trim($("#proyecto-observacion").val()) != '') {
        var respuesta = confirm('Esta seguro de Observar este Proyecto?');
        
        if (respuesta == true) {
          $('#proyecto-respuesta_aprob').val(0);
          jsShowWindowLoad('Procesando...');
          return true;
        }
    }
    else
    {
      $("#mensajeobs").html("<label style='color:red;'>Por favor ingrese el Motivo de la Observación</label>"); 
    }
    return false;
});
*/
function monto_presupuesto(id)
{
    var array = [];
   $.ajax({
                    url: '<?= $verf_presupuesto ?>',
                    type: 'GET',
                    async: false,
                    data: {id:id},
                    success: function(data){
			var valor = jQuery.parseJSON(data);
		        array[0] = valor.estado;
			array[1] = valor.mensaje;
			
			;
                    }
                });
   return array
}




  
  </script>