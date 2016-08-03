<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyecto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vigencia')->dropDownList() ?>

    <?php // $form->field($model, 'ubigeo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_direccion_linea')->textInput() ?>

    <?= $form->field($model, 'id_unidad_ejecutora')->textInput() ?>

    <?= $form->field($model, 'id_dependencia_inia')->textInput() ?>

    <?= $form->field($model, 'id_tipo_proyecto')->textInput() ?>

    <?= $form->field($model, 'desc_tipo_proy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_programa')->textInput() ?>

    <?= $form->field($model, 'id_cultivo')->textInput() ?>

    <?= $form->field($model, 'id_especie')->textInput() ?>

    <?= $form->field($model, 'id_areatematica')->textInput() ?>

    <?= $form->field($model, 'resumen_ejecutivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'relevancia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'objetivo_general')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_trabajo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resultados_esperados')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'presupuesto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'referencias_bibliograficas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problematica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ind_prob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'med_prob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_prob')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proposito')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ind_prop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'med_prop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sup_prop')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_propietario')->textInput() ?>
    
     <?= $form->field($model, 'situacion')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput() ?>

    <div class="form-group">
        <?php // Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
