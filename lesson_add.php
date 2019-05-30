<?php
session_start();
require_once ("system/helpers.php");
login_control();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Lesson Add</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>

<div id="navbar">
    <?php require_once ("topbar.php"); ?>
    <?php require_once ("navbar.php"); ?>
</div>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Welcome Lesson Add Tab! You can add Lesson</h5>
            <hr>
            <form method="POST" action="system/process.php">
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="lesson_name" placeholder="Enter Lesson Name (Max: 50 Character)..." required maxlength="50"></label>
                </div>
                <hr>
                <label class="w-100"><input type="submit" name="lesson_add" value="Add Lesson" class="btn btn-primary btn-block"></label>
            </form>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>