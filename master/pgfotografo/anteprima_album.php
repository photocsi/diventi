<?php
$id_album=38;
$nome_album='';
$sottotitolo='';
$data_album='';
$path_copertina=''  ;
$vuota= ''                                                                                                                                           ;





?>


                <!--   SECONDA SEZIONE A DESTRA -->
                <div id="album" class="col-lg-4">

<div class="card">
  <div class="card-body">
    <div class="row">
    <div class="col-6">
    <h5 class="card-title">Album</h5>
   
   </div>
     </div>
    
          <!-- Advanced Form Elements -->
      
        <div class="col-sm-10">

        <section id="portfolio" class="portfolio">
      <div class="container" style="border: 2px #bbb solid; padding: 10px" data-aos="fade-up">

 <!-- Card intestazione album -->
 <div class="card">
            <div class="card-body">
              <h5 class="card-title">Nome Album:  <b>'<?php echo $nome_album ?>'</b></h5>
              <p class="card-text">Sottotitolo: <b>'<?php echo $sottotitolo?> '</b>
            </br>Data: <b>'<?php echo $data_album?> '</b></p>
            </div>
            <img src="<?php echo $path_copertina ?>" class="card-img-bottom" alt="...">
          </div><!-- End Card intestazione album -->

        </div>
      </div>
      </div>
     
     <!--  inizio sessione cartelle e foto -->
      <div class="container" style=" padding: 0 30px 0 30px ;" data-aos="fade-up">
        <div class="section-title">
              <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          
               <h5>Info Album</h5>
         <?php
               $tot_download=0;
               $tot_stampe=0;
               include('../../../config_pdo.php');
  $select=$conn->prepare("SELECT download, stampe FROM $db.$id_album");
  $select->execute();
  while($row=$select->fetch(PDO::FETCH_ASSOC)){
    $tot_download += $row['download'];
    $tot_stampe += $row['stampe'];
  }

               ?>
               <div class="card">
            <div class="card-body">
              <!-- Table Variants -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Tipo</th>
                    <th scope="col">Totale</th>
                  
                  </tr>
                </thead>
                <tbody>

                  <tr class="table-primary">
                    <th scope="row">Download</th>
                    <td><?php echo $tot_download ?></td>
                  </tr>
               
                  <tr class="table-success">
                    <th scope="row">Stampe</th>
                    <td><?php echo $tot_stampe ?></td>
                  </tr>
                 
                </tbody>
              </table>
              <!-- End Table Variants -->

            </div>
          </div>

        </div>


        </div>
      </div>
      </div>
      </section>
      </div>

          <!-- End sezione a destra -->