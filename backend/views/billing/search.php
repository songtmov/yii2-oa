<?php

use yii\widgets\ActiveForm;

// use yii\bootstrap\Html;
use yii\helpers\Html;

/**

 * Created by PhpStorm.

 * User: Administrator

 * Date: 2016/12/22 0022

 * Time:  5:27

 */

$this->title = '用户信息搜索';

$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Billing Operations'), 'url' => ['index']];



$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->registerCss('

    .input-group-lg .help-block{

        margin:0;

       display:none

    }

    .col-md-7{

        padding:0

    }

    .billing-operation-form {

        margin-top:20px

    }

');?>

<div class="customer-search mt">



    <?php $form = ActiveForm::begin([

        'action' => ['create'],

        'method' => 'get',

    ]); ?>







    <div class="col-md-7 col-md-offset-2" style="padding: 0">



        <div class="input-group input-group-lg">



            <?= $form->field($query, 'telephone')->textInput(['placeholder'=>empty($_GET['Search']['telephone'])?'请输入手机号码进行查询……':$_GET['Search']['telephone'],'class'=>'form-control input-lg'])->label(false) ?>



            <span class="input-group-btn">



                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-lg']) ?>



            </span>



        </div>

    </div>



    <?php ActiveForm::end(); ?>



</div>

