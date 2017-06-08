<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerDetail */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','顾客信息详情表');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-detail-index">
    <div style="margin-bottom: 2%;">
        <form action="/customerdetail/search" method="post">
            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
            <input type="text" name="username" placeholder="　输入用户名查询">　
            <button>查询</button>
        </form>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['id' => 'grid','class'=>'table-responsive'],
        'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
        'pager' => [
        'class' => \liyunfang\pager\LinkPager::className(),
        'template' => '<div class="page-body">{pageButtons} <p class="pageSize">{customPage} {pageSize}</p></div>', 
        //分页栏布局
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
            // 'id',
            [
                'attribute' => 'customer_id',
                'value' => 'customer.client_name'
            ],
            // 'customer_id',
            // 'filecode',
            'customer_birthday',
            'husband_birthday',
            'merry_day',
            'children_birthday',
            // 'customser_nature',
            // 'pay_times',
            // 'habit',
            // 'attitude',
            // 'emotion',
            // 'care_about',
            // 'hobby',
            'years',
            'total_sals',
            'healthy',
            'plastic_items',
            'plastic_part',
            'attidute',
            'hospital',
            'old_manner',
            // 'buy_type',
            // 'all_evaluate',
            // 'is_old_customer',
            'backup:ntext',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 185],
            'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            'buttons' => [
                'update'=> function($url,$model,$key){
                    // return Html::a(Yii::t('common','Update'),$url,['class'=>'btn btn-primary btn-sm']);
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
