<?php

namespace backend\controllers;

use Yii;
use common\models\SurgicalItems;
use backend\models\SurgicalItems as SurgicalItemsSearch;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SuppliesBound;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/**
 * SurgicalItemsController implements the CRUD actions for SurgicalItems model.
 */
class SurgicalItemsController extends Controller
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
     * Lists all SurgicalItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SurgicalItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single SurgicalItems model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        
        $model = $this->findModel($id);

        if($model->supplier){
            
            $modelsAddress = $model->supplier;
        
        }else{

           $modelsAddress = [new SuppliesBound()]; 
        
        }
        
        $cate = \common\models\Category::find()->where(['and',['parent_id'=>2],['status'=>1]])->all();
        
        if(Yii::$app->request->isPost){

            $post = Yii::$app->request->post('SuppliesBound');
            
            if($model->supplier){
                //取出数据库中存在的旧ID
                $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
                //计算出需要删除的旧规格详情
                $deletedIDs=[];
                
                foreach($oldIDs as $v){
                    if(!$this->deep_in_array($v,$post)){

                        $deletedIDs[]= $v;
                    }
                }
                $transaction = Yii::$app->db->beginTransaction();
                //数据异常处理
                try{
                    //删除需要删除的耗材绑定
                    if(!empty($deletedIDs)){
                        SuppliesBound::deleteAll(['id' => $deletedIDs]);
                    }
                    
                    foreach ($post as $key => $value) {

                        //判断post过来的ID是否为空
                        if(!empty($value['id'])){
                            //如果不为空，说明数据库中存在该数据，直接修改该数据
                            $updateBound = SuppliesBound::findOne($value['id']);

                            $updateBound->cate_id = $value['cate_id'];
                            $updateBound->supplie_id = $value['supplie_id'];
                            $updateBound->number = $value['number'];
                            $updateBound->save();
                        }else{
                            //如果post过来的id为空说明数据库中部存在该数据，直接新增该数据
                            $newBound = new SuppliesBound();
                            $newBound->cate_id = $value['cate_id'];
                            $newBound->operation_id = $id;
                            $newBound->supplie_id = $value['supplie_id'];
                            $newBound->number = $value['number'];
                            $newBound->save();
                        }
                    }

                    $transaction->commit();

                    return $this->redirect(['index']); 
                }catch(\Exception $e){
                    //如果有数据插入或更新不成功的时候执行回滚，并且报错
                    $transaction->rollBack();

                    throw new BadRequestHttpException('数据插入失败');
                }

            }else{

                foreach ($post as $key => $value) {
                    $post[$key]['operation_id'] = $id;
                }

                $add = Yii::$app->db->createCommand()->batchInsert(SuppliesBound::tableName(),
                        
                    ['cate_id','supplie_id', 'number', 'operation_id'],
                        
                    $post
                    
                )->execute();
                if($add !== 0){
                    return $this->redirect(['index']); 
                }else{
                    throw new BadRequestHttpException("添加失败");
                
                }  
            }
            
        }else{
            return $this->render('view', [

                'model' => $model,

                'cate' => $cate,

                'modelsAddress' => (empty($modelsAddress)) ? [new DrugBuyerDetail()] : $modelsAddress
            ]);   
        }
       
    }
    public  function deep_in_array($value, $array) {
        foreach($array as $item) {
            if(!is_array($item)) {
                if ($item == $value) {
                    return true;
                } else {
                    continue;
                }
            }

            if(in_array($value, $item)) {
                return true;
            } else if(self::deep_in_array($value, $item)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Creates a new SurgicalItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SurgicalItems();
        $list = $model->getOptions();
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $post['SurgicalItems']['store_id'] = Yii::$app->user->identity->store_id;
            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                throw new BadRequestHttpException('数据添加失败！');
            }
        }else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list
            ]);
        }
    }

    /**
     * Updates an existing SurgicalItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $list =$model->getOptions();
        
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
     * Deletes an existing SurgicalItems model.
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
        $model = new SurgicalItems();
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
        $model =new SurgicalItems();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the SurgicalItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SurgicalItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SurgicalItems::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
