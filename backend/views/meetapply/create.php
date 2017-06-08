<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\meetapply */

$this->title =Yii::t('common', '会务发起');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会务列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meetapply-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
