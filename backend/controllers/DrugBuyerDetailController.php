<?php

namespace backend\controllers;

use Yii;
use common\models\DrugBuyerDetail;
use backend\models\DrugBuyerDetail as DrugBuyerDetailSearch;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\DrugBuyerOrder;
use common\models\Leechdom;

/**
 * DrugBuyerDetailController implements the CRUD actions for DrugBuyerDetail model.
 */
class DrugBuyerDetailController extends Controller
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
     * Lists all DrugBuyerDetail models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        // if(!Yii::$app->request->isAjax){
        //     throw new BadRequestHttpException("未知错误！");
        // }
        $status = DrugBuyerOrder::findOne($id)['status'];
        $searchModel = new DrugBuyerDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

            'status'=>$status
        ]);
    }

    /**
     * Displays a single DrugBuyerDetail model.
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
     * Creates a new DrugBuyerDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->post('Leechdom');
            if(!$post){
                throw new BadRequestHttpException("提交数据有误");
            }
            foreach($post as $key=>$value){
                Leechdom::updateAllCounters(['stock' =>+$value],['id'=>$key]);
            }
            DrugBuyerOrder::updateall(['status'=>200],['id'=>Yii::$app->request->get('id')]);
            return $this->redirect(['/drug-buyer-order/index']);
        }
    }

    /**
     * Updates an existing DrugBuyerDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = DrugBuyerOrder::findOne($id);
        if(!$model){
            throw new BadRequestHttpException("未查到该订单");
        }
        if($model['status'] == 68){
            
            $modelUpdate = $model->updateall(['status'=>98,'buyer_id'=>Yii::$app->user->identity->id],['id'=>$id]);
        
        }elseif($model['status'] == 98){
            
            $modelUpdate = $model->updateall(['status'=>136],['id'=>$id]);
        
        }


        if ($modelUpdate) {
            return $this->redirect(['/drug-buyer-order/index']);
        } else {
           throw new BadRequestHttpException("数据修改失败！");
           
        }
    }


    /**
     * Deletes an existing DrugBuyerDetail model.
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
        $model = new DrugBuyerDetail();
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
        $model =new DrugBuyerDetail();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the DrugBuyerDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DrugBuyerDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DrugBuyerDetail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
