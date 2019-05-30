<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$lessons = $db->query("SELECT * FROM lectures", PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Lesson Delete</title>
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
            <h5 class="card-title text-center">Welcome Lesson Delete Tab! You can delete add Lesson here...</h5>
            <hr>
            <?php if ($lessons) { ?>
                <ul class="list-group">
                    <?php foreach ($lessons as $lesson) { ?>
                        <li class="list-group-item">
                            <span class="btn"><?php echo $lesson["name"]; ?></span>
                            <a href="system/process.php?process=lessondelete&id=<?php echo $lesson["id"]; ?>" class="btn btn-danger text-white float-right"><i class="fas fa-trash-alt"></i></a>
                        </li>
                    <?php } ?>
                </ul>
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