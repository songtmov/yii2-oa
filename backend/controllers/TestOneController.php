<?php

namespace backend\controllers;

use Yii;
use common\models\Test;
use backend\models\Test as TestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestOneController implements the CRUD actions for Test model.
 */
class TestOneController extends Controller
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
     * Lists all Test models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();

        // $user_id = $_SESSION['__id'];
        
        // $user_id = yii::$app->user->id;

        $post = Yii::$app->request->queryParams;

        // $post['Test']['username'] = $user_id;

        // p($post);die;

        //array(3) {
        //   ["Test"]=>
        //   array(2) {
        //     ["id"]=>
        //     string(0) ""
        //     ["username"]=>
        //     string(3) "47"
        //   }
        //   ["page"]=>
        //   string(1) "1"
        //   ["per-page"]=>
        //   string(2) "20"
        // }

        $dataProvider = $searchModel->search($post);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
    
    /**
     * Displays a single Test model.
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
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Test();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Test model.
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
     * Deletes an existing Test model.
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
        $model = new Test();
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
        $model =new Test();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
