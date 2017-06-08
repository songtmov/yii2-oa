<?php

namespace backend\controllers;

use Yii;
use common\models\CustomerProfiles;
use backend\models\CustomerProfiles as CustomerProfilesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\BillingOperation;
use common\models\Customer;
use common\models\UserModel;
use backend\models\Search;

/**
 * CustomerProfilesController implements the CRUD actions for CustomerProfiles model.
 */
class CustomerProfilesController extends Controller
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
     * Lists all CustomerProfiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerProfilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSearch()
    {
        $model = new Search();

        if(!empty($_GET['Search']['client_name'])){

                $client_name = $_GET['Search']['client_name'];
                $customer_model = new Customer();

                $customer_id = $customer_model::find()->where(['like','client_name',$client_name])->all();

                $CustomerProfiles_model =  new CustomerProfiles();

                $res = [];
                $num = 0;
                foreach ($customer_id as $key => $value) {

                    $res[$num] = $CustomerProfiles_model::find()->where(['customer_id'=>$value->id])->one();

                    $num++;

                }

                foreach ($res as $key => $value) {
                    if($value == null){
                        unset($res[$key]);
                    }
                }

                return $this->render('serach', [
                    'model' => $model,
                    'data' => $res,
                ]
            );
        }

        return $this->render('serach',[
            'model' => $model,
            'data'=> null
        ]);
    }

    public function actionJc(){
        if(yii::$app->request->isAjax && yii::$app->request->isPost){
            $client_name = yii::$app->request->Post()['title'];
            $customer_model = new Customer();
            $billing_operation_model = new BillingOperation();
            $id = $customer_model::find()->select('id')->where(['client_name'=>$client_name])->one()['id'];
            $billing_res = $billing_operation_model::find()->select(['order_num'])->where(['client_id' => $id])->all();
            $str  = '';
            foreach ($billing_res as $key => $value) {
                $str .= '<option value="'.$value['order_num'].'">'.$value['order_num'].'</option>';
            }
            if($str == ''){
                return 1;
            }
            return $str;
        }   
    }

    public function actionOrder(){
        if(yii::$app->request->isAjax && yii::$app->request->isPost){
            $order_num = yii::$app->request->Post()['now'];
            $billing_operation_model = new BillingOperation();
            $operation_time = $billing_operation_model::find()->select(['operation_time'])->where(['order_num'=>$order_num])->one()['operation_time'];
            $time_res = explode(' - ',$operation_time);
            $time_start = $time_res[0];
            $time = explode(' ',$time_start)[0];
            $time_end = $time_res[1];
            $end = ['time' => $time,'time_start'=>$time_start,'time_end'=>$time_end];
            return json_encode($end);
        }else{
            yii::$app->session->setFlash('error','非法操作！');
            return $this->goBack('/');
        }
    }

    /**
     * Displays a single CustomerProfiles model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $customer_model = new Customer();

        $client_name = $customer_model::find()->select(['client_name'])->where(['id' => $model->customer_id])->one()['client_name'];
        
        // p($model->customer_id);die;

        return $this->render('view', [
            'model' => $this->findModel($id),
            'name' => $client_name
        ]);
    }

    /**
     * Creates a new CustomerProfiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerProfiles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $res = $this-> common();
            return $this->render('create', [
                'model' => $model,
                'all' => $res
            ]);
        }
    }


    public function common(){
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
            $all = array_merge($hakim,$assistant,$nurse);

            $res = [];
            foreach ($all as $key => $value) {
                $res[$value->id] = $value['username'];
            }

            return $res;
    }
    /**
     * Updates an existing CustomerProfiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $customer_model = new Customer();
        $client_name = $customer_model::find()->select(['client_name'])->where(['id' => $model->customer_id])->one()['client_name'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $res = $this-> common();
            return $this->render('update', [
                'model' => $model,
                'all' => $res,
                'name' => $client_name,
            ]);
        }
    }

    /**
     * Deletes an existing CustomerProfiles model.
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
        $model = new CustomerProfiles();
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
        $model =new CustomerProfiles();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the CustomerProfiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerProfiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerProfiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
