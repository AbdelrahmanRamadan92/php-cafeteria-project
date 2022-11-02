<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/cart.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
$user_id = $_SESSION["user_id"] ;

$full = 'https://cafeteria-new.000webhostapp.com/assets/img/';
?>
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Products</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Products</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!-- <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h4>
                <h1 class="display-4">Serving Since 1950</h1>
            </div>
        </div>
    </div>     -->
    <form action="" method="GET">
            <div class="input-group" style="width: 300px; margin-left: 900px;" >
                <input  type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>"   class="form-control"  placeholder=" Search">
                <button class="btn btn-primary">
                      Search
                </button>
            </div>
    </form>
                          
 
    <!-- Service Start --> 
    <div class="container-fluid">
        <div class="row">
            <!--the Bill-->
             <div class="col-lg-5 mt-4">
               
                <?php 
                     $order_product = Cart::getByCondd("product",["user_id"=>$user_id,"product.id"=>"product_id"]); 
                     if(count($order_product)==0){?>
                     
                      <div class=" row align-items-center mb-3 col-sm-12  empty-data" style="background-color:#da9f5b1f;height: 100%;text-align: center;">
                   <p class="w-100"> Your cart is empty now</p>
                </div>
                
                                <div id="myDIV" style="display:none">  
                    <div class="products-continerx">
                      <?php   
                      foreach ($order_product as $val): ?>   
                       <div class="row align-items-center mb-3 col-sm-12 mt-2"id="showproduct" p-id="<?php echo $val['id'] ?>">
                                <div class="col-4 col-sm-3 ">
        <img style="width: 100%;"   src="<?php echo $full.$val['image'] ?>"alt="">           

                                </div>
                                <div class="col-4 col-sm-3">
                                     <h4><?php echo $val['name'] ?></h4>
                                </div>
                                   
                                <div class="col-sm-1 ">
                                    <input type='button' style="width: 30px;" value='-' field='quantity'  onclick="decrementValue()"  class='qtyminus' data-product-id="<?php echo $val['id']; ?>" />
                                </div> 
                                <div class="col-4 col-sm-1">
                                    <input type='text' style="width: 30px; text-align:center;" class="input-number" name='quantity'  class='qty' value="<?php echo $val['quantity']; ?>"/>      
                                </div>
                                <div class="col-4 col-sm-1">
                                    <input type='button' style="width: 30px;" value='+' class='qtyplus' onclick="incrementValue()" field='quantity' data-product-id="<?php echo $val['id']; ?>" />
                                </div> 
                                   
                                <div class="col-4 col-sm-2 mb-1">
                                    <button class="btn btn-primary" >
                                        <span id="product-total-price"
                                        data-price =  <?php echo $val['price']  ?>>
                                            <?php echo $val['price']  ?>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-1">
                                       <button class="btn btn-danger"
                                            id="delete-product" onclick="deleteItem(<?php echo $val['id']; ?>)" >
                                            x
                                        </button>
                                </div>
                
                          </div>    
                          <?php endforeach; ?>
                        </div>
                        <div class="row align-items-center col-sm-12">
                                    
                                <form action="">
                                        <textarea name="message" style="width: 300; height: 100px; margin-left:85px;" class="form-control" id="message" placeholder="Your message..." required></textarea>
                                </form>
                        </div>
                        <div class="row align-items-center col-sm-12 mt-2">      
                            <span>Room : <?php echo User::get_user($user_id)["room"];?></span>
                        </div>
                            <hr>
                        <div class="row align-items-center col-sm-12 mt-2">
                                <div class="col-sm-4">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="mFunction()">
                                </div>

                            
                                <div class="col-sm-2 offset-3">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-sm-3"> 
                                    <button class="btn btn-primary">
                                        <?php  $totals = Cart::getTotal($user_id); $total = $totals[0]["total"];?>
                                        <span class="product-maxtotal-price" data-price="<?php echo $total;?>">
                                            <?php echo $total;?>
                                        </span>

                                    </button>
                                </div>
                        </div>
                </div>  

                     
                <?php } else{?>
                <div id="myDIV">  
                    <div class="products-continerx">
                      <?php   
                      foreach ($order_product as $val): ?>   
                       <div class="row align-items-center mb-3 col-sm-12 mt-2"id="showproduct" p-id="<?php echo $val['id'] ?>">
                                <div class="col-4 col-sm-3 ">
                                    <img style="width: 100%;"   src="<?php echo  $full .$val['image'] ?>"alt="">           

                                </div>
                                <div class="col-4 col-sm-3">
                                     <h4><?php echo $val['name'] ?></h4>
                                </div>
                                   
                                <div class="col-sm-1 ">
                                    <input type='button' style="width: 30px;" value='-' field='quantity'  onclick="decrementValue()"  class='qtyminus' data-product-id="<?php echo $val['id']; ?>" />
                                </div> 
                                <div class="col-4 col-sm-1">
                                    <input type='text' style="width: 30px; text-align:center;" class="input-number" name='quantity'  class='qty' value="<?php echo $val['quantity']; ?>"/>      
                                </div>
                                <div class="col-4 col-sm-1">
                                    <input type='button' style="width: 30px;" value='+' class='qtyplus' onclick="incrementValue()" field='quantity' data-product-id="<?php echo $val['id']; ?>" />
                                </div> 
                                   
                                <div class="col-4 col-sm-2 mb-1">
                                    <button class="btn btn-primary" >
                                        <span id="product-total-price"
                                        data-price =  <?php echo $val['price']  ?>>
                                            <?php echo $val['price']  ?>
                                        </span>
                                    </button>
                                </div>
                                <div class="col-sm-1">
                                       <button class="btn btn-danger"
                                            id="delete-product" onclick="deleteItem(<?php echo $val['id']; ?>)" >
                                            x
                                        </button>
                                </div>
                
                          </div>    
                          <?php endforeach; ?>
                        </div>
                        <div class="row align-items-center col-sm-12">
                                    
                                <form action="">
                                        <textarea name="message" style="width: 300; height: 100px; margin-left:85px;" class="form-control" id="message" placeholder="Your message..." required></textarea>
                                </form>
                        </div>
                        <div class="row align-items-center col-sm-12 mt-2">      
                            <span>Room : <?php echo User::get_user($user_id)["room"];?></span>
                        </div>
                            <hr>
                        <div class="row align-items-center col-sm-12 mt-2">
                                <div class="col-sm-4">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" onclick="mFunction()">
                                </div>

                            
                                <div class="col-sm-2 offset-3">
                                    <h3>Total</h3>
                                </div>
                                <div class="col-sm-3"> 
                                    <button class="btn btn-primary">
                                        <?php  $totals = Cart::getTotal($user_id); $total = $totals[0]["total"];?>
                                        <span class="product-maxtotal-price" data-price="<?php echo $total;?>">
                                            <?php echo $total;?>
                                        </span>

                                    </button>
                                </div>
                        </div>
                </div>  
               <?php } ?>
                
            </div> 
            <!---->
            <!--products-->
            <?php
            if(isset($_GET['search'])){
        $filtervalues = $_GET['search'];
        $singleitem = Product::getsearch( $filtervalues);
         
        
       // foreach($search as $singleitem):
?>
            <div class="col-lg-7">
            <div class="row align-items-center mb-5 ml-2">
                   
                <div class="row align-items-center mt-5 col-sm-6 mr-1" >
                    <div class="col-4 col-sm-4">
                    <img style="width: 130px;"  class="rounded-pill m-md-n4" 
                    src="<?php echo $full. $singleitem['image'] ?>"alt="">                     
                    <h5 class="menu-price m-lg-n4">$<?php  echo $singleitem['price'] ?></h5>
                    </div>
                    <div class="col-8 col-sm-8">
                        <h4 class="ml-1"><?php echo $singleitem['name'] ?></h4>
                        <span><?php echo $singleitem['avilable'] ?> </span>    
                        <div>
                                    <input type="hidden" name="product_id" 
                                      value="<?php echo $singleitem["id"]; ?>">
                                      <?php if($singleitem['avilable']){?>
                                    <button class="btn btn-primary m-2 single" onclick="newxxxcreateorder(<?php echo $singleitem['id'] ?>)">
                                    Order
                                    </button>
                                    <?php }?>

                            </div>  
                    </div>
                </div> 
            </div>
            </div>

  <?php

        }
        else 
        {

            
?>
            <div class="col-lg-7">
                <div class="row align-items-center mb-5 ml-2">
                    <?php      
                   $products = DB::getAll('product');
                       
                   foreach ($products as $single): ?> 
                    <div class="row align-items-center mt-5 col-sm-6 mr-1" >
                        <div class="col-4 col-sm-4 jj">
                        <img style="width: 130px;"  class="rounded-pill m-md-n4" 
                        src="<?php   echo $full. $single['image'] ?>"alt="">                     
                        <h5 class="menu-price m-lg-n4">$<?php  echo $single['price'] ?></h5>
                        </div>
                        <div class="col-8 col-sm-8">
                            <h4 class="ml-1"><?php echo $single['name'] ?></h4>
                            <span><?php echo $single['avilable'] ?> </span>    
                            <div>
                                        <input type="hidden" name="product_id" 
                                          value="<?php echo $single["id"]; ?>">
                                          <?php if($single['avilable']){?>
                                        <button class="btn btn-primary m-2 single" onclick="newxxxcreateorder(<?php echo $single['id'] ?>)">
                                        Order
                                        </button>
                                        <?php }?>

                                </div>  
                        </div>
                    </div>  <?php  endforeach; 

        
        

        }
        ?>



                <!---->   
            </div>        
    </div>
    
   
</div>

</div>
    <!-- Footer Start -->

<script src="<?php echo $full_path;?>/assets/js/product.js"></script>
    <script src="assets/js/checks.js"></script>

   <?php  require $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>