<?php
namespace backend\controllers;

use common\models\User;
use Yii; 
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','captcha'],
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
     * @inheritdoc
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
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 5, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>42,//高度
                'width' => 135,  //宽度  
                'foreColor'=>0xffffff,     //字体颜色
                'offset'=>13       //设置字符偏移量 有效果
                //'controller'=>'login',        //拥有这个动作的controller
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
        // phpinfo();die;
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $url = Yii::$app->request->getHostInfo(); // 获取当前url的域名 
        // echo Yii::$app->request->getPathInfo(); // 获取当前除url域名外的后段
        $uarray = explode('//', $url);
        $server = $uarray[1];
        $server = explode('.',$server);
        $servername = $server[0];
        // var_dump($servername);

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            User::updateAll(['login_time'=>time(),'login_ip'=>Yii::$app->request->userIP],['id'=>Yii::$app->user->identity->id]);

            return $this->goBack();

        } else {

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
        
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}