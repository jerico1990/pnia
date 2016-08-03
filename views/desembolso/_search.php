<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DesembolsoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recurso-programado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_recurso') ?>

    <?= $form->field($model, 'anio') ?>

    <?= $form->field($model, 'mes') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?php // echo $form->field($model, 'cant_rendida') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
