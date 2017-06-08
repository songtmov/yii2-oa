<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use common\models\CustomerDetail;
use common\models\Customer;
use common\models\UserModel;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Customer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .btn-sm{
        width:30%;
        margin-bottom: 2px;
    }
</style>
<div class="customer-index">
    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"> </i> '.Yii::t('common','新增客户基础信息'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
    <?php  endif?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['id' => 'grid','class'=>'table-responsive'],
        'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
        'pager' => [
        'class' => \liyunfang\pager\LinkPager::className(),
        'template' => '<div class="page-body">{pageButtons} <p class="pageSize">{customPage} {pageSize}</p></div>', //分页栏布局
        'pageSizeList' => [10, 20, 30, 50,100], //页大小下拉框值
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
            'client_name',
            'telephone',
            'age',
            [
                'attribute'=>'sex',
                'value'=>function($model){
                    return $model->sex == 0?'女':'男';
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'sex',
                    [0=>'女',1=>'男'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
                'attribute'=>'cstore_id',
                'value'=>'cstore.store_name',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'cstore_id',
                    $csres,
                    ['class'=>'form-control','prompt'=>'请选择']
                ),
            ],
            [
                'attribute'=>'source',
                'value'=>function($model){
                    return \common\models\SourceType::find()->select('source_name')->where(['id'=>$model->source])->one()['source_name'];
                }
                ,
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'source',
                    $new,
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
                'attribute'=>'sale_id',
                'value'=>'sale.username'
            ],
            [
                'attribute'=>'service_id',
                'value'=>'service.username',
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'service_id',
                    $ures,
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
                'attribute'=>'created_time',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model->created_time);
                }
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 240],
            'template' => Helper::filterActionColumn('{detail}{detailview}{detailupdate}{update}{view}{delete}{list}{son}'),
            'buttons' => [
                'detail' => function ($url, $model, $key) {
                    $customer_id = $model -> id;
                    $customer_detail_model = new CustomerDetail();
                    if(!$customer_detail_model::find()->where(['customer_id' => $customer_id])->one()){
                        $url = \yii\helpers\Url::to(['customerdetail/create','id'=>$model->id]);
                        return Html::a('增设详情', $url, ['class' => 'btn btn-success btn-sm'] );
                    }
                },

                'detailview' => function ($url, $model, $key) {
                    $customer_id = $model -> id;
                    $customer_detail_model = new CustomerDetail();
                    if($customer_detail_model::find()->select('id')->where(['customer_id' => $customer_id])->one()){
                        $customer_detail_id = $customer_detail_model::find()->select('id')->where(['customer_id' => $customer_id])->one()->id;
                        $url = \yii\helpers\Url::to(['customerdetail/view','id' => $customer_detail_id,'customer_id' => $model->id]);
                        return Html::a('详情查看', $url, ['class' => 'btn btn-danger btn-sm'] );
                    }
                },

                'detailupdate' => function ($url, $model, $key) {
                    $customer_id = $model -> id;
                    $customer_detail_model = new CustomerDetail();
                    if($customer_detail_model::find()->select('id')->where(['customer_id' => $customer_id])->one()){
                        $customer_detail_id = $customer_detail_model::find()->select('id')->where(['customer_id' => $customer_id])->one()->id;
                        $url = \yii\helpers\Url::to(['customerdetail/update','id' => $customer_detail_id,'customer_id' => $model->id]);
                        return Html::a('详情修改', $url, ['class' => 'btn btn-primary btn-sm'] );
                    }   
                },

                'son' => function ($url, $model, $key) {
                    $url = \yii\helpers\Url::to(['visit/create','id'=>$model->id]);
                    return Html::a('来访', $url, ['class' => 'btn btn-success btn-sm'] );
                },

                'update'=> function($url){
                    return Html::a(Yii::t('common','Update'),$url,['class'=>'btn btn-danger btn-sm']);
                },
                
                'view' => function($url,$model,$key){
                    return Html::a(Yii::t('common','View'),$url,['class'=>'btn btn-warning btn-sm']);
                },

                'delete' => function($url,$model,$key){
                    return Html::a(Yii::t('common','Delete'),$url,[
                    'class'=>'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                        'method' => 'post',
                        ],
                    ]);
                },
                
                'list' => function($url,$model,$key){
                    $url = \yii\helpers\Url::to(['customer/openlist','id'=>$model->id]);
                    return Html::a(Yii::t('common','开单'),$url,[
                    'class'=>'btn btn-warning btn-sm']);
                }
            ]
            ],
        ],
    ]); ?>
    
</div>

<div class="batch">
    <?=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>
</div>

<?php $this->registerJs('
$(".gridview").on("click", function () {
    var keys = $("#grid").yiiGridView("getSelectedRows");
    if(keys == "" || keys==null){
     alert("' . Yii::t('common', 'Please select the option to delete!') . '");
     return false;
    }
   if (window.confirm("'.Yii::t('common','Delete is not recoverable, are you sure you want to delete these options?').'")){
        $.ajax({
            type:"POST",
            url:"'.Url::to(['delall']).'",
            data:{id:keys},
            success: function(data){
            }
        });
   }
});
$(".audit").on("click", function () {
    var keys = $("#grid").yiiGridView("getSelectedRows");
    if(keys == "" || keys==null){
     alert("' . Yii::t('common', 'Please select the option to review!') . '");
     return false;
    }
   if (window.confirm("'.Yii::t('common','Are you sure you want to pass the audit?').'")){
        $.ajax({
            type:"POST",
            url:"'.Url::to(['updateall']).'",
            data:{id:keys},
            success: function(data){
            }
        });
   }
});
');
?>
