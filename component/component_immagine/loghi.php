


<!--   INIZIO SEZIONE GRAFICHE -->
<div class="accordion-item">
  <h2 class="accordion-header" id="headingThree">
    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      GRAFICHE
  </h2>
  <div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headingThree" data-bs-parent="#accordionExample">
    <div class="accordion-body">
    <div class="row">
                     <!-- General Form Elements -->
             <!--       INIZIO CARICA LOGHI -->
                    <hr>
                     
                    <span class="badge rounded-pill bg-light text-dark">Carica loghi</span>

                    <form class="row g-3" action="#" method="POST" enctype="multipart/form-data" style="margin-top: 0px !important;">
                    <div class="col-md-9">
                        <input class="form-control" type="file" name="logo_grafica" id="formFile">
                    </div>
                    <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Carica</button>
                    </div>
                    </form> <!-- fine carica loghi -->


                    <hr style="margin: 5px">
                        </div>

         <!--                SEZIONE TESTO DA INSERIRE -->
   
         <div class="row"> <!-- row per comporre la grafica -->
         <span class="badge rounded-pill bg-light text-dark" style="margin: 15px 0px 15px 0px" >Inserisci testo grafica</span>
       
         <div class="col-md-7">
         <input type="text" id="makeText" class="form-control" placeholder="testo grafica" value="" ></input>
         </div>
         <div class="col-md-5">
         <button type="submit" class="btn btn-primary" id="buttonText" onclick="inserisci('makeText','textGrafica','testo')" 
                      value=" <?php  echo $testo  ?>" name=" buttonText" style="margin-bottom: 6px; min-width: 90px;"> inserisci</button>
                      </div>
          
                      <?php include('../../../component/component_immagine/text_grafica.php');  ?>
        </div>

                    <?php include('../../../component/component_immagine/base_grafica.php');  ?>

                    <?php include('../../../component/component_immagine/size_loghi.php');  ?>

</div>               
     <div class="row row-cols-1 row-cols-md-3 g-4" style="padding: 15px"> <!-- row inizio card loghi -->
     <?php  $lista_loghi=glob("../../../fotografi/1/loghi_grafiche/*.*");
     foreach ($lista_loghi as $value) { ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?php  echo $value ?>" class="card-img-top" alt="...">
          <div class="card-body">
           
            <button type="button" class="btn btn-primary btn-sm"  style="margin-bottom: 2px; "
                    id="<?php  echo $value.'sx'; ?>"  value="<?php  echo $value ?>" onclick="inserisci('<?php  echo $value.'sx'; ?>','logosx','logosx')">  <i class="bi bi-arrow-left-square"></i> </button>
              <button type="button" class="btn btn-primary btn-sm" style="margin-bottom: 2px; "
              id="<?php  echo $value.'dx'; ?>"  value="<?php  echo $value ; ?>" onclick="inserisci('<?php  echo $value.'dx' ; ?>', 'logodx','logodx')"> <i class="bi bi-arrow-right-square"></i>  </button>
     
          </div>
        </div>
      </div>
      <?php } ?>
      
 
    </div>  <!-- row end card loghi -->

  </div> <!-- end accordion body grafica -->
</div> <!-- end accordion grafica -->