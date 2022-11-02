<?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/isAdmin.php';

if (!Auth::check()) {
    header('location: home'); 
}?>