<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfiles */

$this->title = Yii::t('common','更改档案: ') . $name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','档案列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="customer-profiles-update col-md-6 col-md-offset-2">
	
    <?= $this->render('_form', [
        'model' => $model,
        'all' => $all,
    ]) ?>

</div>
<div class="clearfix"></div>