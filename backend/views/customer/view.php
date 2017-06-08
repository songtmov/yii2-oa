<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Store;
use common\models\CStore;
use common\models\User;
use common\models\Customer;
use common\models\SourceType;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = $model->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

    <p>
        <?= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?php 
        $store_model = new Store();
        $cstore_model = new CStore();
        $user_model = new User();
        $customer_model = new Customer();
        $source_type_model = new SourceType();
        $model -> store_id = $store_model::findOne($model -> store_id)->name;
        if(empty($cstore_model::findOne($model -> cstore_id)->store_name)){
            $model -> cstore_id = '未填写美容院！';};
        if($model -> service_id){
            $model -> service_id = $user_model::findOne($model->service_id)->username;
        }
        $model -> source = $source_type_model::find()->select('source_name')->where(['id'=>$model->source])->one()['source_name'];
    ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'client_name',
            'telephone',
            'member_card',
            'age',
            [
                'attribute' => 'sex',
                'value' => $model->sex ? '男' : '女'
            ],
            'store_id',
            'source',
            'remark',
            'sale_id',
            'service_id',
            'cstore_id',
            'created_time:datetime',
            'updated_time:datetime',
        ],
    ]) ?>
</div>
