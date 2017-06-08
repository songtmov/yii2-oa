<?php

use yii\helpers\Html;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Notpunch */

$this->title = Yii::t('common','未打卡修改: ') . User::find()->where(['id' => $model->user_id])->one()->username.'--'.$model->full_time;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Notpunches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="notpunch-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>