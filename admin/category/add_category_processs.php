<?php 

// require_once('./Category.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Category.php';
//session_start();
$errors=[];
$flag=false;
if (isset($_REQUEST["name"])){
    if (!empty($_REQUEST["name"])) {
        if (strlen($_REQUEST["name"])>3) {
            $flag=true;
        }else{
          $errors['name']="name is must be more than 3 characters";

        }
    
    }else{
    $errors['name']="name is empty";

    }
}else{
    $errors['name']="name is required";
}

if (count($errors) > 0) {
	$_SESSION['errors'] = $errors;
	header('location:addCategory.php');
    // var_dump($_SESSION['errors']);
}else{
    if(Category::store($_REQUEST))
    {
        echo"added successfully";
        header('location:showcategories');   
    }

}
