<?php


namespace app\controllers;
use yii;
use yii\web\Controller;
use yii\web\Session;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Usuarios;
use app\models\Proyecto;
use app\models\Responsable;
use app\models\ObjetivoEspecifico;
use app\models\Actividad;
use app\models\Cronograma;
use app\models\CultivoCrianza;
use app\models\AccionTransversal;
use app\models\Indicador;
use app\models\AlianzaEstrategica;
use app\models\Colaborador;
use app\models\Ubigeo;
use app\models\ZonaAccion;
use app\models\Recurso;
use app\models\Maestros;
use app\models\Aportante;
use app\models\ProyectoSearch;
use app\models\Accesos;
use app\models\RecursoProgramado;
use app\models\Desembolso;
use app\models\FlowChange;
use app\models\FlowObservation;
use app\models\NivelAprobacion;
use app\models\Aprobaciones;
use app\models\Observaciones;

use app\models\ModificarSearch;

/**
 * ModificarController implements the CRUD actions for Proyecto model.
 */
class ModificarController extends Controller
{
     public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','modificardatosgen'],
                'rules' => [
                    [
                        'actions' => ['modificardatosgen','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];

    }

    /**
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='principal';
        $searchModel = new ModificarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $flow = null;
                  
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$event,$type)
    {
        $this->layout='principal';
        
        $proyecto = new Proyecto();
        $responsable = new Responsable();
        //$departamentos = new Ubigeo();
        $provincias = new Ubigeo();
        $distritos = new Ubigeo();
        //$cultivo = new CultivoCrianza();
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto ',[':id_nuevo_proyecto'=>$id])
                        ->one();
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            if($proyecto->respuesta_anular == 0){
            $nivelApLast = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>$type])
                            ->orderBy(['orden'=>SORT_DESC])
                            ->one();
              
            $nivelAp = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>$type])
                            ->orderBy(['orden'=>SORT_ASC])
                            ->all();
            
            foreach($nivelAp as $nivelAp2)
            {
                $AprobCount = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->count();
                                
                if($AprobCount > 0)
                {
                    $Aprobaciones = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->one();
                                
                    if($Aprobaciones->estado == 0)
                    {
                        $aprob =Aprobaciones::findOne($Aprobaciones->id);
                        $aprob->id_proyecto = $proyecto->id;
                        $aprob->id_nivelaprobacion = $nivelAp2->id;
                        $aprob->estado = $proyecto->respuesta_aprob;
                        $aprob->update();
                         break; 
                    }
                    
                }
                else{
                    //var_dump((int)$proyecto->id);var_dump((int)$nivelAp2->id);var_dump($proyecto->respuesta_aprob);die;
                    $aprob =new Aprobaciones();
                    $aprob->id_proyecto = (int)$proyecto->id;
                    $aprob->id_nivelaprobacion = (int)$nivelAp2->id;
                    $aprob->estado = (int)$proyecto->respuesta_aprob;
                    $aprob->save();
                    break;
                }
            }
                                
           if($proyecto->respuesta_aprob == 0)
                {
                    $pro = Proyecto::findOne($proyecto->id);
                    $pro->situacion = 0;
                    $pro->update();
                    
                    $hoy = getdate();
                
                    $obs = new Observaciones;
                    $obs->id_proyecto = $proyecto->id;
                    $obs->observacion = $proyecto->observacion;
                    $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                    $obs->id_user = Yii::$app->user->identity->id;
                    $obs->save();
                    
                    $flow =  FlowChange::findOne($flowEstado->id);
                    $flow->estado_flujo = 0;
                    $flow->update();
                    
                }
                
                if($proyecto->respuesta_aprob == 1)
                {
                    if(Yii::$app->user->identity->id_perfil == $nivelApLast->id_perfil)
                    {
                       $pro = Proyecto::findOne($proyecto->id);
                        $pro->situacion = 2;
                        $pro->estado = 1;
                        $pro->update();
                        
                        $pro2 = Proyecto::find()
                                    ->where('estado = 1 and user_propietario = :user_propietario',[':user_propietario'=>$pro->user_propietario])
                                    ->one();
                        
                        $pro3 = Proyecto::findOne($pro2->id);
                        $pro3->estado = 0;
                        $pro3->update();
                        
                        $flow =  FlowChange::findOne($flowEstado->id);
                        $flow->estado = 1;
                        $flow->update();
                    }    
                }
                
            }
            else
            {
                $pro = Proyecto::findOne($proyecto->id);
                    $pro->estado = 3;
                    $pro->situacion = 3;
                    $pro->update();
            }
            
            return $this->redirect('index');
            
                
              
            
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()))
        {
            $user_aprueba = [];
            $estado_aprueba = [];
           $proyecto = Proyecto::find()
                        ->where(' id =:id',[':id'=>$id])
                        ->one();
            
           $responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();
            
            $departamentos = Ubigeo::find(['department_id', 'department'])
                        ->groupBy('department_id')
                        ->orderBy('department')
                        ->all();
                
                        
            if($proyecto->ubigeo)
            {
                $provincias = Ubigeo::find('province_id, province')
                            ->where('department_id = :department_id',[':department_id'=>substr($proyecto->ubigeo,0,2)])
                            ->groupBy('province')
                            ->orderBy('province')
                            ->all();
        
                $distritos = Ubigeo::find('district_id, district')
                            ->where('province_id = :province_id',[':province_id'=>substr($proyecto->ubigeo,0,4)])
                            ->groupBy('district')
                            ->orderBy('district')
                            ->all();
                
                
                        
            }
            
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->all();
                        
            /*financiamiento*/
            $aportante12=Aportante::find()
                    ->where('tipo <> 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
            $aportante3=Aportante::find()
                        ->where('tipo = 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                        ->all();
            
            $aportante=Aportante::find()
                        ->where('id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                        ->all();
                        
            $desembolsos=Desembolso::find()
                                    ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                    ->all();
            $nro_desembolso = Maestros::find()
                                    ->where('id_padre = 48 and estado = 1')
                                    ->orderBy('orden')
                                    ->all();
            
            $meses = Maestros::find()
                                    ->where('id_padre = 57 and estado = 1')
                                    ->orderBy('orden')
                                    ->all();
            
            /*end financiamiento*/
            
            /*objetivos_endicadores*/
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->all();
            /*end objetivos_endicadores*/
            
                                
                /*actividad*/                
            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->all();
            /*end objetivos_endicadores*/
            
                /*recursos*/   
            $actividades=Actividad::find()
                                ->select('actividad.id,actividad.descripcion,actividad.id_ind')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->all();
            /*end recursos*/
            
            $flow_obs = FlowObservation::find()
                        ->select('flow_observation.descripcion,usuarios.name,usuarios.img,usuarios.username')
                        ->innerJoin('usuarios','usuarios.id=flow_observation.id_user')
                        ->where('id_flow = :id_flow',[':id_flow'=>$flowEstado->id])
                        ->all();
            
            $nivelAp = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>$type])
                            ->orderBy(['orden'=>SORT_ASC])
                            ->all();
        
            $nivel = '';
            
            foreach($nivelAp as $nivelAp2)
            {
                
                $AprobCount = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->count();
                                
                if($AprobCount > 0)
                {
                    $Aprobaciones = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->one();
                                
                    if($Aprobaciones->estado == 0)
                    {
                       $nivel = $nivelAp2->id_perfil;
                         break; 
                    }
                    
                }
                else{
                    $nivel = $nivelAp2->id_perfil;
                    break;
                }
                
                
                
                
            }
            
            
            foreach($nivelAp as $nivelAp2)
            {
                
                $AprobCount = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->count();
                
                
                if($AprobCount > 0)
                {
                    $aprob = Aprobaciones::find()
                                ->where('id_proyecto = :id_proyecto and id_nivelaprobacion =:id_nivelaprobacion',[':id_proyecto'=>$proyecto->id,':id_nivelaprobacion'=>$nivelAp2->id])
                                ->one();
                    if($aprob)
                    {
                        if(($nivelAp2->id_perfil == 5)||($nivelAp2->id_perfil == 3))
                        {
                            if($nivelAp2->id_perfil == 5)
                            {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil and ejecutora = :ejecutora',[':id_perfil'=>$nivelAp2->id_perfil,':ejecutora'=>$proyecto->id_unidad_ejecutora])->one();
                            $user_aprueba[] = $user_ap->Name;
                            }
                            
                            if($nivelAp2->id_perfil == 3)
                            {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil and dependencia = :dependencia',[':id_perfil'=>$nivelAp2->id_perfil,':dependencia'=>$proyecto->id_dependencia_inia])->one();
                            $user_aprueba[] = $user_ap->Name;
                            }
                        }
                        else
                        {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil',[':id_perfil'=>$nivelAp2->id_perfil])->one();
                            $user_aprueba[] = $user_ap->Name;
                            
                        }
                        
                        if($aprob->estado == 0)
                        {
                           $estado_aprueba[] = "OBSERVADO"; 
                        }
                        else
                        {
                          $estado_aprueba[] = "APROBADO";  
                        }
                        
                    }
                    
                   $aprob = null;
                }
                else
                {
                    
                        if(($nivelAp2->id_perfil == 5)||($nivelAp2->id_perfil == 3))
                        {
                            if($nivelAp2->id_perfil == 5)
                            {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil and ejecutora = :ejecutora',[':id_perfil'=>$nivelAp2->id_perfil,':ejecutora'=>$proyecto->id_unidad_ejecutora])->one();
                            $user_aprueba[] = $user_ap->Name;
                            $estado_aprueba[] = "PENDIENTE";
                            }
                            
                            if($nivelAp2->id_perfil == 3)
                            {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil and dependencia = :dependencia',[':id_perfil'=>$nivelAp2->id_perfil,':dependencia'=>$proyecto->id_dependencia_inia])->one();
                            $user_aprueba[] = $user_ap->Name;
                            $estado_aprueba[] = "PENDIENTE";
                            }
                        }
                        else
                        {
                            $user_ap = Usuarios::find()->where('estado = 1 and id_perfil = :id_perfil',[':id_perfil'=>$nivelAp2->id_perfil])->one();
                            $user_aprueba[] = $user_ap->Name;
                            $estado_aprueba[] = "PENDIENTE";
                            
                        }
                        
                    
                    
                }
                
                
            }
            
            
            
            
            
            
            $usuario = Usuarios::findOne(Yii::$app->user->identity->id);
            $requiere_aprobar = 0;
            
            if(Yii::$app->user->identity->id_perfil == $nivel)
            {
                if(Yii::$app->user->identity->id_perfil == 5)
                {
                    
                    if(($usuario->ejecutora == $proyecto->id_unidad_ejecutora) )
                    {
                    $requiere_aprobar = 1;
                    }
                }
                
                if(Yii::$app->user->identity->id_perfil == 3)
                {
                    
                    if(($usuario->ejecutora == $proyecto->id_unidad_ejecutora) && ($usuario->dependencia == $proyecto->id_dependencia_inia) )
                    {
                    $requiere_aprobar = 1;
                    }
                }
                
                if(Yii::$app->user->identity->id_perfil == 4)
                {
                    
                    $requiere_aprobar = 1;
                    
                }
            }
            
            
            
            $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->all();
        }
        
        
        $tipoInv = Maestros::find()
                                ->where('id_padre = 16 and estado = 1')
                                ->orderBy('orden')
                                ->all();
                                
        $programa = Maestros::find()
                                ->where('id_padre = 42 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $AccionT =  AccionTransversal::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
        
        
        return $this->render('view',['proyecto'=>$proyecto,'responsable'=>$responsable,'departamentos'=>$departamentos,'provincias'=>$provincias,'distritos'=>$distritos,'tipoInv'=>$tipoInv,'AccionT'=>$AccionT,'programa'=>$programa,'cultivo'=>$cultivo,'aportante3'=>$aportante3,'aportante12'=>$aportante12,'aportante'=>$aportante,'proyecto_id'=>$proyecto->id,'desembolsos'=>$desembolsos,'nro_desembolso'=>$nro_desembolso,'meses'=>$meses,'objetivos'=>$objetivosespecificos,'objetivosespecificos'=>$objetivosespecificos,'indicadores'=>$indicadores,'evento'=>2,'actividades'=>$actividades,'flow_obs'=>$flow_obs,'requiere_aprobar'=>$requiere_aprobar,'observaciones'=>$observaciones,'user_aprueba'=>$user_aprueba,'estado_aprueba'=>$estado_aprueba]);
      
        
    }

    /**
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proyecto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Proyecto model.
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
     * Deletes an existing Proyecto model.
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
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
    public function actionModificardatosgen($id,$event)
    {
       //$situacion = $_REQUEST["situation"];
        //$evento = $_REQUEST["event"];
        $this->layout='principal';
        
        if(Yii::$app->user->identity->id_perfil == 2)
        {
            $existe_proyecto = Yii::$app->runAction('proyecto/pertnece_proyecto_user', ['id'=>$id]);
        
        if($existe_proyecto == 0)
        {
            return $this->redirect('../dashboard/index');     
        }
            
        }
        
        
        
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $model = new Proyecto();
        $responsable = new Responsable();
        //$departamentos = new Ubigeo();
        $provincias = new Ubigeo();
        $distritos = new Ubigeo();
        
        
        $proy = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
        
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto ',[':id_nuevo_proyecto'=>$id])
                        ->one();
         $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto ',[':id_nuevo_proyecto'=>$id])
                        ->count();
        if($flowCount > 0)
        {
            switch($flowEstado->tipo_modificacion)
            {
            case 1:
                $tipo = 79;
                break; 
            case 3:
                $tipo = 80;
                break;
            case 4:
                $tipo = 81;
                break;
            case 5:
                $tipo = 82;
                break;
            }
            
            if($flowEstado->estado_flujo > 0)
                {
                  return $this->redirect('view?id='.$id.'&event='.$event.'&type='.$tipo);     
                }
            if($flowEstado->tipo_modificacion != 1){    
            switch($flowEstado->tipo_modificacion)
            {
                
            case 3:
                return $this->redirect('modificarobjind?id='.$id.'&event=2'); 
                break;
            case 4:
                return $this->redirect('modificaract?id='.$id.'&event='.$event); 
                break;
            case 5:
                return $this->redirect('modificarrec?id='.$id.'&event='.$event); 
                break;
            }
            }
        }
        
        $proy_ant = $proy->id;                
        if($proyecto->load(Yii::$app->request->post()))
        {

            $countColaboradores = 0;
            if($proyecto->aportante_colaborador)
            {
            $countColaboradores = count(array_filter($proyecto->aportante_colaborador));
            }
            
            


 
                /*colaboradores*/
                for($i=0;$i<$countColaboradores;$i++)
                {
                    if(isset($proyecto->colaboradores_ids[$i]))
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
                    {
                        $Colaborador=new Aportante;
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->colaborador=$proyecto->aportante_colaborador[$i];
                        $Colaborador->regimen=$proyecto->aportante_regimen[$i];
                        $Colaborador->tipo_inst=$proyecto->aportante_tipo_inst[$i];
                        $Colaborador->tipo=3;
                        $Colaborador->save(); 
                    }
                }
                
            if(isset($proyecto->cerrar_modificacion))
             {
                
                $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 1;
                $flow->update();
                
                $pro = Proyecto::findOne($proyecto->id);
                $pro->situacion = 1;
                $pro->update();
                
                $hoy = getdate();
                
                $obs = new Observaciones;
                $obs->id_proyecto = $proyecto->id;
                $obs->observacion = $proyecto->observacion;
                $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $obs->id_user = Yii::$app->user->identity->id;
                $obs->save();
                
                return $this->redirect('index'); 
             }
            
            
            return $this->refresh(); 
        }

        if(!$model->load(Yii::$app->request->post()))
        {
           /* if($id == 0)
            {
                $ver_reg_pendiente = Yii::$app->runAction('proyecto/verificar_registros_pendientes');
                
                if($ver_reg_pendiente > 0)
                {
                 return $this->redirect('index');   
                }
                
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
            }
            else
            {*/
                $proyecto = Proyecto::find()
                        ->where('id =:id',[':id'=>$id])
                        ->one();
      
                if(!isset($proyecto))
                {
                 return $this->redirect('index');     
                }
            //}
           /*$responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();*/
            
            $departamentos = Ubigeo::find(['department_id', 'department'])
                        ->groupBy('department_id')
                        ->orderBy('department')
                        ->all();
                
                        
            if($proyecto->ubigeo)
            {
                $provincias = Ubigeo::find('province_id, province')
                            ->where('department_id = :department_id',[':department_id'=>substr($proyecto->ubigeo,0,2)])
                            ->groupBy('province')
                            ->orderBy('province')
                            ->all();
        
                $distritos = Ubigeo::find('district_id, district')
                            ->where('province_id = :province_id',[':province_id'=>substr($proyecto->ubigeo,0,4)])
                            ->groupBy('district')
                            ->orderBy('district')
                            ->all();
                        
            }
            
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->all();
            
            $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->count();
        }
         
        
        $tipoInv = Maestros::find()
                                ->where('id_padre = 16 and estado = 1')
                                ->orderBy('orden')
                                ->all();
                                
        $programa = Maestros::find()
                                ->where('id_padre = 42 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $AccionT =  AccionTransversal::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
                        
        
        return $this->render('modificardatosgen',['proyecto'=>$proyecto,'responsable'=>$responsable,'departamentos'=>$departamentos,'provincias'=>$provincias,'distritos'=>$distritos,'tipoInv'=>$tipoInv,'AccionT'=>$AccionT,'programa'=>$programa,'cultivo'=>$cultivo,'evento'=>$event,'id'=>$id,'observaciones'=>$observaciones]);
       
    }
    
    public function actionModificarfinanciamiento($id,$event)
    {
        $evento = $_REQUEST["event"];
        
        $this->layout='principal';
        
        $existe_proyecto = Yii::$app->runAction('proyecto/pertnece_proyecto_user', ['id'=>$id]);
        
        if($existe_proyecto == 0)
        {
            return $this->redirect('../dashboard/index');     
        }
        
        $session = Yii::$app->session;
        $aportante=new Aportante;
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto',[':id_nuevo_proyecto'=>$id])
                        ->one();
        $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto',[':id_nuevo_proyecto'=>$id])
                        ->count();
        
        if($flowCount > 0)
        {                       
            if($flowEstado->estado_flujo > 0)
                {
                  return $this->redirect('view?id='.$id.'&event='.$event);     
                }
        }
        
        
        if($aportante->load(Yii::$app->request->post()) )
        {
            if(isset($aportante->aporte_nomonetario))
            {
                $countAportantess=count(array_filter($aportante->aporte_nomonetario));
                //var_dump($countAportantess);die;
                for($i=0;$i<$countAportantess;$i++)
                {  
                    if(!empty($aportante->aportante_ids[$i]))
                    {
                        $aportanteupdate=Aportante::findOne($aportante->aportante_ids[$i]);
                        $aportanteupdate->monetario=$aportante->aporte_monetario[$i];
                        $aportanteupdate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportanteupdate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportanteupdate->update(); 
                    }
                }
            }
                if(isset($aportante->cerrar_modificacion))
                {
                    
                $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 1;
                $flow->update();
                
                $pro = Proyecto::findOne($aportante->proyecto_id);
                $pro->situacion = 1;
                $pro->update();
                
                $hoy = getdate();
                
                $obs = new Observaciones;
                $obs->id_proyecto = $aportante->proyecto_id;
                $obs->observacion = $aportante->observacion;
                $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $obs->id_user = Yii::$app->user->identity->id;
                $obs->save();

                return $this->redirect('index'); 
                }
                
             
             
             return $this->refresh();    
          /*  $countAportantess=count(array_filter($aportante->aporte_tipo));

                for($i=0;$i<$countAportantess;$i++)
                {

                    if(!empty($aportante->aportante_ids[$i]))
                    {
                        $aportanteupdate=Aportante::findOne($aportante->aportante_ids[$i]);
                        $aportanteupdate->id_proyecto=$aportante->proyecto_id;
                        $aportanteupdate->tipo=$aportante->aporte_tipo[$i];
                        $aportanteupdate->monetario=$aportante->aporte_monetario[$i];
                        $aportanteupdate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportanteupdate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportanteupdate->update(); 
                    }
                    else
                    {
                        $aportantecreate=new Aportante;
                        $aportantecreate->id_proyecto=$aportante->proyecto_id;
                        $aportantecreate->tipo=$aportante->aporte_tipo[$i];
                        $aportantecreate->monetario=$aportante->aporte_monetario[$i];
                        $aportantecreate->no_monetario=$aportante->aporte_nomonetario[$i];
                        $aportantecreate->total=($aportante->aporte_monetario[$i] + $aportante->aporte_nomonetario[$i]);
                        $aportantecreate->save(); 
                    }
                }
            return $this->refresh();*/
          
          
        }
        else
        {
        
        $proyecto = Proyecto::find()
                        ->where('id =:id_proyecto',[':id_proyecto'=>$id])
                        ->one();
        
        $aportante12=Aportante::find()
                    ->where('tipo <> 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        
                    
        $aportante3=Aportante::find()
                    ->where('tipo = 3 and id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        
        $aportante=Aportante::find()
                    ->where('id_proyecto =:id_proyecto',[':id_proyecto'=>$proyecto->id])
                    ->orderBy(['tipo' => SORT_ASC,'id' => SORT_ASC,])
                    ->all();
        $desembolsos=Desembolso::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->all();
        $nro_desembolso = Maestros::find()
                                ->where('id_padre = 48 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $meses = Maestros::find()
                                ->where('id_padre = 57 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->count();
        
        }
        
        return $this->render('modificarfinanciamiento',['proyecto'=>$proyecto,'aportante3'=>$aportante3,'aportante12'=>$aportante12,'aportante'=>$aportante,'desembolsos'=>$desembolsos,'nro_desembolso'=>$nro_desembolso,'meses'=>$meses,'evento'=>$evento,'observaciones'=>$observaciones]);
    
    }
    
    
    public function actionModificarobjind($id,$event)
    {
        
        //$evento = $_REQUEST["event"];
        
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $objetivosespecificos = new ObjetivoEspecifico();
        $session = Yii::$app->session;
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->one();
        $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->count();
        if($flowCount == 0)
        {
          return $this->redirect('index');     
        }
        
        /*if($flowEstado->next_url != 'modificarobjind')
        {
          return $this->redirect($flowEstado->next_url.'?id='.$id.'&event='.$event);   
        }*/

        
        
        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            // var_dump($_REQUEST);die;
             
            $countObjetivosEspecificos=count(array_filter($proyecto->objetivos_descripciones));
            $countIndicadores=count(array_filter($proyecto->indicadores_oe_ids));
            
            
                $data= Proyecto::findOne($proyecto->id);
                $data->objetivo_general = $proyecto->objetivo_general;
                $data->update();


                /*objetivos*/
                for($i=0;$i<$countObjetivosEspecificos;$i++)

                {
                    if(isset($proyecto->objetivos_ids[$i]))
                    {
                        $objetivosespecificos=ObjetivoEspecifico::findOne($proyecto->objetivos_ids[$i]);
                        $objetivosespecificos->id_proyecto=$proyecto->id;
                        $objetivosespecificos->descripcion=$proyecto->objetivos_descripciones[$i];
                        $objetivosespecificos->peso=$proyecto->objetivos_peso[$i];
                        $objetivosespecificos->update(); 
                    }
                    else
                    {
                        $objetivosespecificos=new ObjetivoEspecifico;
                        $objetivosespecificos->id_proyecto=$proyecto->id;
                        $objetivosespecificos->descripcion=$proyecto->objetivos_descripciones[$i];
                        $objetivosespecificos->peso=$proyecto->objetivos_peso[$i];
                        $objetivosespecificos->save(); 
                    }
                }
                //var_dump($proyecto);die;
                /*indicadores*/
                for($i=0;$i<$countIndicadores;$i++)
                {
                   
                    
                    if($proyecto->indicadores_ids[$i] != '')
                    {
                        $indicador=Indicador::findOne($proyecto->indicadores_ids[$i]);
                        $indicador->id_oe=$proyecto->indicadores_oe_ids[$i];
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->peso=$proyecto->indicadores_pesos[$i];
                        $indicador->unidad_medida=$proyecto->indicadores_unidad_medidas[$i];
                        $indicador->meta=$proyecto->indicadores_meta[$i];
                        $indicador->update(); 
                    }
                    else
                    {
                        
                        $indicador=new Indicador;
                        $indicador->id_oe=$proyecto->indicadores_oe_ids[$i];
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->peso=$proyecto->indicadores_pesos[$i];
                        $indicador->unidad_medida=$proyecto->indicadores_unidad_medidas[$i];
                        $indicador->meta=$proyecto->indicadores_meta[$i];
                        $indicador->save();
                        
                    }
                }
                
            
                
            if(isset($proyecto->cerrar_modificacion))
             {
                
                $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 3;
                $flow->update();
                
                $pro = Proyecto::findOne($proyecto->id);
                $pro->situacion = 1;
                $pro->update();
                
                $hoy = getdate();
                
                $obs = new Observaciones;
                $obs->id_proyecto = $proyecto->id;
                $obs->observacion = $proyecto->observacion;
                $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $obs->id_user = Yii::$app->user->identity->id;
                $obs->save();
                
                return $this->redirect('index'); 
             }
            
            
            return $this->refresh();

        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()))
        {
           $proyecto = Proyecto::find()
                        ->where('id =:id',[':id'=>$id])
                        ->one();
                        
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->all();
            
            $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->count();
                                
        }
        
        
        
        return $this->render('modificarobjind',['proyecto'=>$proyecto,'objetivos'=>$objetivosespecificos,'evento'=>$event,'observaciones'=>$observaciones]);
      
    }
    
    public function actionModificaract($id,$event)
    {
        
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $session = Yii::$app->session;
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->one();
        $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->count();
        if($flowCount == 0)
        {
          return $this->redirect('index');     
        }
        

        
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countActividades=count(array_filter($proyecto->actividades_descripciones));
                            
                
                for($i=0;$i<$countActividades;$i++)
                {
                    
                    if(isset($proyecto->actividades_ids[$i]))
                    {
                        $actividad=Actividad::findOne($proyecto->actividades_ids[$i]);
                        $actividad->id_ind=$proyecto->id_indicador;
                        $actividad->descripcion=$proyecto->actividades_descripciones[$i];
                        $actividad->id_bid=$proyecto->actividades_indicadorbid[$i];
                        $actividad->peso=$proyecto->actividades_pesos[$i];
                        $actividad->unidad_medida=$proyecto->actividades_unidad_medidas[$i];
                        $actividad->meta=$proyecto->actividades_metas[$i];
                        $actividad->fecha_inicio=$proyecto->actividades_finicio[$i];
                        $actividad->fecha_fin=$proyecto->actividades_ffin[$i];
                        $actividad->update(); 
                    }
                    else
                    {
                        $actividad=new Actividad;
                        $actividad->id_ind=$proyecto->id_indicador;
                        $actividad->descripcion=$proyecto->actividades_descripciones[$i];
                        $actividad->id_bid=$proyecto->actividades_indicadorbid[$i];
                        $actividad->peso=$proyecto->actividades_pesos[$i];
                        $actividad->unidad_medida=$proyecto->actividades_unidad_medidas[$i];
                        $actividad->meta=$proyecto->actividades_metas[$i];
                        $actividad->fecha_inicio=$proyecto->actividades_finicio[$i];
                        $actividad->fecha_fin=$proyecto->actividades_ffin[$i];
                        $actividad->save(); 
                    }
                }
                
             if(isset($proyecto->cerrar_actividad))
             {
                $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 4;
                $flow->update();
                //var_dump($proyecto->id);die;
                $pro2 = Proyecto::findOne($proyecto->id);
                $pro2->situacion = 1;
                $pro2->update();
                
                $hoy = getdate();
                
                $obs = new Observaciones;
                $obs->id_proyecto = $proyecto->id;
                $obs->observacion = $proyecto->observacion;
                $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $obs->id_user = Yii::$app->user->identity->id;
                $obs->save();
             
                return $this->redirect('index'); 
             
             }
            
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()))
        {
           $proyecto = Proyecto::find()
                        ->where('id =:id_proyecto',[':id_proyecto'=>$id])
                        ->one();
                        
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('gestion = 0 and id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->orderBy(['descripcion'=>SORT_ASC])
                                ->all();
                                
            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->orderBy(['indicador.descripcion'=>SORT_ASC])
                                ->all();
                    
            $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->count();            
        }
        
        $ver_obj_ind = Yii::$app->runAction('proyecto/verificar_obj_ind', ['id'=>$proyecto->id]); //actionVerificar_obj_ind($proyecto->id);
        
        return $this->render('modificaract',['indicadores'=>$indicadores,'objetivosespecificos'=>$objetivosespecificos,'evento'=>$event,'proyecto'=>$proyecto,'ver_obj_ind'=>$ver_obj_ind,'observaciones'=>$observaciones]);
      
    }
    
    public function actionModificarrec($id,$event)
    {
        $this->layout='principal';
        $proyecto = new Proyecto();
        $session = Yii::$app->session;
        $flat = '';
        $flat_ob_esp = '';
        $flat_ind = '';
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->one();
        $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->count();
        if($flowCount == 0)
        {
          return $this->redirect('index');     
        }
        
        /*if($flowEstado->next_url != 'modificarrec')
        {
          return $this->redirect($flowEstado->next_url.'?id='.$id.'&event='.$event);   
        }*/
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countRecurso = count(array_filter($proyecto->recurso_descripcion));
            //var_dump($proyecto->recurso_ids);
            //var_dump($proyecto->recurso_descripcion);
            //die;
            
 
                
                for($i=0;$i<$countRecurso;$i++)
                {
                    $flat .= 'a';
                    if(isset($proyecto->recurso_ids[$i]))
                    {
                        $recurso=Recurso::findOne($proyecto->recurso_ids[$i]);
                        $recurso->actividad_id=$proyecto->id_actividad;
                        $recurso->clasificador_id=$proyecto->recurso_clasificador[$i];
                        $recurso->detalle=$proyecto->recurso_descripcion[$i];
                        $recurso->unidad_medida=$proyecto->recurso_unidad[$i];
                        $recurso->fuente=$proyecto->recurso_fuente[$i];
                        //$recurso->cantidad=$proyecto->recurso_cantidad[$i];
                        //$recurso->precio_unit=$proyecto->recurso_precioun[$i];
                        //$recurso->precio_total=($proyecto->recurso_precioun[$i] *  $proyecto->recurso_cantidad[$i]);
                        $recurso->update(); 
                    }
                    else
                    {
                        
                        $recurso = new Recurso;
                        $recurso->actividad_id=$proyecto->id_actividad;
                        $recurso->clasificador_id=$proyecto->recurso_clasificador[$i];
                        $recurso->detalle=$proyecto->recurso_descripcion[$i];
                        $recurso->unidad_medida=$proyecto->recurso_unidad[$i];
                        $recurso->fuente=$proyecto->recurso_fuente[$i];
                        //$recurso->cantidad=$proyecto->recurso_cantidad[$i];
                        //$recurso->precio_unit=$proyecto->recurso_precioun[$i];
                        //$recurso->precio_total=($proyecto->recurso_precioun[$i] *  $proyecto->recurso_cantidad[$i]);
                        $recurso->save(); 
                    }
                }
                
            if(isset($proyecto->cerrar_recurso))
             {
                $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 5;
                $flow->next_url = 'modificarobs';
                $flow->update();
                
                $pro = Proyecto::findOne($proyecto->id);
                $pro->situacion = 1;
                $pro->update();
                
                $hoy = getdate();
                
                $obs = new Observaciones;
                $obs->id_proyecto = $proyecto->id;
                $obs->observacion = $proyecto->observacion;
                $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $obs->id_user = Yii::$app->user->identity->id;
                $obs->save();
             
                return $this->redirect('index'); 
             }
             
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()))
        {
            $proyecto = Proyecto::find()
                        ->where('id =:id_proyecto',[':id_proyecto'=>$id])
                        ->one();
            //var_dump($proyecto);die;
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->orderBy(['descripcion'=>SORT_ASC])
                                ->all();
                                
            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->orderBy(['indicador.descripcion'=>SORT_ASC])
                                ->all();
                        
           $actividades=Actividad::find()
                                ->select('actividad.id,actividad.descripcion,actividad.id_ind')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->all();
            
            $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->count();
            
            $clasificador = Maestros::find()
                                ->where('id_padre = 32 and estado = 1')
                                ->orderBy('orden')
                                ->all();
            
            $fuentes=Aportante::find()
                                ->select('id, colaborador')
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->orderBy('tipo')
                                ->all();
                        
        }
        
        
        $ver_obj_ind = Yii::$app->runAction('proyecto/verificar_obj_ind', ['id'=>$proyecto->id]);
        $ver_actividad = Yii::$app->runAction('proyecto/verificar_actividades', ['id'=>$proyecto->id]);
        $ver_monto_total = Yii::$app->runAction('proyecto/verificar_presupuesto', ['id'=>$proyecto->id]);
        $ver_recursos = Yii::$app->runAction('proyecto/verificar_recursos', ['id'=>$proyecto->id]);
        $ver_peso_actividad = Yii::$app->runAction('proyecto/verificar_peso_actividades', ['id'=>$proyecto->id]);
        $ver_co_aporte = Yii::$app->runAction('proyecto/verificar_colaborador_aporte', ['id'=>$proyecto->id]);
        //var_dump($ver_monto_total);die;
        
        
        return $this->render('modificarrec',['proyecto'=>$proyecto,'actividades'=>$actividades,'objetivosespecificos'=>$objetivosespecificos,'indicadores'=>$indicadores,'evento'=>$event,'ver_obj_ind'=>$ver_obj_ind,'ver_actividad'=>$ver_actividad,'ver_monto_total'=>$ver_monto_total,'ver_recursos'=>$ver_recursos,'ver_peso_actividad'=>$ver_peso_actividad,"observaciones"=>$observaciones,'ver_co_aporte'=>$ver_co_aporte,'flat_ob_esp'=>$flat_ob_esp,'flat_ind'=>$flat_ind,'clasificador'=>$clasificador,'fuentes'=>$fuentes]);
    }
    
