<?php 
namespace backend\controllers;

use yii\web\Controller;
use common\models\Cstore;

class ActionController extends Controller
{
	/**
	 * [actionTime description]
	 * @return [type] [description]
	 */
	public function actionTime(){
	        $sql = 'UPDATE mly_c_store SET telephone=telephone+1';
	        $res = yii::$app->db->createCommand($sql);
	        $query = $res -> query();
	}
}
?>