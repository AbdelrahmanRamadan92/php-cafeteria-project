<?php 

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Category.php';


if(Category::update_Category(['id'=>$_REQUEST['id']],$_REQUEST))
{
	header('location:showcategories');
}