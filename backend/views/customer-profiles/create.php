<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfiles */

$this->title =Yii::t('common', '创建档案');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','档案列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-profiles-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'all'=>$all
    ]) ?>

</div>
<div class="clearfix"></div>
