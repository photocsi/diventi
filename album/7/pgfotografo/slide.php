<?php
    $id_album=7;
    $nome_album='MAX'                                                                                      ;




session_start();

?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Header Side - Modul Photo</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/img/favicon.png" rel="icon">
  <link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../../assets/css/style.css" rel="stylesheet">
  <script src="../../../function/funzioni_js.js"></script>

  <script type='text/javascript'>
    function slide1(url, win) {
        window.open(url, win, 'alwaysRaised=yes,scrollbars=no,status=no,resizabl e=no,top=100,left=150,width=630,height=620');
        return false;
    }
    </script>

</head>

<body>

    <?php  include('../../../function/funzioni_album.php'); ?>

 <!-- END PHP CODE -->
 <main id="main" class="main" style="margin-top: 0; background-color: #bee5fc" >
        <section class="section">
        <div class="row">
            <!--    PRIMO SLIDE -->
        <div class="col-4">
            <div class="card">
              <div class="card-body">
            
                <h4>SLIDE 1</h4>
             <!--   FROM PER LA SCELTA DELLE CARTELLE------------------------------------------------------- -->
             <!--  PRIMA SELEZIONE OPTION -->
                <form class='row g-3' action="#" method="GET">
                <select name="cartella_scelta">
                <?php
                /* il percorso dove cercare le cartelle */
                $path="../sottocartelle/";
                 /*     uso la funzione per scandire le cartelle e inserirle in un array */
               $sotto_cartelle= mostra_cartelle($path);
                /* creo la prima selezione */
               echo"<option selected=\"NULL\" value=\"NULL\">cartella</option>";
               foreach ($sotto_cartelle as $value) {
               echo "<option value=\"$value\"> $value </option>";
              }
              ?>
                </select>
                    <!--  SECONDA SELEZIONE OPTION -->
                     <!-- creo la seconda selezione -->
                    <select name="cartella_scelta2">
                    <option selected="NULL" value="NULL">cartella</option>
                    <?php foreach ($sotto_cartelle as $value) {
                    echo "<option value=\"$value\"> $value </option>";
                  }?>
                </select>
              
                <!-- SELEZIONE PER PRENDERE LE CARTELLE SELEZIONATE DAI CLIENTI -->

                <select id="inputState" class="form-select" name="scelta_cliente" style="float:left; display:block;">
    
                 <?php
                 $clienti=prendi_clienti($id_album);
                 /* creo la prima selezione */
                  echo"<option selected=\"NULL\" value=\"NULL NULL\" >selezione</option>";
                  while($row=$clienti->fetch(PDO::FETCH_ASSOC)) {
                    $row['nome_cliente'] = str_replace(" ", "_", $row['nome_cliente']);
                    echo "<option value=\"{$row['nome_cliente']} {$row['id_cliente']}\"> {$row['nome_cliente']} </option>";
                        
                   }     ?>
                  </select>

               <!--      FINE CASELLE PER LA SELEZIONE -->
                <!--  PULSANTE INPUT DEL FORM -->
                </br> <input type="submit" name="win1" value="prendi"></button>
                <button id="manda1" onclick="slide1('slide1.php','win')" name="manda1">Manda</button></form>
                <!-- fine form di scelta -->

                                <?php
                                if(isset($_GET['win1'])){
                            
                                $_SESSION['cartella_scelta']=$_GET['cartella_scelta'];
                                $_SESSION['cartella_scelta2']=$_GET['cartella_scelta2'];
                                /*  per l'INPUT CARTELLA CLIENTI FACCIO IL PROCEDIMENTO PER ESTRAPOLARE I PREFERITI E METTERLI IN UN ARRAY */
                                       if(isset($_GET['scelta_cliente'])){
                                       $array=explode(" " , $_GET['scelta_cliente']);
                                       $nome_cliente=$array[0];
                                       $id_cliente=$array[1];
                                       $_SESSION['nome_cliente']=$nome_cliente;
                                       $_SESSION['id_cliente']=$id_cliente;
                                  }
        

 include('../../../config_pdo.php');
/*     faccio una query sql per prendere il percorso delle foto e le inserisco in un array */
$seleziona_foto=$conn->prepare("SELECT * FROM `$id_album` WHERE sotto_cartella= '{$_GET['cartella_scelta']}' OR sotto_cartella='{$_GET['cartella_scelta2']}'; ");
$seleziona_foto->execute();

$listafile=array();

while($row=$seleziona_foto->fetch(PDO::FETCH_ASSOC)){
    $listafile[]=$row['path_small'];
    $_SESSION['sotto_cartella']=$row['sotto_cartella'];
    }  

    $conn = null;
                                     } 
        ?>
       <p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta']) && ($_SESSION['cartella_scelta'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta2'])&& ($_SESSION['cartella_scelta2'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta2']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['nome_cliente'])&& ($_SESSION['nome_cliente'] != 'NULL') ){ echo " {$_SESSION['nome_cliente']}" ; } ?> </b> </p>

          </div>
      </div>
 </div>
            

 

            <!--    SECONDO SLIDE -->
            <!-- <div class="row align-items-start" style=" padding: 10px;  background-color: #eee;"> -->
            <div class="col-4">
            <div class="card">
            <div class="card-body">

                <h4>SLIDE 2</h4>
             <!--   FROM PER LA SCELTA DELLE CARTELLE------------------------------------------------------- -->
                   <!--  PRIMA SELEZIONE OPTION -->
               <form class='row g-3' action="#" method="GET">
               <select name="cartella_scelta3">
                <?php

                 /* il percorso dove cercare le cartelle */
                 $path="../sottocartelle/";
                /*     uso la funzione per scandire le cartelle e inserirle in un array */
                 $sotto_cartelle= mostra_cartelle($path);
                 /* creo la prima selezione */
                echo"<option selected=\"NULL\" value=\"NULL\">cartella</option>";
                foreach ($sotto_cartelle as $value) {
               echo "<option value=\"$value\"> $value </option>";
                }
               ?>
                </select>

                    <!--  seconda SELEZIONE OPTION -->
                    <!-- creo la seconda selezione -->
                    <select name="cartella_scelta4">
                    <option selected="NULL" value="NULL">cartella</option>
                    <?php foreach ($sotto_cartelle as $value) {
                    echo "<option value=\"$value\"> $value </option>";
                    }?>
                   </select>

                             <!-- SELEZIONE PER PRENDERE LE CARTELLE SELEZIONATE DAI CLIENTI -->

                            <select id="inputState" class="form-select" name="scelta_cliente2" style="float:left; display:block;">
    
                             <?php
                             $clienti=prendi_clienti($id_album);
                             /* creo la prima selezione */
                             echo"<option selected=\"NULL\" value=\"NULL NULL\">selezione</option>";
                             while($row=$clienti->fetch(PDO::FETCH_ASSOC)) {
                                $row['nome_cliente'] = str_replace(" ", "_", $row['nome_cliente']);
                              echo "<option value=\"{$row['nome_cliente']} {$row['id_cliente']}\"> {$row['nome_cliente']}</option>";
                                        
                            }     ?>
                                </select>

                            <!--            FINE CASELLE PER LA SELEZIONE -->

                             <!--  PULSANTE INPUT DEL FORM -->

                            </br> <input type="submit" name="win2" value="prendi"></button>
                            <button id="manda2" onclick="slide1('slide2.php','win2')" name="manda2">Manda</button></form>
                            <!-- fine form di scelta -->

                                 <?php
                                            if(isset($_GET['win2'])){
          
                                            $_SESSION['cartella_scelta3']=$_GET['cartella_scelta3'];
                                            $_SESSION['cartella_scelta4']=$_GET['cartella_scelta4'];
                                            /*  per l'INPUT CARTELLA CLIENTI FACCIO IL PROCEDIMENTO PER ESTRAPOLARE I PREFERITI E METTERLI IN UN ARRAY */
                                            if(isset($_GET['scelta_cliente2'])){
                                            $array=explode(" " , $_GET['scelta_cliente2']);
                                            $nome_cliente=$array[0];
                                            $id_cliente=$array[1];
                                            $_SESSION['nome_cliente2']=$nome_cliente;
                                            $_SESSION['id_cliente2']=$id_cliente;
                                            }

                                            include('../../../config_pdo.php');
                                            /*     faccio una query sql per prendere il percorso delle foto e le inserisco in un array */
                                            $seleziona_foto=$conn->prepare("SELECT * FROM `$id_album` WHERE sotto_cartella= '{$_GET['cartella_scelta3']}' OR sotto_cartella='{$_GET['cartella_scelta4']}'; ");
                                            $seleziona_foto->execute();
                                            
                                            $listafile=array();
                                            
                                            while($row=$seleziona_foto->fetch(PDO::FETCH_ASSOC)){
                                                $listafile[]=$row['path_small'];
                                                $_SESSION['sotto_cartella2']=$row['sotto_cartella'];
                                                }  
                                            
                                                $conn = null;
                                            }
 ?>

<p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta3']) && ($_SESSION['cartella_scelta3'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta3']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta4'])&& ($_SESSION['cartella_scelta4'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta4']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['nome_cliente2'])&& ($_SESSION['nome_cliente2'] != 'NULL') ){ echo " {$_SESSION['nome_cliente2']}" ; } ?> </b> </p>
       
    </div>
    </div>
    </div>



                <!--    TERZO SLIDE -->
            <!-- <div class="row align-items-start" style=" padding: 10px;  background-color: #eee;"> -->
            <div class="col-4">
            <div class="card">
            <div class="card-body">

                <h4>SLIDE 3</h4>
             <!--   FROM PER LA SCELTA DELLE CARTELLE------------------------------------------------------- -->
                   <!--  PRIMA SELEZIONE OPTION -->
               <form class='row g-3' action="#" method="GET">
               <select name="cartella_scelta5">
                <?php

                 /* il percorso dove cercare le cartelle */
                 $path="../sottocartelle/";
                /*     uso la funzione per scandire le cartelle e inserirle in un array */
                 $sotto_cartelle= mostra_cartelle($path);
                 /* creo la prima selezione */
                echo"<option selected=\"NULL\" value=\"NULL\">cartella</option>";
                foreach ($sotto_cartelle as $value) {
               echo "<option value=\"$value\"> $value </option>";
                }
               ?>
                </select>

                    <!--  seconda SELEZIONE OPTION -->
                    <!-- creo la seconda selezione -->
                    <select name="cartella_scelta6">
                    <option selected="NULL" value="NULL">cartella</option>
                    <?php foreach ($sotto_cartelle as $value) {
                    echo "<option value=\"$value\"> $value </option>";
                    }?>
                   </select>

                             <!-- SELEZIONE PER PRENDERE LE CARTELLE SELEZIONATE DAI CLIENTI -->

                            <select id="inputState" class="form-select" name="scelta_cliente3" style="float:left; display:block;">
    
                             <?php
                             $clienti=prendi_clienti($id_album);
                             /* creo la prima selezione */
                             echo"<option selected=\"NULL\" value=\"NULL NULL\">selezione</option>";
                             while($row=$clienti->fetch(PDO::FETCH_ASSOC)) {
                                $row['nome_cliente'] = str_replace(" ", "_", $row['nome_cliente']);
                              echo "<option value=\"{$row['nome_cliente']} {$row['id_cliente']}\"> {$row['nome_cliente']}</option>";
                                        
                            }     ?>
                                </select>

                            <!--            FINE CASELLE PER LA SELEZIONE -->

                             <!--  PULSANTE INPUT DEL FORM -->

                            </br> <input type="submit" name="win3" value="prendi"></button>
                            <button id="manda3" onclick="slide1('slide3.php','win3')" name="manda3">Manda</button></form>
                            <!-- fine form di scelta -->

                                 <?php
                                            if(isset($_GET['win3'])){
          
                                            $_SESSION['cartella_scelta5']=$_GET['cartella_scelta5'];
                                            $_SESSION['cartella_scelta6']=$_GET['cartella_scelta6'];
                                            /*  per l'INPUT CARTELLA CLIENTI FACCIO IL PROCEDIMENTO PER ESTRAPOLARE I PREFERITI E METTERLI IN UN ARRAY */
                                            if(isset($_GET['scelta_cliente3'])){
                                            $array=explode(" " , $_GET['scelta_cliente3']);
                                            $nome_cliente=$array[0];
                                            $id_cliente=$array[1];
                                            $_SESSION['nome_cliente3']=$nome_cliente;
                                            $_SESSION['id_cliente3']=$id_cliente;
                                            }

                                            include('../../../config_pdo.php');
                                            /*     faccio una query sql per prendere il percorso delle foto e le inserisco in un array */
                                            $seleziona_foto=$conn->prepare("SELECT * FROM `$id_album` WHERE sotto_cartella= '{$_GET['cartella_scelta5']}' OR sotto_cartella='{$_GET['cartella_scelta6']}'; ");
                                            $seleziona_foto->execute();
                                            
                                            $listafile=array();
                                            
                                            while($row=$seleziona_foto->fetch(PDO::FETCH_ASSOC)){
                                                $listafile[]=$row['path_small'];
                                                $_SESSION['sotto_cartella3']=$row['sotto_cartella'];
                                                }  
                                            
                                                $conn = null;
                                            }
 ?>

<p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta5']) && ($_SESSION['cartella_scelta5'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta5']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['cartella_scelta6'])&& ($_SESSION['cartella_scelta6'] != 'NULL') ){ echo " {$_SESSION['cartella_scelta6']}" ; } ?> </b> </p>
<p style="text-align: center;"> <b><?php if (isset($_SESSION['nome_cliente3'])&& ($_SESSION['nome_cliente3'] != 'NULL') ){ echo " {$_SESSION['nome_cliente3']}" ; } ?> </b> </p>
       
    </div>
    </div>
    </div>
            
              </section>
              </main><!-- End #main -->


        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../../assets/vendor/quill/quill.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../../assets/js/main.js"></script>

</body>

</html>