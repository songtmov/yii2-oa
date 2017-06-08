<?php

namespace backend\controllers;

use Yii;
use common\models\Evection;
use backend\models\Evection as EvectionSearch;
use yii\web\Controller;
use common\models\Region;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EvectionController implements the CRUD actions for Evection model.
 */
class EvectionController extends Controller
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
     * Lists all Evection models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EvectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * [actions description]
     * @return [type] [description]
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    "imagePathFormat" => "/uploads/image/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
                ],
            ]
        ];
    }

    /**
     * Displays a single Evection model.
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
     * Creates a new Evection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Evection();
        $region = Region::find()->where(['parent_id' => 1])->all();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['Evection']['user_id'] = Yii::$app->user->identity->id;
            $post['Evection']['store_id']=Yii::$app->user->identity->id;
            
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } 
        }else {
            return $this->render('create', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * Updates an existing Evection model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Deletes an existing Evection model.
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
        $model = new Evection();
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
        $model =new Evection();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Evection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Evection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Evection::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
