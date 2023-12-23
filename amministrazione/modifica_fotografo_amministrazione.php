<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

<body>
 <!--  INIZIALMENTE ESTRAPOLO TUTTE LE NFO DEL FOTOGRAFO -->
<?php
 $id_fotografo=$_GET['modifica_fotografo'];
 session_start();
 $_SESSION['fotografo_delete']=$id_fotografo;
include('header_side_amministrazione.php');
              
                     include('../config_pdo.php');
                   $select_fotografi=$conn->prepare("SELECT * FROM fotografi WHERE id_fotografo= :id_fotografo;");
                   $select_fotografi->bindParam(':id_fotografo', $id_fotografo);
                   $select_fotografi->execute();
                   $conn= null;

                    
                   while($row=$select_fotografi->fetch(PDO::FETCH_ASSOC)){
                   $nome_fotografo=$row['nome_fotografo'];
                   $cognome_fotografo=$row['cognome_fotografo'];
                   $telefono_fotografo=$row['telefono_fotografo'];
                   $sito_fotografo=$row['sito_fotografo'];
                   $nome_studio=$row['nome_studio'];
                   $piva_fotografo=$row['piva_fotografo'];
                   $codfiscale_fotografo=$row['codfiscale_fotografo'];
                   $email_fotografo=$row['email_fotografo'];
                   $pec_fotografo=$row['pec_fotografo'];
                   $indirizzo_fotografo=$row['indirizzo_fotografo'];
                   $citta_fotografo=$row['citta_fotografo'];
                   $cap_fotografo=$row['cap_fotografo'];
                   }

                /* SE SI SALVANO LE INFORMAZIONI SUCCEDE QUESTO */
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome_fotografo=htmlspecialchars(trim( $_POST['nome_fotografo']));
    $cognome_fotografo=htmlspecialchars(trim( $_POST['cognome_fotografo']));
    $piva_fotografo=htmlspecialchars(trim( $_POST['piva_fotografo']));
    $codfiscale_fotografo=htmlspecialchars(trim( $_POST['codfiscale_fotografo']));
    $telefono_fotografo=htmlspecialchars(trim( $_POST['telefono_fotografo']));
    $email_fotografo=htmlspecialchars(trim( $_POST['email_fotografo']));
    $pec_fotografo=htmlspecialchars(trim( $_POST['pec_fotografo']));
    $indirizzo_fotografo=htmlspecialchars(trim( $_POST['indirizzo_fotografo']));
    $citta_fotografo=htmlspecialchars(trim( $_POST['citta_fotografo']));
    $cap_fotografo=htmlspecialchars(trim( $_POST['cap_fotografo']));
    $sito_fotografo=htmlspecialchars(trim( $_POST['sito_fotografo']));
    $nome_studio=htmlspecialchars(trim( $_POST['nome_studio']));

  
    $cartella_logo="../fotografi/$id_fotografo/logo/";

    include('../config_pdo.php'); //vado ad inserire o modificare i dati nel db

    $insert=$conn->prepare("UPDATE `fotografi` SET `email_fotografo`=:email_fotografo,`telefono_fotografo`=:telefono_fotografo,`nome_fotografo`=:nome_fotografo,
    `cognome_fotografo`=:cognome_fotografo,`nome_studio`=:nome_studio,`pec_fotografo`=:pec_fotografo,`indirizzo_fotografo`=:indirizzo_fotografo,
    `citta_fotografo`=:citta_fotografo,`cap_fotografo`=:cap_fotografo ,`piva_fotografo`= :piva_fotografo ,`codfiscale_fotografo`= :codfiscale_fotografo,
    `sito_fotografo`=:sito_fotografo WHERE  `id_fotografo`=:id_fotografo AND `user_fotografo`=:user_fotografo ; ");
    $insert->bindParam(':email_fotografo', $email_fotografo);
    $insert->bindParam(':telefono_fotografo', $telefono_fotografo);
    $insert->bindParam(':nome_fotografo', $nome_fotografo);
    $insert->bindParam(':cognome_fotografo', $cognome_fotografo);
    $insert->bindParam(':nome_studio', $nome_studio);
    $insert->bindParam(':pec_fotografo', $pec_fotografo);
    $insert->bindParam(':indirizzo_fotografo', $indirizzo_fotografo);
    $insert->bindParam(':citta_fotografo', $citta_fotografo);
    $insert->bindParam(':cap_fotografo', $cap_fotografo);
    $insert->bindParam(':piva_fotografo', $piva_fotografo);
    $insert->bindParam(':codfiscale_fotografo', $codfiscale_fotografo);
    $insert->bindParam(':sito_fotografo', $sito_fotografo);
    $insert->bindParam(':id_fotografo', $id_fotografo);
    $insert->bindParam(':user_fotografo', $user_fotografo);
    if($insert->execute()){
      echo "Modifica avvenutta correttamente";
    };
}
?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Profilo</h1>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
 

    <div class="col-xl-8">

      <!-- Default Card -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Modifica Informazioni - <a href="index_amministrazione.php">Torna alla index amministrazione</a></h5>

          <!-- Floating Labels Form -->
          <form class="row g-3" action="#" method="POST" enctype="multipart/form-data">
          <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="nome_fotografo" value="<?php echo $nome_fotografo ?>" class="form-control" id="floatingName" placeholder="nome">
                <label for="floatingName">Nome</label>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="cognome_fotografo" value="<?php echo $cognome_fotografo ?>" class="form-control" id="floatingSurname" placeholder="cognome">
                <label for="floatingSurname">Cognome</label>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="telefono_fotografo" value="<?php echo $telefono_fotografo ?>" class="form-control" id="floatingTel" placeholder="Telefono">
                <label for="floatingTel">Telefono</label>
              </div>
            </div>
            </div>
            <div class="col-md-6">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="sito_fotografo" value="<?php echo $sito_fotografo ?>" class="form-control" id="floatingSito" placeholder="Sito">
                <label for="floatingSito">Sito Internet</label>
              </div>
            </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" name="nome_studio" value="<?php echo $nome_studio ?>" class="form-control" id="floatingStudio" placeholder="studio">
                <label for="floatingStudio">Denominazione Studio</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="piva_fotografo" value="<?php echo $piva_fotografo ?>" class="form-control" id="floatingPiva" placeholder="piva">
                <label for="floatingPiva">Partita Iva</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="text" name="codfiscale_fotografo" value="<?php echo $codfiscale_fotografo ?>" class="form-control" id="floatingCodfiscale" placeholder="codice fiscale">
                <label for="floatingCodfiscale">Codice Fiscale</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="email_fotografo" value="<?php echo $email_fotografo ?>" class="form-control" id="floatingEmail" placeholder="Email">
                <label for="floatingEmail">Email</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="email" name="pec_fotografo" value="<?php echo $pec_fotografo ?>" class="form-control" id="floatingPec" placeholder="Pec">
                <label for="floatingPec">PEC</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-floating">
                <input name="indirizzo_fotografo" value="<?php echo  $indirizzo_fotografo ?>" class="form-control"  placeholder="Indirizzo" id="floatingIndirizzo" >
                <label for="floatingIndirizzo">Indirizzo</label>
              </div>
            </div>
            <div class="col-md-7">
              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" name="citta_fotografo" value="<?php echo $citta_fotografo ?>" class="form-control" id="floatingCity" placeholder="City">
                  <label for="floatingCity">Città</label>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-floating">
                <input type="text" name="cap_fotografo" value="<?php echo $cap_fotografo ?>" class="form-control" id="floatingZip" placeholder="Zip">
                <label for="floatingZip">CAP</label>
              </div>
            </div>
            <div class="col-md-12">
            <div class="row mb-1">
              <label for="inputNumber" class="col-sm-1 col-form-label">Logo</label>
              <div class="col-sm-6">
                <input class="form-control" type="file" name="logo_fotografo" id="formFile" required>
                </div>
                <div class="col-sm-5">
              <label for="inputNumber" class="col-sm-12 col-form-label"><b>Caricare il proprio logo in formato "JPG" </b></label>
              </div>
            </div>
            </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Salva</button>
            </div>
          </form><!-- End floating Labels Form -->
    <!-- End Default Card -->
    <div class="card-body row align-items-center" style="border: 1px solid #0040ff ; padding-top: 1rem ; text-align: center ; border-radius: 30px ; margin: 1rem ;">
                                                        <div class="col-12">
                                                        <h4>ELIMINA FOTOGRAFO</h4>
                                                        <p style="color: white; background-color:brown">Attenzione eliminando i dati del fotografo dal DataBase eliminerai anche tutti i suoi album e i clienti ad essi registrati</p>
                                                        <form id="modulo_fotografo" action="../function/cancella_fotografo.php" method="GET">
                                                        <input type="input" name="cancella_fotografo" id="cancella_fotografo" placeholder="scrivi: Elimina Fotografo" onfocus="resetta_fotografo()"><i class="bi bi-trash"></i>
                                                       </form>
                                                       <small>Scrivi qui "Elimina Fotografo"  </small> 
                                                       <p> <b>Stai eliminando definitivamente I dati del fotografo </br> "<?php echo $id_fotografo  ?>"</b> </p>  
                                                   

                                                    <!--  Passa prima dalla funzione JS e da li alla pagina  cancella album che si trova all'interno di funzioni-->
                                                    <button onclick="cancella_fotografo()" class="btn btn-outline-danger btn-sm">Conferma cancellazione</button>
                                                </div>
                                            </div>

                                            <div id="console_fotografo">

                                            </div>
             

            

        </div>
      </div>

    </div>

</section>

<!-- SEZIONE DI CONTROLLO -->
<div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">SPAZIO DI CONTROLLO</h5>
                    <h3>Variabili di sessione memorizzate</h3>
                    <?php print_r($_SESSION); print_r($_GET);print_r($_POST)?>

                    <a href="gestione_galleria.php">gestione galleria</a>";


                </div>
            </div>

        </div>
    </div> <!-- END SESIONE DI CONTROLLO -->

</main><!-- End #main -->


<script src="../function/funzioni_js.js"></script>
</body>

</html>