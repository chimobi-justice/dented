<?php 

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    session_start();

    $user_id = $_SESSION['id'];

    if (!$user_id) {
        header('location: .././auth/login.php');
    }


    $sql = "SELECT * FROM company WHERE account_id = '$user_id'";

    $result = mysqli_query($conn, $sql);
    
    $userPosts = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>


<?php include('template/admin_header.php'); ?>

        <div class="container-fluid" id="postjob-container">
            <div class="row postjob-wrapper">
                <?php foreach($userPosts as $post) : ?>
                    <div class="col-md-4 col-sm-12 col-xm-12 postjob-card-container">
                        <a href="update.php?update&id=<?php echo $post['id']; ?>">
                            <div class="postjob-card d-flex justify-content-between">
                                <div class="p-3 text-dark">
                                    <h6><small><?php echo htmlspecialchars($post['company_name']); ?></small></h6>
                                    <h5><?php echo htmlspecialchars($post['company_location']); ?></h5>
                                    <h6><?php echo htmlspecialchars($post['category']); ?></h6>
                                    <h6><?php echo htmlspecialchars($post['job_time']); ?></h6>
                                </div>
                                <div class="p-3">
                                    <img src="../assets/uploads/<?php echo htmlspecialchars($post['uploads']); ?>" class="img-circle" alt="<?php echo htmlspecialchars($company['company_name']); ?> logo">    
                                </div>
                            </div>
                        </a>
                    </div> 
                <?php endforeach;?>            
            </div>
        </div>

<?php include('template/admin_footer.php'); ?>
