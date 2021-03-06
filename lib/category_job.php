<?php

    include('../config/db_connect.php');

    $category_job_role = mysqli_real_escape_string($conn, $_GET['categoryjobs']);

    $query = "SELECT * FROM company WHERE job_role = '$category_job_role'";
      
    $result = mysqli_query($conn, $query);

    $category_job_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
    

    mysqli_free_result($result);

    mysqli_close($conn);


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/category_job.css">
        <title>Dented | category Jobs</title>
    </head>
    <body>
        <div class="container pt-3 m-3">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
        </div>

        <section class="container-fluid mb-5 pb-5 pt-5">
        <div class="job-cards container">
            <div class="row job-cards-wrapper">
                <?php foreach($category_job_details as $job_details) :?>
                    <div class="col-md-4 col-sm-12 col-xm-12 job-cards-container">
                        <div class="job_hold_detail p-4">
                            <div class="d-flex justify-content-between align-center">
                                <div>
                                    <img src="../assets/images/myicon.png" class="img-circle"> 
                                </div>  
                                <div>
            <pre>
            ..........
            ..........
            ..........
            ..........
            </pre>
                                </div>
                            </div>
                            <h5><?php echo htmlspecialchars($job_details['job_role']); ?></h5>
                            <h5><?php echo htmlspecialchars($job_details['company_name']); ?></h5>
                            <a href="lib/catjob.php?categoryjobs=<?php echo htmlspecialchars($job_details['job_role']); ?>" class="btn btn-sm category-btn">know More</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
        
    </body>
</html>    