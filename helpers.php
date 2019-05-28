<?php

function db_connect(){
    try {
        return $db = new PDO("mysql:host=localhost;dbname=learnsth;charset=utf8", "root", "12345678");
    } catch (PDOException $error) {
        return $error->getMessage();
    }
}

function login_control(){
    if (!isset($_SESSION["user_login"])){
        header("Location: /learnsth/login.php");
    }
}

function login_user_greeter(){
    return "Hello! ".$_SESSION["user_login"]["username"]." - ".$_SESSION["user_login"]["name"]." ".$_SESSION["user_login"]["surname"];
}

function get_file_color($type){
    switch ($type){
        case "0":
            return "primary";
            break;
        case "1":
            return "success";
            break;
        case "2":
            return "warning";
            break;
    }
}

function get_file_type($type){
    switch ($type){
        case "0":
            return "Note";
            break;
        case "1":
            return "Exam";
            break;
        case "2":
            return "Quiz";
            break;
    }
}

?>