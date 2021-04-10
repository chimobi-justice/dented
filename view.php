<?php

    include('config/db_connect.php');

    session_start();

    $user_id = $_SESSION['id'];

    if (!$user_id) {
        header('location: ././auth/login.php');
    }

    if (isset($_GET['viewjobid'])) {
        $veiwId = mysqli_real_escape_string($conn, $_GET['viewjobid']);

        $query = "SELECT * FROM company WHERE id = $veiwId";

        $result = mysqli_query($conn, $query);

        $company = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);

    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/view.css">
    <title>Dented | view Job</title>
</head>
<body>
    <section>
        <div class="container pt-3 m-3">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
        </div>
        <div class="container pt-5 mt-3 mb-5">
            <div class="row category-job-apply-card-wrapper">
                <div class="col-md-12 col-sm-12 col-xm-12 category-job-apply-card-container text-dark">
                    <div class="category-job-apply-card">
                        <div class="category-job-card-img-holder p-3">
                            <img src="assets/uploads/<?php echo htmlspecialchars($company['uploads']); ?>" class="img-circle" alt="company logo">    
                        </div>
                        <div class="p-3 text-dark">                   
                           <h5>Company Name: <small><?php echo htmlspecialchars($company['company_name']); ?></small></h5>
                        </div>
                        <div id="job_description" class="p-3">
                            <h4>Job Description:</h4>
                            <p><?php echo htmlspecialchars($company['job_description']); ?></p>
                        </div>
                        <div class="details-job-card container">
                            <div class="row details-job-card-wrapper">
                                 <h4 class="p-3">Job Details:</h4>
                                    <div class="col-md-12 col-sm-12 col-xm-12 mb-3 details-job-apply-card-container bg-white">
                                        <div class="details-job-apply-card">
                                            <div class="details-holder p-1">
                                                <div class="p-3 text-dark">                   
                                                    <h5>Category: <small><?php echo htmlspecialchars($company['category']); ?></small></h5>
                                                    <h5>Location: <small><?php echo htmlspecialchars($company['company_location']); ?></small></h5>
                                                    <h5>Position: <small><?php echo htmlspecialchars($company['job_time']); ?></small></h5>
                                                    <h5>Date Posted: <small><?php echo htmlspecialchars($company['created_at']); ?></small></h5>
                                                </div> 
                                                <div class="p-3 text-dark">
                                                    <a href="<?php echo htmlspecialchars($company['company_url']); ?>" class="btn btn-md c-my-btn">Apply</a>
                                                </div>   
                                            </div>
                                        </div>  
                                    </div>
                            </div>
                        </div>  
                    </div>                    
                </div>
            </div>
        </div>
    </section>
</body>
</html>    