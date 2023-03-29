<?php
    session_start();
?>

<!-- LARAVEL -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta description="NinoFarm" charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="robots" content="index,follow">
    <link rel="icon" href="./Icons/logo-icon.ico">
    <link rel="stylesheet" href="Styles/header-footer.css">

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <title>NinoFarm</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://fontawesome.com/icons"></script>
    <script src="https://kit.fontawesome.com/a4dace6bf3.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">  
        <header>
            <nav>
            <div class="menu-icon"><span class="fas fa-bars"></span></div>
            <div class="logo"><img  width="40rem" src="Images/logo.png">NinoFarm</div>
                <div class="nav-items">
                    <li><a href="index.php">Acasă</a></li>
                    <li><a href="produse.php">Produse</a></li>
                    <li><a href="">Afecțiuni</a></li>
                    <li><a href="">Contact</a></li>
                    <?php
                    if(isset($_SESSION["useruid"])){
                        echo "<li><a href='profile.php' >Contul meu</a></li>";
                        echo "<li><a href='includes/logOut-inc.php' >Deconectare</a></li>";
                        echo "<li><a href='logIn.php'>Coșul meu</a></li>";

                    }else{
                        echo "<li><a href='signUp.php' >Înregistrare</a></li>";
                        echo "<li><a href='logIn.php'>Conectare</a></li>";
                    }
                    ?> 
                </div>
                <div class="search-icon"><span class="fas fa-search"></span></div>
                <div class="cancel-icon"><span class="fas fa-times"></span></div>

                <form action="#">
                    <input type="search" class= "search-data" placeholder= "Cauta medicamente" required>
                    <button type= "submit" class="fas fa-search"></button>
                </form>
            </nav>
        </header>