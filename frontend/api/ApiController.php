<?php  
/** 
 * Created by PhpStorm. 
 * User: Administrator 
 * Date: 2016/3/16 
 * Time: 23:03 
 */  
  
namespace frontend\api;  

use yii\web\Controller;

class ApiController extends Controller{  
  	
    public function actionTest(){
        echo 'Hello Api';  
    }
  	
}  