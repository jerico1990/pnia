<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Proyecto */

$this->title = Yii::t('app', 'Create Proyecto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
