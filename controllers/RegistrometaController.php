<?php

namespace app\controllers;

use Yii;
use app\models\RegistroMeta;
use app\models\Indicador;
use app\models\Actividad;
use app\models\Usuarios;
use app\models\RegistroMetaDetalle;
use app\models\Proyecto;
use app\models\RegistroMetaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistrometaController implements the CRUD actions for RegistroMeta model.
 */
class RegistrometaController extends Controller
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
     * Lists all RegistroMeta models.
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
        
        $searchModel = new RegistroMetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id,$user);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegistroMeta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
         $this->layout='principal';
         
         
         $model = new RegistroMeta();
         
        if ($model->load(Yii::$app->request->post()))
        {
            $hoy = getdate();
            
            $registroM = RegistroMeta::findOne($model->id_meta);
            $registroMetaDet = RegistroMetaDetalle::find()->where('id_registrometa = :id_registrometa',[':id_registrometa'=>$model->id_meta])->all();
            
           if($model->respuesta_aprob == 0)
                {
                    
                    foreach($registroMetaDet as $registroMetaDet2)
                    {
                        
                        if($registroM->id_tipo == 1)
                        {
                            $indicador = Indicador::findOne($registroMetaDet2->id_indact);
                            $indicador->ejecutado = ($indicador->ejecutado - $registroMetaDet2->cantidad);
                            $indicador->estado = 0;
                            $indicador->update(); 
                        }
                        
                        if($registroM->id_tipo == 2)
                        {
                            $actividad = Actividad::findOne($registroMetaDet2->id_indact);
                            $actividad->ejecutado = ($actividad->ejecutado - $registroMetaDet2->cantidad);
                            $actividad->estado = 0;
                            $actividad->update();   
                        }
                          
                    }
                    
                    
                    
                    $registroMeta = RegistroMeta::findOne($model->id_meta);
                    $registroMeta->observacion = $model->observacion;
                    $registroMeta->estado = 3;
                    $registroMeta->fecha_aprobacion = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                    $registroMeta->id_user_obs = Yii::$app->user->identity->id;
                    $registroMeta->update();
                    
                    //DetalleSolicitud::updateAll(['estado' => 3], 'id_solicitud = :id_solicitud',[':id_solicitud'=>(int)$model->id_sol]);

                    
                }
                
                if($model->respuesta_aprob == 1)
                {
                    if(Yii::$app->user->identity->id_perfil == 5)
                    {
                        
                        $registroMeta = RegistroMeta::findOne($model->id_meta);
                        $registroMeta->estado = 2;
                        $registroMeta->fecha_aprobacion = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                        $registroMeta->id_user_obs = Yii::$app->user->identity->id;
                        $registroMeta->update();
                        
                    }
                    
                    foreach($registroMetaDet as $registroMetaDet2)
                    {
                        
                        if($registroM->id_tipo == 1)
                        {
                            $indicador = Indicador::findOne($registroMetaDet2->id_indact);
                            if($indicador->ejecutado == $indicador->meta)
                            {
                                $indicador->estado = 1;
                                $indicador->update();   
                            }
                            
                        }
                        
                        if($registroM->id_tipo == 2)
                        {
                            $actividad = Actividad::findOne($registroMetaDet2->id_indact);
                            
                            if($actividad->ejecutado == $actividad->meta)
                            {
                                $actividad->estado = 1;
                                $actividad->update();   
                            }   
                        }
                          
                    }
                    
                }
                
              
            
            return $this->redirect('proyecto');
            
            
        }
        else
        {
         
         $registroMeta = RegistroMeta::findOne($id);
         $registroMetaDet = RegistroMetaDetalle::find()->where('id_registrometa = :id_registrometa',[':id_registrometa'=>$id])->all();
         
         $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>$registroMeta->id_user])
                        ->one();
             if($registroMeta->id_user_obs == null)
             {
               $user_ap = Usuarios::find()->where('estado = 1 and ejecutora = :ejecutora',[':ejecutora'=>$proyecto->id_unidad_ejecutora])->one();
               $user_aprueba = $user_ap->Name;
               $estado_aprueba = "PENDIENTE";
             }
             else
             {
                $user_ap = Usuarios::findOne($registroMeta->id_user_obs);
                $user_aprueba = $user_ap->Name;
                if($registroMeta->observacion != null)
                {
                   $estado_aprueba = "RECHAZADO"; 
                }
                else
                {
                    $estado_aprueba = "APROBADO";
                }
                
             }
         
         
        }
        return $this->render('view', [
            'registroMeta' => $registroMeta,'registroMetaDet'=>$registroMetaDet,'user_aprueba'=>$user_aprueba,'estado_aprueba'=>$estado_aprueba
        ]);
    }
    
    public function actionAccion()
    {
         $this->layout='principal';
         
         $model = new RegistroMeta();
         
        if ($model->load(Yii::$app->request->post()))
        {
            return $this->redirect(['create', 'id_tipo' => $model->id_tipo]);
        }
        else{
        return $this->render('accion', []);
        }
    }

    /**
     * Creates a new RegistroMeta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_tipo)
    {
        $this->layout='principal';
        
        $model = new RegistroMeta();

        if ($model->load(Yii::$app->request->post())) {
            
            $countEjecutado=count(array_filter($model->id_indact));
            $hoy = getdate();
            
                        $RegistroMeta =new RegistroMeta;
                        $RegistroMeta->id_tipo=$model->tipo;
                        $RegistroMeta->fecha=$hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                        $RegistroMeta->id_user=Yii::$app->user->identity->id;
                        $RegistroMeta->save();
            
            for($i=0;$i<$countEjecutado;$i++)

                {
                    /*if(isset($proyecto->zona_ids[$i]))
                    {
                        $zonaAccion=ZonaAccion::findOne($proyecto->zona_ids[$i]);
                        $zonaAccion->id_distrito=$proyecto->zona_distrito[$i];
                        $zonaAccion->update(); 
                    }
                    else
                    {*/
                        
                        $RegistroMetaDet =new RegistroMetaDetalle;
                        $RegistroMetaDet->id_registrometa = $RegistroMeta->id;
                        $RegistroMetaDet->des_indact=$model->des_indact[$i];
                        $RegistroMetaDet->id_indact=$model->id_indact[$i];
                        $RegistroMetaDet->cantidad=$model->cantidad[$i];
                        $RegistroMetaDet->save();
                        
                        if($model->tipo == 1)
                        {
                            $indicador = Indicador::findOne($model->id_indact[$i]);
                            $indicador->ejecutado = ($indicador->ejecutado + $model->cantidad[$i]);
                            $indicador->update(); 
                        }
                        
                        if($model->tipo == 2)
                        {
                            $actividad = Actividad::findOne($model->id_indact[$i]);
                            $actividad->ejecutado = ($actividad->ejecutado + $model->cantidad[$i]);
                            $actividad->update();   
                        }
                        

                   // }
                }
            
            //return $this->refresh();
            return $this->redirect('index');
        } else {
            
              $objetivos = Proyecto::find()
                        ->select('objetivo_especifico.id, objetivo_especifico.descripcion')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->orderBy(['objetivo_especifico.descripcion'=>SORT_ASC])
                                ->all();   
              if($id_tipo == 1)
            {  
              $indicadores = Proyecto::find()
                        ->select('indicador.id, indicador.descripcion, indicador.id_oe, indicador.meta, indicador.ejecutado')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->innerJoin('indicador','indicador.id_oe = objetivo_especifico.id')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and indicador.estado = 0',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->orderBy(['indicador.descripcion'=>SORT_ASC])
                                ->all();
                $actividades = null;
            }
            if($id_tipo == 2)
            {
                $indicadores = Proyecto::find()
                        ->select('indicador.id, indicador.descripcion, indicador.id_oe, indicador.meta, indicador.ejecutado')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->innerJoin('indicador','indicador.id_oe = objetivo_especifico.id')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->orderBy(['indicador.descripcion'=>SORT_ASC])
                                ->all();
                                
              $actividades = Proyecto::find()
                        ->select('actividad.id, actividad.descripcion, actividad.id_ind, actividad.meta, actividad.ejecutado')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->innerJoin('indicador','indicador.id_oe = objetivo_especifico.id')
                                ->innerJoin('actividad','actividad.id_ind = indicador.id')
                                ->where('proyecto.estado = 1 and proyecto.user_propietario=:user_propietario and actividad.estado = 0',[':user_propietario'=>Yii::$app->user->identity->id])
                                ->orderBy(['indicador.descripcion'=>SORT_ASC])
                                ->all();  
            }
            
            return $this->render('create', [
                'indicadores' => $indicadores, 'objetivos' =>$objetivos, 'id_tipo' => $id_tipo, 'actividades' => $actividades
            ]);
        }
    }

    /**
     * Updates an existing RegistroMeta model.
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
    
    public function actionProyecto()
    {
        $this->layout='principal';
        $id = 1;
        $user = '';
        $searchModel = new RegistroMetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id,$user);

        return $this->render('proyecto', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing RegistroMeta model.
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
     * Finds the RegistroMeta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegistroMeta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegistroMeta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionCargar_lista($tipo,$id)
    {
        $html = '';
                        $query = RegistroMeta::find()
                            ->select('registro_meta_detalle.cantidad, registro_meta.fecha, registro_meta.id')
                            ->innerJoin('registro_meta_detalle','registro_meta_detalle.id_registrometa = registro_meta.id')
                            ->where('registro_meta.estado =2 and registro_meta.id_tipo = :id_tipo and registro_meta_detalle.id_indact = :id_indact',[':id_tipo'=>$tipo,':id_indact'=>$id])
                            ->all();
        
                        if($tipo == 1)
                        {
                            $query2 = Indicador::findOne($id);
                        }
                        
                        if($tipo == 2)
                        {
                            $query2 = Actividad::findOne($id);   
                        }
            
         $html .=   '<div class="clearfix"></div>
                    <div class="col-xs-12 col-sm-7 col-md-12">
                        <label>Nombre '.($tipo == 1?'Indicador':'Actividad').': <strong style="color:silver;">'.$query2->descripcion.'</strong></label>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-12">
                        <label>Unidad de Medida: <strong style="color:silver;">'.$query2->unidad_medida.'</strong></label>
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-12">
                        <label>Meta Global: <strong style="color:silver;">'.$query2->meta.'</strong></label>
                    </div>
                    <div class="clearfix"></div><br/>
                    <div class="col-xs-12 col-sm-7 col-md-12 text-center">
                    <h4>Metas Ejecutadas</h4>
                    <div>
                    <div class="clearfix">
                    <div class="col-xs-12 col-sm-7 col-md-2"></div>
                    <div class="col-xs-12 col-sm-7 col-md-8">
                    <table class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">
                                 Nro de Registro
                                </th>
				<th class="text-center">
                                    cantidad
                                </th>
                                <th class="text-center">
                                    Fecha
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                    ';            
                    $i = 1;
                    foreach($query as $query1)
                    {
                      $html .='<tr><td>'.$i.'</td><td>'.$query1->id.'</td><td>'.$query1->cantidad.'</td><td>'.$query1->fecha.'</td></tr>';  
                    }
                    
                    $html .='<tbody>
                            </table>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-2"></div>';
        
        return $html;
    }
    
    
    public function actionVerificar_metas()
    {
         $this->layout='principal';
         
         $model = new RegistroMeta();
         
        if ($model->load(Yii::$app->request->post()))
        {
            return $this->redirect(['create', 'id_tipo' => $model->id_tipo]);
        }
        else{
        return $this->render('accion', []);
        }
    }
}
