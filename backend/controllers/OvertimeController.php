<?php

namespace backend\controllers;

use Yii;
use common\models\Overtime;
use backend\models\Overtime as OvertimeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use mdm\admin\components\Helper;

use common\models\User;
use common\models\Department;
use common\models\Store;
use common\models\Position;

/**
 * OvertimeController implements the CRUD actions for Overtime model.
 */
class OvertimeController extends Controller
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
        // return [
        //     'access' => [
        //         'class' => yii\filters\AccessControl::className(),
        //             'rules' => [
        //                 [
        //                     'allow' => true,
        //                     'actions' => ['create', 'update', 'view', 'delete'],
        //                     'roles' => ['@'],
        //                 ],
        //                 [
        //                     'allow' => true,
        //                     'actions' => ['index'],
        //                     'roles' => ['?'],
        //                 ],
        //             ],
        //     ],
        // ];
    }

    /**
     * Lists all Overtime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OvertimeSearch();
        $post = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($post);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists one Overtime models.
     * @return mixed
     */
    public function actionOne()
    {
        $searchModel = new OvertimeSearch();
        $post = Yii::$app->request->queryParams;
        $user_id = $_SESSION['__id'];
        $post['Overtime']['user_id'] = $_SESSION['__id'];
        $dataProvider = $searchModel->search($post);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Overtime model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $user_id = $this->findModel($id)->user_id;
        $username = User::find()->where(['id' => $user_id])->one()->username;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'username' => $username
        ]);
    }

    /**
     * Creates a new Overtime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Overtime();
        if(yii::$app->request->ispost){
            $post = Yii::$app->request->post();
            $post["Overtime"]['work_address'] = $post['work_address'];
            $post["Overtime"]['user_id'] = yii::$app->session['__id'];
            // p($post);
            unset($post['work_address']);
            if ($model->load($post) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            die('数据插入失败，请查看数据是否填写完整！');
        }}else {
            $All = $this -> CommonUser();
            return $this->render('create', [
                'model' => $model,
                'res' => $All
            ]);
        }
    }

    /**
     * Updates an existing Overtime model.
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
            $All = $this -> CommonUser();
            return $this->render('update', [
                'model' => $model,
                'res' => $All
            ]);
        }
    }

    /**
     * [CommonRes 公共的User数据]
     */
    public function CommonUser(){
        $user_id = \Yii::$app->session->get('__id');
        $res = User::find()->select(['department_id','username','store_id','position_id'])->where(['id' => $user_id])->one();
        $username = $res -> username;
        $department_id = $res -> department_id;
        
        $department = Department::find()->select(['name'])->where(['id'=>$department_id])->one();
        $store_id = $res -> store_id;
        $store = Store::find()->select(['name'])->where(['id'=>$store_id])->one();
        
        $position_id = $res -> position_id;
        $position = Position::find()->select(['name'])->where(['id'=>$position_id])->one();

        $All = [$username,$department,$store,$position];
        return $All;
    }

    /**
     * Deletes an existing Overtime model.
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
        $model = new Overtime();
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
        $model = new Overtime();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    // public function action
    /**
     * Finds the Overtime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Overtime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Overtime::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
