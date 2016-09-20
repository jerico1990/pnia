<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RendicionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Lista de Rendiciones');
$this->params['breadcrumbs'][] = $this->title;


$floor = 1;
if (isset($_GET['page']) >= 2)
    $floor += ($rendiciones['pages']->pageSize * $_GET['page']) - $rendiciones['pages']->pageSize;

    
?>
<div class="rendicion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if(Yii::$app->user->identity->id_perfil == 2)
        { ?>
    <p>
        <?= Html::a(Yii::t('app', 'Nueva Rendición'), ['detalle'], ['class' => 'btn btn-success','id'=>'nueva_rendicion']) ?>
    </p>
   <?php } ?>
   
   <div class="col-md-2"></div>
   <div class="col-md-10">
    <table class="table">
        <thead>
            <th>Nro Rendición</th>
            <th>Nro de Desembolso</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>
            <th>Monto Rendido</th>
        </thead>
        <tbody>
            <?php $total=0;?>
            <?php foreach($rendiciones['rendiciones'] as $rendicion){?>
            <tr>
                <td><?= $rendicion["id"] ?></td>
                <td><?= $rendicion["id_solicitud"] ?></td>
                <td><?= $rendicion["fecha"] ?></td>
                <td>
                    <?php 
                    if($rendicion["estado"] == 2 ){echo "<span style='color:green;'><strong>Aprobado</strong><span>"; }
                    if($rendicion["estado"] == 0 ){echo "<span style='color:blue;'><strong>Registrado</strong><span>"; }
                    if($rendicion["estado"] == 3 ){echo "<span style='color:red;'><strong>Rechazado</strong><span>"; }
                    ?>
                </td>
                <td>
                    <?= Html::a('<span class="fa fa-search">Ver</span>',['rendicion/view','id'=>$rendicion["id"]],['title'=>'Ver Desembolso','class'=>'btn btn-primary btn-xs ver']);?>
                    
                    
                </td>
                <td>
                    <?php  //echo $rendicion["total"];
                    if($rendicion["estado"] == 2 ){echo $rendicion["total"]; $total=$total+$rendicion["total"];}
                    ?>
                    
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total</td>
                <td><?= $total?></td>
            </tr>
        </tfoot>
    </table>
    <?= LinkPager::widget([
            'pagination' => $rendiciones['pages'],
            'lastPageLabel' => true,
            'firstPageLabel' => true
        ]);?>
    
    <?php /*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_solicitud',
            //'id_user',
            'fecha',
            
            [
                'label'=>'Estado',
                'attribute' => 'estado',
                'format'=>'raw',
                'value'=>function($data) {
                    
                    if($data->estado == 2 ){return "<span style='color:green;'><strong>Aprobado</strong><span>"; }
                    if($data->estado == 0 ){return "<span style='color:blue;'><strong>Registrado</strong><span>"; }
                    if($data->estado == 3 ){return "<span style='color:red;'><strong>Rechazado</strong><span>"; }
                    //if($data->estado == 2 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
               
                            
                    
                },
                'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}',
             'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="fa fa-search">Ver</span>', $url, [
                                'title' => Yii::t('app', 'Ver Desembolso'),
                                'class'=>'btn btn-primary btn-xs ver',
                                
                    ]);
                }
              ]
             
             ],
        ],
    ]); */ ?>
   
   
    </div>
    <div class="col-md-1"></div>
</div>
<?php

    $verificar_desembolso_disp= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_desembolsos_disponible');
?>
<script>
  
  $("#nueva_rendicion").click(function() {
       //alert("llego");
       var valor1 = 0;
       var valor2 = null; 
        
        
        $.ajax({
                    url: '<?= $verificar_desembolso_disp ?>',
                    type: 'GET',
                    async: false,
                    //data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        
                      valor2 = data;
                      
                    }
                });
        
        
        if (valor2 == 0) {
           
           $.notify({
                message: "<strong>No es posible esta Acción: </strong>No tiene Deselmbolsos Aprobados." 
            },{
                type: 'danger',
                offset: 20,
                spacing: 10,
                z_index: 1031,
                placement: {
                    from: 'top',
                    align: 'right'
                },
            });
           
           return false;
        }
        
        
        
        return true;
        
    });
    
</script>