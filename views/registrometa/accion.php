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
    <h3>Registrar Meta</h3>
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-12 col-sm-7 col-md-12" >
                <div class="form-group field-proyecto-opcion required">
                <label for="registrometa-id_tipo">Seleccione Tipo de Meta a Registrar:</label>
                <select class="form-control" id="registrometa-id_tipo" "  name="RegistroMeta[id_tipo]" >
                    <option value="1">Indicador</option>
                    <option value="2">Actividad</option>
                </select>
                </div>    
    </div>
    <div class="clearfix"></div><br/>
    <div class="col-xs-12 col-sm-7 col-md-12 col-centered" > 
        <button type="submit" id="btnmodificar" class="btn btn-success">Registrar</button>   
    </div>
<?php ActiveForm::end(); ?>
</div>

<script>
    
$("#btnmodificar").click(function(){
    
jsShowWindowLoad("Procesando Solicitud...");
return true;
});
    
</script>