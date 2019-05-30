<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$world_projects = $db->query("SELECT * FROM projects WHERE type = '0' ORDER BY id DESC")->fetchAll();
$thesis_projects = $db->query("SELECT * FROM projects WHERE type = '1' ORDER BY id DESC")->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Home Page</title>
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
    <?php if ($_SESSION["user_login"]["type"] == "0" || $_SESSION["user_login"]["type"] == "2") { ?>
        <hr>
        <div class="col-12">
            <a class="btn btn-primary btn-block text-white" href="project_add.php">Add Project</a>
        </div>
        <hr>
    <?php } ?>
    <div class="row col-12">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Welcome Projects | Current Project in the World</h5>
                    <hr>
                    <?php foreach ($world_projects as $project) { ?>
                        <div class="card" style="margin: 15px 0">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="border-radius: 5px"><?php echo $project["title"]; ?></h5>
                                <hr>
                                <p class="card-text m-0"><span class="font-weight-bold">Information:</span> <?php echo $project["information"]; ?></p>
                                <?php if (isset($project["file"])) { ?>
                                    <img alt="<?php echo $project["file"]; ?>" class="card-text w-75 announcement-img" style="margin: 10px;" src="attends/project/<?php echo $project["file"]; ?>">
                                <?php } ?>
                                <p class="card-text m-0 mb-2"><span class="font-weight-bold text-muted">Publish Date:</span> <?php echo $project["date"]; ?></p>
                                <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                                    <hr>
                                    <a href="system/process.php?process=projectdelete&id=<?php echo $project["id"]?>">
                                        <span class="badge badge-danger badge-pill" style="padding: 5px 10px;">Delete Project</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Welcome Projects | Current Project in the World</h5>
                    <hr>
                    <?php foreach ($thesis_projects as $project) { ?>
                        <?php $user = $db->query("SELECT * FROM users WHERE id = '{$project["user_id"]}'")->fetch(); ?>
                        <div class="card" style="margin: 15px 0">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="border-radius: 5px"><?php echo $project["title"]." - ".$user["name"]." ".$user["surname"]." (".$user["username"].")"; ?></h5>
                                <hr>
                                <p class="card-text m-0"><span class="font-weight-bold">Information:</span> <?php echo $project["information"]; ?></p>
                                <?php if (isset($project["file"])) { ?>
                                    <img alt="<?php echo $project["file"]; ?>" class="card-text w-75 announcement-img" style="margin: 10px;" src="attends/project/<?php echo $project["file"]; ?>">
                                <?php } ?>
                                <p class="card-text m-0 mb-2"><span class="font-weight-bold text-muted">Publish Date:</span> <?php echo $project["date"]; ?></p>
                                <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                                    <hr>
                                    <a href="system/process.php?process=projectdelete&id=<?php echo $project["id"]?>">
                                        <span class="badge badge-danger badge-pill" style="padding: 5px 10px;">Delete Project</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


