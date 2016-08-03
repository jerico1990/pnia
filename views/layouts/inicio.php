<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language = 'es' ?>" ng-app >
<head>
    <meta charset="<?= Yii::$app->charset = 'UTF-8'?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .btnrecuperar:focus
        {
            border: 2px solid #449d44;
            background: #449d44;
            color: white;
        }
        .btnrecuperar:hover
        {
            border: 2px solid #449d44;
            background: #449d44;
            color: white;
        }
        .btnrecuperar
        {
            border: 2px solid #449d44;
            background: white;
            color: #449d44;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" style="background: #EAEAEA;margin: 0px;padding: 0px;margin: 0px;border-top:10px solid #449d44">
    
    <!--<div class="container " style="width:100%;background: white;padding: 0px;">
        <div class="col-md-10 " style="float:none;margin:0 auto;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px; border: 0px;margin-bottom:  0px;">
           <?= Html::img('../img/login.png',['class'=>'img-responsive', 'alt'=>'Responsive image','style'=>'margin:0px;padding:0px;height:70px']);?>
        </div>
    </div>-->
    <div class="container" style="padding-top: 0px;padding-bottom: 10px;border-top-right-radius: 0px;border-top-left-radius: 0px; border: 0px;margin-top:  0px;background: #EAEAEA;color: white">
            &nbsp
    </div>
    <div class="container" style="padding-top: 5px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
