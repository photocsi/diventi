<!--   ICONE PER DIMENSIONARE LE IMMAGINI -->
    
<div class="col-xxl-2 col-md-2">
                  <div class="card" style="margin: 0px">
                    <div class="card-body" style="padding-top: 20px">
                      <form class="row g-3" method="POST" action="#" >
                        <button  type="submit" name="rename" class="btn btn-primary  btn-sm" >Rinomina cartella</button>
                        <select id="inputState" class="form-select" name="cartella_rename" style="float:left; display:block;">
    
                        <?php
                        /* il percorso dove cercare le cartelle */
                        $path="../sottocartelle";
                       /*     uso la funzione per scandire le cartelle e inserirle in un array */
                        $cartelle= mostra_cartelle($path);
                       /* creo la prima selezione */
                       echo"<option selected=\"NULL\" value=\"NULL\" >seleziona cartella</option>";
                        foreach ($cartelle as $value) {
                        echo "<option value=\"$value\"> $value </option>";
                        }
                       ?>
                     </select>

                     <input type="text" name="cartella_newname" value="" placeholder="nuovo nome">
                      </form>
    
        </div></div></div>