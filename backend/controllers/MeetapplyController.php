<?php

namespace backend\controllers;

use Yii;
use common\models\meetapply;
use backend\models\meetapply as meetapplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MeetapplyController implements the CRUD actions for meetapply model.
 */
class MeetapplyController extends Controller
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
     * Lists all meetapply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new meetapplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'model' => meetapply::find()->where(['ma_delete' => '0'])->all(),
        ]);
    }

    /**
     * Displays a single meetapply model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        // $res = $this->findModel($id);
        
        return $this->render('view', [

            'model' => $this->findModel($id),
            
        ]);
    }

    /**
     * Creates a new meetapply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new meetapply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ma_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing meetapply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ma_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing meetapply model.
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
        $model = new meetapply();
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
        $model = new meetapply();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * [backfile 回收站列表]
     * @return [type] [description]
     */
    public function actionBackfile(){
        $searchModel = new meetapplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // p($searchModel);
        
        // p();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => meetapply::find()->where(['ma_delete' => '1'])->all()
        ]);
    }

    /**
     * [backfile 回收站彻删]
     * @return [type] [description]
     */
    public function actionBackfiled($id){
        
    }

    /**
     * [backfile 回收站还原]
     * @return [type] [description]
     */
    public function actionBackfileo($id){
       
    }

    /**
     * Finds the meetapply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return meetapply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = meetapply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
