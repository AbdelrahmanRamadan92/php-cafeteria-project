<?php


/********************* HTML ORDER PAGE ******************************/
function returnOrders($orders,$page){

$enumVal = Order::getEnumVal();

foreach ($orders as $single_order) :?>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Order id</th><th>Order Date</th><th>Name</th><th>Room</th><th>EXT</th><th>Action</th>
            </tr>
        </thead>
                <tbody>
                    <tr order_id="<?php echo $single_order['order_id']; ?>">
                        <td><?php echo $single_order['order_id']; ?></td>
                        <td><?php echo $single_order['created_at']; ?></td>
                        <td><?php echo $single_order['name']; ?></td>
                        <td><?php echo $single_order['room']; ?></td>
                        <td><?php echo $single_order['ext']; ?></td>
                        <td>                                  
                            <form method="POST">
                                <select name="status" id="status">
                                    <?php foreach($enumVal as $val): 
                                        if($single_order['status']==$val){?>
                                            <option value="<?php echo $val?>" selected><?php echo $val; ?></option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $val?>"><?php echo $val; ?></option><?php }?>
                                    <?php endforeach;?>
                                </select>
                                <input type="button" value="submit" name="updateStatus" onclick="updateStatusHandle(<?php echo $single_order['order_id'] .','. $page?> )">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="order-content w-100" order_num="<?php echo $single_order['order_id']; ?>">
                <div class="row m-0">
                    <?php $order_items = ProductOrder::getByOrderId("product_order.price , name , amount",$single_order['order_id']);
                    foreach ($order_items as $single_item) : ?>
                            <div class="col-md-2 text-center single-order-product">
                                <img width="130" src='http://localhost/phpProject-main/phpProject-main/img/menu-3.jpg' class="position-relative" alt="">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-num">
                                    <span class="visually-hidden"><?php echo $single_item['price']; ?></span>
                                </span>
                                <p><?php echo $single_item['name']; ?></p>
                                <span class="amount"><?php echo $single_item['amount']; ?></span>
                            </div>
                    <?php endforeach; ?>
                </div>
                <div class="total">
                    <p> Total : <?php echo $single_order['total']; ?> LE</p>
                </div>
            </div>
        <?php endforeach;  
}

/********************* HTML ORDER PAGE ******************************/
function returnMyOrders($orders,$page){

     foreach ($orders as $single_order) : ?>
        <tr order_id="<?php echo $single_order['id'];?>">
          <th class="pointer"  scope="row">
          
              <?php echo $single_order['created_at'];?>
              <button type="button" class="btn btn-warning float-right btn-floating rounded pluse" data-mdb-ripple-color="dark" onclick="showOrderProductss(<?php echo $single_order['id1']; ?>)">
                  <i class="bi bi-plus" style="font-size: 24px;"></i>
                </button>     
          </th>
          <td class="status"><?php echo $single_order['status'];?></td>
          <td><?php echo $single_order['total'];?></td>
          <?php if($single_order['status']=="Processing"){?>
              <td class="text-center btns-del">
                  <button type="button" class="btn btn-danger rounded" onclick="cancelOrder(<?php echo $single_order['id'];?>)">Cancel</button>
              </td>
              <?php }else if($single_order['status']=="Canceled"){?>
                <td  class="text-center btns-del"> 
                    <button type="button" class="btn btn-primary rounded" onclick="reOrder(<?php echo $single_order['id'];?>)">Reorder</button>
                    <button type="button" class="btn btn-danger rounded" onclick="deleteOrder(<?php echo $single_order['id'];?>)">Delete</button>
                  </td>
          <?php }else echo '
          <td></td>
        </tr>';
       endforeach;

}

/********************* return My Checks ******************************/
function returnMyChecks($orders){
     $i =1 ;foreach($orders as $order):?>
        <tr>
            <td><?php echo $order['name'];?></td>
            <td><?php echo $order['total_amount'];?></td>
            <td><button type="button" class="btn btn-primary btn-custom" onclick="showOrder(<?php echo $order['user_id']; ?> )">View Orders</button></td>
        </tr>
    <?php endforeach;
}