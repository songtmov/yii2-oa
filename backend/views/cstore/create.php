<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Cstore */

$this->title =Yii::t('common', '新建店家');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','店家列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cstore-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>
