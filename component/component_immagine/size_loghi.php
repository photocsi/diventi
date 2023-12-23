
<div class="row"> <!-- row per la dimensione dei loghi -->
                        <span class="badge rounded-pill bg-light text-dark" style="margin: 10px 0px 15px 0px" >Dimensione loghi</span>
                        <div class="card">
            <div class="card-body">
            <div class="row">
              <div class="col-6">
                <p>sinistra</p>
              <button type="button" class="btn btn-primary btn-sm"  id="<?php  echo $value.'sx'; ?>" 
                             value="<?php  echo $value ?>" onclick="inserisci('<?php  echo $value.'plus'; ?>','logosx','logosx')"> <i class="bi bi-plus"></i> </button>
              <button type="button" class="btn btn-primary btn-sm" id="<?php  echo $value.'dx'; ?>" 
                              value="<?php  echo $value ; ?>" onclick="inserisci('<?php  echo $value.'min' ; ?>', 'logodx','logodx')">  <i class="bi bi-dash"></i>  </button>
              - <button type="button" class="btn btn-primary btn-sm" id="nullsx" 
                              value="" onclick="inserisci('nullsx', 'logosx','logosx')">  0  </button>
                              </div>
                              <div class="col-6">
                              <p>destra</p>
              <button type="button" class="btn btn-primary btn-sm"  id="<?php  echo $value.'sx'; ?>" 
                             value="<?php  echo $value ?>" onclick="inserisci('<?php  echo $value.'plus'; ?>','logosx','logosx')"> <i class="bi bi-plus"></i> </button>
              <button type="button" class="btn btn-primary btn-sm" id="<?php  echo $value.'dx'; ?>" 
                              value="<?php  echo $value ; ?>" onclick="inserisci('<?php  echo $value.'min' ; ?>', 'logodx','logodx')">  <i class="bi bi-dash"></i>  </button>
             - <button type="button" class="btn btn-primary btn-sm" id="nulldx" 
                              value="" onclick="inserisci('nulldx', 'logodx','logodx')">  0  </button>
                              </div>
                              </div>
            </div>
          </div>     
       </div>  