<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
//use app\models\Recuperar;
use app\models\Mensajes;
//use app\models\TblPersona;
use app\models\Usuarios;

class LoginController extends Controller
{
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','logout'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                ],
            ],//estaba en post debido a que cuando creastes el yii este se guardpo por post y no en base de datos y necesitabas un action
            //ya saio
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
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

    public function actionIndex()//esto si
    {
        
        $this->layout='inicio';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model=new LoginForm();
       
        if($model->load(Yii::$app->request->post()) && $model->login())
        {
            return $this->redirect(['dashboard/index']);
        }
        //return $this->redirect('http://10.1.1.64/jec/web');
        return $this->render('index',['model'=>$model]);
    }

    public function actionLogin()// esto no funca login/login
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        
        $session = Yii::$app->session;
        $session->destroy();

        return $this->redirect(['login/index']);
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    
    /*public function actionRecuperar()
    {
        $this->layout='blank';
        $model= new Recuperar;
        $model->scenario='recuperar';
        $mensajes=new Mensajes();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $persona=TblPersona::find()->select('id,per_email')->where('per_email=:per_email',[':per_email'=>$model->correo])->one();
            $usuario=Usuario::find()->where('id_persona=:id_persona',[':id_persona'=>$persona->id])->one();
            
            $usuario->user_link_verificacion=$mensajes->generate_random_key();
            $usuario->update();
            $mensajes->recuperar($model->correo,$usuario->user_link_verificacion);
            
            
            Yii::$app->session->setFlash('mensaje');
            return $this->refresh();
        }
        return $this->render('recuperar',['model'=>$model]);
    }*/
}
