<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Aprobaciones;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModificarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modificar Proyecto');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyecto-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    if(\Yii::$app->user->can('investigador'))
            {
                ?>
    <p>
        <?= Html::a(Yii::t('app', 'Nuevo Cambio'), ['accion'], ['class' => 'btn btn-success','id'=>'nuevo_cambio']) ?>
    </p>
    <?php }?>
    <div class="col-md-1"></div>
   <div class="col-md-11">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'titulo',
            //'vigencia',
            //'ubigeo',
            //'id_direccion_linea',
            //'date_create',
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
            // 'tipo_registro',
            // 'situacion',
            // 'estado',
            [
                //'label'=>'Estado',
                'attribute' => 'date_create',
                'format'=>'raw',
                /*'value'=>function($data) {
                    
                    if($data->situacion == 1 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
                    if($data->situacion == 0 ){return "<span style='color:red;'><strong>Pendiente</strong><span>"; }                         
                    
                },*/
                'contentOptions'=>['style'=>'width: 250px;','class'=>'text-center'], 
                'headerOptions'=>['class'=>'text-center'],
                //'width'=>'60px',
            ],
            [
                'label'=>'Tipo',
                'attribute' => 'modificacion',
                'format'=>'raw',
                'value'=>function($data) {
                    
                    if($data->modificacion == 1 ){return "Datos Generales"; }
                    if($data->modificacion == 3 ){return "Objetivos e Indicadores"; }
                    if($data->modificacion == 4 ){return "Actividades"; }
                    if($data->modificacion == 5 ){return "Recursos"; }
                    
                },
                //'width'=>'60px',
            ],
            [
                //'label'=>'Estado',
                'attribute' => 'situacion',
                'format'=>'raw',
                'value'=>function($data) {
                    $nivelApro = 0;
                    
                    if($data->situacion == 3 ){return "<span style='color:blue;'><strong>Anulado</strong><span>"; }
                    if($data->situacion == 2 ){return "<span style='color:green;'><strong>Completo</strong><span>"; }
                    
                    if(Yii::$app->user->identity->id_perfil == 2)
                    {
                        if($data->situacion == 1 ){return "<span style='color:red;'><strong>Pendiente</strong><span>"; }
                        if($data->situacion == 0 ){return "<span style='color:Orange;'><strong>Incompleto</strong><span>"; }  
                    }
                    
                    if($data->modificacion == 1 )
                    {
                      if($data->situacion == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 2; }
                    
                    /*if(Yii::$app->user->identity->id_perfil == 6)
                    { $nivelApro = 1; }*/
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:Orange;'><strong>Incompleto</strong><span>";  
                    }
                    
                        
                    }
                    
                    if($data->situacion == 1 )
                    {
                    if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 2; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:red;'><strong>Pendiente</strong><span>";   
                    }
                    
                     
                    
                    }
                    
                    }
                    
                    if($data->modificacion == 3 )
                    {
                      if($data->situacion == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 6; }
                    
                    /*if(Yii::$app->user->identity->id_perfil == 6)
                    { $nivelApro = 1; }*/
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:Orange;'><strong>Incompleto</strong><span>";  
                    }
                    
                        
                    }
                    
                    if($data->situacion == 1 )
                    {
                    if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 6; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:red;'><strong>Pendiente</strong><span>";   
                    }
                    
                     
                    
                    }
                    
                    }
                    
                    
                    
                    
                    if($data->modificacion == 4 )
                    {
                      if($data->situacion == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 10; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 11; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:Orange;'><strong>Incompleto</strong><span>";  
                    }
                    
                        
                    }
                    
                    if($data->situacion == 1 )
                    {
                    if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 10; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 11; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:red;'><strong>Pendiente</strong><span>";   
                    }
                    
                     
                    
                    }
                    
                    }
                    
                    
                    
                    if($data->modificacion == 5 )
                    {
                      if($data->situacion == 0 )
                    {
                        if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 8; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 9; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:Orange;'><strong>Incompleto</strong><span>";  
                    }
                    
                        
                    }
                    
                    if($data->situacion == 1 )
                    {
                    if(Yii::$app->user->identity->id_perfil == 3)
                    { $nivelApro = 8; }
                    
                    if(Yii::$app->user->identity->id_perfil == 4)
                    { $nivelApro = 9; }
                    
                    $aprobacion = Aprobaciones::find()->where('estado = 1 and id_proyecto = :id_proyecto and id_nivelaprobacion = :id_nivelaprobacion',[':id_proyecto'=>$data->id,':id_nivelaprobacion'=>$nivelApro])->one();
                    
                    if($aprobacion)
                    {
                      return "<span style='color:green;'><strong>Completo</strong><span>";   
                    }
                    else
                    {
                     return "<span style='color:red;'><strong>Pendiente</strong><span>";   
                    }
                    
                     
                    
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
            
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{modificardatosgen}',
             'buttons' => [
                'modificardatosgen' => function ($url, $model) /*use ($event)*/{
                    if($model->situacion != 0){$valor = 1; $icon = 'glyphicon-search';}else{$valor=2;$icon = 'glyphicon-pencil';}
                        $url .= '&event='.$valor; 
                        return Html::a('<span class="glyphicon '.$icon.'"><input type="hidden" value="'.$model->situacion.'" id="situacion" /></span>', $url, 
                        [
                            'title' => '',
                            'class'=>'ver',
                        ]);
                },
                
                
                /*'modificardatosgen' => function ($url, $model) {
                        $url .= '&event=2'; 
                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, 
                        [
                            'title' => Yii::t('app', 'Change today\'s lists'),
                        ]);
                        }*/
              ]
             
             
             ],
            ],
    ]); ?>
    </div>
    <div class="col-md-1"></div>
