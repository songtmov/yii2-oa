<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RecoverService */

$this->title =Yii::t('common', '创建顾客术后调查');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','顾客术后调查列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recover-service-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
