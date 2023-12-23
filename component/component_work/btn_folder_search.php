   <!-- inizio Card ricerca per cartella -->
   <div class="col-xxl-2 col-md-2">
                  <div class="card" style="margin: 0px">
                    <div class="card-body" style="padding-top: 20px">
                      <form class="row g-3" method="POST" action="#" >
                        <button  type="submit" name="mostra" class="btn btn-primary  btn-sm" >Mostra Foto</button>
                        <select id="inputState" class="form-select" name="cartella_scelta" style="float:left; display:block;">
    
                        <?php
                        /* il percorso dove cercare le cartelle */
                        $path="../sottocartelle";
                       /*     uso la funzione per scandire le cartelle e inserirle in un array */
                        $cartelle= mostra_cartelle($path);
                       /* creo la prima selezione */
                       echo"<option selected=\"NULL\" value=\"NULL\">seleziona cartella</option>";
                        foreach ($cartelle as $value) {
                        echo "<option value=\"$value\"> $value </option>";
                        }
                       ?>
                     </select>
            
               <!-- selezione seconda cartella -->
               <select id="inputState" class="form-select" name="cartella_scelta2" style="float:left; display:block;">
                       <option selected="NULL" value="NULL">seleziona cartella</option>
                        <?php foreach ($cartelle as $value) {
                        echo "<option value=\"$value\"> $value </option>";
                        }?>
                     </select>  
                  </form>
                  </div></div> </div>
            <!--       fine ricerca per cartella -->