<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '美林苑OA系统登录';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

AppAsset::register($this);
AppAsset::addCss($this,Yii::$app->request->baseUrl."/statics/css/supersized.css");
// AppAsset::addCss($this,Yii::$app->request->baseUrl."/statics/css/login.css");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/statics/js/supersized.3.2.7.min.js");
AppAsset::addScript($this,Yii::$app->request->baseUrl."/statics/js/supersized-init.js");
$this->registerCss('
    .captcha-image{
        height:42px;
        padding-left:0;
        overflow: hidden;
    }
    .captcha-input{
        padding:0
    }
    .captcha-image img{
        max-width:100%;
        min-height:100%
    }
    ');
?>

<div class="login-box">

    <!-- /.login-logo -->
    <div class="login-box-body">
        <h1>Login Tmov</h1>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('请输入您的用户名!')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('请输入您的用户密码!')]) ?>
        
        <?= $form->field($model, 'verifyCode')
        ->label(false)
        ->widget(Captcha::className(), 
            [
                'imageOptions'=>['id'=>'captchaimg', 'title'=>'看不清？点击换一个！' ],
                'template' => '
                <div class="row">
                <div class="col-xs-7"><input type="text" id="loginform-verifycode" class="form-control" placeholder="请输入验证码！" name="LoginForm[verifyCode]"/></div>
                <div class="col-xs-5 captcha-image">{image}</div>
                </div>',
            ]) ?>
        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox()->label('记住我') ?>
            </div>
            <!-- /.col -->
            <div class="col-xs-4" style="min-height: 40px;line-height: 40px;padding:0;text-align:center">
                <!-- <a href="#">忘记密码？</a> -->
                <br>
                
            </div>
            <!-- /.col -->

        </div>
        <div class="form-group">
            
            <?= Html::submitButton('立即登录', ['class' => 'btn btn-danger btn-block btn-flat', 'name' => 'login-button']) ?>
                
        </div>

        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
            <p>　</p>
            <!-- <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"> -->
            <!-- <i class="fa fa-facebook"></i> -->
            <!-- <img src="/statics\images\wechat.png"> 　　　　　　微信登陆 </a> -->
            <!-- <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"> -->
            <!-- <i class="fa fa-google-plus"></i> -->
            <!-- <img src="/statics\images\xinlang.png">　　　　　　 微博登陆 </a> -->
            <!-- </div> -->
        </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<!-- HTML to write -->