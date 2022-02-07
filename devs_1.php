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

  //getting data from `devs`
  $page = 1;
  $data = $conn->getDevelopersForPage($page);

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
                  <p class="card-title mb-0">Top Products</p>
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Location</th>
                          <th>Price per hour</th>
                          <th>Skills</th>
                          <th>LinkedIn</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $dev):?>
                        <tr>
                          <td><img src="<?= $dev['profile_picture'] ?>"></td>
                          <td class="font-weight-bold"><?= $dev['name'] ?></td>
                          <td><?= $dev['location'] ?></td>
                          <td class="font-weight-bold">€<?= $dev['price_per_hour'] ?></td>
                          <td>
                            <?= $dev['javascript'] ? 'Javascript &nbsp' : '' ?>
                            <?= $dev['java'] ? 'Java &nbsp' : '' ?>
                            <?= $dev['net'] ? '.NET &nbsp' : '' ?>
                            <?= $dev['flutter'] ? 'Flutter &nbsp' : '' ?>
                            <?= $dev['python'] ? 'Python &nbsp' : '' ?>
                            <?= $dev['php'] ? 'PHP' : '' ?>
                          </td>
                          <td><a href="<?= $dev['linked_in'] ?>" target="_blank">LinkedIn</a></td>
                          <td class="font-weight-medium">
                            <div class="badge badge-success">Free</div>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="./devs_1.php">Previous</a></li>
                          <li class="page-item active"><a class="page-link" href="./devs_1.php">1</a></li>
                          <li class="page-item"><a class="page-link" href="./devs_2.php">2</a></li>
                          <li class="page-item"><a class="page-link" href="./devs_3.php">3</a></li>
                          <li class="page-item"><a class="page-link" href="./devs_4.php">4</a></li>
                          <li class="page-item"><a class="page-link" href="./devs_2.php">Next</a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
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