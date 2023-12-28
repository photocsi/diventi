<?php
session_start();
if (!isset($_SESSION['user_fotografo'])) {
    header('Location: ../login.php');
} else {
    include('../function/funzioni_album.php');
    resetta_sessioni();
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>crea album - Total Photo</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
</head>

<body>
    <!-- -START PHP CODE- -->
    <!-- CREO L'ALBUM NEL DB -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('../function/creazione_album.php');
        crea_album();
    }
    include('header_side_live.php');
    ?>

    <!--   -END PHP CODE- -->
    <main id="main" class="main" style="background-color: #bee5fc ">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informazioni Principali</h5>

                            <div class="card">
                                <div class="card-body">

                                    <!-- Bordered Tabs Justified -->
                                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                        <li class="nav-item flex-fill" role="presentation">
                                            <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                                <h5><b>Crea Album</b></h5>
                                            </button>
                                        </li>

                                    </ul>
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">
                                            <!--      CONTENUTO TAB -->


                                            <!-- Form di compilazione dati -->
                                            <form action="#" method="POST" enctype="multipart/form-data">
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-2 col-form-label">Nome Album</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="nome" class="form-control" maxlength="30" required>
                                                    </div>

                                                    <label for="inputText" class="col-sm-2 col-form-label">Sottotitolo</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="sottotitolo" class="form-control" maxlength="30">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Categoria Servizio</label>
                                                    <div class="col-sm-4">
                                                        <select class="form-select" name="categoria" aria-label="Default select example">
                                                            <option selected>scegli il tipo di servizio</option>
                                                            <option value="matrimonio">Matrimonio</option>
                                                            <option value="gravidanza">Gravidanza</option>
                                                            <option value="newborn">New Born</option>
                                                            <option value="battesimo">Battesimo</option>
                                                            <option value="comunione">Comunione</option>
                                                            <option value="cresima">Cresima</option>
                                                            <option value="ritratto">Ritratto</option>
                                                            <option value="ecommerce">E-commerce</option>
                                                            <option value="stilllife">Still-life</option>
                                                            <option value="immobiliare">Immobiliare</option>
                                                            <option value="reportage">Reportage</option>
                                                            <option value="giornalismo">Giornalismo</option>
                                                            <option value="sport">Sport</option>
                                                        </select>
                                                    </div>
                                                    <label for="inputDate" class="col-sm-2 col-form-label">Data</label>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="data_album" class="form-control">
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="inputNumber" class="col-sm-2 col-form-label">Carica
                                                        Copertina</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="file" name="file" accept=".jpg" required>
                                                    </div>
                                                    <label for="inputDate" class="col-sm-2 col-form-label">Cartella Locale</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="path_hd" class="form-control" disabled>
                                                    </div>
                                                </div>



                                                <div class="row mb-3">
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Note Album</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" name="note" style="height: 100px"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 1" required >
                                                    </div>
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 2">
                                                    </div>
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 3">
                                                    </div>
                                                    
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 4">
                                                    </div>
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 5">
                                                    </div>
                                                    <div class="col-2">
                                                    <input type="text" class="form-control" name="operatore[]" placeholder="operatore 6">
                                                    </div></div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Crea l'Album</label>
                                                    <div class="col-sm-10">
                                                        <button type="submit" class="btn btn-primary">Crea l'Album</button>
                                                    </div>
                                                </div>
                                            </form><!-- End General Form Elements -->
                                        </div>
                                    </div><!-- End Bordered Tabs Justified -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            </div>

            </div>
            </div>
        </section>

        <?php include('../component/sezione_controllo.php'); ?>

    </main><!-- End #main -->

    <?php include('footer_live.html'); ?>

</body>

</html>