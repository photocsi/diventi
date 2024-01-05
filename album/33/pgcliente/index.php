<?php
        $path_galleria_register='album/33/pgcliente/index.php';
        $id_album=33;
        $id_fotografo=1                                                        ;


session_start();
$nome_cliente=$_SESSION['nome_cliente'];
$id_cliente=$_SESSION['id_cliente'];
$_SESSION['id_album']=$id_album;
$_SESSION['id_fotografo']=$id_fotografo;

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
   <!-- PHP CODE PER ESTRAPOLARE TUTTI I VALORI CHE SERVONO -->
   
   <?php 
   include('../../../config_pdo.php');  include('../../../function/funzioni_album.php');
   $select=$conn->prepare("SELECT * FROM 1album WHERE id_album= :id_album ;");
   $select->bindParam(':id_album', $id_album);
   $select->execute();
   
   while($row=$select->fetch(PDO::FETCH_ASSOC)){
   $nome_album=$row['nome'];
   $sottotitolo=$row['sottotitolo'];
   $path_copertina=$row['path_copertina'];
   $path_cartella=$row['path_cartella'];
   
     }

     /*  salvo in sessione i dati estrapolati */
     $_SESSION['nome_album']=$nome_album; $_SESSION['sottotitolo']=$sottotitolo;  $_SESSION['path_copertina']=$path_copertina; $_SESSION['$path_cartella']=$path_cartella;
     /*    ESTRAPOLO I VALORI DAL CLIENTE */
