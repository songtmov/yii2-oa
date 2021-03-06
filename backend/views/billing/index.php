<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BillingOperation */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Billing Operations');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
    $gridColumns = [
        'id',
        'client_id',
        'surgical_id',
        'hakim_id',
        'assistant_id',
        'nurse_id',
        'surgery_cost',
        'counselor_id',
        'store_id',
        'sale_id',
        'status',
        'operation_time',
        'created_time',
        'order_num'
    ];
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);
?>
<div class="billing-operation-index">
    
    <!-- <?php  //echo $this->render('_search', ['model' => $searchModel]); ?> -->
    
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','Create Billing Operation'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
        
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','生成Execl'), ['dump-excel'], ['class' => 'btn btn-danger pull-right']) ?>
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
            'order_num',
            [
                'attribute'=>'client_id',
                'value'=>'client.client_name'
            ],
            [
                'attribute'=>'surgical_id',
                // 'value'=>'surgical.entry_name'
            ],
            [
                'attribute'=>'hakim_id',
                // 'value'=>'hakim.username'
            ],
            [
                'attribute'=>'assistant_id',
                // 'value'=>'assistant.username'
            ],
            [
                'attribute'=>'nurse_id',
                // 'value'=>'nurse.username'
            ],
            'surgery_cost',
            [
                'attribute'=>'counselor_id',
                'value'=>'counselor.username'
            ],
            [
                'attribute'=>'store_id',
                'value'=>'store.name'
            ],
            [
                'attribute'=>'sale_id',
                'value'=>'sale.username'
            ],
            // 'status',
            [
                'attribute'=>'status',
                'format' =>'html',
                'value' => function($model){
                    return Html::a(\common\models\BillingOperation::$state[$model->status],'javascript:',['class'=>'btn btn-success btn-sm']);
                }
            ],
            // 'operation_time',
            // 'created_time',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 140],
            'template' => Helper::filterActionColumn('{son}{view}{delete}'),
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
    <?php if (($models = $dataProvider->models) !== []): ?>
    <div class="batch">

        <?=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>

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