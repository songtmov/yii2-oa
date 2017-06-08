<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SurgicalOption */

$this->title =Yii::t('common', '创建手术方式');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','方式列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surgical-option-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
