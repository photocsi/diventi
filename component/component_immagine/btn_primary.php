<!-- SEZIONE IN BASSO STAMPA SAVE ELIMINA GRAFICA , INFO E RESET -->
<div class="row" >
              <div class="card">
            <div class="card-body" style="align-self: center;">

              <div class="btn-group" role="group" aria-label="Basic example" style="padding-right: 3rem;">
              <button type="button" class="btn btn-primary btn" name="stampa" id="stampa" value="<?php echo "$id_album,$id_foto,stampe" ?>" onclick="stampa('stampa')"> Stampa </button>
              </div>
              <div class="btn-group" role="group" aria-label="Basic example" style="padding-right: 3rem;">
              <button type="button" class="btn btn-primary btn" name="reset" id="reset" value="<?php echo "$nome_foto,$sotto_cartella,$id_album" ?>" onclick="reset()"> Reset </button>
              </div> 
              <div class="btn-group" role="group" aria-label="Basic example" style="padding-right: 3rem;">
                   <?php echo "  <button type=\"button\" class=\"btn btn-primary btn\" name=\"save\"
                                 onclick=\"save_img64('save_button')\" id=\"save_button\" 
                                 value=\"$id_album,$path_immagine_modificata_save,$nome_foto\">  Save </button> "; ?>
              </div> 
              <div class="btn-group" role="group" aria-label="Basic example" style="padding-right: 3rem;">
              <button type="button" class="btn btn-primary btn" name="elimina_grafica" id="elimina_grafica"  onclick="inserisci('elimina_grafica','elimina_grafica','elimina_grafica')"> Elimina grafica </button>
              </div>
              <?php /* modale_foto($path_immagine_medium , $path_immagine); */ ?>
             
                 </div> 
                    </div>
                      </div> <!-- FINE SEZIONE IN BASSO PULSANTI -->