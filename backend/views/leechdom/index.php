<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

// use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Leechdom */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Leechdoms');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leechdom-index">

<?= Html::tag('p', Html::encode('药品搜索')) ?>

<?= Html::beginForm(['index'], 'post', ['enctype' => 'multipart/form-data']) ?>

<?=Html::Input('hidden','_csrf',Yii::$app->request->csrfToken)?>

<?= Html::input('text', 'username', '', ['class' => 'form-control','id'=>'exampleInputEmail1']) ?><br>

<?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>

<?= Html::resetButton('重置', ['class' => 'btn btn-danger']) ?>

<?= Html::endForm() ?>

<?php  if(Helper::checkRoute('create')):?>
<p class="clearfix">
    <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','药品采购申请'), ['/drug-buyer-order/create'], ['class' => 'btn btn-success pull-right']) ?>
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
            'maxButtonCount' => 10, //  默认页码
        ],
        'rowOptions'=>function($model){
            if($model->stock < $model->stock_warning)
            {
                return ['class'=> 'danger'];
            }
        },
        'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\CheckboxColumn',
            'name' => 'id'
            ],
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute'=>'cate_id',
                'value' => 'cate.name'
            ],
            'number',
            'stock',
            // 'types',
            // 'standard',
            // 'guide_price',
            [
                'attribute'=>'status',
                'format'=>'html',
                'value' => function($model){
                    $status = '';
                    if($model->status == 0){
                        return Html::a('停售','javascript:',['class'=>'btn btn-danger btn-sm']);
                    }else{
                        if($model->stock < $model->stock_warning)
                        {
                            return Html::a('库存不足','javascript:',['class'=>'btn btn-warning btn-sm']);
                        }else{
                            return Html::a('正常','javascript:',['class'=>'btn btn-success btn-sm']);
                        }
                    }
                },
                'filter'=>Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [1=>'正常',0=>'停售'],
                    ['class'=>'form-control','prompt'=>'请选择']
                )
            ],
            // 'stock_warning',
            [
                'attribute'=>'store_id',
                'value' => 'store.name'
            ],
            [
                'attribute'=>'created_time',
                'value' => function ($model){
                    return date('Y-m-d H:i:s',$model->created_time);
                }
            ],
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
    <?php if (($models = $dataProvider->models) !== []): ?>

    <div class="batch">
        
        <!-- <?//=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?> -->
        
        <!-- <?//=  Html::a(Yii::t('common','Batch audit'), "javascript:void(0);", ["class" => "btn btn-success audit"]) ?> -->
        
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
');?>
