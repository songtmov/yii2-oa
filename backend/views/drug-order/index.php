<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\DrugOrder;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DrugOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerCss('
.table-bordered > tbody >tr>td:last-child{
    text-align: center;
}');
$this->title = Yii::t('common','Drug Orders');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="drug-order-index">

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
                'attribute'=>'client_id',
                'value'=>'client.client_name'
            ],
            'order_number',
            'amount',
            [
                'attribute'=>'store_id',
                'value' => 'store.name'
            ],
            [
                'attribute'=>'hakim_id',
                'value' => 'hakim.username'
            ],
            // [
            //     // 'attribute' => 'status',
            //     // 'value' => function($model){
            //     //     return DrugOrder::$state[$model->status];
            //     // },
            //     // 'filter'=>Html::activeDropDownList(
            //     //         $searchModel,
            //     //         'status',
            //     //         DrugOrder::$state,
            //     //         ['class'=>'form-control','prompt'=>'请选择']
            //     //     )
            // ],
            // 'created_time',
            // 'updated_time',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 220,'text-align'=>'center'],
            'template' => Helper::filterActionColumn('{son}{update}{check}{view}{delete}'),
            'buttons' => [
                'update'=> function($url,$model,$key){
                    // if($model->status == 168){
                        $button = Html::button('查看用药',['value' => Url::to(['/drug-order-detail/index','id'=>$model->id]), 'class' => 'btn btn-primary btn-sm ModalButton']);
                    // }elseif($model->status == 198){
                    //     $button = Html::button('已发放',[ 'class' => 'btn btn-primary btn-sm']);

                    // } else{
                    //     $button = '';
                    // }
                    return $button;
                },
                'view' => function($url,$model,$key){

                    // return $model->status == 100 
                    // ? Html::button('收款',['value' => Url::to(['view','id'=>$model->id]), 'class' => 'btn btn-warning btn-sm ModalButton']):
                    // Html::button('已收款',['class'=>'btn btn-sm btn-success'])
                    // ;
                },
                'check' => function($url,$model,$key){
                    if(!$model->check){
                        // return Html::button('确认发放',['value' => Url::to(['view','id'=>$model->id]), 'class' => 'btn btn-primary btn-sm ModalButton']);
                        return Html::a(Yii::t('common','未发'),$url,[
                        'class'=>'btn btn-danger btn-sm',
                        'data' => [
                            'confirm' => Yii::t('common','确认发放吗?'),
                            'method' => 'post',
                            ],
                        ]);
                    }else{
                        return Html::button('已经发放',['value' => Url::to(['#','id'=>$model->id]), 'class' => 'btn btn-warning btn-sm ModalButton']);
                    }
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

<?php \yii\bootstrap\Modal::begin([
    'header' => '<h4>订单详情</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo '<div id="modalContent"></div>';
\yii\bootstrap\Modal::end();
?>

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
