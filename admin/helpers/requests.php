<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product_order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/views.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/cart.php';

session_start();

/********************* display orders by users **************************/
if(isset($_POST['user_id'])){
    $id = intval($_POST['user_id']);
    $userOrders = Order::getWhere(["user_id"=> $id ,"status" => "'Delivered'"]);
    $i =1 ;
    foreach($userOrders as $singleOrder):?>
            <tr order_id="<?php echo $singleOrder['id']; ?>">
                <td><?php echo $singleOrder['created_at'];?></td>
                <td><?php echo $singleOrder['total'];?></td>
                <td>
                    <button type='button' class='btn btn-primary btn-custom' onclick="showOrderProducts(<?php echo $singleOrder['id']; ?>)">View</button>
                    <button type='button' class='btn btn-danger' onclick="deleteOrder(<?php echo $singleOrder['id']; ?>)">Delete</button>
                </td>
            </tr>
      <?php endforeach;
}
/********************* display order details **************************/
if(isset($_POST['addToCart'])){
    $id = intval($_POST['id']);
    $order_data = ProductOrder::getByOrderId("product_order.product_id ,product_order.amount , product.name , product.image , product.price", $id);
    $r = Cart::addToCart(["user_id"=>3,"product_id"=>4 , "quantity"=>4]);
}


