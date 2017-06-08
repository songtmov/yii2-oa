<?php

namespace backend\controllers;

use Yii;
use common\models\Cstore;
use common\models\Region;
use common\models\Store;
use backend\models\Cstore as CstoreSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\StoreSearch;

use common\models\User;

use common\models\BillingOperation;

/**
 * CstoreController implements the CRUD actions for Cstore model.
 */
class CstoreController extends Controller
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
     * Lists all Cstore models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CstoreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPersonalCstore()
    {
        $searchModel = new CstoreSearch();
        $id = yii::$app->user->id;
        $post = Yii::$app->request->queryParams;
        
        $post['Cstore']['business'] = $id;

        $dataProvider = $searchModel->search($post);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cstore model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $res = $this->findModel($id);
        //获取id
        // $cityid = $res -> city;
        // $provinceid = $res -> province;
        // $areaid = $res -> area;
        $hospitalid = $res -> hospital;
        //获取名称
        // $city = Region::find()->where(['id' => $cityid])->one()->name;
        // $province = Region::find()->where(['id' => $provinceid])->one()->name;
        // $area = Region::find()->where(['id' => $areaid])->one()->name;
        $hospital = Store::find()->where(['id' => $hospitalid])->one()->name;
        //返回地址数组
        // $return = ['city' => $city,'province' => $province,'area' => $area];
        //获取医院名称
        return $this->render('view', [
            'model' => $this->findModel($id),
            // 'address' => $return,
            'hospital' => $hospital
        ]);
    }

    /**
     * Creates a new Cstore model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $region = Region::find()->where(['parent_id' => 1])->all();
        $model = new Cstore();
        
        $post = yii::$app->request->post();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            // yii::$app->session->setFlash('error','新增美容院失败！');
            return $this->render('create', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * [actionSearch 搜索类]
     * @return [type] [description]
     */
    public function actionSearch()
    {
        $model = new StoreSearch();

        $select = $model->search(Yii::$app->request->queryParams);

        $data = $select->one();

        $acreage = $data['acreage'];

        $hospital = $data['hospital'];

        $user_model = new User();

        $store_model = new Store();

        if($user_model::find()->select(['username'])->where(['id' => $acreage])->one()){
            $username = $user_model::find()->select(['username'])->where(['id' => $acreage])->one()->username;
        }else{
            $username = '该人员尚未确定';
        }
        
        // p($acreage_name);die;
        if($store_model::find()->select(['name'])->where(['id' => $hospital])->one()){
            $store_name = $store_model::find()->select(['name'])->where(['id' => $hospital])->one()->name;
        }else{
            $cstore_name = '医院名称尚未确定';
        }
        
        // p($cstore_name);die;
        if( !isset($username) || !isset($store_name)){
            $username = null;
            $store_name = null;
        }
        
        return $this->render(
            'search',
            [
                'model' => $model,
                'data' => $data,
                'acreage_name' => $username,
                'store_name' => $store_name
            ]
        );
    }

    /**
     * Updates an existing Cstore model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {   
        $region = Region::find()->where(['parent_id' => 1])->all();
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * Deletes an existing Cstore model.
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
        $model = new Cstore();
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
        $model =new Cstore();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * [actionAjaxListShow 城市三级联动]
     * @return [type] [description]
     */
    public function actionAjaxListShow()
    {
        $this -> ajax();
        $id = Yii::$app->request->post('id');
        $countChild = Region::find()->where(['parent_id' => $id])->count();
        $children = Region::find()->where(['parent_id' => $id])->all();
        if($countChild > 0)
        {
            echo "<option>" . Yii::t('common', 'Please Select') . "</option>";
            foreach($children as $child)
                echo "<option value='" . $child->id . "'>" . $child->name . "</option>";
        }else{
            echo "<option>" . Yii::t('common', 'No Option') . "</option>";
        }
    }
    /**
     * [actionHospital Ajax医院]
     * @return [type] [description]
     */
    public function actionHospital(){
        $this -> ajax();
        $id = yii::$app->request->post('id');
        $parent_id = Region::find()->where(['id' => $id])->one()->parent_id;
        $children = Store::find()->where(['city' => $parent_id])->all();
        $countChildren = Store::find()->where(['city' => $parent_id])->count();
        if($countChildren > 0){
            echo "<option value='null'>请选择</option>";
            foreach ($children as $child) {
                echo "<option value='" . $child->id . "'>" . $child->name . "</option>";
            }
        }else{
            echo "<option value='null'>请选择</option><option>该地区暂无门店...</option>";
        }
    }
    /**
     * 判断ajax的公共函数
     */
    public function ajax(){
        if(!Yii::$app->request->isAjax || !Yii::$app->request->isPost){
            return false;
        }
    }
    /**
     * Finds the Cstore model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Cstore the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cstore::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
