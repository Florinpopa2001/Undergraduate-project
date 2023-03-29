<?php

$serverName="localhost";
$dBUsername="root";
$dBPassword="";
$dBName="register";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName );

if(!$conn){
    die("Eroare de conexiune!:"  . mysqli_connect_error());
}


