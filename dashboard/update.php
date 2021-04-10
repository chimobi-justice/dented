<?php 

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    session_start();
    
    $user_id = $_SESSION['id'];

    $res = ['message' => ''];

    if (!$user_id) {
        header('location: .././auth/login.php');
    }

    $id = $_GET['id'];


    $sql = "SELECT * FROM company WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
    $posts = mysqli_fetch_assoc($result);
    $company_id = $posts['id'];
    $company_name = $posts['company_name'];
    $company_location = $posts['company_location'];
    $category = $posts['category'];
    $job_time = $posts['job_time'];
    $msgBody = $posts['description'];
    $uploads = $posts['uploads'];

    }


?>      

<?php include('template/admin_header.php'); ?>

        <div>
            <?php if(!$res) :?>
                <p></p>
            <?php elseif($res['message'] === 'Job post has been deleted successfully') :?>  
                <p class="alert alert-success text-dark text-center response p-3"><i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo $response['message']; ?></p> 
            <?php elseif($res['message'] === 'Error while Deleting, Please try again') :?>  
                <p class="alert alert-danger text-dark text-center response p-3"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>  <?php echo $response['message']; ?></p>
              <?php echo $res['message']; ?></p> 
            <?php else :?>  
                <p><?php echo $res['message']; ?></p>                         
            <?php endif; ?>      
        </div>

        <div class="container-fluid" id="updatejob-container">
            <div class="row updatejob-wrapper">
                    <div class="col-md-6 mx-auto col-sm-12 col-xm-12 updatejob-card-container">
                            <div class="updatejob-card d-flex justify-content-between">
                                <div class="p-3 text-dark">
                                    <h6><small><?php echo htmlspecialchars($company_name); ?></small></h6>
                                    <h5><?php echo htmlspecialchars($company_location); ?></h5>
                                    <h6><?php echo htmlspecialchars($category); ?></h6>
                                    <h6><?php echo htmlspecialchars($job_time); ?></h6>
                                    <small><?php echo htmlspecialchars($msgBody); ?></small>
                                    <form method="POST">
                                        <a href="edit.php?update&editid=<?php echo $company_id; ?>" name="update" class="btn btn-sm btn-info">Update</a>
                                        <input type="hidden" value="<?php echo $id; ?>" name="delete_post">
                                        <a href="delete.php?update&id=<?php echo $posts['id']; ?>" name="delete" class="btn btn-sm btn-danger">Delete</a>
                                    </form>             
                                </div>
                                <div class="p-3">
                                    <img src="../assets/uploads/<?php echo htmlspecialchars($uploads); ?>" class="img-circle" alt="<?php echo htmlspecialchars($company['company_name']); ?> logo">    
                                </div>
                            </div>
                    </div>             
            </div>
        </div>

<?php include('template/admin_footer.php'); ?>