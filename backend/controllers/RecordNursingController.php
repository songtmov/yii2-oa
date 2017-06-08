<?php

namespace backend\controllers;

use Yii;
use common\models\RecordNursing;
use common\models\UserModel;
use backend\models\RecordNursing as RecordNursingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Customer;
// use common\models\UserModel;
/**
 * RecordNursingController implements the CRUD actions for RecordNursing model.
 */
class RecordNursingController extends Controller
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
     * Lists all RecordNursing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordNursingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RecordNursing model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $res = $this->findModel($id);

        $customer_id = $res->customer_id;

        $customer = Customer::findOne($customer_id)->client_name;

        $nurse_id = $res->nurse_id;

        $nurse = UserModel::findOne($nurse_id)->username;
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'nurse' => $nurse,
            'customer' => $customer
        ]);

    }

    /**
     * Creates a new RecordNursing model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RecordNursing();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $nurse1 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',28]])->all();
            $nurse2 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',8]])->all();

            $nurse = array_merge($nurse1,$nurse2);
            // p($nurse);die;
            $new = [];
            foreach ($nurse as $key => $value) {
                $new[$value->id] = $value['username'];
            }
            return $this->render('create', [
                'model' => $model,
                'nurse' => $new
            ]);
        }
    }

    /**
     * Updates an existing RecordNursing model.
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
            $nurse1 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',28]])->all();
            $nurse2 = UserModel::find()->where(['and',['=','store_id',Yii::$app->user->identity->store_id],['=','position_id',8]])->all();
            $nurse = array_merge($nurse1,$nurse2);

            $name = Customer::findOne($model->customer_id)->client_name;

            $new = [];
            foreach ($nurse as $key => $value) {
                $new[$value->id] = $value['username'];
            }
            return $this->render('update', [
                'model' => $model,
                'nurse' => $new,
                'name' => $name
            ]);
        }
    }

    /**
     * Deletes an existing RecordNursing model.
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
        $model = new RecordNursing();
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
        $model =new RecordNursing();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the RecordNursing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RecordNursing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RecordNursing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
