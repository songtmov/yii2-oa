<?php 
use yii\helpers\Html;
use common\models\Customer;
use common\models\Cstore;
/* @var $this yii\web\View */
/* @var $model common\models\CaseManagement */

$this->title =Yii::t('common', '病例查询');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','病历列表'), 'url' => ['casemanagement/index']];
$this->params['breadcrumbs'][] = $this->title;
$customer = new Customer();
$customer_res = $customer::findOne($res['customer_id']);
// $customer_res->cstore_id
// $customer_res = $customer::findOne($res['customer_id']);
$cstore = new Cstore();
$cstore_name = $cstore::find()->select('store_name')->where(['id'=>$customer_res->cstore_id])->one()['store_name'];
?>

<table class="table table-hover">
	<tr>
		<th>客户名</th>
		<th>下载病例</th>
		<th>备注信息</th>
		<th>提交时间</th>
		<th>所属美容院</th>
		<th>操作</th>
	</tr>
	<tr>
		<td><?=$customer_res->client_name?></td>
		<td><a href="<?='/'.$res->path?>">下载病例</a></td>
		<td><?=$res->nbackup?></td>
		<td><?=$res->submit_time?></td>
		<td><?=$cstore_name?></td>
		<td>
			<a href="/casemanagement/view/<?=$res->id?>">
				<button class="btn btn-success">详情</button>
			</a>
			<a href="/casemanagement/update/<?=$res->id?>">
				<button class="btn btn-warning">修改</button>
			</a>
			<a href="/casemanagement/delete/<?=$res->id?>">
				<button class="btn btn-danger">删除</button>
			</a>
		</td>
	</tr>
</table>