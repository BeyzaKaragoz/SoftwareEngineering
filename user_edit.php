<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION["user_login"]["id"]}'")->fetch();
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
            <h5 class="card-title text-center">Welcome User Edit Tab! You can edit your Account</h5>
            <hr>
            <form method="POST" action="system/process.php">
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_name" placeholder="Enter your Name..." required value="<?php echo $user["name"]; ?>"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input type="text" class="form-control" name="user_surname" placeholder="Enter your Surname..." required value="<?php echo $user["surname"]; ?>"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input disabled type="email" class="form-control" name="user_mail" placeholder="Enter your E-Mail..." required value="<?php echo $user["mail"]; ?>"></label>
                </div>
                <div class="form-group">
                    <label class="w-100"><input disabled type="text" class="form-control" name="user_username" placeholder="Enter your Username (Max: 20 Character)..." required maxlength="20" value="<?php echo $user["username"]; ?>"></label>
                </div>
                <?php if ($_SESSION["user_login"]["type"] == "0" || $_SESSION["user_login"]["type"] == "2") { ?>
                    <div class="graduate-student">
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="user_company" placeholder="Enter your Company..." value="<?php echo $user["company"]; ?>"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="user_information" placeholder="Enter your Information..."><?php echo $user["information"]; ?></textarea></label>
                        </div>
                    </div>
                <?php } ?>
                <label class="w-100"><input type="submit" name="user_update" value="Update Account" class="btn btn-primary btn-block"></label>
            </form>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>