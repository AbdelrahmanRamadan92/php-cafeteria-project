<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/order.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/product_order.php';


$all_users = Order::getWith("orders.user_id ,name","users" , "orders.user_id = users.id" , " orders.user_id");
$corders = Order::getWith("orders.user_id ,name, sum(total) as total_amount","users" , "orders.user_id = users.id AND orders.status ='Delivered'" , " orders.user_id");


?>
<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
  <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
    <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Checks</h1>
    <div class="d-inline-flex mb-lg-5">
      <p class="m-0 text-white">
        <a class="text-white" href="">Home</a>
      </p>
      <p class="m-0 text-white px-2">/</p>
      <p class="m-0 text-white">Checks</p>
    </div>
  </div>
</div>
<!-- Page Header End --> <?php 
if(count($corders)==0){
    echo '
<p style="text-align:center"> There is no delivered orders now </p>';
}
else {?>
<!-- Contact Start -->
<div class="container-fluid pt-5 checks">
  <div class="container">
    <div class="row m-0">
      <div class="date-filter">
        <form method="POST" action="checks.php">
          <label for="from">From:</label>
          <input type="date" id="from" name="from" onchange="filterDate()" value="
						<?php echo isset($_POST['from']) ? $_POST['from'] : '' ?>">
          <label for="to">To:</label>
          <input type="date" id="to" name="to" onchange="filterDate()" value="
							<?php echo isset($_POST['to']) ? $_POST['to'] : '' ?>">
          <select id="users" name="users" onchange="filterDate()">
            <option value="-1">all</option> <?php foreach($all_users as $k):?> <option value=<?php echo $k['user_id'];?>> <?php echo $k['name'];?> </option> <?php endforeach;?>
          </select>
        </form>
      </div>
      <table class="table text-center table1-orders">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <div class="table2-content  w-75 m-auto" style="display:none">
        <table class="table table2 text-center">
          <thead>
            <tr>
              <th scope="col">Order Date</th>
              <th scope="col">Total Amount</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div class="order-items w-75 m-auto">
        <div class="row m-0"></div>
      </div>
    </div>
    <div class="pagination"> 
        <?php Order::paginate(count( $corders) , 2 ,"showChecksPage"); ?> 
    </div>
  </div>
</div> <?php }?>
<!-- Contact End -->
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
  <i class="fa fa-angle-double-up"></i>
</a>


<script src="assets/js/checks.js"></script>
<script>
  showChecksPage(1)
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';?>