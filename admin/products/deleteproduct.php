<?php
 require_once $_SERVER['DOCUMENT_ROOT'] .'/connection.php';
$id = $_REQUEST["id"];
echo $id;
$product = DB::findtById("product",$id);
// var_dump($product);
if(file_exists($_SERVER['DOCUMENT_ROOT'] .'/assets/img/'.$product['image'])){
    unlink($_SERVER['DOCUMENT_ROOT'] .'/assets/img/'.$product['image']);
}
DB::delete("product",$id);
// $result = DB::delete("product",$id);
// echo $result;

header("Location: allproducts");

