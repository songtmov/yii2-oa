<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = Yii::t('common','修改备注');
	$this->params['breadcrumbs'][] = $this->title;
?>

<form action="/casemanagement/remark" method="post">
	<h1>　</h1>
	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	<?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">备注</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', 'nbackup', $model->nbackup, ['class' => 'form-control']);
        echo '</div></div>';
    ?>
    <input type="hidden" name="id" value="<?=$model->id?>">
	<button class="btn btn-success" style="margin-left: 50%;margin-top:5%;">确定更改</button>
	<button class="btn btn-danger" style="margin-top:5%;" type="reset">重置</button>
</form>