<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';


class Product extends DB
{
    public function __construct(){}

    static protected $table = 'product';
    
    static function get()
    {
        return Product::getAll(Product::$table);
    }
    static function find($id)
    {
        return Product::getOne(Product::$table, $id);
    }

    static function getProductPrice($product_id){
        return Product::getOne(Product::$table,$product_id);
    }
  
}


