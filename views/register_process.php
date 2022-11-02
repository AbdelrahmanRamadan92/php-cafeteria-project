<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/classes/user.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/save_image.php';
include $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/validator.php';

session_start();
$errors = validator($_REQUEST, [
	'name' => 'required|string|min:3|max:50',
	'email' => 'required|email|string|min:10|max:255',
	'password' => 'required|string|min:8',
	'room' => 'required|numeric',
	'ext' => 'required|numeric',
]);

$result=save('user',$_FILES);
if ($result) {
    $_REQUEST['image']=save('user',$_FILES);
}else{
    $errors['image']='insert valied image';
}

if (count($errors) > 0) {
	$_SESSION['errors'] = $errors;
	header('location:adduser');
    // var_dump($_SESSION['errors']);
}else{
    
    if(User::store($_REQUEST))
    {
        header('location:users');   
    }

}