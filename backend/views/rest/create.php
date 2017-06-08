<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Rest */

$this->title =Yii::t('common', '创建调休');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','调休列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
