<?php include('./template/admin_header.php'); ?>
    <main id="main-boby">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"  class="form-group p-4 mt-5 mx-auto h-auto col-lg-4 col-sm-12">
            <input type="text" name="fullname" id="fullname" class="form-control  mb-2 p-3">
            <!-- placeholder="Enter your fullname" value="<?php echo htmlspecialchars($fullname);?>"> -->
            <!-- <p id="errResponseFullname" class="text-danger"><?php echo $errors['fullname']; ?></p>          -->
            <input type="email" name="email" id="emailAddress" class="form-control w-100 mb-2 mt-4 p-3" >
            <!-- placeholder="Enter email address" value="<?php echo htmlspecialchars($email);?>"> -->
            <!-- <p id="errResponseEmail" class="text-danger"><?php echo $errors['email']; ?></p> -->
            <input type="password" name="password" id="password" class="form-control  mb-2 p-3" >
            <!-- placeholder="Enter password" value="<?php echo htmlspecialchars($password);?>"> -->
            <!-- <p id="errResponsePassword" class="text-danger"><?php echo $errors['password']; ?></p> -->
            <label for="">Upload image:</label>
            <input type="file" name="profile_photo" id="profile">         
            <button type="submit" name="submit" id="logInBtn" class="btn btn-md c-my-btn w-100 mb-2 p-1">Update</button>
        </form>
    </main>

<?php include('template/admin_footer.php'); ?>