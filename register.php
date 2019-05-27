<?php
session_start();
require_once ("system/helpers.php");
?>

<!DOCTYPE html>

<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Sign Up</title>
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
            <h5 class="card-title">Sign Up Learnsth</h5>
            <hr>

            <form method="POST" action="system/process.php">
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_name" placeholder="Enter your Name..." required></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_surname" placeholder="Enter your Surname..." required></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="email" class="form-control" name="user_mail" placeholder="Enter your E-Mail..." required></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_username" placeholder="Enter your Username (Max: 20 Character)..." required maxlength="20"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="password" class="form-control" name="user_password" placeholder="Enter your Password (Min: 8 Character)..." required minlength="8"></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="user_type_1" name="user_type" value="1" checked onclick="hide()">
                    <label class="form-check-label" for="user_type_1">
                        Ungraduate Student
                    </label>
                </div>
                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" id="user_type_2" name="user_type" value="2" onclick="show()">
                    <label class="form-check-label" for="user_type_2">
                        Graduate Student
                    </label>
                </div>
                <div class="graduate-student">
                    <div class="form-group">
                        <label class="w-100"><input type="text" class="form-control" name="user_company" placeholder="Enter your Company..."></label>
                    </div>
                    <div class="form-group">
                        <label class="w-100"><textarea class="form-control" name="user_information" placeholder="Enter your Information..."></textarea></label>
                    </div>
                </div>
                <label class="w-100"><input type="submit" name="user_register" value="Sign Up" class="btn btn-primary btn-block"></label>
            </form>
            <a href="login.php" class="btn btn-danger btn-block">Log In</a>
        </div>
    </div>
</div>


<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        hide();
    });
    function show() {
        $(".graduate-student").show();
    }
    function hide() {
        $(".graduate-student").hide();
    }
</script>
</body>
</html>


