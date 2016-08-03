<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>


<h1>Validar Formulario</h1>

<?php $Form = ActiveForm::begin([
    
    "method" => "post",
    "enableClientValidation" => true,
    
]);
?>

<div class="form-group">    
 <?= $Form->field($model,"nombre")->input("text") ?>   
</div>
<div class="form-group">    
 <?= $Form->field($model,"email")->input("email") ?>   
</div>

<?= Html::submitbutton("Enviar",["class"=>"btn btn-primary"]) ?>

<?php $Form->end() ?>
