<?php

class DB
{
    static public $connection;
    private function __construct($database_type, $host, $database_name, $username, $password)
    {
        $db = "$database_type:host=$host;dbname=$database_name";
        DB::$connection = new PDO($db, $username, $password);
    }

    ////////////////////////////// CONNECT ////////////////////////////////////

    static function connect($database_type, $host, $database_name, $username, $password)
    {
        if (!isset(DB::$connection)) {
            new DB($database_type, $host, $database_name, $username, $password);
        }
        return DB::$connection;
    }

    ////////////////////////////// GET ALL ////////////////////////////////////

    static public function getAll($table)
    {
        $query = "SELECT * FROM $table";
        $sql =  DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    ////////////////////////////// GET ALL ////////////////////////////////////

    static public function getCond($table,  $table2  ,$cond)
    {
        $query = "SELECT *FROM $table , $table2 WHERE ";
        foreach ($cond as $key => $value) {
            $query .= "$key = $value";
            $query .= ' AND ';
        }

        $query =  rtrim($query, 'AND '); 
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getCondOneTable($table ,$cond)
    {
        $query = "SELECT *  FROM $table  WHERE ";
        foreach ($cond as $key => $value) {
            $query .= "$key = $value";
            $query .= ' AND ';
        }

        $query =  rtrim($query, 'AND '); 
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


    /////GET ONE

    static public function getOne($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id=$id";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    /// get col by cond
    static public function getColByCond($table,$table2, $col,$cond){
        $query = "SELECT $col FROM $table ,$table2 WHERE ";

        foreach ($cond as $key => $value) {
            $query .= "$key = $value";
            $query .= ' AND ';
        }
        $query =  rtrim($query, 'AND ');  

       // echo $query;
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

        ////////////////////////////// UPDATE ////////////////////////////////////

    static public function update($table, $cond, $data)
    {
        $query = "UPDATE $table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = '$value',";
        }
        $query = rtrim($query, ',');
        $query .= ' WHERE ';

        foreach ($cond as $key => $value) {
            $query .= "$key = '$value'";
            $query .= ' AND ';
        }
        $query =  rtrim($query, 'AND ');  

        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }


   

    ////////////////////////////// CREATE ////////////////////////////////////

    static public function create($table, $data)
    {
        $query = "INSERT INTO $table(";
        $col = [];
        $values = [];
        foreach ($data as $key => $value) {
            array_push($col, "`$key`");
            array_push($values, "'$value'");
        }
        $col = implode(',', $col);
        $values = implode(',', $values);
        $query .= "$col) VALUES($values)";

        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }



    static public function createWithReturnID($table, $data)
    {
        DB::create($table, $data);
        return DB::$connection->lastInsertId();
    }
    ////////////////////////////// DELETE ////////////////////////////////////
    static public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id=$id";
        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }


    static public function deleteCond($table, $cond)
    {
        $query = "DELETE from $table WHERE ";
        
        foreach ($cond as $key => $value) {
            $query .= "$key = '$value'";
            $query .= ' AND ';
        }
        $query =  rtrim($query, 'AND ');  

        $sql = DB::$connection->prepare($query);
        return $sql->execute();
    }


    ////////////////////////////// GET BY ////////////////////////////////////


    static public function getByPaginate($table, $cond , $from , $num)
    {

        $query = "SELECT * , $table.id as id1 FROM $table WHERE $cond LIMIT $from , $num";

        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
      
    }


     ////////////////////////////// GET FROM TWO TABLES  ////////////////////////////////////
  
     static public function getFromTwoTables($cols, $table1 ,$table2 , $cond ,$group_by=null )
     {
        if(isset($group_by))
                $query = "SELECT $cols FROM $table1 , $table2 WHERE  $cond group by $group_by";
        
        else
         $query = "SELECT $cols FROM $table1 , $table2 WHERE $cond";
         
         $sql = DB::$connection->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
     } 



     static public function getFromTwoTables1($table1 ,$table2 , $p1 , $p2)
    {
        $query = "SELECT * FROM $table1 , $table2 WHERE $table1.$p1=$table2.$p2";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }


      ////////////////////////////// GET FROM TWO TABLES Paginate  ////////////////////////////////////
  
      static public function getFromTwoTablesPaginate($cols, $table1 ,$table2 , $cond ,$group_by=null,$start , $num )
      {
         if(isset($group_by))
                $query = "SELECT $cols FROM $table1 , $table2 WHERE  $cond group by $group_by LIMIT $start , $num";
         else
                $query = "SELECT $cols FROM $table1 , $table2 WHERE $cond LIMIT $start , $num";
          
          $sql = DB::$connection->prepare($query);
          $sql->execute();
          return $sql->fetchAll(PDO::FETCH_ASSOC);
      } 

     /*************** Column Type "Enum" ***************/
     static public function getColValues($table, $col )
     {
         $query = "SELECT COLUMN_TYPE FROM information_schema.`COLUMNS` WHERE TABLE_NAME='$table' AND COLUMN_NAME ='$col'";
         $sql = DB::$connection->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
     }


     static public function customQuery($query )
     {
         $sql = DB::$connection->prepare($query);
         $sql->execute();
         return $sql->fetchAll(PDO::FETCH_ASSOC);
     }



     /*********************** PAGINATE ***********************/
     public static function paginate($total,$num_of_record,$renderFun ){
        $pagLink=''; 
        $page = 1;
        $total_pages = ceil($total / $num_of_record); 

       for ($i=1; $i<=$total_pages; $i++)   
          $pagLink .=    $i == $page ?  "<a class = 'active' onclick='$renderFun(".($i).")'>".$i." </a>"  :    "<a onclick='$renderFun(".($i).")'> ".$i." </a>"; 

        echo $pagLink;
     }
    
    
    static public function query($query)
    {

        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    static public function findtById($table,$id)
    {
        $query = "SELECT * FROM $table WHERE id =$id";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $data = $sql->fetch(PDO::FETCH_ASSOC);
    }



    static public function updateCol($table,$col,$value,$id)
    {
        $query = "UPDATE $table SET $col = $value WHERE id =$id";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
    }
    
      static public function getusersbyadmincart()
    {
        $query = "SELECT * FROM `cart`,`users` WHERE cart.user_id = users.id";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
   
    
    
    
    static public function search($table,$filtervalues)
    {
        $query = "SELECT * FROM $table WHERE `name` like '%$filtervalues%'";
        $sql = DB::$connection->prepare($query);
        $sql->execute();
        return $data = $sql->fetch(PDO::FETCH_ASSOC);
    }
}

   

