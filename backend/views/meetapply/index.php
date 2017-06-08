<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use yii\db\Query as DB;
use common\models\User;
use common\models\Meetapply;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\meetapply */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','会务列表');
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->request->getUrl() == '/meetapply/index'){
    $model = Meetapply::find()->where(['ma_delete' => 0])->all();
}else{
    $model = Meetapply::find()->where(['ma_delete' => 1])->all();
}
// p($model);
?>

<div class="meetapply-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','　添加会务'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </p>
    <?php  endif ?>
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

            'ma_id',

            'ma_content:ntext',

            'ma_meetname',

            'ma_countpeople',
            [
                'attribute' => 'ma_department',
                'value' => function($model){
                    $idarray = explode(',',$model -> ma_department);
                    $query = new DB();
                    $res = $query -> select(['name']) -> from('mly_department') -> where(['id' => $idarray]) -> all();
                    $end = '';
                    foreach ($res as $k => $v) {$end.= ','.$v['name'];}
                    if($end){
                        return ltrim($end,',');
                    }else{
                        return $model -> ma_department;
                    }
                }
            ],
            'ma_starttime',
            'ma_endtime',
            'ma_speaker',
            // 'ma_createtime',
            ['attribute' => 'ma_createtime','value' => function($model){
                return date('Y-m-d h:i:s',$model -> ma_createtime);
            }],
            [
                'attribute'=>'ma_type',
                'value' => function($model){
                    if($model -> ma_type == 0){
                        return '内部会议';
                    }else{
                        return '外部会议';
                    }
                }
            ],
            // 'ma_loginstatus',
            // 'ma_applystatus',
            'ma_meetaddress',
            // 'ma_feedback:ntext',
            'ma_remark:ntext',
            // 'ma_see',
            // 'ma_uid',
            ['attribute' => 'ma_uid','value' => function($model){return User::findOne($model -> ma_uid)['username'];}],
            // 'ma_mid',
            // 'ma_new',
            // 'ma_delete',
            // 'ma_hint',
            [
            'class' => 'yii\grid\ActionColumn',
            'header' => Yii::t('common','operation'),
            'headerOptions'=>['width' => 185],
            'template' => Helper::filterActionColumn('{son}{update}{view}{delete}'),
            'buttons' => [
                    'update'=> function($url,$model,$key){
                        if(Yii::$app->request->getUrl() == '/meetapply/index'){
                            return Html::a(Yii::t('common','Update'),$url,['class'=>'btn btn-primary btn-sm']);
                        }else{
                            return Html::a(Yii::t('common','还原操作'),$url,['class'=>'btn btn-primary btn-sm']);
                        }
                    },
                    'view' => function($url,$model,$key){
                        if(Yii::$app->request->getUrl() == '/meetapply/index'){
                            return Html::a(Yii::t('common','View'),$url,['class'=>'btn btn-warning btn-sm']);
                        }else{
                            return Html::a(Yii::t('common','彻底删除'),$url,['class'=>'btn btn-danger btn-sm']);
                        }
                    },
                    'delete' => function($url,$model,$key){
                        if(Yii::$app->request->getUrl() == '/meetapply/index'){
                            return Html::a(Yii::t('common','Delete'),$url,[
                            'class'=>'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                                'method' => 'post',
                                ],
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
    <?php  if (($models = $dataProvider->models) !== []):?>
        
    <div class="batch">
        
        
        <?php 
            echo Html::a(Yii::t('common','彻底删除'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]);
            // echo Html::a(Yii::t('common','Batch audit'), "javascript:void(0);", ["class" => "btn btn-success audit"]) ; 
        ?>

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
