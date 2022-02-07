<?php 
  include_once ('./initdb.php');
  session_start();

  if(isset($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];
  }

  if(!isset($_SESSION['email'])) {
    header('Location: ./login.php');
  }

  $user = $_SESSION['user_type'];
  if ($user == 'dev') $user_data = $conn->getDev($_SESSION['email']);
  if ($user == 'company') $user_data = $conn->getCompany($_SESSION['email']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Account</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <!-- Title bar logo -->
  <link rel="shortcut icon" href="images/logo_icon.png" type="image/x-icon" />
</head>

<body class="sidebar-fixed">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php require_once('./navbar.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php require_once('./theme_settings.php'); ?>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php require_once('./sidebar.php') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-10 mx-auto">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="border-bottom text-center pb-4">
                          <?php if (isset($_SESSION['proced'])) echo "<h6 class=\"text-success\">". $_SESSION['proced'] ."</h6>"; ?>
                        <img src="<?= $user_data['profile_picture'] ?>" alt="profile" class="img-lg rounded-circle mb-3">
                        <div class="mb-3">
                          <h3><?= $user_data['name'] ?></h3>
                          <div class="d-flex align-items-center justify-content-center">
                            <h5 class="mb-0 me-2 text-muted"><?= $user_data['location'] ?></h5>
                          </div>
                        </div>
                        <p class="w-75 mx-auto mb-3"><?= $user_data['description'] ?></p>
                        <!-- <div class="d-flex justify-content-center">
                          <button class="btn btn-success me-1">Hire Me</button>
                        </div> -->
                      </div>
                      <div class="border-bottom py-4">
                        <p>Skills</p>
                        <div>
                        <?php if ($user_data['javascript']) echo "<label class=\"badge badge-outline-dark\">JavaScript</label>"; ?>
                        <?php if ($user_data['java']) echo "<label class=\"badge badge-outline-dark\">Java</label>"; ?>
                        <?php if ($user_data['net']) echo "<label class=\"badge badge-outline-dark\">.NET</label>"; ?>
                        <?php if ($user_data['flutter']) echo "<label class=\"badge badge-outline-dark\">Flutter</label>"; ?>
                        <?php if ($user_data['python']) echo "<label class=\"badge badge-outline-dark\">Python</label>"; ?>
                        <?php if ($user_data['php']) echo "<label class=\"badge badge-outline-dark\">PHP</label>"; ?>
                        </div>                                                               
                      </div>
                      <div class="border-bottom py-4">
                        <div class="d-flex mb-3">
                          <div class="progress progress-md flex-grow">
                            <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="55" style="width: 55%" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex">
                          <div class="progress progress-md flex-grow">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="75" style="width: 75%" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                      <div class="py-4">
                        <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                          <span class="float-right badge badge-success">
                            Free
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Price per Hour
                          </span>
                          <span class="float-right text-muted">
                          <?= $user_data['price_per_hour'] . " €" ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Phone
                          </span>
                          <span class="float-right text-muted">
                          <?= $user_data['phone'] ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Mail
                          </span>
                          <span class="float-right text-muted">
                          <?= $user_data['email'] ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Years of experience
                          </span>
                          <span class="float-right text-muted">
                          <?= $user_data['years_of_exp'] ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            Native language
                          </span>
                          <span class="float-right text-muted">
                          <?= $user_data['native_language'] ?>
                          </span>
                        </p>
                        <p class="clearfix">
                          <span class="float-left">
                            LinkedIn
                          </span>
                          <span class="float-right text-muted">
                            <a href="<?= $user_data['linked_in'] ?>" target="_blank"><?= $user_data['name'] ?></a>
                          </span>
                        </p>
                      </div>
                      <a href="./edit_profile_dev.php" class="btn btn-primary btn-block mb-2">Edit Profile</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php include_once('./footer.php') ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="js/dataTables.select.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

<?php 
    unset($_SESSION['proced']);
?>