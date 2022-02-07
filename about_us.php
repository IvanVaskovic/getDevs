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
  <title>getDev(s)</title>
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
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="h3">About Us...</p><br>
                  <h5>Let us tell you something about us .</h5><br>
                  <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste cumque ab corporis odit sint. Atque optio illum non 
                      Quas minima perspiciatis debitis libero dolor cumque possimus vitae nihil autem rerum necessitatibus ad amet excepturi consequatur numquam quae, dignissimos odit in distinctio itaque sint dicta modi recusandae voluptatibus? Possimus.
                       Est atque praesentium ipsa, voluptates corrupti hic accusamus commodi sunt reprehenderit veniam quibusdam omnis dolorum suscipit perspiciatis!<br><br>
                      Minus mollitia inventore eveniet earum, dignissimos ipsum corporis ipsam, numquam consequuntur nesciunt dicta atque deleniti, totam reprehenderit accusamus consequatur officia animi modi repellat sint aut? Nam nesciunt repellendus facere. Consequatur.
                      Provident repudiandae nesciunt quod facere, molestiae obcaecati velit cupiditate at voluptatibus! Ab, nihil aut corrupti expedita ratione praesentium labore laudantium, veniam distinctio eaque veritatis laborum ex hic doloribus! Ratione, ex.<br><br>
                      Nihil nulla mollitia sequi veniam, iusto, sed quae temporibus, id doloribus exercitationem voluptatum suscipit voluptate repudiandae!<br><br>
                      Praesentium tempora fugiat ipsa impedit suscipit assumenda repellendus, blanditiis quibusdam explicabo cumque totam, libero aut eveniet iste temporibus itaque id vel dignissimos veritatis dolor sed, error quas ad. Quaerat, rem.
                      Molestias provident nesciunt officia beatae eveniet eius in, modi distinctio optio suscipit quasi sapiente ad tempore cumque minus nemo repudiandae accusamus amet voluptatibus dolorem nam illum animi? Quasi, sequi illo!
                      Nemo fugiat nostrum eum distinctio enim eos expedita omnis molestiae quae? Quibusdam ullam debitis voluptatum, perferendis modi laboriosam labore recusandae inventore error laudantium sapiente mollitia velit, magnam adipisci tempore iste?<br><br>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur mollitia hic iusto at, quam, enim dolore, magni sapiente alias tempore dicta est nesciunt accusamus non molestias vitae laborum magnam officia.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="js/paginate.js"></script>
  <!-- End custom js for this page-->
</body>

</html>