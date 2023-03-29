<?php

    if(isset($_POST["submit"])) {

        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        $pwdrepeat = $_POST["pwdrepeat"];


        require_once 'dbh-inc.php';
        require_once 'functions-inc.php';
        
        if(emptyInputSignUp($name, $email, $username, $pwd, $pwdrepeat) !== false){
            header("location: ../signUp.php?error=emptyinput");
            exit();
        }

        if(invalidUsername($username) !== false){
            header("location: ../signUp.php?error=invalidUsername");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("location: ../signUp.php?error=invalidEmail");
            exit();
        }

        if(pwdMatch($pwd, $pwdrepeat) !== false){
            header("location: ../signUp.php?error=Passwordsdontmatch");
            exit();
        }
        if(usernameExist($conn, $username, $email) !== false){
            header("location: ../signUp.php?error=UsernameTaken");
            exit();
        }

        createUser($conn, $name, $email, $username, $pwd);
    
    }
    else{
        header("location: ../signUp.php");
        exit();
    }