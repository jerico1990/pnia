<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<h1>Formulario</h1>

<h3><?= $mensaje ?></h3>
<?= Html::beginForm(
                    Url::toRoute("site/request"),
                    "get",
                    ['Class'=> 'form-inline']                    

);?>

<div Class="form-group">
    <?= Html::label("Introduce tu Nombre","nombre") ?>
    <?= Html::textInput("nombre",null,["class"=>"form-control"]) ?>
    
</div>

<?= Html::SubmitInput("Enviar Nombre",["Class" => "btn btn-primary"]) ?>

<?= Html::endForm() ?>