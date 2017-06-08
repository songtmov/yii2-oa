<?php

namespace backend\controllers;

use Yii;
use common\models\CustomerVisit;
use backend\models\CustomerVisit as CustomerVisitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VisitController implements the CRUD actions for CustomerVisit model.
 */
class VisitController extends Controller
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
     * Lists all CustomerVisit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerVisitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Displays a single CustomerVisit model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = CustomerVisit::find()->with([
            'user'=>function($query){
                return $query->select('username');
            },
            'customer'=> function($query){
                return $query->select('client_name');
            }
        ])->where(['id'=>$id])->one();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new CustomerVisit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new CustomerVisit();
        if(Yii::$app->request->isPost){

            $post = Yii::$app->request->post();
            
            $post['CustomerVisit']['customer_id'] = $id;

            $post['CustomerVisit']['service_id'] = Yii::$app->user->identity->id;

            if ($model->load($post) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CustomerVisit model.
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
        $model = new CustomerVisit();
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
        $model =new CustomerVisit();
        $model->updateAll(['link_status'=>1],"id in($id)");
        return $this->redirect(['index']);
    }

    /**
     * [ipaddress ip归属地]
     * @return [type] [description]
     */
    public function actionIp(){
        if(yii::$app->request->isAjax){
            $ip = yii::$app->request->post()['ip'];
            //配置您申请的appkey
            $appkey = 'ee5208a03940d19919912f071423c14b';
            //************1.根据IP/域名查询地址************
            $url = "http://apis.juhe.cn/ip/ip2addr";
            $params = array(
                  "ip" => $ip,//需要查询的IP地址或域名
                  "key" => $appkey,//应用APPKEY(应用详细页查询)
                  "dtype" => "",//返回数据的格式,xml或json，默认json
            );
            $paramstring = http_build_query($params);
            $content = $this ->juhecurl($url,$paramstring);
            $result = json_decode($content,true);
            if($result){
                if($result['error_code']=='0'){
                    return json_encode($result);
                }else{
                    return json_encode($result['error_code'].":".$result['reason']);
                }
            }else{
                echo "请求失败";
            }
        }
    }

    /**
     * 请求接口返回内容
     * @param  string $url [请求的URL地址]
     * @param  string $params [请求的参数]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    private function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
     
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }

    /**
     * Finds the CustomerVisit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return CustomerVisit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerVisit::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
