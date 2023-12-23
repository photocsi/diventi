<?php
session_start();
$id_album=$_SESSION['id_album'];



?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login client - D20</title>
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
$messaggio="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email_cliente=htmlspecialchars(trim($_POST['email_cliente']));
    $password_cliente=$_POST['password_cliente'];
     include('config_pdo.php');

     

     
/* seleziono tutti i dati dei clienti */
     $sql="SELECT * FROM `1clienti` ;";
     $stmt=$conn->prepare($sql);
     $stmt->execute();
     $conn= null;
    
     /* controllo se il cliente esiste ed e registrato in quella galleria specifica */
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['email_cliente']===$email_cliente && password_verify($password_cliente,$row['password_cliente'])===TRUE && $row['id_album']==$id_album){
                  $id_cliente=$row['id_cliente'];
                  $nome_cliente=$row['nome_cliente'];
                 
               /*    $path_galleria_register=$_SESSION['path_galleria_register']; *//*  DA CONTROLLARE */
                  $_SESSION['email_cliente']=$email_cliente;
                  $_SESSION['password_cliente']=$password_cliente;
                  $_SESSION['id_cliente']=$id_cliente;
                  $_SESSION['nome_cliente']=$nome_cliente;
                  
                  header("Location: album/$id_album/pgcliente/index.php");
                               
              }else if($row['email_cliente']===$email_cliente && $row['password_cliente']!=$password_cliente && $row['id_album']==$id_album){
                 $a=1;
              }
                  }
                 
             
                /*   a questo punto se la variabile a è settata mando il messaggio per la seconda opzione email giusta pass sbagliata
                  altrimenti mando il messaggio di iscriversi */
                 if(isset($a)){
                  $messaggio="</br><b>Password errata, riprova oppure recupera la password</b>";
                 }else $messaggio="</br><b>Email non presente in questo album, effettua la registrazione</b>";
                }
      

?>
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
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
                                        <h5 class="card-title text-center pb-0 fs-4">Accedi</h5>
                                        <p class="text-center small"> <?php echo $messaggio ?></p>
                                    </div>
                                    <div class="col-12">
                                            <a href="register_clienti.php">
                                                <h4 class="card-title text-center pb-0 fs-4">Se non sei registrato</br>
                                                <b> Clicca QUI </b><i class="bi bi-arrow-left-square-fill"></i></h4>
                                            </a>

                                        </div>

                                    <form action="#" method="POST" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="email_cliente" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Inserisci l'e-mail</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password_cliente" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Iserisci la tua password</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Ricorda il login</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                name="login">Login</button>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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