if(isset($_POST['addToCartPId'])){
    $product_id = intval($_POST['addToCartPId']);
    $user_id = intval($_POST['user_idx']);
   // $data = Cart::getByCondOneTable(["user_id"=>$user_id,"product_id"=>$product_id]);
   
    if(count($data)==0){
        Cart::addToCart(["user_id"=>$user_id,"product_id"=>$product_id , "quantity"=>1]);
        $product_data = Product::find($product_id);
       
       echo  '<div class="singleItem d-flex w-100 justify-content-between" p-id="'.$product_data["id"].'">
                    <h5>'. $product_data["name"].'</h5>
                    <button onclick="decrease()">-</button>
                    <p class="quantity">1</p>
                    <button class="increase" onclick="increase()">+</button>
                    <p class="price">'. $product_data["price"].'</p>
                    <button onclick="removeFromCart('.$product_data["id"].')">X</button>
                </div>';
    }
    else{
        $q = $data[0]['quantity']+1;
        $data = Cart::updateCol(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
       echo '
        <p class="here" style="margin:0">'. ($q++) .'</p>';
    }  
}


if(isset($_POST['increasQuantity'])){
    $q = intval($_POST['increasQuantity']) ;
    $product_id=  intval($_POST['p_id']) ;
    $user_id = $_SESSION["user_id"] ;
    $data = Cart::updateCol(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
}



if(isset($_POST['removeFromCart'])){
    $product_id = intval($_POST['removeFromCart']);
    $user_id = $_SESSION["user_id"] ;
    $r = Cart::deleteCartItem(["user_id"=>$user_id,"product_id"=>$product_id]);
    
}


if(isset($_POST['removeFromCartByAdminx'])){
    $product_id = intval($_POST['removeFromCartByAdminx']);
    $user_id = intval($_POST["user_id"]) ;
    $r = Cart::deleteCartItem(["user_id"=>$user_id,"product_id"=>$product_id]);
    
}




/********************* display order details **************************/


if(isset($_POST['id'])){
    $id = intval($_POST['id']);
    $order_data = ProductOrder::getByOrderId("product_order.product_id ,product_order.amount , product.name , product.image , product.price", $id);
    
    $i =0 ;
    foreach($order_data as $singleOrder):?>
        <div class="col-md-3 text-center single-order-product">
            <img width="130"  src='<?php echo $singleOrder["image"]; ?>' class="position-relative" alt="">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-num">
            <span class="visually-hidden"><?php echo $singleOrder["price"];?>.LE</span></span>
            <p><?php echo $singleOrder['name']; ?></p>
            <span class="price"><?php echo $singleOrder['amount'];?></span>
        </div> 
    <?php endforeach;
}

/********************* Delete Single Order **************************/
if(isset($_POST['deleteId'])){
    $id = intval($_POST['deleteId']);
    ProductOrder::deleteOrderProducts(["order_id"=>$id]);
    Order::deleteOrder($id);
}

/********************* UPDATE ORDER STATUS **************************/
if(isset($_POST['status'])){
    $id = intval($_POST['order_id']);
    $status = $_POST['status'];
    Order::updateStatus($id,$status);
    echo $status;
}

/**************************** **************************/
if(isset($_POST['q'])){
    $order_id = intval($_POST['q']);
    $q = "SELECT * FROM order_products WHERE order_id=$order_id";
    $sql = $connect->prepare($q);
    $sql->execute();
    $orderProducts = $sql->fetchAll(PDO::FETCH_ASSOC);
}

/********************* Filter **************************/

if(isset($_POST['from'])){
    $from = date('Y-m-d', strtotime($_POST['from']));
    if(empty($_POST['to'])){
        $_POST['to'] = date('Y-m-d 12:00:00');
    }
    $to = date('Y-m-d 12:00:00', strtotime($_POST['to']));

    if($_POST['users']!= -1){
        $user = $_POST['users'];
        $orders = Order::getWith("orders.user_id , name , total , orders.id as ordID" , "users" , "user_id=users.id AND user_id = $user AND orders.created_at BETWEEN '$from' AND '$to' AND status = 'Delivered' ","orders.user_id");
    }
    else{
        $orders = Order::getWith("orders.user_id , name , total , orders.id as ordID" , "users" , "user_id=users.id  AND status = 'Delivered' AND orders.created_at BETWEEN '$from' AND '$to' ","orders.user_id ");
    }

    $i =1 ;
    foreach($orders as $k):
       echo '<tr>
            <td>'. $k['name'].'</td>
            <td>'.$k['total'].'</td>
            <td><button type="button" class="btn btn-primary btn-custom" onclick="showOrder('. $k['user_id'].')">View</button></td>
        </tr>';
     endforeach;
}


/********************* Filter In Users **************************/

if(isset($_POST['Userfrom'])){

    $from = date('Y-m-d', strtotime($_POST['Userfrom']));
    if(empty($_POST['to']))        $_POST['to'] = date('Y-m-d 12:00:00');
    $user_id = $_SESSION["user_id"] ;
    $to = date('Y-m-d 23:59:59', strtotime($_POST['to']));
    $orders = Order::getWith("orders.created_at,status,total,orders.id" , "users" , "orders.user_id=users.id AND orders.user_id=$user_id AND orders.created_at BETWEEN '$from' AND '$to'",null);
    
    foreach($orders as $singleOrder):
       echo '<tr order_id="'.$singleOrder['id'].'"><td>'. $singleOrder['created_at'].'<button type="button" class="btn btn-warning float-right btn-floating rounded pluse" data-mdb-ripple-color="dark" onclick="showOrderProductss('.$singleOrder['id'].')"> <i class="bi bi-plus" style="font-size: 24px;"></i></button></td>
            <td class="status">'. $singleOrder['status'].'</td>
            <td>'.$singleOrder['total'].'</td>';
             if($singleOrder['status']=="Processing"){
               echo '<td class="text-center btns-del"><button type="button" class="btn btn-danger rounded" onclick="cancelOrder('.$singleOrder['id'].')">Cancel</button></td>';
             }else if($singleOrder['status']=="Canceled"){
               echo  '<td  class="text-center btns-del"> 
                <button type="button" class="btn btn-primary rounded" onclick="reOrder('.$singleOrder['id'].')">Reorder</button>
                <button type="button" class="btn btn-danger rounded" onclick="deleteOrder('.$singleOrder['id'].')">Delete</button>
              </td>';
             }else{
                echo '<td></td>';
             }
             echo '</tr>';
     endforeach;
}


/********************* CANCEL ORDER **************************/

if(isset($_POST['cancelOrder'])){
    $id = intval($_POST['cancelOrder']);
    Order::updateStatus($id,"Canceled");
    echo '<td class="text-center btns-del">    <button type="button" class="btn btn-primary rounded" onclick="reOrder('.$id.')">Reorder</button>
    <button type="button" class="btn btn-danger rounded" onclick="deleteOrder('.$id.')">Delete</button></td>';
}
/********************* Re ORDER **************************/

if(isset($_POST['reOrder'])){
    $id = intval($_POST['reOrder']);
    Order::updateStatus($id,"Processing");
    echo '<td class="text-center btns-del"><button type="button" class="btn btn-danger rounded" onclick="cancelOrder('.$id.')">Cancel</button></td>';
}


/********************* Handle Pagination **************************/

if(isset($_POST['pageoo'])){
    $page =  isset($_POST["pageoo"]) ? $_POST["pageoo"] :  $page=1;   
    $num_of_record = 2; 
 
    $start_from = ($page-1) * $num_of_record;

    $orders = Order::getWithPaginate("orders.created_at,orders.room, status ,ext,name,total,orders.user_id as id1 ,users.id as id2 , orders.id as order_id", "users" , "user_id=users.id AND status != 'Delivered' AND status != 'Canceled'  ORDER BY orders.created_at DESC" ,null,$start_from ,$num_of_record );
    returnOrders($orders , $page);
}

/********************* Handle Pagination **************************/

if(isset($_POST['myorders'])){
    $page =  isset($_POST["myorders"]) ? $_POST["myorders"] :  $page=1;   
    $num_of_record = 2; 
 
    $start_from = ($page-1) * $num_of_record;
    $user_id =  $_SESSION["user_id"];
   $orders = Order::getWherePaginate("user_id = $user_id",$start_from,$num_of_record );
    //$orders = Order::customQuery("SELECT * ,orders.id as id1 FROM orders WHERE user_id = $user_id LIMIT $start_from , $num_of_record");

   // $orders = Order::getWithPaginate("orders.created_at,orders.room, status ,ext,name,total,orders.user_id as id1 ,users.id as id2 , orders.id as order_id", "users" , "user_id=users.id AND status != 'Delivered' AND status != 'Canceled'" ,null,$start_from ,$num_of_record );
    returnMyOrders($orders , $page);
}


if(isset($_POST['checks'])){
    $page =  isset($_POST["checks"]) ? $_POST["checks"] :  $page=1;   
    $num_of_record = 2; 
 
    $start_from = ($page-1) * $num_of_record;
    $user_id =  $_SESSION["user_id"];
    //$orders = Order::getWherePaginate("user_id = $user_id",$start_from,$num_of_record );
    $orders = Order::getWithPaginate("orders.user_id ,name, sum(total) as total_amount","users" , "orders.user_id = users.id AND orders.status ='Delivered'" , " orders.user_id" ,$start_from ,$num_of_record );

   // $orders = Order::getWithPaginate("orders.created_at,orders.room, status ,ext,name,total,orders.user_id as id1 ,users.id as id2 , orders.id as order_id", "users" , "user_id=users.id AND status != 'Delivered' AND status != 'Canceled'" ,null,$start_from ,$num_of_record );
   returnMyChecks($orders);
}


if(isset($_POST['createOrder'])){
        // = intval($_POST['createOrder']);

   $user_id =  $_SESSION["user_id"];
   $total = Cart::getTotal($user_id);
   $last_total = $total[0]["total"];
   $order_id = Order::createOrder($user_id,["user_id"=> $user_id , "status"=>'Processing' , "room"=>1 , "total" => $last_total]);
  
}

if(isset($_POST['createOrderbyid'])){
   $user_id = intval($_POST['createOrderbyid']);
   $room = intval($_POST['userroom']);
   $total = Cart::getTotal($user_id);
   $last_total = $total[0]["total"];
   $order_id = Order::createOrder($user_id,["user_id"=> $user_id , "status"=>'Processing' , "room"=>$room , "total" => $last_total]);
  
}



    /////////////////////////////////////////add item to cart by admin///////////////////////////////////

// {
//     
// }  
if(isset($_POST['addtoadmincartxx'])){
   
     $product_id = $_POST['addtoadmincartxx'];
     $user_id = $_SESSION['user_id'];
     $guest_id = intval($_POST['user_id']);
      $data = Cart::getCartByUserProduct(["user_id"=>$user_id,"product_id"=>$product_id]);
   
    if(count($data)==0){
      //  Cart::addToCart(["user_id"=>$user_id,"product_id"=>$product_id , "quantity"=>1]);
        Cart::addToCart(["admin_id"=>$user_id,"user_id"=>$guest_id,"product_id"=>$product_id,"quantity"=>1]);
        $val = Product::find($product_id);
       
   echo '<div class="row align-items-center mb-3 col-sm-12 mt-2"id="showproduct" p-id="'. $val["id"].'">
                                <div class="col-4 col-sm-3 ">
                                    <img style="width: 100%;"   src="'. $val["image"] .'"alt="">           

                                </div>
                                <div class="col-4 col-sm-3">
                                     <h4>'.$val["name"].'</h4>
                                </div>
                                   
                                <div class="col-sm-1 ">
                                    <input type="button" style="width: 30px;" value="-" field="quantity"  onclick="decrementValue()"  class="qtyminus" data-product-id="'. $val["id"] .'" />
                                </div> 
                                <div class="col-4 col-sm-1">
                                    <input type="text" style="width: 30px; text-align:center;" class="input-number" name="quantity"  class="qty" value="1"/>      
                                </div>
                                <div class="col-4 col-sm-1">
                                    <input type="button" style="width: 30px;" value="+" class="qtyplus" onclick="incrementValue()" field="quantity" data-product-id="'.$val['id'].'" />
                                </div> 
                                   
                                <div class="col-4 col-sm-2 mb-1">
                                    <button class="btn btn-primary" >
                                        <span id="product-total-price"
                                        data-price ="'.$val["price"].'">
                                           '.$val["price"].'
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-1">
                                       <button class="btn btn-danger"
                                            id="delete-product" onclick="deleteItemById('.$val["id"].')" >
                                            x
                                        </button>
                                </div>
                
                          </div>';
       
    }
    else{
        $q = $data[0]['quantity']+1;
        $data = Cart::updateColx(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
       echo '
        <input class="here" style="margin:0" value="'.($q++).'">';
    } 
    
} 
    

    /////////////////////////////////////////////////////delete item from admin cart//////////
    
if(isset($_POST['removeFromadminCart'])){
    $product_id = intval($_POST['removeFromadminCart']);
    $user_id = $_SESSION["user_id"] ;
    $x = Cart::deleteCartItem(["user_id"=>$user_id,"product_id"=>$product_id]);
    
}

//////////////////////////////////////////////////////////////////////////////////



if(isset($_POST['addToCartPId'])){
    $product_id = intval($_POST['addToCartPId']);
    $user_id = intval($_POST['user_idx']);
   // $data = Cart::getByCondOneTable(["user_id"=>$user_id,"product_id"=>$product_id]);
   echo 'hhhhhhhhhhhhh';
      $data = Cart::getByCondOneTable(["user_id"=>$user_id,"product_id"=>$product_id]);
   
    if(count($data)==0){
        Cart::addToCart(["user_id"=>$user_id,"product_id"=>$product_id , "quantity"=>1]);
        $product_data = Product::find($product_id);
       
       echo  '<div id="showproduct" class="singleItem d-flex w-100 justify-content-between" p-id="'.$product_data["id"].'">
                    <h5>'. $product_data["name"].'</h5>
                    <button onclick="decrease()">-</button>
                    <p class="quantity">1</p>
                    <button class="increase" onclick="increase()">+</button>
                    <p class="price">'. $product_data["price"].'</p>
                    <button onclick="removeFromCart('.$product_data["id"].')">X</button>
                </div>';
    }
    else{
        $q = $data[0]['quantity']+1;
        $data = Cart::updateCol(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
       echo '
        <p class="here" style="margin:0">'. ($q++) .'</p>';
    } 
}

////////////////////////////////////add item to cart by user////////////////////////////////////////

if(isset($_POST['addtocartxx'])){
    
    $product_id = $_POST['addtocartxx'];
    $user_id = $_SESSION['user_id'];
   // $cart = Cart::getCartByUser($user_id);

    //   $mycart = Cart::addToCart(["user_id"=>$user_id,"product_id"=>$id,"quantity"=>1]);
     //   var_dump( Product::find($id));
     //$user_id = intval($_POST['user_idx']);
   // $data = Cart::getByCondOneTable(["user_id"=>$user_id,"product_id"=>$product_id]);
      $data = Cart::getCartByUserProduct(["user_id"=>$user_id,"product_id"=>$product_id]);
   
    if(count($data)==0){
        Cart::addToCart(["user_id"=>$user_id,"product_id"=>$product_id , "quantity"=>1]);
        $val = Product::find($product_id);
       
   echo '<div class="row align-items-center mb-3 col-sm-12 mt-2"id="showproduct" p-id="'. $val["id"].'">
                                <div class="col-4 col-sm-3 ">
                                    <img style="width: 100%;"   src="'. $val["image"] .'"alt="">           

                                </div>
                                <div class="col-4 col-sm-3">
                                     <h4>'.$val["name"].'</h4>
                                </div>
                                   
                                <div class="col-sm-1 ">
                                    <input type="button" style="width: 30px;" value="-" field="quantity"  onclick="decrementValue()"  class="qtyminus" data-product-id="'. $val["id"] .'" />
                                </div> 
                                <div class="col-4 col-sm-1">
                                    <input type="text" style="width: 30px; text-align:center;" class="input-number" name="quantity"  class="qty" value="1"/>      
                                </div>
                                <div class="col-4 col-sm-1">
                                    <input type="button" style="width: 30px;" value="+" class="qtyplus" onclick="incrementValue()" field="quantity" data-product-id="'.$val['id'].'" />
                                </div> 
                                   
                                <div class="col-4 col-sm-2 mb-1">
                                    <button class="btn btn-primary" >
                                        <span id="product-total-price"
                                        data-price ="'.$val["price"].'">
                                           '.$val["price"].'
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-1">
                                       <button class="btn btn-danger"
                                            id="delete-product" onclick="deleteItem('.$val["id"].')" >
                                            x
                                        </button>
                                </div>
                
                          </div>';
       
    }
    else{
        $q = $data[0]['quantity']+1;
        $data = Cart::updateColx(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
       echo '
        <input class="here" style="margin:0" value="'.($q++).'">';
    } 
    
} 
    
    
    //////////////////

////////////////////////////////////////
 
if(isset($_POST['increasadminQuantity'])){
    $q = intval($_POST['increasadminQuantity']) ;
    $product_id=  intval($_POST['p_id']) ;
    $user_id = $_SESSION["user_id"] ;
    $data = Cart::updateColx(["user_id"=>$user_id,"product_id"=>$product_id],["quantity"=>$q]);
}



if(isset($_POST['changecartbyuser'])){
    $user_id = intval($_POST['changecartbyuser']) ;

    $order_product = Cart::getByCondd("product",["user_id"=>$user_id,"product.id"=>"product_id"]); 
    if(count($order_product )>0){
    foreach ($order_product as $val){   

     echo '<div class="row align-items-center mb-3 col-sm-12 mt-2"id="showproduct" p-id="'. $val["id"].'">
                                <div class="col-4 col-sm-3 ">
                                    <img style="width: 100%;"   src="'. $val["image"] .'"alt="">           

                                </div>
                                <div class="col-4 col-sm-3">
                                     <h4>'.$val["name"].'</h4>
                                </div>
                                   
                                <div class="col-sm-1 ">
                                    <input type="button" style="width: 30px;" value="-" field="quantity"  onclick="decrementValue()"  class="qtyminus" data-product-id="'. $val["id"] .'" />
                                </div> 
                                <div class="col-4 col-sm-1">
                                    <input type="text" style="width: 30px; text-align:center;" class="input-number" name="quantity"  class="qty" value="1"/>      
                                </div>
                                <div class="col-4 col-sm-1">
                                    <input type="button" style="width: 30px;" value="+" class="qtyplus" onclick="incrementValue()" field="quantity" data-product-id="'.$val['id'].'" />
                                </div> 
                                   
                                <div class="col-4 col-sm-2 mb-1">
                                    <button class="btn btn-primary" >
                                        <span id="product-total-price"
                                        data-price ="'.$val["price"].'">
                                           '.$val["price"].'
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-1">
                                       <button class="btn btn-danger"
                                            id="delete-product" onclick="deleteItemById('.$val["id"].')" >
                                            x
                                        </button>
                                </div>
                
                          </div>';
}

    }else{
        echo 'xxxxxempty';
        
    }

    
}

    

?>