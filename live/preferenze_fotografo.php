<?php session_start(); 
$id_fotografo=$_SESSION['id_fotografo'];
$user_fotografo=$_SESSION['user_fotografo'];
?>

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
 <!--  passo da profilo a impostazioni per confermare le modifiche delle pagine -->
  <!-- recupero tutte le info prese dal form le sanifico e creo le variabili -->
<?php   include('header_side_live.php');    include('../function/funzioni_album.php');

if($_SERVER['REQUEST_METHOD']=='POST'){ //questo metodo POST si riferisce alla pagina profilo
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

/* da controllare se l'immagine è stata messa la dimensiono e la aggiungo nella cartella logo,
altrimneti se il nome immagine risulta vuoto non faccio nulla*/
if(!empty($_FILES['logo_fotografo']['name'])){
  $immagine=$_FILES['logo_fotografo']['tmp_name'];
  $nome_immagine=$_FILES['logo_fotografo']['name'];
  riduci_e_salva($immagine,400,"$cartella_logo/$nome_immagine",75, false);
  rename("$cartella_logo/$nome_immagine" ,"$cartella_logo/logo.jpg" );
}

}

?>

  <main id="main" class="main" style="background-color: #bee5fc ">

  <div class="pagetitle">
      <h1>Profilo</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <!-- Default Card -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Impostazioni Generali</h5>

              <div class="col-xl-8">

<!-- Default Card -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Aggiungi Watermark</h5>

    <!-- Floating Labels Form -->
    <form class="row g-3" action="profilo.php" method="POST" enctype="multipart/form-data">
      <div class="col-md-12">
      <div class="row mb-1">
        <label for="inputNumber" class="col-sm-1 col-form-label">Watermark</label>
        <div class="col-sm-6">
          <input class="form-control" type="file" name="watermark" id="formFile" required>
          </div>
          <div class="col-sm-5">
        <label for="inputNumber" class="col-sm-12 col-form-label"><b>Caricare l'immagine in formato "PNG"  dimensione 550 px lato lungo </b></label>
        </div>
      </div>
      </div>
      
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Salva</button>
      </div>
    </form><!-- End floating Labels Form -->
<!-- End Default Card -->
        <!-- End Default Card -->
        <h5 class="card-title">Watermark Attuale</h5>
       <?php echo " <img src=\"../fotografi/$id_fotografo/watermark/watermark.png\"> " ?>

        </div>
          </div>  

                

            </div>
          </div>

        </div>
    
    </section>
    <?php /* include ('../component/sezione_controllo.php'); */ ?>

  </main><!-- End #main -->

  <?php include('footer_live.html'); ?>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


</body>

</html>