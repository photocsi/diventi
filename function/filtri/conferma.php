<?php
// Preleva l'immagine dal server remoto
$url = $img;
$image = file_get_contents( $url );
// Scrive l'immagine sul proprio server
$path = $pathModificata;
file_put_contents( $path, $image );