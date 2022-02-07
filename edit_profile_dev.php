<?php 
require_once ('./initdb.php');
session_start();

//if cookie already set
if (isset($_COOKIE['email'])) {
    $_SESSION['email'] = $_COOKIE['email'];
    $user = $conn->getUser($_POST['email']);
    $_SESSION['user_type'] = $user['user_type'];
    if ($_SESSION['user_type'] == 'dev') $_SESSION['id'] = $user['dev_id'];
    if ($_SESSION['user_type'] == 'campany') $_SESSION['id'] = $user['company_id'];
}

//if email(user) not in session
if (!isset($_SESSION['email'])) {
    header('Location: ./index.html');
}

$user_data = $conn->getDev($_SESSION['email']);

//back to account
if (isset($_POST['back'])) {
  header('Location: ./account.php');
}

//delete profile
if (isset($_POST['delete'])) {
  
  try {
    if ($conn->deleteUser($user_data['email'])) {
      unset($_SESSION['email']);
      unset($_COOKIE['email']);
      setcookie('email','',time()-3600);
      header('Location: ./index.html');
    }
  } catch (Exception $e) {
    if ($e instanceof FailDeleteProfile) $error = $e->getMessage() . " Please try again!";
    if ($e instanceof FailDeleteUser) $error = $e->getMessage() . " Please try again!";
  }
}

