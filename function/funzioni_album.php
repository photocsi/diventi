<?php
//Lista funzioni
/* numero_preferiti() - prende tutti i preferiti del cliente e aggiorna il numero totale nella tabella del cliente
   prendi_preferiti() - prende tutti i preferiti di un cliente in un album e crea un array di preferiti utilizzabile
                        (crea il risultato di una query che prende tutti i dati dei preferiti prota per essere ciclata in row)
   array_cartelle()   - prende tutte le cartelle di un album e le mette in un array (crea un array con i nomi di tutte le cartelle)
   lista_clienti()    - crea un array con la lista clienti di un album
   lista_operatori()    - crea un array con la lista id degli operatori di un album
   resetta_sessioni() - elimina tutte le sessioni escluso id_fotografo e user_fotografo 
   invia_email()      - permette di inviare una email
   modale_cliente()   - crea un modale per un cliente (quindi card con i suoi dati , selezione carrello ecc.)
   miniatura_and_watermark() - riduco un immagine di dimensione e se voglio aggiungo il watermark
   riduci_e_salva()   - riduce un'immagine jpg e la salva in una cartella di destinazione
   riduci_e_salva_png()   - riduce un'immagine png e la salva in una cartella di destinazione
   watermark()        - Applica il watermark su unimmagine e la salva in una cartella di destinazione
   aggiungi_lista()   - prende la lista , la trasforma in array controlla se il valore è presente altrimenti lo aggiunge e lo inserisce come stringa nel campo del db
   lista_album()       - prende la tutti gli album di un fotografo e li mette in lista secondo html che c'e' in dashboard

   INIZIO FUNZIONI*/


   /* controllo le impostazioni inserite nel db 1album */
function path_pc($id_album){
  include('../../../config_pdo.php');
  $select=$conn->prepare("SELECT path_pc FROM 1album WHERE id_album= :id_album ;");
$select->bindparam(':id_album' , $id_album);
$select->execute();
$row=$result->fetch(PDO::FETCH_ASSOC);
if($row['path_pc']==NULL){
  $update=$conn->prepare("UPDATE `1album` SET `path_pc`=1  WHERE id_album = :id_album");
  $update->bindparam(':id_album' , $id_album);
    if($update->execute()){
        /* echo"Preferiti aggiornati con successo"; */
    }else{
        die ("Errore nell'aggiornamento dei preferiti".$connessione->connect_error); 
    }
    $conn= null;
  return FALSE;
}else{
  
  return TRUE;
}
}


