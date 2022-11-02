<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/connection.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/functions.php';

$data = DB::getAll("categories");

   if($_SERVER['REQUEST_METHOD'] == "POST"){
      $Message = [];
      $id  = $_POST['id'];
    //   var_dump($id);
      if(!Validator($id,3)){
        $Message['id'] = "Invalid ID";
        $_SESSION['messages'] = $Message;
       header("Location: allproducts");
       }
       $product = DB::findtById("product",$id);
    //    var_dump($product);
    };
 require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
?>
<title> Edit Product</title>
<link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
<link rel="stylesheet" href="../../assets/css/products.css" />
</head>
<?php 
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';

?>


<div class="container-fluid">

                  
</ol>
<form method="POST" action = "updateproduct" enctype ="multipart/form-data" class="mx-auto mt-4" name="form1" style="width: 350px">
      <h1 class="p-2">Update Product</h1>
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

      <label for="id1">PRODUCT</label>
      <input type="hidden" name="id" value="<?php echo $product['id']?>" />
      <input class="form-control" id="id1" type="text" name="name" required value="<?php echo $product['name']?>" />

      <label for="id3">PRICE</label>
      <input class="form-control" id="id3" min="1" type="number" name="price" required value="<?php echo $product['price']?>"/>

      <div class="form-group">
        <label for="inputState">CATEGORY</label>         <a id="replyb" class="category btn btn-primary"> ADD CATEGORY </a>
        <select id="inputState" class="form-control" name ="category_id" required>
          <?php foreach($data as $key => $value):?> 
          <option value="<?php echo $value['id'];?> <?php if($value['id'] == $product['category_id'] ){ echo 'selected';}?> "> <?php echo $value['name'];?> </option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="formFile" class="form-label">PRODUCT PICTURE</label>
        <input class="form-control p-3" name="image" type="file" id="formFile" accept="image/png ,image/jpg"  />
        <img src="../../assets/img/<?php echo $product['image'];?>"  width="70px" height="70px">
        <input type="hidden" name = "OldImage" value="<?php echo $product['image'];?>">
    </div>
      <div >
        <input name="submit" type="submit" value="Update" class="btn btn-success"> 
      </div>
    </form>
</div>    
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