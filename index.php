<?php
ob_start();


if(isset($_COOKIE['user_fotografo'])){
    session_start();
    $_SESSION['user_fotografo']=$_COOKIE['user_fotografo'];
    $_SESSION['password_fotografo']=$_COOKIE['password_fotografo'];
    $_SESSION['id_fotografo']=$_COOKIE['id_fotografo'];
    header('Location: live/dashboard.php ');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login Fotografo - Total Photo</title>
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
    $username=htmlspecialchars(trim($_POST['user_fotografo']));
    $password=$_POST['password_fotografo'];
     include('config_pdo.php');
      

     $sql = 'SELECT * FROM fotografi';
     $stmt = $conn->prepare($sql);
     $stmt->execute();

     $control=0;
            while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                if($row['user_fotografo']===$username && password_verify($password,$row['password_fotografo'])===TRUE){
                  $id_fotografo=$row['id_fotografo'];
                 $control=1;
             }
            }

      if($control===1){
      
        $_SESSION['user_fotografo']=$username;
        $_SESSION['password_fotografo']=$password;
        $_SESSION['id_fotografo']=$id_fotografo;
        setcookie ("user_fotografo", $username, time()+(86400 * 365));
        setcookie ("password_fotografo", $password, time()+(86400 * 365));
        setcookie ("id_fotografo", $id_fotografo, time()+(86400 * 365));
        header('Location: live/dashboard.php ');
   
      }else{
          $messaggio="</br><b>Nome Utente o password errati</b>";
      }
      $conn= null;
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
                                            <a href="register.php">
                                                <h4 class="card-title text-center pb-0 fs-4">Se non sei registrato</br>
                                                <b> Clicca QUI </b><i class="bi bi-arrow-left-square-fill"></i></h4>
                                                   
                                                </h4>
                                            </a>

                                        </div>

                                    <form action="#" method="POST" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="user_fotografo" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Inserisci il tuo username</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password_fotografo" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Inserisci la tua password</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Ricordami il login</label>
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
                                Designed by <a href="https://csistudio.com/">Photo CSI</a> figa
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