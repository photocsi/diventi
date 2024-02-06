<?php

/* -----FUNZIONE PER CREARE UN NUOVO ALBUM-------------------
creo una nuova riga sul db in album, memorizzo le variabili creo una nuova cartella e salvo la copertina */


function crea_album()
{

  /* Esternalizzo le viaribili post del form */
  $nome = htmlEntities(str_replace(" ", "_", trim($_POST['nome'])));
  $sottotitolo = htmlEntities(str_replace(" ", "_", trim($_POST['sottotitolo'])));
  $categoria = htmlEntities(str_replace(" ", "_", trim($_POST['categoria'])));
  $data_album = $_POST['data_album'];
  $note = htmlEntities(str_replace(" ", "_", trim($_POST['note'])));
  $operatori = $_POST['operatore'];

  $id_fotografo = $_SESSION['id_fotografo'];
  $nome_file_copertina = $_FILES['file']['name'];
  $password_fotografo = $_SESSION['password_fotografo'];
  $password_fotografo_hash = password_hash($password_fotografo, PASSWORD_ARGON2I);
  if (empty($_POST['path_hd'])) {
    $path_hd = 1;
  } else {
    $ltrim = ltrim($_POST['path_hd'], "\"");
    $rtrim = rtrim($ltrim, "\"");
    $path_hd = $rtrim;
  }

  include('../config_pdo.php');

  /*   aggiungo una nuova riga alla tabella album */
  $sql = "INSERT INTO `1album`(id_fotografo, nome, sottotitolo , categoria , data_album , note,path_pc)
      VALUES (:id_fotografo , :nome,:sottotitolo , :categoria , :data_album , :note,:path_pc);";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id_fotografo', $id_fotografo, PDO::PARAM_INT);
  $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
  $stmt->bindParam(':sottotitolo', $sottotitolo, PDO::PARAM_STR);
  $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
  $stmt->bindParam(':data_album', $data_album, PDO::PARAM_STR);
  $stmt->bindParam(':note', $note, PDO::PARAM_STR);
  $stmt->bindParam(':path_pc', $path_hd, PDO::PARAM_STR);
  $stmt->execute();




  /* seleziono i dati dell'album appena creato,
    prendendo l'album con lo stesso nome e l'id più alto */
  $select = $conn->prepare("SELECT * FROM 1album WHERE nome= :nome ORDER BY  id_album DESC LIMIT 1; ");
  $select->bindParam(':nome', $nome);
  $select->execute();
  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $nome_album = $row['nome'];
    $sottotitolo = $row['sottotitolo'];
    $categoria = $row['categoria'];
    $id_album = $row['id_album'];
    $data_album = $row['data_album'];
    $id_fotografo = $row['id_fotografo'];
    $path_copertina = "../copertina/$nome_file_copertina";
    $path_cartella_album = "../album/$id_album/";
  }

  /* inserisco i dati dell'operatore */
  for ($i = 0; $i < count($operatori); $i++) {
    if ($operatori[$i] != "") {
      $nome_cliente = $operatori[$i];
      $ruolo = "operatore";
      $aggiungi_operatore = $conn->prepare("INSERT INTO 1clienti (id_album, id_fotografo, nome_cliente, password_cliente , ruolo) 
  VALUES (:id_album ,:id_fotografo , :nome_cliente , :password_cliente , :ruolo );");
      $aggiungi_operatore->bindParam(':id_album', $id_album);
      $aggiungi_operatore->bindParam(':id_fotografo', $id_fotografo);
      $aggiungi_operatore->bindParam(':nome_cliente', $nome_cliente);
      $aggiungi_operatore->bindParam(':password_cliente', $password_fotografo_hash);
      $aggiungi_operatore->bindParam(':ruolo', $ruolo);
      if ($aggiungi_operatore->execute()) {
        echo "operatore aggiunto con successo";
      };
    }
  }
  require_once '../includes/db_pdo-class.php';
  $db_class = new DB_CSI;
  $db_class->insert('1report', array('id_album'), array($id_album));
  $lista_op = $db_class->select(array('id_cliente', 'id_album'), '1clienti', 'id_album', $id_album);
  if (isset($lista_op[0]['id_cliente'])) {
    $db_class->update('1report', 'id_op1', $lista_op[0]['id_cliente'], 'id_album', $id_album);
  }
  if (isset($lista_op[1]['id_cliente'])) {
    $db_class->update('1report', 'id_op2', $lista_op[1]['id_cliente'], 'id_album', $id_album);
  }
  if (isset($lista_op[2]['id_cliente'])) {
    $db_class->update('1report', 'id_op3', $lista_op[2]['id_cliente'], 'id_album', $id_album);
  }
  if (isset($lista_op[3]['id_cliente'])) {
    $db_class->update('1report', 'id_op4', $lista_op[3]['id_cliente'], 'id_album', $id_album);
  }
  if (isset($lista_op[4]['id_cliente'])) {
    $db_class->update('1report', 'id_op5', $lista_op[4]['id_cliente'], 'id_album', $id_album);
  }
  if (isset($lista_op[5]['id_cliente'])) {
    $db_class->update('1report', 'id_op6', $lista_op[5]['id_cliente'], 'id_album', $id_album);
  }



  /* estrapolo e poi aggiungo l'id operatore all'interno della lista operatori_registrati nella tabella 1album */
  $select = $conn->prepare("SELECT id_cliente FROM 1clienti WHERE id_album= :id_album AND nome_cliente= :nome_cliente AND ruolo= :ruolo ;");
  $select->bindParam(':id_album', $id_album);
  $select->bindParam(':nome_cliente', $nome_cliente);
  $select->bindParam(':ruolo', $ruolo);
  $select->execute();

  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $id_operatore = $row['id_cliente'];
  }

  $insert = $conn->prepare("UPDATE 1album SET operatori_registrati= :id_operatore WHERE id_album = :id_album ");
  $insert->bindParam(':id_operatore', $id_operatore);
  $insert->bindParam(':id_album', $id_album);
  if ($insert->execute()) {
    echo 'id operatore inserito nella tabella album';
  };


  /* inserisco in tabella il path della copertina */

  $insert_path = $conn->prepare("UPDATE 1album SET path_copertina= :path_copertina , path_cartella= :path_cartella_album WHERE id_album= :id_album ;");

  $insert_path->bindParam(':path_copertina', $path_copertina);
  $insert_path->bindParam(':path_cartella_album', $path_cartella_album);
  $insert_path->bindParam(':id_album', $id_album);
  if ($insert_path->execute()) {
    echo 'dati path copertina inseriti correttamente';
  }




  /* VADO A FARE TUTTA LA PROCEDURA PER DIMENSIONARE E SALVARE L'IMMAGINE IN CARTELLA */

  /* creo la cartella che ospiterà il file di copertina */

  mkdir("../album/$id_album/copertina/", 0777, TRUE);

  // Ottengo le informazioni sull'immagine originale
  list($width, $height, $type, $attr) = getimagesize($_FILES['file']['tmp_name']);

  // Creo la versione 400*400 dell'immagine (thumbnail)
  $thumb = imagecreatetruecolor(400, 400);
  $source = imagecreatefromjpeg($_FILES['file']['tmp_name']);
  $img = imagescale($source, 400);
  $path_copertina_creazione = "../album/$id_album/copertina/$nome_file_copertina";
  // Salvo l'immagine ridimensionata
  imagejpeg($img, $path_copertina_creazione, 75);

  /* creo tutte le cartelle che servono nella cartella dell'album */
  mkdir("../album/$id_album/pgcliente/", 0777, TRUE);
  mkdir("../album/$id_album/pgcliente/selezioni/", 0777, TRUE);
  mkdir("../album/$id_album/pgfotografo/", 0777, TRUE);
  mkdir("../album/$id_album/sottocartelle/CESTINO/large/", 0777, TRUE);
  mkdir("../album/$id_album/sottocartelle/CESTINO/medium/", 0777, TRUE);
  mkdir("../album/$id_album/sottocartelle/CESTINO/small/", 0777, TRUE);
  mkdir("../album/$id_album/sottocartelle/CESTINO/watermark/", 0777, TRUE);


  /* creo una nuova tabella nominata con l'id dell'album */


  $create = $conn->prepare("CREATE TABLE $db.$id_album (`id_foto` INT UNSIGNED NOT NULL AUTO_INCREMENT , `id_album` INT UNSIGNED NOT NULL ,`id_fotografo` INT UNSIGNED NOT NULL,`sotto_cartella` VARCHAR(80) NOT NULL ,
   `path` VARCHAR(250) NOT NULL , `path_medium` VARCHAR(250) NOT NULL  , `path_watermark` VARCHAR(250) NOT NULL, `nome_foto` VARCHAR(50) NOT NULL ,
   `tag` VARCHAR(50)  , `download` INT UNSIGNED , `stampe` INT UNSIGNED , `messaggio` VARCHAR(200)  ,`data`VARCHAR(20), PRIMARY KEY (`id_foto`), 
   CONSTRAINT `$id_album` FOREIGN KEY (`id_album`) REFERENCES `1album`(`id_album`) ON DELETE RESTRICT ON UPDATE RESTRICT) ENGINE = InnoDB;");

  if ($create->execute()) {
    echo "Tabella album creata con successo";
  } else {
    die("Errore di creazione" . $connessione->connect_error);
  }




  /*  elimino le variabili di sessione delle cartelle se memorizzate in precedenza */
  unset($_SESSION['sotto_cartella']);
  unset($_SESSION['path_sotto_cartella']);
  /*      porto l'utente alla pagina della modifica dell'album */
  header("Location: dashboard.php ");
  $conn = null;

  /*    CREO TUTTE LE PAGINE PER L'ALBUM */
  /*   CREO LE PAGINE PGFOTOGRAFO */

  /*   creo la pagina impostazioni */
  $origin = "../master/pgfotografo/impostazioni.php";
  $destination = "../album/$id_album/pgfotografo/impostazioni.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album   ;
    \$nome_album='$nome_album' ;  ";

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /*   creo la pagina REPORT */
  $origin = "../master/pgfotografo/report.php";
  $destination = "../album/$id_album/pgfotografo/report.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
     \$id_album=$id_album   ;  ";

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /*   CREO LA PAGINA HEADER */
  $origin = "../master/pgfotografo/header_side.php";
  $destination = "../album/$id_album/pgfotografo/header_side.php";
  copy($origin, $destination);


  /*   CREO LA PAGINA HEADER PER LA SEZIONE WORK */
  $origin = "../master/pgfotografo/header_side_light.php";
  $destination = "../album/$id_album/pgfotografo/header_side_light.php";
  copy($origin, $destination);

  /*  creo la pagina anteprima album */
  $origin = "../master/pgfotografo/anteprima_album.php";
  $destination = "../album/$id_album/pgfotografo/anteprima_album.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album;
    \$nome_album='$nome_album';
    \$sottotitolo='$sottotitolo';
    \$data_album='$data_album';
    \$path_copertina='$path_copertina ' ;
    \$vuota=' ' ;
    ";

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);


  /* creo la pagina gestione clienti */
  $origin = "../master/pgfotografo/gestione_clienti.php";
  $destination = "../album/$id_album/pgfotografo/gestione_clienti.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album                     ;";

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);


  $origin = "../master/pgfotografo/work.php";
  $destination = "../album/$id_album/pgfotografo/work.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album ;";

  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina upload */
  $origin = "../master/pgfotografo/upload.php";
  $destination = "../album/$id_album/pgfotografo/upload.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album;
    \$id_fotografo=$id_fotografo; ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina immagine */
  $origin = "../master/pgfotografo/immagine.php";
  $destination = "../album/$id_album/pgfotografo/immagine.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album; ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);


  /* creo la pagina slide */
  $origin = "../master/pgfotografo/slide.php";
  $destination = "../album/$id_album/pgfotografo/slide.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
    \$id_album=$id_album;
    \$nome_album='$nome_album'     ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 1 */
  $origin = "../master/pgfotografo/slide1.php";
  $destination = "../album/$id_album/pgfotografo/slide1.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
      \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 2 */
  $origin = "../master/pgfotografo/slide2.php";
  $destination = "../album/$id_album/pgfotografo/slide2.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
        \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 3 */
  $origin = "../master/pgfotografo/slide3.php";
  $destination = "../album/$id_album/pgfotografo/slide3.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
         \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 4 */
  $origin = "../master/pgfotografo/slide4.php";
  $destination = "../album/$id_album/pgfotografo/slide4.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
      \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 5 */
  $origin = "../master/pgfotografo/slide5.php";
  $destination = "../album/$id_album/pgfotografo/slide5.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
      \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina slide 6 */
  $origin = "../master/pgfotografo/slide6.php";
  $destination = "../album/$id_album/pgfotografo/slide6.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
      \$id_album=$id_album;  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /*    CREO LE PAGINE PER I CLIENTI */
  /*   creo la pagina iniziale pgcliente */
  $origin = "../master/pgcliente/index.php";
  $destination = "../album/$id_album/pgcliente/index.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
        \$path_galleria_register='album/$id_album/pgcliente/index.php';
        \$id_album=$id_album;
        \$id_fotografo=$id_fotografo   ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina cliente preferiti.php */
  $origin = "../master/pgcliente/preferiti.php";
  $destination = "../album/$id_album/pgcliente/preferiti.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
        \$id_album=$id_album;
        \$nome_album='$nome_album';
        \$sottotitolo='$sottotitolo';
        \$id_fotografo=$id_fotografo;
        \$path_copertina='$path_copertina';     ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /* creo la pagina cliente preferiti confermati.php */
  $origin = "../master/pgcliente/preferiti_confermati.php";
  $destination = "../album/$id_album/pgcliente/preferiti_confermati.php";
  copy($origin, $destination);

  $nuovo_file = fopen("$destination", "r+") or die("unable to open file!");
  $testo = "<?php
        \$id_album=$id_album;
       \$nome_album='$nome_album';
       \$sottotitolo='$sottotitolo';
       \$id_fotografo=$id_fotografo;
       \$path_copertina='$path_copertina'  ";


  fwrite($nuovo_file, $testo);
  fclose($nuovo_file);

  /*  PREPARO IL JSON PER I DATI DELL'ALBUM */

  $array_report = [
    "personale" => [],
    "foto_scaricate" => [],
  ];

  $json_report = json_encode($array_report);
  $byte = file_put_contents("../album/$id_album/pgfotografo/json_report.json", $json_report);
}
/* END CREA ALBUM */


