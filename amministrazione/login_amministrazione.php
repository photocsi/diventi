
<?php session_start();  ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login Fotografo - Total Photo</title>
    <meta content="" name="description">
    <meta content="" name="keywords">



</head>

<body>
    <?php 
$messaggio="";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user_amministratore=htmlspecialchars(trim($_POST['user_amministratore']));
    $password_amministratore=htmlspecialchars(trim($_POST['password_amministratore']));
    $username=$_SESSION['user_fotografo'];
    $password=$_SESSION['password_fotografo'];
     include('../config_pdo.php');


     $select=$conn->prepare("SELECT * FROM fotografi ;");
     
     if($select->execute()){
         

         $control=0;
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                if($row['user_fotografo']===$username && password_verify($password,$row['password_fotografo'])===TRUE){
                  $id_amministratore=$row['id_fotografo'];
                 $control=1;
             }
            }
           
            $conn= null;
        }

         if($control===1){
         session_start();
         $_SESSION['user_fotografo']=$username;
         $_SESSION['password_fotografo']=$password;
         $_SESSION['id_fotografo']=$id_amministratore;
         $_SESSION['user_amministratore']="amministratore";
         header('Location: index_amministrazione.php ');
   
        }else{
          $messaggio="</br><b>Nome Utente o password errati</b>";
        }
}
include('header_side_amministrazione.php');
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
                                        <h5 class="card-title text-center pb-0 fs-4">Amministrazione</h5>
                                        <p class="text-center small"> <?php echo $messaggio ?></p>
                                    </div>

                                    <form action="#" method="POST" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="user_amministratore" class="form-control"
                                                    id="yourUsername" required>
                                                <div class="invalid-feedback">Inserisci il tuo username</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password_amministratore" class="form-control"
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
                                Designed by <a href="https://csistudio.com/">Photo CSI</a>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

</body>
</html>