<?php
    $id_album=7                     ;




session_start();
if(!isset($_SESSION['user_fotografo']) ){
    header('Location: ../../../index.php');
}


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Album - Total Photo</title>
    <script src="../../../function/funzioni_js.js"></script>
</head>

<body>

<!-- CODICE PHP -->
<!-- prime interrogazioni al db per creare la lista clienti -->
<?php
include('../../../function/funzioni_album.php');
include('../../../config_pdo.php');
$array_clienti=lista_clienti($id_album);
 

include('header_side.php');
?>

    <main id="main" class="main" style="background-color: #bee5fc;" >

        <!-- <div class="pagetitle">
            <h1>Carica immagini </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="basic.php">Home</a></li>
                    <li class="breadcrumb-item active">Carica Immagini</li>
                </ol>
            </nav>
        </div> --><!-- End Page Title -->

        <section class="section" >
            <div class="row"> <!-- INIZIO ROW PAGINA TOTALE -->
                <div class="col-lg-8" id="centrale">
                    <div class="card"> <!-- INIZIO CARD PARTE SINISTRA -->
                        <div class="card-body"> <!-- INIZIO CARD BODY PARTE SINISTRA -->
                            <div class="row"> <!-- INIZIO ROW BARRA IN ALTO -->
                                <div class="col">
                            <h6 class="card-title">Gestione Clienti</h6></div>
                            <div class="col">
                          <a href="work.php">  <button type="button" style="margin-top: 1rem;" class="btn btn-outline-success btn-sm">
                          "Vai nell'area di lavoro" </button></a></div>
                            <div class="col">
                            <div class="form-check form-switch form-check-reverse">
                            <label class="form-check-label" for="flexSwitchCheckDefault">mostra/nascondi anteprima</label>
                      <input class="form-check-input" type="checkbox" id="mostra" onclick="nascondi_anteprima()" checked>
                    </div>
                     </div>
                    </div> <!-- FINE ROW BARRA IN ALTO -->


                            <!-- inizio tab menu  -->
                            <div class="card"> <!-- INIZIO CARD MADRE DI SINISTRA -->
                                <div class="card-body">

                                    
                                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="modifica_album.php"> <button class="nav-link w-100 " id="home-tab"
                                                    data-bs-toggle="tab" data-bs-target="#bordered-justified-home"
                                                    type="button" role="tab" aria-controls="home"
                                                    aria-selected="true" disabled>Modifica Album</button></a>
                                        </li>
                                      
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="impostazioni.php"> <button class="nav-link w-100 " id="contact-tab"
                                                    data-bs-toggle="tab" data-bs-target="#bordered-justified-contact"
                                                    type="button" role="tab" aria-controls="contact"
                                                    aria-selected="false">Impostazioni</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="#"> <button class="nav-link w-100 active" id="contact-tab"
                                                    data-bs-toggle="tab" data-bs-target="#bordered-justified-contact"
                                                    type="button" role="tab" aria-controls="contact"
                                                    aria-selected="false">Clienti</button></a>
                                        </li>
                                    </ul>

                                    <!-- fine tab alti -->
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                                        </div>    </div>
                                            <!-- contenuto tab -->

                                            <!-- INIZIO GESTIONE CLIENTI -->
                                            <!-- Link per l'invio al cliente -->
                                    
                                            <?php $link_clienti="localhost/diventi/album/$id_album/pgcliente/index.php" ;
                                            $link_locale="/diventi/album/$id_album/pgcliente/index.php" ; ?>
                                            

                                                 <!-- CARD INIZIO LINK CLIENTI -->

                                                 <div class="row row-cols-1 row-cols-md-2 g-4">
                                                <div class="col">
                                                    <div class="card h-100">
                                                    <div class="card-body">
                                                        <h5 class="card-title">ONLINE</h5>                           
                                                            <input id="area" type="text" size="10" class="form-control"  value="<?php echo $link_clienti ?>" disabled></input>
                                                                                                        
                                                    </div>
                                                    <div class="card-footer">
                                                    <label class="col-sm-2 col-form-label"><button class="btn btn-outline-success btn-sm"   onclick="copia('area')">copia</button></label>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card h-100">
                                                    <div class="card-body">
                                                        <h5 class="card-title">IN LOCALE</h5>
                                                    <div class="row g-3">
                                                        <div class="col-md-12">
                                                    <input id="link_locale" type="text" size="10" class="form-control" value="" disabled></input>
                                                </div>
                                                <div class="col-md-8">
                                                            <input type="text" id="link_rete" onchange="link_locale('link_rete', '<?php echo $link_locale ?>' , 'link_locale')" 
                                                            style="border-radius: 5px ; border-color: green " placeholder="Inserisci indirizzo di rete" value="" ></input>
                                                </div> 
                                                <div class="col-md-4">
                                                    <button class="btn btn-outline-success btn-sm">INVIA</button> 
                                                
                                                </div>                 

                                                </div>                                 
                                                </div>
                                                <div class="card-footer">
                                                <label class="col-sm-2 col-form-label"><button class="btn btn-outline-success btn-sm"   onclick="copia('link_locale')">copia</button></label>
                                                <button class="btn btn-outline-success btn-sm">CREA QRCODE</button> 
                                                </div>
                                                </div>
                                            </div>
                                            </div>

                                            <!-- END LINK CLIENTI -->
                </div>
                </div> <!-- FINE CARD MADRE DI SNISTRA -->
 
           
     <?php      /*    seleziono i dati di ogni cliente per visualizzare la lista dei clienti a schermo*/
                    foreach ($array_clienti as $valore) {
                    $select=$conn->prepare("SELECT * FROM 1clienti WHERE id_cliente= :valore;");
                    $select->bindParam(':valore', $valore);
                       $select->execute();
                   while($row=$select->fetch(PDO::FETCH_ASSOC)){
                    $nome_cliente=$row['nome_cliente']; $email_cliente=$row['email_cliente']; $telefono_cliente=$row['telefono_cliente'];
                    $conferma_selezione=$row['conferma_preferiti']; $numero_selezione=$row['numero_preferiti'];
    /*  MODALE CON LA LISTA CLIENTI */
                    modale_cliente($nome_cliente,$email_cliente,$telefono_cliente,$conferma_selezione,$numero_selezione,$id_album,$valore,$id_album);     
                }   
          }       ?>

                                    <!--  FINE GESTIONE CLIENTI -->
   </div> <!-- FINE CARD BODY PARTE SINISTRA -->
 </div> <!-- FINE CARD PARTE SINISTRA -->
</div> <!-- fine contenuto tab -->
                
                <!--       sezione anteprima album -->
                <?php   include('anteprima_album.php'); ?>
                <!--   fine anteprima album -->

            </div> <!-- FINE ROW PAGINA TOTALE -->
        </section>
       
        <?php include ('../../../component/sezione_controllo.php'); ?>

    </main><!-- End #main -->

    <?php include('../../../live/footer_live.html');  ?>

    <script>
        function link_locale(make_id, text, destinazion){
            locale= document.getElementById(make_id).value + text ;
            document.getElementById(destinazion).value = locale;
            localStorage["link_locale"]= locale;
            console.log(localStorage.getItem("link_locale"));

        }

        addEventListener("load", myFunction);

function myFunction() {
  console.log(localStorage.getItem("link_locale"));
  document.getElementById("link_locale").value = localStorage.getItem("link_locale");
}
    </script>


    <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>
</body>

</html>