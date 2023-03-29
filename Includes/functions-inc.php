<?php
    function emptyInputSignUp($name, $email, $username, $pwd, $pwdrepeat){
        $result;
        if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidUsername($username) {
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email) {
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pwd, $pwdrepeat) {
        $result;
        if($pwd !== $pwdrepeat){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function usernameExist($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE userUsername	 = ? OR userEmail = ?;"; //connect to database
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signUp.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);

        
    }

    function createUser($conn, $name, $email, $username, $pwd) {
        $sql = "INSERT INTO users (userName, userEmail, userUsername, userPwd) VALUES (?, ?, ?, ?);"; 
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signUp.php?error=stmtFailed");
            exit();
        }


        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $pwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signUp.php?error=none");
        exit();
        
    }

    function emptyInputLogIn($username, $pwd){
        $result;
        if(empty($username) || empty($pwd)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function loginUser($conn, $username, $pwd){
        $uidExists = usernameExist($conn, $username, $username);

        if ($uidExists === false) {
            header("location: ../logIn.php?error=WrongLogIn");
            exit();
        }

        $pwd2 = $uidExists["userPwd"];
        if ($pwd !== $pwd2) {
            header("location: ../logIn.php?error=WrongLogIn");
            exit();
        }else {
            session_start();
            $_SESSION["userid"] = $uidExists["userId"];
            $_SESSION["useruid"] = $uidExists["userUsername"];
            header("location: ../index.php");
            
            exit();
        }
    }

    function checkUserExists($conn, $email) {
        $sql = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signUp.php?error=stmtFailed");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                // user exists
                return true;
            } else {
                // user doesn't exist
                return false;
            }
        }
    }
    



    