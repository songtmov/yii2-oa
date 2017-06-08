<?php
namespace common\data;
use Yii;
use common\models\Region;
class Data
{
	public static function getRegion($areaCode)
	{
		if(is_array($areaCode)){
			$areaCode = implode(',',$areaCode);
			$region = Region::find()->asArray()->select('name')->where("id in($areaCode)")->all();
			$address = '';
			foreach ($region as $key => $value) {
				$address .=$value['name'];
			}
			return $address;
		}
		
	} 



}


?>