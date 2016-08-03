<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RecursoProgramado */

$this->title = Yii::t('app', 'Create Recurso Programado');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recurso Programados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recurso-programado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
