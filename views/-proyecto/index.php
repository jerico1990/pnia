<script>
    angular.module("myApp", ["ngTable"]);
    
</script>

<h2>Lista de Proyectos</h2>
<div>
    
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Nuevo
  </button>    
    
</div>

<div class="variables-matrix">
    
    <table ng-table="vm.tableParams" class="table" show-filter="true">
    <tr>
      <th>ID</th>
      <th>Proyecto</th>
      <th>Presupuesto</th>
   </tr>
<?php

 //var_dump($model);
 foreach($model as $proyecto)
 {
    echo '<tr ng-repeat="user in $data"><td title="id"  sortable="id">'.(string)$proyecto->id.'</td>'.'<td title="titulo"  sortable="titulo">'.$proyecto->titulo.'</td>'.'<td title="presupuesto"  sortable="presupuesto">'.(string)$proyecto->presupuesto.'</td><td><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button></td></tr>';
 }
?>

    </table>
    
</div>