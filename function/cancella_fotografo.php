

    
<?php
 session_start();
echo $_SESSION['fotografo_delete'];
$id_fotografo=$_SESSION['fotografo_delete'];
echo $id_fotografo;
?>
    <!-- SEZIONE DI CONTROLLO -->
<div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">SPAZIO DI CONTROLLO</h5>
                    <h3>Variabili di sessione memorizzate</h3>
                    <?php  print_r($_SESSION); print_r($_GET);print_r($_POST)?>

                    <a href="gestione_galleria.php">gestione galleria</a>";


                </div>
            </div>

        </div>
    </div> <!-- END SESIONE DI CONTROLLO -->


<?php

include('../config_pdo.php');

$select=$conn->prepare("SELECT id_album , path_cartella FROM 1album WHERE id_fotografo= :id_fotografo ");
$select->bindparam(":id_fotografo",$id_fotografo);
$select->execute();

    while ($row=$select->fetch(PDO::FETCH_ASSOC)){
         cancella_preferiti($row['id_album']);
         cancella_clienti($row['id_album']);
         cancella_album($row['id_album']);
         cancella_cartella($row['path_cartella']);
         echo "{$row['id_album']} , {$row['path_cartella']} </br>";
      }
        $conn= null;
        cancella_fotografo($id_fotografo);
        header('Location: ../amministrazione/index_amministrazione.php');


/* FUNZIONE PER CANCELLARE TUTTI I DATI DELL ALBUM NEL DB---------------------------------------------------------------------------------------- */
function cancella_album($id_album){
    include('../config_pdo.php');

    $cancella_album=$conn->prepare("DROP TABLE $db.$id_album;");
    $cancella_album->execute();

$select=$conn->prepare("DELETE FROM 1album WHERE id_album= :id_album ;");
$select->bindParam(':id_album', $id_album);
$select->execute();

$conn= null;
}

/* FUNZIONE PER CANCELLARE LA CARTELLA FISICA CON TUTTI I SUOI FILE */
function cancella_cartella($path_delete){
   
        foreach(scandir($path_delete) as $file) {
          if ('.' === $file || '..' === $file) continue;
          if (is_dir($path_delete.'/'.$file)) cancella_cartella($path_delete.'/'.$file);
          else unlink($path_delete.'/'.$file);
        }
        rmdir($path_delete);
      }

/*       FUNZIONE PER CANCELLARE TUTTI I PREFERITI DELL'ALBUM */

function cancella_preferiti($id_album){

    include('../config_pdo.php');
    $cancella_preferiti=$conn->prepare("DELETE FROM `1preferiti` WHERE id_album= :id_album ;");
    $cancella_preferiti->bindParam(':id_album', $id_album);

    $cancella_preferiti->execute();

     $conn=null;
}

function cancella_clienti($id_album){
    include('../config_pdo.php');
  /*  prendo la cella con la lista dei clienti di quell'album */
             $select_clienti=$conn->prepare("SELECT clienti_registrati FROM 1album WHERE id_album= :id_album ;");
             $select_clienti->bindParam(':id_album' , $id_album);
             $select_clienti->execute();
             $row=$select_clienti->fetch(PDO::FETCH_ASSOC);
       /*  prendo la stringa con tutti gli id e la trasformo in array */
             $array=explode(",",$row['clienti_registrati']);

             /* con un cliclo foreach prendo cliente per cliente e lo cancello */
             foreach ($array as  $valore) {
                $delete=$conn->prepare("DELETE FROM `1clienti` WHERE id_cliente=:valore ;");
                $delete->bindParam(':valore' , $valore);
                if($delete->execute()){
                    echo"Cliente $valore cancellato";
                }else{
                    die ("Errore nella cancellazione della tabella"); 
                }
            
                
             }
             $conn= null;
}

function cancella_fotografo($id_fotografo){
    include('../config_pdo.php');
    $delete=$conn->prepare("DELETE FROM fotografi WHERE id_fotografo= :id_fotografo");
    $delete->bindparam(':id_fotografo',$id_fotografo);
    $delete->execute();
    
    $conn= null;
}

?>

