<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReturnVisit */

$this->title = $model->customer->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Return Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$mode = [0=>'拜访',1=>'电话',2=>'通讯工具'];
?>
<div class="return-visit-view">

    <p>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <table class="table table-striped  table-bordered">
        <tr>
            <th>客户姓名</th>
            <td><?= $model->customer->client_name?></td>
            <th>客户电话</th>
            <td><?= $model->customer->telephone?></td>
        </tr>
        <tr>
            <th>回访形式</th>
            <td><?= $mode[$model->mode]?></td>
            <th>客户状态</th>
            <td>
                <?= $model->client_status == 0?'新拜访':'已合作' ?>
            </td>
        </tr>
        <tr>
            <th>是否满意</th>
            <td>
                <?= $model->is_satisfied==1?'满意':'不满意' ?>
            </td>
            <th>身体状况</th>
            <td>
                <?= $model->health == 1?'正常':'异常' ?>
            </td>
        </tr>
        <tr>
            <th>回访内容</th>
            <td colspan="3">
                <?= $model->visit_content?>
            </td>
        </tr>
        <tr>
            <th>客户意见</th>
            <td colspan="3">
                <?= $model->response?>
            </td>
        </tr>
        <tr>
            <th>回访人</th>
            <td>
                                <?= $model->user->username?>
            </td>
            <th>回访时间</th>
            <td>
                <?= date('Y年m月d日 H:i:s',time())?>
            </td>
        </tr>
    </table>
</div>
