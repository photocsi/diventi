<!-- SEZIONE IN BASSO STAMPA SAVE ELIMINA GRAFICA , INFO E RESET -->
<div class="row" >
              <div class="card">
            <div class="card-body" style="align-self: center;">

              <div class="btn-group" role="group" aria-label="Basic example" style="padding-top: 2px;">
              <button type="button" class="btn btn-primary btn" name="stampa" id="stampa" value="<?php echo "$id_album,$id_foto,stampe" ?>" onclick="stampa('stampa')">
              <abb title=”STAMPA”>(s) <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
</svg> </abb></button>
              </div>


              <div class="btn-group" role="group" aria-label="Basic example" style="padding-top: 2px;">
              <button type="button" class="btn btn-primary btn" name="reset" id="reset" value="<?php echo "$nome_foto,$sotto_cartella,$id_album" ?>" onclick="reset()">
              <abb title='AZZERA LE MODIFICHE FATTE SULLA FOTO'>(r) <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
</svg></abb> </button>
              </div> 


              <div class="btn-group" role="group" aria-label="Basic example" style="padding-top: 2px;">
                   <?php echo "  <button type=\"button\" class=\"btn btn-primary btn\" name=\"save\"
                                 onclick=\"save_img64('save_button')\" id=\"save_button\" 
                                 value=\"$id_album,$path_immagine_modificata_save,$nome_foto\"> "; ?>
                                 <abb title='SALVA'>(a)  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-floppy2-fill" viewBox="0 0 16 16">
                                 <path d="M12 2h-2v3h2z"/>
                                 <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v13A1.5 1.5 0 0 0 1.5 16h13a1.5 1.5 0 0 0 1.5-1.5V2.914a1.5 1.5 0 0 0-.44-1.06L14.147.439A1.5 1.5 0 0 0 13.086 0zM4 6a1 1 0 0 1-1-1V1h10v4a1 1 0 0 1-1 1zM3 9h10a1 1 0 0 1 1 1v5H2v-5a1 1 0 0 1 1-1"/>
                               </svg> </abb></button>
              </div> 


              <div class="btn-group" role="group" aria-label="Basic example" style="padding-top: 2px;">
              <button type="button" class="btn btn-primary btn" name="elimina_grafica" id="elimina_grafica"  onclick="inserisci('elimina_grafica','elimina_grafica','elimina_grafica')">
              <abb title='ELIMINA LA GRAFICA'>(e) <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708"/>
</svg> </abb></button>
              </div>
              <?php /* modale_foto($path_immagine_medium , $path_immagine); */ ?>
             
                 </div> 
                    </div>
                      </div> <!-- FINE SEZIONE IN BASSO PULSANTI -->