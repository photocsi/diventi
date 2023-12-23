<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registrazione Fotografo - Total Photo</title>
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
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user_fotografo=htmlspecialchars(trim($_POST['user_fotografo']));
    $tel=htmlspecialchars(trim($_POST['telefono_fotografo']));
    $email=htmlspecialchars(trim($_POST['email_fotografo']));
    $password=$_POST['password_fotografo'];
    $password_hash=password_hash($password, PASSWORD_ARGON2I);
    $livello_fotografo= 000;

    include('validazione_dati.php');
    $checkemail=convalida_email($email);
    $check_password=convalida_pass($password);
    $check_telefono=convalida_telefono($tel);
  
   /*  !!!!!!!!!!!ricordarsi di convalidare anche nome , telefono e username!!!!!!!!!!!!!!!----------------- */
   /*  controlliamo che i dati inseriti siano corretti */


      if($checkemail===TRUE && $check_password[0]===TRUE && $check_telefono[0]===TRUE){
         include('config_pdo.php');

   
        $select=$conn->prepare("SELECT * FROM fotografi ;");
        $select->execute();
       
        /* verifico che il nome utente non sia già presente */
        $control=1;
          while($row=$select->fetch(PDO::FETCH_ASSOC)){
             if($row['user_fotografo']==$user_fotografo){
                $messag_user="</br><b style=\"color: red;\" >E' già presente un utente con questo user</br>scegline un'altro</b>";
                $control=0;
            }else if($row['email_fotografo']==$email){
                $messag_user="</br><b style=\"color: red;\">Email già presente nel sistema</br>vai a recupera password</b>";
                $control=0;
           }
        } 
     }else{
      $control=0; $messag_user="Email, password o telefono non validate riprova";
     }
              /*  altrimenti passo a creare sul db un nuovo utente */
                 if($control===1){
                    $insert=$conn->prepare("INSERT INTO `fotografi`(`user_fotografo`,`password_fotografo`, `email_fotografo`, `telefono_fotografo`, `livello_fotografo`) 
                    VALUES (:user_fotografo, :password_hash, :email ,:tel , :livello_fotografo)");
                    $insert->bindParam(':user_fotografo', $user_fotografo);
                    $insert->bindParam(':password_hash', $password_hash);
                    $insert->bindParam(':email', $email);
                    $insert->bindParam(':tel', $tel);
                    $insert->bindParam(':livello_fotografo', $livello_fotografo );
                         if($insert->execute()){
                          echo "Dati inseriti correttamente";
                          /* seleziono l'id del fotografo appena inserito */
                          $select=$conn->prepare("SELECT id_fotografo FROM fotografi WHERE user_fotografo= :user_fotografo AND email_fotografo= :email ;  ");
                          $select->bindParam(':user_fotografo' , $user_fotografo);
                          $select->bindParam(':email' , $email);
                          $select->execute();
                          $row=$select->fetch(PDO::FETCH_ASSOC);
                          $id_fotografo=$row['id_fotografo'];
                          mkdir("fotografi/$id_fotografo/watermark/" , 0777, TRUE);
                          mkdir("fotografi/$id_fotografo/logo/" , 0777, TRUE);
                          mkdir("fotografi/$id_fotografo/loghi_grafiche/" , 0777, TRUE);
                          header('Location: index.php');

                          $conn= null;
                        }
                   }
         }
    

?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
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
                                            <a href="login.php">
                                                <h4 class="card-title text-center pb-0 fs-4">Se ti sei già registrato</br>
                                                <b> Clicca QUI </b><i class="bi bi-arrow-left-square-fill"></i></h4>
                                            
                                            </a>

                                        </div>

                  <form class="row g-3 needs-validation" action="#" method="POST" novalidate>

                  <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="user_fotografo" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Inserisci la tua username</div>
                      </div>
                    </div>
                  
                    <div class="col-12">
                      <label for="yourEmail" class="form-label">E-mail</label>
                      <input type="email" name="email_fotografo" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Inserisci un e-mail valida</div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>  <b style="color:firebrick"><?php if(isset($check_password[1])==TRUE) echo $check_password[1] ; ?></b>
                      <input type="password" name="password_fotografo" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Inserisci la tua passqord</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">N° Cellulare</label> <b style="color:firebrick"><?php if(isset($check_telefono[1])==TRUE) echo $check_telefono[1] ; ?></b>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">T</span>
                        <input type="tel" name="telefono_fotografo" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Inserisci il numero di cellulare</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">Accetto <a href="#">termini e condizioni</a></label>
                        <div class="invalid-feedback">Devi accettare termini e condizioni per proseguire</div>
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