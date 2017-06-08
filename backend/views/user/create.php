<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title =Yii::t('common', 'Create User Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','User Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
