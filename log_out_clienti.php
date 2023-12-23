<?php
session_start();
include('function/funzioni_album.php');
resetta_sessioni();
unset($_SESSION['id_fotografo']);
unset($_SESSION['user_fotografo']);
unset($_SESSION['password_fotografo']);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Scansona nuovamente i QRCODE oppure utilizza il link della galleria per effetuare il login
</body>
</html>