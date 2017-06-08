<?php

namespace backend\controllers;

use common\models\DrugOrderDetail;
use common\models\Leechdom;
use Yii;
use common\models\DrugOrder;
use backend\models\DrugOrder as DrugOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use common\models\BillingOperation;

/**
 * DrugOrderController implements the CRUD actions for DrugOrder model.
 */
class DrugOrderController extends Controller
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
     * Lists all DrugOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DrugOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single DrugOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->request->isAjax){
            throw new BadRequestHttpException("未知错误！");
        }
        $model = DrugOrder::find()->with([
            'client'=>function($query){
                $query->select('client_name');
            },
            'store'=>function($query){
                $query->select('name');
            },
            'hakim'=>function($query){
                $query->select('username');
            }
            ])->where(['id'=>$id])->one();
        return $this->renderAjax('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new DrugOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new DrugOrder();

        $modelsAddress = [new DrugOrderDetail()];

        // $model->bill_id = $_GET['id'];
        // $model->client_id = $billing['client_id'];
        // $model->order_number = 'MLYDD'.$this->random(4).Yii::$app->user->identity->id.time();
        // $model->amount = $amount;
        // $model->store_id = Yii::$app->user->identity->store_id;
        // $model->hakim_id = Yii::$app->user->identity->id;
        // $model->status = 100;
        // $model->created_time = time();
        
        $list = Leechdom::find()->where(['and',['status'=>1],['>','stock',0]])->all();

        $cate = \common\models\Category::find()->where(['and',['parent_id'=>1],['status'=>1]])->all();

        $billing = BillingOperation::findOne($id);

        if(!$billing){

            throw new BadRequestHttpException('该手术不存在，请不要乱填加！');
            
        }

        //p($_POST);die;
         // $post = Yii::$app->request->post();
         //    $post['DrugOrderDetail']['order_id'] = Yii::$app->user->identity->id;
         //    $post['DrugOrderDetail']['created_time'] = time();
         //    p($post);die;
        //     $post['DrugOrderDetail']['number'] = 100;
        //     $post['DrugOrderDetail']['price'] = $data['id'];
    p($model->save());die;
        if( $model->save()){
            p(1);die;
            // $data = Yii::$app->request->post();
           
            // $amount = 0;
            
            // foreach ($data['DrugOrderDetail'] as $value) {
                
            //     $amount += $value['number'] * $value['price'];
            
            // }

            // $transaction =  Yii::$app->db->beginTransaction();
            // try{
            //     $model->bill_id = $_GET['id'];
            //     $model->client_id = $billing['client_id'];
            //     $model->order_number = 'MLYDD'.$this->random(4).Yii::$app->user->identity->id.time();
            //     $model->amount = $amount;
            //     $model->store_id = Yii::$app->user->identity->store_id;
            //     $model->hakim_id = Yii::$app->user->identity->id;
            //     $model->status = 100;
            //     $model->created_time = time();
                    
            // if($model->save()){

            //         $orderId = $model->getPrimaryKey();
            //         $detail = [];
                    
            //         foreach ($data['DrugOrderDetail'] as $value) {
                    
            //             $detail[] = [

            //                 'leechdom_id' => $value['leechdom_id'],
            //                 'number' => $value['number'],
            //                 'price' => $value['price'],
            //                 'order_id' =>$orderId,
            //                 'time' => time()

            //             ];
            //             Leechdom::updateAllCounters(['stock'=>-$value['number']],['id'=>$value['leechdom_id']]);
            //         }

            //         $b = Yii::$app->db->createCommand()->batchInsert(DrugOrderDetail::tableName(),
                        
            //             ['leechdom_id', 'number', 'price', 'order_id', 'created_time'],
                        
            //             $detail
                    
            //         )->execute();

            //         $transaction->commit();
                    
            //         if($b !== 0){

            //             return $this->redirect(['/billing/success','format'=>'success']);

            //         }else{
            //             throw new BadRequestHttpException("详情信息插入错误，请联系技术部员工。");
            //         }

            //     }else{

            //         throw new BadRequestHttpException("订单信息插入失败，请联系技术部员工。");
                        
            //     }

            // }catch(\Express $e){

            //     //异常处理数据回滚
            //     $transaction->rollBack();
            //     //抛出异常
            //     throw new BadRequestHttpException('数据写入失败，请联系管理员！');

            // }
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list,
                'cate' => $cate,
                'modelsAddress' => (empty($modelsAddress)) ? [new DrugOrderDetail()] : $modelsAddress

            ]);
        }
    }


    public function actionCheck($id){
        $order_number = DrugOrder::findOne($id)->order_number;
        p($id);die;
    }

    /**
     * Updates an existing DrugOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            
            print_r(Yii::$app->request->post());
            
            $model->updateAll(['status'=>168],['id'=>$id]);
            
            return $this->redirect(['index']);
        
        } else {
            throw new BadRequestHttpException("未知错误！");
            
        }
    }
    public function actionDrugPrice()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $price = Leechdom::findOne($id)['guide_price'];
            return $price;
        }else{
            return false;
        }
    }
    /**
     * 检查药品的库存是否小于传递过来数量
     * [actionDrugNumber description]
     * @return [type] [description]
     */
    public function actionDrugNumber()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            // p($post['id']);die;
            //判断传递过来的药品ID和开单数量是否为空
            if(!$post['id'] || !$post['number']){
                return 400;
            }
            //根据传递过来的ID取出药品的实际库存
            
            $stock = Leechdom::findOne($post['id'])['stock'];
            
            //判断开单药品数量是否大于实际库存数量
            
            if($stock < $post['number']){
                return 402;
            }
        }else{
            return false;
        }
    }


    // public function actionGrant($id)
    // {
    //     if (!Yii::$app->request->isPost) {
    //         throw new BadRequestHttpException("未知错误！");
    //     }
    //     $model = DrugOrder::updateall(['status'=>198],['id'=>$id]);
    //     if ($model) {
    //         return $this->redirect(['index']);
    //     }else{
    //         throw new BadRequestHttpException("程序错误！请联系技术部！");
    //     }
    // }
    
    /**
     * Deletes an existing DrugOrder model.
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
        $model = new DrugOrder();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }

    /**
    * @param $id
    * @return \yii\web\Response
    */
    public function actionUpdateall()
    {
        if(!Yii::$app->request->isAjax && !Yii::$app->request->isPost){
            return '未知错误';
        }
        $id = implode(',',$_POST['id']);
        $model =new DrugOrder();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * 根据传递过来的分类ID取出该分类下的所有药品
     * [actionAjaxListShow description]
     * @return [type] [description]
     */
    public function actionAjaxListShow()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $children = Leechdom::find()->where(['and',['cate_id'=>$id],['status'=>1],['>','stock',0]])->all();
            $countChild = Leechdom::find()->where(['and',['cate_id'=>$id],['status'=>1],['>','stock',0]])->count();
            if($countChild == 0){
                return 400;
            }else{
                echo "<option>请选择药品……</option>";
                foreach ($children as $value) {
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
            }
        }
    }

    /***
     * 生成随机字符串
     * @param $length
     * @return null|string
     */
    public function random($length){
        $pattern = '1234567890';
        $key = null;
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 9)};    //生成php随机数
        }
        return $key;
    }

    /**
     * Finds the DrugOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DrugOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DrugOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
