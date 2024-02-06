<?php
$id_album=23                                    ;





header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

session_start();

if (!isset($_SESSION['user_fotografo'])) {
  header('Location: ../index.php');
}
$id_operatore = $_COOKIE['id_operatore'];
(isset($_SESSION['lista_file'])) ? $select_in_slide= $_SESSION['lista_file'] : null ;

?>


<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../../../function/funzioni_js.js"></script>

  <!--  SCRIPT JAVASCRIPT -->

  <script language="javascript" type="text/javascript">
    function ApriImmagini(file) {
      newin = window.open(file, 'foto', 'scrollbars=no,resizable=no, top=20, left=20, width=1800,height=1000,status=no,location=no,toolbar=no,menubar=no');
    }
  </script>
  <script>
    function apri(url, fin) {
      window.open(url, fin, 'alwaysRaised=yes,scrollbars=no,status=no,resizabl e=no,top=100,left=150,width=630,height=620');
      return false;
    }
  </script>


  <title>Visualizza</title>
</head>

<body>


  <?php
  include('header_side_light.php');
  require_once '../../../includes/db_pdo-class.php';
  $db_class = new DB_CSI();

  /*  mi prendo le info che servono dell'album */
  $select = $conn->prepare("SELECT * FROM 1album WHERE id_album= :id_album ");
  $select->bindparam(":id_album", $id_album);
  $select->execute();


  while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
    $nome_album = $row['nome'];
    $id_fotografo = $row['id_fotografo'];
  }

  $conn = null;


  ?>

  <main id="main" class="main" style="background-color: #bee5fc ">
    <section class="section">
      <div class="row">
        <div class="col-lg-12"> <!-- //larghezza form -->

          <!-- inizio tab menu sopra il form -->
          <div class="card">
            <div class="card-body">


              <div class="container-flex text-center "> <!-- Sezione pulsanti di ricerca foto -->


                <!--  -------------------------------------------------------------------------------------------  -->


                <!--     INIZIO SPAZIO DIV DOVE VISUALIZZO LE FOTO -->
                <div class="row" style=" overflow: auto; max-width: 100%; padding-top: 8px;">



                  <!-- VISUALIZZO LE FOTO DELLE CARTELLE SCELTE -->
                  <?php

                  /*         Se premo invia nella scelta delle cartelle da visualizzare */

                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['mostra']) && isset($_POST['cartella_scelta'])) {
                      include('../../../config_pdo.php');


                      $button = new WORK_CSI($id_album, $id_operatore, $conn);
                      $preferiti_cliente = $button->prendi_preferiti();


                      $cartella_scelta = $_POST['cartella_scelta'];
                      foreach ($cartella_scelta as $value) {
                        $select = $conn->prepare("SELECT *  FROM `$id_album` WHERE (sotto_cartella= :cartella_scelta) ORDER BY data ASC;");
                        $select->bindparam(":cartella_scelta",  $value);
                        $select->execute();
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                          include('../../../component/component_work/show_folder_img.php');
                        }
                      }

                      $conn = null;
                    }
                    unset($_POST['mostra']);
                  }

                  ?> <!-- FINE SELEZIONE PER CARTELLE -->



                  <!-- PRENDO DAL DB TUTTE LE FOTO SELEZIONATE  -->
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['selezione'])) {
                      $result = mostra_selezionate($id_album, $id_operatore);
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                        include('../../../component/component_work/show_select_img.php');
                      }
                    }
                    unset($_POST['selezione']);
                  }
                  ?>

                  <!-- ELIMINO LA SELEZIONE DA TUTTE LE FOTO -->
                  <?php
                  if (isset($_POST['reset'])) {
                    include('../../../config_pdo.php');
                    $unselect = $conn->prepare("DELETE FROM 1preferiti WHERE id_cliente= :id_operatore;");
                    $unselect->bindParam(':id_operatore', $id_operatore);
                    $unselect->execute();
                    $conn = null;
                  }
                  ?> <!-- FINE MOSTRA E ELIMINA SELEZIONE -->


                  <!-- CODICE PHP PER LA RICERCA TRAMITE NOME ------------------------------------->
                  <?php
                  if (isset($_POST['selezione_nome']) && isset($_POST['nome_foto']) && $_POST['nome_foto'] != '') {
                    $result = mostra_selezionate($id_album, $id_operatore);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                      $selezionate[] = $row['id_foto'];
                    }
                    $arr_ricerca = explode(",", $_POST['nome_foto']);


                    for ($i = 0; $i < count($arr_ricerca); $i++) {
                      include('../../../config_pdo.php');
                      $campo = '%' . $arr_ricerca[$i] . '%';
                      $select_ricerca = $conn->prepare("SELECT * FROM $db.$id_album WHERE nome_foto LIKE :campo ;");
                      $select_ricerca->bindParam(':campo', $campo);
                      $select_ricerca->execute();
                      $conn = null;
                      while ($row = $select_ricerca->fetch(PDO::FETCH_ASSOC)) {

                        include('../../../component/component_work/show_search_img.php');
                      }
                    }
                  }  /* FINE SELEZIONE TRAMITE NOME */

                  /*  CODICE PER LA RICERCA TRAMITE CARTELLA */

                  if (isset($_POST['prendi_cartella'])) {
                    include('../../../config_pdo.php');
                    $result = mostra_selezionate($id_album, $id_operatore);
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                      $selezionate[] = $row['id_foto'];
                    }
                    $nome_cartella = '%' . $_POST['nome_cartella'] . '%';

                    $select_cartella = $conn->prepare("SELECT * FROM $db.$id_album WHERE sotto_cartella  LIKE :nome_cartella  OR tag LIKE :nome_cartella;");
                    $select_cartella->bindParam(':nome_cartella', $nome_cartella);
                    $select_cartella->bindParam(':nome_cartella', $nome_cartella);
                    $select_cartella->execute();
                    while ($row = $select_cartella->fetch(PDO::FETCH_ASSOC)) {

                      include('../../../component/component_work/show_search_img.php');
                    }
                    $conn = null;
                  }

                  ?> <!-- FINE RICERCA TRAMITE CARTELLA -->



                  <!-- SALVO LA SELEZIONE E GLI DO UN NOME -->
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['salva_selezione']) && $_POST['nome_selezione'] != '') {
                      include('../../../config_pdo.php');
                      $boolean_conferma = 1;

                      $nome_cliente = $_POST['nome_selezione'];

                      $insert_cliente = $conn->prepare("INSERT INTO 1clienti (id_album, id_fotografo, nome_cliente, conferma_preferiti)
      VALUES (:id_album , :id_fotografo , :nome_cliente , :conferma_preferiti) ");

                      $insert_cliente->bindParam(":id_album", $id_album);
                      $insert_cliente->bindParam(":id_fotografo", $id_fotografo);
                      $insert_cliente->bindParam(":nome_cliente", $nome_cliente);
                      $insert_cliente->bindParam(":conferma_preferiti",  $boolean_conferma);
                      $insert_cliente->execute();

                      $field = ['id_cliente'];
                      $where = ['id_cliente', 'ruolo'];
                      $value = [$id_operatore, 'operatore'];

                      $id_operatore = $db_class->select_2where($field, '1clienti', $where, $value);
                      $id_operatore = $id_operatore[0]['id_cliente'];


                      $select_cliente = $conn->prepare("SELECT id_cliente FROM 1clienti ORDER BY id_cliente DESC LIMIT 1;");
                      $select_cliente->execute();


                      while ($row = $select_cliente->fetch(PDO::FETCH_ASSOC)) {
                        $id_cliente_nuovo = $row['id_cliente'];
                      }

                      /*     aggiungo l'id del nuovo cliente nella lista clienti della tabella album */
                      aggiungi_lista_cliente("clienti_registrati", $id_album, $id_cliente_nuovo, '../../../config_pdo.php');
                      /*  qua vado a sostituire l'id del fotografo nei preferiti (dove gia sono presenti le foto) con l'id del nuovo cliente appena creato (che poi sarebbe la nuova cartella) */
                      $update_preferiti = $conn->prepare("UPDATE 1preferiti SET id_cliente = $id_cliente_nuovo WHERE id_cliente = $id_operatore");


                      $update_preferiti->execute();
                    }
                  }
                  ?> <!-- FINE SALVA SELEZIONE -->


                  <!--  INIZIO SCELTA SELEZIONE CLIENTI E CANCELLA CLIENTI -->

                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['mostra_cliente']) && $_POST['scelta_cliente'] != 'NULL') {
                      $array = explode(",", $_POST['scelta_cliente']);
                      $nome_cliente = $array[0];
                      $id_cliente = $array[1];

                      $selezione = prendi_preferiti($id_album, $id_cliente);

                      while ($row = $selezione->fetch(PDO::FETCH_ASSOC)) {

                        include('../../../component/component_work/show_search_img.php');
                      }
                    }
                    unset($_POST['selezione_cliente']);
                  }

                  ?>

                  <!-- INIZIO CANCELLA SELEZIONE CLIENTE -->
                  <?php
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['cliente_servito']) && $_POST['scelta_cliente'] != 'NULL') {
                      $array = explode(",", $_POST['scelta_cliente']);
                      $nome_cliente = $array[0];
                      $id_cliente = $array[1];
                      include('../../../config_pdo.php');
                      $delete_selezione_cliente = $conn->prepare("UPDATE 1clienti SET conferma_preferiti = NULL WHERE id_cliente = $id_cliente;");
                      $delete_selezione_cliente->execute();
                      $delete_preferiti = $conn->prepare("DELETE FROM 1preferiti WHERE id_cliente = $id_cliente;");
                      $delete_preferiti->execute();
                      $delete_cliente = $conn->prepare("DELETE FROM 1clienti WHERE id_cliente = $id_cliente;");
                      $delete_cliente->execute();

                      unset($_POST['scelta_cliente']);
                    }
                    $conn = null;
                  }

                  ?> <!-- FINE CANCELLA SELEZIONE CLIENTI -->




                  <!--  INIZIO CAMBIO NOME CARTELLA -->
                  <?php
                  if (isset($_POST['cartella_rename']) && $_POST['cartella_rename'] != 'NULL' && isset($_POST['cartella_newname']) && $_POST['cartella_newname'] != '') {
                    require('../../../config_pdo.php');
                    $preferiti_cliente = array();
                    /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
                    $select_preferiti = $conn->prepare("SELECT id_foto FROM 1preferiti WHERE (id_cliente= :id_cliente AND id_album= :id_album )");
                    $select_preferiti->bindparam(":id_cliente", $id_operatore);
                    $select_preferiti->bindparam(":id_album", $id_album);
                    $select_preferiti->execute();

                    /*       e li metto all'interno di un array */
                    while ($row = $select_preferiti->fetch(PDO::FETCH_ASSOC)) {
                      $preferiti_cliente[] = $row['id_foto'];
                    }



                    /*    SELEZIONO TUTTI I RECORD CON IL NOME DELLA SOTTOCARTELLA DA RINOMINARE */
                    $cartella_rename = $_POST['cartella_rename'];
                    $cartella_newname = $_POST['cartella_newname'];
                    $select_rename = $conn->prepare("SELECT *  FROM `$id_album` WHERE sotto_cartella= :cartella_rename  ORDER BY data ASC;");
                    $select_rename->bindparam(':cartella_rename',  $cartella_rename);

                    $select_rename->execute();

                    /* VADO A RINOMINARE IL NOME DELLA SOTTOCARTELLA + TUTTI I PATH */
                    while ($row = $select_rename->fetch(PDO::FETCH_ASSOC)) {

                      $path = str_replace($cartella_rename, $cartella_newname, $row['path']);
                      $path_medium = str_replace($cartella_rename, $cartella_newname, $row['path_medium']);
                      $path_watermark = str_replace($cartella_rename, $cartella_newname, $row['path_watermark']);
                      $id_foto = $row['id_foto'];


                      $rename = $conn->prepare("UPDATE diventi.$id_album SET sotto_cartella = :cartella_newname , path= :path_foto , path_medium= :path_medium ,
                                                           path_watermark= :path_watermark WHERE id_foto = :id_foto ");
                      $rename->bindparam(":cartella_newname",  $cartella_newname);
                      $rename->bindparam(":path_foto",  $path);
                      $rename->bindparam(":path_medium",  $path_medium);
                      $rename->bindparam(":path_watermark",  $path_watermark);
                      $rename->bindparam(":id_foto",  $id_foto);
                      $rename->execute();
                    }


                    $conn = null;

                    rename('../sottocartelle/' . $cartella_rename, '../sottocartelle/' . $cartella_newname);

                    unset($_POST['cartella_rename']);
                    unset($_POST['cartella_newname']);
                  }

                  /*    INIZIO CREA NUOVA CARTELLA */

                /*   if (isset($_POST['create_folder']) && $_POST['create_folder'] != 'NULL') {
                    $new_folder = $_POST['create_folder'];
                    mkdir("../sottocartelle/$new_folder/large/", 0777, TRUE);
                    mkdir("../sottocartelle/$new_folder/medium/", 0777, TRUE);
                   
                    mkdir("../sottocartelle/$new_folder/watermark/", 0777, TRUE);
                  } */
                  /*  FINE CREA NUOVA CARTELLA */

                  /*   INIZIO SPOSTA FOTO */

                  if (isset($_POST['move_photo']) && $_POST['move_photo'] != 'NULL') {
                    $move_photo = $_POST['move_photo'];
                    if (!file_exists("../sottocartelle/$move_photo/large/")) {
                      mkdir("../sottocartelle/$move_photo/large/modificate/", 0777, TRUE);
                      mkdir("../sottocartelle/$move_photo/medium/", 0777, TRUE);
                      mkdir("../sottocartelle/$move_photo/watermark/", 0777, TRUE);
                    }
                    $select = $db_class->take_select($id_operatore, $id_album);
                    for ($i = 0; $i < count($select); $i++) {
                      $new_path = str_replace($select[$i]['sotto_cartella'], $move_photo, $select[$i]['path']);
                      copy($select[$i]['path'], $new_path);
                      if ($select[$i]['path'] != $new_path) {
                        unlink($select[$i]['path']);
                        $db_class->update($id_album, 'path', $new_path, 'id_foto', $select[$i]['id_foto']);
                      }


                      $new_path = str_replace($select[$i]['sotto_cartella'], $move_photo, $select[$i]['path_medium']);
                      copy($select[$i]['path_medium'], $new_path);
                      if ($select[$i]['path_medium'] != $new_path) {
                        unlink($select[$i]['path_medium']);
                        $db_class->update($id_album, 'path_medium', $new_path, 'id_foto', $select[$i]['id_foto']);
                      }

              
                       $new_path = str_replace($select[$i]['sotto_cartella'], $move_photo, $select[$i]['path_watermark']);
                      copy($select[$i]['path_watermark'], $new_path);
                      if ($select[$i]['path_watermark'] != $new_path) {
                        unlink($select[$i]['path_watermark']);
                        $db_class->update($id_album, 'path_watermark', $new_path, 'id_foto', $select[$i]['id_foto']);
                      } 

                      $db_class->update($id_album, 'sotto_cartella', $move_photo, 'id_foto', $select[$i]['id_foto']);
                    }
                  }

                  /*     FINE SPOSTA FOTO */

                  ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

    <?php include('../../../component/sezione_controllo.php'); ?>

    </div>
    </div>
  <!--   tasti rapidi per la dimensione delle immagini -->
    <script type="text/javascript">
      document.addEventListener('keydown', function(event) {
        if (event.code == 'Digit1' && (event.ctrlKey || event.shiftKey)) {
          var card = (document.getElementsByClassName("card"));
          for (i = 0; i < card.length; i++) {
            document.querySelectorAll('#card_foto')[i].style.width = '8rem';
          }
        }

        if(event.code == 'Digit2' && (event.ctrlKey || event.shiftKey)) {
          var card = (document.getElementsByClassName("card"));
          for (i = 0; i < card.length; i++) {
            document.querySelectorAll('#card_foto')[i].style.width = '18rem';
          }
        }

        if(event.code == 'Digit3' && (event.ctrlKey || event.shiftKey)) {
          var card = (document.getElementsByClassName("card"));
          for (i = 0; i < card.length; i++) {
            document.querySelectorAll('#card_foto')[i].style.width = '24rem';
          }
        }

        if(event.code == 'Digit4' && (event.ctrlKey || event.shiftKey)) {
          var card = (document.getElementsByClassName("card"));
          for (i = 0; i < card.length; i++) {
            document.querySelectorAll('#card_foto')[i].style.width = '32rem';
          }
        }

        if(event.code == 'Digit5' && (event.ctrlKey || event.shiftKey)) {
          var card = (document.getElementsByClassName("card"));
          for (i = 0; i < card.length; i++) {
            document.querySelectorAll('#card_foto')[i].style.width = '40rem';
          }
        }


      });

      

     
    </script>
    <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
    <script src="../../../function/funzioni_js.js"></script>
</body>

</html>