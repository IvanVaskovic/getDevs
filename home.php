<?php 
  include_once ('./initdb.php');
  session_start();

  if(isset($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];
    $user = $conn->getUser($_POST['email']);
    $_SESSION['user_type'] = $user['user_type'];
    if ($_SESSION['user_type'] == 'dev') $_SESSION['id'] = $user['dev_id'];
    if ($_SESSION['user_type'] == 'campany') $_SESSION['id'] = $user['company_id'];
  }

  if(!isset($_SESSION['email'])) {
    header('Location: ./login.php');
  }

  $user = $_SESSION['user_type'];
  if ($user == 'dev') $user_data = $conn->getDev($_SESSION['email']);
  if ($user == 'company') $user_data = $conn->getCompany($_SESSION['email']);

  $latest_devs = $conn->getLatestDevs();
  $top_devs = $conn->getDevelopersForPage(1);
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
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome <?= $user_data['name'] ?></h3>
                  <h6 class="font-weight-normal mb-0">Great to have you back! You have <span class="text-primary">1 new job offer!</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white " type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Today (<?= date('d-M-Y') ?>)
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">          <!-- to be updated -->
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="images/dashboard/1554564806.svg" alt="picture" style="width:100%; margin-top:-20px;">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-4">
                        <h4 class="location font-weight-normal">Niš</h4>
                        <h6 class="font-weight-normal">Serbia</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">          <!-- to be updated -->
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Today’s Devs hired</p>
                      <p class="fs-30 mb-2">16</p>
                      <p>10.00% (7 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">          <!-- to be updated -->
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Hired Developers</p>
                      <p class="fs-30 mb-2">496</p>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">          <!-- to be updated -->
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Projects</p>
                      <p class="fs-30 mb-2">76</p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">          <!-- to be updated -->
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Number of Clients</p>
                      <p class="fs-30 mb-2">1268</p>
                      <p>0.22% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card position-relative">
                <div class="card-body">
                  <p class="card-title mb-1">New developers - check them out!</p>
                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                    <div class="carousel-inner" onclick="location.href='./devs_1.php';" style="cursor: pointer;">
                    <?php foreach ($latest_devs as $index => $dev): ?>
                      <div class="carousel-item <?= ($index == 0) ? 'active' : '' ?>">
                        <div class="row">
                          <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                            <div class="ml-xl-4 mt-3">
                              <p class="card-title"><?= $dev['name'] ?></p>
                              <h1 class="text-primary h3">€<?= $dev['price_per_hour'] ?><small> - Per hour</small></h1>
                              <h3 class="font-weight-500 mb-xl-4 text-primary h4"><?= $dev['location'] ?></h3>
                              <p class="mb-2 mb-xl-0"><?= $dev['description'] ?></p>
                            </div>
                          </div>
                          <div class="col-md-12 col-xl-9">
                            <div class="row">
                              <div class="col-md-6 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <table class="table table-borderless report-table">          <!-- to be updated -->
                                    <?php if ($dev['javascript'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">JavaScript</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">70</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($dev['java'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">Java</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">30</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($dev['net'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">.NET</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">95</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($dev['flutter'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">Flutter</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">60</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($dev['python'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">Python</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">60</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if ($dev['php'] == 1): ?>
                                    <tr>
                                      <td class="text-muted">PHP</td>
                                      <td class="w-100 px-0">
                                        <div class="progress progress-md mx-4">
                                          <div class="progress-bar bg-danger" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                      </td>
                                      <td>
                                        <h5 class="font-weight-bold mb-0">60</h5>
                                      </td>
                                    </tr>
                                    <?php endif; ?>
                                  </table>
                                </div>
                              </div>
                              <div class="col-md-6 mt-3 text-center d-flex justify-content-center align-items-center" style="position:relative;">
                                  <img src="<?= $dev['profile_picture'] ?>" alt="profile picture" style="max-width:50%; max-height:auto; border-radius:50%">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Top Developers</p>          <!-- to be updated -->
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
                        <?php foreach ($top_devs as $dev):?>
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
            <div class="col-md-8 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-0">Projects</p>          <!-- to be updated -->
                  <div class="table-responsive">
                    <table class="table table-borderless">
                      <thead>
                        <tr>
                          <th class="pl-0  pb-2 border-bottom">Project name</th>
                          <th class="border-bottom pb-2">Ordered by</th>
                          <th class="border-bottom pb-2">Team count</th>
                          <th class="border-bottom pb-2">Start date</th>
                          <th class="border-bottom pb-2">Finish date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="pl-0">Project 1</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">65</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>
                        <tr>
                          <td class="pl-0">Project 2</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">51</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>
                        <tr>
                          <td class="pl-0">Project 3</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">32</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>
                        <tr>
                          <td class="pl-0">Project 4</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">15</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>
                        <tr>
                          <td class="pl-0">Project 5</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">25</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>                        
                        <tr>
                          <td class="pl-0">Project 6</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">25</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>                        
                        <tr>
                          <td class="pl-0">Project 7</td>
                          <td>
                            <p class="mb-0"><span class="font-weight-bold mr-2">Company</span></p>
                          </td>
                          <td class="text-muted">25</td>
                          <td class="text-muted">15 - Jan - 2022</td>
                          <td class="text-muted">15 - Feb - 2022</td>
                        </tr>                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Top Companies - Projects completed</p>          <!-- to be updated -->
                      <div class="charts-data">
                        <div class="mt-3">
                          <p class="mb-0">Company 1</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">41</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">Company 2</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">29</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">Company 3</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 48%" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">18</p>
                          </div>
                        </div>
                        <div class="mt-3">
                          <p class="mb-0">Company 4</p>
                          <div class="d-flex justify-content-between align-items-center">
                            <div class="progress progress-md flex-grow-1 mr-4">
                              <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">17</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                  <div class="card data-icon-card-primary">
                    <div class="card-body">
                      <p class="card-title text-white">Number of Developers</p><!-- to be updated -->
                      <div class="row">
                        <div class="col-8 text-white">
                          <h3>12040</h3>
                          <p class="text-white font-weight-500 mb-0">The total number of developers and companies who used our services in the past 3 years, thank you for trusting us ! </p>
                        </div>
                        <div class="col-4 background-icon">
                        </div>
                      </div>
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
  <!-- End custom js for this page-->
</body>

</html>