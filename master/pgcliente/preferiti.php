
<?php
$id_album=3444       ;
$nome_album=''   ;
$sottotitolo=''    ;
$id_fotografo=3444   ;
$path_copertina=""                                                                                                               ;




/* inizio codice copiato */

session_start();

$id_cliente = $_SESSION['id_cliente'];
$nome_cliente = $_SESSION['nome_cliente'];

if (!isset($_SESSION['email_cliente'])) {
  header('Location: ../../register_clienti.php');
}

/*   controllo sessioni decommenta per controllare */
/*  print_r( $_SESSION);  */
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

  <!-- LINK CHE SERVONO PER LE FUNZIONI DI SELEZIONE CARRELLO ECC. -->
</head>

<body>

  <!--   PHP CODE --------------------->
  <!-- PHP CODE PER ESTRAPOLARE TUTTI I VALORI CHE SERVONO DALL'ALBUM -->
  <?php
  /*    ESTRAPOLO I VALORI DAL CLIENTE */
  include('../../../config_pdo.php');
  include('../../../function/funzioni_album.php');

  $select = $conn->prepare("SELECT * FROM 1clienti WHERE id_cliente= :id_cliente ;");
  $select->bindparam(':id_cliente', $id_cliente);
  $select->execute();

  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $selezione_confermata = $row['conferma_preferiti'];
  }

  /*  contare il numero dei preferiti */
  $numero_preferiti = numero_preferiti($id_album, $id_cliente);
  $_SESSION['numero_preferiti'] = $numero_preferiti;

  ?>

  <!-- MENU -->

  <div class="card text-center">
    <div class="card-header ">
      <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
          <img class="navbar-brand " src="../../../img/logo_w.png" width="150" height="auto">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
              <li class="nav-item">
                <a class="nav-link text-primary" href="index.php">Album</a>
              </li>
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
      <h5 class="card-title">Ricontrolla la tua scelta e conferma</h5>
      <p class="card-text"><b>Appena confermata la scelta puoi recanti al Photo Point per ritirare le tue stampe</b></p>

    </div>
    <div class="card-footer text-body-secondary">
      2 days ago
    </div>
  </div>
  <main id='main'>
    <!-- ======= SEZIONE FOTO ======= -->

    <section id='portfolio' class='portfolio'>
      <div class='container' data-aos='fade-up'>

        <div class='section-title'>
          <h2>Selezione</h2>
        </div>
        <div class='row portfolio-container' data-aos='fade-up' data-aos-delay='200'>
          <!-- prendo i prefriti di quel cliente in quell'album -->
          <?php
          include('../../../config_pdo.php');

          $select = $conn->prepare("SELECT * FROM $db.$id_album
              INNER JOIN 1preferiti ON $db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente;");
          $select->bindparam(':id_cliente', $id_cliente);
          $select->execute();

          while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            if (controlla_opzioni($id_album, 'w') == false) {
              $immagine = $row['path_medium'];
            } else {
              $immagine = $row['path_watermark'];
            }
            echo " <div class='col-lg-4 col-md-6 portfolio-item filter-8'>
    
    <div class='portfolio-wrap'>
     <img src='$immagine' class='img-fluid' alt=''>
      <div class='portfolio-info'>
        <h4>{$row['nome_foto']}</h4>
        <div class='portfolio-links'>
          <a href='$immagine' data-gallery='$immagine' class='portfolio-lightbox'title='<b>{$row['nome_foto']}</b> '>
          <button type='button' class='btn btn-success btn-lg'><i  class='bx bx-zoom-in'></i></button></a>";

            /*   inserisco il bottone del cuore verde già selezionato, in caso di onclick va a cambiare lo stato selezionato si/no */
            /*  se le selezione è confermata non metto il pulsante del cuore */
            if (controlla_opzioni($id_album, 's') == false || $selezione_confermata == 1) {
              /* altrimenti appare il pulsante cuore */
            } else {
              echo " &nbsp &nbsp  <button onclick='seleziona({$row['id_album']}{$row['id_foto']})' name='foto'
          value='$id_cliente,{$row['id_album']},{$row['id_foto']}' id='{$row['id_album']}{$row['id_foto']}'
          type='button' class='btn btn-success btn-lg'><i  class='bx bx-heart '></i></button> ";
            }
            if (controlla_opzioni($id_album, 'c') == false) {
              /*non fa nulla, altrimenti appare il pulsante cuore */
            } else {

              echo "   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bx bx-cart '></i></button> ";
            }
            if (controlla_opzioni($id_album, 'c') == false) {
              /*non fa nulla, altrimenti appare il pulsante cuore */
            } else {

              echo "   &nbsp <button type='button' class='btn btn-secondary btn-lg me-md-2'><i class='bi bi-chat-left-text-fill '></i></button> ";
            }

            echo " </div>
      </div>
    </div>
    </div>";
          }


          $conn = null;



          /*     se la selezione è da confermare esce il PULSANTE
     altrimenti esce una scrtta selezione già confermata */

          if (isset($selezione_confermata) && $selezione_confermata == 1) { ?>
    </section> <!-- End SEZIONE FOTO -->
    <div class='container fixed-bottom'>
      <div class='card-body'>
        <button type='button' class='btn btn-primary mb-2'>
          Selezione Confermata </button>
      </div>
    </div>
  <?php } else {
  ?>

    </section> <!-- End SEZIONE FOTO -->
    <div class='container fixed-bottom'>

      <div class='card-body '>
        <form action='preferiti_confermati.php' method='POST'>
          <button type='submit' class='btn btn-primary mb-2'>
            Conferma le <span class='badge bg-white text-primary'><?php echo $numero_preferiti ?></span> foto selezionate
          </button>
        </form>
      </div>
    </div>

  <?php } ?>


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
  <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
  <script src='../../../assets2/js/main.js'></script>
</body>

</html>