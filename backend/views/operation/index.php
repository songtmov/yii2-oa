<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

use common\models\User;
use common\models\Customer;
use common\models\SurgicalItems;
use common\models\cstore;
use common\models\BillingOperation;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Operation */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common',$title);
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerCssFile('../statics/js/jquery.js');?>

<style>
    #button{
        position: relative;
        right:90%;
    }
</style>

<div class="billing-operation-index">
    <div style="width: 100%;height: 200px;margin:0 1% 3% 0;">
        <div style="width:100%;height: 50px;">
            <button class="btn btn-primary" style="width: 15%">选择查询</button>
        </div>
        <form action="<?=$_SERVER['REQUEST_URI'];?>" method="post">
            <div style="display:none"><input type="hidden" value="<?=md5('songyu');?>" name="_csrf" /></div>
            <div style="width:100%;height: 50px;">
                <button class="btn btn-danger" style="">开始时间</button>　
                    <select name="timestart[year]" id="year1">
                        <?php
                            foreach (BillingOperation::yearlist() as $key => $value) {
                                if($value == date('Y',time())){
                                    echo '<option selected = "selected" value="'.$value.'">'.$value.'</option>';
                                }else{
                                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>　年　
                    <select name="timestart[mouth]" id="mouth1">
                        <?php
                            foreach (BillingOperation::mouthlist() as $key => $value) {
                                if($value == date('m',time())){
                                    echo '<option selected = "selected">'.$value.'</option>';
                                }else{
                                    echo '<option>'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>　月　
                    <select name="timestart[day]" id="day1">
                        <?php
                            for ($i=1; $i <= 30; $i++) { 
                                if($i == date('d',time())){ 
                                    echo '<option selected = "selected">'.$i.'</option>';
                                }else{
                                    echo '<option>'.$i.'</option>';
                                }
                            }
                        ?>
                    </select>　日
                    <label for="billingoperation-surgical_id" class="sr-only"></label>
            </div>
            <div style="width:100%;height: 50px;">
                <button class="btn btn-warning" style="">结束时间</button>　
                <select name="timeend[year]" id="year2">
                        <?php
                            foreach (BillingOperation::yearlist() as $key => $value) {
                                if($value == date('Y',time())){
                                    echo '<option selected = "selected">'.$value.'</option>';
                                }else{
                                    echo '<option>'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>　年　
                    <select name="timeend[mouth]" id="mouth2">
                        <?php
                            foreach (BillingOperation::mouthlist() as $key => $value) {
                                if($value == date('m',time())){
                                    echo '<option selected = "selected">'.$value.'</option>';
                                }else{
                                    echo '<option>'.$value.'</option>';
                                }
                            }
                        ?>
                    </select>　年　
                    <select name="timeend[day]" id="day2">
                        <?php
                            for ($i=1; $i <= 30; $i++) { 
                                if($i == date('d',time())){
                                    echo '<option selected = "selected" value="'.$i.'">'.$i.'</option>';
                                }else{
                                    echo '<option>'.$i.'</option>';
                                }
                            }
                        ?>
                    </select>　日　
            </div>
            <div style="width:100%;height: 50px;">
                <button class="btn btn-success" style="width: 15%">查询</button>
            </div>
        </form>
    <!-- <script type="text/javascript">
        timestart = $('#year1').val() + '-' + $('#mouth1').val() + '-' + $('#day1').val();
        timeend = $('#year2').val() + '-' + $('#mouth2').val() + '-' + $('#day2').val();
    </script> -->
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['id' => 'grid','class'=>'table-responsive'],
        'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
        'pager' => [
        'class' => \liyunfang\pager\LinkPager::className(),
        'template' => '<div class="page-body">{pageButtons} <p class="pageSize">{customPage} {pageSize}</p></div>', //分页栏布局
        'pageSizeList' => [10, 20, 30, 50, 100], //页大小下拉框值
        'customPageWidth' => 50,            //自定义跳转文本框宽度
        'hideOnSinglePage' => false,        //当页码小于2页的时候是否显示分页，true不显示，false显示
        'customPageBefore' => Yii::t('common','Jump To'), //跳转到
        'customPageAfter' => Yii::t('common','Page'),    // 页
        'firstPageLabel'=>Yii::t('common','First'),      // 首页button
        'prevPageLabel'=>Yii::t('common','Prev'),        // 上一页button
        'nextPageLabel'=>Yii::t('common','Next'),        // 下一页button
        'lastPageLabel'=>Yii::t('common','Last'),        // 尾页button
        'maxButtonCount' => 10,                         //  默认页码
        ],
        'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\CheckboxColumn',
            'name' => 'id'
            ],
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute'=>'client_id',
                'value'=> function($model){
                    $client_id = $model -> client_id;
                    $customer_model = new Customer();
                    $client_name = $customer_model::find()->select('client_name')->where(['id' => $client_id])->one()['client_name'];
                    return $client_name;
                }
            ],
            // 'client_id',
            // 'surgical_id',
            [
                'attribute'=>'surgical_id',
                'value'=> function($model){
                    $surgical_id = $model -> surgical_id;
                    $surgicalltems_model = new SurgicalItems();
                    $entry_name = $surgicalltems_model::find()->select('entry_name')->where(['id' => $surgical_id])->one()['entry_name'];
                    return $entry_name;
                }
            ],
            // 'hakim_id',
            // 'assistant_id',
            // 'nurse_id',
            'surgery_cost',
            // 'counselor_id',
            [
                'attribute'=>'counselor_id',
                'value'=> function($model){
                    $counselor_id = $model -> counselor_id;
                    $user_model = new User();
                    $username = $user_model::find()->select('username')->where(['id' => $counselor_id])->one()['username'];
                    return $username;
                }
            ],
            [
                'attribute'=>'store_id',
                'value'=> function($model){
                    $store_id = $model -> store_id;
                    $cstore_model = new cstore();
                    $store_name = $cstore_model::find()->select('store_name')->where(['id' => $store_id])->one()['store_name'];
                    return $store_name;
                }
            ],
            // 'store_id',
            [
                'attribute'=>'sale_id',
                'value'=> function($model){
                    $sale_id = $model -> sale_id;
                    $user_model = new User();
                    $username = $user_model::find()->select('username')->where(['id' => $sale_id])->one()['username'];
                    return $username;
                }
            ],
            // 'sale_id',
            // 'status',
            'operation_time',
            // 'created_time:datetime',
            [
                'attribute' => 'created_time',
                'value' => function($model){
                    return date('Y-m-d h:i:s',$model->created_time);
                }
            ],
            // [
            // 'class' => 'yii\grid\ActionColumn',
            // 'header' => Yii::t('common','operation'),
            // 'headerOptions'=>['width' => 185],
            // 'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            // 'buttons' => [
            //     'update'=> function($url,$model,$key){
            //         return Html::a(Yii::t('common','Update'),$url,['class'=>'btn btn-primary btn-sm']);
            //     },
            //     'view' => function($url,$model,$key){
            //         return Html::a(Yii::t('common','View'),$url,['class'=>'btn btn-warning btn-sm']);
            //     },
            //     'delete' => function($url,$model,$key){
            //         return Html::a(Yii::t('common','Delete'),$url,[
            //         'class'=>'btn btn-danger btn-sm',
            //         'data' => [
            //             'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
            //             'method' => 'post',
            //             ],
            //         ]);
            //     }
            // ]
            // ],
        ],
    ]); ?>

<div style="position: relative;left:70%;"><h3>业绩统计　<b><span style="color: red;"><?php if(empty($num)){echo '¥0.00';}else{echo '¥'.$num;};?></span></b></h3></div>



