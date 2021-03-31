<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include('.././config/db_connect.php');

    session_start();
    $fullname = $_SESSION['fullname'];
    $user_id = $_SESSION['id'];

    $sql = "SELECT uploads FROM account WHERE id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    $profile_image = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".././assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/admin_header.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/profile.css">
    <link rel="stylesheet" href="./styles/update.css">
    <link rel="stylesheet" href="./styles/delete.css">
    <link rel="stylesheet" href="./styles/admin_footer.css">
    <title>Dented | dashboard</title>
</head>
<nav id="navbar">
        <div class="menu-holder">
            <div id="menu-icon">
                <div class="icon"></div>
                <div class="icon icon2"></div>
                <div class="icon"></div>
            </div>
            <div id="close-icon">
                <div class="icon"></div>
                <div class="icon icon2"></div>
                <div class="icon"></div>
            </div>
        </div>
        <div class="user-profile">
            <p><small><?php echo $fullname; ?></small></p>
            <div class="user-profile-photo">
                <?php if (!$profile_image['uploads']) : ?>
                    <img src="../assets/images/avatar.png" alt="profile">
                <?php elseif ($profile_image['uploads']) : ?>
                    <img src="../assets/profile_uploads/<?php echo $profile_image['uploads']; ?>" alt="profile">
                <?php else :?>    
                    <img src="../assets/images/avatar.png" alt="profile">
                <?php endif ;?>
            </div>    
        </div>
    </nav>
    <!-- mobile navbar -->
    <nav id="navbar-mobile">
        <div class="menu-holder-mobile">
            <div id="menu-icon-mobile">
                <div class="icon-mobile"></div>
                <div class="icon-mobile icon2-mobile"></div>
                <div class="icon-mobile"></div>
            </div>
        </div>
        <div class="user-profile-mobile">
            <p class="text-dark"><small><?php echo $fullname; ?></small></p>
            <div class="user-profile-photo-mobile">
                <?php if (!$profile_image['uploads']) : ?>
                    <img src="../assets/images/avatar.png" alt="profile">
                <?php elseif ($profile_image['uploads']) : ?>
                    <img src="../assets/profile_uploads/<?php echo $profile_image['uploads']; ?>" alt="profile">
                <?php else :?>    
                    <img src="../assets/images/avatar.png" alt="profile">
                <?php endif ;?>
            </div>    
        </div>
    </nav>

    <aside class="aside-nav-mobile">
        <div class="header d-flex justify-content-between p-3">
            <h1 id="header"><a href="../index.php" class="text-white"><i>Dented</i></a></h1>
            <div id="close-icon-mobile">&times;</div>
        </div>

        <ul class="list-mobile">
            <li class="list-item-mobile"><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>  Dashboard</a></li>
            <li class="list-item-mobile"><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a></li>
            <li class="list-item-mobile"><a href="post.php"><i class="fa fa-clipboard" aria-hidden="true"></i>  Post job</a></li>
            <li class="list-item-mobile"><a href="setting.php"><i class="fa fa-cog" aria-hidden="true"></i>  Settings</a></li>
            <li class="list-item-mobile" name="logout"><a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>  Logout</a></li>
        </ul>
    </aside>

    <!-- END OF MOBILE  -->

    <aside class="aside-nav">
        <h1 id="header"><a href="../index.php"><i>Dented</i></a></h1>

        <ul class="list">
            <li class="list-item"><a href="index.php"><i class="fa fa-tachometer" aria-hidden="true"></i>  Dashboard</a></li>
            <li class="list-item"><a href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>  Profile</a></li>
            <li class="list-item"><a href="post.php"><i class="fa fa-clipboard" aria-hidden="true"></i>  Postjob</a></li>
            <li class="list-item"><a href="setting.php"><i class="fa fa-cog" aria-hidden="true"></i>Settings  </a></li>
            <li class="list-item" name="logout"><a href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>  Logout</a></li>
        </ul>
    </aside>

    <main class="main-body">

    <!-- <i class="fa fa-spinner" aria-hidden="true"></i> -->