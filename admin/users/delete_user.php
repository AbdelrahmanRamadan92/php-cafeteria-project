<?php
include $_SERVER['DOCUMENT_ROOT'] . '/classes/user.php';
$result=User::delete_user($_REQUEST['id']);
if($result){
header('location:../users');
}
// var_dump($_REQUEST['id']);
?>







