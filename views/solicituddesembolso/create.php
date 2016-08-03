<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SolicitudDesembolso */

$this->title = Yii::t('app', 'Create Solicitud Desembolso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Solicitud Desembolsos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-desembolso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
