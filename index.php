<?php
ob_start();
$request = $_SERVER['REQUEST_URI'];
/*
$path =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

parse_str( parse_url( $path, PHP_URL_QUERY), $query );
echo count($query);
echo implode("&",$query);
*/

switch ($request) {
    
    /**************** GUEST ***********************/
        
     case '/login' :
        require __DIR__ . '/views/login.php';
        break; 
        
    case '/manualorders' :
        require __DIR__ . '/views/manualorder.php';
        break; 
       
    case '/login_process':
               require __DIR__ . '/views/login_process.php';
        break;
        
        
    case '/register' :
        require __DIR__ . '/views/register.php';
        break; 
        
        
    case '/register_process' :
        require __DIR__ . '/views/register_process.php';
        break;
        
        
    /******************* USER **************************/
        
    case '/' :
        require __DIR__ . '/views/home.php';
        break;
        
    case '/home' :
        require __DIR__ . '/views/home.php';
        break;
        
    
     case '/myorders' :
        require __DIR__ . '/views/myorders.php';
        break;
        
    case '/products' :
        require __DIR__ . '/views/product.php';
        break;
        
    case '/logout' :
        require __DIR__ . '/views/logout.php';
        break;
    
        
    /***************** ADMIN *************************/
        
    case '/orders' :
        require __DIR__ . '/admin/orders.php';
        break;
    case '/checks' :
        require __DIR__ . '/admin/checks.php';
        break;
        
    case '/users' :
        require __DIR__ . '/admin/users.php';
        break;    
    case '/users/edit' :
    require __DIR__ . '/admin/users/edit.php';
    break;
    
    case '/users/edite_process' :
    require __DIR__ . '/admin/users/edite_process.php';
    break;
    
        
    case '/users/delete' :
        require __DIR__ . '/admin/users/delete_user.php';
        break; 
      
    case '/allproducts' :
    require __DIR__ . '/admin/products/index.php';
    break;   
        
     
        
    case '/createproduct' :
        require __DIR__ . '/admin/products/add.php';
        break; 
        
    case '/addproduct' :
        require __DIR__ . '/admin/products/productController.php';
        break; 
                
        
    case '/editproduct' :
    require __DIR__ . '/admin/products/edit.php';
    break;
    
    case '/updateproduct' :
    require __DIR__ . '/admin/products/productController.php';
    break; 
    
    // delete without refresh don't work
    case '/deleteproduct' :
    require __DIR__ . '/admin/products/delete.php';
    break; 
    
    // Delet with refresh
    case '/delproduct' :
    require __DIR__ . '/admin/products/deleteproduct.php';
    break; 

    case '/available' :
    require __DIR__ . '/admin/products/changeAvailability.php';
    break; 
    case '/createcategory' :
    require __DIR__ . '/admin/category/add_category.php';
    break;
    
    case '/add_category_process' :
    require __DIR__ . '/admin/category/add_category_processs.php';
    break; 
    
    case '/showcategories' :
    require __DIR__ . '/admin/category/show_categories.php';
    break;
    
    case '/category/edit' :
    require __DIR__ . '/admin/category/category_edit.php';
    break;
    
    case '/category/delete' :
    require __DIR__ . '/admin/category/category_delete.php';
    break;
 case '/categoryedite' :
    require __DIR__ . '/admin/category/category_edit_process.php';
    break;

    
case '/adduser' :
    require __DIR__ . '/admin/users/addUser.php';
    break;   
    
    
case '/requests' :
    require __DIR__ . '/admin/helpers/requests.php';
    break;   
    

        
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}