    public function actionModificarobs($id,$event)
    {
        $this->layout='principal';
        
        $proyecto = new Proyecto();
        
        $flowEstado = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->one();
        $flowCount = FlowChange::find()
                        ->where('id_nuevo_proyecto = :id_nuevo_proyecto and estado = 0',[':id_nuevo_proyecto'=>$id])
                        ->count();
        if($flowCount == 0)
        {
          return $this->redirect('index');     
        }
        
        if($flowEstado->next_url != 'modificarobs')
        {
          return $this->redirect($flowEstado->next_url.'?id='.$id.'&event='.$event);   
        }
        
        if($proyecto->load(Yii::$app->request->post()))
        {
             $flow_obs = new FlowObservation();
             $flow_obs->id_flow = $flowEstado->id;
             $flow_obs->id_user = Yii::$app->user->identity->id;
             $flow_obs->descripcion = $proyecto->descripcion;
             $flow_obs->save();
             
             $flow =  FlowChange::findOne($flowEstado->id);
                $flow->estado_flujo = 6;
                $flow->next_url = 'view';
                $flow->update();
                
             
             
                return $this->redirect('index'); 
        }
        
        return $this->render('modificarobs',['id_proyecto'=>$id]);
    }
    
    public function actionObservaciones($id,$event)
    {
        $this->layout='principal';
        
        $proyecto = Proyecto::findOne($id);
        
        $observaciones = Observaciones::find()
                                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                                        ->all();

        return $this->render('observaciones',['proyecto'=>$proyecto,'observaciones'=>$observaciones,'evento'=>$event]);
    }
    
