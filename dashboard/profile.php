<?php 

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');
    
    session_start();

    $user_id = $_SESSION['id'];

    if (!$user_id) {
        header('location: .././auth/login.php');
    }
    
    $user_profile = $_SESSION['uploads'];
    $user_fullname = '';
    $email = '';
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {
        
        if (!empty($_POST['fullname']) && !empty($_POST['email'])) {
            $user_fullname = $_POST['fullname'];
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $res['message'] = 'Please Enter A Valid Email Address';
            }
            if (!preg_match('/^[a-zA-Z\s]+$/', $user_fullname)) {
                $res['message'] = 'Fullname must be letters and space only';
            }
        } else {
            $res['message'] = 'All fields are required*';
        }

        $imageUpload = $_FILES['profile_image']['name'];
        $imageTmpLoc = $_FILES['profile_image']['tmp_name'];
        $imageUploadType = $_FILES['profile_image']['type'];
        $imageUploadSize = $_FILES['profile_image']['size'];

         if ($imageUploadSize > 5242880) {
            $res['message'] = 'your file is larger than 5 megabytes';
        }

        if (!array_filter($res)) {
            $user_fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $rndNum = rand(111111111, 99999999)."-".$imageUpload;

            $move_result = move_uploaded_file($imageTmpLoc, "../assets/profile_uploads/$rndNum");

            if ($move_result != true) {
                $res['message'] = 'File not uploaded please try again';            
            }

            $sql_email = "SELECT * FROM account WHERE emailaddress =  '$email'";
            $sql_email_result = mysqli_query($conn, $sql_email);
            $count = mysqli_num_rows($sql_email_result);

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
    <title>Dented | profile</title>
</head>

<?php include('template/admin_header.php'); ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" class="col-md-5 col-sm-10 col-xs-12 mx-auto pt-2 p-3 bg-white" id="form">
            <div>
                <?php if (!$res['message']) :?>
                    <p></p>
                <?php elseif($res['message'] === 'All fields are required*') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Fullname must be letters and space only') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>    
                <?php elseif($res['message'] === 'File not uploaded please try again') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p> 
                <?php elseif($res['message'] === 'profile updated') : ?>  
                    <p class="text-center alert alert-success text-dark p-2 response"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Please browse for a file before submit') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>  
                 <?php elseif($res['message'] === 'Please Enter A Valid Email Address') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Email Address Not Found') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Please broswe for a file') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'your file is larger than 5 megabytes') : ?>  
                    <p class="text-center alert alert-danger text-dark p-2 response"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?php echo $res['message']; ?></p>                          
                <?php else :?>
                    <p class="text-center alert alert-danger text-dark p-2"><?php echo $res['message']?></p>
                <?php endif; ?>
            </div>    
            <input type="text" name="fullname" class="form-control mt-4 mb-4 p-3" placeholder="Enter fullname" value="<?php echo htmlspecialchars($user_fullname); ?>">
            <input type="email" name="email" class="form-control mt-4 mb-4 p-3" placeholder="Enter Email Address" value="<?php echo htmlspecialchars($email); ?>">
            <input type="file" name="profile_image" id="profile" class="text-dark">
            <input type="submit" name="submit" value="update profile" class="btn btn-block mt-4 mb-4 c-my-btn">
        </form>

<?php include('template/admin_footer.php'); ?>