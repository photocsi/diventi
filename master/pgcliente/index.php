
    <?php
$path_galleria_register=''  ;
$id_album=$id_album  ;
$id_fotografo=$id_fotografo                                                                               ;


session_start();
$nome_cliente = $_SESSION['nome_cliente'];
$id_cliente = $_SESSION['id_cliente'];
$_SESSION['id_album'] = $id_album;
$_SESSION['id_fotografo'] = $id_fotografo;

if (!isset($_SESSION['email_cliente'])) {
  header('Location: ../../../register_clienti_semplificato.php');
}

//PER L'ONLINE GIA PRONTO CAMBIARE LA DESTINAZIONE
//   header('Location: ../../../register_clienti.php');

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



  include('../../../config_pdo.php');
  include('../../../function/funzioni_album.php');
  $select = $conn->prepare("SELECT * FROM 1album WHERE id_album= :id_album ;");
  $select->bindParam(':id_album', $id_album);
  $select->execute();

  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $nome_album = $row['nome'];
    $sottotitolo = $row['sottotitolo'];
    $path_copertina = $row['path_copertina'];
    $path_cartella = $row['path_cartella'];
  }

  /*  salvo in sessione i dati estrapolati */
  $_SESSION['nome_album'] = $nome_album;
  $_SESSION['sottotitolo'] = $sottotitolo;
  $_SESSION['path_copertina'] = $path_copertina;
  $_SESSION['$path_cartella'] = $path_cartella;
  /*    ESTRAPOLO I VALORI DAL CLIENTE */
  $select_cliente = $conn->prepare("SELECT * FROM 1clienti WHERE id_cliente= :id_cliente ;");
  $select_cliente->bindParam(':id_cliente', $id_cliente);
  $select_cliente->execute();

  while ($row = $select_cliente->fetch(PDO::FETCH_ASSOC)) {
    $selezione_confermata = $row['conferma_preferiti'];
  }



  ?>

  <!-- MENU -->



  <main id='main'>



    <div class="card text-center">
      <div class="card-header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary ">
          <div class="container-fluid">
            <img class="navbar-brand " src="../../../img/logo_w.png" width="150" height="auto">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
<ul class=" navbar-nav me-auto mb-2 mb-lg-0 ">
              <li>
                <a class="dropdown-item d-flex align-items-center text-primary" href="../../../log_out_clienti.php">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Log Out</span>
                </a>
              </li>
              </ul>
              <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
          </div>
        </nav>
      </div>
      <div class="card-body">
        <h5 class="card-title"><b>Seleziona ed ordina le tue foto</b></h5>
        <div class="row">
          <div class="col-4 " style="background:azure ; border: 1px solid gray">
          <img src="../../../img/clickCartella.png" height="50px" width="auto" style="padding-top: 5px;"><p class="card-text"><b>Seleziona la cartella corrispondente alla tua categoria.</b></p>
          </div>
          <div class="col-4" style="background:azure ; border: 1px solid gray">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
