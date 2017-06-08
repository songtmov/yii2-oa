<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MeetingConvey */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','会议传达表（市场部）');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="meeting-convey-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','新建会议传达表（市场部）'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
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
            [
                'attribute' => 'meeting_type',
                'value' => function($model){
                    if($model->meeting_type){
                        return '大会';
                    }else{
                        return '小会';
                    }
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'meeting_type',
                    [0=>'小会',1=>'大会'],
                    ['class' => 'form-control', 'prompt' => '请选择....'])
            ],
            'meeting_topic',
            'meeting_address',
            // 'cstore_id',
            [
                'attribute' => 'cstore_id',
                'value' => 'cstore.store_name'
            ],
            // 'cstore_address',
            // 'owner_id',
            // 'owner_phone',
            // 'cstore_number',
            // 'cstore_area',
            // 'manager_id',
            // 'manager_phone',
            // 'emplyees_number',
            // 'training_date',
            // 'hotel_name',
            // 'hotel_address',
            // 'hotel_floor',
            // 'doctor_id',
            // 'instructor_id',
            // 'host_id',
            // 'asistant_id',
            // 'consultant_id',
            // 'engineer_id',
            // 'nurse_id',
            // 'resident_id',
            // 'cameraman_id',
            // 'travel_arrangement:ntext',
            // 'ticket',
            // 'draw',
            // 'invitation',
            // 'box',
            // 'vehicle_type',
            // 'renter_id',
            // 'marketing_responsible_id',
            // 'meeting_responsible_id',
            // 'ko_solution:ntext',
            // 'place_solution:ntext',
            // 'creattime',
            // 'comment:ntext',


            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 185],
            'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            'buttons' => [
                'update'=> function($url,$model,$key){
                    return Html::a(Yii::t('common','Update'),$url,['class'=>'btn btn-primary btn-sm']);
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
                }
            ]
            ],
        ],
    ]); ?>
    <?php  if (($models = $dataProvider->models) !== []):?>
        
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
