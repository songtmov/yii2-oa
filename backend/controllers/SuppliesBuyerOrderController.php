<?php

namespace backend\controllers;

use Yii;
use common\models\SuppliesBuyerOrder;
use backend\models\SuppliesBuyerOrder as SuppliesBuyerOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SuppliesBuyerDetail;
use common\models\Category;
use common\models\Supplies;
use backend\controllers\DrugBuyerOrder;
/**
 * SuppliesBuyerOrderController implements the CRUD actions for SuppliesBuyerOrder model.
 */
class SuppliesBuyerOrderController extends Controller
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
     * Lists all SuppliesBuyerOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuppliesBuyerOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single SuppliesBuyerOrder model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        // if(!Yii::$app->request->isAjax){
        //     throw new BadRequestHttpException('未知错误！');
        // }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuppliesBuyerOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuppliesBuyerOrder();
        $modelsAddress = [new SuppliesBuyerDetail()];
        $cate = Category::find()->where(['and',['parent_id'=>2],['status'=>1]])->all();

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
                   foreach ($post['SuppliesBuyerDetail'] as $key => $value) {
                        $detail[] = [
                            'supplie_id' => $value['supplie_id'],
                            'number' => $value['number'],
                            'order_id' => $orderId,
                            'created_time'=>time()
                        ];
                    } 
                Yii::$app->db->createCommand()->batchInsert(SuppliesBuyerDetail::tableName(),
                        
                    ['supplie_id', 'number', 'order_id', 'created_time'],
                        
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
            
            
        }else {
            return $this->render('create', [
                'model' => $model,
                'modelsAddress' => (empty($modelsAddress))? [new SuppliesBuyerDetail()] : $modelsAddress,
                'cate' => $cate
            ]);
        }
    }

    /**
     * Updates an existing SuppliesBuyerOrder model.
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
    public function random($length)
    {
        $pattern = '1234567890';
        $key = null;
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, 9)};    //生成php随机数
        }
        return $key;
    }

    /**
     * Deletes an existing SuppliesBuyerOrder model.
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
     * 通过传递过来的耗材分类ID，获取该分类下的所有耗材ID
     * [actionAjaxListShow description]
     * @return [type] [description]
     */
    public function actionAjaxListShow()
    {
      
        if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
            
            $id = Yii::$app->request->post('id');
            
            $children = Supplies::find()->where(['and',['cate_id'=>$id],['status'=>1]])->all();
            
            $countChild = Supplies::find()->where(['and',['cate_id'=>$id],['status'=>1]])->count();
            
            if($countChild == 0){
                
                return 400;
            
            }else{
               
                echo "<option>请选择耗材……</option>";
                
                foreach ($children as $value) {
                    
                    echo "<option value='".$value->id."'>".$value->name."</option>";
                
                }
            }
        }
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
        $model = new SuppliesBuyerOrder();
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
        $model =new SuppliesBuyerOrder();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the SuppliesBuyerOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SuppliesBuyerOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuppliesBuyerOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
