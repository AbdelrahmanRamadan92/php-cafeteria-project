
 <!-- Navbar Start -->
 <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.html" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">KOPPEE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">

                <?php if((Auth::check() && Auth::user()['role'] != 'admin')){?>


                    <a href="/" class="nav-item nav-link ">Home</a>
                    <a href="/products" class="nav-item nav-link">Products</a>
                    <a href="/myorders" class="nav-item nav-link">My Orders</a>
                   <!-- <a href="logout.php" class="nav-item nav-link">Logout</a>-->

               <?php }
                    else if($admin) {?>

                    <a href="/" class="nav-item nav-link ">Home</a>

                    <div class="dropdown-custom">
                        <button>Users</button>
                        <div class="dropdown-content">
                            <a rel="noopener" target="_blank" href="/users">All User</a>
                            <a rel="noopener" target="_blank" href="/adduser">Add User</a>
                        </div>
                    </div>


                        <div class="dropdown-custom">
                        <button>Products</button>
                        <div class="dropdown-content">
                            <a rel="noopener" target="_blank" href="/allproducts">All Products</a>
                            <a rel="noopener" target="_blank" href="/createproduct">Add Product</a>
                        </div>
                    </div>



                    <div class="dropdown-custom">
                        <button>Orders</button>
                        <div class="dropdown-content">
                            <a rel="noopener" target="_blank" href="/manualorders">Manual Orders</a>
                            <a rel="noopener" target="_blank" href="/checks">Checks</a>
                         <a rel="noopener" target="_blank" href="/orders">Orders</a>

                        </div>
                    </div>
                    
                   
                    <div class="dropdown-custom">
                        <button>Categories</button>
                        <div class="dropdown-content">
                            <a rel="noopener" target="_blank" href="/showcategories">All Categories</a>
                            <a rel="noopener" target="_blank" href="/createcategory">Add Category</a>
                        </div>
                    </div>
                   <!-- <a href="logout.php" class="nav-item nav-link">Logout</a>-->

            <?php }
           
                    
                if(Auth::check()){
                    
                    ?>
                    <a href="/logout" class="nav-item nav-link">Logout</a>

                    <?php } else {?>
                        <a href="/login" class="nav-item nav-link">Login</a>
                        <a href="/register" class="nav-item nav-link">Register</a>

                <?php } ?>

                </div>
            </div>
        </nav>
</div>
    <!-- Navbar End -->

    <!-- require -->
    