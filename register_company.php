<?php
include_once('./initdb.php');
session_start();

//if email(user) already in session
if (isset($_SESSION['email'])) {
  header('Location: ./home.php');
}

//if cookie already set
if (isset($_COOKIE['email'])) {
  $_SESSION['email'] = $_COOKIE['email'];
  header('Location: ./home.php');
}

//company registration
if (isset($_POST['submit'])) {
  
  try {
    if ($conn->registerCompany($_POST['name'], $_POST['owner'], $_POST['email'], $_POST['pass'], ($_POST['prefix'] . $_POST['phone']), $_POST['location'])) {
      $_SESSION['proced'] = "Registration successful! Please Log In to continue...";
      header('Location: ./login.php');
    }
    $error = "User with this E-mail already exists!";
  } catch (Exception $e) {
    if ($e instanceof FailInsertCompany) $error = $e->getMessage() . " Please try again!";
    if ($e instanceof FailInsertUser) $error = $e->getMessage() . " Please try again!";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign Up!</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="./css/vertical-layout-light/terms_and_conditions.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/logo_icon.png" type="image/x-icon" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <?php
                  if (isset($error)) {
                    echo "<h4><span class=\"text-danger\">$error</span></h4><br>";
                  }
                ?>
                <img src="images/logo_text_index.svg" alt="logo">
              </div>
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps to get <br> <span class="font-weight-bold">your own</span> team of developers!</h6>
              <form class="pt-3" action="./register_company.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Company Name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="owner" name="owner" placeholder="Owner Name" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="cemail" name="email" placeholder="E-mail" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Password" required>
                </div>
                <div class="form-group" style="display:flex; justify-content:space-between;">
                  <input type="tel" class="form-control form-control-lg" style="width:15%; padding-left: 0px; padding-right: 0px; text-align:center;" id="prefix" name="prefix" placeholder="Phone" value="+381" readonly>
                  <input type="text" class="form-control form-control-lg" style="width:84%;" id="phone" name="phone" placeholder="Phone" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="location" name="location" placeholder="City" required>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      I agree to all <a href="#" id="myTermsLink">Terms & Conditions</a>
                      <input type="checkbox" class="form-check-input" required>
                    </label>
                    <!-- Terms and Conditions -->
                    <div id="myTerms" class="terms">

                      <!-- content -->
                      <div class="terms-content">
                        <div class="terms-header">
                          <span class="closebtnn">&times;</span>
                          <h2>getDev(s) Terms and Conditions</h2>
                        </div>
                        <div class="terms-body">
                          <p>Read carefuly!</p>
                          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error officia eligendi harum, placeat molestiae esse, natus ab minus blanditiis ipsa sunt deleniti aperiam ad dolor obcaecati quibusdam nisi at. Sapiente.
                            Ipsam tenetur doloremque expedita, quam necessitatibus incidunt laborum esse deleniti nisi porro tempora aperiam harum impedit, maxime similique. Pariatur fuga magnam perspiciatis adipisci deleniti recusandae culpa iste totam reprehenderit inventore!
                            Tempore quo sit aperiam beatae facere esse doloremque quasi. Iure repellat cum dolores velit nostrum ducimus molestiae commodi dolorem, quae fugit excepturi nisi quidem quas, libero ex? Facilis, expedita quod.
                            Pariatur at minus omnis nostrum fuga laudantium inventore iusto labore veritatis facere. Ipsum enim nam ut, corporis iste voluptatem velit dicta quo eos beatae fugit, placeat laboriosam ducimus, consectetur deleniti?<br><br>
                            Ex iste asperiores ipsa suscipit ab obcaecati quis saepe vero, praesentium similique voluptatem perferendis eaque omnis quasi in quia consectetur, harum doloremque voluptatum, repudiandae cupiditate. Quasi aspernatur inventore aliquam consequuntur.
                            Atque distinctio quis explicabo nulla, id eaque debitis deleniti, alias sit, quibusdam iure eligendi! Eos repellendus sunt, consequuntur asperiores quasi corrupti tenetur libero culpa quas quisquam? Cupiditate mollitia alias possimus!
                            Provident eius dolorum labore ipsam iste iusto eos expedita, laborum sit similique nihil quos voluptate quo nesciunt! Consequuntur suscipit libero deleniti officiis rem, impedit, id totam ratione distinctio quibusdam nobis.
                            Quasi magnam quas distinctio voluptate! In molestias inventore nulla ipsam eligendi repellat tempora accusantium delectus! Doloribus accusantium ex architecto et veritatis exercitationem molestiae, quasi aut possimus dolorum numquam! Quibusdam, quidem?
                            Animi ullam doloremque vel suscipit temporibus enim illo incidunt dolore. Dolores, delectus optio accusamus corrupti iure obcaecati id quisquam modi doloribus, asperiores odio architecto repellat vitae veritatis. Iste, asperiores facere?
                            Cumque maxime deserunt ipsam quia deleniti odit beatae corrupti dolorum, natus asperiores ratione accusamus doloremque quod nostrum ullam eaque pariatur obcaecati aspernatur fugiat enim magni provident alias facere. Omnis, ipsa.<br><br>
                            Accusantium qui quo dolorum nemo asperiores perferendis quos repellendus, explicabo numquam eveniet laborum! Autem deleniti sequi odit doloribus sapiente. Possimus, ipsa hic? Rerum quisquam enim, quod repudiandae assumenda illum excepturi!
                            Temporibus possimus blanditiis officia quaerat, totam laborum voluptatibus vero. Ipsa aliquid autem et quia molestias distinctio officia laboriosam obcaecati rem. Quam itaque excepturi sed reiciendis magnam impedit eos et ducimus!
                            Corporis cupiditate magnam architecto, doloribus aspernatur vel? Recusandae laboriosam a vero repellat quae veritatis, nostrum quod dolorum mollitia voluptatem magni reprehenderit, sequi ipsam! Eum, soluta. Dicta earum beatae porro est.
                            Odio ut non nostrum sed numquam, deleniti quod nisi explicabo itaque repellat illo? Distinctio odit enim eos, quos, vero sit neque placeat magni quis, fugiat sed quisquam dignissimos! Vel, unde?
                            Eius repudiandae sunt deserunt tempora aut impedit quaerat enim, animi commodi esse eos in perspiciatis voluptatibus quos explicabo totam, reprehenderit quis! Delectus iure accusantium necessitatibus autem, velit quaerat perspiciatis eos.
                            Enim, autem deleniti! Impedit totam, laborum dolorum esse vel tempora enim culpa quibusdam dicta iusto corporis at repellendus dolor consectetur facilis neque tenetur minima? Vitae expedita sed fugiat blanditiis nisi!
                            Rem, repellendus vitae cum quo quam similique ut unde. Dolore, saepe. Libero officiis odio adipisci praesentium porro autem pariatur suscipit harum mollitia dolorem iste tempora fugit laboriosam, architecto neque recusandae!</p>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="mt-3">
                  <input type="submit" name="submit" id ="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP"/>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Log In</a>
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
  <script src="js/terms-and-conditions.js"></script>
  <!-- endinject -->
</body>

</html>