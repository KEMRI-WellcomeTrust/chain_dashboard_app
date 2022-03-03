<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
      if(!Yii::$app->user->isGuest){
      
        return $this->render('index');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionBanfora()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('banfora');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            Yii::$app->user->login($model->getUser(), $model->rememberMe ? 3600*24*30 : 0);
            //update last login stamp.
            Yii::$app->user->identity->loginStamp();
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionClinical()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('clinical');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionChain2()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('chain2');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionViz()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('viz');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionMonitoring()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('monitoring');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    /**
     * Displays TGHN Report.
     *
     * @return string
     */
    public function actionTghn()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('tghn');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLab()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('lab');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionQc()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('qc');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLabqc()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('labqc');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLabStorage()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('labstorage');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionNeobac()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('neobac');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionPar()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('par');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
    
    public function actionBiorepo()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('biorepo');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }

    public function actionPbsam()
    {
      if(!Yii::$app->user->isGuest){
        return $this->render('pbsam');
      }
      else{
            return $this->redirect(['site/login']);
        }
    }
}
