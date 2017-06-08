<?php

namespace backend\controllers;

use common\models\Region;
use Yii;
use common\models\Store;
use backend\models\Store as StoreSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoreController implements the CRUD actions for Store model.
 */
class StoreController extends Controller
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
                    "imagePathFormat" => "/uploads/image/{yyyy}{mm}{dd}/{time}{rand:6}" //上传保存路径
                ],
            ]
        ];
    }

    /**
     * 门店列表
     * Lists all Store models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * 门店详情
     * Displays a single Store model.
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
     * 新增门店
     * Creates a new Store model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // p(yii::$app->request->post());die;
        $model = new Store();
        $region = Region::find()->where(['parent_id' => 1])->all();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            
            $post['Store']['store_created_time'] = strtotime($post['Store']['store_created_time']);
            
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * 修改门店
     * Updates an existing Store model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $region = Region::find()->where(['parent_id' => 1])->all();
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $post['Store']['store_created_time'] = strtotime($post['Store']['store_created_time']);

            if ($model->load($post) && $model->save()) {

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * 删除门店
     * Deletes an existing Store model.
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
     * 批量删除
    * @param $id
    * @return \yii\web\Response
    */

    public function actionDelall()
    {
        if(!Yii::$app->request->isAjax && !Yii::$app->request->isPost){
            return '未知错误';
        }
        $id = implode(',',$_POST['id']);
        $model = new Store();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * 批量修改
    * @param $id
    * @return \yii\web\Response
    */
    public function actionUpdateall()
    {
        if(!Yii::$app->request->isAjax && !Yii::$app->request->isPost){
            return '未知错误';
        }
        $id = implode(',',$_POST['id']);
        $model =new Store();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /***
     *
     */
    public function actionAjaxListShow()
    {
        if(!Yii::$app->request->isAjax || !Yii::$app->request->isPost){
            return false;
        }
        $id = Yii::$app->request->post('id');
        $countChild = Region::find()->where(['parent_id' => $id])->count();

        $children = Region::find()->where(['parent_id' => $id])->all();

        if($countChild > 0)
        {
            echo "<option>" . Yii::t('common', 'Please Select') . "</option>";
            foreach($children as $child)
                echo "<option value='" . $child->id . "'>" . $child->name . "</option>";
        }
        else
        {
            echo "<option>" . Yii::t('common', 'No Option') . "</option>";
        }
    }
    /**
     * Finds the Store model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Store the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Store::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('所请求的页面不存在。');
        }
    }
}