//dev profile update
if (isset($_POST["submit"])) {

    //profile picture
    $profile_picture_path = $user_data['profile_picture'];
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]['tmp_name'] == 0) {
      $file = $_FILES['profile_picture'];
      $ext = substr($file['name'], -4);
      $profile_picture_path = './images/users-profile-pictures/' . $user_data['email'] . $ext;
      if ($file['error'] == 0) {
        move_uploaded_file($file['tmp_name'], $profile_picture_path);
      }
    }
  
    $javascript = (isset($_POST['javascript']) ? 1 : 0);
    $java = (isset($_POST['java']) ? 1 : 0);
    $net = (isset($_POST['net']) ? 1 : 0);
    $flutter = (isset($_POST['flutter']) ? 1 : 0);
    $python = (isset($_POST['python']) ? 1 : 0);
    $php = (isset($_POST['php']) ? 1 : 0);

    //old password validation
    if (isset($_POST['new_pass']) && $_POST['new_pass'] != '') {
        if ($conn->validateUser($user_data['email'], $_POST['old_pass'])) {
            $new_pass = $_POST['new_pass'];
        }
    }
  
    try {
      if ($conn->updateDev($_POST['name'], $user_data['email'], ($_POST['prefix'] . $_POST['phone']), $_POST['location'], $profile_picture_path, $_POST['price_per_hour'], $javascript, $java, $net, $flutter, $python, $php, $_POST['description'], $_POST['years_of_exp'], $_POST['native_language'], $_POST['linked_in'])) {
          if (isset($new_pass)) {
            if ($conn->updateUserPassword($user_data['email'], $new_pass)) {
                
                unset($_SESSION['email']);
                unset($_COOKIE['email']);
                setcookie('email','',time()-3600);

            }
          }
        $success = true;
      } else {
        $error = "Something went wrong, please try again!";
      } 
    } catch (Exception $e) {
      if ($e instanceof FailInsertDev) $error = $e->getMessage() . " Please try again!";
      if ($e instanceof FailInsertUser) $error = $e->getMessage() . " Please try again!";
    } finally {
        if ($success) {
            if (isset($new_pass)) {
                $_SESSION['proced'] = "Password updated successfully! Please Log In to continue...";
                header('Location: ./login.php');
            } else {
                if ($_POST['old_pass'] != '' && !$conn->validateUser($user_data['email'], $_POST['old_pass'])) {
                    $error = "Wrong password, try again!";
                } else {
                    $_SESSION['proced'] = "Profile updated successfully!";
                    header('Location: ./account.php');
                }
            }
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Profile</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="./vendors/select2/select2.min.css">
  <link rel="stylesheet" href="./vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="./css/vertical-layout-light/terms_and_conditions.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./images/logo_icon.png" type="image/x-icon" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-6 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
              <?php if (isset($error)) echo "<h4><span class=\"text-danger\">$error</span></h4><br>"; ?>
                <img src="images/logo_text_index.svg" alt="logo">
              </div>
              <h4>Edit your profile in a few simple steps!</h4>
              <!-- <h6 class="font-weight-light">Signing up is easy. It only takes a few steps!</h6> -->
              <form class="pt-3" action="./edit_profile_dev.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="name" name="name" value="<?= $user_data['name'] ?>" placeholder="" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="<?= $user_data['email'] ?>" disabled>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="old_pass" placeholder="Current Password">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" name="new_pass" placeholder="New Password">
                </div>
                <div class="form-group" style="display:flex; justify-content:space-between;">
                  <input type="tel" class="form-control form-control-lg" style="width:15%; padding-left: 0px; padding-right: 0px; text-align:center;" id="prefix" name="prefix" placeholder="Phone" value="+381" readonly>
                  <input type="text" class="form-control form-control-lg" style="width:84%;" id="phone" name="phone" value="<?= substr($user_data['phone'],4); ?>" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="location" name="location" value="<?= $user_data['location'] ?>" placeholder="" required>
                </div>
                <div class="form-group">
                  <input type="file" name="profile_picture" id="profile_picture" class="file-upload-default" accept=".jpg,.jpeg,.png">
                  <div class="input-group col-xs-12">
                    <input type="text" class="form-control form-control-lg" disabled placeholder="Upload Image - Optional">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-primary" style="border-radius:0px;" type="button">Upload</button>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-primary text-white">€</span>
                    </div>
                    <input type="text" class="form-control" id="price_per_hour" name="price_per_hour" value="<?= $user_data['price_per_hour'] ?>" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row" style="padding-left:10px;">
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="javascript" name="javascript" <?= $user_data['javascript'] ? "checked" : "" ?>>
                          JavaScript
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="java" name="java" <?= $user_data['java'] ? "checked" : "" ?>>
                          Java
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="net" name="net" <?= $user_data['net'] ? "checked" : "" ?>>
                          .NET
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="flutter" name="flutter" <?= $user_data['flutter'] ? "checked" : "" ?>>
                          Flutter
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="python" name="python" <?= $user_data['python'] ? "checked" : "" ?>>
                          Python
                        </label>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" id="php" name="php" <?= $user_data['php'] ? "checked" : "" ?>>
                          PHP
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <textarea class="form-control form-control-lg" rows="4" id="description" name="description" placeholder="" required><?= $user_data['description'] ?></textarea>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="years_of_exp" name="years_of_exp" value="<?= $user_data['years_of_exp'] ?>" placeholder="" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="native_language" name="native_language" value="<?= $user_data['native_language'] ?>" placeholder="" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="linked_in" name="linked_in" value="<?= $user_data['linked_in'] ?>" placeholder="" required>
                </div>
                <div class="mt-3">
                  <input type="submit" name="submit" id ="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="UPDATE"/>
                </div>
              </form>
              <form action="./edit_profile_dev.php" method="POST" style="margin-top: 15px;">
                <input type="hidden" name="id" id="id" value="<?= $user_data['email'] ?>"/>
                <input type="submit" name="delete" id ="delete" class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn" value="DELETE PROFILE" onclick="alert('Are you sure you want to delete profile?');"/>
              </form>
              <form action="./edit_profile_dev.php" method="POST" style="margin-top: 15px;">
                <input type="submit" name="back" id ="back" class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" value="BACK"/>
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
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="./vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="./vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="./js/file-upload.js"></script>
  <script src="./js/terms-and-conditions.js"></script>
  <!-- End custom js for this page-->
</body>

</html>