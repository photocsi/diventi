
    
<?php
/* MODALE PER INGRANDIRE LA FOTO E COMPIERE OPERAZIONI */
function modale_foto($path_immagine_medium , $path_immagine_large_exif){ ?>

<!-- Extra Large Modal -->
  <!-- Extra Large Modal -->
  <button type="button"  onclick="viewImg()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
  <i class="bi bi-zoom-in"></i>
              </button>

              <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Info Foto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                      <div class="col-6" style="padding: 25px">
                   <img  src="<?php echo $path_immagine_medium ?> " style="width: 100% ; height: 100%; object-fit: contain; ">
                   </div>
                   <div class="col-6" style="padding: 25px">
                   <div class="row" style="background-color:lightcyan; padding: 25px"> <!-- riga dati exif -->
                   <h5> Dati exif foto</h5>
                      <?php $exif = exif_read_data($path_immagine_large_exif, 'IFDO');
                      if(isset($exif['UndefinedTag:0xA434'])){
                         $ottica = $exif['UndefinedTag:0xA434'];
                         }else{
                           $ottica = 'Non riconosciuta' ;
                          };
                      echo 'Nome: '.$exif['FileName'].
                         ' </br> Dimensione: '.$exif['FileSize'].'kb </br>'.
                          'Model: '.$exif['Model'].'</br>'.
                          'Ottica: '.$ottica.'</br>'.
                           'Diaframma: '.$exif['COMPUTED']['ApertureFNumber'].
                           ' </br> Tempo di scatto: '.$exif['ExposureTime'].' </br>'. 
                           'ISO: '.$exif['ISOSpeedRatings'].' </br>'. 
                           'Data: '.$exif['DateTimeOriginal'].'</br>'. 
                           'Dimensione: '.$exif['COMPUTED']['html'].'</br>'. 
                           'Risoluzione: '.$exif['XResolution'].'dpi </br>' ; 
                          
                          /*   print_r($exif); */ ?>
                          </div> <!-- fine dati exif -->
                          <div class="row" style="background-color:lightgray; padding: 25px">
                          Funzioni in lavorazione
                          </div>
                   </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Extra Large Modal-->
 




<?php }; ?>