$select_cliente=$conn->prepare("SELECT * FROM 1clienti WHERE id_cliente= :id_cliente ;");
$select_cliente->bindParam(':id_cliente', $id_cliente);
$select_cliente->execute();
   
   while($row=$select_cliente->fetch(PDO::FETCH_ASSOC)){
   $selezione_confermata=$row['conferma_preferiti'];
   
   }
   
 
   
   ?>
   
   <!-- MENU -->
   
   <!-- ======= Header ======= -->
   <header id='header' class='fixed-top '>
       <div class='container d-flex align-items-center justify-content-lg-between'>
   
    <!--      <h1 class='logo me-auto me-lg-0'><a href='index.html'>Tardis<span>.</span></a></h1> -->
         <!-- Uncomment below if you prefer to use an image logo -->
         <a href='' class='logo me-auto me-lg-0'><img src='<?php echo "../../../fotografi/$id_fotografo/logo/logo.jpg " ; ?>' alt='' class='img-fluid'></a>
   
         <nav id='navbar' class='navbar order-last order-lg-0'>
           <ul>
             <li><a class='nav-link scrollto' href='preferiti.php'>Selezione</a></li>
             <li><a class='nav-link scrollto' href='carrello.php'>Carrello <?php echo $id_cliente ?></a></li>
           </ul>
           <i class='bi bi-list mobile-nav-toggle'></i>
         </nav><!-- .navbar -->
   
         <a href='#header' class='get-started-btn scrollto'>Torna su</a>
   
       </div>
     </header><!-- End Header -->
   
   
     <!-- ======= Hero Section ======= -->
     <section id='hero' style="background: url('<?php echo $path_copertina ?> ')  top center; background-size: cover;" class='d-flex align-items-center justify-content-center'>
       <div class='container' data-aos='fade-up'>
   
          <div class='row justify-content-center' data-aos='fade-up' data-aos-delay='150'>
           <div class='col-xl-12 col-lg-12'>
           <h2><?php echo $nome_cliente ?> questo è il tuo album</h2>
             <h1><?php echo $nome_album ?><span>.</span></h1>
             <h2><?php echo $sottotitolo ?></h2>
           </div>
         </div> 
      <div class='row gy-4 mt-5 justify-content-center' data-aos='zoom-in' data-aos-delay='250'>
           <div class='col-xl-4 col-md-6'>
             <div class='icon-box'>
               <i class='bx bx-heart'></i>
               <h3><a href='168-preferiti.php'>Visualizza Selezione</a></h3>
               <p style='color: white ;'>Clicca sull'icona del cuore per selezionare le fotografie</p>
             </div>
           </div>
           <div class='col-xl-4 col-md-6'>
             <div class='icon-box'>
               <i class='bx bx-cart'></i>
               <h3><a href='../../web/carrello.php'>Visualizza Carrello</a></h3>
               <p style='color: white ;'>Clicca sull'icona del carrello per acquistare stampe , file e prodotti vari</p>
             </div>
           </div>
           <div class='col-xl-4 col-md-6'>
             <div class='icon-box'>
               <i class='bi bi-megaphone'></i>
               <h3><a href=''>Info e Comunicazioni</a></h3>
               <p style='color: white ;'>Leggi le comunicazioni del tuo fotografo e le instruzioni d'uso dell'App</p>
             </div>
           </div>
           
         </div> 
   
       </div>
     </section> <!-- End Hero --> 
     <main id='main'>
      <!-- ======= Portfolio Section ======= -->
   
      <section id='portfolio' class='portfolio'>
         <div class='container' data-aos='fade-up'>
   
           <div class='section-title'>
             <h2>cartelle</h2>
             <p><?php echo $nome_album ?></p>
           </div>
   
           <div class='row' data-aos='fade-up' data-aos-delay='100'>
             <div class='col-lg-12 d-flex justify-content-center'>
             <h2>cartelle</h2>
               <ul id='portfolio-flters'>
                 <li data-filter='*' class='filter-active'>All</li>
   
                 <?php
   
                 /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
                 $select_preferiti=$conn->prepare("SELECT id_foto FROM 1preferiti WHERE (id_cliente= :id_cliente AND id_album= :id_album )");
                 $select_preferiti->bindparam(':id_cliente', $id_cliente);
                 $select_preferiti->bindparam(':id_album', $id_album);
                  $select_preferiti->execute();
     
           /*       e li metto all'interno di un array */
           $preferiti_cliente=array();
                 while($row=$select_preferiti->fetch(PDO::FETCH_ASSOC)){
                   $preferiti_cliente[]=$row['id_foto'];
                 }
     
             /*     poi seleziono tutte le sottocartelle dell'album e le metto in un array */
           
   
   $select_sotto_cartelle=$conn->prepare("SELECT sotto_cartella FROM $db.$id_album GROUP by sotto_cartella;");
   $select_sotto_cartelle->execute();
   
   
   while($row=$select_sotto_cartelle->fetch(PDO::FETCH_ASSOC)){
     $sotto_cartelle[]=$row['sotto_cartella'];
   } 
   /* ciclo l'array e tiro fuori cartelle finche c'e' ne sono*/
   foreach ($sotto_cartelle as $value) {
     echo"  <li data-filter='.filter-$value'>$value</li>";
   }
     ?>
               </ul>
             </div>
           </div>
   
           <div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>
   
          
   
   <?php
   /* ciclo l'array delle cartelle e per ognuna
   prendendo una cartella alla volta selezione tutte le foto presenti */
   
   foreach ($sotto_cartelle as $valore) {
   
   $select=$conn->prepare("SELECT * FROM $db.$id_album WHERE `sotto_cartella`= :valore ; ");
   $select->bindParam(':valore' , $valore);
   $select->execute();
   
   while($row=$select->fetch(PDO::FETCH_ASSOC)){
     if(controlla_opzioni($id_album,'w')==false){
       $immagine=$row['path_medium'];
     }else{
       $immagine=$row['path_watermark'];
     }
   echo"  <div class='col-lg-4 col-md-6 portfolio-item filter-$valore'>
   
   <div class='portfolio-wrap'>
    <img src='$immagine' class='img-fluid' alt=''>
     <div class='portfolio-info'>
       <h4>{$row['nome_foto']}</h4>
       <div class='portfolio-links'>
         <a href='$immagine' data-gallery='$immagine' class='portfolio-lightbox'title='<b>{$row['nome_foto']}</b> '>
         <button type='button' class='btn btn-success btn-lg'><i  class='bx bx-zoom-in'></i></button></a>";
         
         /*   inserisco il bottone del cuore verde già selezionato, in caso di onclick va a cambiare lo stato selezionato si/no */
         /*  se le selezione è confermata non metto il pulsante del cuore */
           if( controlla_opzioni($id_album,'s')==false || $selezione_confermata==1){
         /*non fa nulla, altrimenti appare il pulsante cuore */
           }else{
             /*   controllo se è selezionato o no il cuoricino */
             if(in_array($row['id_foto'],$preferiti_cliente)){
             echo " &nbsp &nbsp  <button onclick='seleziona({$row['id_album']}{$row['id_foto']})' name='foto'
             value='$id_cliente,{$row['id_album']},{$row['id_foto']}' id='{$row['id_album']}{$row['id_foto']}'
             type='button' class='btn btn-success btn-lg'><i  class='bx bx-heart '></i></button> ";
             }else{
              echo"  &nbsp &nbsp  <button onclick='seleziona({$row['id_album']}{$row['id_foto']})' name='foto'
              value='$id_cliente,{$row['id_album']},{$row['id_foto']}' id='{$row['id_album']}{$row['id_foto']}'
              type='button' class='btn btn-secondary btn-lg'><i  class='bx bx-heart '></i></button>";
             }
           
           }
           if(controlla_opzioni($id_album,'c')==false){
             /*non fa nulla, altrimenti appare il pulsante carrello */
               }else{
        echo"   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bx bx-cart '></i></button> ";
               }

             if(controlla_opzioni($id_album,'m')==false){
                /*non fa nulla, altrimenti appare il pulsante messaggi */
                }else{
        echo"   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bi bi-chat-left-text-fill '></i></button> ";
                          }

              if(controlla_opzioni($id_album,'d')==false){
                /*non fa nulla, altrimenti appare il pulsante download */
                }else{
        echo"   &nbsp   <a href=' {$row['path']} 'download='file'>
               <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bi bi-cloud-arrow-down-fill '></i></button></a> ";
                              }


   echo "  </div>
     </div>
   </div>
   </div>";
   
   }
   }

   $conn= null;

   ?>

   </section> <!-- End SEZIONE FOTO -->
   <div class='container fixed-bottom'>
   <div class='card-body'>
   <a href='preferiti.php'><button class='btn btn-primary mb-2'>
    Guarda la selezione </button></a>
   </div>
</div>
   
   </section> <!-- End Team Section --> 
   </main>

   <script>
 
   function seleziona(val){
       var valore =$('#'+val).val();
       $.ajax({
           type: "post",
           url: "../../../function/seleziona.php",
           data: "foto=" + valore,
           success: function(response){
               var prova = response;
             console.log(prova);
       
               var bottone = document.getElementById(val);
               if(prova==0){
                   bottone.style.backgroundColor = 'green';
                    bottone.style.color= 'white'; 
                    
               }else{
                   bottone.style.backgroundColor = 'gray';
                   bottone.style.color= 'white';
                  
               }
            console.log(response);
           }
       })    
}
</script>
   
   
       
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