<?php
 $stringa_da_dividere = file_get_contents("php://input");
 $array_valori=explode("," , $stringa_da_dividere);
 $id_album=$array_valori[0];
 $path_cartella=$array_valori[1];
 $nome_foto=$array_valori[2];
 if(isset($array_valori[4])){
    $img=$array_valori[4];
    $data = base64_decode($img);
    $path = $path_cartella.$nome_foto;
    
    $success = file_put_contents($path, $data);
    print $success ? 'Immagine Modificata Salvata' : 'salvataggio non riuscito';
 }else{
    echo "Immagine Modificata non è possibile salvare l'immagine";
 }
 

 
   




   /*  $img = file_get_contents("php://input"); 
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/img")) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . "/img", 0777, true);
    }
    
    $file = $_SERVER['DOCUMENT_ROOT'] . "/img/".time().'.jpg';
    
    $success = file_put_contents($file, $data);
    print $success ? $file.' saved.' : 'Unable to save the file.'; */



?>