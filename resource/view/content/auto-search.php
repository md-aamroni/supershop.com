<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/PageController.php");
## ===*=== [C]ALLING CONTROLLER ===*=== ##


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$pageControl = new PageController;
## ===*=== [O]BJECT DEFINED ===*=== ##


@$searchData = $_POST['search'];

## ===*=== [F]ETCH SERACH DATA QUERY ===*=== ##
$result = $pageControl->searchAuto('products', 'product_name', $searchData);

if($result > 0)
{
	foreach($result AS $eachData)
	{
		echo '<a class="list-group-item-action loadData">'. $eachData['product_name'] .'</a>';
	}
}
else
{
	echo '<a class="list-group-item-action loadData"> No Data Found </a>';
}
## ===*=== [F]ETCH SERACH DATA QUERY ===*=== ##
?>