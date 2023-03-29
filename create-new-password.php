<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NinoFarm</title>
    <link rel="icon" href="./Icons/logo-icon.ico">
    <link rel="stylesheet" href="Styles/logIn.css">
    <script src="https://fontawesome.com/icons"></script>
    <script src="https://kit.fontawesome.com/a4dace6bf3.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container">
        <div class="form-boxCreatePwd">
            <?php
                $selector = $_GET["selector"];
                $token = $_GET["token"];

                if (empty($selector) || empty($token)) {
                    echo 'Cererea dumneavoastră  nu poate fi validată!';
                } else {
                    if (ctype_xdigit($selector) !== false && ctype_xdigit($token) !== false) {
                    ?>

                    <form action="Includes/reset-password-inc.php" method="post">
                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                        <input type="hidden" name="token" value="<?php echo $token; ?>">
                        <input class = "pwdInputs" type="password" name="pwd" placeholder="Parolă nouă..">
                        <input class = "pwdInputs" type="password" name="pwd-repeat" placeholder="Repeta parola noua..">
                        <button class = "buttonSubmitPasswords" type="submit" name="reset-password-submit">Resetează parola</button>
                    </form>
                    


                    <?php

                    }
                }
            ?>
        </div>
    </div>

</body>
</html>
