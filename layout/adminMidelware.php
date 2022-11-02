<?php  
 require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/isAdmin.php';
 $admin = is_admin();
 if (!$admin) {
    header("location: home"); 
 }
 ?>