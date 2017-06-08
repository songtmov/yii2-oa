<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

/* @var $model backend\models\Customer */

/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('common','业绩时间段查询');

$this->params['breadcrumbs'][] = $this->title;

?>

<?php $this->registerCss('

    .help-block{

        margin:0;

       display:none

    }

');

?>

<div class="customer-search mt">

    <?php $form = ActiveForm::begin([

        'action' => ['search'],

        'method' => 'get',

    ]); ?>

    <div class="col-md-6 col-md-offset-3" style="padding: 0">

        <div class="input-group input-group-lg">

            <?= $form->field($model, 'telephone')->textInput(['placeholder'=>empty($_GET['Search']['telephone'])?'请输入手机号码进行查询……':$_GET['Search']['telephone'],'class'=>'form-control input-lg'])->label(false) ?>

            <span class="input-group-btn">

                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-lg']) ?>

            </span>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="clearfix"></div>

 <div class="col-md-6 col-md-offset-3" style="margin-top: 30px;padding: 0;">

<?php if(isset($_GET['Search']['telephone'])):?>

    <?php if(count($data) == 0){?>

    <div style="margin-top: 20px">

        没有查找到用户数据 <?=Html::a('去添加',['create','telephone'=>$_GET['Search']['telephone']],['class'=>'btn btn-success btn-sm'])?>

    </div>

    <?php }else{?>



            <table class="table table-bordered">

                <thead>

                <tr>

                    <th>姓名</th>

                    <th>年龄</th>

                    <th>电话</th>

                    <th>性别</th>

                </tr>

                </thead>

                <tbody>

                    <tr>

                        <td><?=$data['client_name']?></td>

                        <td><?=$data['age']?></td>

                        <td><?=$data['telephone']?></td>

                        <td><?=$data['sex'] == 0 ?'女':'男'?></td>

                    </tr>

                </tbody>

            </table>

            <?= Html::a('添加来访记录',['/visit/create','id'=>$data['id']],['class'=>'btn btn-success'])?>





    <?php }?>

<?php endif?>

 </div>