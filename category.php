<?php

  error_reporting(E_ALL ^ E_NOTICE);
  include('./config/db_connect.php');

  $sql = "SELECT * FROM company ORDER BY created_at DESC limit 8";

  $result = mysqli_query($conn, $sql);

  $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);

  mysqli_close($conn);


?>

  <section class="container-fluid">
      <div class="container d-flex justify-content-between text-dark category-heading pt-5 pb-5">
        <div>
          <h1>Remote Jobs</h1>
          <h1>By Category</h1>
        </div>
        <div class="pt-5 p-5">
          <a href="view.php" class="text-dark">Explore Category</a>
        </div>
      </div>
      <div class="category_cards container">
          <div class="row category-cards-wrapper">
              <?php foreach($categories as $category) :?>
                  <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                      <div class="category_hold_detail p-4">
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
                          <h5><?php echo htmlspecialchars($category['job_role']); ?></h5>
                          <p  class="text-dark">14 job vacancy</p>
                          <a href="lib/category_job.php?categoryjobs=<?php echo htmlspecialchars($category['job_role']); ?>" class="btn btn-sm category-btn">View More</a>
                      </div>
                  </div>
              <?php endforeach; ?>

          </div>
      </div>  
  </section>
