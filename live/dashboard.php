<?php
/* controllo se non è settato il cookie vado all'index cioè login */
if(!isset($_COOKIE['user_fotografo']) ){
    header('Location: ../index.php ');
}

session_start();
$_SESSION['user_fotografo']=$_COOKIE['user_fotografo'];
$_SESSION['password_fotografo']=$_COOKIE['password_fotografo'];
$_SESSION['id_fotografo']=$_COOKIE['id_fotografo'];

/*     comando per resettare tutte le sessioni che riguardano album e cartelle... si tiene solo user fotografo e id fotografo */
    /* }else{
     
      resetta_sessioni();
    unset($_SESSION['$path_cartella']); 
    } */

 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<!-- PHO CODE STATISTICHE -->
 <?php  include ('header_side_live.php')  ?> 
<?php
include('../function/funzioni_album.php');
include('../function/statistiche.php');
/* $n_album=numero_album($_SESSION['id_fotografo']);
$quantita_foto=numero_foto($_SESSION['id_fotografo']);
$n_clienti=numero_clienti($_SESSION['id_fotografo']); */
$n_album=0;
$quantita_foto=0;
$n_clienti=0;
?>

<main id="main" class="main" style="background-color: #bee5fc;">

<div class="pagetitle">
      <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Statistiche Album </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-book"></i>
                    </div>
                    <div class="ps-3">
                    <h5><b><?php  echo $n_album ?></b> Album</h5>
                      <span class="text-success small pt-1 fw-bold"><?php  echo $quantita_foto ?></span> <span class="text-muted small pt-2 ps-1">Fotografie</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-4">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Clienti </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $n_clienti ?></h6>
                      <span class="text-success small pt-1 fw-bold">0</span> <span class="text-muted small pt-2 ps-1">Foto Selezionate </span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-4">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Ordini <span>| in lavorazione</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>0</h6>
                      <span class="text-danger small pt-1 fw-bold">0</span> <span class="text-muted small pt-2 ps-1">in lavorazione</span>

                    </div>
                  </div>

                </div>
              </div>
              </div>
             

            </div><!-- End Customers Card -->

<!-- SEZIONE CARD DEGLI ALBUM -->
    <div class="pagetitle">
      <h1>Album</h1>
    </div><!-- End Page Title -->
<!-- visualizzo tutti gli album dell'utente -->
    <section class="section float">
      <div class="row align-items-top">

      <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                 
                 
                  <table class="table table-borderless">
                     <tr>
                      <th scope="col"> <p class="card-title">Lista Album</th>
                        <!-- <th scope="col"><p class="card-title">Ricerca <span>| filtro in lavorazione</span></p></th>
                        <th scope="col"><p class="card-title">Ricerca <span>| filtro in lavorazione</span></p></th>
                        <th scope="col"><p class="card-title">Ricerca <span>| filtro in lavorazione</span></p></th> -->
                        
                        
                      </tr>
                    </thead>
                   </table>
                  <table class="table table-borderless">
                    <thead>
                      <tr>
                      
                      <th scope="col">Copertina</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sottotitolo</th>
                        <th scope="col">Data</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
          lista_album($_SESSION['id_fotografo']);
        
         ?>
         
  </div>
</div>

</div>

<?php include ('../component/sezione_controllo.php'); ?>
        
</div>
    </section>

  </main><!-- End #main -->
  <?php include ('footer_live.html'); ?>



</body>
</html>