<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectare</title>
    <link rel="icon" href="./Icons/logo-icon.ico">
    <link rel="stylesheet" href="Styles/logIn.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://fontawesome.com/icons"></script>
    <script src="https://kit.fontawesome.com/a4dace6bf3.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container">
        <div class="form-boxLogin">
            <h1 id="title">Conectare</h1>
            <form action="Includes/logIn-inc.php" method="post" >
                <div class="input-group">

                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Numele de utilizator/Email" name="uid">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" placeholder="Parola" name="pwd">
                    </div>
                </div>

                <div class="button-field">
                    <button type="submit"  name="submit">Conectare</button>
                </div>
            </form>
            <div id="error-container"></div>

            <?php
            if (isset($_GET["newpwd"])) {
                if ($_GET["newpwd"] == "parolaschimbata") {
                    echo "<p><font color = white>Parola a fost schimbată!</p>";
                }
            }
            ?>
            <!--Forgotten password -->
            <a class= "pwdtextforgot" href="signUp.php">Creeaza cont!</a>
            <a href="resetPassword.php" class= "pwdtextforgot">Ați uitat parola?!</a>


            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                        \"positionClass\": \"toast-center\"
                    }; toastr.error('Introduceți toate datele!')</script>";
    
                }
                else if($_GET["error"] == "WrongLogIn"){
                    echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                        \"positionClass\": \"toast-center\"
                    }; toastr.error('Date de logare greșite!')</script>"; 
                }
            }

            
            ?>
        </div>
    </div>

</body>
</html>