    public function actionAccion()
    {
        $this->layout='principal';
        
        $ver_pendientes = Yii::$app->runAction('proyecto/verificar_registros_pendientes');
        
        if($ver_pendientes != 0)
        {
          return $this->redirect('index');  
        }
        
        $proyecto = new Proyecto();
        
        if($proyecto->load(Yii::$app->request->post()))
        {
            $id = Yii::$app->runAction('modificar/copiar_proyecto', ['opcion'=>$proyecto->opcion]);
            switch($proyecto->opcion)
            {
                
            case 1:
                return $this->redirect('modificardatosgen?id='.$id.'&event=2'); 
                break;
            case 2:
                return $this->redirect('modificarobjind?id='.$id.'&event=2');  
                break;
            case 3:
                return $this->redirect('modificarobjind?id='.$id.'&event=2'); 
                break;
            case 4:
                return $this->redirect('modificaract?id='.$id.'&event=2'); 
                break;
            case 5:
                return $this->redirect('modificarrec?id='.$id.'&event=2'); 
                break;
            }
            
        }


        return $this->render('accion',[]);
    }
    
    public function actionCopiar_proyecto($opcion)
    {
        $proy = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
                        
        $proy_ant = $proy->id;
        
                $array = [];
                unset($proy['id']);
                
                $proyecto=new Proyecto($proy);
                $proyecto->save();
                
                $hoy = getdate();
                
                $data = Proyecto::findOne($proyecto->id);
                $data->tipo_registro = 1;
                $data->modificacion = $opcion;
                $data->situacion = 0;
                $data->estado = 0;
                $data->date_create = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                $data->update();
                
                /*colaboradores*/
                $colaboradores = Aportante::find()
                                    ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proy_ant])
                                    ->all();
                 $w=0;                   
                foreach($colaboradores as $colaboradores2)
                {
                   $col_ant = $colaboradores2->id; 
                   $colaboradores2->id_proyecto = $proyecto->id;
                   unset($colaboradores2['id']);
                   $col=new Aportante($colaboradores2);
                    $col->save();
                    
                    $array[$w] = array($col_ant, $col->id);
                    
                    $w++;
                }
                
                /*$cultivo = CultivoCrianza::find()
                                ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proy_ant])
                                ->all();
                                
                if($cultivo)
                {
                    foreach($cultivo as $cul)
                    {
                        $cul->id_proyecto = $proyecto->id;
                        unset($cul['id']);
                        $cul2=new CultivoCrianza($cul);
                        $cul2->save();
                    }
                    
                }*/
                /*
                for($i=0;$i<$countColaboradores;$i++)
                {                    
                if(isset($model->colaboradores_ids[$i]))
                    {
                        $colab = Aportante::find()
                                    ->where('id =:id and id_proyecto = :id_proyecto',[':id'=>$model->colaboradores_ids[$i],':id_proyecto'=>$proy_ant])
                                    ->one();
                                    
                        $Colaborador=new Aportante;
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->colaborador=$model->aportante_colaborador[$i];
                        $Colaborador->regimen=$model->aportante_regimen[$i];
                        $Colaborador->tipo_inst=$model->aportante_tipo_inst[$i];
                        $Colaborador->monetario=$colab->monetario;
                        $Colaborador->no_monetario=$colab->no_monetario;
                        $Colaborador->total=$colab->total;
                        $Colaborador->tipo=3;
                        $Colaborador->save(); 
                    }
                    else
                    {
                        $Colaborador=new Aportante;
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->colaborador=$model->aportante_colaborador[$i];
                        $Colaborador->regimen=$model->aportante_regimen[$i];
                        $Colaborador->tipo_inst=$model->aportante_tipo_inst[$i];
                        $Colaborador->tipo=3;
                        $Colaborador->save(); 
                    }
                }*/    
                 
                $objetivosE = ObjetivoEspecifico::find()
                                ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proy_ant])
                                ->all();
                
                foreach($objetivosE as $objetivosE2)
                {
                  $idObj =   $objetivosE2->id;
                  $objetivosE2->id_proyecto = $proyecto->id;
                  
                  unset($objetivosE2['id']);
                   $obj=new ObjetivoEspecifico($objetivosE2);
                    $obj->save();
                    
                    $indicador = Indicador::find()
                                ->where('id_oe = :id_oe',[':id_oe'=>$idObj])
                                ->all();
                                
                        foreach($indicador as $indicador2)
                        {
                            $idInd =   $indicador2->id;
                            $indicador2->id_oe = $obj->id;
                            
                            unset($indicador2['id']);
                            $ind=new Indicador($indicador2);
                            $ind->save();
                            
                            $actividad = Actividad::find()
                                ->where('id_ind = :id_ind',[':id_ind'=>$idInd])
                                ->all();
                                
                                    foreach($actividad as $actividad2)
                                    {
                                        $idAct =   $actividad2->id;
                                        $actividad2->id_ind = $ind->id;
                                        
                                        unset($actividad2['id']);
                                        $act=new Actividad($actividad2);
                                        $act->save();
                                        
                                        $recurso = Recurso::find()
                                            ->where('actividad_id = :actividad_id',[':actividad_id'=>$idAct])
                                            ->all();
                                            
                                                foreach($recurso as $recurso2)
                                                {
                                                    $idRec =   $recurso2->id;
                                                    $recurso2->actividad_id = $act->id;
                                                    
                                                    for($x=0;$x<count($array);$x++)
                                                    {
                                                        if($array[$x][0] == $recurso2->fuente)
                                                        {
                                                           $recurso2->fuente = $array[$x][1];
                                                        }
                                                    }
                                                    
                                                    unset($recurso2['id']);
                                                    $rec=new Recurso($recurso2);
                                                    $rec->save();
                                                    
                                                    $recursoProg = RecursoProgramado::find()
                                                        ->where('id_recurso = :id_recurso',[':id_recurso'=>$idRec])
                                                        ->all();
                                                            
                                                            foreach($recursoProg as $recursoProg2)
                                                            {
                                                                
                                                                $recursoProg2->id_recurso = $rec->id;
                                                                
                                                                unset($recursoProg2['id']);
                                                                $RPr=new RecursoProgramado($recursoProg2);
                                                                $RPr->save();  
                                                            }
                                                }
                                                
                                    }
                                    
                            
                        }
                    
                }
                
                
                $flow = new FlowChange;
                $flow->id_nuevo_proyecto = $proyecto->id;
                $flow->id_ant_proyecto = $proy_ant;
                $flow->estado_flujo = 0;
                $flow->estado = 0;
                $flow->tipo_modificacion = $opcion;
                $flow->save();
                
       return $proyecto->id; 
    }
    
    
}
