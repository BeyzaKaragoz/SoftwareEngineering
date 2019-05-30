<?php
session_start();
require_once ("system/helpers.php");
login_control();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Announcement Add</title>
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
            <h5 class="card-title text-center">Welcome Announcement Add Tab! You can add Announcement</h5>
            <hr>
            <form method="POST" action="system/process.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="announcement_title" placeholder="Enter Announcement Title (Max: 50 Character)..." required maxlength="50"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><textarea class="form-control" name="announcement_description" placeholder="Enter Announcement Description (Nullable)..."></textarea></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="file" class="form-control" name="announcement_file" style="height: unset"></label>
                </div>
                <hr>
                <label class="w-100"><input type="submit" name="announcement_add" value="Add Announcement" class="btn btn-primary btn-block"></label>
            </form>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>