</div>

<?php

    $verificar_pendientes= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_registros_pendientes');
    $verificar_desembolso= Yii::$app->getUrlManager()->createUrl('proyecto/verificar_desembolsos_pendientes');
    $verificar_ejecutados= Yii::$app->getUrlManager()->createUrl('registrometa/verificar_metas');
?>


<script>
    
  $("#nuevo_cambio").click(function() {
       //alert("llego");
       var valor1 = 0;
       var valor2 = null;
       var valor3 = null;
        $.ajax({
                    url: '<?= $verificar_pendientes ?>',
                    type: 'GET',
                    async: false,
                    //data: {unidadejecutora:unidad.val()},
                    success: function(data){
                      valor1 = data;
                    }
                });
        
        if (valor1 > 0) {
           
           $.notify({
                message: "<strong>No es posible esta Acción: </strong>Tiene un Registro de Cambio Pendiente." 
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
        
        
        $.ajax({
                    url: '<?= $verificar_desembolso ?>',
                    type: 'GET',
                    async: false,
                    //data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        
                      valor2 = data;
                      
                    }
                });
        
        
        if (valor2 > 0) {
           
           $.notify({
                message: "<strong>No es posible esta Acción: </strong>Tiene Desembolsos Pendientes." 
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
        
        
        
        $.ajax({
                    url: '<?= $verificar_ejecutados ?>',
                    type: 'GET',
                    async: false,
                    //data: {unidadejecutora:unidad.val()},
                    success: function(data){
                        
                      valor3 = data;
                      
                    }
                });
        
        
        if (valor3 > 0) {
           
           $.notify({
                message: "<strong>No es posible esta Acción: </strong>Tiene Registro de Metas en Proceso." 
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
  
$(".ver").click(function(){
    
   var user = <?= Yii::$app->user->identity->id_perfil; ?>;
   
   
   if(user != 2)
    {
        situacion = $(this).children().children().val();
        if (situacion == 0)
        {
            $.notify({
                message: "El registro se encuentra Inconcluso."
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
    } 
        return true;
    });
    
</script>