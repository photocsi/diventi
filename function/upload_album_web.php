<?php

include_once('../config_pdo.php');

$id_album = 41;
echo $id_album;

/*Seleziono tutti i dati dell'album in locale*/

$stmt= $db->prepare("SELECT * FROM 1album WHERE id_album='$id_album' ");
$stmt->execute();

while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $id_fotografo=$row['id_fotografo'];
    $nome_album=$row['nome'];
    $sottotitolo_album=$row['sottotitolo'];
    $categoria_album=$row['categoria'];
    $data_album=$row['data_album'];
    $path_copertina=$row['path_copertina'];
    $cloneweb=$row['cloneweb'];
}

/* chiudo la connessione locale ,

prima di procedere controllo se l'album in remoto è gia stato creato*/
if($cloneweb===Null){

/*includo il file config di quella remota e aggiungo i dati dell'album da clonare */

/* Creo un nuovo album sul DB sul web remoto */
$stmt= $db->prepare("INSERT INTO 1album (id_fotografo, nome, sottotitolo, categoria, data_album , path_copertina) VALUES ( ?, ? ,?,?,?,?)  ");

$stmt->execute([$id_fotografo, $nome_album, $sottotitolo_album, $categoria_album,$data_album,$path_copertina]);

$stmt= $db->prepare("SELECT * FROM 1album WHERE id_fotografo= '$id_fotografo' AND nome = '$nome_album' AND sottotitolo='$sottotitolo_album' ");
$stmt->execute();
While($row=$stmt->fetch(PDO::FETCH_ASSOC)){
$id_album_clonato=$row['id_album'];}


/* Ora che ho il nuovo id album clonato lo vado ad aggiungere nella colonna album del database locale (cloe web) */
/* Quindi chiudo la connessione rwmota e riapro quella locale includendo il file config locale */

$stmt= $db->prepare("UPDATE 1album SET cloneweb='$id_album_clonato' WHERE id_album='$id_album' ");

$stmt->execute();



/* Ora rociudo la connessione locale per l'ultima volta e riapro quella remota includendo il file config di quella remota */
$stmt= $db->prepare("UPDATE 1album SET path_cartella='../album/$id_album_clonato' WHERE id_album='$id_album_clonato' ");

$stmt->execute();

/* CREO LA TABELLA DELLA CARTELLA ALBUM */

$stmt= $db->prepare("CREATE TABLE modul.$id_album_clonato (`id_foto` INT UNSIGNED NOT NULL AUTO_INCREMENT , `id_album` INT UNSIGNED NOT NULL ,`id_fotografo` INT UNSIGNED NOT NULL,`sotto_cartella` VARCHAR(50) NOT NULL ,
   `path` VARCHAR(150) NOT NULL , `path_medium` VARCHAR(150) NOT NULL , `path_small` VARCHAR(150) NOT NULL  , `path_watermark` VARCHAR(150) NOT NULL, `nome_foto` VARCHAR(50) NOT NULL ,
   `tag` VARCHAR(50)  , `messaggio` VARCHAR(200)  ,`data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id_foto`), 
   CONSTRAINT `$id_album_clonato` FOREIGN KEY (`id_album`) REFERENCES `1album`(`id_album`) ON DELETE RESTRICT ON UPDATE RESTRICT) ENGINE = InnoDB;");

$stmt->execute();

/* _______________________________________________________________________ */

/*    CREO TUTTE LE PAGINE PER L'ALBUM */
  /*   CREO LE PAGINE PGFOTOGRAFO */

/*   creo la pagina impostazioni */
$id_album=$id_album_clonato;

/* creo tutte le cartelle che servono nella cartella dell'album */
mkdir("../album/$id_album/pgcliente/",0777, TRUE);
mkdir("../album/$id_album/pgcliente/selezioni/",0777, TRUE);
mkdir("../album/$id_album/pgfotografo/",0777, TRUE);
mkdir("../album/$id_album/sottocartelle/",0777, TRUE);



$origin="../master/pgfotografo/impostazioni.php";
$destination="../album/$id_album/pgfotografo/impostazioni.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album   ;
\$nome_album='$nome_album' ;  ";

fwrite($nuovo_file, $testo);
fclose($nuovo_file);

  /*   CREO LA PAGINA HEADER */
