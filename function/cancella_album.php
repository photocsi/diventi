
<?php
session_start();
$id_album = $_GET['id'];
$path_cartella = "../album/$id_album";

/* $dir=glob("../album/$id_album/*");
print_r($dir);
foreach( $dir as $glob){
cancella_cartella($glob);
}
rmdir($path_cartella); */


cancella_preferiti($id_album);
cancella_clienti($id_album);
cancella_album($id_album);
cancella_cartella($path_cartella);




/* FUNZIONE PER CANCELLARE TUTTI I DATI DELL ALBUM NEL DB---------------------------------------------------------------------------------------- */
function cancella_album($id_album)
{
    include('../config_pdo.php');

    $cancella_album = $conn->prepare("DROP TABLE $db.$id_album;");

    if ($cancella_album->execute()) {
        echo "Tabella cancellata con successo";
    }

    $select = $conn->prepare("DELETE FROM 1album WHERE id_album= :id_album ;");
    $select->bindParam(':id_album', $id_album);
    $select->execute();
    echo "Riga da 1album cancellata con successo";


    $conn = null;
}


/*       FUNZIONE PER CANCELLARE TUTTI I PREFERITI DELL'ALBUM */

function cancella_preferiti($id_album)
{

    include('../config_pdo.php');
    $cancella_preferiti = $conn->prepare("DELETE FROM `1preferiti` WHERE id_album= :id_album ;");
    $cancella_preferiti->bindParam(':id_album', $id_album);

    $cancella_preferiti->execute();

    $conn = null;
}

function cancella_clienti($id_album)
{
    include('../config_pdo.php');
    $select = $conn->prepare("DELETE FROM 1clienti WHERE id_album= :id_album ");
    $select->bindparam(":id_album", $id_album);
    $select->execute();

    $conn = null;
}

/* FUNZIONE PER CANCELLARE LA CARTELLA FISICA CON TUTTI I SUOI FILE */
function cancella_cartella($path_delete)
{


    foreach (scandir($path_delete) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir($path_delete . '/' . $file)) cancella_cartella($path_delete . '/' . $file);
        else unlink($path_delete . '/' . $file);
    }
    rmdir($path_delete);
}
header('Location: ../live/dashboard.php');

?>

