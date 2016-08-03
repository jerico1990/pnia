<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RecursoProgramado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recurso-programado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_recurso')->textInput() ?>

    <?= $form->field($model, 'anio')->textInput() ?>

    <?= $form->field($model, 'mes')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
