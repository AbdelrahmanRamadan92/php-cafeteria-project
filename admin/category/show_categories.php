<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
    //   /require_once('Category.php');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Category.php';
    //   require_once('Auth.php');
      require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Auth.php';
      $categories=Category::get();
?>

<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Categories</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Categories</p>
            </div>
        </div>
    </div>
    <div class="container my-4">
    <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        
      </tr>
    </thead>
    <tbody>


<?php foreach ($categories as $categoy):
                    # code...
?>
      <tr>
        <th><?php echo $categoy['id']?></th>
        <td><?php echo $categoy['name']?></td>
       
        <td>
                <form action="../category/edit" method="POST">
                    <input style="display:none;" name="id" value="<?php echo $categoy['id'] ?>">
            	    <button type="submit" class="btn btn-primary"> Edit </button>
                </form>
            
            	<form action="../category/delete" method="POST">
                    <input style="display:none;" name="id" value="<?php echo $categoy['id'] ?>">
            	    <button type="submit" class="btn btn-primary"> delete </button>
                </form>
        </td>
      </tr>
      <?php
         endforeach
         ?>
    </tbody>
  </table>
      </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>