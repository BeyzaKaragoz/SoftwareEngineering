<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$lessons = $db->query("SELECT * FROM lectures")->fetchAll();
$files = $db->query("SELECT * FROM lecture_adds")->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Lessons</title>
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
            <h5 class="card-title">Welcome Lesson Tab! You can find Lesson Adds</h5>
            <hr>
            <?php if ($lessons) { ?>
                <div class="accordion" id="accordionLessons">
                    <?php foreach ($lessons as $lesson) { ?>
                        <div class="card">
                            <div class="card-header bg-light" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-outline-primary btn-block collapsed" type="button" data-toggle="collapse" data-target="#lesson<?php echo $lesson["id"];?>" aria-expanded="false">
                                        <?php echo $lesson["name"]; ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="lesson<?php echo $lesson["id"];?>" class="collapse" data-parent="#accordionLessons">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php $found = false; ?>
                                        <?php foreach ($files as $file) { ?>
                                            <?php if ($file["lecture_id"] == $lesson["id"]) { ?>
                                                <?php $found = true; ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-<?php echo get_file_color($file["type"]); ?>">
                                                    <?php
                                                    echo "Title: ".$file["title"]."<br>";
                                                    echo (!empty($file["information"])) ? "Information: ".$file["information"]."<br>" : "";
                                                    $user = $db->query("SELECT * FROM users WHERE id = '{$file["user_id"]}'")->fetch();
                                                    echo "Owner: ".$user["username"];
                                                    ?>
                                                    <div>
                                                        <a href="system/process.php?process=filedownload&id=<?php echo $file["id"]?>">
                                                            <span class="badge badge-<?php echo get_file_color($file["type"]); ?> badge-pill" style="padding: 5px; width: 150px">Click for Download <?php echo get_file_type($file["type"]); ?></span>
                                                        </a>
                                                        <?php if ($_SESSION["user_login"]["type"] == "0") { ?>
                                                            <br>
                                                            <a href="system/process.php?process=filedelete&id=<?php echo $file["id"]?>">
                                                                <span class="badge badge-danger badge-pill" style="padding: 5px; width: 150px">Delete <?php echo get_file_type($file["type"]); ?></span>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </li>
                                        <?php } } ?>
                                        <?php if (!$found) { ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-danger">
                                                Lesson not have any files.
                                            </li>
                                        <?php } ?>
                                        <?php $found = false; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <p>Lessons Not Found!</p>
            <?php } ?>
        </div>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>