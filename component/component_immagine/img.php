 <!-- SEZIONE VISUALIZZA IMMAGINI ORIGINALE E MODIFICATA -->

 <div class="row" style="margin-bottom: 10;">
          <div class="col">
            <h5>Immagine originale</h5>
            <div class="boxFoto" style="width: auto ; height: 580px">
              <div style=" width: 100% ; height: 100% ; object-fit: cover; ">
                <img src="<?php echo $path_immagine ?>" id="image">
              </div>
            </div>
          </div>

          <div class="col">
            <h5>Immagine da stampare</h5>
            <div class="boxFoto" style="width: auto ; height: 580px">

              <div class="card " id="fotoMod" style=" width: 100% ; height: 100% ; ">
                <img class="card-img" src=" <?php echo  $path_immagine_large_modificata . '. ? .' .  time(), ' '; ?>" id="output" style="width: 100% ; height: 100%; object-fit: contain;">
                </a>
                <!--  Elementi della grafica nella loro posizione -->
                <div class="card-img-overlay">
                  <img src="../../../img/base_grafica_white.png" id="center" class=" position-absolute bottom-0 start-50 translate-middle-x" style="width: 100% ;  object-fit: contain;">
                  <img src="" id="logosx" class="position-absolute bottom-0 start-0" style="padding: 10px 3px 14px 15px; width:auto; height:60px ;">
                  <img src="" id="logodx" class="position-absolute bottom-0 end-0" style="padding: 10px 15px 14px 3px;width:auto; height:60px ;">
                  <p class="card-text position-absolute bottom-0 start-50 translate-middle-x" id="textGrafica" style="font-size: 18px; color: red; text-shadow: 2px 2px 4px black; padding: 5px 2px 14px 2px;"></p>

                </div>
              </div>
            </div>
            <div id="textImg" style="display: none;"></div> <!-- immagine decodificata in testo decode 64 che viene preso dal php e ridecodificata in immagine-->
          </div>
        </div> <!-- fine immagine originale e modificata -->