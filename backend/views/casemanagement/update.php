<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CaseManagement */

$this->title = Yii::t('common','修改病历: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Case Managements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="case-management-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>