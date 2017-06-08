<?php

namespace backend\controllers;

use Yii;
use common\models\Supplies;
use backend\models\Supplies as SuppliesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SuppliesController implements the CRUD actions for Supplies model.
 */
class SuppliesController extends Controller
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
     * Lists all Supplies models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuppliesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * [actionAdd description]
     * @return [type] [description]
     */
    public function actionAdd(){
        if(yii::$app->request->isAjax && yii::$app->request->isPost){
            $id = yii::$app->request->Post()['id'];
            $Supplies = new Supplies();
            $stock = $Supplies::find()->select('stock')->where(['id' => $id])->one()['stock'];
            return $stock;
        }

        return $this->render('add',
            [
                'title' => '耗材增加',
            ]
        );
    }

    /**
     * [actionAddlogin description]
     * @return [type] [description]
     */
    public function actionAddlogin(){
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $Supplies = new Supplies();
            $id = $post['id'];
            $new_stock = $Supplies::find()->select('stock')->where(['id' => $id])->one()['stock'];
            $add_stock = $post['add_stock'];
            $stock = $new_stock + $add_stock;
            $status = $post['status'];
            $db = \Yii::$app->db;
            $res = $db->createCommand('UPDATE mly_supplies SET stock =:stock , status =:status WHERE id =:id')->bindValues([':stock'=>$stock,':status'=>$status,':id'=>$id])->query();
            if($res){
                yii::$app->session->setFlash('success','修改成功');
                return $this->redirect('/supplies/index');
            }else{
                yii::$app->session->setFlash('error','修改失败');
                return $this->redirect('/supplies/index');
            }
        }
    }

    /**
     * Displays a single Supplies model.
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
     * Creates a new Supplies model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Supplies();
        $list = $model->getOption();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Updates an existing Supplies model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list = $model->getOption();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Deletes an existing Supplies model.
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
        $model = new Supplies();
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
        $model =new Supplies();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Supplies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Supplies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Supplies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
