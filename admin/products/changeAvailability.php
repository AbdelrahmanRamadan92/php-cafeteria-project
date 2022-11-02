<?php
 require_once $_SERVER['DOCUMENT_ROOT'] .'/connection.php';
$id=$_REQUEST['id'];
$product = DB::findtById("product",$id);

echo $product["avilable"];

if($product["avilable"]){
    DB::updateCol("product",'avilable',0,$id);
}else{
    DB::updateCol("product",'avilable',1,$id);

}
header("Location: allproducts");

