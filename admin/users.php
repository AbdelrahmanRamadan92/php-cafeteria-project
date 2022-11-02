<?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/adminMidelware.php';
include $_SERVER['DOCUMENT_ROOT'] .'/layout/header.php';
include $_SERVER['DOCUMENT_ROOT']  . '/layout/navbar.php';
 require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/user.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/helpers/isAdmin.php';

//  require_once $_SERVER['DOCUMENT_ROOT'] . 'isAdmin.php';

?>

<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Users</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">All Users</p>
            </div>
        </div>
    </div>
   <div class="container">
    <!-- table Start -->
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Name</th>
                    <th>Room</th>
                    <th>Image</th>
                    <th>Ext</th>
                    <th>Action</th>        
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):
                    # code...
                 ?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['room'] ?></td>
                    <td><img src="<?php echo $user['image'] ?>" alt="image" width="50px" height="50px"></td>
                    <td><?php echo $user['ext'] ?></td>
                    <td>
                        <form action="../users/edit" method="POST">
                            <input style="display:none;" name="id" value="<?php echo $user['id'] ?>">
                    	    <button type="submit" class="btn btn-primary"> Edit </button>
                        </form>
                    	<!--<a class="btn btn-primary" href="edit.php?id=<?php echo $user['id'] ?>"> Edite</a> -->
                    	<form action="../users/delete" method="POST">
                            <input style="display:none;" name="id" value="<?php echo $user['id'] ?>">
                    	    <button type="submit" class="btn btn-primary"> delete </button>
                        </form>
                    	<!--<button type="button" class="btn btn-primary delete"  data-id="<?php echo $user['id'] ?>" > Delete </button>-->
                    </td>
                </tr>
                <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <!-- table end -->
   <script src="./assets/js/show_users.js"></script>
    
<?php
include $_SERVER['DOCUMENT_ROOT'].'/layout/footer.php';
?>