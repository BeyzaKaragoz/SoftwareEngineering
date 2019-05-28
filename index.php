<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$announcements = $db->query("SELECT * FROM announcement ORDER BY id DESC")->fetchAll();
$surveys = $db->query("SELECT * FROM survey ORDER BY id DESC")->fetchAll();
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
    <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
        <hr>
        <div class="col-12">
            <a class="btn btn-primary btn-block text-white" href="announcement_add.php">Add Announcement</a>
        </div>
        <div class="col-12">
            <a class="btn btn-primary btn-block text-white mt-2" href="survey_add.php">Add Survey</a>
        </div>
        <hr>
    <?php } ?>
    <div class="row col-12">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Welcome Index | Announcements</h5>
                    <hr>
                    <?php foreach ($announcements as $announcement) { ?>
                        <div class="card" style="margin: 15px 0">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="border-radius: 5px"><?php echo $announcement["title"]; ?></h5>
                                <hr>
                                <p class="card-text m-0"><span class="font-weight-bold">Description:</span> <?php echo $announcement["description"]; ?></p>
                                <?php if (isset($announcement["file"])) { ?>
                                    <img alt="<?php echo $announcement["file"]; ?>" class="card-text w-75 announcement-img" style="margin: 10px;" src="attends/announcement/<?php echo $announcement["file"]; ?>">
                                <?php } ?>
                                <p class="card-text m-0 mb-2"><span class="font-weight-bold text-muted">Publish Date:</span> <?php echo $announcement["date"]; ?></p>
                                <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                                    <hr>
                                    <a href="system/process.php?process=announcementdelete&id=<?php echo $announcement["id"]?>">
                                        <span class="badge badge-danger badge-pill" style="padding: 5px 10px;">Delete Announcement</span>
                                    </a>
                                <?php } ?>
                                <hr>
                                <?php $posts = $db->query("SELECT * FROM announcement_posts WHERE announcement_id = '{$announcement["id"]}' ORDER BY id DESC")->fetchAll(); ?>
                                <ul class="list-group text-left">
                                    <li class="list-group-item">
                                        <form action="system/process.php" method="post">
                                            <div class="form-group d-none">
                                                <label class="w-100"><input type="text" class="form-control" name="announcement_id" value="<?php echo $announcement["id"]; ?>" required></label>
                                            </div>
                                            <div class="form-group">
                                                <label class="w-100 m-0"><textarea class="form-control" name="announcement_post" placeholder="Enter your Post..."></textarea></label>
                                            </div>
                                            <label class="w-100 m-0"><input type="submit" name="announcement_post_add" value="Post It" class="btn btn-primary btn-block"></label>
                                        </form>
                                    </li>
                                    <?php foreach ($posts as $post) { ?>
                                        <?php $post_user = $db->query("SELECT * FROM users WHERE id = '{$post["user_id"]}'")->fetch(); ?>
                                        <li class="list-group-item">
                                            <p class="m-0 font-weight-bold">
                                                <?php echo $post_user["name"]." ".$post_user["surname"]." - ".$post_user["username"]; ?>
                                                <span class="float-right text-muted font-weight-normal"><?php echo $post["date"]?></span>
                                            </p>
                                            <p class="m-0"><i class="fas fa-share"></i> <?php echo $post["post"]; ?></p>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Welcome Index | Surveys</h5>
                    <hr>
                    <?php foreach ($surveys as $survey) { ?>
                        <?php $user_survey = $db->query("SELECT * FROM survey_users WHERE user_id = '{$_SESSION["user_login"]["id"]}' AND survey_id = '{$survey["id"]}'")->fetch(); ?>
                        <div class="card" style="margin: 15px 0">
                            <div class="card-body text-center">
                                <h5 class="card-title" style="border-radius: 5px"><?php echo $survey["title"]; ?></h5>
                                <hr>
                                <form action="system/process.php" method="post">
                                    <div class="form-group d-none">
                                        <label class="w-100"><input type="text" class="form-control" name="survey_id" value="<?php echo $survey["id"]; ?>" required></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="survey_option_1" name="survey_option" value="0" checked>
                                        <label class="form-check-label" for="survey_option_1">
                                            <?php echo $survey["option1"]; ?>
                                            <?php $query = $db->query("SELECT COUNT(*) AS count FROM survey_users WHERE survey_id = '{$survey["id"]}' AND answer = '0'")->fetch(); echo "(".$query["count"].")"; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="radio" id="survey_option_2" name="survey_option" value="1">
                                        <label class="form-check-label" for="survey_option_2">
                                            <?php echo $survey["option2"]; ?>
                                            <?php $query = $db->query("SELECT COUNT(*) AS count FROM survey_users WHERE survey_id = '{$survey["id"]}' AND answer = '1'")->fetch(); echo "(".$query["count"].")"; ?>
                                        </label>
                                    </div>
                                    <p class="card-text m-0 mb-2"><span class="font-weight-bold text-muted">Publish Date:</span> <?php echo $survey["date"]; ?></p>
                                    <hr>
                                    <?php if (!$user_survey) { ?>
                                        <label class="w-100"><input type="submit" name="survey_send" value="Send Survey" class="btn btn-success btn-block"></label>
                                    <?php } else { ?>
                                        <label class="w-100"><input type="submit" name="survey_send" value="Pre-Send" class="btn btn-success btn-block" disabled></label>
                                    <?php } ?>
                                </form>
                                <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                                    <a href="system/process.php?process=surveydelete&id=<?php echo $survey["id"]?>">
                                        <span class="badge badge-danger badge-pill" style="padding: 5px 10px;">Delete Survey</span>
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


