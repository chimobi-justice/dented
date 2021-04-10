<?php 

  error_reporting(E_ALL ^ E_NOTICE);
  include('../config/db_connect.php');

  session_start();

  $user_id = $_SESSION['id'];

  if (!$user_id) {
      header('location: .././auth/login.php');
  }

  $sql = "SELECT * FROM company ORDER BY created_at DESC";
  // make query and get result
  
  $result = mysqli_query($conn, $sql);

  // fetch the resulting row as an array

  $catetgories_companies = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="styles/allcategoryjobs.css">
    <title>Dented | trending jobs</title>
</head>
<body>
     <div class="container pt-3 m-3">
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
    </div>
    <section class="container-fluid mb-5 pb-5 pt-5">
           <?php if ($catetgories_companies) : ?>
                <div class="job-cards container">
                    <div class="row job-cards-wrapper">
                        <?php foreach($catetgories_companies as $job_details) :?>
                            <div class="col-md-3 col-sm-12 col-xm-12 job-cards-container">
                                <div class="job_hold_detail p-4">
                                    <div class="d-flex justify-content-between align-center">
                                        <div class="text">
                                            <h2><?php echo $job_details['category'][0]; ?></h2>
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
                                    <h6><?php echo htmlspecialchars($job_details['category']); ?></h6>
                                    <h6><?php echo htmlspecialchars($job_details['company_name']); ?></h6>
                                    <a href="catjob.php?categoryjobs=<?php echo htmlspecialchars($job_details['id']); ?>" class="btn btn-sm category-btn">know More</a>
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