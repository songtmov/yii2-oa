<?php
use common\models\UserModel;
$this->title='手术安排';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Billing Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<table class="table table-bordered">
    <tr style="font-weight: bold;">
        <td>id</td>
        <td>顾客</td>
        <td>手术项目</td>
        <td>执刀医师</td>
        <td>医助</td>
        <td>护士</td>
        <td>手术费用</td>
        <td>咨询师</td>
        <td>销售员</td>
        <td>驻店师</td>
        <td>状态</td>
        <td>手术时间</td>
        <td>创建时间</td>
        <td>手术订单号</td>
        <td>手术订单号</td>
    </tr>
    <?php foreach ($data as $key => $value): ?>
        <tr class="active">
            <?php foreach ($value as $k => $v): ?>
                <td><?= $v?></td>
            <?php endforeach ?>
            <td>
                <button class="btn btn-success">药品开单</button>
                <a href="/drug-order/create/<?=$value['id']?>"><button class="btn btn-danger">耗材开单</button></a>
                <a href="/billing/view/<?=$value['id']?>"><button class="btn btn-warning">详情查看</button></a>
            </td> 
        </tr>
    <?php endforeach ?>
</table>