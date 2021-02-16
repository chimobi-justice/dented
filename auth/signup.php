<?php 

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
    
    <form action="signup.php" id="signup-form" class="form-group p-4 mt-5 mx-auto h-auto" method="POST">
        <div class="signup-content-holder">
            <h1 class="text-center"><a href="#" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">Sign up to your Dented Jobs Internships</h5>
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
        <div class="text-right">
           <a href="login.php" class="text-dark">Already a user signin here</a>
        </div>
    </form>

    <footer id="footer">
      <div class="footer-copyright text-center">
        <p><small>&copy; All rights reserved <i>Dented</i> | justice foundation &cross;</small></p>
      </div>
    </footer>

    <script src="../assets/js/signup.js"></script>
</body>
</html>