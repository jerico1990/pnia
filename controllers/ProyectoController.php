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
use app\models\SolicitudDesembolso;
use app\models\Desembolso;
use app\models\NivelAprobacion;
use app\models\Aprobaciones;
use app\models\Observaciones;
class ProyectoController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
        $this->layout='principal';
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        
        
        $menus= Accesos::find()
                                    ->select('menus.id, menus.descripcion')
                                    ->innerJoin('menus','menus.id = accesos.id_menu')
                                    ->where('menus.id_modulo = 1 and accesos.id_pefil=2 and menus.estado=1 and accesos.estado=1 and menus.visible=1')
                                    ->all();
                                    
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'menus' => $menus
        ]);
    }

    /**
     * Displays a single Proyecto model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id,$event)
    {
        $this->layout='principal';
        
        $proyecto = new Proyecto();
        $responsable = new Responsable();
        $flat_ob_esp = '';
        $flat_ind = '';
        //$departamentos = new Ubigeo();
        $provincias = new Ubigeo();
        $distritos = new Ubigeo();
        //$cultivo = new CultivoCrianza();
        
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $nivelApLast = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>78])
                            ->orderBy(['orden'=>SORT_DESC])
                            ->one();
              
            $nivelAp = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>78])
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
                    
                    $obs = new Observaciones();
                    $obs->id_proyecto = (int)$proyecto->id;
                    $obs->observacion = $proyecto->observacion;
                    $obs->id_user = Yii::$app->user->identity->id;
                    $obs->fecha = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
                    $obs->save();
                }
                
                if($proyecto->respuesta_aprob == 1)
                {
                    if(Yii::$app->user->identity->id_perfil == $nivelApLast->id_perfil)
                    {
                       $pro = Proyecto::findOne($proyecto->id);
                        $pro->situacion = 2;
                        $pro->update();
                    }    
                }
                
              
            
            return $this->redirect('index');
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()))
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id',[':id'=>$id])
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
            
            $nivelAp = NivelAprobacion::find()
                            ->where('id_actividad = :id_actividad',[':id_actividad'=>78])
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
            
            
            $usuario = Usuarios::findOne(Yii::$app->user->identity->id);
            
            $requiere_aprobar = 0;
            if(Yii::$app->user->identity->id_perfil == $nivel)
            {
                
                if(Yii::$app->user->identity->id_perfil == 3)
                {
                    if(($usuario->ejecutora == $proyecto->id_unidad_ejecutora) && ($usuario->dependencia == $proyecto->id_dependencia_inia) )
                    {
                    $requiere_aprobar = 1;
                    }
                }
                else
                {
                  $requiere_aprobar = 1;  
                }
                
                
            }
            
            
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
        
        $ver_obj_ind = Yii::$app->runAction('proyecto/verificar_obj_ind', ['id'=>$proyecto->id]);
        $ver_actividad = Yii::$app->runAction('proyecto/verificar_actividades', ['id'=>$proyecto->id]);
        $ver_monto_total = Yii::$app->runAction('proyecto/verificar_presupuesto', ['id'=>$proyecto->id]);
        $ver_recursos = Yii::$app->runAction('proyecto/verificar_recursos', ['id'=>$proyecto->id]);
        $ver_peso_actividad = Yii::$app->runAction('proyecto/verificar_peso_actividades', ['id'=>$proyecto->id]);
        $ver_programado = Yii::$app->runAction('proyecto/verificar_programado', ['id'=>$proyecto->id]);
        $ver_co_aporte = Yii::$app->runAction('proyecto/verificar_colaborador_aporte', ['id'=>$proyecto->id]);

         //'ver_obj_ind'=>$ver_obj_ind,'ver_actividad'=>$ver_actividad,'ver_monto_total'=>$ver_monto_total,'ver_recursos'=>$ver_recursos,'ver_peso_actividad'=>$ver_peso_actividad,'ver_programado'=>$ver_programado   

        return $this->render('view',['proyecto'=>$proyecto,'responsable'=>$responsable,'departamentos'=>$departamentos,'provincias'=>$provincias,'distritos'=>$distritos,'tipoInv'=>$tipoInv,'AccionT'=>$AccionT,'programa'=>$programa,'cultivo'=>$cultivo,'aportante3'=>$aportante3,'aportante12'=>$aportante12,'aportante'=>$aportante,'proyecto_id'=>$proyecto->id,'desembolsos'=>$desembolsos,'nro_desembolso'=>$nro_desembolso,'meses'=>$meses,'objetivos'=>$objetivosespecificos,'objetivosespecificos'=>$objetivosespecificos,'indicadores'=>$indicadores,'evento'=>$event,'actividades'=>$actividades,'ver_obj_ind'=>$ver_obj_ind,'ver_actividad'=>$ver_actividad,'ver_monto_total'=>$ver_monto_total,'ver_recursos'=>$ver_recursos,'ver_peso_actividad'=>$ver_peso_actividad,'ver_programado'=>$ver_programado,'requiere_aprobar'=>$requiere_aprobar,'ver_co_aporte'=>$ver_co_aporte,'flat_ob_esp'=>$flat_ob_esp,'flat_ind'=>$flat_ind]);
      
        
        
        /*return $this->render('view', [
            'model' => $this->findModel($id),
        ]);*/
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
    
    public function actionMarcologico()
    {
        $this->layout='principal';
        $proyecto = new Proyecto();
        $objetivosespecificos = null;
        $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
            
           $responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
            
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
           // var_dump($cultivo); die;
           
            $AccionT =  AccionTransversal::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
                        
        }
        return $this->render('marcologico',['proyecto'=>$proyecto,'objetivosespecificos'=>$objetivosespecificos]);
    }
    
    public function actionNuevo()
    {
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $responsable = new Responsable();
        $cultivo = new CultivoCrianza();
        $AccionT = new AccionTransversal();
        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countAlianzas=count(array_filter($proyecto->alianzas_instituciones));
            $countObjetivosEspecificos=count(array_filter($proyecto->objetivos_descripciones));
            $countIndicadores=count(array_filter($proyecto->indicadores_descripciones));
            $countActividades=count(array_filter($proyecto->actividades_descripciones));
            $countCronogramas=count(array_filter($proyecto->cronogramas_meses));
            $countColaboradores = count(array_filter($proyecto->nombresc));
            if($existe == 0)
            {
                $proyecto->user_propietario = Yii::$app->user->identity->id;
                $proyecto->estado = 1;
                $proyecto->save();
                $responsable->id_proyecto = $proyecto->id;
                $responsable->nombres = $proyecto->nombres;
                $responsable->apellidos = $proyecto->apellidos;
                $responsable->telefono = $proyecto->telefono;
                $responsable->celular = $proyecto->celular;
                $responsable->correo = $proyecto->correo;
                $responsable->save();
                
                $cultivo->id_proyecto = $proyecto->id;
                $cultivo->tipo = $proyecto->tipocc;
                $cultivo->descripcion = $proyecto->descripcioncc;
                $cultivo->save();
                
                $AccionT->id_proyecto = $proyecto->id;
                $AccionT->id_accion_transversal = $proyecto->idat;
                $AccionT->otros = $proyecto->otrosat;
                $AccionT->save();

            }
            else
            {
                $data= Proyecto::findOne($proyecto->id);
                $data->titulo = $proyecto->titulo;
                $data->direccion_linea = $proyecto->direccion_linea;
                $data->estacion_exp = $proyecto->estacion_exp;
                $data->sub_estacion_exp = $proyecto->sub_estacion_exp;
                $data->sub_estacion_exp = $proyecto->sub_estacion_exp;
                $data->sub_estacion_exp = $proyecto->sub_estacion_exp;
                $data->id_tipo_proyecto = $proyecto->id_tipo_proyecto;
                $data->desc_tipo_proy = $proyecto->desc_tipo_proy;
                $data->resumen_ejecutivo = $proyecto->resumen_ejecutivo;
                $data->relevancia = $proyecto->relevancia;
                $data->objetivo_general = $proyecto->objetivo_general;
                $data->plan_trabajo = $proyecto->plan_trabajo;
                $data->resultados_esperados = $proyecto->resultados_esperados;
                $data->presupuesto = $proyecto->presupuesto;
                $data->referencias_bibliograficas = $proyecto->referencias_bibliograficas;
                $data->update();
                
                
                $responsable = Responsable::findOne($proyecto->id);
                $responsable->nombres = $proyecto->nombres;
                $responsable->apellidos = $proyecto->apellidos;
                $responsable->telefono = $proyecto->telefono;
                $responsable->celular = $proyecto->celular;
                $responsable->correo = $proyecto->correo;
                
                $responsable->update();
                
                $cultivo = CultivoCrianza::findOne($proyecto->idcc);
                $cultivo->id_proyecto = $proyecto->id;
                $cultivo->tipo = $proyecto->tipocc;
                $cultivo->descripcion = $proyecto->descripcioncc;
                $cultivo->update();
                
                $AccionT = AccionTransversal::findOne($proyecto->id);
                $AccionT->id_accion_transversal = $proyecto->idat;
                
                if($proyecto->idat == 15)
                $AccionT->otros = $proyecto->otrosat;
                else
                $AccionT->otros = '';
                
                $AccionT->update();
                
                /*alianzas*/
                for($i=0;$i<$countAlianzas;$i++)

                {
                    if(isset($proyecto->alianzas_ids[$i]))
                    {
                        $alianza=AlianzaEstrategica::findOne($proyecto->alianzas_ids[$i]);
                        $alianza->id_proyecto=$proyecto->id;
                        $alianza->institucion=$proyecto->alianzas_instituciones[$i];
                        $alianza->descripcion=$proyecto->alianzas_descripciones[$i];
                        $alianza->nombres=$proyecto->alianzas_nombres[$i];
                        $alianza->apellidos=$proyecto->alianzas_apellidos[$i];
                        $alianza->correo=$proyecto->alianzas_correos[$i];
                        $alianza->telefono=$proyecto->alianzas_telefonos[$i];
                        $alianza->update(); 
                    }
                    else
                    {
                        $alianza=new AlianzaEstrategica;
                        $alianza->id_proyecto=$proyecto->id;
                        $alianza->institucion=$proyecto->alianzas_instituciones[$i];
                        $alianza->descripcion=$proyecto->alianzas_descripciones[$i];
                        $alianza->nombres=$proyecto->alianzas_nombres[$i];
                        $alianza->apellidos=$proyecto->alianzas_apellidos[$i];
                        $alianza->correo=$proyecto->alianzas_correos[$i];
                        $alianza->telefono=$proyecto->alianzas_telefonos[$i];
                        $alianza->save(); 
                    }
                }
                

                /*objetivos*/
                for($i=0;$i<$countObjetivosEspecificos;$i++)

                {
                    if(isset($proyecto->objetivos_ids[$i]))
                    {
                        $objetivosespecificos=ObjetivoEspecifico::findOne($proyecto->objetivos_ids[$i]);
                        $objetivosespecificos->id_proyecto=$proyecto->id;
                        $objetivosespecificos->descripcion=$proyecto->objetivos_descripciones[$i];
                        $objetivosespecificos->update(); 
                    }
                    else
                    {
                        $objetivosespecificos=new ObjetivoEspecifico;
                        $objetivosespecificos->id_proyecto=$proyecto->id;
                        $objetivosespecificos->descripcion=$proyecto->objetivos_descripciones[$i];
                        $objetivosespecificos->save(); 
                    }
                }
                
                
                /*indicadores*/
                for($i=0;$i<$countIndicadores;$i++)
                {
                    //var_dump($proyecto->actividades_ids);die;
                    if(isset($proyecto->indicadores_ids[$i]))
                    {
                        $indicador=Indicador::findOne($proyecto->indicadores_ids[$i]);
                        $indicador->id_oe=$proyecto->indicadores_oe_ids[$i];
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->update(); 
                    }
                    else
                    {
                        $indicador=new Indicador;
                        $indicador->id_oe=$proyecto->indicadores_oe_ids[$i];
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->save(); 
                    }
                }
                
                /*actividades*/
                for($i=0;$i<$countActividades;$i++)
                {
                    //var_dump($proyecto->actividades_ids);die;
                    if(isset($proyecto->actividades_ids[$i]))
                    {
                        $actividad=Actividad::findOne($proyecto->actividades_ids[$i]);
                        $actividad->id_ind=$proyecto->actividades_ind_ids[$i];
                        $actividad->descripcion=$proyecto->actividades_descripciones[$i];
                        $actividad->update(); 
                    }
                    else
                    {
                        $actividad=new Actividad;
                        $actividad->id_ind=$proyecto->actividades_ind_ids[$i];
                        $actividad->descripcion=$proyecto->actividades_descripciones[$i];
                        $actividad->save(); 
                    }
                }
                
                /*cronogramas*/
                for($i=0;$i<$countCronogramas;$i++)
                {
                    //var_dump($proyecto->cronogramas_meses);die;
                    if(isset($proyecto->cronogramas_ids[$i]))
                    {
                        $cronograma=Cronograma::findOne($proyecto->cronogramas_ids[$i]);
                        $cronograma->id_actividad=$proyecto->cronogramas_actividad_ids[$i];
                        $cronograma->mes=$proyecto->cronogramas_meses[$i];
                        $cronograma->update(); 
                    }
                    else
                    {
                        $cronograma=new Cronograma;
                        $cronograma->id_actividad=$proyecto->cronogramas_actividad_ids[$i];
                        $cronograma->mes=$proyecto->cronogramas_meses[$i];
                        $cronograma->save(); 
                    }
                }
                
                /*colaboradores*/
                for($i=0;$i<$countColaboradores;$i++)
                {
                    //var_dump($proyecto->cronogramas_meses);die;
                    if(isset($proyecto->colaboradores_ids[$i]))
                    {
                        $Colaborador=Colaborador::findOne($proyecto->colaboradores_ids[$i]);
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->nombres=$proyecto->nombresc[$i];
                        $Colaborador->apellidos=$proyecto->apellidosc[$i];
                        $Colaborador->funcion=$proyecto->funcionesc[$i];
                        $Colaborador->update(); 
                    }
                    else
                    {
                        $Colaborador=new Colaborador;
                        $Colaborador->id_proyecto=$proyecto->id;
                        $Colaborador->nombres=$proyecto->nombresc[$i];
                        $Colaborador->apellidos=$proyecto->apellidosc[$i];
                        $Colaborador->funcion=$proyecto->funcionesc[$i];
                        $Colaborador->save(); 
                    }
                }
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
            
           $responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
            
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
           // var_dump($cultivo); die;
           
            $AccionT =  AccionTransversal::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
                        
        }
        

        
        
        return $this->render('nuevo',['proyecto'=>$proyecto,'responsable'=>$responsable,'cultivo'=>$cultivo,'AccionT'=>$AccionT]);
      
    }
    
    
    public function actionDatosgenerales()
    {
        //$situacion = $_REQUEST["situation"];
        $evento = $_REQUEST["event"];
        
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $responsable = new Responsable();
        //$departamentos = new Ubigeo();
        $provincias = new Ubigeo();
        $distritos = new Ubigeo();
        //$cultivo = new CultivoCrianza();
        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countColaboradores = 0;
            if($proyecto->aportante_colaborador)
            {
            $countColaboradores = count(array_filter($proyecto->aportante_colaborador));
            }
           // $countAlianzas=count(array_filter($proyecto->alianzas_instituciones));
            if($existe == 0)
            {
                $proyecto->user_propietario = Yii::$app->user->identity->id;
                $proyecto->estado = 1;
                $proyecto->save();
               /* $responsable->id_proyecto = $proyecto->id;
                $responsable->nombres = $proyecto->nombres;
                $responsable->apellidos = $proyecto->apellidos;
                $responsable->telefono = $proyecto->telefono;
                $responsable->celular = $proyecto->celular;
                $responsable->correo = $proyecto->correo;
                $responsable->save();*/

            }
            else
            {
                
                //var_dump($proyecto->id_cultivo);die;
                $data= Proyecto::findOne($proyecto->id);
                $data->titulo = $proyecto->titulo;
                $data->vigencia = $proyecto->vigencia;
                $data->id_tipo_proyecto = $proyecto->id_tipo_proyecto;
                $data->id_programa = $proyecto->id_programa;
                $data->id_cultivo = $proyecto->id_cultivo;
                $data->id_especie = $proyecto->id_especie;
                $data->id_areatematica = $proyecto->id_areatematica;
                
                $data->ubigeo = $proyecto->distrito;
                $data->id_direccion_linea = $proyecto->id_direccion_linea;
                $data->id_unidad_ejecutora = $proyecto->id_unidad_ejecutora;
                $data->id_dependencia_inia = $proyecto->id_dependencia_inia;
                $data->resumen_ejecutivo = $proyecto->resumen_ejecutivo;
                $data->relevancia = $proyecto->relevancia;
                $data->update();
                
                
               /* $responsable = Responsable::findOne($proyecto->id);
                $responsable->nombres = $proyecto->nombres;
                $responsable->apellidos = $proyecto->apellidos;
                $responsable->telefono = $proyecto->telefono;
                $responsable->celular = $proyecto->celular;
                $responsable->correo = $proyecto->correo;
                
                $responsable->update();*/

 
                /*colaboradores*/
                for($i=0;$i<$countColaboradores;$i++)
                {
                    //var_dump($proyecto->cronogramas_meses);die;
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
                
                
                /*CultivoCrianza::deleteAll('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id]);
                
                
                for($i=0;$i<count($proyecto->id_cultivo);$i++)

                {
                    $cultivo = new CultivoCrianza();
                    $cultivo->id_proyecto = $proyecto->id;
                    $cultivo->tipo = $proyecto->id_cultivo[$i];
                    $cultivo->save();
                }*/
                
                /*Instituciones Alianza*/
               /* for($i=0;$i<$countAlianzas;$i++)

                {
                    if(isset($proyecto->alianzas_ids[$i]))
                    {
                        $alianza=AlianzaEstrategica::findOne($proyecto->alianzas_ids[$i]);
                        $alianza->id_proyecto=$proyecto->id;
                        $alianza->institucion=$proyecto->alianzas_instituciones[$i];
                        $alianza->descripcion=$proyecto->alianzas_descripciones[$i];
                        $alianza->nombres=$proyecto->alianzas_nombres[$i];
                        $alianza->apellidos=$proyecto->alianzas_apellidos[$i];
                        $alianza->correo=$proyecto->alianzas_correos[$i];
                        $alianza->telefono=$proyecto->alianzas_telefonos[$i];
                        $alianza->update(); 
                    }
                    else
                    {
                        $alianza=new AlianzaEstrategica;
                        $alianza->id_proyecto=$proyecto->id;
                        $alianza->institucion=$proyecto->alianzas_instituciones[$i];
                        $alianza->descripcion=$proyecto->alianzas_descripciones[$i];
                        $alianza->nombres=$proyecto->alianzas_nombres[$i];
                        $alianza->apellidos=$proyecto->alianzas_apellidos[$i];
                        $alianza->correo=$proyecto->alianzas_correos[$i];
                        $alianza->telefono=$proyecto->alianzas_telefonos[$i];
                        $alianza->save(); 
                    }
                }*/
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
            
           /*$responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();
            */
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
                                        ->all();
        }
        
        //var_dump($cultivo);die;
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
        
        
        return $this->render('datosgenerales',['proyecto'=>$proyecto,'responsable'=>$responsable,'departamentos'=>$departamentos,'provincias'=>$provincias,'distritos'=>$distritos,'tipoInv'=>$tipoInv,'AccionT'=>$AccionT,'programa'=>$programa,'cultivo'=>$cultivo,'evento'=>$evento,'observaciones'=>$observaciones]);
      
    }
    
    
    public function actionObjetivo_indicador()
    {
        $situacion = $_REQUEST["situation"];
        $evento = $_REQUEST["event"];
        
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $objetivosespecificos = new ObjetivoEspecifico();
        $session = Yii::$app->session;
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and id =:id',[':id'=>$session['proyecto_id']])
                        ->count();
        if($proyecto->load(Yii::$app->request->post()) )
        {
            // var_dump($_REQUEST);die;
             
            $countObjetivosEspecificos=count(array_filter($proyecto->objetivos_descripciones));
            $countIndicadores=count(array_filter($proyecto->indicadores_oe_ids));
            
            //var_dump($proyecto->indicadores_oe_ids);die;
            
            if($existe == 0)
            {
                $proyecto->user_propietario = Yii::$app->user->identity->id;
                $proyecto->estado = 1;
                $proyecto->save();

            }
            else
            {
                //var_dump($proyecto->id);
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
                        
                       /* $indicador=new Indicador;
                        $indicador->id_oe=5;
                        $indicador->descripcion="123";
                        $indicador->peso=34;
                        $indicador->unidad_medida=34;
                        $indicador->meta="luis";
                        $indicador->save(); */
                    }
                }
                
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id',[':id'=>$session['proyecto_id']])
                        ->one();
                        
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->orderBy(['gestion'=>SORT_ASC,'descripcion'=>SORT_ASC])
                                ->all();
                                
        }
        
        
        
        return $this->render('objetivo_indicador',['proyecto'=>$proyecto,'objetivos'=>$objetivosespecificos,'evento'=>$evento]);
      
    }
    

    
    public function actionAreasclaves()
    {
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $responsable = new Responsable();
        $cultivo = new CultivoCrianza();
        $AccionT = new AccionTransversal();
        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
        if($proyecto->load(Yii::$app->request->post()) )
        {
            if($existe == 0)
            {
                
                $cultivo->id_proyecto = $proyecto->id;
                $cultivo->tipo = $proyecto->tipocc;
                $cultivo->descripcion = $proyecto->descripcioncc;
                $cultivo->save();
                
                $AccionT->id_proyecto = $proyecto->id;
                $AccionT->id_accion_transversal = $proyecto->idat;
                $AccionT->otros = $proyecto->otrosat;
                $AccionT->save();

            }
            else
            {
                //var_dump($proyecto->id);
                $data= Proyecto::findOne($proyecto->id);
                $data->id_tipo_proyecto = $proyecto->id_tipo_proyecto;
                $data->desc_tipo_proy = $proyecto->desc_tipo_proy;
                $data->update();
                
                $cultivo = CultivoCrianza::findOne($proyecto->idcc);
                $cultivo->tipo = $proyecto->tipocc;
                $cultivo->descripcion = $proyecto->descripcioncc;
                $cultivo->update();
                
                $AccionT = AccionTransversal::findOne($proyecto->id);
                $AccionT->id_accion_transversal = $proyecto->idat;
                
                if($proyecto->idat == 15)
                $AccionT->otros = $proyecto->otrosat;
                else
                $AccionT->otros = '';
                
                $AccionT->update();
                
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
            
           $responsable = Responsable::find()
                            ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                            ->one();
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
            
            $cultivo =  CultivoCrianza::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
           // var_dump($cultivo); die;
           
            $AccionT =  AccionTransversal::find()
                        ->where('id_proyecto = :id_proyecto',[':id_proyecto'=>$proyecto->id])
                        ->one();
                        
        }
        
        
        
        return $this->render('areasclaves',['proyecto'=>$proyecto,'responsable'=>$responsable,'cultivo'=>$cultivo,'AccionT'=>$AccionT]);
      
    }
    
    public function actionOtros()
    {
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();

        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countZonaAccion=count(array_filter($proyecto->zona_departamento));
            if($existe == 0)
            {

            }
            else
            {
                //var_dump($proyecto->id);
                $data= Proyecto::findOne($proyecto->id);
                $data->plan_trabajo = $proyecto->plan_trabajo;
                $data->resultados_esperados = $proyecto->resultados_esperados;
                $data->presupuesto = $proyecto->presupuesto;
                $data->referencias_bibliograficas = $proyecto->referencias_bibliograficas;
                $data->update();

                
                

                /*ZOna Accion*/
                for($i=0;$i<$countZonaAccion;$i++)

                {
                    if(isset($proyecto->zona_ids[$i]))
                    {
                        $zonaAccion=ZonaAccion::findOne($proyecto->zona_ids[$i]);
                        $zonaAccion->id_distrito=$proyecto->zona_distrito[$i];
                        $zonaAccion->update(); 
                    }
                    else
                    {
                        $zonaAccion=new ZonaAccion;
                        $zonaAccion->id_proyecto=$proyecto->id;
                        $zonaAccion->id_distrito=$proyecto->zona_distrito[$i];
                        $zonaAccion->save(); 
                    }
                }
                
                
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->one();
                        
        }
        
        
        
        return $this->render('otros',['proyecto'=>$proyecto]);
      
    }
    
    public function actionRecursos()
    {
        //$situacion = $_REQUEST["situation"];
        $evento = $_REQUEST["event"];
        
        $this->layout='principal';
        $proyecto = new Proyecto();
        $session = Yii::$app->session;
        $flat = '';
        $flat_ob_esp = '';
        $flat_ind = '';
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                        ->count();
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countRecurso = count(array_filter($proyecto->recurso_act_ids));
            //var_dump($countRecurso);die;
            //var_dump($proyecto->recurso_descripcion);
            //die;
            //var_dump($countRecurso);
            if($existe == 0)
            {

            }
            else
            {
                $flat_ob_esp = $proyecto->id_objetivo;
                $flat_ind = $proyecto->id_indicador;
                
                for($i=0;$i<$countRecurso;$i++)
                {
                    if($proyecto->id_actividad)
                    {
                      if((trim($proyecto->recurso_descripcion[$i]) != '') && ($proyecto->recurso_clasificador[$i] != '0') && ($proyecto->recurso_fuente[$i] != '0') && (trim($proyecto->recurso_unidad[$i]) != '')){  
                    //$flat .= 'a';
                    // var_dump($proyecto->recurso_descripcion[$i].'- ');
                    
                    if(isset($proyecto->recurso_ids[$i]))
                    {
                        //var_dump($proyecto->recurso_ids[$i].','.$proyecto->recurso_act_ids[$i].','.$proyecto->recurso_clasificador[$i].','.$proyecto->recurso_descripcion[$i].','.$proyecto->recurso_unidad[$i].','.$proyecto->recurso_fuente[$i]);die;
                        $recurso=Recurso::findOne($proyecto->recurso_ids[$i]);
                        $recurso->actividad_id=$proyecto->recurso_act_ids[$i];
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
                        $recurso->actividad_id=$proyecto->recurso_act_ids[$i];
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
                    
                    }
                }
                
                //die;
            }
            
            if(isset($proyecto->cerrar_recurso))
             {
                $proy =  Proyecto::findOne($proyecto->id);
                $proy->situacion = 1;
                $proy->update();
                
             
             
                return $this->redirect('datosgenerales?event='.$evento); 
             }
            
            //return $this->refresh();
        }
        
                        
        /*if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {*/
            $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
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
                                ->orderBy(['actividad.descripcion'=>SORT_ASC])
                                ->all();
            
            $consolidados=Recurso::find()
                                ->select('maestros.descripcion,SUM(recurso.precio_total) as precio_total')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->innerJoin('maestros','maestros.id=recurso.clasificador_id and maestros.estado=1')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$proyecto->id])
                                ->groupBy('maestros.descripcion')
                                ->all();
            
            
            $clasificador = Maestros::find()
                                ->where('id_padre = 32 and estado = 1')
                                ->orderBy('orden')
                                ->all();
            
            $fuentes=Aportante::find()
                                ->select('id, colaborador')
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->orderBy('tipo')
                                ->all();
                        
       // }
        
        
        $ver_obj_ind = Yii::$app->runAction('proyecto/verificar_obj_ind', ['id'=>$proyecto->id]);
        $ver_actividad = Yii::$app->runAction('proyecto/verificar_ind_actividad', ['id'=>$proyecto->id]);
        $ver_monto_total = Yii::$app->runAction('proyecto/verificar_presupuesto', ['id'=>$proyecto->id]);
        $ver_recursos = Yii::$app->runAction('proyecto/verificar_recursos', ['id'=>$proyecto->id]);
        $ver_peso_actividad = Yii::$app->runAction('proyecto/verificar_peso_actividades', ['id'=>$proyecto->id]);
        $ver_co_aporte = Yii::$app->runAction('proyecto/verificar_colaborador_aporte', ['id'=>$proyecto->id]);

        //var_dump($ver_monto_total);die;
        
        
        return $this->render('recursos',['proyecto'=>$proyecto,'actividades'=>$actividades,'objetivosespecificos'=>$objetivosespecificos,'indicadores'=>$indicadores,'evento'=>$evento,'ver_obj_ind'=>$ver_obj_ind,'ver_actividad'=>$ver_actividad,'ver_monto_total'=>$ver_monto_total,'ver_recursos'=>$ver_recursos,'ver_peso_actividad'=>$ver_peso_actividad,'ver_co_aporte'=>$ver_co_aporte,'flat_ob_esp'=>$flat_ob_esp,'flat_ind'=>$flat_ind,'clasificador'=>$clasificador,'fuentes'=>$fuentes,'consolidados'=>$consolidados]);
    }
    
    
    public function actionIndicador()
    {
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $session = Yii::$app->session;
        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                        ->count();
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countIndicadores=count(array_filter($proyecto->indicadores_descripciones));
            if($existe == 0)
            {

            }
            else
            {
                
                /*indicadores*/
                for($i=0;$i<$countIndicadores;$i++)
                {
                    //var_dump($proyecto->actividades_ids);die;
                    if(isset($proyecto->indicadores_ids[$i]))
                    {
                        $indicador=Indicador::findOne($proyecto->indicadores_ids[$i]);
                        $indicador->id_oe=$proyecto->id_indicador;
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->peso=$proyecto->indicadores_pesos[$i];
                        $indicador->unidad_medida=$proyecto->indicadores_unidad_medidas[$i];
                        $indicador->programado=$proyecto->indicadores_programados[$i];
                        $indicador->update(); 
                    }
                    else
                    {
                        $indicador=new Indicador;
                        $indicador->id_oe=$proyecto->id_indicador;
                        $indicador->descripcion=$proyecto->indicadores_descripciones[$i];
                        $indicador->peso=$proyecto->indicadores_pesos[$i];
                        $indicador->unidad_medida=$proyecto->indicadores_unidad_medidas[$i];
                        $indicador->programado=$proyecto->indicadores_programados[$i];
                        $indicador->save(); 
                    }
                }
                
                
            }
            
            return $this->refresh();
        }
        
                        
        if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                        ->one();
                        
            $objetivos=ObjetivoEspecifico::find()->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])->all();
                    
                        
        }
        
        
        
        return $this->render('indicador',['objetivos'=>$objetivos]);
      
    }
    
    
    public function actionActividad()
    {
        $situacion = $_REQUEST["situation"];
        $evento = $_REQUEST["event"];
        $flat_ob_esp = '';
        $flat_ind = '';
        
        $this->layout='principal';
        $flatUpdate = 0;        
        $proyecto = new Proyecto();
        $session = Yii::$app->session;
        
        
        $existe = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
                        ->count();
                        
        if($proyecto->load(Yii::$app->request->post()) )
        {
            $countActividades=count(array_filter($proyecto->actividades_descripciones));
            if($existe == 0)
            {

            }
            else
            {
                
                $flat_ob_esp = $proyecto->id_objetivo;
                $flat_ind = $proyecto->id_indicador;
                
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
                        //$actividad->fecha_inicio=$proyecto->actividades_finicio[$i];
                        //$actividad->fecha_fin=$proyecto->actividades_ffin[$i];
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
                        //$actividad->fecha_inicio=$proyecto->actividades_finicio[$i];
                        //$actividad->fecha_fin=$proyecto->actividades_ffin[$i];
                        $actividad->save(); 
                    }
                }
                
                
            }
            
            //return $this->refresh($flat_ob_esp,$flat_ind);
        }
        
                        
        /*if(!$proyecto->load(Yii::$app->request->post()) && $existe > 0)
        {*/
           $proyecto = Proyecto::find()
                        ->where('estado = 1 and id =:id_proyecto',[':id_proyecto'=>$session['proyecto_id']])
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
                    
                        
        //}
        
        $ver_obj_ind = Yii::$app->runAction('proyecto/verificar_obj_ind', ['id'=>$proyecto->id]); //actionVerificar_obj_ind($proyecto->id);
        
        return $this->render('actividad',['indicadores'=>$indicadores,'objetivosespecificos'=>$objetivosespecificos,'evento'=>$evento,'proyecto'=>$proyecto,'ver_obj_ind'=>$ver_obj_ind,'flat_ob_esp'=>$flat_ob_esp,'flat_ind'=>$flat_ind]);
      
    }
    
    
    
    
    
    public function actionModificaractrec()
    {
        $this->layout='principal';
        
        return $this->render('modificaractrec');
    }
    
    public function actionExisteproyecto()
    {
       $existe = Proyecto::find()
                        ->where('estado = 1 and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
                        
        if($existe == 0)
        {
          $error = 'No Exite Proyecto Registrado!';  
        }
        else
        {
            $error = 1;
        }
        
        echo $error;
    }
    
    public function actionEliminarobjetivoespecifico()
    {
        //var_dump($_REQUEST);die;
        $mesaje = "";
        $myData = json_decode($_POST['obj_esp']);
        
        $validarIndicador = Indicador::find()->where('id_oe = :id_oe',[':id_oe'=>$myData->id])->all();
        //var_dump($validarIndicador);die;
        //var_dump($validarIndicador);
        if($validarIndicador)
        {
           //ObjetivoEspecifico::findOne($myData->id)->delete();
           $mesaje = "El Objetivo se encuentra asociado a un Indicador";

        }
        else
        {
            ObjetivoEspecifico::findOne($myData->id)->delete();
        }
        //var_dump($mesaje);die;
        echo $mesaje;
        
        /*if(ObjetivoEspecifico::findOne($myData->id)->delete())
        {
            
        }
        else
        {
            echo "El Objetivo se encuentra asociado a un Indicador";
        }*/
        
        
    }
    
    public function actionEliminarindicador($id)
    {
        $mesaje = "";
        $estado = 0;
        $validaractividades = Actividad::find()->where('id_ind = :id_ind',[':id_ind'=>$id])->all();

        if($validaractividades)
        {
           $mesaje = "El Indicador se encuentra asociado con Actividades";

        }
        else
        {
            Indicador::findOne($id)->delete();
            $estado = 1;
            $mesaje = "Se elimino el Indicador Correctamente.";
        }
        
        
        
        $array = array('mensaje'=>$mesaje,'estado'=>$estado);
            echo json_encode($array);
    }
    
    public function actionEliminaractividad($id)
    {
        $mesaje = "";
        $estado = '0';
        $validarrecurso = Recurso::find()->where('actividad_id = :actividad_id',[':actividad_id'=>$id])->all();
        $validarAct = Actividad::find()->where('id = :id',[':id'=>$id])->one();
        if($validarrecurso)
        {
           //ObjetivoEspecifico::findOne($myData->id)->delete();
           $mesaje = "<strong>¡Cuidado! </strong>La Actividad se encuentra asociado a Recursos";

        }
        else
        {
            if($validarAct->ejecutado == 0)
            {
            Actividad::findOne($id)->delete();
            $estado = '1';
            $mesaje = "Se elimino la Actividad Correctamente.";
            }
            else
            {
             $mesaje = "<strong>¡Cuidado! </strong>La Actividad se encuentra en Ejecución, no puede ser Eliminada";   
            }
        }
        
        
        
        $array = array('mensaje'=>$mesaje,'estado'=>$estado);
            echo json_encode($array);

    }
    
    public function actionEliminarcronograma($id)
    {
        Cronograma::findOne($id)->delete();
    }
    
    public function actionObtenerprovincia($id)
    {
        $option = '<option value="0">--Seleccione--</option>';
       $provincia = Ubigeo::find('province_id, province')
                            ->where('department_id = :department_id',[':department_id'=>$id])
                            ->groupBy('province')
                            ->orderBy('province')
                            ->all();
                            
        foreach($provincia as $provincias)
        {
           $option .= '<option value="'.$provincias->province_id.'" >'.$provincias->province.'</option>';
        }
        
        echo $option;
    }
    
    public function actionObtenerdistrito($id)
    {
        $option = '<option value="0">--Seleccione--</option>';
       $distritos = Ubigeo::find('district_id, district')
                            ->where('province_id = :province_id',[':province_id'=>$id])
                            ->groupBy('district')
                            ->orderBy('district')
                            ->all();
                            
        foreach($distritos as $distrito)
        {
           $option .= '<option value="'.$distrito->district_id.'" >'.$distrito->district.'</option>';
        }
        
        echo $option;
    }
    
    public function actionGrabarog()
    {
        $data_obj = json_decode($_POST['obj_gen']);
        
        $proyecto=Proyecto::findOne($data_obj->id_proyecto);
                $proyecto->objetivo_general=$data_obj->objetivo_general;
                $proyecto->update();
                        
        echo'';
    }
    
    public function actionEliminarcolaborador($id)
    {
        //$mesaje = "No existe el Identificador del Colaborador";
        
        $validarAportante = Recurso::find()->where('fuente = :fuente',[':fuente'=>$id])->all();
        
        
        if($validarAportante)
        {
           //ObjetivoEspecifico::findOne($myData->id)->delete();
           $mesaje = "El Colaborador se encuentra Asociado a Recursos.";

        }
        else
        {
            Aportante::findOne($id)->delete();
           $mesaje = "Se elimino Colaborador Correctamente";
        }
        //var_dump($mesaje);die;
        echo $mesaje;
        
        
    }
    
    public function actionEliminarubigeo($id)
    {

           ZonaAccion::findOne($id)->delete();
           $mesaje = "Se elimino la Zona de Acción";
        
        echo $mesaje;

        
    }
    
    public function actionEliminarrecurso($id)
    {
        
            RecursoProgramado::deleteAll('id_recurso = :id_recurso',[':id_recurso'=>$id]);

            Recurso::findOne($id)->delete();
            $mesaje = "Se elimino el Recurso Correctamente.";
        
        echo $mesaje;

        
    }
    
    public function actionRefrescarrecursos($id, $id_proyecto,$evento)
    {
        $html = '';
        $opcion2 = '';
        $opcion1 = '';
        $re = 0;
        $session = Yii::$app->session;
        

        $proyecto = Proyecto::find()
                        ->where('id =:id',[':id'=>$id_proyecto])
                        ->one();

        
        $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$id])
                                ->orderBy(['descripcion'=>SORT_ASC])
                                ->all();
        
        $html .= '<div class="panel-group" id="accordion">';
        
        if($actividades)
        {
        
                                                
             
                                                  
            
        
        /*$recursos=Recurso::find()
                                ->where('actividad_id=:actividad_id',[':actividad_id'=>$actividad->id])
                                ->all();
                                
        $fuentes=Aportante::find()
                                ->select('id, colaborador')
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$id_proyecto])
                                ->orderBy('tipo')
                                ->all();
                                
        $clasificador = Maestros::find()
                                ->where('id_padre = 32 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        
        $proyecto = Proyecto::find()
                                ->select('vigencia')
                                ->where('id =:id',[':id'=>$id_proyecto])
                                ->one();
        
        if($recursos)
        {
            
            
                foreach($recursos as $recursos2)
                {*/
                    
                
               
	       $array =[];
               $i = 0;
		  
                foreach($actividades as $actividades2)
                {
			$array[] = $actividades2->id;
			

                $html .=  '<div class="panel panel-primary">
                      <div class="panel-heading" style="height: 45px;padding:5px">
                        <div id="divactividad" >
                <div class="col-xs-12 col-sm-9 col-md-12" id="proyecto-div_id_'.$i.'" >
		    <input type="hidden" value="'.$actividades2->id.'" id="proyecto-id_actividad_'.$i.'" name="Proyecto[id_actividad][]" />
		    <input type="hidden" value="'.$actividades2->descripcion.'" id="proyecto-act_descripcion_'.$i.'" name="Proyecto[act_descripcion]" /> 
		    <div class="col-md-1" >
			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="true">
			     <span style="color:black" class="glyphicon glyphicon-minus"></span>
			</a>
			</div>
		    <div class="col-xs-10 col-sm-10 col-md-9" >
			<div class="form-group field-proyecto-objetivos_descripciones_'.$i.'required">
			    <label for="proyecto-obj_descripcion_'.$i.'">'.$actividades2->descripcion.'</label>
			</div> 
		    </div>
		    <div class="col-xs-12 col-sm-9 col-md-2" >
			<div class="form-group field-proyecto-objetivos_peso_'.$i.' required">
			    
			</div>    
		    </div>
                    
                    <br>
                </div>
                <div class="clearfix"></div>
	    </div>

                      </div>
                      <div id="collapse'.$i.'" class="panel-collapse collapse in">
                        <div class="panel-body">
                            '.\app\widgets\recursos\RecursosWidget::widget(['actividad_id'=>$actividades2->id,'vigencia'=>$proyecto->vigencia,'id_proyecto'=>$proyecto->id,'evento'=>$evento,'correlativo'=>$i]).'
                        </div>
                      </div>
                  </div>
                ';
                    
                    $i++;
                }
                    
                    
                   /* foreach($clasificador as $clasificador2)
                    {
                                                        
                     $opcion1 .='<option value="'.$clasificador2->id.'" '.($clasificador2->id == $recursos2->clasificador_id ? 'selected="selected"' : '' ).'>'.$clasificador2->descripcion.'</option>';
                                                          
                    }
                    
                    foreach($fuentes as $fuentes2)
                    {
                                                        
                     $opcion2 .='<option value="'.$fuentes2->id.'" '.($fuentes2->id == $recursos2->fuente ? 'selected="selected"' : '' ).'>'.$fuentes2->colaborador.'</option>';
                                                          
                    }
                    
                                            if($evento == 2){
					    $ejecutado = '<td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_'.$re.' required">
						<input type="text" id="proyecto-recurso_ejecutado_'.$re.'" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder="" value="'.$recursos2->ejecutado.'" Disabled>
					    </div>
					    </td>';
                                            }
                                            else
                                            {
                                               $ejecutado = ''; 
                                            }
                    
			$html .= '<tr id="recurso_addr_1_'.$re.'">
					<td>
					'.($re+1).'
                                        <input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_'.$re.'" value="'.$re.'" />
					</td>
					<td>
                                        <div class="form-group field-proyecto-recurso_clasificador_'.$re.' required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_'.$re.'" name="Proyecto[recurso_clasificador][]" >
                                                <option value="0">--Clasificador--</option>'.$opcion1.'</select>
					    
                                            </div>    
                                        </td>
                                        <td class="col-xs-3"  >
                                            <div class="form-group field-proyecto-recurso_descripcion_'.$re.' required">
                                                <input class="form-control " value="'.$recursos2->detalle.'" type="text"  placeholder="..." id="proyecto-recurso_descripcion_'.$re.'" name="Proyecto[recurso_descripcion][]"/>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="form-group field-proyecto-recurso_fuente_'.$re.' required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_'.$re.'" name="Proyecto[recurso_fuente][]" >
                                                <option value="0">--Fuente--</option>'.$opcion2.'
                                            </select>
					    
                                            </div>    
                                        </td>
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_unidad_'.$re.' required">
                                                <input class="form-control " value="'.$recursos2->unidad_medida.'" type="text"  placeholder="..." id="proyecto-recurso_unidad_'.$re.'" name="Proyecto[recurso_unidad][]"/>
                                            </div>
                                        </td>
                                        <td class="col-xs-1">
                                            <div class="form-group field-proyecto-recurso_cantidad_'.$re.' required">
                                                <input  class="form-control " value="'.$recursos2->cantidad.'" class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_'.$re.'" name="Proyecto[recurso_cantidad][]" Disabled>
                                            </div>
                                        </td>'.$ejecutado.'
                                        <td class="col-xs-2">
                                            <div class="form-group field-proyecto-recurso_preciototal_'.$re.' required">
                                                <input class="form-control " value="'.$recursos2->precio_total.'" class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_'.$re.'" name="Proyecto[recurso_preciototal][]" Disabled>
                                            </div>
                                        </td>
                                        <td>
					    <div>
					    '.\app\widgets\programado\ProgramadoWidget::widget(['recurso_id'=>$recursos2->id,'re'=>$re,'vigencia'=>$proyecto->vigencia,'evento'=>$evento]).'
					    </div>
                                        </td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" id="proyecto-recurso_ids_'.$re.'" name="Proyecto[recurso_ids][]" value="'.$recursos2->id.'" />
					    </span>
					</td>
				    </tr>';
				     $re++;
                    
                    $opcion2 ='';
		}*/
        }
        else
        {
            /*foreach($clasificador as $clasificador2)
            {
                                                
             $opcion1 .='<option value="'.$clasificador2->id.'" >'.$clasificador2->descripcion.'</option>';
                                                  
            }
            
            foreach($fuentes as $fuentes2)
                    {
                                                        
                     $opcion2 .='<option value="'.$fuentes2->id.'" >'.$fuentes2->colaborador.'</option>';
                                                          
                    }
                                    if($evento == 2){
					    $ejecutado = '<td class="col-xs-1">
					    <div class="form-group field-proyecto-recurso_ejecutado_0 required">
						<input type="text" id="proyecto-recurso_ejecutado_0" class="form-control" name="Proyecto[recurso_ejecutado][]" placeholder=""  Disabled>
					    </div>
					    </td>';
                                            }
                                            else
                                            {
                                               $ejecutado = ''; 
                                            }
                                            
         $html .='<tr id="recurso_addr_1_0">
				    <td>
				    '.($re+1).'
                                    <input type="hidden" name="Proyecto[recurso_numero][]" id="proyecto-recurso_numero_'.$re.'" value="'.$re.'" />
				    </td>
				    <td class="col-xs-2" >
					<div class="form-group field-proyecto-recurso_clasificador_0 required">
                                            <select  class="form-control " id="proyecto-recurso_clasificador_0" name="Proyecto[recurso_clasificador][]" >
                                                <option value="0">--Clasificador--</option>'.$opcion1.'</select>
					    
					</div>
				    </td>
                                    <td class="col-xs-3"  >
					<div class="form-group field-proyecto-recurso_descripcion_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_descripcion_0" name="Proyecto[recurso_descripcion][]"/>
					</div>
				    </td>
                                    <td>
                                        <div class="form-group field-proyecto-recurso_fuente_0 required">
                                            <select  class="form-control " id="proyecto-recurso_fuente_0" name="Proyecto[recurso_fuente][]" >
                                                <option value="0">--Fuente--</option>'.$opcion2.'
                                            </select>
					    
                                            </div>    
                                    </td>
                                    <td class="col-xs-2">
					<div class="form-group field-proyecto-recurso_unidad_0 required">
					    <input class="form-control " type="text"  placeholder="..." id="proyecto-recurso_unidad_0" name="Proyecto[recurso_unidad][]"/>
					</div>
				    </td>
                                    <td class="col-xs-1">
					<div class="form-group field-proyecto-recurso_cantidad_0 required">
					    <input  class="form-control " class="form-control " type="text"  placeholder="..." id="proyecto-recurso_cantidad_0" name="Proyecto[recurso_cantidad][]" Disabled>
					</div>
				    </td>'.$ejecutado.'
                                    <td class="col-xs-2">
					<div class="form-group field-proyecto-recurso_preciototal_0 required">
					    <input class="form-control " class="form-control "  type="text"  placeholder="..." id="proyecto-recurso_preciototal_0" name="Proyecto[recurso_preciototal][]" Disabled>
					</div>
				    </td>
                                    <td>
				    <div>
				    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#programado0_" id="btn_programado" onclick="cargartitulos(0)">Detalle</button>
				    </div>
                                        </td>
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					    
					</span>
				    </td>
				</tr>';
                                
                                $re = 1;
            $opcion2 ='';*/
        }
        
         $html .='</div>';
        
        
            $html .='<tr id="recurso_addr_1_'.$re.'"></tr>';
            
            $array = array('html'=>$html,'contador'=>$re);
            //$array[] = $re;
            echo json_encode($array);
    }
    
    
    public function actionRefrescarindicadores($id)
    {
        $html = '';
        $opcion1 = '';
        $ind = 0;
        
        $indicadores=Indicador::find()
                                ->where('id_oe=:objetivo_id',[':objetivo_id'=>$id])
                                ->all();        

        
        if($indicadores)
        {
            
            
                foreach($indicadores as $indicadores2)
                {
                    


			$html .= '<tr id="indicador_addr_1_'.$ind.'">
					<td>
					'.($ind+1).'
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_'.$ind.'" value="'.$ind.'" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_'.$ind.'  required ">
						<input type="text" id="proyecto-indicadores_descripciones_'.$ind.'" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #'.$ind.'" value="'.$indicadores2->descripcion.'" />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_'.$ind.' required">
						<input type="text" id="proyecto-indicadores_pesos_'.$ind.'" class="form-control" name="Proyecto[indicadores_pesos][]" placeholder="Peso" value="'.$indicadores2->peso.'" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_'.$ind.' required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_'.$ind.'" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida " value="'.$indicadores2->unidad_medida.'" />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_programados_'.$ind.' required">
						<input type="text" id="proyecto-indicadores_programados_'.$ind.'" class="form-control" name="Proyecto[indicadores_programados][]" placeholder="Programado" value="'.$indicadores2->programado.'" />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[indicadores_ids][]" value="'.$indicadores2->id.'" />
					    </span>
					</td>
				    </tr>';
				     $ind++;
		}
        }
        else
        {
            
         $html .='<tr id="indicador_addr_1_0">
				    <td>
					'.($ind+1).'
					<input type="hidden" name="Proyecto[indicadores_numero][]" id="proyecto-indicadores_numero_0" value="'.$ind.'" />
					</td>

					<td class="col-xs-6">
					    <div class="form-group field-proyecto-indicadores_descripciones_0  required ">
						<input type="text" id="proyecto-indicadores_descripciones_0" class="form-control " name="Proyecto[indicadores_descripciones][]" placeholder="Indicador #'.($ind+1).'"  />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-indicadores_pesos_0  required">
						<input type="text" id="proyecto-indicadores_pesos_0" class="form-control" name="Proyecto[indicadores_pesos][]" placeholder="Peso"  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_unidad_medidas_0 required">
						<input type="text" id="proyecto-indicadores_unidad_medidas_0" class="form-control" name="Proyecto[indicadores_unidad_medidas][]" placeholder="Unidad de Medida "  />
					    </div>
					</td>
					<td>
					    <div class="form-group field-proyecto-indicadores_programados_0 required">
						<input type="text" id="proyecto-indicadores_programados_0" class="form-control" name="Proyecto[indicadores_programados][]" placeholder="Programado"  />
					    </div>
					</td>
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
					    </span>
					</td>
				</tr>';
                                
                                $ind = 1;
        }
        
            $html .='<tr id="indicador_addr_1_'.$ind.'"></tr>';
            
            $array = array('html'=>$html,'contador'=>$ind);
            echo json_encode($array);
    }
    
    
    
    
    public function actionRefrescaractividades($id,$evento)
    {
        $html = '';
        $opcion1 = '';
        $act = 0;

        $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$id])
                                ->all();
                                
        $indicadorBID = Maestros::find()
                                ->where('id_padre = 38 and estado = 1')
                                ->orderBy('orden')
                                ->all();
        

        
        if($actividades)
        {
            
            
                foreach($actividades as $actividad)
                {
                    
                    foreach($indicadorBID as $indicadorBID2)
                    {
                                                        
                     $opcion1 .='<option value="'.$indicadorBID2->id.'" '.($indicadorBID2->id == $actividad->id_bid ? 'selected="selected"' : '' ).'>'.$indicadorBID2->descripcion.'</option>';
                                                          
                    }
                    
                                            if($evento == 2){
					    $ejecutado = '<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ejecutado_'.$act.' required">
						<input type="text" maxlength="30" id="proyecto-actividades_ejecutado_'.$act.'" class="form-control text-center" name="Proyecto[actividades_ejecutado][]" placeholder="" value="'.$actividad->ejecutado.'" Disabled>
					    </div>
					    </td>';
                                            }
                                            else
                                            {
                                               $ejecutado = ''; 
                                            }

			$html .= '<tr id="actividad_addr_1_'.$act.'">
					<td style="text-align: center">
					'.($act+1).'
					<input type="hidden" name="Proyecto[actividades_numero][]" id="proyecto-actividades_numero_'.$act.'" value="'.$act.'" />
					</td>
					<td class="col-xs-4">
					    <div class="form-group field-proyecto-actividades_descripciones_'.$act.' required">
						<input type="text" id="proyecto-actividades_descripciones_'.$act.'" class="form-control" maxlength="2980" name="Proyecto[actividades_descripciones][]" placeholder="" value="'.$actividad->descripcion.'" />
					    </div>
					</td>
					<td class="col-xs-2">
                                        <div class="form-group field-proyecto-actividades_indicadorbid_'.$act.' required">
                                            <select  class="form-control " id="proyecto-actividades_indicadorbid_'.$act.'" name="Proyecto[actividades_indicadorbid][]" >
                                                <option value="0">--Indicador BID--</option>'.$opcion1.'</select>
					    
                                            </div>    
                                        </td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_pesos_'.$act.' required">
						<input type="text" maxlength="3" id="proyecto-actividades_pesos_'.$act.'" class="form-control entero text-center" name="Proyecto[actividades_pesos][]" placeholder="Peso" value="'.$actividad->peso.'" />
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-proyecto-actividades_unidad_medidas_'.$act.' required">
						<input type="text" maxlength="100" id="proyecto-actividades_unidad_medidas_'.$act.'" class="form-control" name="Proyecto[actividades_unidad_medidas][]" placeholder="Unidad de Medida" value="'.$actividad->unidad_medida.'" />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_metas_'.$act.' required">
						<input type="text" maxlength="30" id="proyecto-actividades_metas_'.$act.'" class="form-control entero text-center" name="Proyecto[actividades_metas][]" placeholder="Cantidad Programada<?= $act ?>" value="'.$actividad->meta.'" />
					    </div>
					</td>'.$ejecutado.'
					<!--<td>
					    <div>
					    '.'0'/*\app\widgets\fechas\FechasWidget::widget(['actividad_id'=>$actividad->id,'act'=>$act])*/.'
					    </div>
					</td>-->
					<td>
					    <span class="eliminar glyphicon glyphicon-minus-sign">
						<input type="hidden" name="Proyecto[actividades_ids][]" value="'.$actividad->id.'" />
					    </span>
					</td>
				    </tr>';
				     $act++;
                                     $opcion1 = '';
		}
                
                
        }
        else
        {
            foreach($indicadorBID as $indicadorBID2)
                    {
                                                        
                     $opcion1 .='<option value="'.$indicadorBID2->id.'" >'.$indicadorBID2->descripcion.'</option>';
                                                          
                    }
                    
                                            if($evento == 2){
					    $ejecutado = '<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_ejecutado_0 required">
						<input type="text" maxlength="30" id="proyecto-actividades_ejecutado_0" class="form-control text-center" name="Proyecto[actividades_ejecutado][]" placeholder=""  Disabled>
					    </div>
					    </td>';
                                            }
                                            else
                                            {
                                               $ejecutado = ''; 
                                            }
            
         $html .='<tr id="actividad_addr_1_0">
				    <td style="text-align: center">
					'.($act+1).'
					<input type="hidden" name="Proyecto[actividades_numero][]" id="proyecto-actividades_numero_0" value="0" />
					</td>
					<td class="col-xs-4">
					    <div class="form-group field-proyecto-actividades_descripciones_0 required">
						<input type="text" id="proyecto-actividades_descripciones_0" maxlength="2980" class="form-control" name="Proyecto[actividades_descripciones][]" placeholder=""  />
					    </div>
					</td>
					<td class="col-xs-2">
                                        <div class="form-group field-proyecto-actividades_indicadorbid_0 required">
                                            <select  class="form-control " id="proyecto-actividades_indicadorbid_0" name="Proyecto[actividades_indicadorbid][]" >
                                                <option value="0">--Indicador BID--</option>'.$opcion1.'</select>
					    
                                            </div>    
                                        </td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_pesos_0 required">
						<input type="text" maxlength="3" id="proyecto-actividades_pesos_0" class="form-control entero text-center" name="Proyecto[actividades_pesos][]" placeholder="" " />
					    </div>
					</td>
					<td class="col-xs-2">
					    <div class="form-group field-proyecto-actividades_unidad_medidas_0 required">
						<input type="text" maxlength="100" id="proyecto-actividades_unidad_medidas_0" class="form-control" name="Proyecto[actividades_unidad_medidas][]" placeholder=""  />
					    </div>
					</td>
					<td class="col-xs-1">
					    <div class="form-group field-proyecto-actividades_metas_0 required">
						<input type="text" maxlength="30" id="proyecto-actividades_metas_0" class="form-control entero text-center" name="Proyecto[actividades_metas][]" placeholder="" />
					    </div>
					</td>'.$ejecutado.'
					<!--<td>
					    <div>'.'0'/*\app\widgets\fechas\FechasWidget::widget(['actividad_id'=>'','act'=>$act])*/.' 
					    </div>
					</td>-->
				    <td>
					<span class="eliminar glyphicon glyphicon-minus-sign">
					</span>
				    </td>
				</tr>';
                                
                                $act = 1;
        }
        
            $html .='<tr id="actividad_addr_1_'.$act.'"></tr>';
            
            $array = array('html'=>$html,'contador'=>$act);
            //$array[] = $re;
            echo json_encode($array);
    }
    
    
    public function actionObtenerindicadores($id)
    {
        $opcion1 = '';
        $estado = 0;
        
        $objetivo =  ObjetivoEspecifico::findOne($id);
        
        $indicadores=Indicador::find()
                                ->where('id_oe=:objetivo_id',[':objetivo_id'=>$id])
                                ->orderBy(['descripcion'=>SORT_ASC])
                                ->all();
        
        
        foreach($indicadores as $indicador)
            {
                                                
             $opcion1 .='<option value="'.$indicador->id.'" >'.$indicador->descripcion.'</option>';
                                                  
            }
        
        
        if($objetivo->gestion == 1)
        {
          $estado = 1;  
        }
        
        
       $array = array('estado'=>$estado,'option'=>$opcion1);
            echo json_encode($array);
    }
    
    public function actionObteneractividad($id)
    {
        $opcion1 = '';
        
        $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$id])
                                ->orderBy(['descripcion'=>SORT_ASC])
                                ->all();
        
        foreach($actividades as $actividad)
            {
                                                
             $opcion1 .='<option value="'.$actividad->id.'" >'.$actividad->descripcion.'</option>';
                                                  
            }
        
       echo $opcion1; 
    }
    
    public function actionObtenermeta($tipo,$id)
    {
        $opcion1 = 0;
        
        if($tipo == 1)
        {
            $ejecutado=Indicador::find()
                                ->select('meta,ejecutado')
                                ->where('id=:id',[':id'=>$id])
                                ->one();
        }
        
        if($tipo == 2)
        {
            $ejecutado=Actividad::find()
                                ->select('meta,ejecutado')
                                ->where('id=:id',[':id'=>$id])
                                ->one();
        }
        
        $opcion1 = ($ejecutado->meta - $ejecutado->ejecutado);
        
       echo $opcion1; 
    }
    
    public function actionVerificar_meta($tipo,$id,$cantidad)
    {
        $opcion1 = 0;
        $resultado = 0;
        
        if($tipo == 1)
        {
            $ejecutado=Indicador::find()
                                ->select('meta,ejecutado')
                                ->where('id=:id',[':id'=>$id])
                                ->one();
        }
        
        if($tipo == 2)
        {
            $ejecutado=Actividad::find()
                                ->select('meta,ejecutado')
                                ->where('id=:id',[':id'=>$id])
                                ->one();
        }
        
        $opcion1 = ($ejecutado->meta - $ejecutado->ejecutado);
        
        if($cantidad > $opcion1)
        {
            $resultado = 1;
        }
        
       echo $resultado; 
    }
    
    public function actionValorproyecto($proyecto, $accion)
    {
        
        $menus = Menus::find()
                        ->select('ruta')
                        ->whre('id = :id and visible = 1 and estado = 1',[':id'=>$accion])
                        ->one();
        
        ignore_user_abort(true);
set_time_limit(0);

        
        //echo $proyecto.' '.$accion;
        if(Yii::app()->request->isAjaxRequest)
        {
           return $this->redirect($menus->ruta, ['proyecto_id' => $proyecto,]);
        }
        else{
          return  $this->redirect($menus->ruta, ['proyecto_id' => $proyecto,]);
        }
    }
    
    
    public function actionCargarmesesanio($id, $anios, $meses, $id_recurso,$re,$tabla)
    {
        $tds = null;
        $programado = RecursoProgramado::find()
                                ->where('anio =:anio and id_recurso = :id_recurso',[':anio'=>$id,':id_recurso'=>$id_recurso])
                                ->orderBy('mes')
                                ->all();

        
        if($programado)
        {
                                $mes = [];
                                $cantidad = [];
                                $id = [];
                                
                                foreach($programado as $programado2)
                                {
                                    $mes[] = $programado2->mes;
                                    $cantidad[] = $programado2->cantidad;
                                    $id[] = $programado2->id;
                                }
                                for($i=1; $i<=count($mes); $i++)
                                {
                                     switch($i) {
						    case 1 : $var_mes = "ENE";
									    break;
						    case 2 : $var_mes = "FEB";
									    break;
						    case 3 : $var_mes = "MAR";
									    break;
						    case 4 : $var_mes = "ABR";
									    break;
						    case 5 : $var_mes = "MAY";
									    break;
						    case 6 : $var_mes = "JUN";
									    break;
						    case 7 : $var_mes = "JUL";
									    break;
						    case 8 : $var_mes = "AGO";
									    break;
						    case 9 : $var_mes = "SEP";
									    break;
						    case 10 : $var_mes = "OCT";
									    break;
						    case 11 : $var_mes = "NOV";
									    break;
						    case 12 : $var_mes = "DIC";
						    }
                                  
                        $tds .=     '<td><label>'.$var_mes.'</label>
					    <div class="form-group field-proyecto-programado_mes_'.$tabla.'_'.$re.'_'.$i.' required">
						<input type="text" id="proyecto-programado_cantidad_'.$tabla.'_'.$re.'_'.$i.'" class="form-control decimal" name="Proyecto[programado_cantidad][]" placeholder="" value="'.$cantidad[($i-1)].'"  />
                                                <input type="hidden" id="proyecto-programado_mes_'.$tabla.'_'.$re.'_'.$i.'" class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="'.$mes[($i-1)].'" />
                                                <input type="hidden" id="proyecto-programado_id_'.$tabla.'_'.$re.'_'.$i.'" class="form-control" name="Proyecto[programado_id][]" placeholder="" value="'.$id[($i-1)].'" />
					    </div>
                                    </td>';
                                }
        }
        else
        {
            if($anios >= $id)$contador = 12; else $contador = $meses;
				
                                for($i=1; $i<=$contador; $i++)
                                {
                                    switch($i) {
						    case 1 : $var_mes = "ENE";
									    break;
						    case 2 : $var_mes = "FEB";
									    break;
						    case 3 : $var_mes = "MAR";
									    break;
						    case 4 : $var_mes = "ABR";
									    break;
						    case 5 : $var_mes = "MAY";
									    break;
						    case 6 : $var_mes = "JUN";
									    break;
						    case 7 : $var_mes = "JUL";
									    break;
						    case 8 : $var_mes = "AGO";
									    break;
						    case 9 : $var_mes = "SEP";
									    break;
						    case 10 : $var_mes = "OCT";
									    break;
						    case 11 : $var_mes = "NOV";
									    break;
						    case 12 : $var_mes = "DIC";
						    }
                                $tds .=  '<td><label>'.$var_mes.'</label>
					    <div class="form-group field-proyecto-programado_mes_'.$tabla.'_'.$re.'_'.$i.' required">
						<input type="text" id="proyecto-programado_cantidad_'.$tabla.'_'.$re.'_'.$i.'" class="form-control decimal" name="Proyecto[programado_cantidad][]" placeholder="" value="0" />
                                                <input type="hidden" id="proyecto-programado_mes_'.$tabla.'_'.$re.'_'.$i.'" class="form-control" name="Proyecto[programado_mes][]" placeholder="" value="'.$i.'" />
					    </div>
                                    </td>';  
                                }
        }
        
        echo $tds;
    }
    //($anio, $id, $mes, $cantidad, $id_recurso, $precio_unit)
    public function actionGrabarprogramado()
    {
        $anio = $_REQUEST["anio"];
        $id = $_REQUEST["id"];
        $mes = $_REQUEST["mes"];
        $cantidad = $_REQUEST["cantidad"];
        $id_recurso = $_REQUEST["id_recurso"];
        $precio_unit = $_REQUEST["precio_unit"];
        

        //var_dump($id);die;
        $count = count($mes);

        
        /*Grabar RecursoProgramado*/
        for($i=0;$i<$count;$i++)

                {
                    if($id[$i] != null)
                    {
                        $recursoprogramado=RecursoProgramado::findOne($id[$i]);
                        $recursoprogramado->id_recurso=$id_recurso;
                        $recursoprogramado->anio=$anio[$i];
                        $recursoprogramado->mes=$mes[$i];
                        $recursoprogramado->cantidad=$cantidad[$i];
                        $recursoprogramado->precio_unit=$precio_unit;
                        $recursoprogramado->update(); 
                    }
                    else
                    {
                        $recursoprogramado=new RecursoProgramado;
                        $recursoprogramado->id_recurso=$id_recurso;
                        $recursoprogramado->anio=$anio[$i];
                        $recursoprogramado->mes=$mes[$i];
                        $recursoprogramado->cantidad=$cantidad[$i];
                        $recursoprogramado->precio_unit=$precio_unit;
                        $recursoprogramado->save(); 
                    }
                }
                
                
        $sumacantidad = RecursoProgramado::find()
                                ->where('id_recurso = :id_recurso',[':id_recurso'=>$id_recurso])
                                ->sum('cantidad');
        
        $Recurso = Recurso::findOne($id_recurso);
        $Recurso->cantidad = $sumacantidad;
        $Recurso->precio_unit = $precio_unit;
        $Recurso->precio_total = ($precio_unit * $sumacantidad);
        $Recurso->update();
                
         $mensaje = "Se Grabo la Programación del Recurso";
         
         $array = array('cantidad'=>$sumacantidad,'monto'=>($precio_unit * $sumacantidad),'mensaje'=>$mensaje);

            echo json_encode($array);
    }
    
    
    public function actionVerificar_obj_ind($id)
    {
        $existe_ind = [];
        $w = 0;
       $proyecto = Proyecto::find()
                        ->where('id =:id_proyecto',[':id_proyecto'=>$id])
                        ->one();
                        
            $objetivosespecificos=ObjetivoEspecifico::find()
                                ->where('id_proyecto=:id_proyecto',[':id_proyecto'=>$proyecto->id])
                                ->all();
            
            foreach($objetivosespecificos as $obj)
            {
               $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->where('id_oe=:id_oe',[':id_oe'=>$obj->id])
                                ->all();
                foreach($indicadores as $ind)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] == 0)
               {
                 return 1;
               }
            }
            
            return 0;
        
    }
    
    public function actionVerificar_actividades($id)
    {
        $existe_ind = [];
        $w = 0;

                        
            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$id])
                                ->all();
            
            foreach($indicadores as $ind)
            {
               $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$ind->id])
                                ->all();
                foreach($actividades as $act)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] == 0)
               {
                 return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>Tiene Indicadores sin Actividades registradas. <br/>"));
               }
            }
            
            return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    public function actionVerificar_ind_actividad($id)
    {
        $existe_ind = [];
        $w = 0;

                        
            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('objetivo_especifico.gestion = 0 and proyecto.id=:proyecto_id',[':proyecto_id'=>$id])
                                ->all();
            
            foreach($indicadores as $ind)
            {
               $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$ind->id])
                                ->all();
                //var_dump($actividades);die;
                foreach($actividades as $act)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] > 0)
               {
                return json_encode(array('estado'=>0,'mensaje'=>"")); 
               }
            }
            
            return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>No tienen Actividad Registrada. <br/>"));
            
        
    }
    
    
    
    public function actionVerificar_presupuesto($id)
    {
        $mensaje = '';
        $w = 0;

        /*    select ap.monetario, sum(r.precio_total) as total from recurso r
INNER JOIN aportante ap on ap.id = r.fuente
INNER JOIN actividad a on a.id = r.actividad_id
INNER JOIN indicador i on i.id = a.id_ind
INNER JOIN objetivo_especifico o on o.id = i.id_oe
INNER JOIN proyecto p on p.id = o.id_proyecto
where p.id = 28
and ap.tipo = 1*/

            $total_recursos=Recurso::find()
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id and aportante.tipo = 1',[':proyecto_id'=>$id])
                                ->sum('recurso.precio_total');
            
            $presupuesto_pnia = Aportante::find()
                                        ->select('monetario')
                                        ->where('id_proyecto=:id_proyecto and aportante.tipo = 1',[':id_proyecto'=>$id])
                                        ->one();
            //var_dump($presupuesto_pnia);die;
            if((isset($total_recursos)) && (isset($presupuesto_pnia)))
            {
            if($total_recursos == $presupuesto_pnia->monetario)
            {
               $w = 1; 
            }
            
            if($total_recursos > $presupuesto_pnia->monetario)
            {
                $mensaje = "<strong>¡Cuidado! <strong>La suma de montos de los Recursos supera por S/. ".(floatval($total_recursos) - floatval($presupuesto_pnia->monetario))." el presupuesto asignado por PNIA por favor corregirlo. <br/>";
               $w = 2; 
            }
            
            if($total_recursos < $presupuesto_pnia->monetario)
            {
                $mensaje = "<strong>¡Cuidado! <strong>Tiene aun un saldo disponible de S/. ".(floatval($presupuesto_pnia->monetario) - floatval($total_recursos))." del presupuesto asignado por PNIA por favor completar los Recursos. <br/>";
               $w = 3; 
            }
            }
            else
            {
               $w = 1;  
            }
            $array['estado'] = $w;
            $array['mensaje'] = $mensaje;
            
            return json_encode($array);
    }
    
    public function actionVerificar_recursos($id)
    {
        $existe_ind = [];
        $w = 0;

                        
            $actividades=Actividad::find()
                                ->select('actividad.id,actividad.descripcion,actividad.id_ind')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$id])
                                ->all();
            
            foreach($actividades as $act)
            {
               $recursos=Recurso::find()
                                ->where('actividad_id=:actividad_id',[':actividad_id'=>$act->id])
                                ->all();
                foreach($recursos as $rec)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] == 0)
               {
                return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>Tiene actividades sin recursos registrados. <br/>"));
               }

            }
            
            return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    public function actionVerificar_registros_pendientes()
    {
        $proyectoCount = Proyecto::find()
                        ->where('situacion in(0,1) and user_propietario =:user_propietario',[':user_propietario'=>Yii::$app->user->identity->id])
                        ->count();
                        
                        
        if($proyectoCount > 0)
        {
            return $proyectoCount;
        }
        
        return 0;
    }
    
    
    public function actionVerificar_desembolsos_pendientes()
    {
                        
        $desembolso = SolicitudDesembolso::find()
                            ->where('estado in(0,1) and id_user =:id_user',[':id_user'=>Yii::$app->user->identity->id])
                            ->count();
        
        

        if($desembolso > 0)
        {
            return $desembolso;
        }
        
        return 0;
    }
    
    
    public function actionVerificar_desembolsos_disponible()
    {
                        
        $desembolso = SolicitudDesembolso::find()
                            ->where('estado = 1 and id_user =:id_user',[':id_user'=>Yii::$app->user->identity->id])
                            ->count();
        
        

        if($desembolso > 0)
        {
            return $desembolso;
        }
        
        return 0;
    }
    
    public function actionVerificar_peso_actividades($id)
    {
        $existe_ind = [];
        $w = 0;

            $indicadores=Indicador::find()
                                ->select('indicador.id,indicador.descripcion,indicador.id_oe')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('proyecto.id=:proyecto_id',[':proyecto_id'=>$id])
                                ->all();
            
            foreach($indicadores as $ind)
            {
               $actividades=Actividad::find()
                                ->where('id_ind=:id_ind',[':id_ind'=>$ind->id])
                                ->sum('peso');
                                
                if($actividades != 100)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] != 0)
               {
                return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>Revise el peso de las Actividades por Indicador, no se encuentran a su 100%. <br/>"));
               }

            }
            
            return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    public function actionVerificar_programado($id)
    {
        $existe_ind = [];
        $w = 0;

            $recursos=Recurso::find()
                                ->innerJoin('aportante','aportante.id=recurso.fuente')
                                ->innerJoin('actividad','actividad.id=recurso.actividad_id')
                                ->innerJoin('indicador','indicador.id=actividad.id_ind')
                                ->innerJoin('objetivo_especifico','objetivo_especifico.id=indicador.id_oe')
                                ->innerJoin('proyecto','proyecto.id=objetivo_especifico.id_proyecto')
                                ->where('aportante.tipo = 1 and proyecto.id=:proyecto_id and aportante.tipo = 1',[':proyecto_id'=>$id])
                                ->all();
            
            foreach($recursos as $rec)
            {
                                
                if($rec->cantidad > 0)
                {
                    $w++;
                }
                
                $existe_ind[] = $w;
                
                $w = 0;
                
            }
            
            
            for($e=0;$e<count($existe_ind);$e++)
            {
               if($existe_ind[$e] == 0)
               {
                return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>Tiene Recursos no Programados. <br/>"));
               }

            }
            
            return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    public function actionVerificar_colaborador_aporte($id)
    {
        $existe_ind = [];
        $w = 0;

            $aporte_sintotal=Aportante::find()
                                ->where('tipo = 3 and total = 0.00  and id_proyecto=:id_proyecto',[':id_proyecto'=>$id])
                                ->count();
            if($aporte_sintotal)
            {
            if($aporte_sintotal > 0)
            {
                return json_encode(array('estado'=>1,'mensaje'=>"<strong>¡Cuidado! <strong>Tiene Colaboradores sin aportes. Revisar el formulario de Financiamiento. <br/>"));
            }
            }
            return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
    
    
    public function actionPertnece_proyecto_user($id)
    {
        $existe_ind = [];
        $w = 0;

            $proyecto=Proyecto::find()
                                ->where('id = :id and user_propietario = :user_propietario',[':id'=>$id,':user_propietario'=>Yii::$app->user->identity->id])
                                ->count();
            
            if($proyecto > 0)
            {
                return 1;
            }
            
            return 0;
        
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
    
    public function actionCultivos($id)
    {
        $option = '';
       $cultivos = Maestros::find()
                            ->select('id, descripcion, orden')
                            ->where('estado = 1 and id_padre = :id_padre',[':id_padre'=>$id])
                            ->orderBy('orden')
                            ->all();
                            
        foreach($cultivos as $cult)
        {
            $option .= '<option value="'.$cult->id.'" >'.$cult->descripcion.'</option>';
           //$option .= '<b><input type="checkbox" id="proyecto-id_cultivo" name="Proyecto[id_cultivo][]" value="'.$cult->id.'" >'.$cult->descripcion.'</b><br/>';
        }
        
        echo $option;
    }
    
    public function actionEspecies($id)
    {
        $option = '';
       $cultivos = Maestros::find()
                            ->select('id, descripcion, orden')
                            ->where('estado = 1 and id_padre = :id_padre',[':id_padre'=>$id])
                            ->orderBy('orden')
                            ->all();
                            
        foreach($cultivos as $cult)
        {
            $option .= '<option value="'.$cult->id.'" >'.$cult->descripcion.'</option>';
           //$option .= '<b><input type="checkbox" id="proyecto-id_cultivo" name="Proyecto[id_cultivo][]" value="'.$cult->id.'" >'.$cult->descripcion.'</b><br/>';
        }
        
        echo $option;
    }
    
    public function actionVer_programado($id)
    {
        
       $programado = RecursoProgramado::find()
                            ->where('estado > 0 and id_recurso = :id_recurso',[':id_recurso'=>$id])
                            ->count();
                            
        
        if($programado > 0)
        {
            return json_encode(array('estado'=>1,'mensaje'=>"No puede eliminar el Recurso, tiene Asignado un Desembolso.<br/>"));
        }
        return json_encode(array('estado'=>0,'mensaje'=>""));
        
    }
}