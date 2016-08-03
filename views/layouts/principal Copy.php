<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\PrincipalAsset;
use yii\web\JsExpression;
use app\models\Modulo;
use app\models\Menus;
use app\models\Usuarios;
use app\models\Proyecto;
use yii\web\Session;

$Asset = PrincipalAsset::register($this);
$baseUrl = $Asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
      <?= Html::csrfMetaTags() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.3/angular.min.js" type="text/javascript"></script>-->
            
 <?php     header('Content-Type: text/html; charset=UTF-8');
            mb_internal_encoding('UTF-8');
?>
   <!-- <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
    <style>
#WindowLoad
{
    position:fixed;
    top:0px;
    left:0px;
    z-index:3200;
    filter:alpha(opacity=65);
   -moz-opacity:65;
    opacity:0.65;
    background:#999;
}
</style>
    
</head>
  <body>
<?php $this->beginBody() ?>


<div id="header" style="border-top:10px solid #449d44">
<div class="container " style="width:100%;background: white;padding: 0px;">
        <div class="col-md-3 " style="float:right;margin:0 auto;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px; border: 0px;margin-bottom:  0px;">
           <?= Html::img(Yii::$app->homeUrl.'/img/logo-principal.png',['class'=>'img-responsive', 'alt'=>'Responsive image','style'=>'margin:0px;padding:0px;height:55px']);?>
        </div>
    </div>
</div>
<div id="lateral">
<div id="user_login">
<img src="<?= Yii::$app->homeUrl.'img/admin.jpg';?>" class="user-image" alt="User Image">
<span><?= Yii::$app->user->identity->Name; ?></span>
<?= Html::a( 'Cerrar Sesión',['login/logout'],['class'=>'']); ?>
</div>
<div id="nav">
       <?php

           // if(\Yii::$app->user->can('investigador'))
           // {

            if(\Yii::$app->user->can('investigador'))
            {
                  $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
                        
                  $proyecto_situacion = Proyecto::find()
                        ->where('situacion = 0 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
                        
                  $session = Yii::$app->session;
                  
                  $session['proyecto_id'] = $proyecto->id;
               
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta.'?event=1&type='.$proyecto->tipo_registro.'&situation='.$proyecto_situacion],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            
           // }
            

            }
            else if(\Yii::$app->user->can('administrador'))
            {
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            }
            else if(\Yii::$app->user->can('estacion'))
            {
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            }
            else if(\Yii::$app->user->can('pnia_tecnico'))
            {
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            }
            else if(\Yii::$app->user->can('pnia_financiero'))
            {
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            }
            
            else if(\Yii::$app->user->can('unidad_ejecutora'))
            {
                $modulos=Usuarios::find()
                                    ->select('modulo.id mid,modulo.descripcion')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->innerJoin('modulo','modulo.id = menus.id_modulo')
                                    ->where('usuarios.id=:user_id and accesos.estado=1 and  modulo.estado=1 and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id])
                                    ->groupBy('modulo.id,modulo.descripcion')
                                    ->all();
                                    
                foreach($modulos as $modulo)
                {
                    echo '
              <a href="#">
                <span>'.$modulo->descripcion.'</span>
              </a>
              <ul class="treeview-menu">';
                
               // var_dump($modulo->descripcion);die;
                
                $menus= Usuarios::find()
                                    ->select('menus.descripcion, menus.ruta')
                                    ->innerJoin('perfil','perfil.id = usuarios.id_perfil')
                                    ->innerJoin('accesos','accesos.id_pefil = perfil.id')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('usuarios.id=:user_id and menus.estado=1 and accesos.estado=1 and menus.id_modulo=:id_modulo and menus.visible=1',[':user_id'=>Yii::$app->user->identity->id,':id_modulo'=>$modulo->mid])
                                    ->all();
                
                
                    foreach($menus as $menu)
                    {
                        echo Html::a( $menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</br>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul>';
                
                }
            }
            
            ?>

</div>
</div>
<div id="section">
<?= $content ?>
</div>


<!--<div id="footer">
Copyright © W3Schools.com
</div>
-->    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
/*
$('.numerico').keypress(function (tecla) {
        var reg = /^[0-9\s]+$/;
        if(!reg.test(String.fromCharCode(tecla.which))){
            return false;
        }
        return true;
        
    });
*/

$(document).ready(function(){
      
        $('.decimal').numeric({ decimalPlaces: 2 });
        $('.entero').numeric(false); 
        
    });

function getNum(val) {
   if (val == '') {
     return 0;
   }
   return val;
}


function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();
 
}

function ejecutar_numeric() {
      $('.decimal').numeric({ decimalPlaces: 2 });
        $('.entero').numeric(false);

}
 
function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();
 
    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined) mensaje = "Procesando la información<br>Espere por favor";
 
    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;
 
    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined) ancho = window.screen.width;
    else ancho = window.innerWidth;
    if (window.innerHeight == undefined) alto = window.screen.height;
    else alto = window.innerHeight;
 
    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
 
   //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:"+alto+"px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img  src='<?= Yii::$app->homeUrl."/img/load.gif" ?>'></div>";
 
        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);
 
        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        input = document.createElement("input");
        input.id = "focusInput";
        input.type = "text"
 
        //asignamos el div que bloquea
        $("#WindowLoad").append(input);
 
        //asignamos el foco y ocultamos el input text
        $("#focusInput").focus();
        $("#focusInput").hide();
 
        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);
 
}
</script>
