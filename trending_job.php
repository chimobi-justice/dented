<?php
  error_reporting(E_ALL ^ E_NOTICE);
  include('./config/db_connect.php');

  $sql = "SELECT * FROM company ORDER BY created_at DESC limit 9";
  // make query and get result
  
  $result = mysqli_query($conn, $sql);

  // fetch the resulting row as an array

  $companies = mysqli_fetch_all($result, MYSQLI_ASSOC);


  // free result from memory
  mysqli_free_result($result);

  // close connection
  mysqli_close($conn);


?>

<section class="container-fluid mb-5 pb-5">
    <div class="container d-flex justify-content-between text-dark trending-job-heading pt-5 pb-5">
      <div>
        <h1>Most Trending</h1>
        <h1>Remote Jobs</h1>
      </div>
      <div class="pt-5 p-5">
        <a href="lib/trendjob.php" class="text-dark">Explore More Jobs</a>
      </div>
    </div>
    <div class="trending-job-cards container">
      <div class="row trending-job-cards-wrapper">
        <?php foreach($companies as $company) :?>
            <div class="col-md-4 col-sm-12 col-xm-12 trending-job-cards-container">
                <a href="view.php?viewjobid=<?php echo $company['id']; ?>">
                  <div class="company-card d-flex justify-content-between">
                      <div class="p-3 text-dark">
                          <h6><small><?php echo htmlspecialchars($company['company_name']); ?></small></h6>
                          <h5><?php echo htmlspecialchars($company['company_location']); ?></h5>
                          <h6><?php echo htmlspecialchars($company['job_role']); ?></h6>
                          <h6><?php echo htmlspecialchars($company['job_time']); ?></h6>
                          <small><?php echo htmlspecialchars($company['job_description']); ?></small>
                      </div>
                      <div class="p-3">
                          <img src="assets/uploads/<?php echo htmlspecialchars($company['uploads']); ?>" class="img-circle" alt="company logo">                 
                      </div>
                    </div>  
                </a>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
</section>
