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





<!--<form class="contact_form" action="#" id="contact_form" runat="server">-->

    <?php $form = ActiveForm::begin(['options' => ['class' => 'contact_form', ]]); ?>
    <div><a name="general" ></a>
        <ul>
            <li>
                <h2 name="general">1. Datos Generales</h2>
                <span class="required_notification">* Datos requeridos</span>
            </li>
            
            <li>
                <h4>1.1 Titulo del Proyecto</h4>
                <input type="hidden" value="<?= $proyecto->id?>" id="proyecto-id" name="Proyecto[id]" /> 
                <label for="proyecto-titulo">Nombre del Proyecto:</label>
                <input type="text" value="<?= $proyecto->titulo?>" placeholder="Nombre del Proyecto" id="proyecto-titulo" name="Proyecto[titulo]"  required/> <!-- required-->
                
             
                
            </li>
            <li>
                <h4>1.2 Dependencia del INIA que Ejecutara el Proyecto</h4>
                <label for="proyecto-direccion_linea">Señale Dirección en Linea:</label>
                <input type="text" value="<?= $proyecto->direccion_linea?>" placeholder="Señale Dirección en Linea" id="proyecto-direccion_linea" name="Proyecto[direccion_linea]"  required/> <!-- required-->
                
             
                
            </li>
            <li>
                <label for="proyecto-estacion_exp">Señale Estación Experimental Agraria:</label>
                <input type="text" value="<?= $proyecto->estacion_exp?>" placeholder="Señale Estación Experimental Agraria" id="proyecto-estacion_exp" name="Proyecto[estacion_exp]"  required/> <!-- required-->
                
            </li>
            <li>
                <label for="proyecto-sub_estacion_exp">Señale Sub Estación Experimental Agraria:</label>
                <input type="text" value="<?= $proyecto->sub_estacion_exp?>" placeholder="Señale Sub Estación Experimental Agraria" id="proyecto-sub_estacion_exp" name="Proyecto[sub_estacion_exp]"  required/> <!-- required-->
                
            </li>
            <li>
                <h4>1.3 Nombres y Apellidos del Responsable Técnico del Proyecto</h4>
                <label for="proyecto-nombres">Nombres:</label>
                <input type="text" value="<?= $responsable->nombres?>" placeholder="Nombres" id="proyecto-nombres" name="Proyecto[nombres]"  required/> <!-- required-->
                
            </li>
            <li>
                <label for="proyecto-apellidos">Apellidos:</label>
                <input type="text" value="<?= $responsable->apellidos?>" placeholder="Apellidos" id="proyecto-apellidos" name="Proyecto[apellidos]"  required/> <!-- required-->
                
            </li>
            <li>
                <label for="proyecto-telefono">Teléfono Fijo:</label>
                <input type="text" value="<?= $responsable->telefono?>" placeholder="Teléfono Fijo" id="proyecto-telefono" name="Proyecto[telefono]"  required/> <!-- required-->
                
            </li>
            <li>
                <label for="proyecto-celular">Celular:</label>
                <input type="text" value="<?= $responsable->celular?>" placeholder="Celular" id="proyecto-celular" name="Proyecto[celular]"  required/> <!-- required-->
                
            </li>
            <li>
                <label for="proyecto-correo">Correo Electrónico:</label>
                <input type="text" value="<?= $responsable->correo?>" placeholder="Correo Electrónico" id="proyecto-correo" name="Proyecto[correo]"  required/> <!-- required-->
                <span class="form_hint">Formato correcto: "nombre@dominio.com"</span>
                
            </li>
            
            <li>
                <h4>1.4 Lista de Nombres y Colaboradores Técnicos del Proyecto y Función Técnica</h4>
                <?= \app\widgets\colaboradores\ColaboradoresWidget::widget(['id'=>$proyecto->id]); ?> 
                                
            </li>
            <li>
                <h4>1.5 Alianza Estratégica establecidas para el Proyecto</h4>
                <?= \app\widgets\instituciones\InstitucionesWidget::widget(['proyecto_id'=>$proyecto->id]); ?> 
                
                
            </li>
                        <li>
                <h4>1.6 Resumen Ejecutivo del Proyecto</h4>
                <label for="proyecto-resumen_ejecutivo">Descripción:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 150px;" id="proyecto-resumen_ejecutivo" name="Proyecto[resumen_ejecutivo]"  required><?= $proyecto->resumen_ejecutivo?></textarea>

            </li>
            <li>
                <h4>1.7 Relevancia del Proyecto y Referencias a Resultados Obtenidos en INIA u otras Instituciones</h4>
                <label for="proyecto-relevancia">Descripción:</label>
                <textarea type="text" placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 150px;" id="proyecto-relevancia" name="Proyecto[relevancia]"  required><?= $proyecto->relevancia?></textarea>

            </li>
            </br></br></br><a name="areas" ></a>
            <li>
                <h2 name="areas">2. Áreas Claves</h2>
                
            </li>
            
            <li>
                <h4>   2.1 Cultivo o Crianza priorizado en su Proyecto</h4>
                
                <input type="hidden" value="<?= $cultivo->id?>" id="proyecto-idcc" name="Proyecto[idcc]" /> 
                <label for="proyecto-tipocc">Cultivo o Crianza:</label>
                <select id="proyecto-tipocc" name="Proyecto[tipocc]" style="width:200px;">
                 <option value="0">--Seleccione--</option>   
                 <?php
                 
                    $maestro = Maestros::find()
                                ->where('id_padre = 1 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($maestro as $maestros)
                            {
                ?>
                                <option value="<?= $maestros->id; ?>" <?=($maestros->id == $cultivo->tipo)?'selected':'' ?> > <?= $maestros->descripcion ?></option>;
                    <?php   } ?>
                      
                        
                    
                 
                    
                </select>
                
                
            </li>
            <li id="descripcioncc">
                <label for="proyecto-descripcioncc">Especifique:</label>
                <input type="text" value="<?= $cultivo->descripcion; ?>" placeholder="..." id="proyecto-descripcioncc" name="Proyecto[descripcioncc]" />
                
            </li>
            <li>
                <h4>2.2 Señale una Acción Transversal de Áreas Temáticas Específicas</h4>
                
                <label for="proyecto-idat">Acción Transversal:</label>
                <select id="proyecto-idat" name="Proyecto[idat]" style="width:200px;">
                    <option value="0">--Seleccione--</option>
                <?php
                 
                    $accionTrans = Maestros::find()
                                ->where('id_padre = 10 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                           foreach($accionTrans as $accionTransv)
                            {
                ?>
                                <option value="<?= $accionTransv->id; ?>" <?=($accionTransv->id == $AccionT->id_accion_transversal)?'selected':'' ?> > <?= $accionTransv->descripcion ?></option>;
                    <?php    } ?>

                 
                </select>
                
                
            </li>
            <li id="especifiqueAT">
                <label for="proyecto-otrosat">Especifique:</label>
                <input type="text" value="<?= $AccionT->otros; ?>" placeholder="..." id="proyecto-otrosat" name="Proyecto[otrosat]"/>
                
            </li>
            <li>
                <h4>2.3 Señale el Tipo de Proyecto</h4>
                
                <label for="proyecto-id_tipo_proyecto">Invetigación:</label>
                <select id="proyecto-id_tipo_proyecto" name="Proyecto[id_tipo_proyecto]" style="width:200px;">
                    <option value="0">--Seleccione--</option>
                    <?php
                 
                    $tipoInv = Maestros::find()
                                ->where('id_padre = 16 and estado = 1')
                                ->orderBy('orden')
                                ->all();

                    
                           foreach($tipoInv as $tipoInvs)
                            {
                    ?>
                               <option value="<?= $tipoInvs->id; ?>" <?=($tipoInvs->id == $proyecto->id_tipo_proyecto)?'selected':'' ?> > <?= $tipoInvs->descripcion ?></option>;
                    <?php   } ?>

                 

                </select>
                
                
            </li>
            <li>
                <label for="proyecto-desc_tipo_proy">Descripción:</label>
                <textarea type="text" placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 100px;" id="proyecto-desc_tipo_proy" name="Proyecto[desc_tipo_proy]"  required><?= $proyecto->desc_tipo_proy?></textarea>
                
                
            </li>
            
            </br></br></br><a name="logico" ></a>
            <li>
                <h2>3. Marco Lógico</h2>
                
            </li>

            <li>
                <h4>3.1 Objetivo</h4>
                <h5>3.1.1 Objetivo General</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 80px;" id="proyecto-objetivo_general" name="Proyecto[objetivo_general]"  required><?= $proyecto->objetivo_general?></textarea>
            </li>
            <li>
                <h5>3.1.2 Objetivos Especificos</h5>
                <?= \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['proyecto_id'=>$proyecto->id]); ?> 

            </li>
            <li>
                <h4>3.2 Indicadores</h4>
                <?= \app\widgets\indicadores\IndicadoresWidget::widget(['proyecto_id'=>$proyecto->id]); ?>
            </li>
            
            <li>
                <h4>3.3 Actividades</h4>
                <h5>3.3.1 Actividades del Proyecto</h5>
                <?= \app\widgets\actividades\ActividadesWidget::widget(['proyecto_id'=>$proyecto->id]); ?>
            </li>
            <li>
                <h5>3.3.2 Cronograma del Proyecto</h5>
                <?= \app\widgets\cronogramas\CronogramasWidget::widget(['proyecto_id'=>$proyecto->id]); ?>
                
            </li>
            <li>
                <h4>3.4 Recursos</h4>
                <h5>3.4.1 Recursos y Costos</h5>
                <a href="#">Lista de Recursos y Costos</a>
            </li>
            <li>
                <h5>3.4.2 Detallar la Infraestructura, Equipos, y Apoyo Logístico disponibles y solicitados para el desarrollo del proyecto</h5>
                <a href="#">
                 Lista de Recursos del Proyecto 
                </a>
            </li>
            
            </br></br></br><a name="otros" ></a>
            <li>
                <h2>4. Otros</h2>
                
            </li>
            <li>
                <h4>4.1 Lugar de acción donde se ejecutará el trabajo de Investigación</h4>
                <?= \app\widgets\zonaaccion\ZonaAccionWidget::widget(['proy_zonaaccion_id'=>$proyecto->id]); ?> 
                
            </li>
            <li>
                <h4>4.2 Plan de Trabajo</h4>
                <label for="proyecto-plan_trabajo">Descripción:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 300px;" id="proyecto-plan_trabajo" name="Proyecto[plan_trabajo]"  required><?= $proyecto->plan_trabajo?></textarea>

                
            </li>
            <li>
                <h4>4.3 Resultados Esperados en Innovación Agraria o Transferencia de Tecnología</h4>
                <label for="proyecto-resultados_esperados">Descripción:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 200px;" id="proyecto-resultados_esperados" name="Proyecto[resultados_esperados]"  required><?= $proyecto->resultados_esperados?></textarea>

            </li>
            <li>
                <h4>4.4 Presupuesto del Proyecto</h4>
                <label for="proyecto-presupuesto">Monto Total:</label>
                <input type="text" value="<?= $proyecto->presupuesto?>" placeholder="Presupuesto"  id="proyecto-presupuesto" name="Proyecto[presupuesto]"  required/>
                
            </li>
            <li>
                <h4>4.5 Lista de Referencias Bibliográficas</h4>
                <label for="proyecto-referencias_bibliograficas">Señale las Referencias:</label>
                <textarea type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 600px; height: 200px;" id="proyecto-referencias_bibliograficas" name="Proyecto[referencias_bibliograficas]"  required><?= $proyecto->referencias_bibliograficas?></textarea>

            </li>
            <li>
            <button type="submit" id="btnproyecto" class="btn btn-primary">Guardar</button>
            </li>
            <li>
                
                
            </li>
        
        </ul>
    </div>
    
    
    
    
 <?php ActiveForm::end(); ?>


<?php

    $urlproyectoExiste= Yii::$app->getUrlManager()->createUrl('proyecto/existeproyecto');
    $urlresponsable= Yii::$app->getUrlManager()->createUrl('responsable/guardar');
    /*$validarintegrante2= Yii::$app->getUrlManager()->createUrl('equipo/validarintegrante2');
    $existeequipo=Yii::$app->getUrlManager()->createUrl('equipo/existeequipo');*/
?>


<script type="text/javascript">
$(document).ready(function(){
 
if($.trim($('select[id=proyecto-tipocc]').val())=='0')
        { $("#descripcioncc").hide();}
else    {$("#descripcioncc").show();;}

if($.trim($('select[id=proyecto-idat]').val())!='15')
        { $("#especifiqueAT").hide();}
else    {$("#especifiqueAT").show();;}

$('#proyecto-presupuesto').keydown(function (){
            this.value = (this.value + '').replace(/[^0-9]/g, '');
          });


});

$('#proyecto-tipocc').change(function(){ 
     var valor = $('#proyecto-tipocc').val(); 
     
     if (valor != 0) {
       $("#descripcioncc").show();;
     }
     else
     {
      $("#descripcioncc").hide();  
     }
     //saludo(nombre); 
});

$('#proyecto-idat').change(function(){ 
     var valor2 = $('#proyecto-idat').val(); 
     
     if (valor2 == 15) {
       $("#especifiqueAT").show();
     }
     else
     {
      $("#especifiqueAT").hide();  
     }
    // saludo(valor2); 
});

$("#btnproyecto").click(function( ) {
    
    var error='';
    if($.trim($('#proyecto-titulo').val())=='')
        {
            error=error+'Ingrese Nombre del Proyecto<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-direccion_linea').val())=='')
        {
            error=error+'Señale la Dirección en Linea<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-estacion_exp').val())=='')
        {
            error=error+'Señale la Estación Experimental<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-sub_estacion_exp').val())=='')
        {
            error=error+'Señale la Sub Estación Experimental<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-nombres').val())=='')
        {
            error=error+'Ingrese Nombres del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-apellidos').val())=='')
        {
            error=error+'Ingrese Apellidos del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
    if($.trim($('#proyecto-telefono').val())=='')
        {
            error=error+'Ingrese Nro Teléfonico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-celular').val())=='')
        {
            error=error+'Ingrese Nombre Nro Celular del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
    
     if($.trim($('#proyecto-correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }

     if($.trim($('select[id=proyecto-tipocc]').val())=='0')
        {
            error=error+'Seleccione Cultivo O Crianza<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
     if($.trim($('select[id=proyecto-idat]').val())=='0')
        {
            error=error+'Seleccione Acción Transversal<br>';
            $('#proyecto-idat').addClass('has-error');
            //alert('hola');
        }
    if($.trim($('select[id=proyecto-id_tipo_proyecto]').val())=='0')
        {
            error=error+'Seleccione el Tipo de Investigación<br>';
            $('#proyecto-tipoInvestigacion').addClass('has-error');
            //alert('hola');
        }
    
    /*if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }
        
    if($.trim($('#proyecto-Correo').val())=='')
        {
            error=error+'Ingrese Correo Electrónico del Responsable<br>';
            $('#proyecto-titulo').addClass('has-error');
            //alert('hola');
        }*/
        
                 
        
    if(error!='')
        {
            $.notify({
                message: error 
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
        
       /* var id = $('#proyecto-id').val();
        var titulo = $('#proyecto-id').val();
        var direccion_linea = $('#proyecto-direccion_linea').val();
        var estacion_exp = $('#proyecto-estacion_exp').val();
        var sub_estacion_exp = $('#proyecto-sub_estacion_exp').val();
        var nombres = $('#responsable-nombres').val();
        var apellidos = $('#responsable-apellidos').val();
        var telefono = $('#responsable-telefono').val();
        var celular = $('#responsable-celular').val();
        var correo = $('#responsable-correo').val();*/
        
  /*  var validarproyecto=$.ajax({
                url: '<? $urlproyecto ?>',
                type: 'POST',
                async: false,
                data: {'Proyecto[id]':id,'Proyecto[titulo]':titulo,'Proyecto[direccion_linea]':direccion_linea,'Proyecto[estacion_exp]':estacion_exp,'Proyecto[sub_estacion_exp]':sub_estacion_exp},
                success: function(data){
                    
                }
            });    */
        
        
        
    
    return true;
});


$("#proyecto-colaboradores").click(function( ) {
    var existe=$.ajax({
                url: '<?= $urlproyectoExiste ?>',
                type: 'POST',
                async: false,
                //data: {},
                success: function(data){
                    
                }
            });
    if(existe.responseText!=1)
        {
            $.notify({
                message: existe.responseText
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
});

</script>

