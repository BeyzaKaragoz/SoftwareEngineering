<?php

session_start();
require_once("helpers.php");
$db = db_connect();

// USER REGISTER BLOCK
if (isset($_POST["user_register"])){
    $query = $db->prepare("INSERT INTO users SET username = ?, name = ?, surname = ?, mail = ?, password = ?, information = ?, company = ?, type = ?");
    $insert = $query->execute(array(
        $_POST["user_username"],
        $_POST["user_name"],
        $_POST["user_surname"],
        $_POST["user_mail"],
        SHA1($_POST["user_password"]),
        $_POST["user_information"],
        $_POST["user_company"],
        $_POST["user_type"]
    ));
    if ($insert){
        header("Location: /learnsth/login.php");
    }
}

// USER LOGIN BLOCK
if (isset($_POST["user_login"])){
    $query = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->execute(array(
        $_POST["user_username"],
        SHA1($_POST["user_password"])
    ));
    $select = $query->fetch(PDO::FETCH_ASSOC);
    if ($select){
        $_SESSION["user_login"] = $select;
        header("Location: /learnsth/index.php");
    } else {
        header("Location: /learnsth/login.php");
    }
}

if (isset($_POST["lesson_add"])){
    $query = $db->prepare("INSERT INTO lectures SET name = ?");
    $insert = $query->execute(array(
        $_POST["lesson_name"]
    ));
    if ($insert){
        header("Location: /learnsth/lessons.php");
    }
}

if (isset($_POST["file_lesson_add"])){
    $fileTmpPath = $_FILES['file_file']['tmp_name'];
    $fileName = $_FILES['file_file']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $uploadFileDir = '../attends/files/';
        $dest_path = $uploadFileDir . $newFileName;
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $query = $db->prepare("INSERT INTO lecture_adds SET lecture_id = ?, user_id = ?, title = ?, information = ?, file = ?, type = ?");
            $insert = $query->execute(array(
                $_POST["file_lesson"],
                $_SESSION["user_login"]["id"],
                $_POST["file_title"],
                $_POST["file_information"],
                $newFileName,
                $_POST["file_type"]
            ));
            if ($insert){
                header("Location: /learnsth/lessons.php");
            }
        }
        else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
    }
}

if (isset($_POST["announcement_add"])){
    if ($_FILES["announcement_file"]["size"] > 0){
        $fileTmpPath = $_FILES['announcement_file']['tmp_name'];
        $fileName = $_FILES['announcement_file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../attends/announcement/';
            $dest_path = $uploadFileDir . $newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = $db->prepare("INSERT INTO announcement SET user_id = ?, title = ?, description = ?, file = ?, date = ?");
                $insert = $query->execute(array(
                    $_SESSION["user_login"]["id"],
                    $_POST["announcement_title"],
                    $_POST["announcement_description"],
                    $newFileName,
                    date("Y-m-d H:i:s")
                ));
                if ($insert){
                    header("Location: /learnsth/index.php");
                }
            }
            else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    } else {
        $query = $db->prepare("INSERT INTO announcement SET user_id = ?, title = ?, description = ?, date = ?");
        $insert = $query->execute(array(
            $_SESSION["user_login"]["id"],
            $_POST["announcement_title"],
            $_POST["announcement_description"],
            date("Y-m-d H:i:s")
        ));
        if ($insert){
            header("Location: /learnsth/index.php");
        }
    }
}

if (isset($_POST["project_add"])){
    if ($_FILES["project_file"]["size"] > 0){
        $fileTmpPath = $_FILES['project_file']['tmp_name'];
        $fileName = $_FILES['project_file']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../attends/project/';
            $dest_path = $uploadFileDir . $newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $query = $db->prepare("INSERT INTO projects SET user_id = ?, title = ?, information = ?, file = ?, date = ?, type = ?");
                $insert = $query->execute(array(
                    $_SESSION["user_login"]["id"],
                    $_POST["project_title"],
                    $_POST["project_information"],
                    $newFileName,
                    date("Y-m-d H:i:s"),
                    $_POST["project_type"]
                ));
                if ($insert){
                    header("Location: /learnsth/projects.php");
                }
            }
            else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    } else {
        $query = $db->prepare("INSERT INTO projects SET user_id = ?, title = ?, information = ?, date = ?, type = ?");
        $insert = $query->execute(array(
            $_SESSION["user_login"]["id"],
            $_POST["project_title"],
            $_POST["project_information"],
            date("Y-m-d H:i:s"),
            $_POST["project_type"]
        ));
        if ($insert){
            header("Location: /learnsth/projects.php");
        }
    }
}

