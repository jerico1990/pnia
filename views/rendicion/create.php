<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rendicion */

$this->title = Yii::t('app', 'Create Rendicion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendicions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendicion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
