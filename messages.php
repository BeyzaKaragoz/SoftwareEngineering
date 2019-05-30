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
    <title>Learnsth | Messages</title>
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
            <h5 class="card-title text-center">Welcome Messages Tab! You can send messages to Student</h5>
            <hr>
            <div class="row">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <?php $to_users = $db->query("SELECT to_user_id AS user_id FROM messages WHERE (from_user_id = '{$_SESSION["user_login"]["id"]}') GROUP BY to_user_id")->fetchAll(PDO::FETCH_COLUMN); ?>
                        <?php $from_users = $db->query("SELECT from_user_id AS user_id FROM messages WHERE (to_user_id = '{$_SESSION["user_login"]["id"]}') GROUP BY from_user_id")->fetchAll(PDO::FETCH_COLUMN); ?>
                        <?php foreach ($to_users as $user) { ?>
                            <?php if (!in_array($user, $from_users)) { ?>
                                <?php $info = $db->query("SELECT * FROM users WHERE id = '{$user}'")->fetch(); ?>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#user-<?php echo $info["id"]; ?>">
                                    <?php echo $info["name"]." ".$info["surname"]." - ".$info["username"]; ?>
                                </a>
                            <?php } else {
                                $key = array_search($user, $to_users);
                                unset($to_users[$key]);
                            } ?>
                        <?php } ?>
                        <?php foreach ($from_users as $user) { ?>
                            <?php if (!in_array($user, $to_users)) { ?>
                                <?php $info = $db->query("SELECT * FROM users WHERE id = '{$user}'")->fetch(); ?>
                                <a class="list-group-item list-group-item-action" data-toggle="list" href="#user-<?php echo $info["id"]; ?>">
                                    <?php echo $info["name"]." ".$info["surname"]." - ".$info["username"]; ?>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <?php $to_users = $db->query("SELECT to_user_id AS user_id FROM messages WHERE (from_user_id = '{$_SESSION["user_login"]["id"]}') GROUP BY to_user_id")->fetchAll(PDO::FETCH_COLUMN); ?>
                        <?php $from_users = $db->query("SELECT from_user_id AS user_id FROM messages WHERE (to_user_id = '{$_SESSION["user_login"]["id"]}') GROUP BY from_user_id")->fetchAll(PDO::FETCH_COLUMN); ?>
                        <?php foreach ($to_users as $user) { ?>
                            <?php if (!in_array($user, $from_users)) { ?>
                                <?php $info = $db->query("SELECT * FROM users WHERE id = '{$user}'")->fetch(); ?>
                                <?php $messages = $db->query("SELECT * FROM messages WHERE (from_user_id = '{$_SESSION["user_login"]["id"]}' AND to_user_id = '{$info["id"]}') OR (to_user_id = '{$_SESSION["user_login"]["id"]}' AND from_user_id = '{$info["id"]}') ORDER BY id DESC")->fetchAll(); ?>
                                <div class="tab-pane fade" id="user-<?php echo $info["id"]; ?>" role="tabpanel">
                                    <p>Messages with <?php echo $info["username"]; ?></p>
                                    <hr>
                                    <ul class="list-group text-left">
                                        <?php foreach ($messages as $message) { ?>
                                            <li class="list-group-item list-group-item-<?php echo ($message["from_user_id"] == $_SESSION["user_login"]["id"]) ? "warning" : "primary" ?>">
                                                <p class="m-0 font-weight-bold">
                                                    <span class="float-right text-muted font-weight-normal"><?php echo $message["date"]?></span>
                                                </p>
                                                <p class="m-0">
                                                    <?php if($message["from_user_id"] == $_SESSION["user_login"]["id"]) { ?><i class="fas fa-share"></i><?php } ?>
                                                    <?php echo $message["message"]; ?>
                                                </p>
                                            </li>
                                        <?php } ?>
                                        <li class="list-group-item">
                                            <form action="system/process.php" method="post">
                                                <div class="form-group d-none">
                                                    <label class="w-100"><input type="text" class="form-control" name="user_id" value="<?php echo $info["id"]; ?>" required></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="w-100"><textarea class="form-control" name="message" placeholder="Enter your Message..."></textarea></label>
                                                </div>
                                                <label class="w-100 m-0"><input type="submit" name="send_message" value="Send Message" class="btn btn-primary btn-block"></label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            <?php } else {
                                $key = array_search($user, $to_users);
                                unset($to_users[$key]);
                            } ?>
                        <?php } ?>
                        <?php foreach ($from_users as $user) { ?>
                            <?php if (!in_array($user, $to_users)) { ?>
                                <?php $info = $db->query("SELECT * FROM users WHERE id = '{$user}'")->fetch(); ?>
                                <?php $messages = $db->query("SELECT * FROM messages WHERE (from_user_id = '{$_SESSION["user_login"]["id"]}' AND to_user_id = '{$info["id"]}') OR (to_user_id = '{$_SESSION["user_login"]["id"]}' AND from_user_id = '{$info["id"]}') ORDER BY id DESC")->fetchAll(); ?>
                                <div class="tab-pane fade" id="user-<?php echo $info["id"]; ?>" role="tabpanel">
                                    <p>Messages with <?php echo $info["username"]; ?></p>
                                    <hr>
                                    <ul class="list-group text-left">
                                        <?php foreach ($messages as $message) { ?>
                                            <li class="list-group-item list-group-item-<?php echo ($message["from_user_id"] == $_SESSION["user_login"]["id"]) ? "warning" : "primary" ?>">
                                                <p class="m-0 font-weight-bold">
                                                    <span class="float-right text-muted font-weight-normal"><?php echo $message["date"]?></span>
                                                </p>
                                                <p class="m-0">
                                                    <?php if($message["from_user_id"] == $_SESSION["user_login"]["id"]) { ?><i class="fas fa-share"></i><?php } ?>
                                                    <?php echo $message["message"]; ?>
                                                </p>
                                            </li>
                                        <?php } ?>
                                        <li class="list-group-item">
                                            <form action="system/process.php" method="post">
                                                <div class="form-group d-none">
                                                    <label class="w-100"><input type="text" class="form-control" name="user_id" value="<?php echo $info["id"]; ?>" required></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="w-100"><textarea class="form-control" name="message" placeholder="Enter your Message..."></textarea></label>
                                                </div>
                                                <label class="w-100 m-0"><input type="submit" name="send_message" value="Send Message" class="btn btn-primary btn-block"></label>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
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