/* prendo il numero totale dei preferiti e lo aggiorno nella casella del cliente */
function numero_preferiti($id_album,$id_cliente){
  include('../../../config_pdo.php');
  $preferiti=$conn->prepare(" SELECT COUNT(*) FROM $db.$id_album  INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto 
   WHERE id_cliente=:id_cliente;");
   $preferiti->bindParam(':id_cliente' , $id_cliente);
  $preferiti->execute();
                $row=$preferiti->fetch(PDO::FETCH_COLUMN);
                $totale_preferiti=$row;

  $up=$conn->prepare("UPDATE `1clienti` SET `numero_preferiti`=:totale_preferiti WHERE id_cliente=:id_cliente;");
  $up->bindParam(':totale_preferiti', $totale_preferiti);
  $up->bindParam(':id_cliente', $id_cliente);
  $up->execute();
  
$conn= null;
return $totale_preferiti;
}

function prendi_clienti($id_album){

  include('../../../config_pdo.php');
    
  $select=$conn->prepare("SELECT * FROM  1clienti WHERE conferma_preferiti = 1 AND id_album = :id_album");
  $select->bindParam(':id_album', $id_album);
  $select->execute();

  $conn= null;
  return $select;

}
/* CREO ARRAY DI TUTTI I PREFERITI DI UN CLIENTE IN UN ALBUM */
/* prendo tutti i preferiti e li metto in result, dopo aver richiamato la funzione si puo fare un while */
function prendi_preferiti($id_album,$id_cliente){
  include('../../../config_pdo.php');
    
  $select=$conn->prepare("SELECT * FROM $db.$id_album
  INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente;");
  $select->bindParam(':id_cliente', $id_cliente);

  $select->execute();

  return $select;
}

/* CREAO UN ARRAY DI CARTELLE DELL'ALBUM */
/* prendo tutte le cartelle di un album e le metto in un array */
function array_cartelle($id_album){
  include('../config_pdo.php');
  $sotto_cartelle = array();
$select_cartelle=$conn->prepare("SELECT sotto_cartella FROM $db.$id_album GROUP BY sotto_cartella ; ");
$select_cartelle->execute();
/* prima estrapolo le cartelle e le metto in un array */
while($row=$select_cartelle->fetch(PDO::FETCH_ASSOC)){
$sotto_cartelle[]=$_SESSION['sotto_cartella'][]=$row['sotto_cartella'];
}

$conn= null;
return $sotto_cartelle;
    }
  
/* CREO UN ARRAY CON LA LISTA CLIENTI DI UN ALBUM */
function lista_clienti($id_album){
  include('../../../config_pdo.php');
/* estrapolo la lista clienti di quell'album */
    $select_clienti=$conn->prepare("SELECT clienti_registrati FROM 1album WHERE id_album= :id_album;");
    $select_clienti->bindParam(':id_album' , $id_album);
    $select_clienti->execute();
    $row=$select_clienti->fetch(PDO::FETCH_ASSOC);
/* La lista in $row[0] è una stringa che vado a dividere creando un array */
  $array_clienti=explode(",",$row['clienti_registrati']);
  $conn= null;
  return $array_clienti;

}

/* CREO UN ARRAY CON LA LISTA CLIENTI DI UN ALBUM */
function lista_operatori($id_album){
  include('../config_pdo.php');
/* estrapolo la lista clienti di quell'album */
    $select_clienti=$conn->prepare("SELECT operatori_registrati FROM 1album WHERE id_album=:id_album;");
    $select_clienti->bindParam(':id_album' , $id_album);
    $select_clienti->execute();
    $row=$select_clienti->fetch(PDO::FETCH_ASSOC);
/* La lista in $row[0] è una stringa che vado a dividere creando un array */
  $array_operatori=explode(",",$row['operatori_registrati']);
  $conn= null;
  return $array_operatori;

}


/* RESETTO TUTTE LE SESSIONI ESCLUSO ID FOTOGRAFO E USER FOTOGRAFO */
function resetta_sessioni(){
  unset($_SESSION['path_cartella']);unset($_SESSION['numero_preferiti']);unset($_SESSION['id_album']);unset($_SESSION['nome_album']);
  unset($_SESSION['sottotitolo']);unset($_SESSION['data_album']);unset($_SESSION['path_copertina']);unset($_SESSION['tabella']);
  unset($_SESSION['sotto_cartella']); unset($_SESSION['sotto_cartella2']);unset($_SESSION['path_sotto_cartella']);unset($_SESSION['path_copertina_cliente']);unset($_SESSION['path_cartella_cliente']);
  unset($_SESSION['path_galleria_register']);unset($_SESSION['email_cliente']);unset($_SESSION['id_cliente']);unset($_SESSION['nome_cliente']);
}


/* INVIARE EMAIL */
/* permette di invuare una email */
function invia_email($email_destinatario,$email_mittente,$nome,$oggetto,$messaggio){

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = $email_destinatario;

  if( file_exists($php_email_form = '../../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
/*   $contact->ajax = true; */
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $nome;
  $contact->from_email = $email_mittente;
  $contact->subject = $oggetto;

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  
  $contact->smtp = array(
    'host' => 'smtp.libero.it',
    'username' => 'infostudio.csi@libero.it',
    'password' => 'Shubniggurat1!',
    'port' => '25'
  );
 

  $contact->add_message( $nome, 'Da');
  $contact->add_message( $email_mittente, 'Email');
  $contact->add_message( $messaggio, 'messaggio', 5);

  echo $contact->send();

}

/* controllo le impostazioni inserite nel db 1album */
function controlla_opzioni($id_album,$codice){
  include('../../../config_pdo.php');
  $select=$conn->prepare("SELECT opzioni FROM 1album WHERE id_album=:id_album ;");
  $select->bindParam(':id_album', $id_album);
  $select->execute();
$row=$select->fetch(PDO::FETCH_ASSOC);
$array_codice=explode(" ",$row['opzioni']);//trasformo la stringa in array
if(in_array("$codice",$array_codice)){
  return TRUE;
}else{
  return FALSE;
}
}

/* creo la lista dei clienti in modale */
function modale_cliente($nome_cliente,$email_cliente,$telefono_cliente,$conferma_selezione,$numero_selezione,$id_album,$id_cliente){
  
  echo"<div class='card'>
  <div class='card-body' style='text-align: center;'>
    <h5 class='card-title' >Nome: $nome_cliente</h5>
    <p><i class='bi bi-envelope-at'></i> $email_cliente &nbsp - &nbsp <i class='bi bi-telephone'></i> $telefono_cliente</p>";

    /* controllo se la selezione è stata confermata per inserire l'icona corretta */
    if($conferma_selezione==1)
            echo" <button type='button' id='$id_cliente' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modalDialogScrollable$id_cliente'>
            <i class='bi bi-heart-fill'></i> $numero_selezione  </button>";
    else
            echo" <button type='button' id='$id_cliente' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#modalDialogScrollable$id_cliente'>
            <i class='bi bi-heart'></i> $numero_selezione  </button>";

/* qui parte la finestra modale */
//con l'intestazione del nome del cliente
            echo" <div class='modal fade' id='modalDialogScrollable$id_cliente' tabindex='-1'>
             <div class='modal-dialog modal-dialog-scrollable modal-xl'>
               <div class='modal-content'>
                  <div class='modal-header'>
                    <h5 class='modal-title'>Selezione $nome_cliente</h5>
                       <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                   </div>
                   <div class='modal-body'>
                   
                   <div class='container' style=' padding: 0 30px 0 30px ;' data-aos='fade-up'>
                   <div class='section-title'>
                         <div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>";
/* vado a prendere tutti i preferiti e li impagino insieme al nome delle foto all'interno della finstra */
                   $result=prendi_preferiti($id_album,$id_cliente);
                   while($row=$result->fetch(PDO::FETCH_ASSOC)){
                    echo" <div class=\"col-lg-2 col-md-6 portfolio-item filter-app\">
                    <div class=\"portfolio-wrap\">
                    <img src=\"{$row['path_small']}\" class=\"img-fluid\" alt=\"\">
                    <div class=\"portfolio-info\">
                    <p> {$row['nome_foto']}</p>
                    <a href=' {$row['path']}' download='{$row['nome_foto']}'>
                    <button type='button'id=\"{$row['id_foto']}\" name=\"{$row['nome_foto']}\"
                    value=\"$id_album,{$row['id_foto']},download\" onclick=\"contatore({$row['id_foto']})\" class='btn btn-outline-primary btn-sm  '>Scarica foto</button></a>";
                  
                   echo " <div class=\"portfolio-links\">
                  
                   </div></div></div></div>";
                   }
                 echo"</div></div></div> </div>";

                /*  parte bassa della finestra del modale con i vari pulsanti */
                //i pulsanti hanno vari id e l'onclick per il funzionamento
         echo" <div class='modal-footer hstack gap-3'>
        
            <button type='button' name='bottone' value='a,$id_cliente,$id_album' id='annulla$id_cliente' onclick=\"cancella_selezione('annulla$id_cliente','$id_cliente')\" class='btn btn-outline-danger btn-sm '>Annulla conferma</button>
            
            <button type='button' name='bottone' value='c,$id_cliente,$id_album' id='cancella$id_cliente' onclick=\"cancella_selezione('cancella$id_cliente','$id_cliente')\"  class='btn btn-outline-danger btn-sm '>Azzera selezione</button>
         
            <button type='submit' class='btn btn-outline-primary btn-sm ms-auto' disabled>Estrai le foto dal pc</button>
           
            <div class='vr'></div>
            <a href=' ../pgcliente/selezioni/$nome_cliente-selezione-$id_cliente.txt' download='$nome_cliente-selezione-$id_cliente.txt'>
            <button type='button' class='btn btn-outline-primary btn-sm  '>Scarica selezione txt</button></a>
          </div>
        </div>
      </div>
    </div><!-- End Modal Dialog Scrollable-->
    </div>
  </div>";

    
}



//funzione per ridurre e salvare l'immagine
//parametri: il tmp_name dell'immagine, la dimensione finale in px, il path di destinazione e la compressione HO aggiunto un bollean vero o falso per capire se e verticale oppure no (non so se lo utilizzero)
function riduci_e_salva($file,$dimensione,$path_destinazione,$compressione , $boolean){
  $img = imagecreatefromjpeg($file);
  $exif = exif_read_data($file, 'IFDO');
  if (isset($exif['Orientation']))
  {
      $ort = $exif['Orientation'];

      if ($ort == 6 || $ort == 5){
          $img = imagerotate($img, 270, 0);
       }else if ($ort == 3 || $ort == 4){
          $img = imagerotate($img, 180, 0);
        }else if ($ort == 8 || $ort == 7){
          $img = imagerotate($img, 90, 0);

        } /* else if ($ort == 5 || $ort == 4 || $ort == 7)
          imageflip($img, IMG_FLIP_HORIZONTAL); */
  }

$immagine=imagescale($img, $dimensione); 
imagejpeg($immagine,$path_destinazione, $compressione);
}



function riduci_salva_logo_grafica($file,$dimensione,$path_destinazione,$compressione, $type){
   
  if( $type == 'image/jpeg' ) {
    $sorgente = imagecreatefromjpeg($file);
          $img=imagescale($sorgente, $dimensione);  
           imagejpeg($img,$path_destinazione); 

       } elseif( $type == 'image/png' ) {
        copy($file,$path_destinazione);
          
       } elseif( $type == 'image/gif' ) {
          $sorgente = imagecreatefromgif($file);
          $img=imagescale($sorgente, $dimensione);  
          imagegif($img,$path_destinazione, $compressione);
      }
}


function riduci_e_salva_png($file,$dimensione,$path_destinazione,$compressione){

  /* $sorgente = imagecreatefrompng($file);
  $img=imagescale($sorgente, $dimensione);  */
  /* imagepng($sorgente,$path_destinazione, $compressione); */
  copy($file,$path_destinazione);
 
  }

/* FUNZIONE PER APPLICARE WATERMARK */
// riduco la dimensione di un immagine 
//i parametri indicano: tmp_name dell'immagine, path di destinazione e il path del watermark
function watermark($file,$path_destinazione,$path_watermark){
  $dimensioni_watermark = getimagesize($path_watermark); // prendo le dimensioni del watermark png
  $dimensioni_foto = getimagesize($file); // prendo le dimensioni della foto jpg
  if($dimensioni_foto[0]<$dimensioni_foto[1]){ //controllo se e verticale faccio cosi
    $distanza_sinistra=50; //distanza fra bordo sx e logo
    $distanza_alto=350; //distanza fra bordo alto e lgo
     $larghezza=$dimensioni_watermark[0];
     $altezza=$dimensioni_watermark[1];
     $grandezza=600; //questa e la grandezza in px dell'immagine finale
  }else if($dimensioni_foto[0]>$dimensioni_foto[1]){ //se e orizzontale cosi
    $distanza_sinistra=200;
    $distanza_alto=200;
    $larghezza=$dimensioni_watermark[0];
    $altezza=$dimensioni_watermark[1];
    $grandezza=1000;
  }else{  // se e quadrata faccio cosi
    $distanza_sinistra=150;
    $distanza_alto=150;
    $larghezza=$dimensioni_watermark[0];
    $altezza=$dimensioni_watermark[1];
    $grandezza=900;
  }
$sorgente = imagecreatefromjpeg($file);
$immagine=imagescale($sorgente, $grandezza); 
$watermark=imagecreatefrompng($path_watermark);
imagecopy($immagine, $watermark, $distanza_sinistra,$distanza_alto, 0, 0, $larghezza, $altezza);
/* imagecopymerge($immagine, $watermark,$larghezza,$altezza,0,0,imagesx($watermark),imagesy($watermark),40); */
imagejpeg($immagine,$path_destinazione, 75);
 
}

/* per estrarre il nome delle cartelle */
function mostra_cartelle($path){
  if(is_dir($path)){
  $result=scandir($path);
  $cartelle=array_diff($result,array('.','..'));

  }

  return $cartelle;
}

function mostra_selezionate($id_album,$id_cliente){
  include('../../../config_pdo.php');
  $select=$conn->prepare("SELECT * FROM $db.$id_album 
  INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente ;");
  $select->bindParam(':id_cliente' , $id_cliente);
  $select->execute();
  
  $conn= null;
  return $select;
}


                    /*  FACCIO IL PROCEDIMENTO PER AGGIUNGERE L'ID CLIENTE ALLA LISTA CLIENTI OPPURE OPERATORI DELLA TABELLA 1ALBUM */
                 /*     seleziono la lista clienti nell'album */
                 //parametri: 1 la colonna che sarà clienti_registrati oppure operatoi_registrati - 2 l'id album - 3 l'id cliente da aggiungere - 4 il percorso del config_pdo
  function aggiungi_lista_cliente($colonna, $id_album, $id_cliente, $config_pdo){    
    include($config_pdo);           
                 $select_clienti=$conn->prepare("SELECT $colonna FROM 1album WHERE id_album= :id_album ;");
                 $select_clienti->bindParam(":id_album",$id_album);

                 $select_clienti->execute();
                 $row=$select_clienti->fetch(PDO::FETCH_ASSOC);
               /*  prendo la stringa con tutti gli id e la trasformo in array */
                 $array=explode(",",$row[$colonna]);
                 
               /*  se l'id è già presente nell'array non faccio nulla altrimenti inserisco il nuovo valore */
                 if(in_array($id_cliente,$array)){
                   }else{
                      array_push($array,$id_cliente);
                     /* ordino l'array */
                      sort($array);
                     /* ritrasformo l'array in stringa */
                     $stringa_clienti=implode(",",$array);

                     /*    inserisco la stringa con tutti gli id cliente all'interno della cella in tabella album */
                      $insert_cliente=$conn->prepare("UPDATE 1album SET $colonna= :stringa_clienti WHERE id_album= :id_album;");
                      $insert_cliente->bindParam(":stringa_clienti",$stringa_clienti);
                      $insert_cliente->bindParam(":id_album",$id_album);
                      $insert_cliente->execute();
                     
                      $conn= null;
                     }
                    }


                    /* VISUALIZZO TUTTI GLI ALBUM DI UN FOTOGRAFO SOTTOFORMA DI TABELLA */
//richiede l'id del fotografo 

function lista_album($id_fotografo){  
  include('../config_pdo.php'); 
  
$select=$conn->prepare("SELECT * FROM 1album WHERE id_fotografo= :id_fotografo ORDER BY id_album DESC");
$select->bindParam(":id_fotografo", $id_fotografo);
$select->execute();
$conn = null;
  
  while($row=$select->fetch(PDO::FETCH_ASSOC)){
   
      echo" 
           <div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>
           
            <th scope='row'><a href='../album/{$row['id_album']}/pgfotografo/impostazioni.php'><img src='../album/{$row['id_album']}/copertina/{$row['path_copertina']}' alt=''></th></a>
            
            <td><a href='../album/{$row['id_album']}/pgfotografo/impostazioni.php'>{$row['nome']}</a></td>
            <td>{$row['sottotitolo']}</td>
           <td class='fw-bold'>{$row['data_album']}</td>
       </tr>";
    }
  
  
     echo '</tbody>
     </table>
     </div>
     </div>
     </div>';
  }
     
  
?>
