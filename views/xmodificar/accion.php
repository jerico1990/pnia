<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Create Usuarios';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div>
    <h3>Nueva Modificación</h3>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-opcion required">
                <label for="proyecto-opcion">Seleccione Formulario:</label>
                <select class="form-control" id="proyecto-opcion" "  name="Proyecto[opcion]" >
                    <option value="1">Datos Generales</option>
                    <!--<option value="2">Financiamiento</option>-->
                    <option value="3">Objetivos e Indicadores</option>
                    <option value="4">Actividades</option>
                    <option value="5">Recursos y Programación</option>
                </select>
                </div>    
    </div>
    <div class="clearfix"></div><br/>
    <div class="col-xs-12 col-sm-7 col-md-12 col-centered" > 
        <button type="submit" id="btnmodificar" class="btn btn-success">Modificar</button>   
    </div>
<?php ActiveForm::end(); ?>
</div>

<script>
    
$("#btnmodificar").click(function(){
    
jsShowWindowLoad("Procesando Solicitud...");
return true;
});
    
</script>