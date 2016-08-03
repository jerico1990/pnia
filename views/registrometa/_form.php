<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroMeta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-meta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_meta')->textInput() ?>

    <?= $form->field($model, 'id_tipo')->textInput() ?>

    <?= $form->field($model, 'cantidad')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_user_obs')->textInput() ?>

    <?= $form->field($model, 'observacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
