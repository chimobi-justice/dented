<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');
    session_start();
    $user_id = $_SESSION['id'];

    $company_name = $company_location = $job_role = $job_time = $company_url = $msgBody = '';
    $res = ['message' => ''];

    if (!$user_id) {
        header('location: .././auth/login.php');
    } 

    if (isset($_POST['submit'])) {

        if (!empty($_POST['company_name'] && $_POST['company_location'] && $_POST['job_role'] && $_POST['job_time'] && $_POST['url'] && $_POST['description'])) {
            $company_name = $_POST['company_name'];
            $company_location = $_POST['company_location'];
            $job_role = $_POST['job_role'];
            $job_time = $_POST['job_time'];
            $company_url = $_POST['url'];
            $msgBody = $_POST['description'];
        }

        $fileName = $_FILES['uploaded_file']['name'];
        $fileTempLoc = $_FILES['uploaded_file']['tmp_name'];
        $fileType = $_FILES['uploaded_file']['type'];
        $fileSize = $_FILES['uploaded_file']['size'];

        if (!$fileTempLoc) {
            $res['message'] = 'Error: please browse for a file before clicking the Submit button';
        } elseif ($fileSize > 5242880) {
            $res['message'] = 'ERROR: your file is larger than 5 megabytes in size';
            unlink($fileTempLoc);
        }

        if (!array_filter($res)) {
            $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
            $company_location = mysqli_real_escape_string($conn, $_POST['company_location']);
            $job_role = mysqli_real_escape_string($conn, $_POST['job_role']);
            $job_time = mysqli_real_escape_string($conn, $_POST['job_time']);
            $company_url = mysqli_real_escape_string($conn, $_POST['url']);
            $msgBody = mysqli_real_escape_string($conn, $_POST['description']);

            $rndNum = rand(111111111, 999999999)."-".$fileName;

            $move_result = move_uploaded_file($fileTempLoc, "../assets/uploads/$rndNum");

            if($move_result != true) {
                $res['message'] = 'ERROR: file not uploaded please try again';
                unlink($fileTempLoc);
            }
            
            $insert_sql = "INSERT INTO company(company_name, company_location, job_role, job_time, company_url, job_description, uploads) VAlues('$company_name',
                                         '$company_location',
                                         '$job_role',
                                         '$job_time',
                                         '$company_url',
                                         '$msgBody',
                                         '$rndNum')"; 
                if (mysqli_query($conn, $insert_sql)) {                  
                    if ($insert_sql) {
                        $res['message'] = 'Posted successfully';
                     } else {
                            $res['message'] = 'ERORR: while processing....';
                    }
                } 
        } 
     }
        
?>

<html>
    <head>     
        <title>Dented | Post a job</title>
    </head>

    <?php include('./template/header.php'); ?>

    <div>
        <?php if(!$res) :?>
            <p></p>
        <?php elseif($res['message'] === 'Posted successfully') :?>  
            <p class="alert alert-success text-dark text-center response p-3"><?php echo $res['message']; ?></p> 
        <?php elseif($res['message'] === 'Error: please browse for a file before clicking the Submit button') :?>  
            <p class="alert alert-danger text-dark text-center response p-3"><?php echo $res['message']; ?></p>
        <?php elseif($res['message'] === 'ERROR: your file is larger than 5 megabytes in size') :?>  
            <p class="alert alert-danger text-dark text-center response p-3"><?php echo $res['message']; ?></p> 
        <?php elseif($res['message'] === 'ERROR: file not uploaded please try again') :?>  
            <p class="alert alert-danger text-dark text-center response p-3"><?php echo $res['message']; ?></p>                         
        <?php endif; ?>      
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" id="form" class="form-group p-4 mt-5 mb-5 mx-auto h-auto col-md-6 col-sm-10 col-xs-12">
        <input type="text" name="company_name" id="companyName" class="form-control w-100 mb-3 mt-2 p-3" placeholder="Company name" value="<?php echo htmlspecialchars($company_name); ?>">
        <input type="text" name="company_location" id="companyLocation" class="form-control w-100 mb-3 mt-2 p-3" placeholder="Location" value="<?php echo htmlspecialchars($company_location); ?>">
        <input type="text" name="job_role" id="role" class="form-control w-100 mb-3 mt-2 p-3" placeholder="Role" value="<?php echo htmlspecialchars($job_role); ?>">
        <input type="text" name="job_time" id="jobTime" class="form-control w-100 mb-3 mt-2 p-3" placeholder="full-time/part-time" value="<?php echo htmlspecialchars($job_time); ?>">
        <input type="url" name="url" id="url" class="form-control w-100 mb-3 mt-2 p-3" placeholder="www.example.com" value="<?php echo htmlspecialchars($company_url); ?>">        
        <textarea name="description" id="msgBody" cols="20" rows="10" class="form-control w-100 mb-3 mt-2 p-3" placeholder="Full Job description"><?php echo htmlspecialchars($msgBody); ?></textarea>
        <div class="form-group">
            <label for="upload" class="text-primary">Upload Company Logo</label>
            <input type="file" name="uploaded_file" id="upload" class="text-dark">
        </div>    
        <input type="submit" name="submit" value="submit" id="submitBtn" disabled="disabled"class="btn btn-lg btn-secondary w-100 mb-2 mt-2 p-2">
    </form>

    <?php include('./template/footer.php'); ?>

</html>