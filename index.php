<?php
require('src/api.php');
$TrendyolApi = new TrendyolApi();

//Get All Trendyol Categories
$categoryTreeResult=$TrendyolApi->getAllTrendyolCategoryTree($TrendyolApi->getAllTrendyolCategories());
echo'<pre>'; print_r($categoryTreeResult);

//Get Trencyol Category Attributes And Variants
//$attributeResult=$TrendyolApi->getTrendyolAttributeAndVariant(604);

?>