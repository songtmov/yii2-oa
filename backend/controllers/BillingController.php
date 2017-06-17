<?php

namespace backend\controllers;

use backend\models\Arrange;
use backend\models\Search;

use common\models\SurgicalItems;
use common\models\UserModel;
use common\models\Customer;
use common\models\Store;

use rmrevin\yii\fontawesome\AssetBundle;

use Yii;
use common\models\BillingOperation;
use backend\models\BillingOperation as BillingOperationSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SuppliesBound;
use common\models\Supplies;
use common\models\SupplieOrder;
use common\models\SupplieOrderDetail;
use Sky\Demo\Hello;

/**
 * BillingController implements the CRUD actions for BillingOperation model.
 */
class BillingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BillingOperation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $new = new Hello();
        // $res = yii::$app->response;
        // $res->statusCode = '404';
        // $res->headers->add('pargma','no-cache');

        // $res->headers->add('location','http://www.baidu.com');
        // $this->redirect('http://www.baidu.com',302);
        // $res->headers->add('Content-Disposition','attachment;filename="a.html"');
        // $res->sendFile('./robots.txt');
        // $session = yii::$app->session;
        // $session->close();
        // $session->open();
        // if($session -> isActive){
        //     echo '1';die;
        // }
        // $session->set('k','v');
        
        $searchModel = new BillingOperationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDumpExcel(){
        $objectPHPExcel = new \PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        $page_size = 52;
        $res = BillingOperation::find()->all();
        $data = $this -> make($res);
        $count = BillingOperation::find()->count();

        $page_count = (int)($count/$page_size) + 1;
        $current_page = 0;
        $n = 0;
        foreach ($data as $key)
        {
            if ($n % $page_size === 0 )
            {
                $current_page = $current_page +1;
                
                //报表头的输出
                $objectPHPExcel->getActiveSheet()->mergeCells('B1:O1');
                $objectPHPExcel->getActiveSheet()->setCellValue('B1','手术订单表');
                
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','手术订单表');
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','手术订单表');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
                    ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日"));
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('O2','第'.$current_page.'/'.$page_count.'页');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('G2')
                    ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
                //表格头的输出
                $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B3','id');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C3','客户名');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D3','项目');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E3','医师');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F3','助理');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G3','护士');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H3','手术费用');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8); 
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I3','咨询师');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('J3','所属门店');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('K3','销售人员');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('L3','状态');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('M3','手术开始时间');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('N3','创建时间');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('O3','订单号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(8);

                //设置居中
                $objectPHPExcel->getActiveSheet()->getStyle('B3:G3')
                    ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                
                //设置边框
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getLeft()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getRight()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getVertical()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')
                    ->getBorders()->getVertical()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                
                //设置颜色a 
                $objectPHPExcel->getActiveSheet()->getStyle('B3:O3')->getFill()
                    ->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF66CCCC');
            }
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+4) ,$key->id);
            $objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+4) ,$key->client_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+4) ,$key->surgical_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+4) ,$key->hakim_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('F'.($n+4) ,$key->assistant_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('G'.($n+4) ,$key->nurse_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('H'.($n+4) ,$key->surgery_cost);
            $objectPHPExcel->getActiveSheet()->setCellValue('I'.($n+4) ,$key->counselor_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('J'.($n+4) ,$key->store_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('K'.($n+4) ,$key->sale_id);
            $objectPHPExcel->getActiveSheet()->setCellValue('L'.($n+4) ,$key->status);
            $objectPHPExcel->getActiveSheet()->setCellValue('M'.($n+4) ,$key->operation_time);
            $objectPHPExcel->getActiveSheet()->setCellValue('N'.($n+4) ,$key->created_time);
            $objectPHPExcel->getActiveSheet()->setCellValue('O'.($n+4) ,$key->order_num);

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':O'.$currentRowNum )
                    ->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':O'.$currentRowNum )
                    ->getBorders()->getLeft()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':O'.$currentRowNum )
                    ->getBorders()->getRight()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':O'.$currentRowNum )
                    ->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':O'.$currentRowNum )
                    ->getBorders()->getVertical()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $n = $n + 1;
        }
        
        //设置分页显示
        $objectPHPExcel->getActiveSheet()->setBreak('I55',\PHPExcel_Worksheet::BREAK_ROW );
        $objectPHPExcel->getActiveSheet()->setBreak('I10',\PHPExcel_Worksheet::BREAK_COLUMN );
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);
        
        ob_end_clean();
        ob_start();
        
        // header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'TMOV订单表-'.date("Y年m月j日").'.xls"');
        $objWriter = \PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
        $objWriter->save('php://output');
    }
    
    private function make($obj = null){
        foreach ($obj as $key => $value) {
            foreach ($value as $k => $v) {
                if($k == 'client_id'){
                    $obj[$key]->$k = Customer::find()->select('client_name')->where(['id' => $v])->one()['client_name'];
                }else if( $k == 'hakim_id' || $k == 'assistant_id' || $k == 'nurse_id' || $k == 'counselor_id' || $k == 'sale_id'){
                    $obj[$key]->$k = UserModel::find()->select('username')->where(['id' => $v])->one()['username'];
                }else if($k == 'status'){
                    switch ($v) {
                        case 100:
                            $obj[$key]->$k = '等待付款';
                            break;
                        case 168:
                            $obj[$key]->$k = '等待手术';
                            break;
                        default:
                            $obj[$key]->$k = '手术完成';
                            break;
                    }
                }else if($k == 'created_time'){
                    if(strlen(intval($v)) == 10){
                        $obj[$key]->$k = date('Y-m-d h:i:s',intval($v));
                    }
                }else if($k == 'surgical_id'){
                    $obj[$key]->$k = SurgicalItems::find()->select('entry_name')->where(['id' => $v])->one()['entry_name'];
                }else if($k == 'store_id'){
                    $obj[$key]->$k = Store::find()->select('name')->where(['id' => $v])->one()['name'];
                }else{
                    $obj[$key]->$k = $v;
                }
            }
        }
         return $obj;
    }
    
    public function actionPersonal()
    {
        $searchModel = new BillingOperationSearch();
        $user_id = yii::$app->user->id;
        $post = Yii::$app->request->queryParams;
        $post['BillingOperation']['counselor_id'] = $user_id;
        $dataProvider = $searchModel->search($post);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single BillingOperation model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = BillingOperation::find()->with(['client','surgical','hakim','assistant','nurse','counselor'])->where(['id'=>$id])->one();

        if($model==null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

    /**
     * Creates a new BillingOperation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BillingOperation();
        $query = new Search();
        $select = $query->search(Yii::$app->request->queryParams);
        $data = $select->one();
        $list = $model->getOption();
        
        $hakim1 = UserModel::find()->where([
            'and'
            ,['=','store_id',Yii::$app->user->identity->store_id]
            ,['=','position_id',6]
            ])->all();

        $hakim2 = UserModel::find()->where([
            'and'
            ,['=','store_id',Yii::$app->user->identity->store_id]
            ,['=','position_id',38]
            ])->all();
        
        $hakim = array_merge($hakim1,$hakim2);

        $assistant = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',7]])->all();
        
        $nurse1 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',28]])->all();
        $nurse2 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',8]])->all();
        
        $nurse = array_merge($nurse1,$nurse2);

        $role = [
            'hakim'=>$hakim,
            'assistant'=>$assistant,
            'nurse' => $nurse
        ];
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['BillingOperation']['counselor_id'] = Yii::$app->user->identity->id;
            $post['BillingOperation']['store_id'] = Yii::$app->user->identity->store_id;
            $post['BillingOperation']['status'] = 100;
            $post['BillingOperation']['client_id'] = $data['id'];
            $post['BillingOperation']['sale_id'] = $data['sale_id'];
            // 查出手术项目对应所需要的耗材有哪些
            $bound = SuppliesBound::find()->select('supplie_id,number')->asArray()->where(['operation_id'=>$post['BillingOperation']['surgical_id']])->all();

            $transaction = Yii::$app->db->beginTransaction();
            try{
                if ($model->load($post)) {
                    $model->save();
                    //获取新增的手术单的ID
                    $billingId = $model->getPrimaryKey();
                    
                    //新增该手术单所需要的耗材的订单
                    $supplieOrder = new SupplieOrder();
                    $supplieOrder->bill_id = $billingId;
                    $supplieOrder->client_id = $data['id'];
                    $supplieOrder->order_number = 'MLY'.Yii::$app->user->identity->id.rand(1000,9999).time();
                    $supplieOrder->store_id = Yii::$app->user->identity->store_id;
                    $supplieOrder->hakim_id = Yii::$app->user->identity->id;
                    $supplieOrder->status = $data['id'];
                    $supplieOrder->created_time = time();
                    
                    if($supplieOrder->save()){
                        //获取到刚刚添加的耗材订单的id
                        $supplieOrderId = $supplieOrder->getPrimaryKey();
                        
                        //判断该手术项目下有没有绑定耗材
                        if($bound){
                            //循环获取手术项目所对应的耗材,并且更改耗材库存，组合数据 *该数据是在手术项目管理中详情页面添加的，
                            $supplieOrderDetail = [];
                            foreach ($bound as $key => $value) {
                                $supplieOrderDetail[] = [
                                    'supplie_id' => $value['supplie_id'],
                                    'number' => $value['number'],
                                    'order_id' => $supplieOrderId,
                                    'created_time' => time()
                                ];
                                Supplies::updateAllCounters(['stock'=>-$value['number']],['id'=>$value['supplie_id']]);
                            }

                            //批量插入到订单详情表
                            $createDetail = Yii::$app->db->createCommand()->batchInsert(SupplieOrderDetail::tableName(),
                        
                                ['supplie_id', 'number', 'order_id', 'created_time'],
                        
                                $supplieOrderDetail
                    
                            )->execute();
                            //如果插入失败，抛出异常
                            if($createDetail == 0){

                                throw new BadRequestHttpException("订单详情插入失败");
                            } 
                        }
                    }

                }else{
                    throw new BadRequestHttpException('数据添加失败！');
                }

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            
            }catch(\Exception $e){
                $transaction->rollBack();
                throw new BadRequestHttpException("数据添加失败！");
                
            }
            
        }else {
            return $this->render('create', [
                'model'=> $model,
                'data' => $data,
                'query'=> $query,
                'list' => $list,
                'role' => $role
            ]);
        }
    }

    public function actionAjaxPrice()
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post('id');
            $price = SurgicalItems::findOne($post)['guide_price'];
            return $price;
        }
        return false;
    }
    
    public function actionArrangeOperation()
    {
        $username = UserModel::find()->select('username')->where(['id' => yii::$app->user->id])->one()['username'];
        $res = BillingOperation::find()->select(['assistant_id','id'])->all();
        $new_res = [];
        foreach ($res as $key => $value) {
            if(in_array($username,explode(',',$value->assistant_id))){
                $new_res[] = $value->id;
            }
        }
        $model = new UserModel();
        $new_res = BillingOperation::find()->where(['id' => $new_res])->all();
        return $this->render('arrange-operation', [
            'data' => $new_res,
            'model' => $model
        ]);
    }

    /***
     * 现场咨询师搜索用户信息功能
     * @return string
     */
    public function actionSearch(){
        $model = new BillingOperation();
        $query = new Search();
        $select = $query->search(Yii::$app->request->queryParams);
        $data = $select->one();
        return $this->render(
            'search',
            [
                'model'=>$model,
                'data'=>$data,
                'query'=>$query
            ]);
    }

    /**
     * Updates an existing BillingOperation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->findModel($id)->updateAll(['status'=>168],['id'=>$id]);
        SupplieOrder::updateAll(['status'=>20],['bill_id'=>$id]);
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Deletes an existing BillingOperation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    * @param $id
    * @return \yii\web\Response
    */

    public function actionDelall()
    {
        if(!Yii::$app->request->isAjax && !Yii::$app->request->isPost){
            return '未知错误';
        }
        $id = implode(',',$_POST['id']);
        $model = new BillingOperation();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }

    public function actionRecord($id)
    {
        $model = BillingOperation::find()->with(['client','surgical','hakim','assistant','nurse','counselor'])->where(['and',['client_id'=>$id],['store_id'=>Yii::$app->user->identity->store_id]])->all();
        if(!$model){
            return '暂无手术记录！';
        }
        return $this->renderAjax('record',['model'=>$model]);
    }

    /**
    * 批量修改功能，这只是一个模型，你可以向里面添加你想要的内容
    * @param $id
    * @return \yii\web\Response
    */
    public function actionUpdateall()
    {
        if(!Yii::$app->request->isAjax && !Yii::$app->request->isPost){
            return '未知错误';
        }
        $id = implode(',',$_POST['id']);
        $model =new BillingOperation();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the BillingOperation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BillingOperation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillingOperation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
