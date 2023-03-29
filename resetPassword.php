<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NinoFarm</title>
    <link rel="stylesheet" href="Styles/logIn.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<body>
    
    <div class="container">
        <div class="form-boxReset">
            <h1>Resetează parola</h1>
            <h2 id="reset-message">Un e-mail va fi trimis către dumneavoastră cu toți pașii pentru resetarea parolei.</h2>
            <form action="Includes/resetRequest-inc.php" method= "post">
                <input class = "emailResetInput" type="text" name="emailReset" placeholder="Introduceți email ul dvs!.">
                <button class= "buttonSubmitEmailReset" type="submit" name="reset-request-submit">Continuă</button>
            </form>
        <?php
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo "<script>toastr.options = {\"toastClass\": \"toast-style\"}; toastr.success('Verificați-vă contul de gmail!')</script>";            }
            if ($_GET["reset"] == "invalidEmailForReset") {
                echo "<script>toastr.success('Acest email nu exista')</script>";
            }
        }
        ?>  
        </div>

    </div>

</body>
</html>
