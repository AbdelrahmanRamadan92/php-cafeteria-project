<?php

include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';

$data = DB::getAll("categories");


require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/isAdmin.php';

$admin = is_admin();
if (!$admin) {
  
    header("Location: 'home'"); 
}
?>
<title>Add New Product</title>
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
<link rel="stylesheet" href="../../assets/css/products.css" /><?php 
?>
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Add Product</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Add Product</p>
            </div>
        </div>
    </div>

<form method="POST" action = "addproduct" enctype ="multipart/form-data" class="mx-auto mt-4" name="form1" style="width: 350px">
      <h1 class="p-2">Add New Product</h1>
      <ol class="breadcrumb mb-4">
    <?php 
                        
    if(isset($_SESSION['messages'])){

          foreach($_SESSION['messages'] as $key =>  $errorrs){

        echo '* '.$key.' : '.$errorrs.'<br>';
        }

          unset($_SESSION['messages']);
    }else{
?>
<?php } ?>
                  
</ol>

      <label for="id1">PRODUCT</label>
      <input class="form-control" id="id1" type="text" name="name" required />

      <label for="id3">PRICE</label>
      <input class="form-control" id="id3" min="1" type="number" name="price" required />

      <div class="form-group">
        <label for="inputState">CATEGORY</label>         <a id="replyb" href="createcategory" class="category btn btn-primary"> ADD CATEGORY </a>
        <select id="inputState" class="form-control" name ="category_id" required>
          <?php foreach($data as $key => $value):?> 
          <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">PRODUCT PICTURE</label>
        <input class="form-control p-3" name="image" type="file" id="formFile" accept="image/png ,image/jpg" required />
      </div>
      <div >
        <input name="submit" type="submit" value="Add" class="btn btn-success"> 
      </div>
    </form>
<?php
include('footer.php');
?>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="addproduct.js"></script>
</body>
</html>