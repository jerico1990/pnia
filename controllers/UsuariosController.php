<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use app\models\AuthItem;
use app\models\Perfil;
use app\models\Maestros;
use app\models\AuthAssignment;


use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Proyecto;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    public function behaviors()
    {
        
        return [
                'access' => [
            'class' => AccessControl::className(),
            'only' => ['index', 'view','create','update','delete','nuevo'],
            'rules' => [
                /*[
                    'actions' => ['logout', 'index'],
                    'allow' => true,
                    'roles' => ['@'],
                ],*/
                [
                    'actions' => ['index', 'view','create','update','delete','nuevo'],
                    'allow' => true,
                    'roles' => ['@'],
                    'matchCallback' => function ($rule, $action) {
                        //$valid_roles = ['administrador'];
                         if(\Yii::$app->user->can('administrador')) return true; else return $this->redirect(['dashboard/index']);;
                    }
                ],
            ],
        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='principal';
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout='principal';
        $usuarios = new Usuarios();

        if ($usuarios->load(Yii::$app->request->post())) {
            $usuarios->save();
            
            $auth = AuthItem::find()
                    ->where('type = :type',[':type'=>$usuarios->id_perfil])
                    ->one();
            $item = $auth->name;
            $assigment = new AuthAssignment();
            $assigment->item_name ="$item";
            $assigment->user_id ="$usuarios->id";
            $assigment->save();
            
            if($usuarios->id_perfil == 2)
            {
              $proyecto = new Proyecto();
              $proyecto->titulo = $usuarios->titulo;
              $proyecto->user_propietario = $usuarios->id;
              $proyecto->estado = 1;
              $proyecto->save();
            }
            
            return $this->redirect(['index']);
        } else {
            
            $perfil = Perfil::find()
                        ->where('estado = 1')
                        ->all();
            
            $ejecutora = Maestros::find()
                                ->where('id_padre = 25 and estado = 1')
                                ->orderBy('orden')
                                ->all();
            
            return $this->render('create', ['perfil'=>$perfil,'ejecutora'=>$ejecutora]);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $this->layout='principal';
        $usuarios = $this->findModel($id);

        if ($usuarios->load(Yii::$app->request->post())) {
            
            $auth = AuthItem::find()
                    ->where('type = :type',[':type'=>$usuarios->id_perfil])
                    ->one();
            
            if($usuarios->id_perfil2 != 2)
            {
                $usuarios->save();
                   
                $assigment = AuthAssignment::find()->where('user_id = :user_id',[':user_id'=>$usuarios->id])->one();
                $assigment->item_name =$auth->name;
                $assigment->user_id ="$usuarios->id";
                $assigment->save();
            }
            else
            {
                if($usuarios->nuevo_proyecto == 1)
                {
                    $proyecto = new Proyecto();
                    $proyecto->titulo = $usuarios->titulo;
                    $proyecto->user_propietario = $usuarios->id;
                    $proyecto->estado = 1;
                    $proyecto->save();
                    
                    $assigment = AuthAssignment::find()->where('user_id = :user_id',[':user_id'=>$usuarios->id])->one();
                    $assigment->item_name =$auth->name;
                    $assigment->user_id ="$usuarios->id";
                    $assigment->save();
                }
                //$usuario = Usuarios::findOne($usuarios->id);
                $usuarios->id_perfil = $usuarios->id_perfil2;
                $usuarios->save();
                
                
            }
            
            
            return $this->redirect(['index']);
        }
        
        else
        
        {
            $perfil = Perfil::find()
                        ->where('estado = 1')
                        ->all();
                        
            $usuarios = Usuarios::findOne($id);
            
            if($usuarios->id_perfil == 2)
            {
                $proyecto = Proyecto::find()
                                ->select('id, titulo')
                                ->where('estado = 1 and user_propietario = :user_propietario',[':user_propietario'=>$usuarios->id])
                                ->one();
                $id_proyecto = $proyecto->id;
                $titulo_proyecto = $proyecto->titulo;
            }
            else
            {
                $id_proyecto = null;
                $titulo_proyecto = null; 
            }
            
            $ejecutora = Maestros::find()
                                ->where('id_padre = 25 and estado = 1')
                                ->orderBy('orden')
                                ->all();
            if($usuarios->dependencia != 0)
            {
                
            $estacion = Maestros::find()
                                ->where('id_padre = :id_padre and estado = 1',[':id_padre'=>$usuarios->ejecutora])
                                ->orderBy('orden')
                                ->all();
            }
            else
            {
               $estacion = null; 
            }
            
        }
            return $this->render('update', [
                'usuarios' => $usuarios,
                'perfil'=>$perfil,
                'id_proyecto'=>$id_proyecto,
                'titulo_proyecto'=>$titulo_proyecto,
                'ejecutora'=>$ejecutora,
                'estacion'=>$estacion
            ]);
        
    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        AuthAssignment::find()->where("user_id='".$id."'")->one()->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    
    public function actionNuevo()
    {
        $this->layout='principal';
        $model = new Usuarios();
        $perfiles=Perfil::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->estado=1;
            $model->save();
            
            $assigment=new AuthAssignment;
            $assigment->user_id="$model->id";
            $assigment->item_name="$model->id_perfil";
            $assigment->save();
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('nuevo', [
                'model' => $model,
                'perfiles'=>$perfiles
            ]);
        }
    }

}
