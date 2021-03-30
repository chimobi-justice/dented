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
        $job_role = $posts['job_role'];
        $job_time = $posts['job_time'];
        $msgBody = $posts['description'];
        $uploads = $posts['uploads'];
        }
        
        
        if(isset($_POST['ok'])) {
            $getId = $_POST['delete_post'];
            
            $sql = "DELETE FROM company WHERE id = '$getId'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header('location: index.php');
            } else {
                return false;
            }
        }


?>

<?php include('template/admin_header.php'); ?>   

    <form method="POST" id="form" 
        class="form-group p-4 mt-5 mx-auto h-auto col-md-4 col-sm-10 col-xs-12 text-center">
            <div class="content">
                <h5 class="text-center">Are you sure you really what to delete</h5>
            </div>
            <button name="ok" class="btn btn-sm btn-info">Ok</button>
            <input type="hidden" value="<?php echo $posts['id']; ?>" name="delete_post">
            <a href="update.php?update&id=<?php echo $posts['id']; ?>" name="cancel" class="btn btn-sm btn-danger">Cancel</a>
    </form>

 <?php include('template/admin_footer.php'); ?>
