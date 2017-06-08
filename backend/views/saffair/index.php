<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use yii\db\Query as DB;
use common\models\saffair;
use common\models\Region;
use common\models\Store;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\saffair */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','新增预约');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="saffair-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php  if(Helper::checkRoute('create')):?>
    <p class="clearfix">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('common','新增预约'), ['/saffair/create'], ['class' => 'btn btn-success pull-right']) ?>　
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
            // 'id',
            'customer',
            [
                'attribute' => 'province',
                'format'=>'html',
                'value' => function($model){
                    foreach ($model as $k => $v) {
                        $query = new DB();
                        $province = $model -> province;
                        $res = Region::find('name')->where(['id' => $province])->one()->name;
                        return $res;
                    }
                }
            ],
            [
                'attribute' => 'city',
                'format'=>'html',
                'value' => function($model){
                    foreach ($model as $k => $v) {
                        $query = new DB();
                        $city = $model -> city;
                        $res = Region::find('name')->where(['id' => $city])->one()->name;
                        return $res;
                    }
                }
            ],
            [
                'attribute' => 'hospital',
                'format'=>'html',
                'value' => function($model){
                    foreach ($model as $k => $v) {
                        $query = new DB();
                        $hospital = $model -> hospital;
                        $name = Store::find('name')->where(['id' => $hospital])->one()->name;
                        
                        return $name;
                    }
                }
            ],
            'appointment',
            [
                'attribute' => 'appointment_type',
                'format'=>'html',
                'value' => function($model){
                    if($model -> appointment_type == 1){
                        return '内部';
                    }else{
                        return '外部';
                    }
                }
            ],
            [
                'attribute' => 'doctor',
                'format'=>'html',
                'value' => function($model){
                    $doctor = $model -> doctor;
                    $res = User::find()->where(['id' => $doctor])->one()->username;
                    return $res;
                }
            ],
            'remark:ntext',
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
        <?= Html::a(Yii::t('common','查询今日预约'), ['/saffair/today','time' => date('Y-m-d',time())], ['class' => 'btn btn-danger pull-right']) ?>
    </div>

    <!-- <div class="batch">
        
        <?//=  Html::a(Yii::t('common','Batch delete'), "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>
        
        <?//=  Html::a(Yii::t('common','Batch audit'), "javascript:void(0);", ["class" => "btn btn-success audit"]) ?>
        
    </div> -->
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
