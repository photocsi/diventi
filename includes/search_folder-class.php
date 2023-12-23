<?php

class SearchFolder
{
    function __construct()
    {
        $this->offcanvas();
    }

    public function offcanvas()
    { ?>
        <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            SELEZIONA CARTELLE
        </a>
        

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                


               
                  <div class="card" style="margin: 0px">
                    <div class="card-body" style="padding-top: 20px">
                      <form class="row g-3" method="POST" action="#" >
                        <button  type="submit" name="mostra" class="btn btn-primary  btn-sm" >Mostra Foto</button>
                        <select id="inputState" class="form-select" name="cartella_scelta[]" style="float:left; display:block;" size="20" multiple>
    
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
            
                  </form>
                  </div></div> 


               
                <div class="dropdown mt-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Dropdown button
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>

<?php




    }

    public function ExtractFolders(){
        
    }
}
