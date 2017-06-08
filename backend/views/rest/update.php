<?php

use yii\helpers\Html;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\Rest */

$this->title = Yii::t('common','修改调休: ') . User::find()->where(['id' => $model->user_id])->one() -> username.'--'. date('Y-m-d h:i:s',$model->full_time);
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','调休列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="rest-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>