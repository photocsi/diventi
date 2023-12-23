
<?php

$id_album=3444      ;
$nome_album=''    ;
$sottotitolo='' ;
$id_fotografo=3444    ;
$path_copertina=""                                                                                                                      ;
 



 
session_start();

$id_cliente=$_SESSION['id_cliente'];
$nome_cliente=$_SESSION['nome_cliente'];
$numero_preferiti=$_SESSION['numero_preferiti'];


if(!isset($_SESSION['email_cliente'])){
header('Location: ../../../register_clienti.php');
}

?>
  <!DOCTYPE html>
  <html lang='it'>
  <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Galleria</title>
  
      <!-- Favicons -->
    <link href='../../../assets2/img/favicon.png' rel='icon'>
    <link href='../../../assets2/img/apple-touch-icon.png' rel='apple-touch-icon'>
  
    <!-- Vendor CSS Files -->
    <link href='../../../assets2/vendor/aos/aos.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/glightbox/css/glightbox.min.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/remixicon/remixicon.css' rel='stylesheet'>
    <link href='../../../assets2/vendor/swiper/swiper-bundle.min.css' rel='stylesheet'>
  
    <!-- Template Main CSS File -->
    <link href='../../../assets2/css/style.css' rel='stylesheet'>
  
  
  </head>
  <body>

  <?php
   /*  SE VIENE CONFERMATA LA SELEZIONE TRAMITE IL PULSANTE------------------------------------- */
  /*  vado ad aggiungere true(1) nella cella conferma preferiti e la data della conferma*/
      include('../../../config_pdo.php'); include('../../../function/funzioni_album.php');
      $update=$conn->prepare("UPDATE 1clienti SET conferma_preferiti=TRUE ,data_conferma_preferiti=CURRENT_TIMESTAMP WHERE id_cliente= :id_cliente ;"); 
      $update->bindParam(':id_cliente', $id_cliente);
      
      if($update->execute()===FALSE){
        die ("Errore di creazione");
        }else{
          $selezione_confermata=TRUE;
       /*   poi seleziono tutti i dati dei preferiti dalla tabella del suo album e creo gli array */
          $select=$conn->prepare("SELECT * FROM $db.$id_album
          INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto 
           WHERE id_cliente= :id_cliente AND 1preferiti.id_album= :id_album;");
           $select->bindParam(':id_cliente', $id_cliente);
           $select->bindParam(':id_album', $id_album);
          $select->execute();
          while($row=$select->fetch(PDO::FETCH_ASSOC)){
              $array_nome_foto[]=$row['nome_foto'];
          }

          /*    faccio una queri per selezionare la data di conferma della selezione */
          $select_data=$conn->prepare("SELECT data_conferma_preferiti FROM 1clienti WHERE id_cliente= :id_cliente ;");
          $select_data->bindParam(':id_cliente' , $id_cliente);
            $select_data->execute();
            $row=$select_data->fetch(PDO::FETCH_ASSOC);
            $data_conferma_usa=$row['data_conferma_preferiti'];
            /*  trasformo la data dal formato usa al formato italiano */
            $array_data=explode("-","$data_conferma_usa");
            $array_inverso=array($array_data[2],$array_data[1],$array_data[0]);
            $data_conferma=implode("-",$array_inverso);
           
          /*  apro il file che non esistendo lo crea */
          $lista_preferiti=fopen("selezioni/$nome_cliente-selezione-$id_cliente.txt",'w'); /* percorso dove creare il file txt */
            $testo="Lista Foto selezionate";
            $testoB="Selezione confermata da $nome_cliente il $data_conferma";
            fwrite($lista_preferiti, $testo."\n".$testoB."\n");
          foreach ($array_nome_foto as $value) {
            $lista_preferiti=fopen("selezioni/$nome_cliente-selezione-$id_cliente.txt",'a');
            $testo="$value";
            fwrite($lista_preferiti, $testo."\n");
            
          }
          
          fclose($lista_preferiti);

       /*    includo il file con la funzione per l'email */


          /*    seleziono l'email del fotografo tramite query */
          /*   $select_email="SELECT email_fotografo FROM fotografi INNER JOIN 1album
          ON 1album.id_fotografo=fotografi.id_fotografo
          where id_album='168';"; */

          /* compongo gli elementi del messaggio */
          /*  $result=$connessione->query($select_email);
          $row=$result->fetch_row();
          $email_mittente="infostudio.csi@libero.it";
          $nome="CSI";
          $oggetto="Preferiti confermati";
          $messaggio=" $nome_cliente ha confermato la sua selezione il $data_conferma 
";
          foreach ($array_nome_foto as $value) {
            $messaggio.=" $value  
";
           
          }
          invia_email($row[0],$email_mittente,$nome,$oggetto,$messaggio);*/

     

        }
    ?>
  <!-- MENU -->
  
  <!-- ======= Header ======= -->
  <header id='header' class='fixed-top ' style='background-color: black'>
      <div class='container d-flex align-items-center justify-content-lg-between'>
  
   <!--      <h1 class='logo me-auto me-lg-0'><a href='index.html'>Tardis<span>.</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href='' class='logo me-auto me-lg-0'><img src='<?php echo "../../../fotografi/$id_fotografo/logo/logo.jpg "; ?>' alt='' class='img-fluid'></a>
  
        <nav id='navbar' class='navbar order-last order-lg-0'>
          <ul>
            <li><a class='nav-link scrollto' href='index.php'>Album</a></li>
            
            <li><a class='nav-link scrollto' href='carrello.php'>Carrello</a></li>
          </ul>
          <i class='bi bi-list mobile-nav-toggle'></i>
        </nav><!-- .navbar -->
  
        <a href='#header' class='get-started-btn scrollto'>Torna su</a>
  
      </div>
    </header><!-- End Header -->

    <main id='main'>
     <!-- ======= SEZIONE FOTO ======= -->
  
     <section id='portfolio' class='portfolio'>
        <div class='container' data-aos='fade-up'>
  
  <div class='section-title'>
  </br>
    <h2>Selezione</h2> 
    <h5></br>Hai confermato la scelta di <?php echo $numero_preferiti ?> fotografie</h5>
    <h4> Il tuo fotografo ha già ricevuto la tua selezione , ora non ti resta che aspettare o acquistare altri prodotti.</h4>
  </div>    
          <div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>
  <!-- prendo i prefriti di quel cliente in quell'album -->
                <?php
  
            $select=$conn->prepare("SELECT * FROM $db.$id_album
            INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente;");
            $select->bindParam(':id_cliente' , $id_cliente);
            $select->execute();
            $conn = null;
   
  while($row=$select->fetch(PDO::FETCH_ASSOC)){
    if(controlla_opzioni($id_album,'w')==false){
      $immagine=$row['path_medium'];
    }else{
      $immagine=$row['path_watermark'];
    }
  echo" <div class='col-lg-4 col-md-6 portfolio-item filter-8'>
  
  <div class='portfolio-wrap'>
   <img src='$immagine' class='img-fluid' alt=''>
    <div class='portfolio-info'>
      <h4>{$row['nome_foto']}</h4>
      <div class='portfolio-links'>
        <a href='$immagine' data-gallery='$immagine' class='portfolio-lightbox'title='<b>{$row['nome_foto']}</b> '>
        <button type='button' class='btn btn-success btn-lg'><i  class='bx bx-zoom-in'></i></button></a>";
        
       echo"  &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bx bx-cart '></i></button> 
         
      </div>
    </div>
  </div>
  </div>";
  }
 

  ?>
</main>

       <!-- Vendor JS Files --> 
       <script src='../../../assets2/vendor/purecounter/purecounter_vanilla.js'></script>
    <script src='../../../assets2/vendor/aos/aos.js'></script><!-- script utile confermato -->
    <script src='../../../assets2/vendor/glightbox/js/glightbox.min.js'></script> <!-- script utile confermato -->
    <script src='../../../assets2/vendor/isotope-layout/isotope.pkgd.min.js'></script>  <!-- script utile confermato -->
    <script src='../../../assets2/vendor/swiper/swiper-bundle.min.js'></script>   <!-- script utile confermato -->
   
  
    <!-- Template Main JS File -->
    <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
    <script src='../../../assets2/js/main.js'></script>
  </body>
  </html>