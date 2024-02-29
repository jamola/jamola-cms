<?php

/* ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);
error_reporting(E_WARNING); */

echo PHP_VERSION."<br />";

class Product {
    private $price;
    private $weight;
}

$product = new Product;

var_dump($product);



/* 
// include functions.php
function calculateShipping($productWeight, $pricePerKilogram) {
        return $productWeight * $pricePerKilogram;
}




// $products = $_SESSION['products'];
$products[1]['weight'] = 1;
$products[1]['price'] = 6;


$pricePerKilogram = 5;

$totalShippingPrice = 0;
foreach($products as $product){
    $totalShippingPrice = calculateShipping($product['weight'], $pricePerKilogram);
}

echo $totalShippingPrice;


 */
