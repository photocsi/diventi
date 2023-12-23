
<?php
$stringa_valori_passati_ajax=$_POST['bottone'];

$valori=explode(",",$stringa_valori_passati_ajax);

echo $valori[0].'-'.$valori[1].'-'.$valori[2];
include('../config_pdo.php');
if($valori[0]==='a'){
         
        $select_selezione=$conn->prepare("UPDATE 1clienti SET conferma_preferiti=0 , data_conferma_preferiti=NULL WHERE id_cliente= :valori ");
        $select_selezione->bindparam(':valori', $valori[1]);
              if($select_selezione->execute()){
                  echo "Hai annullato la conferma selezione del cliente ";
                 
            
             }else{
                    die  ("Errore di annullamento");
             }

            }else{
        
          $select_selezione=$conn->prepare("UPDATE 1clienti SET conferma_preferiti=0 , numero_preferiti=0  WHERE id_cliente= :valori ");
          $select_selezione->bindparam(':valori', $valori[1]);
          if($select_selezione->execute()){
                  }else{
                   die  ("Errore di reset");
                  }
          $delet_selezione=$conn->prepare("DELETE FROM 1preferiti  WHERE id_cliente=:valori AND id_album= :valori2 ;");
          $delet_selezione->bindparam(':valori', $valori[1]);
          $delet_selezione->bindparam(':valori2', $valori[2]);
          if($delet_selezione->execute()){
            echo "Hai tolto la selezione fatta dal cliente da tutte le foto";
       
            
                  }else{
                   die  ("Errore di reset");
                  }
                }
                $conn= null;
      ?>