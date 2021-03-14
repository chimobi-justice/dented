<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    session_start();

    $user_id = $_SESSION['id'];
    $scrt = $_SESSION['scrtpsw'];


    if (!$user_id) {
        header('location: .././auth/login.php');
    }

    $user_set_fullname = $user_set_email = $user_set_current_psw = $user_set_new_psw = '';
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {
        
        if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['current_psw']) && !empty($_POST['new_psw'])) {
            $user_set_fullname = $_POST['fullname'];
            $user_set_email = $_POST['email'];
            $user_set_current_psw = $_POST['current_psw'];
            $user_set_new_psw = $_POST['new_psw'];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $res['message'] = 'Please Enter A Valid Email Address';
            }
            if (!preg_match('/^[a-zA-Z]/' ,$user_fullname) {
                $res['message'] = 'Fullname must be letters only';
            }
            if (strlen($user_set_current_psw) < 6) {
                $res['message'] = 'length not long enough';
              } else {
                  if ($user_set_current_psw !== $scrt) {
                    $res['message'] = 'Password Not match';
                  }
                // if (!preg_match('/^[a-zA-Z]+[0-9]+$/', $user_set_current_psw)) {
                //   $res['password'] = 'password must be letters and a number';
                // }
              }
        } else {
            $res['message'] = 'All fields are required*';
        }

        if (!array_filter($res)) {
            $user_set_fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $user_set_email = mysqli_real_escape_string($conn, $_POST['email']);
            $user_set_current_psw = mysqli_real_escape_string($conn, $_POST['current_psw']);
            $user_set_new_psw = mysqli_real_escape_string($conn, $_POST['new_psw']);


            $sql = "SELECT * FROM account WHERE fullname = '$user_set_fullname', emailaddress =  '$user_set_email', psw = $user_set_current_psw";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                $sql = "UPDATE account set fullname = '$user_fullname', emailaddress = '$email', uploads = '$rndNum' WHERE id = '$user_id'";

                if (mysqli_query($conn, $sql)) {
                    $res['message'] = 'profile updated';
                } 

                if (isset($_GET['id'])) {
                    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

                    $result = mysqli_query($conn, $query);

                    $my_user = mysqli_fetch_assoc($result);

                    mysqli_free_result($result);

                    mysqli_close($conn);


                }
            } else {
                $res['message'] = 'Email Address Not Found';
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
                <?php elseif($res['message'] === 'All fields are required*') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'File not uploaded please try agian') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p> 
                <?php elseif($res['message'] === 'profile updated') : ?>  
                    <p class="text-center alert alert-success text-dark p-2 response"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Please browse for a file before submit') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>  
                 <?php elseif($res['message'] === 'Please Enter A Valid Email Address') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Email Address Not Found') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>
                    <?php elseif($res['message'] === 'Email Address Not Found') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $res['message']; ?></p>                      
                <?php else :?>
                    <p class="text-center alert alert-danger text-dark p-2"><?php echo $res['message']?></p>
                <?php endif; ?>
            </div>  

            <input type="text" name="fullname" class="form-control mt-4 mb-4 p-3" placeholder="Enter fullname" value="<?php echo htmlspecialchars($user_set_fullname); ?>">
            <input type="email" name="email" class="form-control mt-4 mb-4 p-3" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($user_set_email); ?>">
            <input type="password" name="current_psw" class="form-control mt-4 mb-4 p-3" placeholder="Enter Current Password" value="<?php echo htmlspecialchars($user_set_current_psw); ?>">
            <input type="password" name="new_psw" class="form-control mt-4 mb-4 p-3" placeholder="Enter New Password" value="<?php echo htmlspecialchars($user_set_new_psw); ?>">
            <input type="submit" name="submit" value="Submit" class="btn btn-block mt-4 mb-4 c-my-btn">
        </form>

<?php include('template/admin_footer.php'); ?>