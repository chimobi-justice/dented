<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');

  $fullname = $email = $password = '';
  $errors = ['email' => '', 'password' => '', 'fullname' => ''];
  $res = ['message' => ''];

  if (isset($_POST['submit'])) {
    
    if (empty($_POST['fullname'])) {
      $errors['fullname'] = 'Required*';
    } else {
      $fullname = $_POST['fullname'];

      if (strlen($fullname) < 6) {
          $errors['fullname'] = 'Fullname too short';
      } else {
          if (!preg_match('/^[a-zA-Z]/', $fullname)) {
            $errors['fullname'] = 'Fullname must be letters only';
          }
      } 
    }

    if (empty($_POST['email'])) {
      $errors['email'] = 'Required*';
    } else {
      $email = $_POST['email'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email must be valid';
      }
    }
    if (empty($_POST['password'])) {
      $errors['password'] = 'Required*';
    } else {
      $password = $_POST['password'];

      if (strlen($password) < 6) {
        $errors['password'] = 'length not long enough';
      } else {
        if (!preg_match('/^[a-zA-Z]+[0-9]+$/', $password)) {
          $errors['password'] = 'password must be letters and a number';
        }
      }
    }

    if (!array_filter($errors)) {
      $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hash_password = md5($password);

      $sql = "SELECT emailaddress FROM account WHERE emailaddress = '$email'";
      $sql_result = mysqli_query($conn, $sql);
      $check_user_email_address = mysqli_num_rows($sql_result);

      if ($check_user_email_address > 0) {
        $errors['email'] = 'Email adrress already exit';
      } else {
          $sql = "INSERT INTO account(fullname, emailaddress, psw) VALUES('$fullname', '$email', '$hash_password')";
          $sql_result = mysqli_query($conn, $sql);

          if ($sql_result) {
            $res['message'] = 'Account created successfully, Please login';
          }
      }
    }
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dented | signup</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/signup.css">
</head>
<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="signup-form"
        class="form-group p-4 mt-5 mx-auto h-auto col-md-4 col-sm-10 col-xs-12" method="POST">
        <div class="signup-content-holder">
            <h1 class="text-center"><a href="../index.php" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">Sign up to your Dented Jobs Internships</h5>
        </div>
        <div>
          <?php if (!$res) :?>
            <p></p>
          <?php elseif($res['message'] === 'Account created successfully, Please login') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-success text-dark p-2"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
          <?php else :?>
            <p><?php echo $res['message']?></p>
          <?php endif; ?>
        </div>
        <input type="text" name="fullname" id="fullname" class="form-control  mb-2 p-3"
        placeholder="Enter your fullname" value="<?php echo htmlspecialchars($fullname);?>">
        <p id="errResponseFullname" class="text-danger"><?php echo $errors['fullname']; ?></p>         
        <input type="email" name="email" id="emailAddress" class="form-control w-100 mb-2 mt-4 p-3" 
        placeholder="Enter email address" value="<?php echo htmlspecialchars($email);?>">
        <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p>
        <input type="password" name="password" id="password" class="form-control  mb-2 p-3" 
        placeholder="Enter password" value="<?php echo htmlspecialchars($password);?>">
        <p id="errResponsePassword" class="text-danger"><?php echo $errors['password']; ?></p>         
        <button type="submit" name="submit" id="logInBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">login</button>
    </form>
    <div class="text-center">
       <p class="text-dark">already have an account?<a href="login.php" class="text-primary">sign in</a></p>
    </div>

    <footer id="footer">
      <div class="footer-copyright text-center">
        <p><small>&copy; All rights reserved <i>Dented</i> | justice foundation &cross;</small></p>
      </div>
    </footer>

    <script src="https://use.fontawesome.com/690d11afa2.js"></script>
    <script src="../assets/js/signup.js"></script>
</body>
</html>