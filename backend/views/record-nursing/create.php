<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RecordNursing */

$this->title =Yii::t('common', '创建护理');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','护理列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="record-nursing-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'nurse' => $nurse
    ]) ?>

</div>
<div class="clearfix"></div>
