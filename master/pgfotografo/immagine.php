<?php
$id_album=180                                      ;
?>







<?php
header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>

<!doctype html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="../../../node_modules/cropperjs/dist/cropper.css">
  <link rel="stylesheet" href="../../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../script/jcrop/dist/jcrop.css" />
  <link rel="stylesheet" href="../../../script/jcrop/examples/style.css" />
  <link rel="stylesheet" href="../../../css/style.css" />



</head>

<body>
  <!-- Disabilito la cache della pagina -->

  <script>
    function sleep(milliseconds) {
      var start = new Date().getTime();
      for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
          break;
        }
      }
    }
  </script>



  <!-- creo il path immagine utile per i filtri, la path parte dalla pagine dei filtri e non da questa pagina -->
  <?php
  include('../../../function/modale_foto.php');
  include('../../../function/funzioni_album.php');
  /* prendo i valori e li separo in un array */
  $array = explode(",", $_GET['id']);
  $nome_foto = $array[0];
  $sotto_cartella = $array[1];
  $id_foto=$array[2];
  $path_immagine = "../sottocartelle/$sotto_cartella/large/$nome_foto";
  $path_immagine_large_modificata = "../sottocartelle/$sotto_cartella/large/modificate/$nome_foto";
  $path_immagine_modificata_save = "../album/$id_album/sottocartelle/$sotto_cartella/large/modificate/";
  $path_immagine_medium = "../sottocartelle/$sotto_cartella/medium/$nome_foto";
  $path_modifiche = "../../album/$id_album/sottocartelle/$sotto_cartella/medium/$nome_foto"; /* path che parte dala pagina dentro la cartella filtri */

  ?> <!-- definisco il path dell'immagine -->



  <div class="container-flex" style="padding: 1% ;">
    <div class="row">
      <div class="col-9 ">

        <?php 
        include('../../../component/component_immagine/img.php');
        include('../../../component/component_immagine/btn_primary.php');
         ?>

      </div>

      <!-- INIZIO SEZIONE LATERALE FISARMONICA -->
      <div class="col-3 ">

        <!-- Default Accordion -->
        <div class="accordion" id="accordionExample">


          <?php 
          include('../../../component/component_immagine/ritocco_immagine.php');
          include('../../../component/component_immagine/ritaglio_immagine.php');
          include('../../../component/component_immagine/loghi.php');
          ?>


        </div><!-- FINE SEZIONE GRAFICHE -->

      </div> <!-- fine sezione laterale fisarmonica -->

      </div>
    </div> <!-- FINE PAGINA TOTALE -->


    

   <!--  CODICE PER IL CARICAMENTO DEL LOGO -->
    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_FILES['logo_grafica'])) {
        $immagine = $_FILES['logo_grafica']['tmp_name'];
        $nome_immagine = $_FILES['logo_grafica']['name'];
        $type_img = $_FILES['logo_grafica']['type'];

        riduci_salva_logo_grafica($immagine, 50, "../../../fotografi/1/loghi_grafiche/$nome_immagine", 7, $type_img);
      }
    }

    ?>   <!-- FINE CARICAMENTO LOGO -->

   

    <!-- la funzione prende in ingresso l'id del bottone da dove prendere il value, l'id del div dove inserirlo e terzo parametro se è il testo o il logo -->
    <script>
      addEventListener("load", myFunction);

      function myFunction() {
        console.log(localStorage.getItem("testo"));
        document.getElementById("textGrafica").innerHTML = localStorage.getItem("testo");

        document.getElementById("logosx").src = localStorage.getItem("logosx");

        document.getElementById("logodx").src = localStorage.getItem("logodx");

        document.getElementById("center").src = localStorage.getItem("center_color");

        document.getElementById("textGrafica").style.fontSize = localStorage.getItem("text_size");

        document.getElementById("textGrafica").style.color = localStorage.getItem("text_color");


      }
    </script>

    <script src="../../../script/jcrop/dist/jcrop.js"></script>
    <script src="../../../script/jcrop/dist/jcrop.dev.js"></script>
    <script src="../../../script/jcrop/dist/jcrop.dev.js.map"></script>

    <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="../../../script/CamanJS-4.1.1/dist/caman.full.min.js"></script>
    <script type="text/javascript" src="../../../function/funzioni_js.js"></script>
    <script src="../../../node_modules/cropperjs/dist/cropper.js"></script>
    <script src="../../../function/index.js"></script>
    <script src="../../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>


</body>

</html>