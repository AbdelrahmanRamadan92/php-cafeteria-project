<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
// require_once('Category.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Category.php';
$result=Category::delete_Category($_REQUEST['id']);

if ($result) {
     header('location:../showcategories');  
}else
{
 echo $result;
}