<?php

$id_operatore=$_COOKIE['id_operatore'];
if(isset($_COOKIE['nome_operatore'])){
  $nome_operatore=$_COOKIE['nome_operatore'];
}else{
  $nome_operatore='anonimo';
}

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



</head>

<body class="toggle-sidebar">


  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../../../index.php" class="logo d-flex align-items-center">
        <img src="../../../img/logo.png" alt="">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" >
             <?php if (isset($id_operatore))  echo $nome_operatore; ?>
          </a><!-- End Profile Iamge Icon -->
        <span class="d-none d-lg-block"></span>
      </a>
      <i class="bi bi-hexagon-half toggle-sidebar-btn"></i>
      <?php
      include('../../../main.php');
      include(D20DIR.'/function/funzioni_album.php');
      include(D20DIR.'/config_pdo.php');
      require_once '../../../includes/work-class.php';
      
      $button = new WORK_CSI($id_album,$id_operatore,$conn);
      echo' <i class="bi bi-grip-vertical"> </i> ';
      $button->reload();
      echo' <i class="bi bi-grip-vertical"> </i> ';
      $button->offcanvas_folder();
      echo' <i class="bi bi-grip-vertical"> </i> ';
      $button->slide_upload();
      echo' <i class="bi bi-grip-vertical"> </i> ';
      $button->mostra_selezione();
      $button->azzera_selezione();
      echo' <i class="bi bi-grip-vertical"> </i> ';
      $button->offcanvas_ricerche();

      ?>



  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="../../../live/dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" style="background-color: #bee5fc ; border-radius:15px; padding: 5px;" href="../../../live/crea_album.php">
          <i class="bi bi-book"></i>
          <span>Crea nuovo album</span>
          <i class="bi bi-plus-square" style="margin-left: 10px ; color:black"></i>
        </a>

        <hr>
      <li class="nav-heading">Work Area</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="work.php">
          <i class="bi bi-person-workspace"></i>
          <span>Area di Lavoro</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="impostazioni.php">
          <i class="bi bi-gear-fill"></i>
          <span>Impostazioni</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="gestione_clienti.php">
          <i class="bi bi-people-fill"></i>
          <span>Clienti</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="report.php">
        <i class="bi bi-table"></i>
          <span>Report</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo D20.'/live/modifica_album.php' ?>">
          <i class="bi bi-boxes"></i>
          <span>Modifica Album</span>
        </a>
      </li>


      <hr>
      <li class="nav-heading">Account</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../live/profilo.php">
          <i class="bi bi-person"></i>
          <span>Profilo</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../live/istruzioni.php">
          <i class="bi bi-question-circle"></i>
          <span>Istruzioni</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../live/contatti.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../index.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../../amministrazione/login_amministrazione.php">
          <?php if (isset($_SESSION['admin_true']) && $_SESSION['admin_true'] === "TRUE") {
            echo "  <i class='bi bi-box-arrow-in-right'></i>
          <span>  'Amministrazione' ";
          } ?> </span>
        </a>
      </li><!-- End Login Page Nav -->



    </ul>

  </aside><!-- End Sidebar-->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>



  <script>
    function hidden_button() {
      anteprima = document.getElementById('pulsante');
      if (anteprima.checked) {

        var divReference = document.getElementById("buttons");
        divReference.className = "d-none";
      } else {
        var divReference = document.getElementById("buttons");
        divReference.className = "row align-items-start sticky-top bs-white ";

      }
    }
  </script>

  <!-- Vendor JS Files -->
  <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
 <!--  <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script> -->
  <script src="../../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../../assets/js/main.js"></script>



</body>

</html>