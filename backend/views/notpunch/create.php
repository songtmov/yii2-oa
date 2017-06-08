<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Notpunch */

$this->title =Yii::t('common', '创建未打卡');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','未打卡列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notpunch-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
