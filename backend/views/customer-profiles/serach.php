<?php 
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use common\models\BillingOperation;
use common\models\CustomerProfiles;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfiles */

$this->title = '档案查询';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','档案列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '档案查询';
// p($data);die;
?>

<?php $this->registerCss('

    .help-block{

        margin:0;

       display:none

    }
    
');

?>

<div class="customer-search mt">

    <?php $form = ActiveForm::begin([

        'action' => ['search'],

        'method' => 'get',

    ]); ?>
	
    <div class="col-md-6 col-md-offset-3" style="padding: 0">

        <div class="input-group input-group-lg">
            
            <?= $form->field($model, 'client_name')->textInput(['placeholder'=>empty($_GET['Search']['client_name'])?'请输入客户名进行查询……':$_GET['Search']['client_name'],'class'=>'form-control input-lg'])->label(false) ?>
            
            <span class="input-group-btn">
                
                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-lg']) ?>
                
            </span>

        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="clearfix"></div>

 <div class="col-md-6 col-md-offset-3" style="margin-top: 30px;padding: 0;">

<?php if(isset($_GET['Search']['client_name'])):?>

    <?php if(count($data) == 0){?>
    
    <div style="margin-top: 20px">
	
        没有查找到客户档案 <?=Html::a('去添加',['/customer-profiles/create','client_name'=>$_GET['Search']['client_name']],['class'=>'btn btn-success btn-sm'])?>
	
    </div>
	
    <?php }else{?>
            
            <table class="table table-bordered">

                <thead>
                
                <tr>

                    <th>订单号</th>

                    <th>客户名</th>
		
                    <th>输液时间</th>

                    <th>创建时间</th>

                    <th>操作</th>

                </tr>

                </thead>

                <tbody>
                    
		<?php foreach ($data as $key => $value): ?>
                    
                    <tr>
		      
                        <td><?=$value['billing_id']?></td>
			
                        <td><?=Customer::findOne($value['customer_id'])->client_name;?></td>
                        
                        <td><?=date('Y-m-d',strtotime($value['transfusion_time']))?></td>
		
                        <td><?=date('Y-m-d',strtotime($value['create_time']))?></td>
			
                        <td>
                        	<a href="/customer-profiles/view/<?=
                        	CustomerProfiles::find()
                        	->select('id')
                        	->where(['billing_id' => $value['billing_id']])
                        	->one()['id'];
                        	?>
                        	">
                        	<button class="btn btn-success">查看手术档案</button></a>
                             <!-- <?php //p($value['id']);die; ?> -->
                                
                        	<a href="/record-nursing/create?billing_id=<?=$value['billing_id']?>&client_name=<?=$value['customer_id']?>&name=<?=$_GET['Search']['client_name']?>">
                                
                              <button class="btn btn-danger">增加一个护理记录</button>
                                
                              </a>
                                
                           <a href="/billing/view/<?=
                           BillingOperation::find()
                            ->select('id')
                            ->where(['order_num' => $value['billing_id']])
                            ->one()['id'];
                            ?>"><button class="btn btn-primary">查看订单详情</button></a>

                        	<!-- <button class="btn btn-danger">增加一个护理记录</button> -->
                        </td>
	
                    </tr>

		<?php endforeach ?>

                </tbody>

            </table>
            
            <!-- <?//= Html::a('增加一个新的档案',['/customer-profiles/create'],['class'=>'btn btn-success'])?> -->
	 
    <?php }?>

<?php endif?>

 </div>