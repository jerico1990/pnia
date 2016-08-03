<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\ReportesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportesController implements the CRUD actions for Usuarios model.
 */
class ReportesController extends Controller
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
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout='principal';
        $searchModel = new ReportesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $proyectos = Usuarios::find()
                        ->select('proyecto.titulo,
	max(usuarios.username) as username,
	count(DISTINCT objetivo_especifico.id) as obj_esp ,
	count(DISTINCT indicador.id) as indicador ,
	count(DISTINCT actividad.id) as actividad,
	count(DISTINCT recurso.id) as recurso,
        ubigeo.department,
        proyecto.vigencia,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_dependencia_inia) as operativa,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_unidad_ejecutora) as ejecutora2,
	(select maestros.descripcion from maestros where maestros.id = proyecto.id_direccion_linea) as linea,
        (select aportante.monetario from aportante where aportante.id_proyecto = proyecto.id and aportante.tipo = 1) as presupuesto,
	sum(recurso.precio_total) as recurso_total')
                                ->innerJoin('proyecto','proyecto.user_propietario = usuarios.id')
                                ->leftJoin('objetivo_especifico','objetivo_especifico.id_proyecto = proyecto.id')
                                ->leftJoin('indicador','indicador.id_oe = objetivo_especifico.id')
                                ->leftJoin('actividad','actividad.id_ind = indicador.id')
                                ->leftJoin('recurso','recurso.actividad_id = actividad.id')
                                ->leftJoin('ubigeo','ubigeo.district_id = proyecto.ubigeo')
                                ->where('proyecto.estado = 1')
                                ->groupBy(['proyecto.titulo'])
                                ->orderBy('username')
                                ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proyectos' => $proyectos
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
        $model = new Usuarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
     * Deletes an existing Usuarios model.
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
}
