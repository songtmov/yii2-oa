<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

/* @var $model backend\models\Customer */

/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('common','店家搜索');

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

            <!-- <?php //p($_GET);die;?> -->
            <!-- Search%5Btelephone%5D=18888888888 -->
            <!-- <?php //p($form->field($model,'store_name'));?> -->
            
            <?= $form->field($model,'store_name')->textInput(['placeholder' => empty($_GET['StoreSearch']['store_name'])?'请输入店家名进行查询……':$_GET['StoreSearch']['store_name'],'class'=>'form-control input-lg'])->label(false) ?>
            
            <span class="input-group-btn">
            
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-lg']) ?>
    
            </span>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="clearfix"></div>

 <div class="col-md-6 col-md-offset-3" style="margin-top: 30px;padding: 0;">

<?php if(isset($_GET['StoreSearch']['store_name'])):?>

    <?php if(count($data) == 0){?>
    
    <div style="margin-top: 20px">

        没有查找到用户数据 <?=Html::a('去添加',['customer/create','store_name'=>$_GET['StoreSearch']['store_name']],['class'=>'btn btn-success btn-sm'])?>

    </div>

    <?php }else{?>
    
            <table class="table table-bordered">

                <thead>

                <tr>
    
                    <th>店名</th>

                    <th>老板姓名</th>

                    <th>地址</th>

                    <th>医院</th>

                    <th>驻店咨询</th>

                    <!-- <th>老板照片</th> -->

                </tr>

                </thead>

                <tbody>

                    <tr>

                        <td><?=$data['store_name']?></td>
                        
                        <td><?=$data['boss']?></td>
                        
                        <td><?=$data['adress']?></td>
                        
                        <td><?=$store_name?></td>

                        <td><?=$acreage_name?></td>
                        
                        <!-- <td style="text-align:center;"><img style="width: 60%;height:20%;" src="<?//=$data['boss_photo']?>"></td> -->
                        
                    </tr>

                </tbody>

            </table>

            <!-- <?//=Html::a('添加来访记录',['/visit/create','id'=>$data['id']],['class'=>'btn btn-success'])?> -->
            
            <?=Html::a('查看该店详情',['/cstore/view','id'=>$data['id']],['class'=>'btn btn-success'])?>
            
    <?php }?>

<?php endif?>

 </div>



