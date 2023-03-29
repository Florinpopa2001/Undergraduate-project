<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" href="./Icons/logo-icon.ico">
    <link rel="stylesheet" href="Styles/signUp.css">
    <script src="https://fontawesome.com/icons"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://kit.fontawesome.com/a4dace6bf3.js" crossorigin="anonymous"></script>

</head>
<body>

    <div class="container">
        <div class="form-boxInregistrare">
            <h1 id="title">Înregistrare</h1>
            <form action="Includes/signUp-inc.php" method="post" >
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Nume si prenume" name="name">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-at"></i>
                        <input type="email" placeholder="Email" name="email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Nume de utilizator" name="username">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" placeholder="Parola" name="pwd">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" placeholder="Confirma Parola" name="pwdrepeat">
                    </div>
                </div>

                <div class="button-field">
                    <button type="submit"  name="submit">Înregistrare</button>
                </div>
            </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Introduceți toate datele!')</script>"; 
            }
            else if($_GET["error"] == "invalidUsername"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Alegeți alt nume de utilizator!')</script>"; 
            }
            else if($_GET["error"] == "invalidEmail"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Alegeți alt email!')</script>"; 
            }
            else if($_GET["error"] == "Passwordsdontmatch"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Parolele nu se potrivesc!')</script>"; 
            }
            else if($_GET["error"] == "stmtfailed"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Ceva nu a mers bine, încercați din nou!')</script>"; 
            }
            else if($_GET["error"] == "UsernameTaken"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.error('Nume de utilizator existent!')</script>"; 
            }
            else if($_GET["error"] == "none"){
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\",
                    \"positionClass\": \"toast-center\"
                }; toastr.success('Înregistrarea a avut succes!')</script>"; 
                header("refresh: 2; url=logIn.php");
            }
        }
        ?>
        </div>
    </div>

    <script src="JavaScripts/register.js"></script>
</body>
</html>