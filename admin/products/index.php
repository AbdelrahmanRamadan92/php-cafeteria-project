<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
$data = DB::getAll("product");

 require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
 include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
 

?>

<title>All products</title>
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
<link rel="stylesheet" href="../../assets/css/products.css" />


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


    <h1> All Products </h1>
    <!-- table Start -->
    <div class="container">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>        
                </tr>
            </thead>
            <tbody>
                <?php
                    $index = 1;
                    foreach($data as $key => $value):
                ?>
                <tr>
                    <td><?php echo $index++ ?></td>
                    <td><?php echo $value["name"];?></td>
                    <td><?php echo $value["price"];?></td>
                    <td><img src="../../assets/img/<?php echo $value["image"];?>" alt="image" width="50px" height="50px"></td>
                    <td>
                        
                    	<!--<button type="button" class="btn btn-primary available" data-id="<?php echo $value['id'] ?>" ><?php echo $value["avilable"] ? "Available" : "Unavailable"?></button>-->
                    	
                    	<form action="available" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                            <input  class="btn btn-secondary" type="submit"  value="<?php echo $value["avilable"] ? "Available" : "Unavailable"?>">
                        </form>                    	
                    	
                    	
                    	<form action="editproduct" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                            <input  class="btn btn-secondary" type="submit"  value="Edite">
                        </form>
                        <form action="delproduct" method="post">
                            <input type="hidden" name="id" value="<?php echo $value['id'];?>">
                            <input  class="btn btn-danger" type="submit"  value="Delete">
                        </form>
                        
                        
                        <!--<button type="button"class="btn btn-danger delete" data-id="<?php echo $value['id'] ?>" >Delete </button>                    -->

                    
                    	
                    	 <!--<button class="btn btn-danger" id="delete-product" onclick="deleteItemadmin(<?php echo $value['id']; ?>)" >-->
                      <!--   Delete-->
                      <!--  </button>-->
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    </div>
    <!-- table end -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="addproduct.js"></script>
    <script src="<?php echo $full_path;?>/admin/products/delete.js"></script>
    <?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>
</body>
</html>