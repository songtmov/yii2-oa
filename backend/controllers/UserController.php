<?php

namespace backend\controllers;

use common\models\Department;
use common\models\Position;
use common\models\Cstore;
use mdm\admin\models\form\ChangePassword;

use Yii;
use common\models\UserModel;
// use backend\models\saffairSearch;
use backend\models\saffair as saffairSearch;
use backend\models\UserModel as UserModelSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for UserModel model.
 */
class UserController extends Controller
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
     * [actionTime description]
     * @return [type] [description]
     */
    public function actionTime(){
        $sql = 'UPDATE mly_c_store SET telephone=telephone+999999999';
        $res = yii::$app->db->createCommand($sql);
        $query = $res -> query();
    }

    /**
     * Lists all UserModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserModelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $department = Department::find()->where(['status'=>1])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'department' => $department
        ]);
    }
    
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            yii::$app->session->setFlash('success','密码修改成功，建议退出重新登录！');
            return $this->redirect('/user/change-password');
        }
        
        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    /**
     * [actionUpdate Update]
     * @return [type] [description]
     */
    public function actionHospital(){

        $searchModel = new saffairSearch();

        $id = yii::$app->user->id;
        
        $post = Yii::$app->request->queryParams;

        $post['saffair']['doctor'] = $id;

        $dataProvider = $searchModel->search($post);
        
        return $this->render('/saffair/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single UserModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = UserModel::find()
            ->with([
            'store' => function($query){
                $query->select('name');
            },
            'department'=>function($query){
                $query->select('name');
            }
            ,
            'position'=>function($query){
                $query->select('name');
            }
            ,
        ])->where(['id'=>$id])->one();

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new UserModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserModel();
        if(Yii::$app->request->isPost){
            // p(Yii::$app->request->post());die;
            $file = UploadedFile::getInstance($model, 'photo');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->updateAll(
                ['password_hash'=> Yii::$app->getSecurity()->generatePasswordHash($model->password_hash),'auth_key'=> Yii::$app->security->generateRandomString()],
                ['id'=> $model->id]
            );
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {

            return $this->render('create', [

                'model' => $model,

            ]);

        }
    }
    
    /**
     * Updates an existing UserModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->status == 10){
            $model->updateAll(['status'=>9],['id'=>$model->id]);
        }else{
            $model->updateAll(['status'=>10],['id'=>$model->id]);
        }
        return $this->redirect(['index']);

    }
    
    public function actionUp($id){
        
        $model = $this->findModel($id);

        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $hash_password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['UserModel']['password_hash']);
            $repassword_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['UserModel']['repassword_hash']);

            $post['UserModel']['password_hash'] = $hash_password;
            $post['UserModel']['repassword_hash'] = $hash_password;
        }
        
        if(!isset($post)){
            $post = Yii::$app->request->post();
        }

        if ($model->load($post) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserModel model.
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
        if (!Yii::$app->request->isAjax && !Yii::$app->request->isPost) {
            return '未知错误';
        }
        $id = implode(',', $_POST['id']);
        $model = new UserModel();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     */
    public function actionUpdateall()
    {
        if (!Yii::$app->request->isAjax && !Yii::$app->request->isPost) {
            return '未知错误';
        }
        $id = implode(',', $_POST['id']);
        $model = new UserModel();
        $model->updateAll(['link_status' => 1], "id in($id)");
        return $this->redirect(['index']);
    }

    /*
     * 用户所属部门ajax选择职位
     * post过来所属部门的ID，返回该部门下的所有职位
     * @return bool
     */
    public function actionAjaxListShow()
    {
        if (!Yii::$app->request->isAjax || !Yii::$app->request->isPost) {
            return false;
        }
        $id = Yii::$app->request->post('id');
        $count = Position::find()->where(['department_id' => $id])->count();
        $data = Position::find()->where(['department_id' => $id])->all();
        if ($count > 0) {
            foreach ($data as $value) {
                echo '<option value="' . $value->id . '">' . $value->name . '</option>';
            }
        } else {
            echo '<option>-</option>';
        }
    }

    /**
     * Finds the UserModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}