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
use app\models\Perfil;

$Asset = PrincipalAsset::register($this);
$baseUrl = $Asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
      <?= Html::csrfMetaTags() ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js" type="text/javascript"></script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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

.sidebar .sidebar-menu .active .treeview-menu {
    display: block;
}
</style>
    
</head>
  <body class="hold-transition skin-blue sidebar-mini" >
    <div class="wrapper" style="background: #fff;">
<?php $this->beginBody() ?>
<header class="main-header">
        <!-- Logo -->
        <a href="../dashboard/index" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>NIA</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Sistema </b>PNIA</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= Yii::$app->homeUrl.'img/'.Yii::$app->user->identity->img;?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= Yii::$app->user->identity->Name;?><?= (Yii::$app->user->identity->id_perfil == 2)? ' ('.Yii::$app->user->identity->username.')':''  ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= Yii::$app->homeUrl.'img/'.Yii::$app->user->identity->img;?>"  class="img-circle" alt="User Image">
                    <p>
                        <?php
                              $perfil = Perfil::findOne(Yii::$app->user->identity->id_perfil);
                        
                        ?>
                      <?= Yii::$app->user->identity->Name;?> <br/> <?= $perfil->descripcion ?> <br/> <?= (Yii::$app->user->identity->id_perfil == 2)? 'Usuario: '.Yii::$app->user->identity->username:''  ?> <br/>
                      <!--<small>Member since Nov. 2012</small>-->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!--<li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li>-->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <?= Html::a( 'Cerrar Sesión',['login/logout'],['class'=>'btn btn-default btn-flat']); ?>
                      <!--<a href="login/logout" class="btn btn-default btn-flat">Sign out</a>-->
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!--<li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>-->
            </ul>
          </div>
        </nav>
      </header>

<!--<div id="header" style="border-top:10px solid #449d44">
<div class="container " style="width:100%;background: white;padding: 0px;">
        <div class="col-md-3 " style="float:right;margin:0 auto;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px; border: 0px;margin-bottom:  0px;">
           <?php // Html::img(Yii::$app->homeUrl.'/img/logo-principal.png',['class'=>'img-responsive', 'alt'=>'Responsive image','style'=>'margin:0px;padding:0px;height:55px']);?>
        </div>
    </div>
</div>-->


<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel 
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?= Yii::$app->homeUrl.'img/'.Yii::$app->user->identity->img;?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?= Yii::$app->user->identity->Name;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">PANEL DE NAVEGACION</li>
            
            <?php
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
                  if(($proyecto->estado == 1) && ($proyecto->situacion != 2))
                  {
                   unset($modulos[1]);      
                  }
                                   
                foreach($modulos as $modulo)
                {
                        
                    echo '
              <li class="treeview active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>'.$modulo->descripcion.'</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
              
              <ul class="treeview-menu menu-open">';
                
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
                        echo '<li>'.Html::a( '<i class="fa fa-circle-o text-aqua"></i> '.$menu->descripcion,[$menu->ruta.'?event=1&type='.$proyecto->tipo_registro.'&situation='.$proyecto_situacion],['options' => ['class' =>'','id'=>'','name'=>'' ]]).'</li>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul></li>';
                
                }
            }
            else if(!\Yii::$app->user->can('investigador'))
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
              <li class="treeview active">
              <a href="#">
                <i class="fa fa-edit"></i> <span>'.$modulo->descripcion.'</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
              
              <ul class="treeview-menu menu-open">';
                
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
                        echo '<li>'.Html::a( '<i class="fa fa-circle-o text-aqua"></i> '.$menu->descripcion,[$menu->ruta],['options' => ['class' => '','id'=>'','name'=>'' ]]).'</li>';
                        /*echo Html::a( 'Datos Generales',[$menu->ruta.'#general'],['class'=>'']).'</br>';
                        echo Html::a( 'Áreas Claves',[$menu->ruta.'#areas'],['class'=>'']).'</br>';
                        echo Html::a( 'Marco Lógico',[$menu->ruta.'#logico'],['class'=>'']).'</br>';
                        echo Html::a( 'Otros',[$menu->ruta.'#otros'],['class'=>'']).'</br>';*/
                    }
                    
                    echo '</ul></li>';
                
                }
            }
            
            ?>
            
           <!-- <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Layout Options</span>
                <span class="label label-primary pull-right">4</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>UI Elements</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Forms</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-table"></i> <span>Tables</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
              </ul>
            </li>
            <li>
              <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <small class="label pull-right bg-red">3</small>
              </a>
            </li>
            <li>
              <a href="pages/mailbox/mailbox.html">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <small class="label pull-right bg-yellow">12</small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Examples</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
              </ul>
            </li>
            <li><a href="documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
          </ul>-->
        </section>
        <!-- /.sidebar -->
      </aside>










<div class="content-wrapper" style="background: #fff; height: auto; display: inline-block; min-width: 1024px; padding-left: 2cm; padding-right: 2cm;">

<?= $content ?>

</div>

<!--
<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
</footer>-->

<!--<div id="footer">
Copyright © W3Schools.com
</div>
-->    
<?php $this->endBody() ?>
    </div></div>
</body>

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

function moneda_soles(sender) {
            $(sender).formatCurrency({
                region: 'es-PE'
                , roundToDecimalPlace: -1
            });
        }

</script>
</html>