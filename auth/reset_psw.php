<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');
  session_start();
  $userid = $_SESSION['id'];

  if (!$user_id) {
    header('location: .././auth/login.php');
  }

  $password = '';
  $res = ['message' => ''];

  if (isset($_POST['submit'])) {

    if (empty($_POST['password'])) {
      $res['message'] = 'Password Required*';
    } else {
      $password = $_POST['password'];

      if (strlen($password) < 6) {
        $res['message'] = 'Length not long enough';
      } else {
        if (!preg_match('/^[\w .]+$/', $password)) {
          $res['message'] = 'Password must be letters and a number';
        }
      }
    }

    if (!array_filter($res)) {
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hash_password = md5($password);

      $sql = "UPDATE account SET psw = '$hash_password'  WHERE id = $userid";
      if (mysqli_query($conn, $sql)) {
        $res['message'] = 'Password Updated Successful, Please login';
      } else {
        $res['message'] = 'Password not Updated';
      }
      mysqli_close($conn);
    }
  }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dented | Reset password</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/reset_psw.css">
</head>
<body>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="reset-form" 
        class="form-group p-4 mt-5 mx-auto h-auto col-lg-4 col-md-6 col-sm-12" method="POST">
        <div class="reset-content-holder">
            <h1 class="text-center"><a href="../index.php" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">forgotten password please retype your password</h5>
        </div>
        <div>
          <?php if (!$res['message']) :?>
            <p></p>
          <?php elseif($res['message'] === 'Password Required*') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></i></p>
          <?php elseif($res['message'] === 'Length not long enough') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></i></p>
          <?php elseif($res['message'] === 'Password must be letters and a number') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></i></p>  
          <?php elseif($res['message'] === 'Password Updated Successful, Please login') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-success text-dark p-2"><?php echo $res['message']; ?></p>  
          <?php elseif($res['message'] === 'Password not Updated') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></i></p>    
          <?php else :?>
            <p class="text-center bg-danger text-white p-2"><?php echo $res['message']?></p>
          <?php endif; ?>
        </div>
        <div class="input-group">
           <input type="password" name="password" id="password" class="form-control  mb-3 p-3" 
           placeholder="Enter password" value="<?php echo htmlspecialchars($password);?>">
        </div>
        <p id="errResponsePassword" class="text-danger"><?php echo $res['password']; ?></p>         
        <button type="submit" name="submit" id="restBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">Reset</button>
        <p class="text-center"><a href="login.php">login</a></p>
    </form>

    <footer id="footer">
      <div class="footer-copyright text-center">
        <p><small>&copy; <span id="copyright"></span> All rights reserved <i>Dented</i> | justice foundation &cross;</small></p>
      </div>
    </footer>

    <script src="https://use.fontawesome.com/690d11afa2.js"></script>
    <script src="../assets/js/reset_psw.js"></script>
</body>
</html>