<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroMetaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-meta-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_meta') ?>

    <?= $form->field($model, 'id_tipo') ?>

    <?= $form->field($model, 'cantidad') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'id_user_obs') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
