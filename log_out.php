<?php
setcookie ("user_fotografo", $username, time()-1);
setcookie ("password_fotografo", $password, time()-1);
setcookie ("id_fotografo", $id_fotografo, time()-1);
session_start();
include('function/funzioni_album.php');
resetta_sessioni();
unset($_SESSION['id_fotografo']);
unset($_SESSION['user_fotografo']);
unset($_SESSION['password_fotografo']);

header('Location: index.php');

?>