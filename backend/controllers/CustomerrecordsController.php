<?php

namespace backend\controllers;

use Yii;
use common\models\CustomerRecords;
use backend\models\CustomerRecords as CustomerRecordsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\BillingOperation;
use common\models\User;

/**
 * CustomerrecordsController implements the CRUD actions for CustomerRecords model.
 */
class CustomerrecordsController extends Controller
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
     * Lists all CustomerRecords models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerRecordsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single CustomerRecords model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user_model = new User();
        $CustomerRecords_model = new CustomerRecords();
        $visited_id = $CustomerRecords_model::findOne($id)->visited_id;
        $service_id = $CustomerRecords_model::findOne($id)->service_id;
        $username = $user_model::findOne($visited_id)->username;

        $BillingOperation_model = new BillingOperation();
        $bid = $BillingOperation_model::find()->select('id')->where(['order_num' => $service_id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'user' => $username,
            'order_id' => $bid
        ]);
    }

    /**
     * Creates a new CustomerRecords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerRecords();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cate_id' => ''
            ]);
        }
    }

    /**
     * Updates an existing CustomerRecords model.
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
     * Deletes an existing CustomerRecords model.
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
        $model = new CustomerRecords();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }

    public function actionAjax(){
        if(yii::$app->request->isAjax){
            $num = yii::$app->request->post()['num'];
            $billing_model = new BillingOperation();
            $surgery_cost = $billing_model::find()->select('surgery_cost')->where(['order_num' => $num])->one()->surgery_cost;
            return $surgery_cost;
        }
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
        $model =new CustomerRecords();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the CustomerRecords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerRecords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerRecords::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
