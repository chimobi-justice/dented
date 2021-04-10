<?php

  error_reporting(E_ALL ^ E_NOTICE);
  include('./config/db_connect.php');

  $sql = "SELECT * FROM company ORDER BY created_at limit 8";

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
          <a href="lib/allcategoryjobs.php?categoryjobs" class="text-dark">Explore Category</a>
        </div>
      </div>
        <?php if ($categories) : ?>
            <div class="category_cards container">
                <div class="row row-flex category-cards-wrapper">
                    <?php foreach($categories as $category) :?>
                        <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                            <div class="category_hold_detail p-4">
                                <div class="d-flex justify-content-between align-center">
                                    <div class="text">
                                        <h2><?php echo $category['category'][0]; ?></h2>
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
                                <h6><?php echo htmlspecialchars($category['category']); ?></h6>
                                <p  class="text-dark">job vacancy</p>
                                <a href="lib/category_job.php?categoryjobs=<?php echo htmlspecialchars($category['category']); ?>" class="btn btn-sm category-btn">View More</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php else : ?>
            <div class="category_cards container">
                <div class="row row-flex category-cards-wrapper">
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xm-12 category-cards-container">
                        <div class="skeleton p-4"></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
      </div>  
  </section>
