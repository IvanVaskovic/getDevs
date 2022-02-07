<?php 
  include_once ('./initdb.php');
  session_start();

  //if email(user) already in session
  if (isset($_SESSION['email'])) {
    header('Location: ./home.php');
  }

  //if cookie already set
  if (isset($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];
    $user = $conn->getUser($_POST['email']);
    $_SESSION['user_type'] = $user['user_type'];
    if ($_SESSION['user_type'] == 'dev') $_SESSION['id'] = $user['dev_id'];
    if ($_SESSION['user_type'] == 'campany') $_SESSION['id'] = $user['company_id'];
    header('Location: ./home.php');
  }

  //if user just logged in
  if (isset($_POST['email']) && isset($_POST['pass'])) {
    if ($conn->validateUser($_POST['email'], $_POST['pass'])) {
      // if keep me logged in is checked
      if (isset($_POST['keep'])) {
        setcookie('email',$_POST['email'],time()+60*60*7);
      }

      $_SESSION['email'] = $_POST['email'];
      $user = $conn->getUser($_POST['email']);
      $_SESSION['user_type'] = $user['user_type'];

      if ($_SESSION['user_type'] == 'dev') $_SESSION['id'] = $user['dev_id'];
      if ($_SESSION['user_type'] == 'campany') $_SESSION['id'] = $user['company_id'];

      unset($_SESSION['proced']);
      header('Location: ./home.php');
    }
    $error = true;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>getDev(s)</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo_icon.png" type="image/x-icon" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo_text_index.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <?php 
                if (isset($_SESSION['proced'])) {
                  echo "<h6 class=\"text-success\">". $_SESSION['proced'] ."</h6>";
                } else {
                  echo "<h6 class=\"font-weight-light\">Log in to continue.</h6>";
                }
              ?>
              <form class="pt-3" action="./login.php" method="POST">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Password">
                </div>
                <?php 
                  if (isset($error) && $error) {
                    echo "<h6 class=\"font-weight-light\" style='text-align: center;' id=\"error\">E-mail or password incorrect, please try again!</h6>";
                  }
                ?>
                <div class="mt-3">
                  <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="LOG IN"/>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" name="keep" id="keep">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <br>
                  <div style="display:flex; justify-content:space-evenly;">
                  <a href="./register_dev.php" class="text-primary">Register as <span class="font-weight-bold">Dev</span></a>
                  <a href="./register_company.php" class="text-primary">Sign Up your <span class="font-weight-bold">Company</span></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>

<?php 
  // unset($_SESSION['proced']);
?>
