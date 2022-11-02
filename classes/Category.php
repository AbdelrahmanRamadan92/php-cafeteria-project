<?php
require_once('connection.php');
require_once('DB.php');

class Category extends DB 
{
   static protected $table='categories';
   
   public static function get(){
   return Category::getAll(Category::$table);
   }
   public static function store($data){
    return Category::create(Category::$table,$data);
    }
    public static function delete_Category($id)
    {
        return Category::delete(Category::$table,$id);
    }
    public static function update_Category($cond,$data)
    {
        return Category::update(Category::$table,$cond,$data);
    }
    public static function get_Category($id)
    {
        return Category::getOne(Category::$table,$id);
    }
        
}