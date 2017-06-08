<?php

namespace backend\controllers;

use Yii;
use common\models\OutboundOrder;
use backend\models\OutboundOrder as OutboundOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Category;

use common\models\Leechdom;
use common\models\Supplies;

/**
 * OutboundorderController implements the CRUD actions for OutboundOrder model.
 */
class OutboundorderController extends Controller
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
     * Lists all OutboundOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OutboundOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OutboundOrder model.
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
     * Creates a new OutboundOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(yii::$app->request->isAjax){
            $leechdom_model = new Leechdom();
            $supplies_model = new Supplies();
            $outboundorder_model = new OutboundOrder();
            $category_model = new Category();
            $cate_id = yii::$app->request->post()['cate'];
            if($cate_id == ''){
                return '<option selected="selected" value="">您暂时还没有选择类别</option>';
            }
            if($category_model::find()->where(['parent_id' => $cate_id])->all() !== null){
                $category = $category_model::find()->where(['parent_id' => $cate_id])->all();
                $long = '';
                foreach ($category as $key => $value) {
                    $long .= "<option value='".$value->id."'>".$value->name."</option>";
                }
                return $long;
            }else{
                return '<option selected="selected">该品类下暂无药品与耗材</option>';
            }
        }

        $model = new OutboundOrder();
        $category_model = new Category();
        $res = $category_model::find()->where(['parent_id' => 0])->all();
        $new = [];
        foreach ($res as $k => $v) {
            $new[$v->id] = $v -> name;
        }

        if(yii::$app->request->isPost){
            $post = Yii::$app->request->post();
            $item_id = explode(',',$post['OutboundOrder']['item_id'])[0];
            $item_name = explode(',',$post['OutboundOrder']['item_id'])[1];
            $leechdom_model = new Leechdom();
            $supplies_model = new Supplies();
            $numbers = $post['OutboundOrder']['numbers'];
            if(!empty($leechdom_model::find()->where(['id' => $item_id,'name' => $item_name])->one())){
                $stock = $leechdom_model::find()->where(['id' => $item_id,'name' => $item_name])->one()->stock;
                if($numbers > $stock){
                    Yii::$app->getSession()->setFlash('success', '出库数量大于现有数量，请重新填写！');
                    return $this->redirect('/outboundorder/create');
                }else{
                    $end_stock = ($stock - $numbers);
                    $end_stock = (string)$end_stock;
                }
                $db = \Yii::$app->db;
                $res = $db->createCommand('UPDATE mly_leechdom SET stock =:stock WHERE id =:id')->bindValues([':id'=>$item_id,':stock'=>$end_stock])->query();
            }else{
                $stock = $supplies_model::find()->where(['id' => $item_id,'name' => $item_name])->one()->stock;
                if($numbers > $stock){
                    Yii::$app->getSession()->setFlash('success', '出库数量大于现有数量，请重新填写！');
                    return $this->redirect('/outboundorder/create');
                }else{
                    $end_stock = $stock - $numbers;
                    $end_stock = (string)$end_stock;
                }
                $db = \Yii::$app->db;
                $res = $db->createCommand('UPDATE mly_supplies SET stock =:stock WHERE id =:id')->bindValues([':id'=>$item_id,':stock'=>$end_stock])->query();
            }
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'cate_id' => $new
            ]);
        }
    }

    /**
     * Updates an existing OutboundOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = new OutboundOrder();
    //     $category_model = new Category();
    //     $res = $category_model::find()->where(['parent_id' => 0])->all();
    //     $new = [];
    //     foreach ($res as $k => $v) {
    //         $new[$v->id] = $v -> name;
    //     }
        
    //     $model = $this->findModel($id);
        
    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //             'cate_id' => $new
    //         ]);
    //     }
    // }

    /**
     * [actionStock 库存查询]
     * @return [type] [返回库存信息]
     */
    public function actionStock(){
        if(yii::$app->request->isPost && yii::$app->request->isAjax){
            $item_id = yii::$app->request->post()['item'];
            
            $leechdom_model = new Leechdom();
            $supplies_model = new Supplies();
            
            if(!empty($leechdom_model::find()->where(['cate_id' => $item_id])->all())){
                $res = $leechdom_model::find()->where(['cate_id' => $item_id])->all();
                $long = '';
                foreach ($res as $k => $v) {
                    $long .= '<option value="'.$v->id.','.$v->name.'">'.$v->name.'</option>';
                    // p($long);die;
                    return $long;
                }
            }else if(!empty($supplies_model::find()->where(['cate_id' => $item_id])->all()) ){
                $res = $supplies_model::find()->where(['cate_id' => $item_id])->all();
                $long = '';
                foreach ($res as $k => $v) {
                    $long .= '<option value="'.$v->id.','.$v->name.'">'.$v->name.'</option>';
                    // p($long);die;
                    return $long;
                }
            }else{
                return '<option>'.'该品类下暂无药品与耗材'.'</option>';
            }
        }
    }

    /**
     * [actionInventory 返回库存]
     * @return [type] [description]
     */
    public function actionInventory(){
        if(yii::$app->request->isAjax){
            $item = yii::$app->request->post()['item'];
            if($item){
                $item_arr = explode(',',$item);
                $id = $item_arr[0];
                $name = $item_arr[1];
                
                $leechdom_model = new Leechdom();
                $supplies_model = new Supplies();
                
                if(!empty($leechdom_model::find()->where(['id' => $id,'name' => $name])->one())){
                    $leechdom = $leechdom_model::find()->select('stock')->where(['id' => $id,'name' => $name])->one()->stock;
                    return $leechdom;
                }else{
                    $supplies = $supplies_model::find()->select('stock')->where(['id' => $id,'name' => $name])->one()->stock;
                    return $supplies;
                }
            }else{
                return '您输入的物品选择不正确，或未按三级分类填写';
            }
        }
    }

    /**
     * Deletes an existing OutboundOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

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
        $model = new OutboundOrder();
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
        $model = new OutboundOrder();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the OutboundOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OutboundOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OutboundOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
