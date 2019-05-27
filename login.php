<?php
session_start();
require_once ("system/helpers.php");
?>

<!DOCTYPE html>

<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Log In</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="height: 85%;">

<div id="navbar">
    <?php require_once ("topbar.php"); ?>
</div>

<div class="h-100 row align-items-center w-100">
    <div class="card text-center w-25" style="margin: auto">
        <div class="card-body">
            <h5 class="card-title">Log In Learnsth</h5>
            <hr>
            <form method="POST" action="system/process.php">
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_username" placeholder="Enter your Username (Max: 20 Character)..." required maxlength="20"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="password" class="form-control" name="user_password" placeholder="Enter your Password (Min: 8 Character)..." required minlength="8"></label>
                </div>
                <hr>
                <label class="w-100"><input type="submit" name="user_login" value="Log In" class="btn btn-primary btn-block"></label>
            </form>
            <a href="register.php" class="btn btn-danger btn-block">Sign Up</a>
        </div>
    </div>
</div>


<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


