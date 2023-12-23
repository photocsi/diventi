<?php

/* FUNZIONE PER CONTARE IL NUMERO DI ALBUM */
/* parametro id del fotografo, restituisce la variabile con il numero */

function numero_album($id_fotografo){

include('../config_pdo.php');

/* estrapolo il numero di album del fotografo */

$count=$conn->prepare("SELECT COUNT(*) FROM 1album WHERE id_fotografo= :id_fotografo; ");
$count->bindParam(':id_fotografo' , $id_fotografo);
 $count->execute();
 $row=$count->fetch(PDO::FETCH_COLUMN); 
 $number_album=$row;
 
/*  il risultato del fetch_arrai mi da un array con all'interno il numero estrapolato */

 $conn= null;

 return $number_album;
}


function numero_clienti($id_fotografo){

  include('../config_pdo.php');
  
  /* estrapolo il numero di album del fotografo */
  
  $count=$conn->prepare("SELECT COUNT(*) FROM 1clienti WHERE id_fotografo= :id_fotografo; ");
  $count->bindParam(':id_fotografo' , $id_fotografo);
  $count->execute(); 
  $row=$count->fetch(PDO::FETCH_COLUMN);
   $number_clienti=$row;
   
  /*  il risultato del fetch_arrai mi da un array con all'interno il numero estrapolato */
  
   $conn= null;
  
   return $number_clienti;
  }

  
/* conto il numero di foto caricate */
function numero_foto($id_fotografo){
    include('../config_pdo.php');

    $select=$conn->prepare("SELECT id_album FROM 1album WHERE id_fotografo=:id_fotografo ;");
    $select->bindParam(':id_fotografo' , $id_fotografo);
    $select->execute(); 
    
       while($row=$select->fetch(PDO::FETCH_ASSOC)){
             $array_album[]+=$row['id_album'];
           }
            $quantita_foto=0;
             if(isset($array_album) AND $array_album!=null){
             foreach ($array_album as  $value) {
             $select_album=$conn->prepare("SELECT COUNT(id_foto) FROM $db.$value ;");
             $select_album->execute();
             $row=$select_album->fetch(PDO::FETCH_COLUMN);
             if($row!=null){
              $quantita_foto=$row;
              }
                     
                      
        } 
      }
    
    $conn= null;
return $quantita_foto;
}
?>