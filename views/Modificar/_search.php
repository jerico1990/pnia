<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModificarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo') ?>

    <?= $form->field($model, 'vigencia') ?>

    <?= $form->field($model, 'ubigeo') ?>

    <?= $form->field($model, 'id_direccion_linea') ?>
    
    <?= $form->field($model, 'date_create') ?>

    <?php // echo $form->field($model, 'id_unidad_ejecutora') ?>

    <?php // echo $form->field($model, 'id_dependencia_inia') ?>

    <?php // echo $form->field($model, 'id_tipo_proyecto') ?>

    <?php // echo $form->field($model, 'desc_tipo_proy') ?>

    <?php // echo $form->field($model, 'id_programa') ?>

    <?php // echo $form->field($model, 'id_cultivo') ?>

    <?php // echo $form->field($model, 'id_especie') ?>

    <?php // echo $form->field($model, 'id_areatematica') ?>

    <?php // echo $form->field($model, 'resumen_ejecutivo') ?>

    <?php // echo $form->field($model, 'relevancia') ?>

    <?php // echo $form->field($model, 'objetivo_general') ?>

    <?php // echo $form->field($model, 'plan_trabajo') ?>

    <?php // echo $form->field($model, 'resultados_esperados') ?>

    <?php // echo $form->field($model, 'presupuesto') ?>

    <?php // echo $form->field($model, 'referencias_bibliograficas') ?>

    <?php // echo $form->field($model, 'problematica') ?>

    <?php // echo $form->field($model, 'ind_prob') ?>

    <?php // echo $form->field($model, 'med_prob') ?>

    <?php // echo $form->field($model, 'sup_prob') ?>

    <?php // echo $form->field($model, 'proposito') ?>

    <?php // echo $form->field($model, 'ind_prop') ?>

    <?php // echo $form->field($model, 'med_prop') ?>

    <?php // echo $form->field($model, 'sup_prop') ?>

    <?php // echo $form->field($model, 'user_propietario') ?>

    <?php // echo $form->field($model, 'tipo_registro') ?>

    <?php // echo $form->field($model, 'situacion') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
