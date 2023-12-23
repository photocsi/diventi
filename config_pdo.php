<?php 
#qua vado ad inserire se sta lavorando in "locale" o su "web"
 
$db='diventi';


   try{
      $conn = new PDO("mysql:host=localhost;dbname=$db", "root", "");
      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /* ECHO "CONNESSIONE RIUSCITA"; */
  } catch(PDOException $e){
      die("ERRORE: Impossibile stabilire una connessione al database");
  }  






 /*   try{
      $conn = new PDO('sqlite:db\diventi.sqlite');  
      // Set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e){
      die("ERRORE: Impossibile stabilire una connessione al database");
  }
 */

?>