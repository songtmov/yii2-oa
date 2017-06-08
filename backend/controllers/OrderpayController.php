<?php

namespace backend\controllers;

use Yii;
use common\models\OrderPay;
use backend\models\OrderPay as OrderPaySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Customer;
use common\models\DepositForm;
use common\models\BillingOperation;

/**
 * OrderpayController implements the CRUD actions for OrderPay model.
 */
class OrderpayController extends Controller
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
     * Lists all OrderPay models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderPaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderPay model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $billing_model = new BillingOperation();
        $order_model = new OrderPay();
        $billing_id = $order_model::findOne($id)->billing_id;
        $bid = $billing_model::find()->select('id')->where(['order_num' => $billing_id])->one();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'order_id' => $bid
        ]);
    }

    /**
     * Creates a new OrderPay model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(yii::$app->request->isAjax){

            $order_num = yii::$app->request->post()['num'];
            
            $depositform_model = new DepositForm();
            
            $orderpay_model = new OrderPay();
            
            $billing_model = new BillingOperation();

            $list_price = $billing_model::find()->select('surgery_cost')->where(['order_num' => $order_num])->one()->surgery_cost;

            // o_res 查询是否有定金
            $d_res = $depositform_model::find()->select('deposit')->where(['billing_id' => $order_num])->one();
            
            // 查询是否有余款交入
            $o_res = $orderpay_model::find()->select('sum_money')->where(['billing_id' => $order_num])->all();
            
            if($d_res == null){
                return $list_price;
            }else{
                if($o_res == null){
                    return $list_price - $d_res['deposit'];
                }
                $surplus = 0;
                foreach ($o_res as $k => $v) {
                   $surplus = $surplus + ($v -> sum_money);
                }
                return $list_price - $d_res['deposit'] - $surplus;
            }
        }
        $model = new OrderPay();

        $post = yii::$app->request->post();
        if(!isset($post['OrderPay']['billing_id'])){
            $customer_model = new Customer();
            $res = $customer_model::find()->select(['id','client_name'])->all();
            $new = [];
            $num = 0;
            foreach ($res as $key => $value) {
                $new[$num]['id'] = $value -> id;
                $new[$num]['client_name'] = $value -> client_name;
                $num++;
            }
            return $this->render('create', [
                'model' => $model,
                'region' => $new
            ]);
        }
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $order_num = yii::$app->request->post()['OrderPay']['billing_id'];
            $db = yii::$app->db;
            $res = $db->createCommand('UPDATE mly_billing_operation SET status=168 WHERE order_num='.$order_num)->query();
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            $customer_model = new Customer();
            $res = $customer_model::find()->select(['id','client_name'])->all();
            $new = [];
            $num = 0;
            foreach ($res as $key => $value) {
                $new[$num]['id'] = $value -> id;
                $new[$num]['client_name'] = $value -> client_name;
                $num++;
            }
            // p($new);die;
            
            return $this->render('create', [
                'model' => $model,
                'region' => $new
            ]);
        }
    }

    /**
     * Updates an existing OrderPay model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing OrderPay model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

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
        $model = new OrderPay();
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
        $model =new OrderPay();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the OrderPay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderPay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderPay::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
