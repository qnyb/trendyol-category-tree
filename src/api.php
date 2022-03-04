<?php

class TrendyolApi{

	// Get Trendyol Categories
	public function getAllTrendyolCategories(){

		// Trendyol Category Url
		$url = 'https://api.trendyol.com/sapigw/product-categories';

		$ch = curl_init($url);
		$header = array('Content-Type: application/json');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		$data = json_decode(curl_exec($ch), true);
		curl_close($ch);
		return $data['categories'];
	}

	// Get Trendyol Category Trees
	public function getAllTrendyolCategoryTree($data,$categoryTree=null,$parentName=null){
		foreach($data as $key => $valuedata)
			{
				// Sub Category Control
				if(sizeof($valuedata["subCategories"])>0)
					{
						$categoryTreeName=$parentName;
						$parentName.=$valuedata["name"].' > ';
						$categoryTree=self::getAllTrendyolCategoryTree($valuedata["subCategories"],$categoryTree,$parentName);
						$parentName=$categoryTreeName;
					}else{
						$categoryTreeName=$parentName.$valuedata["name"];
						$categoryTree[]=['trendyol_category_id' => $valuedata["id"], 'trendyol_category_tree' => $categoryTreeName];
					}
			}
			$parentName="";
		return $categoryTree;
	}

	//Get Trendyol Category Attributes
	public function getTrendyolCategoryAttributes($category_id){

		// Trendyol Category Attributes Url
		$url = "https://api.trendyol.com/sapigw/product-categories/".$category_id."/attributes";

		$ch = curl_init($url);
		$header = array('Content-Type: application/json');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		$data = json_decode(curl_exec($ch), true);
		curl_close($ch);
		return $data['categoryAttributes'];
	}
	
	public function getTrendyolAttributeAndVariant($category_id){

		//Get Trendyol Category Attributes
		$data=self::getTrendyolCategoryAttributes($category_id);
		foreach($data as $key => $value){

			//Variant Or Attribute Control
			if($value['varianter']==1){
				$variantAllData[]=$value;
			}else{
				$attrAllData[]=$value;
			}

		}
		
		//Variants
		$attrAndVariant['options']=$variantAllData;
		//Attributes
		$attrAndVariant['attributes']=$attrAllData;

		return $attrAndVariant;
	}

}
?>