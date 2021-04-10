<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');

  session_start();
  $user_id = $_SESSION['id'];
  $user_email_address = $_SESSION['email'];

  $email = '';
  $res = ['message' => ''];

  if (isset($_POST['submit'])) {

    if (empty($_POST['email'])) {
      $res['message'] = 'Email Address Required*';
    } else {
      $email = $_POST['email'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $res['message'] = 'Please Enter A Valid Email Address';
      } //else { //Email to be sent to user 
      //   $toEmail = "Dented@gmail.org";
      //   $subject = 'Forgotten Password'. $user_full_name;
      //   $body = "<h2>Dented Forgotten Password</h2>
      //          <h4>Name</h4><p>'. $user_full_name'</p>
      //          <h4>Email</h4><p>'. $user_email_address'</p>
      //          <p><a href="forgotpsw.php" class="btn btn-info>Click Link</a></p>";
        
      //   $headers = "MIME-Version: 1.0" . "\r\n";
      //   $headers .= "Content-Type:text/html;charset=UTF-8". "\r\n";
        
      //   $headers .= "From Dented: .$user_full_name . $user_email_address" .  "\r\n";

      //   if (mail($toEmail, $subject, $body, $headers)) {
      //     $res['message'] = 'Your email has been sent';
      //   } else {
      //      $res = 'Your email was not sent';
      //   }
      // }
    }

    if (!array_filter($res)) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);

      $sql = "SELECT emailaddress FROM account WHERE emailaddress = '$email'";
      $sql_result = mysqli_query($conn, $sql);
      $check_user_email_address = mysqli_num_rows($sql_result);

      if ($check_user_email_address > 0) {
        $user = mysqli_fetch_assoc($sql_result);
        $user_id;

        header('location: reset_psw.php');
      } else {
        $res['message'] = 'Email adrress not found';
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
    <title>Dented | forgotten password</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/forgotpsw.css">
</head>
  <body>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="forpsw-form"
        class="form-group p-4 mt-5 mx-auto h-auto col-lg-4 col-md-6 col-sm-12" method="POST">
        <div class="forpsw-content-holder">
            <h1 class="text-center"><a href="../index.php" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">forgotten password please enter your email address to retype your password</h5>
        </div>
        <div>
          <?php if (!$res) :?>
            <p></p>
          <?php elseif($res['message'] === 'Email adrress not found') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></p>
          <?php elseif($res['message'] === 'Please Enter A Valid Email Address') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></p>
          <?php elseif($res['message'] === 'Email Address Required*') : ?>  
            <p id="errMessageDisplay" class="text-center alert alert-danger text-dark p-2"><i class="fa fa-exclamation-circle" aria-hidden="true"> <?php echo $res['message']; ?></p>
          <?php else :?>
            <p><?php echo $res['message']?></p>
          <?php endif; ?>
        </div>         
        <input type="email" name="email" id="emailAddress" class="form-control w-100 mb-2 mt-4 p-3" 
        placeholder="Enter email address" value="<?php echo htmlspecialchars($email);?>">
        <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p>
        <button type="submit" name="submit" id="forgottenBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">Send</button>
    </form>

    <footer id="footer">
      <div class="footer-copyright text-center">
        <p><small>&copy; <span id="copyright"></span> All rights reserved <i>Dented</i> | justice foundation &cross;</small></p>
      </div>
    </footer>

    <script src="https://use.fontawesome.com/690d11afa2.js"></script>
    <script src="../assets/js/forgotpsw.js"></script>
  </body>
</html>