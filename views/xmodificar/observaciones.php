<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use app\models\Usuarios;
use app\models\Perfil;

?>



<div id="form1">
    
<ul class="tabs">
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/modificardatosgen?id='.$proyecto->id.'&event='.$evento.'') ?>">Datos Generales</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('modificar/modificarfinanciamiento?id='.$proyecto->id.'&event='.$evento.'') ?>" >Financiamiento</a></li>
    <!--<li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Objetivos e Indicadores</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Actividades</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Recursos</a></li>-->
    <?php if($observaciones){ ?>
    <li><a href="#tab6" >Observaciones</a></li>
    <?php } ?>
</ul>
  <div class="clr"></div>
  <section class="block">
    
    <article id="tab6">
        
        <?php
        if($observaciones){
        foreach($observaciones as $obs)
        {
            $datos_user = Usuarios::find()
                            ->select('usuarios.Name,perfil.descripcion,usuarios.id_perfil')
                                ->innerJoin('perfil','perfil.id=usuarios.id_perfil')
                                ->where('usuarios.id=:id_user',[':id_user'=>$obs->id_user])
                                ->one();
            ?>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
        <div class="col-xs-12 col-sm-7 col-md-8" >
                <div class="panel panel-<?= ($datos_user->id_perfil == 2) ? 'info':'danger' ?>">
                    
                    <div class="panel-heading">
                      <h4 class="panel-title"><?= $datos_user->Name; ?>(<?= $datos_user->descripcion; ?>) - <?= $obs->fecha; ?></h4>
                    </div>
                    
                    <div class="panel-body">
                     <?= $obs->observacion; ?>
                    </div>
                    
                </div>  
        </div>
        <div class="col-xs-12 col-sm-7 col-md-2" ></div>
        <div class="clearfix"></div>
        <?php }} ?>
    </article>
    
  </section>
  
 </div>

<script>

 $(document).ready(function(){
    
    
 $('ul.tabs li:nth-child(3)').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });    

});  
</script>