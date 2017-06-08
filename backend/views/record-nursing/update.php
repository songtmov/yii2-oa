<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RecordNursing */

$this->title = Yii::t('common','修改护理: ') . $name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','护理列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="record-nursing-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'nurse' => $nurse
    ]) ?>

</div>
<div class="clearfix"></div>