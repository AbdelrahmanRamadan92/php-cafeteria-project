<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
    include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/order.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product_order.php';
?>

    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Orders</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Orders</p>
            </div>
        </div>
    </div>
   
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="row"></div>
        </div>
        
        <div class="pagination">    
             <?php  $corders = Order::getWith("*", "users" , "user_id=users.id AND status != 'Delivered' AND status != 'Canceled'" ,null);
                Order::paginate(count( $corders) , 2 ,"showOrdersPage"); ?>    
         </div> 
    </div>

    <script src="assets/js/checks.js"></script>
    <script>showOrdersPage(1);</script>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';?>


   