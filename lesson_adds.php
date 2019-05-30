<?php
session_start();
require_once ("system/helpers.php");
login_control();

$db = db_connect();
$lessons = $db->query("SELECT * FROM lectures")->fetchAll();
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Learnsth | Lesson Add Note</title>
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
            <h5 class="card-title text-center">Welcome Lesson Add File Tab! You can add Lesson Note, Quiz or Exam here.</h5>
            <p class="text-center text-danger">Just 1 Picture (.jpg, .jpeg, .png) or 1 PDF File.</p>
            <hr>

            <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#add-note" role="tab">Add Note</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#add-quiz" role="tab" >Add Quiz</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#add-exam" role="tab">Add Exam</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="add-note" role="tabpanel">
                    <form method="POST" action="system/process.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="w-100">
                                <select class="form-control" name="file_lesson">
                                    <?php foreach ($lessons as $lesson) { ?>
                                        <option value="<?php echo $lesson["id"]; ?>"><?php echo $lesson["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="file_title" placeholder="Enter File Title (Max: 250 Character)..." required maxlength="250"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="file_information" placeholder="Enter File Information (Nullable)..."></textarea></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="file" class="form-control" name="file_file" required style="height: unset"></label>
                        </div>
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" id="add_type_1" name="file_type" value="0" checked>
                            <label class="form-check-label" for="add_type_1">
                                Note
                            </label>
                        </div>
                        <hr>
                        <label class="w-100"><input type="submit" name="file_lesson_add" value="Add Note for Lesson" class="btn btn-primary btn-block"></label>
                    </form>
                </div>
                <div class="tab-pane fade" id="add-quiz" role="tabpanel">
                    <form method="POST" action="system/process.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="w-100">
                                <select class="form-control" name="file_lesson">
                                    <?php foreach ($lessons as $lesson) { ?>
                                        <option value="<?php echo $lesson["id"]; ?>"><?php echo $lesson["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="file_title" placeholder="Enter File Title (Max: 250 Character)..." required maxlength="250"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="file_information" placeholder="Enter File Information (Nullable)..."></textarea></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="file" class="form-control" name="file_file" required style="height: unset"></label>
                        </div>
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" id="add_type_3" name="file_type" value="2" checked>
                            <label class="form-check-label" for="add_type_3">
                                Quiz
                            </label>
                        </div>
                        <hr>
                        <label class="w-100"><input type="submit" name="file_lesson_add" value="Add Quiz for Lesson" class="btn btn-primary btn-block"></label>
                    </form>
                </div>
                <div class="tab-pane fade" id="add-exam" role="tabpanel">
                    <form method="POST" action="system/process.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="w-100">
                                <select class="form-control" name="file_lesson">
                                    <?php foreach ($lessons as $lesson) { ?>
                                        <option value="<?php echo $lesson["id"]; ?>"><?php echo $lesson["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="text" class="form-control" name="file_title" placeholder="Enter File Title (Max: 250 Character)..." required maxlength="250"></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><textarea class="form-control" name="file_information" placeholder="Enter File Information (Nullable)..."></textarea></label>
                        </div>
                        <div class="form-group">
                            <label class="w-100"><input type="file" class="form-control" name="file_file" required style="height: unset"></label>
                        </div>
                        <div class="form-check d-none">
                            <input class="form-check-input" type="radio" id="add_type_2" name="file_type" value="1" checked>
                            <label class="form-check-label" for="add_type_2">
                                Exam
                            </label>
                        </div>
                        <hr>
                        <label class="w-100"><input type="submit" name="file_lesson_add" value="Add Exam for Lesson" class="btn btn-primary btn-block"></label>
                    </form>
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