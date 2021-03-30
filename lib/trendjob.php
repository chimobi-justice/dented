<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');

  $sql = "SELECT * FROM company ORDER BY created_at DESC";
  // make query and get result
  
  $result = mysqli_query($conn, $sql);

  // fetch the resulting row as an array

  $companies = mysqli_fetch_all($result, MYSQLI_ASSOC);


  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/trendjob.css">
    <title>Dented | trending jobs</title>
</head>
<body>
     <div class="container pt-3 m-3">
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
    </div>
    <section class="container-fluid mb-5 pb-5 pt-5">
        <?php if ($companies) : ?>
            <div class="trending-job-cards container">
            <div class="row trending-job-cards-wrapper">
                <?php foreach($companies as $company) :?>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <a href="../view.php?viewjobid=<?php echo $company['id']; ?>">
                        <div class="company-card d-flex justify-content-between">
                            <div class="p-3 text-dark">
                                <h6><small><?php echo htmlspecialchars($company['company_name']); ?></small></h6>
                                <h5><?php echo htmlspecialchars($company['company_location']); ?></h5>
                                <h6><?php echo htmlspecialchars($company['job_role']); ?></h6>
                                <h6><?php echo htmlspecialchars($company['job_time']); ?></h6>
                                <small><?php echo htmlspecialchars($company['job_description']); ?></small>
                            </div>
                            <div class="p-3">
                                <img src="../assets/uploads/<?php echo htmlspecialchars($company['uploads']); ?>" class="img-circle" alt="<?php echo htmlspecialchars($company['company_name']); ?> logo">                 
                            </div>
                            </div>  
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>
        <?php else : ?>
            <div class="trending-job-cards container">
                <div class="row trending-job-cards-wrapper">
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">  
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                        <div class="p-5 skeleton">
                    </div>
                </div>
                <div class="text-dark p-1 pl-3">looding...</div>
            <?php endif;?>
        </div>
    </section>
</body>
</html>