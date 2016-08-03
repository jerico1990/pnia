<?php

namespace app\controllers;

use Yii;
use app\models\Rendicion;
use app\models\Recurso;
use app\models\SolicitudDesembolso;
use app\models\Maestros;
use app\models\RendicionSearch;
use app\models\DetalleRendicion;
use app\models\RecursoProgramado;
use yii\web\Controller;
use app\models\Proyecto;
use app\models\Usuarios;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\RendicionArchivo;
/**
 * RendicionController implements the CRUD actions for Rendicion model.
 */
class RendicionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Rendicion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='principal';
        

        if(!empty($_REQUEST["id"]))
        {
            $id=$_REQUEST["id"];
            

        }
        else
        {
            $id = 'no';
        }
        
        if($id){$user = $id;}
        
        $id = 0;
        $searchModel = new RendicionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id,$user);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rendicion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout='principal';
        
        $totales = 0;
        $hoy = getdate();
        
        $model = new DetalleRendicion();
        
        //svar_dump($model->load(Yii::$app->request->post()));
        if ($model->load(Yii::$app->request->post()))
        {

            $countregistros = count(array_filter($model->anio));
             //var_dump($countregistros);
             //var_dump($model->respuesta_aprob);die;  
           if($model->respuesta_aprob == 0)
                {
                    //$dRendicion = DetalleRendicion::findOne($model->detalle_ids[0]);
                    
                    for($i=0;$i<$countregistros;$i++)
                    {
                        $dRendicion = DetalleRendicion::findOne($model->detalle_ids[$i]);
                        $programado = RecursoProgramado::find()
                                        ->where('recurso_programado.id_recurso = :id_recurso and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':id_recurso'=>$dRendicion->id_recurso,':anio'=>$model->anio[$i],':mes'=>$model->mes[$i]])
                                        ->one();
                        
                        //var_dump($programado->cant_rendida);die;
                        $programado->cant_rendida = ($programado->cant_rendida - $model->cantidad[$i]);
                        //$programado->precio_unit_rendido = $detRendicion->precio_unit;
                          $programado->estado = 1;  
                        $programado->update();
                          
                    }
                    
                    
                    
                    $rendicion = Rendicion::findOne($model->id_ren);
                    $rendicion->observacion = $model->observacion;
                    $rendicion->estado = 3;
                    $rendicion->fecha_aprobacion = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                    $rendicion->id_user_obs = Yii::$app->user->identity->id;
                    $rendicion->update();
                    
                    //DetalleSolicitud::updateAll(['estado' => 3], 'id_solicitud = :id_solicitud',[':id_solicitud'=>(int)$model->id_sol]);

                    
                }
                
                if($model->respuesta_aprob == 1)
                {
                    if(Yii::$app->user->identity->id_perfil == 5)
                    {
                        for($i=0;$i<$countregistros;$i++)
                        {
                            
                           $totales += ($model->cantidad[$i] * $model->precio_unit[$i]);
                              
                        }
                        
                        $rendicion = Rendicion::findOne($model->id_ren);
                        $rendicion->estado = 2;
                        $rendicion->fecha_aprobacion = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                        $rendicion->id_user_obs = Yii::$app->user->identity->id;
                        $rendicion->update();

                        
                        
                        $desem = SolicitudDesembolso::findOne($rendicion->id_solicitud);
                        $desem->total_pendiente = ($desem->total_pendiente - $totales);
                        $desem->update();
                    }
                    
                    
                    
                }
                
              
            
            return $this->redirect('proyecto');
            
                
              
            
        
          /*  $countregistros = count(array_filter($model->clasificador_id));
            
            
            $hoy = getdate();
            
            $desembolsos = SolicitudDesembolso::find()
                            ->where('estado = 1 and id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id])
                            ->one();
           
                    for($i=0;$i<$countregistros;$i++)
                    {
                        $recurso = Recurso::findOne($model->descripcion[$i]);
                        
                        $detRendicion=new DetalleRendicion;
                        $detRendicion->id_rendicion = $model->id_ren;
                        $detRendicion->id_clasificador= $model->clasificador_id[$i];
                        $detRendicion->id_recurso=$recurso->id;
                        $detRendicion->descripcion=$recurso->detalle;
                        $detRendicion->mes=$model->mes[$i];
                        $detRendicion->anio=$model->anio[$i];
                        $detRendicion->cantidad=$model->cantidad[$i];
                        $detRendicion->precio_unit=$model->precio_unit[$i];
                        $detRendicion->total= ($model->cantidad[$i] * $model->precio_unit[$i]);
                        $detRendicion->ruc=$model->ruc[$i];
                        $detRendicion->razon_social=$model->razon_social[$i];
                        $detRendicion->save();
                        
                        
                        //var_dump([':id_recurso'=>$detRendicion->id_recurso,':anio'=>$detRendicion->anio,':mes'=>$detRendicion->mes]);die;
                        $programado = RecursoProgramado::find()
                                        ->where('recurso_programado.id_recurso = :id_recurso and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':id_recurso'=>$detRendicion->id_recurso,':anio'=>$detRendicion->anio,':mes'=>$detRendicion->mes])
                                        ->one();
                        
                        //var_dump($programado->cant_rendida);die;
                        $programado->cant_rendida = ($programado->cant_rendida + $detRendicion->cantidad);
                        $programado->precio_unit_rendido = $detRendicion->precio_unit;
                        if($programado->cant_rendida == $programado->cantidad)
                        {
                          $programado->estado = 2;  
                        }
                        $programado->update();
                        
                        $totales += $detRendicion->total;
                        
                        
                    }
                    
                   $desem = SolicitudDesembolso::findOne($desembolsos->id);
                   $desem->total_pendiente = ($desem->total_pendiente - $totales);
                   $desem->update();
                    
                    
            return $this->redirect('index');*/
            
        }
        else
        {
            $rendicion = Rendicion::findOne($id);
          $detRendicion =  DetalleRendicion::find()->where('id_rendicion = :id_rendicion',[':id_rendicion'=>$id])->all();
          
          $clasif = Maestros::find()
                                ->where('id_padre = 32 and estado = 1')
                                ->orderBy('orden')
                                ->all();
          
          $clasificadores = RecursoProgramado::find()
                        ->select('recurso.clasificador_id, maestros.descripcion')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  ',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->groupBy(['recurso.clasificador_id'])
                                ->all();
                                
                               // var_dump($clasificadores);die;
            $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>$rendicion->id_user])
                        ->one();
             if($rendicion->id_user_obs == null)
             {
               $user_ap = Usuarios::find()->where('estado = 1 and ejecutora = :ejecutora',[':ejecutora'=>$proyecto->id_unidad_ejecutora])->one();
               $user_aprueba = $user_ap->Name;
               $estado_aprueba = "PENDIENTE";
             }
             else
             {
                $user_ap = Usuarios::findOne($rendicion->id_user_obs);
                $user_aprueba = $user_ap->Name;
                if($rendicion->observacion != null)
                {
                   $estado_aprueba = "RECHAZADO"; 
                }
                else
                {
                    $estado_aprueba = "APROBADO";
                }
                
             }
            
        }
        
        return $this->render('view',['clasificadores'=>$clasificadores,'detRendicion'=>$detRendicion,'clasif'=>$clasif,'rendicion'=>$rendicion,'user_aprueba'=>$user_aprueba,'estado_aprueba'=>$estado_aprueba]);
    }

    /**
     * Creates a new Rendicion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rendicion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rendicion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rendicion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rendicion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rendicion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rendicion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionDetalle()
    {
        $this->layout='principal';
        
        $totales = 0;
        
        $model = new DetalleRendicion();
        
        //svar_dump($model->load(Yii::$app->request->post()));
        if ($model->load(Yii::$app->request->post()))
        {
            $countregistros = count(array_filter($model->clasificador_id));
            
            //var_dump($countregistros);die;
            
            $hoy = getdate();
            
            $desembolsos = SolicitudDesembolso::find()
                            ->where('estado = 1 and id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id])
                            ->one();
           // var_dump($desembolsos->id);die;                
                        $rendicion=new Rendicion();
                        $rendicion->id_user= Yii::$app->user->identity->id;
                        $rendicion->fecha= $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                        $rendicion->id_solicitud = $desembolsos->id;
                        $rendicion->save();
            
                    /*if($model->detalle_ids[$i] != '')
                    {
                        $Colaborador=Aportante::findOne($proyecto->colaboradores_ids[$i]);
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->colaborador=$proyecto->aportante_colaborador[$i];
                        $Colaborador->regimen=$proyecto->aportante_regimen[$i];
                        $Colaborador->tipo_inst=$proyecto->aportante_tipo_inst[$i];
                        $Colaborador->tipo=3;
                        $Colaborador->update(); 
                    }
                    else
                    {*/
                    for($i=0;$i<$countregistros;$i++)
                    {
                        $recurso = Recurso::findOne($model->descripcion[$i]);
                        
                        $detRendicion=new DetalleRendicion();
                        $detRendicion->id_rendicion = $rendicion->id;
                        $detRendicion->id_clasificador= $model->clasificador_id[$i];
                        $detRendicion->id_recurso=$recurso->id;
                        $detRendicion->descripcion=$recurso->detalle;
                        $detRendicion->mes=$model->mes[$i];
                        $detRendicion->anio=$model->anio[$i];
                        $detRendicion->cantidad=$model->cantidad[$i];
                        $detRendicion->precio_unit=$model->precio_unit[$i];
                        $detRendicion->total= ($model->cantidad[$i] * $model->precio_unit[$i]);
                        $detRendicion->ruc=$model->ruc[$i];
                        $detRendicion->razon_social=$model->razon_social[$i];
                        $detRendicion->save();
                        
                        //var_dump($model->clasificador_id[$i].'-'.$model->mes[$i].'-'.$model->anio[$i].'-'.$model->cantidad[$i].'-'.$model->precio_unit[$i].'-'.($model->cantidad[$i] * $model->precio_unit[$i]).'-'.$model->ruc[$i].'-'.$model->razon_social[$i]);die;
                        //var_dump([':id_recurso'=>$detRendicion->id_recurso,':anio'=>$detRendicion->anio,':mes'=>$detRendicion->mes]);die;
                        $programado = RecursoProgramado::find()
                                        ->where('recurso_programado.id_recurso = :id_recurso and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':id_recurso'=>$detRendicion->id_recurso,':anio'=>$detRendicion->anio,':mes'=>$detRendicion->mes])
                                        ->one();
                        
                        //var_dump($programado->cant_rendida);die;
                        $programado->cant_rendida = ($programado->cant_rendida + $detRendicion->cantidad);
                        $programado->precio_unit_rendido = $detRendicion->precio_unit;
                        if($programado->cant_rendida == $programado->cantidad)
                        {
                          $programado->estado = 2;  
                        }
                        $programado->update();
                        
                        $totales += $detRendicion->total;
                        
                        
                    }
                    //var_dump($_FILES);die;
                    $model->archivos = UploadedFile::getInstances($model, 'archivos');
                    foreach ($model->archivos as $file) {
                        $archivo=new RendicionArchivo;
                        $archivo->fecha_registro=date("Y-m-d H:i:s");
                        $archivo->estado=1;
                        $archivo->rendicion_id=$rendicion->id;
                        $archivo->save();
                        
                        $archivo->archivo=$archivo->id. '.' . $file->extension;
                        $archivo->update();
                        $file->saveAs('archivos/' . $archivo->id . '.' . $file->extension);
                        //$file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                    }
                    //var_dump($model->archivos);
                    //die;
                   /*$desem = SolicitudDesembolso::findOne($desembolsos->id);
                   $desem->total_pendiente = ($desem->total_pendiente - $totales);
                   $desem->update();*/
                    //}
                    
            return $this->redirect('index');
            
        }
        else
        {
          $clasificadores = RecursoProgramado::find()
                        ->select('recurso.clasificador_id, maestros.descripcion')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  ',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->groupBy(['recurso.clasificador_id'])
                                ->all();
                                
                               // var_dump($clasificadores);die;
        }
        
        return $this->render('detalle',['clasificadores'=>$clasificadores]);
    }
    
    
    public function actionObtener_descripcion_recurso($clasificador,$user)
    {
        $option = '<option value="0">--Seleccione--</option>';
       $descripcion = RecursoProgramado::find()
                        ->select('recurso.id, recurso.detalle')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id',[':user_propietario'=>$user,':clasificador_id'=>$clasificador])
                                ->groupBy(['recurso.id'])
                                ->all();
                            
        foreach($descripcion as $des)
        {
           $option .= '<option value="'.$des->id.'" >'.$des->detalle.'</option>';
        }
        
        echo $option;
    }
    
    public function actionObtener_anio_repro($id_des,$clasificador,$user)
    {
        $option = '<option value="0">--Seleccione--</option>';
       $anio = RecursoProgramado::find()
                        ->select('recurso_programado.anio')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id and recurso.id = :re_id',[':user_propietario'=>$user,':clasificador_id'=>$clasificador,':re_id'=>$id_des])
                                ->groupBy(['recurso_programado.anio'])
                                ->all();
                            
        foreach($anio as $anio2)
        {
           $option .= '<option value="'.$anio2->anio.'" >'.$anio2->anio.'</option>';
        }
        
        echo $option;
    }
    
    
    public function actionObtener_mes_repro($anio,$id_des,$clasificador,$user)
    {
        $option = '<option value="0">--Seleccione--</option>';
       $mes = RecursoProgramado::find()
                        ->select('recurso_programado.mes')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id and recurso.id = :re_id and recurso_programado.anio = :anio',[':user_propietario'=>$user,':clasificador_id'=>$clasificador,':re_id'=>$id_des,':anio'=>$anio])
                                ->groupBy(['recurso_programado.mes'])
                                ->all();
                            
        foreach($mes as $mes2)
        {
            switch($mes2->mes)
                    {
                        case 1: $des_mes = "Enero"; break;
                        case 2: $des_mes = "Febrero"; break;
                        case 3: $des_mes = "Marzo"; break;
                        case 4: $des_mes = "Abril"; break;
                        case 5: $des_mes = "Mayo"; break;
                        case 6: $des_mes = "Junio"; break;
                        case 7: $des_mes = "Julio"; break;
                        case 8: $des_mes = "Agosto"; break;
                        case 9: $des_mes = "Setiembre"; break;
                        case 10: $des_mes = "Octubre"; break;
                        case 11: $des_mes = "Noviembre"; break;
                        case 12: $des_mes = "Diciembre"; break;
                    }
                    
           $option .= '<option value="'.$mes2->mes.'" >'.$des_mes.'</option>';
        }
        
        echo $option;
    }
    
    public function actionObtener_precio_repro($mes,$anio,$id_des,$clasificador,$user)
    {

       $anio = RecursoProgramado::find()
                        ->select('recurso_programado.precio_unit, (recurso_programado.cantidad - recurso_programado.cant_rendida) as cantidad ')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  and recurso.clasificador_id = :clasificador_id and recurso.id = :re_id and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':user_propietario'=>$user,':clasificador_id'=>$clasificador,':re_id'=>$id_des,':anio'=>$anio,':mes'=>$mes])
                                ->one();
                            
        
        return json_encode(array('precio_unit'=>$anio->precio_unit,'cantidad'=>$anio->cantidad));
        
    }
    
    public function actionVerificar_cantidad_pro($id_recurso,$mes,$anio,$cant)
    {

       $cantidad = RecursoProgramado::find()
                        ->select('recurso_programado.cantidad, recurso_programado.cant_rendida')
                                ->where('recurso_programado.id_recurso = :id_recurso and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':id_recurso'=>$id_recurso,':anio'=>$anio,':mes'=>$mes])
                                ->one();
                            
        $pendiente = ($cantidad->cantidad - $cantidad->cant_rendida);
        
        if($cant > $pendiente)
        {
            return 1;
        }
        return 0;
        
    }
    
    public function actionVerificar_saldo_desembolso($monto,$id_user)
    {
        
       $desembolso = SolicitudDesembolso::find()
                            ->where('estado = 1 and id_user = :id_user',[':id_user'=>$id_user])
                            ->one();
                            
        $saldo = ($desembolso->total_pendiente - $monto);
        
        if($saldo < 0)
        {
            return json_encode(array('estado'=>1,'mensaje'=>"Usted Cuenta con un Saldo de S/.".$desembolso->total_pendiente." <br/>"));
        }
        return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    public function actionEliminar_rendicion_detalle($id)
    {
        $detalle = DetalleRendicion::findOne($id);
        
        $desembolsos = SolicitudDesembolso::find()
                            ->where('estado = 1 and id_user = :id_user',[':id_user'=>Yii::$app->user->identity->id])
                            ->one();
        
        $programado = RecursoProgramado::find()
                                        ->where('recurso_programado.id_recurso = :id_recurso and recurso_programado.anio = :anio and recurso_programado.mes = :mes',[':id_recurso'=>$detalle->id_recurso,':anio'=>$detalle->anio,':mes'=>$detalle->mes])
                                        ->one();
                        
                        //var_dump($programado->cant_rendida);die;
                        $programado->cant_rendida = ($programado->cant_rendida - $detalle->cantidad);
                        $programado->estado = 1;  
                        $programado->update();
        
        $desem = SolicitudDesembolso::findOne($desembolsos->id);
                   $desem->total_pendiente = ($desem->total_pendiente + $detalle->total);
                   $desem->update();
                   
        
    
        DetalleRendicion::findOne($id)->delete();
        
        return "Se elimino el Registro.";
        
    }
    
    
    public function actionProyecto()
    {
        $this->layout='principal';
        $id = 1;
        $user = '';
        $searchModel = new RendicionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id,$user);

        return $this->render('proyecto', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionObtener_clasificador()
    {
        $option = '';
        $clasificadores = RecursoProgramado::find()
                        ->select('recurso.clasificador_id, maestros.descripcion')
                                ->innerJoin('recurso','recurso.id=recurso_programado.id_recurso')
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and aportante.tipo = 1 and recurso_programado.estado = 1 and recurso_programado.cantidad > 0  ',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->groupBy(['recurso.clasificador_id'])
                                ->all();
                                
        
        foreach($clasificadores as $clasif)
        {
            
        $option .= '<option value="'.$clasif->clasificador_id.'" >'.$clasif->descripcion.'</option>';
        
        }
        
        return $option;
    }
    
}
