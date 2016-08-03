<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\Usuarios;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroMeta */

$this->title = ($registroMeta->id_tipo == 1)?'Indicador':'Actividad';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Registro Metas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['options' => ['class' => '', ]]); ?>
<div class="registro-meta-view">
    <?= \app\widgets\observacion\ObservacionWidget::widget(['maestro'=>'RegistroMeta','titulo'=>'Motivo del Rechazo:','tipo'=>'1']); ?>
    <br/><br/>
    <label><strong></strong>Tipo de Registro: </strong><?= Html::encode($this->title) ?></label>
            <input type="hidden"  id="id" name="RegistroMeta[id_meta]" value="<?= $registroMeta->id; ?>" />
            <input type="hidden" value="" id="registrometa-respuesta_aprob" name="RegistroMeta[respuesta_aprob]" /> 
<div class="clearfix"></div><br/>
                <div class="col-xs-12 col-sm-7 col-md-2"></div>
                <div class="col-xs-12 col-sm-7 col-md-8">
		   
                    <table class="table table-striped table-bordered" id="ejecutado_table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                 <?= ($registroMeta->id_tipo == 1)?'Indicador':'Actividad' ?>
                                </th>
				<th class="text-center">
                                    Ejecutado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach($registroMetaDet as $registroMetaDet2){ ?>
                            <tr id='ejecutado_addr_0'>
                                <td><?= $i ?></td>
                                <td><?= $registroMetaDet2->des_indact ?></td>
                                <td class="text-center"><?= $registroMetaDet2->cantidad ?></td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                    <br/><br/>
                <div class="col-xs-12 col-sm-7 col-md-2"></div>
                <div class="clearfix"></div>

</div>
                <?php
                    if($registroMeta->observacion != null){
                        $datos_user = Usuarios::find()
                                        ->select('usuarios.Name,perfil.descripcion,usuarios.id_perfil')
                                            ->innerJoin('perfil','perfil.id=usuarios.id_perfil')
                                            ->where('usuarios.id=:id_user',[':id_user'=>$registroMeta->id_user_obs])
                                            ->one();
                        ?>
                        <div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
                    <div class="col-xs-12 col-sm-7 col-md-8" >
                            <div class="panel panel-<?= ($datos_user->id_perfil == 2) ? 'info':'danger' ?>">
                                
                                <div class="panel-heading">
                                  <h4 class="panel-title"><?= $datos_user->Name; ?>(<?= $datos_user->descripcion; ?>) - <?= $registroMeta->fecha_aprobacion; ?></h4>
                                </div>
                                
                                <div class="panel-body">
                                 <?= $registroMeta->observacion; ?>
                                </div>
                                
                            </div>  
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-2" ></div>
                    
                    <?php } ?>
                
                <?php
                if(Yii::$app->user->identity->id_perfil == 2)
                {
                    ?>
                <div class="clearfix"></div><br/><br/>
                
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                <div class="col-xs-12 col-sm-7 col-md-6" >
                        <table class="table  " border=1 name="DetalleRendicion[detalle_tabla]" id="detalle_tabla" border="0">
                        <thead>
                            <tr class="info">
                                <th class="text-center" >
                                    #
                                </th>
                                <th class="text-center" >
                                    Usuario Aprobador
                                </th>
                                <th class="text-center">
                                    Estado
                                </th>
                        </thead>
                        <tbody>
                            
                            <tr class="text-center">
                                <td>1</td>
                                <td><?= $user_aprueba ?></td>
                                <td><?= $estado_aprueba ?></td>
                            </tr>
                            
                        </tbody>
                        </table>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-3" ></div>
                
                <?php } ?>
                
                
                <div class="clearfix"></div><br/><br/>
		<div class="col-xs-12 col-sm-7 col-md-4" ></div>
                <div class="col-xs-12 col-sm-7 col-md-8 col-centered" >
                <?php
                if(Yii::$app->user->identity->id_perfil != 2)
                {
                    if($registroMeta->estado == 0){
                ?>
                    
                    <button style="" type="button" id="btnrechaza" class="btn btn-danger " data-toggle="modal" data-target="#modalobs_">Rechazar</button>  
                    <button type="submit" id="btnaceptar" class="btn btn-success ">Aceptar</button>
                    <a class="btn btn-primary" href="index?id=<?= $registroMeta->id_user; ?>" role="button">Regresar</a>
                <?php }else{ ?>
                     <a class="btn btn-primary" href="index" role="button">Regresar</a>
                <?php }}else{ ?>
                
                    <a class="btn btn-primary" href="index" role="button">Regresar</a>
                <!--<button type="submit" id="btndetalle" class="btn btn-primary" >Guardar</button>-->
                
                <?php } ?>
		</div>
<?php ActiveForm::end(); ?>


<script>
    
    $("#btnaceptar").click(function( ) {
   
   var respuesta = confirm('Esta seguro de Aprobar este Desembolso?');
   
   if (respuesta == true) {
     
     $('#registrometa-respuesta_aprob').val(1);
     jsShowWindowLoad('Procesando...');
     return true;
   }
    
    return false;
    });
    
    
</script>