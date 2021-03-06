<?php

    include('config/db_connect.php');

    $company_id = mysqli_real_escape_string($conn, $_GET['viewjobid']);

    $query = "SELECT * FROM company WHERE id = '$company_id'";
      
    $result = mysqli_query($conn, $query);

    $company_details = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    mysqli_close($conn);


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
    <div class="container pt-3 m-3">
        <a href="<?php echo ROOT_URL; ?>" class="btn btn-md mt-2 c-my-btn">Back</a>
    </div>
    <div class="container pt-5 mt-3 mb-5">
        <div class="company_logo">
            <img src="assets/uploads/<?php echo htmlspecialchars($company_details['uploads']); ?>" class="rounded" alt="<?php echo htmlspecialchars($company_details['company_name']); ?> logo">
        </div>
        <div class="container pt-3">
            <h3 class="mt-5"><?php echo htmlspecialchars($company_details['company_name']); ?></h3>
            <label>Job Description:</label>
            <p class="border p-4 mt-2 mb-5 description"><?php echo htmlspecialchars($company_details['job_description']); ?>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, eligendi labore? Repellat voluptatum maiores dolorum velit ea natus explicabo optio error odit alias nostrum eum excepturi aliquid, nulla pariatur dicta saepe? Facere ducimus dolorem inventore, commodi alias voluptas eum beatae totam error. Commodi maiores, ea, at distinctio aliquam quae accusantium debitis voluptate non, harum libero excepturi nulla autem animi ex?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, eligendi labore? Repellat voluptatum maiores dolorum velit ea natus explicabo optio error odit alias nostrum eum excepturi aliquid, nulla pariatur dicta saepe? Facere ducimus dolorem inventore, commodi alias voluptas eum beatae totam error. Commodi maiores, ea, at distinctio aliquam quae accusantium debitis voluptate non, harum libero excepturi nulla autem animi ex?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse, eligendi labore? Repellat voluptatum maiores dolorum velit ea natus explicabo optio error odit alias nostrum eum excepturi aliquid, nulla pariatur dicta saepe? Facere ducimus dolorem inventore, commodi alias voluptas eum beatae totam error. Commodi maiores, ea, at distinctio aliquam quae accusantium debitis voluptate non, harum libero excepturi nulla autem animi ex?
            </p>
            <h5 class="mb-5">More Details visit Company Website <a class="link" href="<?php echo htmlspecialchars($company_details['company_url']); ?>">Here</a></h5>
            <h3>Job Details</h3>
            <div class="jumbotron">
                <label>Date Posted:</label>
                <h5><?php echo htmlspecialchars($company_details['created_at']); ?></h5>
                <label>Job Vacancy:</label>
                <h5><?php echo htmlspecialchars($company_details['job_role']); ?></h5> 
                <label>Job Time:</label>
                <h5><?php echo htmlspecialchars($company_details['job_time']); ?></h5>
                <label>Location:</label>
                <h5><?php echo htmlspecialchars($company_details['company_location']); ?></h5>
            </div>
        </div>
</div>
    
</body>
</html>