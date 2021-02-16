<?php 

  $password = $email = '';
  $errors = ['email' => '', 'password' => ''];
  $res = ['message' => ''];

  if (isset($_POST['submit'])) {

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
    <title>Dented | login</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
</head>
<body>
    
    <form action="login.php" id="loggedIn-form" class="form-group p-4 mt-5 mx-auto h-auto" method="POST">
        <div class="login-content-holder">
            <h1 class="text-center"><a href="#" title="Dented - Home"><i >Dented</i></a></h1>
            <h5 class="text-center">Sign in to continue to Dented Jobs Internship</h5>
        </div>
        <p class="text-center text-danger"><?php echo $res['message']; ?></p>
        <input type="email" name="email" id="emailAddress" class="form-control w-100 mb-3 mt-4 p-3" 
        placeholder="Enter email address" value="<?php echo htmlspecialchars($email);?>">
        <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p>
        <div class="input-group">
           <input type="password" name="password" id="password" class="form-control  mb-3 p-3" 
           placeholder="Enter password" value="<?php echo htmlspecialchars($password);?>">
           <button id="show-btn" type="button" class="btn btn-sm btn-default bg-gray showPassword">Show</button>
           <button id="hide-btn" type="button" class="btn btn-sm btn-default bg-gray hidePassword">Hide</button>
        </div>
        <p id="errResponsePassword" class="text-danger"><?php echo $errors['password']; ?></p>         
        <button type="submit" name="submit" id="logInBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">login</button>
        <div class="d-flex justify-content-between">
            <div>
              <a href="#" class="text-dark">Forgotten password</a>
            </div>
            <div>
              <a href="#" class="text-dark">Already a user signup here</a>
            </div>
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