<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use common\models\DrugBuyerOrder;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DrugBuyerOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Drug Buyer Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-buyer-order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
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

            'buyer_number',
            [
                'attribute'=>'store_id',
                'value' => 'store.name'
            ],
            
            [
                'attribute'=>'applicant_id',
                'value' => 'applicant.username'
            ],
            [
                'attribute'=>'buyer_id',
                'value' => 'buyer.username'
            ],
            [
                'attribute'=>'status',
                'value'=>function($model){

                    return DrugBuyerOrder::$state[$model->status];

                }
            ],
            [
                'attribute'=>'created_time',
                'value' => function($model){
                    return date('Y-m-d H:i:s',$model->created_time);
                }
            ],
            // 'updated_time',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 210],
            'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            'buttons' => [
                'update'=> function($url,$model,$key){
                    return Html::button('采购详情',['value' => Url::to(['/drug-buyer-detail/index','id'=>$model->id]), 'class' => 'btn btn-primary btn-sm ModalButton']);
                },
                'view' => function($url,$model,$key){
                    return Html::button('详情',['value' => Url::to(['view','id'=>$model->id]), 'class' => 'btn btn-warning btn-sm ModalButton']);
                },
                'delete' => function($url,$model,$key){
                    // return Html::a(Yii::t('common','Delete'),$url,[
                    // 'class'=>'btn btn-danger btn-sm',
                    // 'data' => [
                    //     'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                    //     'method' => 'post',
                    //     ],
                    // ]);
                }
            ]
            ],
        ],
    ]); ?>

    <?php \yii\bootstrap\Modal::begin([
        'header' => '<h4>订单详情</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);
    echo '<div id="modalContent"></div>';
    \yii\bootstrap\Modal::end();
    ?>

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
$(".ModalButton").click(function(){
    $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
});
');


?>
