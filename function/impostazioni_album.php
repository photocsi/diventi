<?php

$dati=$_POST['valore'];//prendo il valore mandato in ajax


include('../config_pdo.php');
$dati_array=explode("-",$dati); //trasormo in array il valore
$valore=$dati_array[0]; //divido il valore il primo e il codice da inserire che mi fa capire cosa è stato scelto
$id_album=$dati_array[1]; //il secondo e l'id dell'album

//prendo la stringa di opzioni nell'album
$select=$conn->prepare("SELECT opzioni FROM 1album WHERE id_album= :id_album ;");
$select->bindParam(':id_album', $id_album);
$select->execute();
$row=$select->fetch(PDO::FETCH_NUM);
print_r($row);
$array_codice=explode(" ",$row[0]);//trasformo la stringa in array

/* se il codice da inserire è gia nella stringa allora lo vado a togliere */
if(in_array("$valore",$array_codice)){
    $key = array_search($valore, $array_codice);
        unset($array_codice[$key]); //in questo modo tolgo il codice che era già presente nella stringa ora un array
        $codice=implode(" ",$array_codice); //ritrasformo l'array in stringa
        print_r($codice);

        //e vado ad inserire la nuova stringa aggiornata nel db 
$update=$conn->prepare("UPDATE `1album` SET `opzioni`= :codice WHERE id_album= :id_album ;");
$update->bindParam(':codice', $codice);
$update->bindParam(':id_album', $id_album);
$update->execute();
}else{ //se il codice non è presente nella stringa - ora array
    array_push($array_codice,$valore); //aggiungo il codice all'interno dell'array
    $codice=implode(" ",$array_codice); //trasformo l'array in stringa
    //e la inserisco nel db album dentro opzioni aggiornata
    $update=$conn->prepare("UPDATE `1album` SET `opzioni`= :codice WHERE `id_album`= :id_album ;");
    $update->bindParam(':codice', $codice);
    $update->bindParam(':id_album', $id_album);
    $update->execute();
}

$conn= null;





?>