<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $model app\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
$this->title ="Login";
?>
<style>
/*@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");*/

body{
   /* background: url(https://unsplash.imgix.net/photo-1415226581130-91cb7f52f078?q=75&fm=jpg&s=859a0a6f863f8eb93a489c98402e687b);
	background-color: #444;*/
    background-size:   cover;
    background-repeat: no-repeat;
    background-position: center center;  
    /*background: url(https://unsplash.imgix.net/photo-1415226581130-91cb7f52f078?q=75&fm=jpg&s=859a0a6f863f8eb93a489c98402e687b),url(http://mymaplist.com/img/parallax/pinlayer1.png),url(http://mymaplist.com/img/parallax/back.png);    
*/
}

.vertical-offset-100{
    padding-top:100px;
}
.login .user-row{
    background-color: white;
    text-align: center;
    font-size: 30px;
}

.login .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
    margin: auto;
}

.login.panel {
    margin-bottom: 20px;
    background-color: white;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}
.login label{
    display: block;
    width: 100%;
    color: #449d44;
    text-shadow:#4cae4c;
    text-align: center;
}
.login hr{
    margin: 5px;
}
</style>

<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default login">
			  	<div class="panel-heading" style ='background-color: white;'>                            
                    <div class="row-fluid user-row">
                        <img src="<?= Yii::$app->homeUrl.'img/logo.jpg';?>" class="img-responsive" width="150" height="120">
                    </div>
                    <!--<h3 class="panel-title user-row"> VISION System</h3> -->
			 	</div>
			  	<div class="panel-body">
                    <div class="form-group">
    		    		  <label>ACCESO AL SISTEMA</label>
                          <hr>
			    	</div>
                    
                    <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-12">
               <?= $form->field($model,'username',['template' => '<div class="col-md-12"><div class="input-group col-md-12">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>{input}</div></div><div class="col-md-12">{error}</div>',])
                        ->textInput(['placeholder'=>'Ingresa tu usuario'])
                        ->label(false) ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
               <?= $form->field($model, 'password',['template' => '<div class="col-md-12"><div class="input-group col-md-12">
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}</div></div><div class="col-md-12">{error}</div>',])
                        ->passwordInput(['placeholder'=>'Ingresa tu contraseña'])
                        ->label(false)->error(['class' => 'help-block']) ?>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">         
               <div class="col-md-12">
               <?= Html::submitButton('INGRESAR AHORA', ['id'=>'y01','class' =>'btn azul btn-block btnrecuperar']) ?>
               </div>
            </div>
            <?php ActiveForm::end(); ?>
			<!--    	<form accept-charset="UTF-8" role="form">
                    <fieldset>
                        
                        
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>-->
			    </div>
			</div>
		</div>
	</div>
</div>