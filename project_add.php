<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Project Add</title>
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
            <h5 class="card-title text-center">Welcome Add Project Tab! You can add Project</h5>
            <p class="text-center text-danger">Just 1 Picture (.jpg, .jpeg, .png) or 1 PDF File.</p>
            <hr>
            <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                    <form method="POST" action="system/process.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="project_title" placeholder="Enter Project Title (Max: 250 Character)..." required maxlength="250"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="project_information" placeholder="Enter Project Information (Nullable)..."></textarea></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="file" class="form-control" name="project_file" style="height: unset"></label>
                        </div>
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" id="add_type_1" name="project_type" value="0" checked>
                            <label class="form-check-label" for="add_type_1">
                                World
                            </label>
                        </div>
                        <hr>
                        <label class="w-100"><input type="submit" name="project_add" value="Add Current Project in the World" class="btn btn-primary btn-block"></label>
                    </form>
            <?php } ?>

            <?php if ($_SESSION["user_login"]["type"] == "2") { ?>
                    <form method="POST" action="system/process.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="project_title" placeholder="Enter Project Title (Max: 250 Character)..." required maxlength="250"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="project_information" placeholder="Enter Project Information (Nullable)..."></textarea></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="file" class="form-control" name="project_file" style="height: unset"></label>
                        </div>
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" id="add_type_2" name="project_type" value="1" checked>
                            <label class="form-check-label" for="add_type_2">
                                Thesis
                            </label>
                        </div>
                        <hr>
                        <label class="w-100"><input type="submit" name="project_add" value="Add Thesis Project" class="btn btn-primary btn-block"></label>
                    </form>
            <?php } ?>

        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>