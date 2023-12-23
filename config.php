<?php



 $host="localhost";
$user="root";
$pass="";
$db="diventi"; 
 
 
/* <!-- aruba --> */

/* $host="89.46.111.56";
$user="Sql1164129";
$pass="Fotobelli52%";
$db="Sql1164129_4";
 */

 /* <!-- siteground --> */


/*  $host="es56.siteground.eu";
$user="uvojpeazzjebw";
$pass="Shubniggurat1!";
$db="dbx90gk8c9ve8v";  */

$connessione= new mysqli($host,$user,$pass,$db);

  /*  class MyDB extends SQLite3 {
        function __construct() {
           $this->open('./dbsqlite/modul.db');
        }
     }
     $db = new MyDB();
     if(!$db) {
        echo $db->lastErrorMsg();
     } else {
        echo "Opened database successfully\n";
     } 
 */
   
?>