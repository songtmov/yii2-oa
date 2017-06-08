<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Supplies */

$this->title =Yii::t('common', 'Create Supplies');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>
<div class="clearfix"></div>
