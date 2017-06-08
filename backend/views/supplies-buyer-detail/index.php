<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SuppliesBuyerDetail */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','Supplies Buyer Details');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if($status == 136):?>
    <?php $form = ActiveForm::begin([
        
        'action' => ['create','id'=>Yii::$app->request->get('id')],
        'method' => 'post',
    
    ]); ?>
<?php endif?>
<div class="supplies-buyer-detail-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <!--startprint1-->
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
        // 'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\CheckboxColumn',
            'name' => 'id'
            ],
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'supplie_id',
                'value'=>'supplie.name'
            ],
            [
                'attribute'=>'number',
                'format' => 'raw',
                'value' => function($model){
                   
                   return $model->order->status ==136? Html::input('text','Leechdom['.$model->supplie_id.']',$model->number,['class'=>'form-control']):$model->number;
                
                }
            ],
            [
                'attribute' => 'created_time',
                'value' => function($model){
                    return date('Y-m-d H:i:s',$model->created_time);
                }
            ],
        ],
    ]); ?>
    <!--endprint1-->
     <?php if (($models = $dataProvider->models) !== []): ?>
    <div class="batch">
        <?php if(Helper::checkRoute('create')):?>
            <?php if($status == 68){?>
            <?=  Html::a('前往采购', ['update','id'=>Yii::$app->request->get('id')], [
            "class" => "btn btn-success",
            ]) ?>
            <input id="btnPrint" class="btn btn-info " type="button" value="采购单打印" onclick=preview(1) /> 
        
            <?php }elseif ($status == 98) {?>
            <?=  Html::a('采购完成', ['update','id'=>Yii::$app->request->get('id')], [
                "class" => "btn btn-success",
            ]) ?>
            <?php }elseif($status == 136){?>
                
                <?=Html::button('确认入库',['type'=>'submit','class'=>'btn btn-success'])?>
            
            <?php }elseif($status == 200){?>

                <?=Html::button('订单已入库',['type'=>'button','class'=>'btn btn-success'])?>
                
            <?php }?> 
        <?php endif?>
    </div>
    <?php endif?>

</div>


<?php if($status == 136):?>
    <?php ActiveForm::end();?>
<?php endif?>

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

function preview(oper) { 
        
    if (oper < 10) {

        $(".page-body").hide();
        $("th a").attr("href","javascript:");
        $("tr>td:first-child").hide();
        $("tr>th:first-child").hide();
        bdhtml=window.document.body.innerHTML;//获取当前页的html代码 
        sprnstr="<!--startprint"+oper+"-->";//设置打印开始区域 
        eprnstr="<!--endprint"+oper+"-->";//设置打印结束区域 
        prnhtml=bdhtml.substring(bdhtml.indexOf(sprnstr)+18); //从开始代码向后取html 
        prnhtml=prnhtml.substring(0,prnhtml.indexOf(eprnstr));//从结束代码向前取html 
        window.document.body.innerHTML=prnhtml; 
        window.print(); 
        window.document.body.innerHTML=bdhtml;
        $(".page-body").show();
        $("tr>td:first-child").show();
        $("tr>th:first-child").show();
    } else { 
        window.print(); 
    } 
} 
');


?>
