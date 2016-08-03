<div ng-app="app" ng-controller="appCtrl as vm">
<h1>Pruebo Ajax</h1>
<section>
<form ng-submit="vm.enviar()">
Nombre: <input type="text" ng-model="vm.fdatos.nombre">
<br>
Edad: <input type="text" ng-model="vm.fdatos.edad">
<br>
<input type="submit" value="Enviar">
</form>
</section>
</div>
<?php $rutaobetivoe= Yii::$app->getUrlManager()->createUrl('objetivoe/respuesta'); ?>
<script>
angular
.module('app', [])
.controller('appCtrl', ['$http', controladorPrincipal]);
function controladorPrincipal($http){
var vm=this;
//inicializo un objeto en los datos de formulario
vm.fdatos = {};
// declaro la función enviar
vm.enviar = function(){
$.post("<?= $rutaobetivoe ?>", {'order_list':  JSON.stringify(vm.fdatos)})
.success(function(res){
           console.log(res);
//por supuesto podrás volcar la respuesta al modelo con algo como vm.res = res;
});
}
}

</script>