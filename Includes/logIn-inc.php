<?php

if (isset($_POST["submit"])) {

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
   
    require_once 'dbh-inc.php';
    require_once 'functions-inc.php';

    if(emptyInputLogIn($username, $pwd) !== false){
        header("location: ../logIn.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);    
} else {
    header("location: ../logIn.php");
    exit();
}