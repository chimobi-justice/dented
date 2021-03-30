<?php

    include('config/db_connect.php');


        // if (isset($_GET['categoryjobs'])) {
        //     $category = mysqli_real_escape_string($conn, $_GET['categoryjobs']);

        //     $query = "SELECT * FROM company WHERE job_role = '$category'";
            
            // $result = mysqli_query($conn, $query);

            // $category_job_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
            

            // mysqli_free_result($result);

            // mysqli_close($conn);

            $sql = "SELECT * FROM company ORDER BY created_at DESC";
            // make query and get result
            
            $result = mysqli_query($conn, $sql);
          
            // fetch the resulting row as an array
          
            $companies = mysqli_fetch_all($result, MYSQLI_ASSOC);
          
          
            // free result from memory
            mysqli_free_result($result);
          
            // close connection
            mysqli_close($conn);
        
        // }    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/view.css">
    <title>Dented | view Job</title>
</head>
<body>
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
           <?php if ($companies) : ?>
                <div class="job-cards container">
                    <div class="row job-cards-wrapper">
                        <?php foreach($companies as $company) :?>
                            <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                                <div class="job_hold_detail p-4">
                                    <div class="d-flex justify-content-between align-center">
                                        <div>
                                            <img src="assets/images/myicon.png" class="img-circle"> 
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
                                    <h5><?php echo htmlspecialchars($company['job_role']); ?></h5>
                                    <h5><?php echo htmlspecialchars($company['company_name']); ?></h5>
                                    <a href="catjob.php?categoryjobs=<?php echo htmlspecialchars($company['id']); ?>" class="btn btn-sm category-btn">know More</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
            <?php else : ?>
                <div class="job-cards container">
                    <div class="row row-flex job-cards-wrapper">
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                            <div class="skeleton p-4"></div>
                        </div>
                    </div>
                    <div class="text-dark p-1">looding...</div>
                </div>  
            <?php endif; ?>
        </div>
    </section>
        
    </body>
</html>    
    
</body>
</html>