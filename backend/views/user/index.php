<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','User Models');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCss('
    .list-group-item{
        text-align: center
    }
    .list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus {
        z-index: 2;
        color: #fff;
        background-color: #00a65a;
        border-color: #008d4c;
    }
    .col-md-2 .list-group>a.list-group-item{
        width:32%;
        display: inline-block;
    } 
    @media (min-width:998px){
        .col-md-2 .list-group>a.list-group-item{
            width: 100%;
            display: block;
    }
}
');
?>

<div class="col-md-2">
    <div class="list-group" style="margin-top:63px;">
        <?= Html::a('全部',['index'],['class'=>isset($_GET['id'])?'list-group-item':'list-group-item active'])?>
        <?php foreach($department as $value):?>
            <?= Html::a($value->name,['index','id'=>$value->id],['class'=>isset($_GET['id'])&&$_GET['id']==$value->id?'list-group-item active':'list-group-item'])?>

        <?php endforeach?>

    </div>
</div>
<div class="user-model-index col-md-10">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','Create User Model'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
    <?php endif?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['id' => 'grid','class'=>'table-responsive'],
        'filterSelector' => "select[name='".$dataProvider->getPagination()->pageSizeParam."'],input[name='".$dataProvider->getPagination()->pageParam."']",
        'pager' => [
        'class' => \liyunfang\pager\LinkPager::className(),
        'template' => '<div class="page-body">{pageButtons} <p class="pageSize">{customPage} {pageSize}</p></div>', //分页栏布局
        'pageSizeList' => [10, 20, 30, 50,100], //页大小下拉框值
        'customPageWidth' => 50,            //自定义跳转文本框宽度
        'hideOnSinglePage' => false,        
        //当页码小于2页的时候是否显示分页，true不显示，false显示
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
            'username',
            'email:email',
            'telphone',
            [
                'attribute' => 'store_id',
                'value' => 'store.name'

            ],
            [
                'attribute' => 'department_id',
                'value' => 'department.name'

            ],
            [
                'attribute' => 'position_id',
                'value' => 'position.name'

            ],
            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>function($model){
                    return $model->status == 10?
                        Html::a('正常','javascript:',['class'=>'btn btn-success btn-sm'])
                        :Html::a('禁用','javascript:',['class'=>'btn btn-danger btn-sm']);
                }
            ],
            [
                'attribute'=>'login_time',
                'value'=>function($model){
                    return date('Y-m-d H:i:s',$model->login_time);
                }
            ],
             'login_ip',
            // 'created_at',
            // 'updated_at',
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

        <?=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>

        <?=  Html::a(Yii::t('common','Batch audit'), "javascript:void(0);", ["class" => "btn btn-success audit"]) ?>

    </div>
    <?php endif?>

</div>

<!-- <?php 
    // $columns = [
    // 'username',
    // 'email:email',
    // 'telphone',
    // [
    //     'attribute' => 'store_id',
    //     'value' => 'store.name'

    // ],
    // [
    //     'attribute' => 'department_id',
    //     'value' => 'department.name'

    // ],
    // [
    //     'attribute' => 'position_id',
    //     'value' => 'position.name'

    // ],
    // [
    //     'attribute'=>'status',
    //     'format'=>'html',
    //     'value'=>function($model){
    //         return $model->status == 10?
    //             Html::a('正常','javascript:',['class'=>'btn btn-success btn-sm'])
    //             :Html::a('禁用','javascript:',['class'=>'btn btn-danger btn-sm']);
    //     }
    // ],
    // [
    //     'attribute'=>'login_time',
    //     'value'=>function($model){
    //         return date('Y-m-d H:i:s',$model->login_time);
    //     }
    // ],
    //  'login_ip',
    // 'created_at',
    // 'updated_at',
    // ];
?> -->

<!-- <?
// = GridView::widget([
//     'dataProvider' => $dataProvider,
//     'filterModel' => $searchModel,
//     'columns' => $columns,
//     'containerOptions' => ['style'=>'overflow:auto'], 
//     // only set when $responsive = false;
//     'beforeHeader'=>[
//         [
//             'columns'=>[
//                 ['content'=>'updated_at', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
//                 ['content'=>'created_at', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
//                 ['content'=>'login_ip', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
//             ],
//             'options'=>['class'=>'skip-export'] // remove this row from export
//         ]
//     ],
//     'toolbar' => [
//         ['content'=>
//             Html::button('1', ['type'=>'button', 'title'=>Yii::t('common', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//             Html::a('2', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('common', 'Reset Grid')])
//         ],
//         '{export}',
//         '{toggleData}'
//     ],
//     'pjax' => true,
//     'bordered' => true,
//     'striped' => false,
//     'condensed' => false,
//     'responsive' => true,
//     'hover' => true,
//     'floatHeader' => true,
//     'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
//     'showPageSummary' => true,
//     'panel' => [
//         'type' => GridView::TYPE_PRIMARY,
//     ],
// ]);
?> -->

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
