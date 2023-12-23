<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include ('header_side_live.php') ; ?>


    <main id="main" class="main" style="background-color: #bee5fc ">




    <div class="pagetitle">
      <h1>ISTRUZIONI</h1>
             <!-- Card with header and footer -->
             <div class="card">
            <div class="card-header">XAMMP</div>
            <div class="card-body">
              <h5 class="card-title">AVVIARE IN AUTOMATICO XAMPP ALL'AVVIO DI WINDOWS</h5>
              <div class="row">
                <div class="col-md-3">
                                            <!-- Card with an image on top -->
                                <div class="card">
                                  <a href="../img/xammp1.png" target="_blank">  <img src="../img/xammp1.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">SETTARE XAMPP</h5>
                                    <p class="card-text"> Aprire il programma Xammp come amministratore, clieccare su configurazione in alto a destra, sulla finestra che si apre spuntare
                                     Apache e MySql e infine premere save. Ricordarsi di fare questa operazione aprendo Xammp come amministratore.</p>
                                    </div>
                                </div><!-- End Card with an image on top -->
    
                </div>
                <div class="col-md-3">
                                   <!-- Card with an image on top -->
                                   <div class="card">
                                    <a href="../img/xammp2.png" target="_blank">  <img src="../img/xammp2.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">WINDOWS-R</h5>
                                    <p class="card-text"> Premere WINDOWS-R , si aprira la finestra come da immagine, all'interno scrivete " C:\xampp\xampp-control.exe " , 
                                        spuntate la casella dove vi chiede di dare i permessi da amministratore e premete ok. </p>
                                    </div>
                                   </div><!-- End Card with an image on top -->
                </div>
                <div class="col-md-3">
                                    <!-- Card with an image on top -->
                                   <div class="card">
                                    <a href="../img/xammp3.png" target="_blank">  <img src="../img/xammp3.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">CREA COLLEGAMENTO</h5>
                                    <p class="card-text"> Entra nella cartella di XAMPP , percorso "  C:\xampp "" , tasto destro sul file xampp-control.exe e create un nuovo collegamento.
                                    Prendi quel collegamento (facendo taglia)   </p>
                                    </div>
                                   </div><!-- End Card with an image on top -->
                </div>
                <div class="col-md-3">
                                   <!-- Card with an image on top -->
                                   <div class="card">
                                    <a href="../img/xammp4.png" target="_blank">  <img src="../img/xammp4.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">Copia nella cartella di start</h5>
                                    <p class="card-text"> Premi nuovamente WINDOWS-R e digita nella linea di comando shell:startup, digita ok e ti si aprira la cartella dell'esecuzione automatica di windows
                                        ora non ti resta che copiare il collegamento del file xampp-control.exe che hai appena tagliato e il tuo server XAMPP si avviera automaticamente con l'avvio di windows .    </p>
                                    </div>
                                   </div><!-- End Card with an image on top -->
                </div>
              </div>

           <hr>
              <h5 class="card-title">INTERRUZIONE IMPROVVISA DEL SERVER</h5>
              <div class="row">
                <div class="col-md-3">
                                            <!-- Card with an image on top -->
                                <div class="card">
                                  <a href="../img/xammp5.png" target="_blank">  <img src="../img/xammp5.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">PROBLEMI CON IL SERVER</h5>
                                    <p class="card-text"> Potrebbe capitare che il server XAMPP si interrompa inaspettatamente e ti troverai nella situazione dove vedrai solo il menù
                                        ma la parte centrale di alcune pagine del programma risulta bianca. Ciò significa che il server si è fermato per errore.
                                    </p>
                                    </div>
                                </div><!-- End Card with an image on top -->
    
                </div>
                <div class="col-md-3">
                                   <!-- Card with an image on top -->
                                   <div class="card">
                                    <a href="../img/xammp6.png" target="_blank">  <img src="../img/xammp6.png" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">SCHERMATA DI XAMPP</h5>
                                    <p class="card-text">Aprendo XAMPP noterai un messaggio di errore scritto in rosso come questo. Per prima cosa prova a premere stop sul pulsante affianco ad apache
                                        e chiudere XAMPP. Ora riaprilo come amministratore e controlla se il messaggio di errore è sparito e quindi l'app funzionerà di nuovo.  </p>
                                    </div>
                                   </div><!-- End Card with an image on top -->
                </div>
                <div class="col-md-3">
                                    <!-- Card with an image on top -->
                                   <div class="card">
                                    <a href="../img/xammp7.jpg" target="_blank">  <img src="../img/xammp7.jpg" class="card-img-top" alt="..."></a>
                                    <div class="card-body">
                                    <h5 class="card-title">RISOLVERE IL PROBLEMA DELLO SHOWDOWN</h5>
                                    <p class="card-text"> Se con il riavvio come amministratore non funziona , entra nella cartella C:\xampp\mysql ed segui attentamente i passaggi illustrati nell'immagine e tutto ripartirà   </p>
                                    </div>
                                   </div><!-- End Card with an image on top -->
                </div>
                <div class="col-md-3">
                               
                </div>
              </div>
            </div>
            <div class="card-footer">
             Seguendo queste istruzioni il tuo server partira in automatico quando avvierai il pc.
            </div>
          </div><!-- End Card with header and footer -->

</div><!--  end page title -->
</main>
</body>
</html>