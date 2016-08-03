<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarFormulario;

class SiteController extends Controller
{
    public function actionSaludo($get = "mensaje GET")
    {
        $mensaje = "Hola Mundo";
        $numeros = [0,1,2,3,4,5];
        return $this->render('saludo',
                             [
                              
                              "mensaje" => $mensaje,
                              "array"=>$numeros,
                              "get" => $get
                              
                              ]);
    }
    
    public function actionFormulario($mensaje = null)
    {
        return $this->render('formulario',["mensaje"=>$mensaje]);
        
    }
    
    
    public function actionRequest()
    {
        $mensaje = null;
        if(isset($_REQUEST["nombre"]))
        {
            $mensaje = "Tu mensaje ha llegado".$_REQUEST["nombre"];
        }
      $this->redirect(["site/formulario", "mensaje" => $mensaje]);
    }
    
    public function actionValidarformulario()
    {
        $model = new ValidarFormulario;
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                //envia a la abase
            }
            else
            {
                
                $model->getErrors();
            }
            
            
            
        }
        return $this->render('validarformulario',["model"=>$model]);
    }
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
