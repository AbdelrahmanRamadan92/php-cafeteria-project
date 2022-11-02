
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Auth.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/userMidelware.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product_order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/order.php';
$user_id =Auth::id();
include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
$corders = Order::getWhere(["user_id"=> $user_id]);
?>
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">My Orders</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">My Orders</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<?php
if(count( $corders)==0){
    echo '<div class="container"><p style="text-align:center"> You donot have any orders now</p></div>';
}
else{
?>


<div class="container">
    <div class="row text-center ">
      <form method="POST">
        <div class="col-12 col-sm-12 col-md-6 d-inline">
            <input type="date" id="from" class="p-1 text-center mr-1" type="text" name="from"  onchange="filterDateUser()" value="<?php echo isset($_POST['from']) ? $_POST['from'] : '' ?>" /> 
            <label for="from"><i class="bi bi-calendar-check-fill date"></i></label>  
        </div>
        <div class="col-12 col-sm-12 col-md-6 d-inline ">
              <input  type="date" id="to" class="p-1 text-center mr-1 " type="text" name="to"  onchange="filterDateUser()" value="<?php echo isset($_POST['to']) ? $_POST['to'] : '' ?>" />
              <label for="to"><i class="bi bi-calendar-check-fill date"></i></label>
        </div>
      </form>
    </div>

    <div class="row mt-5 table-responsive">
        
        <table class="table table-bordered">
            <thead>
              <tr>          
                <th scope="col">Order Date</th>
                <th scope="col">Status</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
           
            </tbody>
          </table>
    </div>
             
    <div class="order-items my-orders m-auto d-none" id="orders">
      <div class="row m-0"></div>
    </div>
              
        <div class="pagination">    
             <?php  Order::paginate(count( $corders) , 2 , "showMyOrdersPage"); ?>    
         </div> 
</div>
<?php } ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="assets/js/checks.js"></script>
<script>showMyOrdersPage(1);</script>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';?>
