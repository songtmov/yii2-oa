<?php

use yii\helpers\Html;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\Overtime */
$usermodel = new User();
$this->title = Yii::t('common','修改加班: 　') . $usermodel -> find() -> where(['id' => $model->user_id]) -> one() -> username .'在'. date('Y-m-d h:i:s',$model -> fill_time).'　的加班事宜';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Overtimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="overtime-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'res' => $res
    ]) ?>

</div>

<div class="clearfix"></div>