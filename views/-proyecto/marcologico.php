<div id="contenido" ng-app="app">

<ul class="tabs">
    <li><a href="#tab1">Objetivos</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/indicador') ?>">Indicadores</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/actividad') ?>">Actividades</a></li>
    <li><a href="<?= Yii::$app->getUrlManager()->createUrl('proyecto/recursos') ?>">Recursos</a></li>
  </ul>
  <div class="clr"></div>
  <section class="block">
    <article id="tab1">
        <form name="formObjetivos">
        <div ng-controller="objetivoeCtrl">
        
        
        <div class="col-xs-12 col-sm-7 col-md-12" >
            <h5>Objetivo General</h5>
                <!--<label for="proyecto-objetivo_general">Señale Objeto General:</label>-->
                <textarea class="form-control" type="text"  placeholder="..."  rows="10" cols="80" style="margin: 0px; width: 100%; height: 40px;" id="proyecto-objetivo_general" name="Proyecto[objetivo_general]" ng-model="adatos.objetivo_general" required>{{adatos.objetivo_general}}</textarea>
        </div>
        
        <?= \app\widgets\objetivosespecificos\ObjetivosEspecificosWidget::widget(['proyecto_id'=>$proyecto->id]); ?> 
        <div id="control_boton">
                <button type="submit" ng-click="grabaroe()" id="btn_objetivos_especificos" class="btn btn-primary" ng-disabled="!formObjetivos.$valid" >Guardar</button>
        </div>
        
        </div>
        </form>
    </article>

  </section>
  
 </div>       
  <?php
    $eliminaractividad= Yii::$app->getUrlManager()->createUrl('proyecto/eliminarobjetivoespecifico');
?>
  
  <script>

  $(function(){
  $('ul.tabs li:nth-child(1)').addClass('active');
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
})
    
  </script>