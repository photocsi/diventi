<!-- inizio Card ricerca dei preferiti dei clienti -->
<div class="col-xxl-2 col-md-2">
                  
                  <div class="card" style="margin: 0px">
                <div class="card-body" style="padding-top: 20px">
                
                  <!-- No Labels Form -->
                  <form class="row g-3" method="POST" action="#" >
                <!--  BOTTONE PER ELIMINARE LA SELEZIONE -->
                <button  type="submit" name="cliente_servito" value='' class="btn btn-danger  btn-sm" >Cliente servito</button>
                   
                    <select id="inputState" class="form-select" name="scelta_cliente" value="NULL" style="float:left; display:block;">
    
            <?php
       $clienti=prendi_clienti($id_album);
        
               
            /* creo la prima selezione */
              echo"<option selected=\"NULL\" value=\"NULL\">seleziona cliente</option>";
            while($row=$clienti->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value=\"{$row['nome_cliente']},{$row['id_cliente']}\"> {$row['nome_cliente']} </option>";
                
              }
              ?>
                 </select>
                 <button  type="submit" name="mostra_cliente"  class="btn btn-primary  btn-sm" >Mostra Cliente</button>
            
            
                   
                  </form>
                  </div></div> </div>