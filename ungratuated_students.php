<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$users = $db->query("SELECT * FROM users WHERE type = '1'")->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Students</title>
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
            <h5 class="card-title text-center">Welcome Student Tab! You can add Lesson</h5>
            <hr>
            <ul class="list-group">
                <?php foreach ($users as $user) { ?>
                    <li class="list-group-item">
                        <div class="row no-gutters student">
                            <div class="col-md-2">
                                <img src="attends/user.png" class="card-img" alt="User Logo">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $user["name"]." ".$user["surname"]." - ".$user["username"]; ?></h5>
                                    <hr>
                                    <p class="card-text m-0"><span class="font-weight-bold">E-Mail:</span> <?php echo $user["mail"]; ?></p>
                                    <hr>
                                    <a class="btn btn-primary btn-block text-white" href="send_message.php?user_id=<?php echo $user["id"]; ?>">Send Message</a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>