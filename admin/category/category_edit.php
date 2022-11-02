<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';

  
// require_once('Category.php');
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Category.php';

$category=Category::get_Category($_REQUEST['id']);
// var_dump($category);


?>

  <?php
//session_start();
if (isset($_SESSION['errors'])) {
	echo '<div class="alert alert-danger">';
	foreach ($_SESSION['errors'] as $error) {
		echo "<div>{$error}</div>";
	}
	echo '</div>';
	unset($_SESSION['errors']);
}?>

<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Upate Category</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Upate Category</p>
            </div>
        </div>
    </div>
    <form class="mx-auto mt-4" name="form1" style="width: 350px" method="post" action="../categoryedite">
      <h1 class="p-2 mt-5">Add  category</h1>
      
      <label for="id1" class="mt-5">Add New Category</label>
      <input  name="id"  id="id" style="display:none ;" type="text" placeholder="id" value="<?= $category['id']?>"> 
      <input class="form-control mt-5" id="id1" name="name" value="<?php echo $category['name']?>" type="text" required />

      </div>
      <input type="submit" value="SAVE" class="btn mt-3 btn-success" />

        <input type="reset" value="RESET" class="btn mt-3 btn-success" />
    </form>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="addproduct.js"></script>
    <?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>