if (isset($_POST["survey_add"])){
    $query = $db->prepare("INSERT INTO survey SET title = ?, option1 = ?, option2 = ?, date = ?");
    $insert = $query->execute(array(
        $_POST["survey_title"],
        $_POST["survey_option_1"],
        $_POST["survey_option_2"],
        date("Y-m-d H:i:s")
    ));
    if ($insert){
        header("Location: /learnsth/index.php");
    }
}

if (isset($_POST["survey_send"])){
    $query = $db->prepare("INSERT INTO survey_users SET user_id = ?, survey_id = ?, answer = ?");
    $insert = $query->execute(array(
        $_SESSION["user_login"]["id"],
        $_POST["survey_id"],
        $_POST["survey_option"]
    ));
    if ($insert){
        header("Location: /learnsth/index.php");
    }
}

if (isset($_POST["announcement_post_add"])){
    $query = $db->prepare("INSERT INTO announcement_posts SET announcement_id = ?, user_id = ?, post = ?, date = ?");
    $insert = $query->execute(array(
        $_POST["announcement_id"],
        $_SESSION["user_login"]["id"],
        $_POST["announcement_post"],
        date("Y-m-d H:i:s")
    ));
    if ($insert){
        header("Location: /learnsth/index.php");
    }
}

if (isset($_POST["user_update"])){
    if ($_SESSION["user_login"]["type"] == "2") {
        $query = $db->prepare("UPDATE users SET name = ?, surname = ?, information = ?, company = ? WHERE id = '{$_SESSION["user_login"]["id"]}'");
        $update = $query->execute(array(
            $_POST["user_name"],
            $_POST["user_surname"],
            $_POST["user_information"],
            $_POST["user_company"]
        ));
    } else {
        $query = $db->prepare("UPDATE users SET name = ?, surname = ? WHERE id = '{$_SESSION["user_login"]["id"]}'");
        $update = $query->execute(array(
            $_POST["user_name"],
            $_POST["user_surname"],
        ));
    }
    if ($update){
        $user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION["user_login"]["id"]}'")->fetch();
        $_SESSION["user_login"] = $user;
        header("Location: /learnsth/user_edit.php");
    }
}

if (isset($_POST["send_message"])){
    $query = $db->prepare("INSERT INTO messages SET from_user_id = ?, to_user_id = ?, message = ?, date = ?");
    $insert = $query->execute(array(
        $_SESSION["user_login"]["id"],
        $_POST["user_id"],
        $_POST["message"],
        date("Y-m-d H:i:s")
    ));
    if ($insert){
        header("Location: /learnsth/messages.php");
    }
}

if (isset($_GET["process"])){
    if ($_GET["process"] == "logout"){
        unset($_SESSION["user_login"]);
        header("Location: /learnsth/login.php");
    }
    if ($_GET["process"] == "lessondelete"){
        $query = $db->prepare("DELETE FROM lectures WHERE id = :id");
        $delete = $query->execute(array(
            "id" => $_GET["id"]
        ));
        header("Location: /learnsth/lesson_delete.php");
    }
    if ($_GET["process"] == "filedelete"){
        $query = $db->prepare("DELETE FROM lecture_adds WHERE id = :id");
        $delete = $query->execute(array(
            "id" => $_GET["id"]
        ));
        header("Location: /learnsth/lessons.php");
    }
    if ($_GET["process"] == "announcementdelete"){
        $query = $db->prepare("DELETE FROM announcement WHERE id = :id");
        $delete = $query->execute(array(
            "id" => $_GET["id"]
        ));
        header("Location: /learnsth/index.php");
    }
    if ($_GET["process"] == "projectdelete"){
        $query = $db->prepare("DELETE FROM projects WHERE id = :id");
        $delete = $query->execute(array(
            "id" => $_GET["id"]
        ));
        header("Location: /learnsth/projects.php");
    }
    if ($_GET["process"] == "surveydelete"){
        $query = $db->prepare("DELETE FROM survey WHERE id = :id");
        $delete = $query->execute(array(
            "id" => $_GET["id"]
        ));
        header("Location: /learnsth/index.php");
    }
    if ($_GET["process"] == "filedownload"){
        $file = $db->query("SELECT * FROM lecture_adds WHERE id = '{$_GET["id"]}'")->fetch();
        $file_url = '../attends/files/'.$file["file"];
        header("Content-Disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}

?>