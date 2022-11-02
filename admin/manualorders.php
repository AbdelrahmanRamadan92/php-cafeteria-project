<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';

 include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
 include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product_order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/cart.php';

$all_users = Order::getWith("orders.user_id ,name","users" , "orders.user_id = users.id" , " orders.user_id");

require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/isAdmin.php';
$admin = is_admin();
if (!$admin) {
    header('location:home.php'); 
}

?>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Manual Order</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Manual Order</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
        
    <!-- page Header End -->  
 
    <!-- Service Start --> 
    <style>
        div#myDIV {
    width: 80%;
    text-align: center;
    background-color: #da9f5b2e;
    margin: auto;
    padding: 30px;
}

.singleItem button {
    background-color: transparent;
    height: 29px;
    line-height: 0;
    background-color: #795548;
    border-radius: 5px;
    color: #fff;
    border: 1px solid #795548;
}
.row{
    margin-right: 0;
    margin-left: 0;
}
    </style>
    <div class="container-fluid">
        <div class="row">
            <!--the Bill-->
            <div class="col-lg-4">
                <div id="myDIV">     
                       
                    <div class="row">
                    <div class="products-cart w-100">

                  <?php  $cartItems = Cart::getByCondd("product" , ["user_id"=>2 , "cart.product_id"=>"product.id"]) ;
                    foreach($cartItems as $product_data):?>
                        <div class="singleItem d-flex w-100 justify-content-between" p-id="<?php echo $product_data['id'];?>">
                            <h5><?php echo $product_data["name"]; ?></h5>
                            <button onclick="decrease()">-</button>
                            <p class="quantity"><?php echo $product_data["quantity"]; ?></p>
                            <button class="increase" onclick="increase()">+</button>
                            <p class="price"><?php echo $product_data["price"];?> EGP</p>
                            <button onclick="removeFromCart(<?php echo $product_data['id']; ?>)">X</button>
                        </div>
                    <?php endforeach;?>

                        </div>
                                    
                        <form action="">
                            <textarea name="message" style=" height: 100px;" class="form-control" id="message" placeholder="Your message..." required></textarea>
                        </form>
                    </div>
                    
                    <div class="row">      
                        <div class="form-group">
                            <select class="custom-select bg-transparent border-primary" style="height: 49px;">
                                    <option selected>Room</option>
                                    <option value="1">Room 1</option>   
                                </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="mFunction()">
                        </div>

                            
                        <div class="col-sm-2 offset-3">
                            <h3>Total</h3>
                        </div>
                        <div class="col-sm-3"> 
                            <button class="btn btn-primary">
                                <span class="product-maxtotal-price" data-price="24.99"></span>
                            </button>
                                    
                        </div>
                        </div>
                            </div>    
                            </div> 
            <!---->
            <!--products-->


           


            <div class="col-lg-8">
            <form method="POST" action="checks.php">
                <label for="user">Add to User</label>
                           <select id="users" name="users" onchange="">    
                                <?php foreach($all_users as $k):?>
                                    <option value=<?php echo $k['user_id'];?>><?php echo $k['name'];?></option>
                                <?php endforeach;?>
                            </select>
                    </form>
                <div class="row align-items-center">
                    <?php      
                    $products = Product::get();          
                    foreach ($products as $single): ?> 
                    <div class="row align-items-center mt-5 col-md-3 col-sm-6" >
                        <div class="col-4 col-sm-4">
                            <img style="width: 90px;"  class="rounded-pill m-md-n4" src="<?php echo $single['image'] ?>"alt="">
                            <h5 class="menu-price m-lg-n4"><?php echo $single['price'] ?></h5>
                        </div>
                        <div class="col-8 col-sm-8">
                            <h4 class="ml-1"><?php echo $single['name'] ?></h4>
                            <span><?php echo $single['avilable'] ?> </span>    
                                <div>
                                    <button class="btn btn-primary m-2 single" onclick="addToCartAdmin(<?php echo $single['id']; ?> )" >
                                    Add
                                    </button>
                                </div>  
                        </div>
                    </div> 
                     <?php  endforeach; ?>
                <!---->   
            </div>        
    </div>

   <?php
   
require $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
   ?>
   <script src="assets/js/manualOrder.js"></script>

    <script src="assets/js/checks.js"></script>
