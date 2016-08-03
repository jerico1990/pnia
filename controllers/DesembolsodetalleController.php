<?php

namespace app\controllers;

use Yii;
use app\models\RecursoProgramado;
use app\models\SolicitudDesembolso;
use app\models\DetalleSolicitud;
use app\models\DesembolsoDetalleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesembolsodetalleController implements the CRUD actions for RecursoProgramado model.
 */
class DesembolsodetalleController extends Controller
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
     * Lists all RecursoProgramado models.
     * @return mixed
     */
    public function actionIndex()
    {
        $total = 0;
        $hoy = getdate();
        $this->layout='principal';
        $searchModel = new DesembolsoDetalleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $model = new RecursoProgramado();
        if ($model->load(Yii::$app->request->post()))
        {
            for($i=0;$i<6;$i++)
            {
                if(isset($model->solicita[$i]))
                {
                    $total += $model->cantidad2[$model->solicita[$i]];
                   
                }
            }
            
            $solicitud = new SolicitudDesembolso();
            $solicitud->id_user = Yii::$app->user->identity->id;
            $solicitud->total = $total;
            $solicitud->total_pendiente = $total;
            $solicitud->fecha_solicitud = $hoy['year'].'-'.$hoy['mon'].'-'.$hoy['mday'];
            $solicitud->save();
            
            for($e=0;$e<6;$e++)
            {
                if(isset($model->solicita[$e]))
                {
                    $detalle = new DetalleSolicitud();
                    $detalle->id_solicitud = $solicitud->id;
                    $detalle->anio = $model->anio[$model->solicita[$e]];
                    $detalle->mes = $model->mes[$model->solicita[$e]];
                    $detalle->monto =  $model->cantidad2[$model->solicita[$e]];
                    $detalle->save();
                   
                }
            }
            
            return $this->redirect('../solicituddesembolso/index');
        }
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecursoProgramado model.
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
     * Creates a new RecursoProgramado model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecursoProgramado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RecursoProgramado model.
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
     * Deletes an existing RecursoProgramado model.
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
     * Finds the RecursoProgramado model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecursoProgramado the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecursoProgramado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionDesembolso_pendiente($id_user)
    {
        $desembolsos = SolicitudDesembolso::find()
                            ->where('estado in(0,1) and id_user = :id_user',[':id_user'=>$id_user])
                            ->count();
                            
        if($desembolsos > 0)
            {
                return json_encode(array('estado'=>1,'mensaje'=>"Tiene una Solicitud de Desembolso Inconclusa."));
            }
            
            return json_encode(array('estado'=>0,'mensaje'=>""));
    }
}
