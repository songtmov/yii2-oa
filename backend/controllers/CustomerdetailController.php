<?php

namespace backend\controllers;

use Yii;
use common\models\CustomerDetail;
use backend\models\CustomerDetail as CustomerDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Customer;
// use common\models\CustomerDetail;
use common\models\Store;
use common\models\User;
use yii\console\Exception;

/**
 * CustomerdetailController implements the CRUD actions for CustomerDetail model.
 */
class CustomerdetailController extends Controller
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
     * Lists all CustomerDetail models.
     * @return mixed
     */
    public function actionIndex($id = '')
    {
        $searchModel = new CustomerDetailSearch();

        $post = Yii::$app->request->queryParams;
        $post['CustomerDetail']['customer_id'] = $id;

        $dataProvider = $searchModel->search($post);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerDetail model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id)
        ]);
    }

    /**
     * Creates a new CustomerDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerDetail();
        $customer_model = new Customer();
        $c_res = $customer_model::find()->where(['id' => $_GET['id']])->one();
        
        $store_id = $c_res -> store_id;
        $store_model = new Store();
        $store_name = $store_model::find()->where(['id' => $store_id])->one()->name;
        
        $c_res -> store_id = $store_name;

        $user_model = new User();

        $username = $user_model::find()->where(['id' => $c_res -> service_id])->one()->username;

        $c_res -> service_id = $username;
        //如果市场人员为空的处理
        if(empty($c_res -> sale_id)){
            $c_res -> sale_id = '--市场人员尚未确定--';
        }else{
            $username = $user_model::find()->where(['id' => $c_res -> sale_id])->one()->username;
            $c_res -> sale_id = $username;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // $sql = "UPDATE mly_customer SET detail='1' WHERE id=".$_GET['id'];
            // Yii::$app->db->createCommand($sql);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'res' => $c_res
            ]);
        }
    }

    /**
     * Updates an existing CustomerDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(yii::$app->request->isGet){
            $get = yii::$app->request->Get();
            if(empty($get['id']) || empty($get['customer_id'])){
                // throw new Exception("该路由已移动！");
                throw new Exception("非法操作，路由移除！");
            }
        }
        
        $model = new CustomerDetail();

        $customer_model = new Customer();
        $customer_id = $model::find()->select('customer_id')->where(['id'=>$id])->one()['customer_id'];
        
        $c_res = $customer_model::find()->where(['id' => $_GET['customer_id']])->one();

        $store_id = $c_res -> store_id;

        $store_model = new Store();
        $store_name = $store_model::find()->where(['id' => $store_id])->one()->name;

        $c_res -> store_id = $store_name;
        
        $user_model = new User();

        $username = $user_model::find()->where(['id' => $c_res -> service_id])->one()->username;

        $c_res -> service_id = $username;
        //如果市场人员为空的处理
        if(empty($c_res -> sale_id)){
            $c_res -> sale_id = '--市场人员尚未确定--';
        }else{
            $username = $user_model::find()->where(['id' => $c_res -> sale_id])->one()->username;
            $c_res -> sale_id = $username;
        }

        $model = $this->findModel($id);

        $customer_model = new Customer();

        $username = $customer_model::find()->where(['id' => $_GET['customer_id']])->one()->client_name;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'res' => $c_res,
                'username' => $username
            ]);
        }
    }

    /**
     * Deletes an existing CustomerDetail model.
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
        $model = new CustomerDetail();
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
        $model = new CustomerDetail();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * [actionSearch description]
     * @return [type] [description]
     */
    public function actionSearch(){
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $username = $post['username'];
            $customer_model = new Customer();
            $id = $customer_model::find()->select('id')->where(['client_name' => $username])->one()['id'];
            if($id == null){
                Yii::$app->getSession()->setFlash('error', '该用户不存在！');
                $id = '';
            }
            
            $searchModel = new CustomerDetailSearch();
            
            $post = Yii::$app->request->queryParams;
            $post['CustomerDetail']['customer_id'] = $id;

            $dataProvider = $searchModel->search($post);
            
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            
        }else{
            throw new Exception("非法操作！");
        }
    }

    /**
     * Finds the CustomerDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
