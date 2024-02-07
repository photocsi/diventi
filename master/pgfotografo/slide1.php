<?php
$id_album=165                                              ;








session_start();
$cartella_scelta = $_SESSION['cartella_scelta'];
$id_cliente = $_SESSION['id_cliente'];
if ($id_cliente == "NULL") {
  $id_cliente = $_COOKIE['id_operatore'];
}



header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>


<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slide1</title>
</head>

<body>

  <?php
  include('../../../function/funzioni_album.php');
  include('../../../config_pdo.php');
  $seleziona_messagio = $conn->prepare("SELECT note  FROM `1album` WHERE (id_album= :id_album) ;");
  $seleziona_messagio->bindparam(":id_album",  $id_album);
  $seleziona_messagio->execute();
  $messaggio = $seleziona_messagio->fetch(PDO::FETCH_ASSOC);
 

if(isset($cartella_scelta)){
  foreach ($cartella_scelta as $cartella) {
    $seleziona_foto = $conn->prepare("SELECT *  FROM `$id_album` WHERE (sotto_cartella= :cartella_scelta) ORDER BY data ASC;");
    $seleziona_foto->bindparam(":cartella_scelta",  $cartella);
    $seleziona_foto->execute();

    while ($row = $seleziona_foto->fetch(PDO::FETCH_ASSOC)) {
      if (file_exists("../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}")) {
        $row['path_medium'] = "../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
      }
      $listafile["path"][] = $row['path_medium'];
      $listafile["nome"][] = filter_var($row['nome_foto'], FILTER_SANITIZE_NUMBER_INT);
      $listafile["sotto_cartella"][] = $row['sotto_cartella'];
    }
  }
}
  



  $selezione = prendi_preferiti($id_album, $id_cliente);
  /* aggiungo all'array anche le foto delle selezioni */
 
  while ($row = $selezione->fetch(PDO::FETCH_ASSOC)) {
    if (file_exists("../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}")) {
      $row['path_medium'] = "../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
    }
    $listafile["path"][] = $row['path_medium'];
    $listafile["nome"][] = filter_var($row['nome_foto'], FILTER_SANITIZE_NUMBER_INT);
    $listafile["sotto_cartella"][] = $row['sotto_cartella'];
  }


  ?>


  <script>
    var listafile = <?php echo json_encode($listafile) ?>

    console.log(listafile);
    var i = 0;
    var time = 3000;



    function changeImg() {

      document.slide.src = listafile["path"][i]; /* faccio apparire l'immagine */

      var paragrafo = document.createElement("testo"); /* aggiungo l'elemento del nome immagine */
      var testo = document.createTextNode(listafile["sotto_cartella"][i] + ' > ' + listafile["nome"][i] + ' < ');

      paragrafo.appendChild(testo);
      document.getElementById("testo").appendChild(paragrafo); /* fine aggiunta nome immagine */

      setTimeout("rem()", time);
      console.log(listafile["nome"][i]);

      if (i < listafile["path"].length - 1) {
        i++
      } else {
        i = 0;
      }
      setTimeout("changeImg()", time);



    }

    function rem() {
      const list = document.getElementById("testo");
      list.removeChild(list.firstElementChild);

    }

    window.onload = changeImg;
  </script>



  <div class="container-fluid" style="text-align: center;">

    <div class="item active">
      <b>
        <div id="testo" style="font-size : 250%;  color:black; font-family: Tahoma ; "> </div>
      </b>
      <hr>

      <div class="container-fluid">
        <div id="prova" class="row " style="width: auto ; height: 600px">
          <img name="slide" style="width: 100% ; height: 100%; object-fit: contain;  border: 4px black solid ; " alt="..." data-gallery="portfolioGallery" title="Card 1"><i class="bx bx-plus">
        </div>
        <hr>
        <marquee style="font-family: Arial, Helvetica, sans-serif; font-size: 50px ; color:blue ; margin-top: 0px !important" loop="-1" scrollamount="1" scrolldelay="50" direction="left" height="200" width="800" text-align="right">
          <h5 style="margin-top: 0px"><?php str_replace('_',' ',$messaggio['note']) ?> </h5>
        </marquee>
      </div>


    </div>
  </div>

  <script>
    var altezza = window.screen.availHeight;
    console.log(altezza);

    var divReference = document.getElementById("prova");
    divReference.style.height = altezza - 160 + 'px';
  </script>

</body>

</html>