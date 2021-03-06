<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".././assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/admin_header.css">
    <title>Dented | profile</title>
</head>
<nav id="navbar">
        <div id="menu-icon">
            <div class="icon"></div>
            <div class="icon icon2"></div>
            <div class="icon"></div>
        </div>
        <div class="user-profile">
            <div class="user-profile-photo">
                <img src="<?php $profile; ?>" alt="profile">
            </div>    
            <p><small>job doe</small></p>
        </div>
    </nav>
    <aside class="aside-nav">
        <h1 id="header"><a href="index.php"><i>Dented</i></a></h1>

        <ul class="list">
            <li class="list-item"><a href="index.php?userprofile=dashboard">Dashboard</a></li>
            <li class="list-item"><a href="../profile.php?userprofile=profile">Profile</a></li>
            <li class="list-item"><a href="index.php?userprofile=setting">Settings</a></li>
            <li class="list-item"><a href="index.php?userprofile=Nope">Nope</a></li>
        </ul>
    </aside>