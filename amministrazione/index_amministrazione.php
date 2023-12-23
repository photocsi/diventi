
<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

<body>
<?php session_start();
unset($_SESSION['id_fotografo']);
unset($_SESSION['user_fotografo']);
unset($_SESSION['password_fotografo']);
include('header_side_amministrazione.php') ?>


 <!--  INIZIO MAIN -->
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Amministrazione</h1>
      
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

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

                <div class="card-body">
                  <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Studio</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">email</th>
                        <th scope="col">Modifica</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                     include('../config_pdo.php');
                   $select_fotografi=$conn->prepare("SELECT * FROM fotografi ;");
                   $select_fotografi->execute();
                   while($row=$select_fotografi->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr> <td>{$row['id_fotografo']}</td>
                    <td>{$row['user_fotografo']}</td>
                    <td>{$row['nome_studio']}</td>
                    <td>{$row['nome_fotografo']}</td>
                    <td>{$row['telefono_fotografo']}</td>
                    <td>{$row['email_fotografo']}</td>
                    <td><form action='modifica_fotografo_amministrazione.php' method='GET'>
                     <button type='submit' name='modifica_fotografo' value='{$row['id_fotografo']}' class='btn btn-outline-danger btn-sm'>Modifica Fotografo</button></td> </tr></form>";
                      }
                  
                     ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

           
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


</body>

</html>