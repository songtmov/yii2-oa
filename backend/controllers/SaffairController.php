<?php

namespace backend\controllers;

use Yii;
use common\models\saffair;
use backend\models\saffair as saffairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Region;
use common\models\Store;
use common\models\User;
use common\models\Department;

/**
 * SaffairController implements the CRUD actions for saffair model.
 */
class SaffairController extends Controller
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
     * Lists all saffair models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new saffairSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // p(Yii::$app->request->queryParams);die;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionToday($time = null){

        $query = Yii::$app->request->queryParams;

        $query['saffair']['appointment'] = $time;

        $searchModel = new saffairSearch();

        $dataProvider = $searchModel->search($query);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single saffair model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $province = Region::find()->where(['id' => $this -> findModel($id) -> province])->one()->name;
        $city = Region::find()->where(['id' => $this -> findModel($id) -> city])->one()->name;
        $hospital = Store::find()->where(['id' => $this -> findModel($id) -> hospital])->one()->name;
        $this -> findModel($id) -> appointment_type ? $appointment_type = '内部': $appointment_type = '外部';
        $doctor = User::find()->where(['id' => $this -> findModel($id) -> doctor])->one()->username;
        $res = ['province' => $province,'city' => $city,'hospital' => $hospital,'doctor'=>$doctor,'appointment_type'=>$appointment_type];
        return $this->render('view', [
            'model' => $this->findModel($id),
            'res' => $res
        ]);
    }

    /**
     * Creates a new saffair model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post();
            $post['Saffair']['appointment'] = $post['Store']['store_created_time'];
            unset($post['Store']);
            $model = new saffair();
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                throw new NotFoundHttpException('数据存储失败,联系管理员.');
            }
        }else {
            $region = Region::find()->where(['parent_id' => 1])->all();
            $model = new saffair();
            return $this->render('create', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * Updates an existing saffair model.
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
            $region = Region::find()->where(['parent_id' => 1])->all();
            return $this->render('update', [
                'model' => $model,
                'region' => $region
            ]);
        }
    }

    /**
     * Deletes an existing saffair model.
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
        $model = new saffair();
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
        $model = new saffair();
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
     * [actionHospital Ajax医师]
     * @return [type] [description]
     */
    public function actionDoctor(){
        $this -> ajax();
        $id = yii::$app->request->post('id');
        $department_id = Department::find()->where(['name' => '医师部'])->one()->id;
        $children = User::find(['id','username'])->where(['store_id' => $id,'department_id' => $department_id])->all();
        $countChildren = User::find(['id','username'])->where(['store_id' => $id,'department_id' => $department_id])->count();
        echo "<option value='null'>请选择</option>";
        foreach ($children as $child) {
            echo "<option value='" . $child->id . "'>" . $child->username . "</option>";
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
     * Finds the saffair model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return saffair the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = saffair::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}