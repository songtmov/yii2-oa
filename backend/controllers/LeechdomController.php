<?php

namespace backend\controllers;

use Yii;
use common\models\Leechdom;
use backend\models\Leechdom as LeechdomSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use common\models\Customer;

/**
 * LeechdomController implements the CRUD actions for Leechdom model.
 */
class LeechdomController extends Controller
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
     * Lists all Leechdom models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(yii::$app->request->isPost){
            $name = yii::$app->request->Post()['username'];
            if($name == null){
                yii::$app->Session->setFlash('error','您还没输入任何药品名称！');
                return $this->redirect('index');
            }

            $Leechdom = new Leechdom();

            $res = $Leechdom::find()->where(['name' => $name])->one();

            if($res == null){
                yii::$app->Session->setFlash('error','该药品不存在！');
                return $this->redirect('index');
            }else{
                // $res;
                return $this->render('search',
                    [
                        'res' => $res
                    ]
                );
            }
        }

        $searchModel = new LeechdomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Leechdom model.
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
     * Creates a new Leechdom model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Leechdom();
        $list = $model->getOption();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $post = Yii::$app->request->post("Leechdom");
                if(empty($post['number']))
                {
                    $model->updateAll(['number'=>'MLY'.Yii::$app->user->identity->id.time().$this->random(3)],['id'=>$model->id]);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Updates an existing Leechdom model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list  = $model->getOption();

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
     * Deletes an existing Leechdom model.
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
        $model = new Leechdom();
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
        $model =new Leechdom();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /***
     * 生成随机字符串
     * @param $length
     * @return null|string
     */
    public function random($length){
        $pattern = '1234567890';
        $key = null;
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 9)};    //生成php随机数
        }
        return $key;
    }
    /**
     * Finds the Leechdom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Leechdom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Leechdom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
