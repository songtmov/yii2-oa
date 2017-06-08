<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReturnVisit */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Return Visits');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="return-visit-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
<!--<p class="clearfix">
        <!--?= //Html::a('<i class="fa fa-plus"></i>'.Yii::t('common','Create Return Visit'), ['create'], ['class' => 'btn btn-success pull-right']) ?-->
<!--    </p>-->
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

            [
                'attribute'=>'client_id',
                'value'=>'customer.client_name'
            ],
            [
                'attribute'=>'client_status',
                'value' => function($model){
                    return $model->client_status == 0 ?'新拜访':'已合作';
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'client_status',
                    [1=>'已合作',0=>'新拜访'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
                'attribute'=>'mode',
                'value' => function($model){
                    $mode = [0=>'拜访',1=>'电话',2=>'通讯工具'];
                    return $mode[$model->mode];
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'mode',
                    [0=>'拜访',1=>'电话',2=>'通讯工具'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
                'attribute'=>'is_satisfied',
                'value' => function($model){
                    return $model->is_satisfied == 0 ?'不满意':'满意';
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'is_satisfied',
                    [1=>'满意',0=>'不满意'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            [
              'attribute'=>'health',
                'value'=>function ($model){
                    return $model->health == 0?'异常':'正常';
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'health',
                    [1=>'正常',0=>'异常'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            // 'status',
            [
                'attribute'=>'created_time',
                 'value'=>function($model){
                     return date('Y-m-d H:i:s',$model->created_time);
                 }
            ],
            // 'updated_time:datetime',


            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 185],
            'template' => Helper::filterActionColumn('{son}{view}{delete}'),
            'buttons' => [

                'view' => function($url,$model,$key){
                    $url = Url::to(['return-visit/view','id'=>$model->visit_id]);
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
                }
            ]
            ],
        ],
    ]); ?>
    <?php if (($models = $dataProvider->models) !== []): ?>

    <div class="batch">

        <?=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>

        <?=  Html::a(Yii::t('common','Batch audit'), "javascript:void(0);", ["class" => "btn btn-success audit"]) ?>

    </div>
    <?php endif?>

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
