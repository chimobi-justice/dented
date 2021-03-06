<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');
  session_start();

  $email = $password = '';
  $errors = ['email' => '', 'password' => ''];
  $res = ['message' => ''];

  if (isset($_POST['submit'])) {

    if (empty($_POST['email'])) {
      $errors['email'] = 'Required*';
    } else {
      $email = $_POST['email'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please Enter A Valid Email Address';
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
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hash_password = md5($password);

      $sql = "SELECT * FROM account WHERE emailaddress = '$email' AND psw = '$hash_password'";
      $sql_result = mysqli_query($conn, $sql);
      $check_user_email_address = mysqli_num_rows($sql_result);

      if ($check_user_email_address > 0) {
        $user = mysqli_fetch_assoc($sql_result);

        $_SESSION['id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email'] = $user['emailaddress'];


        header('location: ../dashboard/post.php');
      } else {
          $res['message'] = 'Wrong Email Address or Password';
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
    <title>Dented | login</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="loggedIn-form" 
        class="form-group p-4 mt-5 mx-auto h-auto col-lg-4 col-sm-12" method="POST">
        <div class="login-content-holder">
            <h1 class="text-center"><a href="../index.php" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">Sign in to continue to Dented Jobs Internships</h5>
        </div>
        <div>
          <?php if (!$res['message']) :?>
            <p></p>
          <?php elseif($res['message'] === 'Wrong Email Address or Password') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><?php echo $res['message']; ?></p>
          <?php else :?>
            <p class="text-center alert alert-danger text-dark p-2"><?php echo $res['message']?></p>
          <?php endif; ?>
        </div>
        <input type="email" name="email" id="emailAddress" class="form-control w-100 mb-3 mt-4 p-3" 
        placeholder="Enter email address" value="<?php echo htmlspecialchars($email);?>">
        <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p>
        <div class="input-group">
           <input type="password" name="password" id="password" class="form-control  mb-1 p-3" 
           placeholder="Enter password" value="<?php echo htmlspecialchars($password);?>">
           <button id="show-btn" type="button" class="btn btn-sm btn-default bg-gray showPassword">Show</button>
           <button id="hide-btn" type="button" class="btn btn-sm btn-default bg-gray hidePassword">Hide</button>
        </div>
        <p id="errResponsePassword" class="text-danger"><?php echo $errors['password']; ?></p> 
        <div class="pb-2">
            <a href="forgotpsw.php" class="text-dark">Forgotten password</a>
        </div>        
        <button type="submit" name="submit" id="logInBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">login</button>
        <div class="text-center">
            <a href="signup.php" class="text-primary">create an account signup here</a>
        </div>
    </form>

    <footer id="footer">
      <div class="footer-copyright text-center">
        <p><small>&copy; All rights reserved <i>Dented</i> | justice foundation &cross;</small></p>
      </div>
    </footer>

    <script src="../assets/js/login.js"></script>
</body>
</html>