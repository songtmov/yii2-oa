<?php

namespace backend\controllers;

use Yii;
use common\models\Photos;
use backend\models\Photos as PhotosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Customer;
use common\models\BillingOperation;
use app\models\UploadForm;
use yii\web\UploadedFile;
use common\models\PhotoType;

/**
 * PhotosController implements the CRUD actions for Photos model.
 */
class PhotosController extends Controller
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

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',
                'config' => [
                    "imagePathFormat" => "/uploads/image/{yyyy}{mm}{dd}/{time}{rand:6}" 
                        //上传保存路径
                ],
            ]
        ];
    }

    /**
     * Lists all Photos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $phototype = PhotoType::find()->all();
        $type = [];
        foreach ($phototype as $key => $value) {
            $type[$value->id] = $value->name;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type' => $type,
        ]);
    }

    /**
     * [actionAjax 异步传值]
     * @return [type] [description]
     */
    public function actionAjax(){
        if(yii::$app->request->isPost && yii::$app->request->isAjax){
            $username = yii::$app->request->Post()['username'];
            $billing_model = new BillingOperation();
            $customer_model = new Customer();
            $customer_id = $customer_model::findOne(['client_name' => $username]);
            $res = $billing_model::find()->select('order_num')->where(['client_id' => $customer_id])->all();
            $new = [];
            $num = 0;
            foreach ($res as $key => $value) {
                $new[$num] = $value['order_num'];
                $num++;
            }
            return json_encode($new);
        }else{
            return json_encode(['0' => null]);
        }
    }

    /**
     * Displays a single Photos model.
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
     * Creates a new Photos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Photos();

        $post = yii::$app->request->post();
        
        if ($model->load($post) && $model->save()) {
                
                return $this->redirect(['view', 'id' => $model->id]);
                
        }else {
                
                return $this->render('create', [
                    'model' => $model
                ]);
        }
    }

    /**
     * Updates an existing Photos model.
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
     * Deletes an existing Photos model.
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
        $model = new Photos();
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
        $model =new Photos();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Photos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Photos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
