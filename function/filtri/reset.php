<?php
/* prendo i valori li separo in array e faccio tutti i path immagine che mi servono */
$array=explode(",",$_GET['reset']);
$nome_foto=$array[0];
$sotto_cartella=$array[1];
$id_album=$array[2];
$path_immagine_originale="../../album/$id_album/sottocartelle/$sotto_cartella/large/$nome_foto";
$path_immagine_modificata="../../album/$id_album/sottocartelle/$sotto_cartella/large/modificate/$nome_foto";

if (false === copy($path_immagine_originale, $path_immagine_modificata)) {
    printf("Impossibile copiare il file %s",$path_immagine_originale);
}



?>