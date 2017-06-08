<?php

namespace backend\controllers;

use common\models\Customer;
use common\models\CustomerVisit;
use Yii;
use common\models\ReturnVisit;
use backend\models\ReturnVisit as ReturnVisitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReturnVisitController implements the CRUD actions for ReturnVisit model.
 */
class ReturnVisitController extends Controller
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
     * Lists all ReturnVisit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReturnVisitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single ReturnVisit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = ReturnVisit::find()->with([
            'customer'=>function($query){
                $query->select('client_name,telephone');
            },
            'user'=>function($query){
                $query->select('username');
            }
        ])->where(['visit_id'=>$id])->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new ReturnVisit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$uid)
    {

        $model = new ReturnVisit();
        $client = Customer::findOne($uid);
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['ReturnVisit']['visit_id']=$id;
            $post['ReturnVisit']['client_id']=$uid;
            $post['ReturnVisit']['re_id']=Yii::$app->user->identity->id;

            if ($model->load($post) && $model->save()) {
                CustomerVisit::updateAll(['status'=>1],['id'=>$id]);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }else {
            return $this->render('create', [
                'model' => $model,
                'client'=> $client
            ]);
        }
    }

    /**
     * Updates an existing ReturnVisit model.
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
     * Deletes an existing ReturnVisit model.
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
        $model = new ReturnVisit();
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
        $model =new ReturnVisit();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the ReturnVisit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReturnVisit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReturnVisit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
