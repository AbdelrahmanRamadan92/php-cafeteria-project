<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/layout/navbar.php';
?>
<section id="formSection">
  <?php
//session_start();
  // var_dump('cnxllncxln');
if (isset($_SESSION['errors'])) {

	echo '<div class="alert alert-danger">';
	foreach ($_SESSION['errors'] as $error) {
		echo "<div>{$error}</div>";
	}
	echo '</div>';
	unset($_SESSION['errors']);
}

?>

<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">login</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Login</p>
            </div>
        </div>
    </div>
<div class="container align-content-center">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col col-md-6 p-3">
          <div class="outForm w-75 border-1 p-2 p-lg-5 p-3 m-auto mb-5 rounded">
            <form action="login_process" method="post" class="p-0">
              <div class="input-group mb-2">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                  aria-describedby="emailFeedback" />
                <div id="userNameFeedback" class="invalid-feedback">
                  Please enter valid Email.
                </div>
              </div>

              <div class="input-group mb-2">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                  aria-describedby="passwordFeedback" />
                <div id="passwordFeedback" class="invalid-feedback">
                  Password must be 8 chars at least and at least 1 capital
                  letter , 1 small , 1 number .
                </div>
              </div>

              <div class="col-12">
                <button class="btn btn-primary" type="submit">
                  Submit form
                </button>
                <button class="btn btn-primary mt-2" type="reset">
                  reset
                </button>
              <!--  <a href="login2.html">
                  <h6 class="pt-2">Forgit Password ?</h6>
                </a>-->
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <script src="./assets/js/login.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
    <?php
include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>