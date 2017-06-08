<?php

namespace backend\controllers;

use Yii;
use common\models\DrugBuyerOrder;
use backend\models\DrugBuyerOrder as DrugBuyerOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\DrugBuyerDetail;
use common\models\Leechdom;
use yii\web\BadRequestHttpException;

/**
 * DrugBuyerOrderController implements the CRUD actions for DrugBuyerOrder model.
 */
class DrugBuyerOrderController extends Controller
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
     * Lists all DrugBuyerOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DrugBuyerOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DrugBuyerOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!Yii::$app->request->isAjax){
            throw new BadRequestHttpException("未知错误！");
            
        }
      
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DrugBuyerOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DrugBuyerOrder();
        
        $modelsAddress = [new DrugBuyerDetail()];
        
        $cate = \common\models\Category::find()->where(['and',['parent_id'=>1],['status'=>1]])->all();
        
        if(Yii::$app->request->isPost){
            
            $post = Yii::$app->request->post();
            
            $transaction = Yii::$app->db->beginTransaction();
            try{

                $model->buyer_number = 'MLY'.$this->random(4).Yii::$app->user->identity->id.time();
                $model->store_id = Yii::$app->user->identity->store_id;
                $model->applicant_id = Yii::$app->user->identity->id;
                $model->status = 68;
                $model->created_time = time();
                if($model->save()){
                   $orderId = $model->getPrimaryKey();
                   $detail = [];
                   foreach ($post['DrugBuyerDetail'] as $key => $value) {
                        $detail[] = [
                            'leechdom_id' => $value['leechdom_id'],
                            'number' => $value['number'],
                            'order_id' => $orderId,
                            'created_time'=>time()
                        ];
                    } 
                Yii::$app->db->createCommand()->batchInsert(DrugBuyerDetail::tableName(),
                        
                    ['leechdom_id', 'number', 'order_id', 'created_time'],
                        
                    $detail
                    
                )->execute();

                }else{
                    throw new BadRequestHttpException("订单主表信息插入失败，请联系技术部。");
                }
                $transaction->commit();
                return $this->redirect(['index']);
            }catch(\Express $e){
                
                $transaction->rollBack();
                throw new BadRequestHttpException("数据写入失败，请联系管理员！");
                
            }
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'cate' => $cate,
                'modelsAddress' => (empty($modelsAddress)) ? [new DrugBuyerDetail()] : $modelsAddress
            ]);
        }
    }
    
    /**
     * 根据传递过来的分类ID取出该分类下的所有药品
     * [actionAjaxListShow description]
     * @return [type] [description]
     */
    public function actionAjaxListShow()
    {
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $children = Leechdom::find()->where(['and',['cate_id'=>$id],['status'=>1]])->all();
            $countChild = Leechdom::find()->where(['and',['cate_id'=>$id],['status'=>1]])->count();
            if($countChild == 0){
                return 400;
            }else{
                echo "<option>请选择药品……</option>";
                foreach ($children as $value) {
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                }
            }
        }
    }

    /**
     * Updates an existing DrugBuyerOrder model.
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
     * Deletes an existing DrugBuyerOrder model.
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
        $model = new DrugBuyerOrder();
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
        $model =new DrugBuyerOrder();
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
     * Finds the DrugBuyerOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return DrugBuyerOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DrugBuyerOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
