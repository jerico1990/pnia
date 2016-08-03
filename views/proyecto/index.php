<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Aprobaciones;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProyectoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="block">
<div class="proyecto-index">

   <!-- <h1><?= Html::encode($this->title) ?></h1>-->
   <h3><strong>    Proyectos | </strong><span style=" font-size: medium">Lista de Proyectos</span></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                //'label'=>'Estado',
                'attribute' => 'id',
                'format'=>'raw',
                'value'=>function($data){
                    
                    $usuario = Usuarios::findOne($data->user_propietario);
                    
                    return $usuario->username;
                        
                    },
                'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            'titulo',
            'vigencia',
           // 'ubigeo',
           //  'id_direccion_linea',
            // 'id_unidad_ejecutora',
            // 'id_dependencia_inia',
            // 'id_tipo_proyecto',
            // 'desc_tipo_proy',
            // 'id_programa',
            // 'id_cultivo',
            // 'id_especie',
            // 'id_areatematica',
            // 'resumen_ejecutivo',
            // 'relevancia',
            // 'objetivo_general',
            // 'plan_trabajo',
            // 'resultados_esperados',
            // 'presupuesto',
            // 'referencias_bibliograficas',
            // 'problematica',
            // 'ind_prob',
            // 'med_prob',
            // 'sup_prob',
            // 'proposito',
            // 'ind_prop',
            // 'med_prop',
            // 'sup_prop',
            // 'user_propietario',
            //'situacion',
            // 'estado',
            [
                //'label'=>'Estado',
                'attribute' => 'situacion',
                'format'=>'raw',
                'value'=>function($data) {
                    $nivelApro = 0;
                    
                    if($data->situacion == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 5; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 1; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:red;'><strong>Incompleto</strong><span>";  
                    }
                    
                        
                    }
                    
                    if($data->situacion == 2 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
                
                    if($data->situacion == 1 ){
                    if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 5; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 1; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:orange;'><strong>Pendiente</strong><span>";   
                    }
                    
                     
                    
                    }
                    
                    
                    
                /*return  '<select id="accion_'.$data->id.'" class="form-control" onchange="ValorProyecto('.$data->id.')">
                            <option value=0>--Selec. Opción--</option>
                            <option value=4>Datos Generales</option>
                            <option value=5>Financiamiento</option>
                            <option value=6>Objetivos e Indicadores</option>
                            <option value=7>Actividades</option>
                            <option value=9>Recursos</option>
                        </select>';*/
                            
                    
                },
                'contentOptions'=>['style'=>'width: 120px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
             /*[
                'label'=>'',
                //'attribute' => 'codigo_modular',
                'format'=>'raw',
                'value'=>function($data) {

                return  '<select id="accion_'.$data->id.'" class="form-control" onchange="ValorProyecto('.$data->id.')">
                            <option value=0>--Selec. Opción--</option>
                            <option value=4>Datos Generales</option>
                            <option value=5>Financiamiento</option>
                            <option value=6>Objetivos e Indicadores</option>
                            <option value=7>Actividades</option>
                            <option value=9>Recursos</option>
                        </select>';
                            
                    
                },
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'110px',
            ],*/
           ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}',
             'buttons' => [
                'view' => function ($url, $model) {
                    $url .= '&event=1';
                    return Html::a('<span class="fa fa-search">Ver<input type="hidden" value="'.$model->situacion.'" id="situacion" /></span>', $url, [
                                'title' => Yii::t('app', 'Ver Proyecto'),
                                'class'=>'btn btn-primary btn-xs ver',
                                'id'=>'ver',
                                
                    ]);
                }
              ]
             
             
             ],
        ],
    ]); ?>

</div>
</section>
<?php
$ValorProyecto= Yii::$app->getUrlManager()->createUrl('proyecto/valorproyecto');
?>
<script>
    
    function ValorProyecto(proyecto) {
        
       var accion = $("#accion_"+proyecto).val();
       var xhr;

    var fn = function(){
        if(xhr && xhr.readyState != 4){
            xhr.abort();
        }
        
        xhr = $.ajax({
            url: '<?= $ValorProyecto ?>',
            type: 'GET',
            async: false,
            data: {proyecto:proyecto,accion:accion},
            
        });
        
        };
        
         var interval = setInterval(fn, 1);
    }

    $(".ver").click(function(){
        situacion = $(this).children().children().val();
        if (situacion == 0)
        {
            $.notify({
                message: "El registro se encuentra Inconcluso u Observado"
                },{
                type: 'danger',
                z_index: 1000000,
                placement: {
                    from: 'bottom',
                    align: 'right'
                },
            });
          return false;
        }
        
        return true;
    });

</script>
