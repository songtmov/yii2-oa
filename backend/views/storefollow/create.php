<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\StoreFollow */

$this->title =Yii::t('common', '创建美容院跟进情况');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','美容院跟进列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-follow-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
