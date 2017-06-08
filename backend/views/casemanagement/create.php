<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CaseManagement */

$this->title =Yii::t('common', '创建病历');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','病历列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="case-management-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
