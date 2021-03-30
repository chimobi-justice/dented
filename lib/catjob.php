<?php

    include('../config/db_connect.php');

    if(isset($_GET['categoryjobs'])) {
        
        $id = mysqli_real_escape_string($conn, $_GET['categoryjobs']);
    
        $query = "SELECT * FROM company WHERE id = '$id'";
          
        $result = mysqli_query($conn, $query);
    
        $get_company = mysqli_fetch_assoc($result);
    
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
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/catjob.css">
    <title>Dented | view Job</title>
</head>
<body>
    <div class="container pt-3 m-3">
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
    </div>
    <div class="container pt-5 mt-3 mb-5 text-dark">
        <h3>Apply For Your Best Programming Job Here!</h3>
        <p>Seeking For Jobs Apply Here!</p>
    </div>
    <div class="container pt-5 mt-3 mb-5">
        <div class="row category-job-apply-card-wrapper">
            <div class="col-md-12 col-sm-12 col-xm-12 category-job-apply-card-container bg-white">
                <div class="category-job-apply-card d-flex justify-content-between">
                     <div class="category-job-card d-flex justify-content-between p-3">
                         <div>
                            <img src="../assets/uploads/<?php echo htmlspecialchars($get_company['uploads']); ?>" class="img-circle" alt="company logo"> 
                         </div>
                         <div class="p-3 text-dark">                   
                            <h5><small><?php echo htmlspecialchars($get_company['company_name']); ?></small></h5>
                            <h6><?php echo htmlspecialchars($get_company['job_role']); ?></h6>
                         </div>    
                     </div>
                     <div class="p-3 text-dark">
                        <a href="<?php echo htmlspecialchars($get_company['company_url']); ?>" class="btn btn-md c-my-btn">Apply</a>
                      </div>
                </div>  
            </div>
        </div>
    </div>
    
</body>
</html>