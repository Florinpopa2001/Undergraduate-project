<?php

if (isset($_POST["reset-password-submit"])) {
    $selector = $_POST["selector"];
    $token = $_POST["token"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];
    

    if (empty($password) || empty($passwordRepeat)) {
        //check here
        header("Location: ../create-new-password.php?newpass=empty&selector=" . $selector . "&token=" . $token);
        exit();
    } else if($password != $passwordRepeat){
        header("Location: ../create-new-password.php?newpass=pwdsnotsame&selector=" . $selector . "&token=" . $token);
        exit();
    }

    //Get the current time and add 1800 seconds (30 minutes) to it.
    $currentDate = date("U") + 1800;

    require 'dbh-inc.php';
    $sql = "SELECT *FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'A aparut o eroare!';
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"ss",$selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo 'Trebuie sa retrimiti formularul de resetare!';
            exit();
        } else {
            $tokenBin = hex2bin($token);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
        
            if ($tokenCheck === false) {
                echo 'Trebuie sa retrimiti formularul de resetare!';
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];
                $sql = "SELECT  * FROM users WHERE userEmail= ?;"; 
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    echo 'A aparut o eroare!';
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo 'A aparut o eroare!';  
                        exit();
                    } else {
                         $sql = "UPDATE users SET userPwd = ? WHERE userEmail = ?";
                         $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt,$sql)) {
                            echo 'A aparut o eroare!';
                            exit();
                        }else{
                            mysqli_stmt_bind_param($stmt,"ss",$password, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt,$sql)) {
                                echo 'A aparut o eroare!';
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../logIn.php?newpwd=parolaschimbata");
                            }
                        }
                    }    
                }

            }
        }
    }
}else{
    header("Location: ../index.php");
}