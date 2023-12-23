<?php

session_start();
$id_album=$_SESSION['id_album'];
$id_fotografo=$_SESSION['id_fotografo'];

?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registrazione Clienti</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

<?php
$messag_user="";
$check_password=array();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome_cliente=htmlspecialchars(trim($_POST['name']));
    $telefono_cliente=htmlspecialchars(trim($_POST['telefono']));
    $email_cliente=htmlspecialchars(trim($_POST['email']));
    $password_cliente=trim($_POST['password']);
    $password_hash=password_hash($password_cliente, PASSWORD_ARGON2I);

    include('validazione_dati.php');
    $checkemail=convalida_email($email_cliente);
    $check_password=convalida_pass($password_cliente);
    $check_telefono=convalida_telefono($telefono_cliente);
  
   /*  !!!!!!!!!!!ricordarsi di convalidare anche nome , telefono !!!!!!!!!!!!!!!----------------- */
   /*  controlliamo che i dati inseriti siano corretti */

   if($checkemail===TRUE && $check_password[0]===TRUE && $check_telefono[0]===TRUE){
       include('config_pdo.php');
       $sql="SELECT * FROM 1clienti ;";

       $stmt=$conn->prepare($sql);
       $control=1;
       /* verifico che  l'email non sia già presente in quell'album */
       while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        if($row['email_cliente']===$email_cliente && $row['id_album']===$id_album){
            $messag_user="</br><b style=\"color: red;\">Email già presente nel sistema</br>vai al login oppure recupera password</b>";
            $control=0;
       }
    } 
   }else{
    $control=0;
    $messag_user="Email o password non validate, riprova";
   }
           /*  altrimenti passo a creare sul db un nuovo utente */
           //con PDO
           if($control===1){
           $stmt= $conn->prepare("INSERT INTO `1clienti`(id_album, id_fotografo, nome_cliente, email_cliente, password_cliente, telefono_cliente) 
           VALUES (:id_album, :id_fotografo, :nome_cliente, :email_cliente, :password_cliente, :telefono_cliente);");
             $stmt->bindParam(':id_album' , $id_album );  
          $stmt->bindParam(':id_fotografo' , $id_fotografo );        
           $stmt->bindParam(':nome_cliente' , $nome_cliente ); 
           $stmt->bindParam(':email_cliente' , $email_cliente ); 
           $stmt->bindParam(':password_cliente' , $password_hash ); 
           $stmt->bindParam(':telefono_cliente' , $telefono_cliente ); 

            if($stmt->execute()){
                echo "Dati inseriti correttamente";
                
/* prendo e memorizzo l'id_cliente appena creato */
                $stmt= $conn->prepare("SELECT id_cliente FROM 1clienti WHERE email_cliente = :email_cliente AND password_cliente = :password_cliente;");
                $stmt->bindParam(':email_cliente' , $email_cliente ); 
                $stmt->bindParam(':password_cliente' , $password_hash ); 
                $stmt->execute();
                    
                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                  $id_cliente=$row['id_cliente'];
                }
                $conn= null;


                 /*  FACCIO IL PROCEDIMENTO PER AGGIUNGERE L'ID CLIENTE ALLA LISTA CLIENTI DELLA TABELLA 1ALBUM */
                 include('function/funzioni_album.php');
                aggiungi_lista_cliente("clienti_registrati", $id_album , $id_cliente , 'config_pdo.php');
            

    /*   faccio partire la sessione esternalizzo la variabile con l'indirizzo della pagina e li rimando li */
      $_SESSION['nome_cliente']=$nome_cliente;
      $_SESSION['email_cliente']=$email_cliente;
      $_SESSION['id_cliente']=$id_cliente;
    
      header("Location: album/$id_album/pgcliente/index.php");
              
            }die ("Errore di creazione".$connessione->connect_error);
         }
    }

?> <!-- END CODE PHP-->
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="img/logo.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Registrati</h5>
                    <p class="text-center small"> <?php echo $messag_user ?></p>
                  </div>
                  <div class="col-12">
                                            <a href="login_clienti.php">
                                                <h4 class="card-title text-center pb-0 fs-4">Se ti sei già registrato</br>
                                                 <b> Clicca QUI </b><i class="bi bi-arrow-left-square-fill"></i></h4>
                                            </a>

                                        </div>

                  <form class="row g-3 needs-validation" action="#" method="POST" novalidate>
                    <div class="col-12">
                      <label for="yourName" class="form-label">Nome</label>
                      <input type="text" name="name" class="form-control" id="yourName" maxlength="30" required>
                      <div class="invalid-feedback">Inserisci il tuo nome</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">E-mail</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Inserisci un e-mail valida</div>
                    </div>


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label> <b style="color:firebrick"><?php if(isset($check_password[1])==TRUE) echo $check_password[1] ; ?></b>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Inserisci la tua password</div>
                      <label for="yourPassword" class="form-label">Da 8 a 20 caratteri e almeno un numero e una lettera</label>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">N° Cellulare</label> <b style="color:firebrick"><?php if(isset($check_telefono[1])==TRUE) echo $check_telefono[1] ; ?></b>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">T</span>
                        <input type="tel" name="telefono" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Inserisci il numero di cellulare</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Accetto <a href="#">termini e condizioni</a></label>
                        <div class="invalid-feedback">Per proseguire devi accettare i termini e le condizioni</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                  </form>
   </div>
              </div>

              <div class="credits">
                Designed by <a href="https://csistudio.com/">Photo CSI</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>