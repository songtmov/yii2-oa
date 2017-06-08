<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Test */

$this->title = Yii::t('common','修改: ') . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','用户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="test-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>