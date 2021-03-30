<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    session_start();

    $user_id = $_SESSION['id'];
    $scrtpasswd = $_SESSION['scrtpasswd'];

    if (!$user_id) {
        header('location: .././auth/login.php');
    }

    $user_set_fullname = $user_set_email = $user_set_current_psw = $user_set_new_psw = '';
    $res = ['message' => ''];
    $errors = ['fullname' => '', 'email' => '', 'current_psw' => '', 'new_psw' => ''];

    if (isset($_POST['submit'])) {

        if (empty($_POST['fullname'])) {
            $errors['fullname'] = 'Required*';
          } else {
            $user_set_fullname = $_POST['fullname'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $user_set_fullname)) {
              $errors['fullname'] = 'Fullname must be letters and space only';
            }
          }

          if (empty($_POST['email'])) {
            $errors['email'] = 'Required*';
          } else {
            $user_set_email = $_POST['email'];
            if (!filter_var($user_set_email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Please Enter A Valid Email Address';
            }
          }

          if (empty($_POST['current_psw'])) {
            $errors['current_psw'] = 'Required*';
          } else {
            $user_set_current_psw = $_POST['current_psw'];
          }

          if (empty($_POST['new_psw'])) {
            $errors['new_psw'] = 'Required*';
          } else {
            $user_set_new_psw = $_POST['new_psw'];
      
            if (strlen($user_set_new_psw) < 6) {
              $errors['new_psw'] = 'Weak password';
            } else {
              if (!preg_match('/^[a-zA-Z]+[0-9]+$/', $user_set_new_psw)) {
                $errors['new_psw'] = 'password must be letters and number';
              }
            }
          }

        if (!array_filter($errors)) {
            $user_set_fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $user_set_email = mysqli_real_escape_string($conn, $_POST['email']);
            $user_set_current_psw = mysqli_real_escape_string($conn, $_POST['current_psw']);
            $user_set_new_psw = mysqli_real_escape_string($conn, $_POST['new_psw']);
            $hash_current_password = md5($user_set_current_psw);
            $hash_password = md5($user_set_new_psw);



            $sql = "SELECT * FROM account WHERE emailaddress = '$user_set_email' AND psw = '$hash_current_password'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $sql = "UPDATE account set fullname = '$user_set_fullname', emailaddress = '$user_set_email', psw = '$hash_password' WHERE id = '$user_id'";

                if (mysqli_query($conn, $sql)) {
                  $res['message'] = 'Settings Updated Successfully';
                } 

                if (isset($_GET['id'])) {
                    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

                    $result = mysqli_query($conn, $query);

                    $my_user = mysqli_fetch_assoc($result);

                    mysqli_free_result($result);

                    mysqli_close($conn);
                }
            } else {
              $res['message'] = 'Failed To Update Settings';
            }
        }
    }


?>


<head>
    <title>Dented | settings</title>
</head>

<?php include('template/admin_header.php'); ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="col-md-5 col-sm-10 col-xs-12 mx-auto pt-2 p-3 bg-white" id="form">
            <div>
                <?php if (!$res['message']) :?>
                    <p></p>
                <?php elseif($res['message'] === 'Settings Updated Successfully') : ?>  
                    <p class="text-center alert alert-success text-dark p-2 response"><i class="fa fa-check-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Failed To Update Settings') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>                      
                <?php else :?>
                    <p class="text-center alert alert-danger text-dark p-2"><?php echo $res['message']?></p>
                <?php endif; ?>
            </div>  
            <input type="text" name="fullname" id="settingFN" class="form-control mt-4 mb-4 p-3" placeholder="Enter fullname" value="<?php echo htmlspecialchars($user_set_fullname); ?>">
            <p id="errResponseFullname" class="text-danger"><?php echo $errors['fullname']; ?></p>        
            <input type="email" name="email" id="settingEM" class="form-control mt-4 mb-4 p-3" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($user_set_email); ?>">
            <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p>        
            <input type="password" id="current_passwd" name="current_psw" class="form-control mt-4 mb-4 p-3" placeholder="Enter Current Password" value="<?php echo htmlspecialchars($user_set_current_psw); ?>">
            <p id="errResponseCurrentPasswd" class="text-danger"><?php echo $errors['current_psw']; ?></p>           
            <input type="password" name="new_psw" id="new_passwd" class="form-control mt-4 mb-4 p-3" placeholder="Enter New Password" value="<?php echo htmlspecialchars($user_set_new_psw); ?>">
            <p id="errResponseNewPasswd" class="text-danger"><?php echo $errors['new_psw']; ?></p>          
            <input type="submit" name="submit" value="Submit" class="btn btn-block mt-4 mb-4 c-my-btn">
        </form>

<?php include('template/admin_footer.php'); ?>