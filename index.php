<?php
require('src/api.php');
$TrendyolApi = new TrendyolApi();
$catResult=$TrendyolApi->getAllTrendyolCategoryTree($TrendyolApi->getAllTrendyolCategories());
//$attributeResult=$TrendyolApi->getTrendyolAttributeAndVariant(604);
echo'<pre>'; print_r($catResult);
?>