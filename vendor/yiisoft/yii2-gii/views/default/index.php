<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $generators \yii\gii\Generator[] */
/* @var $content string */

$generators = Yii::$app->controller->module->generators;
$this->title = '欢迎使用GII工具';
?>
<div class="default-index">
    <div class="page-header">
        <h1>欢迎使用GII工具 <small>一个可以为你写代码的神奇工具</small></h1>
    </div>

    <p class="lead">开始使用下面的代码生成器：</p>

    <div class="row">
        <?php foreach ($generators as $id => $generator): ?>
        <div class="generator col-lg-4">
            <h3><?= Html::encode($generator->getName()) ?></h3>
            <p><?= $generator->getDescription() ?></p>
            <p><?= Html::a('开始使用 &raquo;', ['default/view', 'id' => $id], ['class' => 'btn btn-default']) ?></p>
        </div>
        <?php endforeach; ?>
    </div>

    <p><a class="btn btn-success" href="http://www.yiiframework.com/extensions/?tag=gii">更多工具 &gt;&gt;</a></p>

</div>
