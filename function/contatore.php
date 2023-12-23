<?php
$stringa=$_POST['bottone'];
$array_dati=explode(",", $stringa);
$id_album=$array_dati[0];
$id_foto=$array_dati[1];
$colonna=$array_dati[2];

include('../config_pdo.php');
$select=$conn->prepare("SELECT $colonna FROM $db.$id_album WHERE id_foto = :id_foto");
$select->bindparam(":id_foto" , $id_foto);
$select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);
$numero=$row[$colonna];
$numero++;

$update_download=$conn->prepare("UPDATE $db.$id_album SET $colonna= :numero WHERE id_foto= :id_foto ");
$update_download->bindparam(":numero", $numero);
$update_download->bindparam(":id_foto" , $id_foto);
$update_download->execute();
