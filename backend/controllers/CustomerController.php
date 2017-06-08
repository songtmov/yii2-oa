<?php

namespace backend\controllers;

use backend\models\Search;
use Yii;
use common\models\Customer;
use backend\models\Customer as CustomerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CStore;
use common\models\UserModel;
use common\models\SurgicalItems;
use common\models\BillingOperation;
/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $source_type_model = new \common\models\SourceType();
        $res = $source_type_model::find()->all();
        foreach ($res as $key => $value) {
            $new[$value->id] = $value->source_name; 
        }
        $cs_res = CStore::find()->all();
        foreach ($cs_res as $key => $value) {
            $csres[$value->id] = $value->store_name; 
        }
        $u_res = UserModel::find()->where(['department_id'=>12])->all();
        foreach ($u_res as $key => $value) {
            $ures[$value->username] = $value->username;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'new'=>$new,
            'csres'=>$csres,
            'ures'=>$ures
        ]);
    }
    
    /**
     * Displays a single Customer model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * [actionOpenlist description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionOpenlist($id){
        $model = new Customer();
        $billing_model = new BillingOperation();
        $data = $model::findOne($id);
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
        $surgical = SurgicalItems::find()->all();
        foreach ($surgical as $key => $value) {
            $new[$value->id] = $value->entry_name;
        }
        return $this->render('openlist',[
            'model' => $model,
            'data' => $data,
            'role' => $role,
            'surgical' => $new,
            'model' => $billing_model
        ]);
    }

    /**
     * [actionOpenlistpost description]
     * @return [type] [description]
     */
    public function actionOpenlistpost(){
        $id = yii::$app->request->Post()['id'];
        $post = yii::$app->request->post();
        $surgical = yii::$app->request->post()['surgical_id'];
        $price = 0;
        foreach ($surgical as $key => $value) {
            $price += SurgicalItems::find()->select('guide_price')->where(['id'=>$value])->one()['guide_price'];
        }
        $post['surgery_cost'] = $price;
        $post['counselor_id'] = yii::$app->user->id;
        $surgical_array = [];
        foreach ($surgical as $key => $value) {
            $surgical_array[$value] = SurgicalItems::find()->select('entry_name')->where(['id'=>$value])->one()['entry_name'];
        }
        $surgical = $surgical_array;
        $surgical_str = '';
        foreach ($surgical as $key => $value) {
            $surgical_str.= $value.',';
        }
        $post['surgical_id'] = $surgical_str;
        $hakim = $post['hakim_id'];
        $hakim_str = '';
        foreach ($hakim as $key => $value) {
            $hakim_str.= $value.',';
        }
        $post['hakim_id'] = $hakim_str;
        $nurse = $post['nurse_id'];
        $nurse_str = '';
        foreach ($nurse as $key => $value) {
            $nurse_str.= $value.',';
        }
        $post['nurse_id'] = $nurse_str;
        unset($post['_csrf']);
        $post['operation_time'] = $post['BillingOperation']['operation_time'];
        unset($post['BillingOperation']);
        $assistant = $post['assistant_id'];
        $assistant_str = '';
        foreach ($assistant as $key => $value) {
            $assistant_str.= $value.',';
        }
        $post['assistant_id'] = $assistant_str;
        $post['client_id'] = $post['id'];
        unset($post['id']);
        $post['store_id'] = CStore::findOne($id)->id;
        $post['sale_id'] = CStore::findOne($id)->business;
        date_default_timezone_set('PRC');
        $post['created_time'] = date('Y-m-d h:i:s',time());
        $post['order_num'] = date('Ymdhis',time()).rand(0,9);
        $old_post = $post;
        $post['BillingOperation'] = $post;
        unset($post['surgical_id']);
        unset($post['hakim_id']);
        unset($post['nurse_id']);
        unset($post['assistant_id']);
        unset($post['surgery_cost']);
        unset($post['counselor_id']);
        unset($post['operation_time']);
        unset($post['client_id']);
        unset($post['store_id']);
        unset($post['sale_id']);
        unset($post['created_time']);
        unset($post['order_num']);
        $billing_model = new \common\models\BillingOperation();
        if($billing_model->load($post)){
            $connection  = Yii::$app->db;
            $res = $connection->createCommand()->insert('mly_billing_operation', $old_post)->execute();
            if($res){
                $connection  = Yii::$app->db;
                $command = $connection->createCommand('SELECT id FROM mly_billing_operation ORDER BY id DESC LIMIT 1');
                $result = $command->queryAll();
                $result_id = $result[0]['id'];
                Yii::$app->session->setFlash('success','插入成功！');
                return $this->redirect("/billing/view/".$result_id);

            }else{
                Yii::$app->session->setFlash('error','数据插入失败！');
                return $this->redirect("openlist/".$id);
            }
        }else{
            Yii::$app->session->setFlash('error','输入错误！');
            return $this->redirect("openlist/".$id);
        }
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();
        $sale = \backend\models\UserModel::find()->where(['and',['store_id'=>Yii::$app->user->identity->store_id],['department_id'=>10]])->all();
        
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['Customer']['store_id'] = Yii::$app->user->identity->store_id;
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'sale' => $sale
            ]);
        }
        
        echo "对不起，您当前所输入的客户姓名已存在，请输入用户名-别名!";die;
    }
    /**
     * [actionPersonal description]
     * @return [type] [description]
     */
    public function actionPersonal()
    {
        $searchModel = new CustomerSearch();

        $post = Yii::$app->request->queryParams;

        $id = yii::$app->user->id;
        
        $username = \common\models\UserModel::findOne($id)->username;
        
        $post["Customer"]["service_id"] = $username;
        
        $dataProvider = $searchModel->search($post);
        $source_type_model = new \common\models\SourceType();
        $res = $source_type_model::find()->all();
        foreach ($res as $key => $value) {
            $new[$value->id] = $value->source_name; 
        }
        
        $cs_res = CStore::find()->all();
        
        foreach ($cs_res as $key => $value) {
            $csres[$value->id] = $value->store_name; 
        }
        
        $u_res = UserModel::find()->where(['department_id'=>12])->all();

        foreach ($u_res as $key => $value) {
            $ures[$value->username] = $value->username;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'new'=>$new,
            'csres'=>$csres,
            'ures'=>$ures
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $sale = \backend\models\UserModel::find()->where(['and',['store_id'=>Yii::$app->user->identity->store_id],['department_id'=>10]])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'sale' => $sale
            ]);
        }
    }
    /**
     * [actionSearch description]
     * @return [type] [description]
     */
    public function actionSearch()
    {
        $model = new Search();

        if(!empty($_GET['Search']['client_name'])){
            $select = $model->search(Yii::$app->request->queryParams);
            // p($select);die;
            $sql = $select->where;

            // p($sql);die;

            $Search = $sql['telephone'];

            // p($Search);die;

            $Search = $Search['Search']['client_name'];
            
            $Search = ['client_name'=>['Search'=>['client_name'=> $Search]]];

            $select->where = $Search;

            // p($select);die;

            $data = $select->one();

            // p($data);die;
            
            return $this->render(
            'search',
            [
                'model' => $model,
                'data' => $data,
            ]
            );
        }

        if(empty($data)){
            $data = null;
        }
        
        // p($data);die;
        
        return $this->render(
            'search',
            [
                'model' => $model,
                'data' => $data,
            ]
        );
    }

    /**
     * Deletes an existing Customer model.
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
        $model = new Customer();
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
        $model =new Customer();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
