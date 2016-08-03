<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

?>


<div>

	<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
            <div>
                
            <h3><strong>    Mi Proyecto | </strong><span style=" font-size: medium">Desembolso</span></h3>
            
            </div>
            
		
                <div class="col-xs-12 col-sm-7 col-md-12">
                 <input type="hidden" name="Aportante[proyecto_id]" value="<?= $proyecto_id; ?>" />   
                    <?= \app\widgets\desembolsos\DesembolsosWidget::widget(['id_proyecto'=>$proyecto_id]); ?>  
                    
                </div>
                
        <?php ActiveForm::end(); ?>
</div>