</svg><img src="../../../img/clickMano.png" height="50px" width="auto" style="padding-top: 5px;"><p class="card-text"><b>clicca sul cuoricino per selezionare le foto che ti piaciono.</b></p>
          </div>
          <div class="col-4" style="background:azure ; border: 1px solid gray">
          <img src="../../../img/clickSelezione.png" height="50px" width="auto" style="padding-top: 5px;"><p class="card-text"><b>Clicca sul pulsante in basso "Guarda la selezione" per ricontrollare le foto scelte.</b></p>
          </div>
        </div>
      

      </div>
      <div class="card-footer text-body-secondary">
   
      </div>
    </div>


    <!-- ======= Portfolio Section ======= -->
    <div class="container">
      <div class="card mt-2">
        <div class="card-header text-center">
          <h5>Inizia Subito</h5>
        </div>
        <div class="card-body">

          <?php require_once '../../../views/client.php';

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['folder'])) {
              $cartella = $_POST['folder'];
            }
          } else {
            $cartella = null;
          }   ?>
        </div>
      </div>
    </div>
    <section id='portfolio' class='portfolio'>
      <div class='container'>

        <div class='section-title'>
          <h2><?php echo $nome_album ?></h2>
          <p><?php echo $cartella ?></p>
        </div>

        <div class='row'>
          <div class='col-lg-12 d-flex justify-content-center'>
            <?php

            /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
            $select_preferiti = $conn->prepare("SELECT id_foto FROM 1preferiti WHERE (id_cliente= :id_cliente AND id_album= :id_album )");
            $select_preferiti->bindparam(':id_cliente', $id_cliente);
            $select_preferiti->bindparam(':id_album', $id_album);
            $select_preferiti->execute();

            /*       e li metto all'interno di un array */
            $preferiti_cliente = array();
            while ($row = $select_preferiti->fetch(PDO::FETCH_ASSOC)) {
              $preferiti_cliente[] = $row['id_foto'];
            }

            /*     poi seleziono tutte le sottocartelle dell'album e le metto in un array */

            ?>

          </div>
        </div>

        <div class='row'>

          <?php
          /* ciclo l'array delle cartelle e per ognuna
   prendendo una cartella alla volta selezione tutte le foto presenti */


          $select = $conn->prepare("SELECT * FROM $db.$id_album WHERE `sotto_cartella`= :valore ; ");
          $select->bindParam(':valore', $cartella);
          $select->execute();

          while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            if (controlla_opzioni($id_album, 'w') == false) {
              $immagine = $row['path_medium'];
            } else {
              $immagine = $row['path_watermark'];
            }
            echo "  <div class='col-lg-4 col-md-6 p-2'>
   
   <div class='portfolio-wrap'>
    <img src='$immagine' class='img-fluid' alt=''>
     <div class='portfolio-info'>
       <h4>{$row['nome_foto']}</h4>
       <div class='portfolio-links'>
         <a href='$immagine' class='portfolio-lightbox'title='<b>{$row['nome_foto']}</b>'>
         <button type='button' class='btn btn-success btn-lg'><i  class='bx bx-zoom-in'></i></button></a>";

            /*   inserisco il bottone del cuore verde già selezionato, in caso di onclick va a cambiare lo stato selezionato si/no */
            /*  se le selezione è confermata non metto il pulsante del cuore */
            if (controlla_opzioni($id_album, 's') == false || $selezione_confermata == 1) {
              /*non fa nulla, altrimenti appare il pulsante cuore */
            } else {
              /*   controllo se è selezionato o no il cuoricino */
              if (in_array($row['id_foto'], $preferiti_cliente)) {
                echo " &nbsp &nbsp  <button onclick='seleziona({$row['id_album']}{$row['id_foto']})' name='foto'
             value='$id_cliente,{$row['id_album']},{$row['id_foto']}' id='{$row['id_album']}{$row['id_foto']}'
             type='button' class='btn btn-success btn-lg'><i  class='bx bx-heart '></i></button> ";
              } else {
                echo "  &nbsp &nbsp  <button onclick='seleziona({$row['id_album']}{$row['id_foto']})' name='foto'
              value='$id_cliente,{$row['id_album']},{$row['id_foto']}' id='{$row['id_album']}{$row['id_foto']}'
              type='button' class='btn btn-secondary btn-lg'><i  class='bx bx-heart '></i></button>";
              }
            }
            if (controlla_opzioni($id_album, 'c') == false) {
              /*non fa nulla, altrimenti appare il pulsante carrello */
            } else {
              echo "   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bx bx-cart '></i></button> ";
            }

            if (controlla_opzioni($id_album, 'm') == false) {
              /*non fa nulla, altrimenti appare il pulsante messaggi */
            } else {
              echo "   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bi bi-chat-left-text-fill '></i></button> ";
            }

            if (controlla_opzioni($id_album, 'd') == false) {
              /*non fa nulla, altrimenti appare il pulsante download */
            } else {
              echo "   &nbsp   <a href=' {$row['path']} 'download='file'>
               <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bi bi-cloud-arrow-down-fill '></i></button></a> ";
            }


            echo "  </div>
     </div>
   </div>
   </div>";
          }


          $conn = null;

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
    function seleziona(val) {
      var valore = $('#' + val).val();
      $.ajax({
        type: "post",
        url: "../../../function/seleziona.php",
        data: "foto=" + valore,
        success: function(response) {
          var prova = response;
          console.log(prova);

          var bottone = document.getElementById(val);
          if (prova == 0) {
            bottone.style.backgroundColor = 'green';
            bottone.style.color = 'white';

          } else {
            bottone.style.backgroundColor = 'gray';
            bottone.style.color = 'white';

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
  <script src='../../../assets2/vendor/isotope-layout/isotope.pkgd.min.js'></script> <!-- script utile confermato -->
  <script src='../../../assets2/vendor/swiper/swiper-bundle.min.js'></script> <!-- script utile confermato -->


  <!-- Template Main JS File -->
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
  <script src='../../../assets2/js/main.js'></script>
</body>

</html>