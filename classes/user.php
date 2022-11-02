<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/DB.php';


class User extends DB 
{
   static protected $table='users';
   
   public static function get(){
   return User::getAll(User::$table);
   }
   public static function store($data){
    return User::create(User::$table,$data);
    }
    public static function delete_user($id)
    {
        return User::delete(User::$table,$id);
    }
    public static function update_user($cond,$data)
    {
        return User::update(User::$table,$cond,$data);
    }
    public static function get_user($id)
    {
        return User::getOne(User::$table,$id);
    }
    public static function user_query($query)
    {
        return User::query($query);
    }
}

