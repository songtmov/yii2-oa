<?php

namespace backend\controllers;

use Yii;
use common\models\Check;
use common\models\OutboundOrder;
use common\models\Category;

use backend\models\Check as CheckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Supplies;
use common\models\Leechdom;

/**
 * CheckController implements the CRUD actions for Check model.
 */
class CheckController extends Controller
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
            // [
                // 'class' => 'yii\filters\HttpCache',
                // 'lastModified'=>function(){
                //     return filemtime('hw.txt');
                // }
                // ,
                // 'etagSeed'=>function(){
                //     $fp = fopen('hw.txt','r');
                //     $title = fgets($fp);
                //     fclose($fp);
                //     return $title;
                // }
            // ]
        ];
    }

    /**
     * Lists all Check models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // $content = file_get_contents('hw.txt');
        // p($content);die;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             
        ]);
    }

    /**
     * Displays a single Check model.
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
     * Creates a new Check model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Check();
        $category_model = new Category();
        $res = $category_model::find()->where(['parent_id' => 0])->all();
        
        $new = [];
        foreach ($res as $k => $v) {
            $new[$v->id] = $v -> name;
        }

        ///////////////////////////////////////////////////
        /**
         * [$post description]
         * @var [type]
         */
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $actual_num = $post['Check']['actual_num'];
            $deviation = $post['Check']['deviation'];
            $post['Check']['paper_num'] = $actual_num - $deviation;
        }else{
            $post = yii::$app->request->Post();
        }
        
        if ($model->load($post) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cate_id' => $new
            ]);
        }
        ///////////////////////////////////////////////////
        
        // if(yii::$app->request->isPost){
        //     $post = yii::$app->request->post();
        //     $actual_num = $post['Check']['actual_num'];
        //     $deviation = $post['Check']['deviation'];
        //     $post['Check']['paper_num'] = $actual_num - $deviation;
        //     $name = explode(',',$post['Check']['item_id'])[1];
            
        //     if ($model->load($post) && $model->save()) {
        //         if($post['Check']['cate_id'] == 1){
        //             // $leechdom_model = new Leechdom();
        //             $sql = 'UPDATE mly_leechdom SET stock='.$actual_num.' WHERE NAME ="'.$name.'"';
        //             $res = yii::$app->db->createCommand($sql);
        //             $query = $res -> query();
        //         }else if($post['Check']['cate_id'] == 2){
        //             // $supplies_model = new Supplies();
        //             $sql = 'UPDATE mly_supplies SET stock='.$actual_num.' WHERE NAME ="'.$name.'"';
        //             $res = yii::$app->db->createCommand($sql);
        //             $query = $res -> query();
        //         }else{
        //             return '暂不支持，新类目的添加！！';
        //         }
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // }else {

        //     return $this->render('create', [
        //         'model' => $model,
        //         'cate_id' => $new,
        //     ]);
        // }
    }
    
    /**
     * Updates an existing Check model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     $category_model = new Category();
    //     $res = $category_model::find()->where(['parent_id' => 0])->all();
        
    //     $new = [];
    //     foreach ($res as $k => $v) {
    //         $new[$v->id] = $v -> name;
    //     }

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //             'cate_id' => $new,
    //         ]);
    //     }
    // }
    
    /**
     * Deletes an existing Check model.
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
        $model = new Check();
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
        $model =new Check();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Check model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Check the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Check::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
