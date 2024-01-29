<?php 
#qua vado ad inserire se sta lavorando in "locale" o su "web"
 
 $db='diventi';


   try{
      $conn = new PDO("mysql:host=localhost;dbname=$db", "root", "");
     
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e){
      die("ERRORE: Impossibile stabilire una connessione al database");
  }   






/* SITO PUNKODE.IT/DIVENTI */

/* $db='owsdpvnf_diventi';


   try{
      $conn = new PDO("mysql:host=localhost;dbname=$db", "owsdpvnf_csi", "Shubniggurat1!");
   
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e){
      die("ERRORE: Impossibile stabilire una connessione al database");
  }   */






?>