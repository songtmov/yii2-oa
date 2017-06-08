<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserModel;

/* @var $this yii\web\View */
/* @var $model common\models\BillingOperation */

$this->title = $model->client->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Billing Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="billing-operation-view mt">
    
    <div class="col-md-7 col-md-offset-2">
        <table class="table table-striped table-bordered">
            <tr>
                <td colspan="4" style="text-align: center;">订单号<h1 style="color: red;"><?= $model->order_num;?></h1></td>
            </tr>
            <tr>
                <th width="15%">客户姓名</th>
                <td width="30%"><?= $model->client->client_name?></td>
                <th width="15%">手术项目</th>
                <td width="30%"><?= $model->surgical_id;?></td>
            </tr>
            <tr>
                <th width="15%">主🔪医师</th>
                <td width="30%"><?= $model->hakim_id;?></td>
                <th width="15%">医师助理</th>
                <td width="30%"><?= $model->assistant_id;?></td>
            </tr>
            <tr>
                <th width="15%">护士</th>
                <td width="30%"><?= $model->nurse_id;?></td>
                <th width="15%">咨询师</th>
                <td width="30%">
                    <?= UserModel::findOne($model->counselor_id)->username;?>
                </td>
            </tr>
            <tr>
                <th width="15%">手术费用</th>
                <td width="30%"><b class="red"><?= $model->surgery_cost;?></b></td>
                <th width="15%">手术时间</th>
                <td width="30%"><?= $model->operation_time;?></td>
            </tr>
            <tr>
                <th width="15%">状态</th>
                <td width="30%" colspan="3"><?= Html::button(\common\models\BillingOperation::$state[$model->status],['class'=>'btn btn-success'])?></td>
            </tr>
        </table>
        <p style="text-align: center">
            <?php 
                if($model->status == 100){
                    echo Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]);
                }
            ?>
        </p>
    </div>


</div>
