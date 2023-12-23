<?php session_start(); ?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

</head>

<body>
<!-- passo da impostazioni a profilo per confermare le modifiche -->
<?php

$id_fotografo=$_SESSION['id_fotografo'];
$cartella_watermark="../fotografi/$id_fotografo/watermark/";

if($_SERVER['REQUEST_METHOD']=='POST'){  //questo metodo POST si riferisce alla pagina impostazioni preferenze
  include('../function/funzioni_album.php');
  $immagine=$_FILES['watermark']['tmp_name'];
  $nome_immagine=$_FILES['watermark']['name'];
  riduci_e_salva_png($immagine,400,"$cartella_watermark/$nome_immagine",9);
  rename("$cartella_watermark/$nome_immagine" ,"$cartella_watermark/watermark.png" ); /* rinomino il file del watermark con watermark.png */
}

?>

<?php  include('header_side_live.php');  include('../config_pdo.php');


$id_fotografo=$_SESSION['id_fotografo'];
$user_fotografo=$_SESSION['user_fotografo'];


$select=$conn->prepare("SELECT * FROM fotografi WHERE id_fotografo=:id_fotografo AND user_fotografo=:user_fotografo ;");
$select->bindparam(':id_fotografo', $id_fotografo);
$select->bindparam(':user_fotografo', $user_fotografo);
if($select->execute()===FALSE){
  die ("Errore di creazione");
}else{
  //prendo i dati dal db esistenti e li inserisco già nel form, in caso si possono modificare
  $select->execute();
  while($row=$select->fetch(PDO::FETCH_ASSOC)){
   $email_fotografo=$row['email_fotografo'];
   $telefono_fotografo=$row['telefono_fotografo'];
   $livello_fotografo=$row['livello_fotografo'];
   $nome_fotografo=$row['nome_fotografo'];
   $cognome_fotografo=$row['cognome_fotografo'];
   $nome_studio=$row['nome_studio'];
   $pec_fotografo=$row['pec_fotografo'];
   $indirizzo_fotografo=$row['indirizzo_fotografo'];
   $citta_fotografo=$row['citta_fotografo'];
   $cap_fotografo=$row['cap_fotografo'];
   $piva_fotografo=$row['piva_fotografo'];
   $codfiscale_fotografo=$row['codfiscale_fotografo'];
   $sito_fotografo=$row['sito_fotografo'];
   
  }
}

?>

  <main id="main" class="main" style="background-color: #bee5fc ">




    <div class="pagetitle">
      <h1>Profilo</h1>
    </div><!-- End Page Title -->

   <!--  Sezione per visualizzare i dati del fotografo -->
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center ">
           
      
              <img src=" <?php echo "../fotografi/$id_fotografo/logo/logo.jpg" ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $nome_studio ?></h2></br>
             
             
              <label>Nome</label> <h3><b><?php echo "$nome_fotografo $cognome_fotografo "?></b></h3></br>
              <label>Email</label> <h3><b><?php echo "$email_fotografo "?></b></h3></br>
              <label>Pec</label> <h3><b><?php echo "$pec_fotografo "?></b></h3></br>
              <label>Telefono</label> <h3><b><?php echo "$telefono_fotografo "?></b></h3></br>
              <label>Indirizzo</label> <h3><b><?php echo "$indirizzo_fotografo "?></b></h3>
              <h3><b><?php echo "$cap_fotografo $citta_fotografo "?></b></h3></br>
              <label>Cod. Fiscale</label> <h3><b><?php echo "$codfiscale_fotografo "?></b></h3></br>
              <label>P.Iva</label> <h3><b><?php echo "$piva_fotografo "?></b></h3></br>
              <label>Livello</label> <h3><b><?php echo "$livello_fotografo "?></b></h3></br>
              
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
              </div>
          </div>
        </div>

<!-- sezione per modificare o aggiungere i dati del fotografo -->

        <div class="col-xl-8">

          <!-- Default Card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Modifica Informazioni</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="preferenze_fotografo.php" method="POST" enctype="multipart/form-data">
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
                    <input class="form-control" type="file" name="logo_fotografo" id="formFile" >
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

  <?php include('footer_live.html'); ?>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>