<?php

    include('config/db_connect.php');

    $search = '';
    $trimSearch = '';
    $trimStr = '';
    $response = NULL;

    $sql = "SELECT * FROM company ORDER BY created_at DESC";

    $result = mysqli_query($conn, $sql);

    $allCompanies = mysqli_fetch_all($result, MYSQLI_ASSOC); 

    if (isset($_POST['submit'])) {
        $search = $_POST['search']; 

        $trimSearch = trim($search);
        
        $trimStr = mysqli_real_escape_string($conn, $trimSearch);

        $sql = "SELECT * FROM company WHERE company_name LIKE '%$trimStr%' OR category LIKE '%$trimStr%' OR job_time LIKE '%$trimStr%'";

        $search_result = mysqli_query($conn, $sql);

        $search_count = mysqli_num_rows($search_result);
  

        $rows = mysqli_fetch_all($search_result, MYSQLI_ASSOC);
        
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/styles/search.css">
    <title>Dented | search for Job</title>
</head>
<body>

    <?php include('template/header.php'); ?>

    <div class="container pt-5 mt-3 mb-5 text-dark">
        <h3 class="searchContent">Search and Apply For Your Best Programming Job Here!</h3>
        <h5 class="searchContent">Seeking For Jobs Apply Here!</h5>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="input-group">
                <input type="text" name="search" class="form-control p-4" id="search" placeholder="type or search for a job......." value="<?php echo htmlspecialchars($trimStr); ?>">
                <input type="submit" value="Search" name="submit" class="btn btn-lg c-my-btn">
            </div>
            <div><?php echo $response; ?></div>  
            <?php if ($trimStr && $search_count): ?>
                <br><br><br>
                <div class="searching-job-cards container">
                    <div class="row searching-job-cards-wrapper">
                        <?php foreach($rows as $row) :?>
                            <div class="col-md-12 col-sm-12 col-xm-12 mb-3 searching-job-apply-card-container bg-white">
                                <div class="searching-job-apply-card">
                                    <div class="searching-job-card p-3">
                                        <div>
                                            <img src="assets/uploads/<?php echo htmlspecialchars($row['uploads']); ?>" class="img-circle" alt="company logo"> 
                                        </div>
                                        <div class="p-3 text-dark">                   
                                            <h5><small><?php echo htmlspecialchars($row['company_name']); ?></small></h5>
                                            <h6><?php echo htmlspecialchars($row['category']); ?></h6>
                                        </div>    
                                    </div>
                                    <div class="p-3 text-dark apply-holder">
                                        <a href="<?php echo htmlspecialchars($company['company_url']); ?>" class="btn btn-md btn-warning">Apply</a>
                                    </div>
                                </div>  
                            </div>
                        <?php endforeach; ?>    
                    </div>
                </div>  
                <?php return  true; ?>

            <?php elseif($trimStr) :?>
                <br><br><br>
                <div class="noting_found text-center text-dark">
                    <h4>Sorry Could't Found Any Job with that Search!</h4>
                    <img src="assets/images/about-img.png">             
                    <?php return true;?>
                </div> 
                                
            <?php endif;?>
        </form>
    </div>
    
    <section class="container-fluid mb-5 pb-5 pt-5">
        <?php if ($allCompanies) : ?>
            <div class="searching-job-cards container">
                <div class="row searching-job-cards-wrapper">
                    <?php foreach($allCompanies as $company) :?>
                        <div class="col-md-12 col-sm-12 col-xm-12 mb-3 searching-job-apply-card-container bg-white">
                            <div class="searching-job-apply-card">
                                <div class="searching-job-card p-3">
                                    <div>
                                        <img src="assets/uploads/<?php echo htmlspecialchars($company['uploads']); ?>" class="img-circle" alt="company logo"> 
                                    </div>
                                    <div class="p-3 text-dark">                   
                                        <h5><small><?php echo htmlspecialchars($company['company_name']); ?></small></h5>
                                        <h6><?php echo htmlspecialchars($company['category']); ?></h6>
                                    </div>    
                                </div>
                                <div class="p-3 text-dark apply-holder">
                                    <a href="<?php echo htmlspecialchars($company['company_url']); ?>" class="btn btn-md btn-warning">Apply</a>
                                </div>
                            </div>  
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>  
        <?php else : ?>
            <div class="searching-job-cards container">
                <div class="row searching-job-cards-wrapper">
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">  
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xm-12 searching-job-apply-card-container">
                        <div class="p-5 skeleton">
                    </div>
                    </div>
                </div>
                
            <?php endif;?>
        </div>
    </section>

    <?php include('template/footer.php'); ?>
    
</body>
</html>