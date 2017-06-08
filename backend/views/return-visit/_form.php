<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ReturnVisit */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('
    .form-group {
        margin-bottom:0
    }
    td label{
        margin-right:10px
    }
');
?>

<div class="return-visit-form mt">

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-10 col-xs-9'>{input}</div>
                            <div class='col-xs-10 col-xs-offset-2'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]

    ]); ?>
    <table class="table table-striped  table-bordered">
        <tr>
            <th>客户姓名</th>
            <td><?= $client->client_name?></td>
            <th>客户电话</th>
            <td><?= $client->telephone?></td>
        </tr>
        <tr>
            <th>回访形式</th>
            <td><?= $form->field($model, 'mode')->radioList([0=>'拜访',1=>'电话',2=>'通讯工具'])->label(false) ?></td>
            <th>客户状态</th>
            <td>
                <?= $form->field($model, 'client_status')->radioList([0=>'新拜访',1=>'已合作'])->label(false) ?>
            </td>
        </tr>
        <tr>
            <th>是否满意</th>
            <td>
                <?= $form->field($model, 'is_satisfied')->radioList([1=>'满意',0=>'不满意'])->label(false) ?>
            </td>
            <th>身体状况</th>
            <td>
                <?= $form->field($model, 'health')->radioList([0=>'健康',1=>'否'])->label(false) ?>
            </td>
        </tr>
        <tr>
            <th>回访内容</th>
            <td colspan="3">
                <?= $form->field($model, 'visit_content')->textarea(['rows' => 8])->label(false)?>
            </td>
        </tr>
        <tr>
            <th>客户意见</th>
            <td colspan="3">
                <?= $form->field($model, 'response')->textarea(['rows' => 8])->label(false)?>
            </td>
        </tr>
        <tr>
            <th>回访人</th>
            <td>
                <?= Yii::$app->user->identity->username?>
            </td>
            <th>回访时间</th>
            <td>
                <?= date('Y年m月d日 H:i:s',time())?>
            </td>
        </tr>
    </table>

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
