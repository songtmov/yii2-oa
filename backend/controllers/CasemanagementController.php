<?php

namespace backend\controllers;

use Yii;
use common\models\CaseManagement;
use common\models\Customer;
use backend\models\CaseManagement as CaseManagementSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\console\Exception;

/**
 * CasemanagementController implements the CRUD actions for CaseManagement model.
 */
class CasemanagementController extends Controller
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
     * Lists all CaseManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CaseManagementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CaseManagement model.
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
     * Creates a new CaseManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CaseManagement();
        if(yii::$app->request->isPost){
            $post = yii::$app->request->Post();
            if($model::find()->where(['customer_id' => $post['CaseManagement']['customer_id']])->one()){
                Yii::$app->session->setFlash('error','该用户病例已存在----如需更新请删除原有病历！');
                return $this -> redirect('/casemanagement/create');die;
            }else{
                $path = UploadedFile::getInstance($model, 'path');
                $basename = date('Ymdhis',time()).rand(0,99);
                if ($path) {
                    if(!in_array($path->extension,['rar','7z','zip'])){
                        Yii::$app->session->setFlash('error','文件格式仅限于rar,7z,zip!');
                        return $this -> redirect('/casemanagement/create');die;
                    }
                    $path->saveAs('uploads/case/' . $basename . '.' . $path->extension);
                    $post['CaseManagement']['path'] = 'uploads/case/' . $basename . '.' . $path->extension;
                    if ($model->load($post)){
                        if($model->save()){
                            return $this->redirect(['view', 'id' => $model->id]);
                        }else{
                            Yii::$app->session->setFlash('error','该用户病例已存在----如需更新请删除原有病历！');
                            return $this -> redirect('/casemanagement/create');
                        }
                    }
                }else{
                    Yii::$app->session->setFlash('error','文件错误!');
                    return $this -> redirect('/casemanagement/create');
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CaseManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('up-date', [
                'model' => $model,
            ]);
        }
    }

    /**
     * [actionSearch 搜索]
     * @return [type] [description]
     */
    public function actionSearch(){
        if(yii::$app->request->isPost){
            $post = yii::$app->request->Post();
            $client_name = $post['client_name'];
            if(!$client_name){
                yii::$app->session->setFlash('error','搜索的客户名不能为空！');
                return $this->redirect('index');
            }

            $CaseManagement = new CaseManagement();

            $Customer = new Customer();

            $customer_id = $Customer::find()->select('id')->where(['client_name' => $client_name])->one()['id'];

            if(!$customer_id){
                yii::$app->session->setFlash('error','不存在的客户名！');
                return $this->redirect('index');
            }
            
            $res = $CaseManagement::find()->where(['customer_id'=>$customer_id])->one();

            return $this->render('search',
            [
                'res' => $res
            ]
        );
        }else{
            throw new Exception("非法操作！GET");
        }
    }

    /**
     * Deletes an existing CaseManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(file_exists($this->findModel($id)->path)){
            unlink($this->findModel($id)->path);
        }
        
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
        $model = new CaseManagement();
        $model->deleteAll("id in($id)");
        return $this->redirect(['index']);
    }
    
    /**
     * [actionNewupdate 修改备注]
     * @return [type] [description]
     */
    public function actionRemark(){
        if(yii::$app->request->isPost){
            $post = yii::$app->request->post();
            $id = $post['id'];
            $nbackup = $post['nbackup'];
            
            $row = Yii::$app->getDb()->createCommand()->update('mly_case_management', [  
                'nbackup' => $nbackup,
                    ], "id=:id", [ 
                ':id' => $id
            ])->execute();
            
            if($row){
                Yii::$app->session->setFlash('success','修改成功!');
                return $this -> redirect('/casemanagement/index');
            }else{
                Yii::$app->session->setFlash('error','修改失败!');
                return $this -> redirect('/casemanagement/index');
            }
        }
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
        $model = new CaseManagement();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * Finds the CaseManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaseManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaseManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
