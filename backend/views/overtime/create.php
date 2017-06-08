<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Overtime */

$this->title =Yii::t('common', '创建加班');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','加班列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtime-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'res' => $res
    ]) ?>

</div>
<div class="clearfix"></div>
