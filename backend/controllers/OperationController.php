<?php

namespace backend\controllers;

use Yii;

use common\models\BillingOperation;

use common\models\Customer;

use common\models\SurgicalItems;

use common\models\Store;

use common\models\Cstore;

use common\models\User;

use backend\models\Operation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OperationController implements the CRUD actions for BillingOperation model.
 */
class OperationController extends Controller
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
     * 个人绩效查询（手术表）
     * @return mixed
     */
    public function actionPersonal()
    {
        // phpinfo();die;
        $id = yii::$app->user->id;
        
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->Post();

            $start = strtotime($post['timestart']['year'].'-'.$post['timestart']['mouth'].'-'.$post['timestart']['day']);

            $end = strtotime($post['timeend']['year'].'-'.$post['timeend']['mouth'].'-'.$post['timeend']['day']);

            $res = Yii::$app->db->createCommand('SELECT * FROM mly_billing_operation WHERE created_time >'.$start.' AND created_time < '.$end.' AND sale_id='.$id)->queryAll();

            // 时间拼接
            
            $time = $start .'-'. $end;

            /**
             * [$k 遍历时的键值 -- 遍历]
             * @var [type]
             */

            // use common\models\BillingOperation;
            
            $customer_model = new Customer();

            // use common\models\Customer;

            $surgicalItems_model = new SurgicalItems();

            $user_model = new User();

            $store_model = new Store();

            // use common\models\User;

            $res = $this -> commonforeach($res);
            
            return $this -> render('search',[
                'res' => $res,
                'time' => $time,
                'title' => '个人业绩时间段查询:',
            ]);
        }

        $searchModel = new Operation();

        $post = Yii::$app->request->queryParams;

        $post['Operation']['sale_id'] = $id;

        $res = Yii::$app->db->createCommand('SELECT SUM(surgery_cost) AS num FROM mly_billing_operation WHERE sale_id='.$id)->queryOne()['num'];

        $dataProvider = $searchModel->search($post);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'num' => $res,
            'title' => '个人绩效查询',
        ]);
    }

    public function commonforeach($res){
        $customer_model = new Customer();

        $surgicalItems_model = new SurgicalItems();

        $user_model = new User();

        $store_model = new Store();
        foreach ($res as $k => $v) {
            $res[$k]['client_id'] = $customer_model::find()->select('client_name')->where(['id' => $v['client_id']])->one()['client_name'];

            $res[$k]['surgical_id'] = $surgicalItems_model::find()->select('entry_name')->where(['id' => $v['surgical_id']])->one()['entry_name'];

            $res[$k]['hakim_id'] = $user_model::find()->select('username')->where(['id' => $v['surgical_id']])->one()['username'];

            $res[$k]['assistant_id'] = $user_model::find()->select('username')->where(['id' => $v['assistant_id']])->one()['username'];

            $res[$k]['nurse_id'] = $user_model::find()->select('username')->where(['id' => $v['nurse_id']])->one()['username'];

            $res[$k]['counselor_id'] = $user_model::find()->select('username')->where(['id' => $v['counselor_id']])->one()['username'];

            $res[$k]['store_id'] = $store_model::find()->select('name')->where(['id' => $v['store_id']])->one()['name'];

            $res[$k]['sale_id'] = $user_model::find()->select('username')->where(['id' => $v['sale_id']])->one()['username'];
        }
        return $res;
    }

    /**
     * 医院绩效查询表（手术表）
     * @return mixed
     */
    
   /* public function actionHospital()
    {
        $user_model = new User();
        $searchModel = new Operation();
        $id = yii::$app->user->id;
        $store_id = $user_model::find()->select('store_id')->where(['id' => $id])->one()['store_id'];
        
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $start = strtotime($post['timestart']['year'].'-'.$post['timestart']['mouth'].'-'.$post['timestart']['day']);
            $end = strtotime($post['timeend']['year'].'-'.$post['timeend']['mouth'].'-'.$post['timeend']['day']);
            $time = $start .'-'. $end;
            $res = Yii::$app->db->createCommand('SELECT * FROM mly_billing_operation WHERE created_time >'.$start.' AND created_time < '.$end.' AND store_id='.$store_id)->queryAll();

            $res = $this -> commonforeach($res);
            return $this -> render(
                'search',[
                    'res' => $res,
                    'time' => $time,
                    'title' => '医院业绩时间段查询:',
                ]
            );
        }else{
            $post = Yii::$app->request->queryParams;
            $post['Operation']['store_id'] = $store_id;
            $res = Yii::$app->db->createCommand('SELECT SUM(surgery_cost) AS num FROM mly_billing_operation WHERE store_id='.$store_id)->queryOne()['num'];
            $dataProvider = $searchModel->search($post);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'num' => $res,
                'title' => '医院绩效查询',
            ]);
        }
    }*/

    /**
     * 店家绩效查询表（手术表）
     * @return mixed
     */
    public function actionAll()
    {
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $start = strtotime($post['timestart']['year'].'-'.$post['timestart']['mouth'].'-'.$post['timestart']['day']);

            $end = strtotime($post['timeend']['year'].'-'.$post['timeend']['mouth'].'-'.$post['timeend']['day']);

            // p([$start,$end]);die;

            $time = $start .'-'. $end;
            $res = Yii::$app->db->createCommand('SELECT * FROM mly_billing_operation WHERE created_time >'.$start.' AND created_time < '.$end)->queryAll();

            $res = $this -> commonforeach($res);
            // p($res);die;
            return $this -> render(
                'search',[
                    'res' => $res,
                    'time' => $time,
                    'title' => '总业绩时间段查询:',
                ]
            );
        }else{
            $post = Yii::$app->request->queryParams;
            $searchModel = new Operation();
            $res = Yii::$app->db->createCommand('SELECT SUM(surgery_cost) AS num FROM mly_billing_operation')->queryOne()['num'];
            $dataProvider = $searchModel->search($post);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'num' => $res,
                'title' => '总绩效查询',
            ]);
        }
    }

    public function actionStore()
    {
        $cstore_model = new Cstore();
        $cstore = $cstore_model::find()->select(['id','store_name'])->all();
        // p($cstore);die;
        return $this -> render(
            'store',[
                'res' => $cstore,
                'title' => '合作商选择'
            ]
        );
    }

    /**
     * 店家绩效查询表（手术表）
     * @return mixed
     */
    public function actionProportion()
    {
        return $this -> render('proportion',[
            'title' => '绩效比例查询'
        ]);
    }

    /**
     * Displays a single BillingOperation model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BillingOperation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BillingOperation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BillingOperation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id   
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * [actionCstore 三方客户查询]
     * @param  [type] $id [商家的id]
     * @return [type]     [三方客户信息]
     */
    public function actionCstore($id){
        $c = yii::$app->request->get()['c'];

        //查询这家美容院下面的顾客id
        $customer_model = new Customer();
        $customer_id = $customer_model::find()->select('id')->where(['cstore_id' => $id])->all();
        $new_customer = [];
        foreach ($customer_id as $key => $value) {
            $new_customer[] = $value->id;
        }

        //查询这些顾客所有的订单
        $operation_model = new BillingOperation();

        $operation_res = $operation_model::find()->where(['client_id' => $new_customer])->all();
        $time = '0-0';

        $res = $this -> commonforeach($operation_res);

        return $this->render('search', [
            'res' => $res,
            'time' => $time,
            'c' => $c,
            'title' => '业绩查询',
        ]);
        
    }

    /**
     * Deletes an existing BillingOperation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
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
        $model =new BillingOperation();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the BillingOperation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
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
