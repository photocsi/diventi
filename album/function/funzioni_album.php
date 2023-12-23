<?php


/* prendo il numero totale dei preferiti e lo aggiorno nella casella del cliente */
function numero_preferiti($id_album,$id_cliente){
  include('../../config_pdo.php');
  $preferiti=$conn->prepare(" SELECT COUNT(*) FROM $db.$id_album  INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto 
   WHERE id_cliente=:id_cliente;");
   $preferiti->bindParam(':id_cliente' , $id_cliente);
  $preferiti->execute();
                $row=$preferiti->fetch(PDO::FETCH_COLUMN);
                $totale_preferiti=$row;

  $up=$conn->prepare("UPDATE `1clienti` SET `numero_preferiti`=:totale_preferiti WHERE id_cliente=:id_cliente;");
  $up->bindParam(':totale_preferiti', $totale_preferiti);
  $up->bindParam(':id_cliente', $id_cliente);
  $up->execute();
  
$conn= null;
return $totale_preferiti;
}

/* prendo tutti i preferiti e li metto in result, dopo aver richiamato la funzione si puo fare un while */
function prendi_preferiti($id_album,$id_cliente){
  include('../../config_pdo.php');
    
  $select=$conn->prepare("SELECT * FROM $db.$id_album
  INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente;");
  $select->bindParam(':id_cliente', $id_cliente);

  $select->execute();

  return $select;
}

/* controllo le impostazioni inserite nel db 1album */
function controlla_opzioni($id_album,$codice){
  include('../../config_pdo.php');
  $select=$conn->prepare("SELECT opzioni FROM 1album WHERE id_album=:id_album ;");
  $select->bindParam(':id_album', $id_album);
  $select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);
$array_codice=explode(" ",$row['opzioni']);//trasformo la stringa in array
if(in_array("$codice",$array_codice)){
  return TRUE;
}else{
  return FALSE;
}
}



?>