/* CARICA FOTO----------------------------------------------------------------------------------------------------------------------------------- */
/* FUNZIONE PER CARICARE FOTO SULL'ALBUM */
/* Le foto scelte verranno ridimensionate e salvate nella cartella scelta */

function carica_foto($id_album, $id_fotografo)
{
  include('../../../function/funzioni_album.php');
  $sostituire = array("'", " ", "<", ">", "&", "£", ".");
  $sotto_cartella = htmlEntities(str_replace($sostituire, "_", trim($_POST['sotto_cartella'])), ENT_NOQUOTES);
  $tag = trim($_POST['tag']);


  /* CON 0777, TRUE VADO A CREARE TUTTE LE CARTELLE SE NON ANCORA ESISTENTI
IN UNA SOLA RIGA invece di fare 3 righe (nomealbum cartella e poi small) */

  if (is_dir("../sottocartelle/$sotto_cartella/medium/") != TRUE) {
    mkdir("../sottocartelle/$sotto_cartella/medium/", 0777, TRUE);
  }

  if (is_dir("../sottocartelle/$sotto_cartella/large/") != TRUE) {
    mkdir("../sottocartelle/$sotto_cartella/large/", 0777, TRUE);
  }

  if (is_dir("../sottocartelle/$sotto_cartella/large/modificate") != TRUE) {
    mkdir("../sottocartelle/$sotto_cartella/large/modificate", 0777, TRUE);
  }

  if (is_dir("../sottocartelle/$sotto_cartella/watermark/") != TRUE) {
    mkdir("../sottocartelle/$sotto_cartella/watermark/", 0777, TRUE);
  }

  /*  questa parte e per salvare l'alta risoluzione su una cartella del pc */
  /*  controllo se è stato inserito un percorso e allora utilizzo quello, altrimenti uTilizzo quello di base */
  include('../../../config_pdo.php');
  $controllo = $conn->prepare("SELECT path_pc FROM 1album WHERE id_album=:id_album;");
  $controllo->bindparam(':id_album', $id_album);
  $controllo->execute();
  while ($row = $controllo->fetch(PDO::FETCH_ASSOC)) {
    if ($row['path_pc'] == 1) {
      $path_hd = "../sottocartelle/$sotto_cartella/large/";
      /* echo $path_hd; */
    } else {
      $path_hd = "{$row['path_pc']}/$sotto_cartella/" /* $row['path_pc'] */;
      if (is_dir("$path_hd") != TRUE) {
        mkdir("$path_hd", 0777, TRUE);
      }
    }
  }





  /* Funzione personalizzata per ordinare l'array $_FILES in modo migliore */
  $files = sistema_array($_FILES);

  /*     stampo le info dei file caricati */
  /* foreach ($files as $key => $value) {
  foreach ($value as $key1 => $value1) {
         echo "</br>$key1 => $value1 </br>";
      }
 } */


  /* creo la connesione al db */


  /*   se la tabella esiste creo le variabili path e path_small e path_medium e dichiaro le estensioni consentite */
  $esiste_tabella = $conn->prepare("SHOW TABLES LIKE :id_album ;");
  $esiste_tabella->bindparam(':id_album', $id_album);


  if ($esiste_tabella->execute()) {
    $tipi_consentiti = array("image/jpeg");
    $path_file = "../sottocartelle/$sotto_cartella/large/";
    $path_medie = "../sottocartelle/$sotto_cartella/medium/";
    $path_watermark = "../sottocartelle/$sotto_cartella/watermark/";
  }



  $n_foto_caricate = 0;
  $n_foto_non_caricate = 0;


  foreach ($files as $file) {   /*   controllo il type di ogni file se è giusto */
    if (in_array($file['type'], $tipi_consentiti)) {  /*  se il type è giusto lo copio nella sua cartella , creo e copio miniature e salvo i dati nel db*/


      /*  inizio controllo file gia scaricato */
      $exif = exif_read_data($file['tmp_name'], 'IFDO');
      $data = $exif['DateTimeOriginal'];
      $controllo = 0;

      $foto_presente = $conn->prepare("SELECT `nome_foto` ,`data` FROM $db.$id_album");
      $foto_presente->execute();
      while ($row = $foto_presente->fetch(PDO::FETCH_ASSOC)) {
        if ($file['name'] == $row['nome_foto']  && $data == $row['data']) {
          $controllo = 1;
        }
      }

      if ($controllo == 0) {  /* eliminare fino qui per togliere il controllo foto gia scaricata ed eliminare la parte segnata in fondo */
        $n_foto_caricate++;
        /*           fine controllo foto gia presente nell'album */

        if (isset($_POST['resolution']) && $_POST['resolution'] == 'hd') { //se l'opzione hd è selezionata copio i file in hd 

          copy($file['tmp_name'], "$path_hd" . $file['name']); //RICORDARSI DI SISTEMARE LA PATH GIUSTA PATH_HD_BIS
          $dimensioni_foto = getimagesize($file['tmp_name']);
          if ($dimensioni_foto[0] < $dimensioni_foto[1]) { //se è verticale uso queste dimensioni
           
            riduci_e_salva($file['tmp_name'], 500, $path_medie . $file['name'], 75, true);
          } else if ($dimensioni_foto[0] > $dimensioni_foto[1]) {  //se è orizzontale uso queste dimensioni
         
            riduci_e_salva($file['tmp_name'], 900, $path_medie . $file['name'], 75, false);
          } else {
           
            riduci_e_salva($file['tmp_name'], 800, $path_medie . $file['name'], 75, false);
          }
        } else if (isset($_POST['resolution']) && $_POST['resolution'] == 'speed') {
           //START RIDIMENSIONAMENTO E SALVATAGGIO IMMAGINI E WATERMARK
        /* funzione per ridurre e salvare l'immagine
         parametri 1-tpm_name dell'immagine, dimensione finale, path del salvataggio, compressione */
          $dimensioni_foto = getimagesize($file['tmp_name']);
          if ($dimensioni_foto[0] < $dimensioni_foto[1]) { //se è verticale uso queste dimensioni
            riduci_e_salva($file['tmp_name'], 500, $path_medie . $file['name'], 75, true);
            riduci_e_salva($file['tmp_name'], 1600, $path_hd . $file['name'], 75, true);
          } else if ($dimensioni_foto[0] > $dimensioni_foto[1]) {  //se è orizzontale uso queste dimensioni
            riduci_e_salva($file['tmp_name'], 900, $path_medie . $file['name'], 75, false);
            riduci_e_salva($file['tmp_name'], 2300, $path_hd . $file['name'], 75, true);
          } else {
            riduci_e_salva($file['tmp_name'], 800, $path_medie . $file['name'], 75, false);
            riduci_e_salva($file['tmp_name'], 2300, $path_hd . $file['name'], 75, true);
          }
        }



/* *****************************CODICE PER CREARE IMG CON LA WATERMARK********************************
*****************************DA RIMETTERE QUANDO USEREMO LA PARTE CLIENTI****************************
*************************************************************************************************** */


        if (file_exists("../../../fotografi/$id_fotografo/watermark/watermark.png"))
          $path_file_watermark = "../../../fotografi/$id_fotografo/watermark/watermark.png";
        else  $path_file_watermark = "../../../img/logo_w.png";

        watermark($file['tmp_name'], $path_watermark . $file['name'], $path_file_watermark);




        /*         poi inserisco i dati nel db */
        $file_name = $file['name'];
        $path = $path_file . $file_name;
        if(isset($_POST['tag']) && $_POST['tag'] != NULL){
          $tag = str_replace(' ','_',$_POST['tag']);
        }else{
          $tag ='NO_TAG';
        }
       
        $path_medium = $path_medie . $file_name;
        $path_watermark_db = $path_watermark . $file_name;
        $exif = exif_read_data($path, 'IFDO');
        $data_scatto = $data;  // prende il $exif['DateTimeOriginal']; che abbiamo definito prima dal file originale


        $insert = $conn->prepare("INSERT INTO `$id_album`( `id_album`, `id_fotografo`, `sotto_cartella`, `path`, `path_medium`, `path_watermark`,`nome_Foto`, `tag`, `data`)
         VALUES (:id_album, :id_fotografo,:sotto_cartella, :path_big , :path_medium, :path_watermark, :nome_foto, :tag , :data);");
        $insert->bindparam(':id_album', $id_album);
        $insert->bindparam(':id_fotografo', $id_fotografo);
        $insert->bindparam(':sotto_cartella', $sotto_cartella);
        $insert->bindparam(':path_big', $path);
        $insert->bindparam(':path_medium', $path_medium);
        $insert->bindparam(':path_watermark', $path_watermark_db);
        $insert->bindparam(':nome_foto', $file_name);
        $insert->bindparam(':tag', $tag);
        $insert->bindparam(':data', $data_scatto);
        if ($insert->execute()) {
        } else {
          echo " foto non caricata";
        }
        /* if ($insert->execute()) {
          echo "</br><h4 style=\"color: green \">caricata</h4><img src=\"$path_small\" style=\"border: 2px solid green\";>  <h4 style=\"color: green \">$file_name </h4> ";
        } else {
          echo "</br></br><h4 style=\"color: red \">errore</h4><img src=\"$path_small\" style=\"border: 2px solid red\">  <h4 style=\"color: red \">$file_name</h4> ";
        }; */
      } else {    /* FINE IF CONTROLLO = A 0  GRAFFA DA ELIMINARE PER TOGLIERE IL CONTROLLO FOTO GIA SCARICATA*/
        echo 'Foto: ' . $file['name'] . ' già presente nell\'album ' . $data . '</br>';
        $n_foto_non_caricate++;
      } /* graffa da togliere per togliere il controllo foto gia scaricata */
    } //end if tipi consentiti
  } //end foreach 

  $conn = null;

  $array_caricamento = [
    'foto_caricate' => $n_foto_caricate,
    'foto_non_caricate' => $n_foto_non_caricate
  ];
  return  $array_caricamento;
}/* END CARICA FOTO--------------------------- */


/* FUNZIONI VARIE */

function sistema_array($files)
{
  $newFiles = array();
  foreach ($files as $key => $file) {
    foreach ($file as $keyfile => $itemfile) {
      for ($i = 0; $i < count($itemfile); $i++) {
        $newFiles[$i][$keyfile] = $itemfile[$i];
      }
    }
  }
  return $newFiles;
}
