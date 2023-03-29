
<?php

if (isset($_POST["reset-request-submit"])) {
    // Generate selector and token
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    // Construct URL with selector and  token
    $url = "localhost/Site-licenta//create-new-password.php?selector=" . $selector . "&token=" . bin2hex($token);

    // Set token expiration time
    $expires = date("U") + 3600;
    require_once 'functions-inc.php';
     //CONNECT TO DATABASE
    require_once 'dbh-inc.php';

    // Get user email from form data
    $userEmail = $_POST["emailReset"];
    

    if(checkUserExists($conn, $userEmail)){
    // Delete any existing password reset tokens for the user
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'A aparut o eroare!';
        exit();
    }
    else
    {
        mysqli_stmt_bind_param($stmt,"s",$userEmail);
        mysqli_stmt_execute($stmt);
    }

    // Insert data in database
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)) {
        echo 'A aparut o eroare!';
        exit();
    }
    else
    {
        // Hash the token before storing it in the database
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"sssi",$userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);

    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Construct email message with reset password link
    $to = $userEmail;
    $subject = 'Resetează parola de pe NinoFarm';
    $message  = '<p>Am primit o cerere de resetare a parolei.Link-ul pentru resetare este dedesubt.Dacă nu ați trimis o cerere pentru resetare a parolei,ignorați acest mesaj!</p>';
    $message .= '<p>Aici este link-ul pentru resetare: </br>';
    $message .= '<a href = "' . $url . '">' . $url . '</a></p>';

    // Set email headers
    $headers = "De la: NinoFarm <ninofarmm@gmail.com>\r\n";
    $headers .= "Raspunde lui: <ninofarmm@gmail.com>\r\n";
    $headers .= "Content-type: text/html\r\n";

    // Send email using PHPMailer library
    require_once('../PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tsl1.3';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '587';
    $mail->isHTML();
    $mail->Username = 'ninofarmm@gmail.com'; //my gmail
    $mail->Password = 'tnhptwgiwiihqmzj'; //my password
    $mail->SetFrom('noreply@code.org');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress ($to);

    $mail->Send();

    //php mailer running
    mail($to, $subject, $message, $headers);
   
    header("Location: ../resetPassword.php?reset=success");
    }else{
        header("Location: ../resetPassword.php?reset=invalidEmailForReset");
        
    }

    

} else {
    header("Location: ../index.php");
}