<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use common\models\SupplieOrder;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SupplieOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Supplie Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplie-order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    
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
                'attribute' => 'client_id',
                'value' => 'client.client_name'
            ],
            'order_number',
            [

                'attribute'=>'store_id',
                'value'=>'store.name'
            ],
            [

                'attribute' => 'hakim_id',
                'value' => 'hakim.username'
            ],
            // [
            //     'attribute' => 'status',
            //     'value' => function($model){
            //         // p($model->status);die;
            //         return SupplieOrder::$state[$model->status];
            //     },
            //     'filter'=>Html::activeDropDownList(
            //             $searchModel,
            //             'status',
            //             SupplieOrder::$state,
            //             ['class'=>'form-control','prompt'=>'请选择']
            //         )
            // ],
            // 'created_time:datetime',
            // 'updated_time:datetime',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 220],
            'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            'buttons' => [
                'update'=> function($url,$model,$key){
                    // if($model->status == 20){
                        $button = Html::button('耗材',['value' => Url::to(['/supplie-order-detail/index','id'=>$model->id]), 'class' => 'btn btn-primary btn-sm ModalButton']);
                    // }elseif($model->status == 30){
                    //     $button = Html::button('已发放',[ 'class' => 'btn btn-primary btn-sm']);

                    // } else{
                    //     $button = '';
                    // }
                    return $button;
                },
                'view' => function($url,$model,$key){
                    // return $model->status == 10
                    // ? Html::button('待收款',['value' => Url::to(['view','id'=>$model->id]), 'class' => 'btn btn-warning btn-sm ModalButton']):
                    //     Html::button('已收款',['class'=>'btn btn-sm btn-success'])
                    // ;
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

$(".ModalButton").click(function(){
    $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
});
');


?>
