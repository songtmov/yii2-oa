<?php

namespace backend\controllers;

use Yii;
use common\models\Notpunch;
use backend\models\Notpunch as NotpunchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotpunchController implements the CRUD actions for Notpunch model.
 */
class NotpunchController extends Controller
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
     * Lists all Notpunch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotpunchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single Notpunch model.
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
     * Creates a new Notpunch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // if(yii::$app->request->isPost){
        //     $post = yii::$app->request->post();
        //     p($post);die;
        // }

        $model = new Notpunch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Notpunch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Notpunch model.
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
        $model = new Notpunch();
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
        $model =new Notpunch();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Notpunch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Notpunch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notpunch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