$origin="../master/pgfotografo/header_side.php";
$destination="../album/$id_album/pgfotografo/header_side.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$nomeutente=$id_fotografo;
\$operatore='$nome_cliente'; ";

fwrite($nuovo_file, $testo);
fclose($nuovo_file);

/*  creo la pagina anteprima album */
$origin="../master/pgfotografo/anteprima_album.php";
$destination="../album/$id_album/pgfotografo/anteprima_album.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album;
\$nome_album='$nome_album';
\$sottotitolo='$sottotitolo';
\$data_album='$data_album';
\$path_copertina='$path_copertina ' ;";

fwrite($nuovo_file, $testo);
fclose($nuovo_file);


/* creo la pagina gestione clienti */
$origin="../master/pgfotografo/gestione_clienti.php";
$destination="../album/$id_album/pgfotografo/gestione_clienti.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album                     ;";

fwrite($nuovo_file, $testo);
fclose($nuovo_file);


$origin="../master/pgfotografo/work.php";
$destination="../album/$id_album/pgfotografo/work.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album ;
\$id_operatore=$id_operatore   ;";

fwrite($nuovo_file, $testo);
fclose($nuovo_file);

/* creo la pagina upload */
$origin="../master/pgfotografo/upload.php";
$destination="../album/$id_album/pgfotografo/upload.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album;
\$id_fotografo=$id_fotografo; ";
                       

fwrite($nuovo_file, $testo);
fclose($nuovo_file);

/* creo la pagina immagine */
$origin="../master/pgfotografo/immagine.php";
$destination="../album/$id_album/pgfotografo/immagine.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album; ";
                       

fwrite($nuovo_file, $testo);
fclose($nuovo_file);


/* creo la pagina slide */
$origin="../master/pgfotografo/slide.php";
$destination="../album/$id_album/pgfotografo/slide.php";
copy($origin,$destination);

$nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
$testo="<?php
\$id_album=$id_album;
\$nome_album='$nome_album'     ";
                       

fwrite($nuovo_file, $testo);
fclose($nuovo_file);

  /* creo la pagina slide 1 */
  $origin="../master/pgfotografo/slide1.php";
  $destination="../album/$id_album/pgfotografo/slide1.php";
  copy($origin,$destination);

  $nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
  $testo="<?php
  \$id_album=$id_album;  ";
                         

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

    /* creo la pagina slide 2 */
    $origin="../master/pgfotografo/slide1.php";
    $destination="../album/$id_album/pgfotografo/slide2.php";
    copy($origin,$destination);

    $nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
    $testo="<?php
    \$id_album=$id_album;  ";
                           

    fwrite($nuovo_file, $testo);
    fclose($nuovo_file);

 /*    CREO LE PAGINE PER I CLIENTI */
/*   creo la pagina iniziale pgcliente */
$origin="../master/pgcliente/index.php";
    $destination="../album/$id_album/pgcliente/index.php";
    copy($origin,$destination);

    $nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
    $testo="<?php
    \$path_galleria_register='album/$id_album/pgcliente/index.php';
    \$id_album=$id_album;
    \$id_fotografo=$id_fotografo   ";
                           

    fwrite($nuovo_file, $testo);
    fclose($nuovo_file);

    /* creo la pagina cliente preferiti.php */
    $origin="../master/pgcliente/preferiti.php";
    $destination="../album/$id_album/pgcliente/preferiti.php";
    copy($origin,$destination);

    $nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
    $testo="<?php
    \$id_album=$id_album;
    \$nome_album='$nome_album';
    \$sottotitolo='$sottotitolo';
    \$id_fotografo=$id_fotografo;
    \$path_copertina='$path_copertina';     ";
                           

    fwrite($nuovo_file, $testo);
    fclose($nuovo_file);

    /* creo la pagina cliente preferiti confermati.php */
    $origin="../master/pgcliente/preferiti_confermati.php";
    $destination="../album/$id_album/pgcliente/preferiti_confermati.php";
    copy($origin,$destination);

    $nuovo_file=fopen("$destination", "r+") or die ("unable to open file!");
    $testo="<?php
    \$id_album=$id_album;
   \$nome_album='$nome_album';
   \$sottotitolo='$sottotitolo';
   \$id_fotografo=$id_fotografo;
   \$path_copertina='$path_copertina'  ";
                           

    fwrite($nuovo_file, $testo);
    fclose($nuovo_file);





}else{
$id_album_clonato=$cloneweb;


}

