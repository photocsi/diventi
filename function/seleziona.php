<?php

/* funzione per selezionare la foto */
$stringa_valori_passati_ajax=$_POST['foto'];

$valori=explode(",",$stringa_valori_passati_ajax);
$id_cliente=$valori[0]; $id_album=$valori[1]; $id_foto= $valori[2];

include('../config_pdo.php');

$controllo_selezione=$conn->prepare("SELECT  * FROM  1preferiti  WHERE (id_cliente= :id_cliente AND id_album= :id_album AND id_foto= :id_foto)");
$controllo_selezione->bindParam(':id_cliente', $id_cliente);
$controllo_selezione->bindParam(':id_album', $id_album);
$controllo_selezione->bindParam(':id_foto', $id_foto);
$controllo_selezione->execute();
while($row=$controllo_selezione->fetch(PDO::FETCH_ASSOC)){
$preferito=$row['id_preferiti'];
}

if(isset($preferito)){
echo $preferito;
}else{
    $preferito=0;
    echo $preferito;
}

if($preferito==0){

$insert_preferito=$conn->prepare("INSERT INTO `1preferiti` (id_cliente, id_album, id_foto) VALUES (:id_cliente, :id_album, :id_foto); ");
$insert_preferito->bindParam(':id_cliente', $id_cliente);
$insert_preferito->bindParam(':id_album', $id_album);
$insert_preferito->bindParam(':id_foto', $id_foto);
$insert_preferito->execute();
$conn= null;
}else{
    $delete_preferito=$conn->prepare("DELETE FROM `1preferiti` WHERE (id_cliente= :id_cliente AND id_album= :id_album AND id_foto= :id_foto); ");
    $delete_preferito->bindParam(':id_cliente', $id_cliente);
$delete_preferito->bindParam(':id_album', $id_album);
$delete_preferito->bindParam(':id_foto', $id_foto);
$delete_preferito->execute();
$conn= null;
}



?>