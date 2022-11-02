<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';


class ProductOrder extends DB
{
    public function __construct(){}

    static protected $table = 'product_order';
    
    static function get($id)
    {
        return ProductOrder::getAll(ProductOrder::$table);
    }

    static function getByOrderId($cols,$order_id) //with name
    {
        return ProductOrder::getFromTwoTables($cols,ProductOrder::$table ,"product" , ProductOrder::$table.".product_id = product.id AND order_id = $order_id",null);
    }

    static function deleteOrderProducts($cond)
    {
        return ProductOrder::deleteCond(ProductOrder::$table,$cond);
    }



    static function insertProduct($price , $product_id ,$quantity , $order_id){

        return ProductOrder::create(ProductOrder::$table,["price"=>$price , "product_id"=>$product_id , "amount"=>$quantity , "order_id"=>$order_id]);
    }
}


