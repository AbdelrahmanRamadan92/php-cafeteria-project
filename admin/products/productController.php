<?php
 require_once $_SERVER['DOCUMENT_ROOT'] .'/connection.php';
 require_once $_SERVER['DOCUMENT_ROOT'] .'/admin/helpers/functions.php';
 
 
if($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_REQUEST['id'])){
       
    // LOGIC ... 
     
      $name        = CleanInputs($_POST['name']);
      $category_id = Sanitize($_POST['category_id'],1);
      $price       = $_POST['price'];
//   var_dump($name);
      $Message = [];
      # Check Validation ... 
      if(!Validator($name,1)){
      
        $Message['Name'] = "name Field Required";

      }
      
      if(!Validator($name,2)){
      
        $Message['NameLength'] = "Name length must be > 2";

      }
      if(!Validator($name,7)){
      
        $Message['Name'] = "name must be string";

      }

      if(!Validator($category_id,3)){

        $Message['Category'] = "Invalid Category ";
      }

      if(!Validator($price,1)){
      
        $Message['Price'] = "price Field Required";

      }

      
// image 
      $imageName     = $_FILES['image']['name'];

      $nameArray = explode('.',$imageName);
      $FileExtension = strtolower($nameArray[1]);
      if(!Validator($imageName,1)){
      $Message['image'] = "image Field Required";

    }


    if(!Validator($FileExtension,5)){
      
      $Message['imageExtension'] = "Invalid Image Extension";

    }

     if(count($Message) > 0){
       $_SESSION['messages'] = $Message;
       header('Location: add.php');
    }else{

        $tmp_path = $_FILES['image']['tmp_name'];
        // $size     = $_FILES['uploadedFile']['size'];
        // $type     = $_FILES['uploadedFile']['type'];
           
         $FinalName = rand().time().'.'.$FileExtension;
   
         $disFolder = $_SERVER['DOCUMENT_ROOT'].'/assets/img/';
           
         $disPath  = $disFolder.$FinalName;
   
       if(move_uploaded_file($tmp_path,$disPath)){

        $inputData = ["name"=>$name ,"price"=>$price ,"image"=>$FinalName ,"category_id"=>$category_id];
        $result = DB::create("product",$inputData);
        header("Location: allproducts");
       };
    }}
    

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_REQUEST['id'])){
       
    // LOGIC ... 
      $id          = $_POST['id'];
      $name        = CleanInputs($_POST['name']);
      $category_id = Sanitize($_POST['category_id'],1);
      $price       = $_POST['price'];
      $image       = $_POST['OldImage'];
      $FinalName  = $image;

      $Message = [];
      # Check Validation ... 
      if(!Validator($name,1)){
      
        $Message['Name'] = "name Field Required";

      }
      
      if(!Validator($name,2)){
      
        $Message['NameLength'] = "Name length must be > 2";

      }
      if(!Validator($name,7)){
      
        $Message['Name'] = "name must be string";

      }

      if(!Validator($category_id,3)){

        $Message['Category'] = "Invalid Category ";
      }

      if(!Validator($price,1)){
      
        $Message['Price'] = "price Field Required";

      }
    // image 
    $imageName     = $_FILES['image']['name'];
    // var_dump($imageName);
    // if new image uploaded
    if(!empty($imageName)){
        $nameArray = explode('.',$imageName);
        $FileExtension = strtolower($nameArray[1]);
        if(!Validator($FileExtension,5)){
            $Message['imageExtension'] = "Invalid Image Extension";
        }
        if(count($Message) > 0){
            $_SESSION['messages'] = $Message;
            header("Location: edit.php?id=$id");
        }else{
            $tmp_path = $_FILES['image']['tmp_name'];
           
            $newFinalImageName = rand().time().'.'.$FileExtension;

            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$image))
            {
                unlink($_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$image);
            }
            $FinalName = $newFinalImageName;
   
            $disFolder = $_SERVER['DOCUMENT_ROOT'].'/assets/img/';
           
            $disPath  = $disFolder.$FinalName;
   
            if(!move_uploaded_file($tmp_path,$disPath)){
                $Message['imageUpload'] = "error on uploading Image ";
            }
        }
    }
    $inputData = ["name"=>$name ,"price"=>$price ,"image"=>$FinalName ,"category_id"=>$category_id];
    // var_dump($inputData);
    $result = DB::update("product",["id"=>$id],$inputData);
        header("Location: allproducts");
}  


?>