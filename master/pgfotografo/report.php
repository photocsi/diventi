<?php
$id_album = 37                             ;




ob_start();
session_start();

if (!isset($_SESSION['user_fotografo'])) {
    header('Location: ../../../index.php');
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Album - Tardis Photo CSI</title>
    <script type="text/javascript" src="../../../function/funzioni_js.js"></script>

</head>

<body>

    <?php
    include('../../../main.php');
    include(D20DIR.'/function/funzioni_album.php');
    include(D20DIR.'/config_pdo.php');
    include('header_side.php');
    require_once '../../../includes/db_pdo-class.php';
    require_once '../../../includes/button-class.php';
    require_once '../../../includes/input-class.php';

    $button = new BUTTON_CSI;
    $report = new INPUT_CSI($id_album);
    $db_class = new DB_CSI;


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['report'])) {

        $luogo = $_POST['luogo'];
        $societa = $_POST['societa'];
        $sport = $_POST['sport'];
        $categoria = $_POST['categoria'];
        $royalti = $_POST['royalty'];
        $royalti_fissa = $_POST['royalty_fissa'];
        $costo_a5 = $_POST['costo_a5'];
        $costo_a4 = $_POST['costo_a4'];
        $costo_file = $_POST['costo_file'];
        $costo_cd = $_POST['costo_cd'];
        $viaggio = $_POST['viaggio'];
        $albergo = $_POST['albergo'];
        $sconti = $_POST['sconti'];
        $varie = $_POST['varie'];
        $omaggi = $_POST['omaggi'];
        $pacchetti = $_POST['pacchetti'];
        $a51 = $_POST['a51'];
        $a51f = $_POST['a51f'];
        $a52 = $_POST['a52'];
        $a52f = $_POST['a52f'];
        $a53 = $_POST['a53'];
        $a53f = $_POST['a53f'];
        $a4 = $_POST['a4'];
        $a4f = $_POST['a4f'];
        $dati_operatore = $_POST['dati_operatore'];
        $stipendio = $_POST['stipendio'];
        $percentuale = $_POST['percentuale'];
        $tasse = $_POST['a52f'];
        $dottore = $_POST['a53'];
        $assistente = $_POST['a53f'];
        $note = $_POST['a4'];

        $db_class->update('1report','luogo',$luogo,'id_album',$id_album);
        $db_class->update('1report','societa',$societa,'id_album',$id_album);
       
       
    }



    ?>

    <main id="main" class="main" style="background-color: #bee5fc ">

        <section class="section">
            <div class="row">

                <div class="col-lg-8" id="centrale">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title">Impostazioni Album </h5>
                                </div>
                                <div class="col">
                                    <a href="work.php"> <button type="button" style="margin-top: 1rem;" class="btn btn-outline-success btn-sm">
                                            "Vai nell'area di lavoro" </button></a>
                                </div>
                                <div class="col">
                                    <div class="form-check form-switch form-check-reverse">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">mostra/nascondi anteprima</label>
                                        <input class="form-check-input" type="checkbox" id="mostra" onclick="nascondi_anteprima()" checked>
                                    </div>

                                </div>
                            </div>
                            <!-- inizio tab menu sopra il form -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Bordered Tabs Justified -->
                                    <ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="<?php echo D20.'/live/modifica_album.php' ?>"> <button class="nav-link w-100 " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true">Modifica Album</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="#"> <button class="nav-link w-100 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="report" aria-selected="false">Report</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="impostazioni.php"> <button class="nav-link w-100 " id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Impostazioni</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="gestione_clienti.php"> <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Clienti</button></a>
                                        </li>
                                    </ul>

                                    <hr>

                                    <?php $report->form_start(); ?>
                                    <div class="col-6">

                                        <div class="card" style="border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Info gara</h5>
                                                <hr>
                                            </div>
                                            <div class="card-body ">
                                                <?php
                                                $report->input_text('Luogo', 'luogo');
                                                $report->input_text('Società', 'societa');
                                                $report->input_text('Sport', 'sport');
                                                $report->input_text('Categoria', 'categoria');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card" style=" border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Royalti</h5>
                                                <hr>
                                                <div class="card-body" style="text-align: start;">
                                                    <?php
                                                    $report->input_number('royalty a foto', 'royalty', 'Euro');
                                                    $report->input_number('royalty fissa', 'royalty_fissa', 'Euro');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card " style=" border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Prezzi</h5>
                                                <hr>
                                                <div class="card-body" style="text-align: start;">
                                                    <?php
                                                    $report->input_number('Prezzo stampa A5', 'costo_a5', 'Euro');
                                                    $report->input_number('Prezzo stampa A4', 'costo_a4', 'Euro');
                                                    $report->input_number('Prezzo file singolo', 'costo_file', 'Euro');
                                                    $report->input_number('Prezzo pacchetto file', 'costo_cd', 'Euro');
                                                    ?>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card " style="border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Spese</h5>
                                                <hr>
                                                <div class="card-body " style="text-align: start;">
                                                    <?php
                                                    $report->input_number('Viaggio', 'viaggio', 'Euro');
                                                    $report->input_number('Albergo', 'albergo', 'Euro');
                                                    $report->input_number('Sconti', 'sconti', 'Euro');
                                                    $report->input_number('Spese varie', 'varie', 'Euro');
                                                    $report->input_number('Omaggi', 'omaggi', 'Foto');
                                                    $report->input_number('Pacchetti', 'pacchetti', 'Offerte');

                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- *********************************************************
***************COLONNA DESTRA****************************
********************************************************* -->
                                    <div class="col-6">
                                        <div class="card " style=" border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Report Stampanti</h5>
                                                <hr>
                                            </div>
                                            <div class="card-body text-left">
                                                <?php
                                                $report->input_print('A5 1', 'a51', 'a51f');
                                                $report->input_print('A5 2', 'a52', 'a52f');
                                                $report->input_print('A5 3', 'a53', 'a53f');
                                                $report->input_print('A4', 'a4', 'a4f');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card " style="border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Personale</h5>
                                                <hr>
                                            </div>
                                            <div class="card-body text-left">
                                                <?php
                                                $report->op('1report.id_op1');
                                                $report->op('1report.id_op2');
                                                $report->op('1report.id_op3');
                                                $report->op('1report.id_op4');
                                                $report->op('1report.id_op5');
                                                $report->op('1report.id_op6');
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card " style="border: 1px solid #0d6efd ">
                                            <div class="text-center">
                                                <h5 style="margin-top:10px">Varie</h5>
                                                <hr>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                $report->input_select('Tasse', 'tasse', '25', '30', '-', '%');
                                                $report->input_select('Dottore', 'dottore', '40', '50', '-', '%');
                                                $report->input_select('Assistente', 'assistente', '6', '-', '-', '%');

                                                ?>
                                            </div>
                                        </div>


                                    </div><!--  end colonna destra -->

                                    <div class="card" style="background-color:aliceblue ; border: 1px solid #0d6efd ">
                                        <div class="text-center">
                                            <h5 style="margin-top:10px">Note</h5>
                                            <hr>
                                            <div class="card-body text-left">
                                                <?php
                                                $report->input_textarea('Note', 'note');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $report->submit('report', 'Salva Info'); ?>



                                </div>
                            </div>
                        </div>
                    </div><!-- fine contenuto tab -->
                </div>


                <!--       sezione anteprima album -->
                <?php include('anteprima_album.php'); ?>

                <!--   fine anteprima album -->


            </div>
        </section>

        <?php include('../../../component/sezione_controllo.php'); ?>



    </main><!-- End #main -->

    <?php include('../../../live/footer_live.html');  ?>


    <script type="text/javascript" src="../../../script/jquery-3.7.1.min.js"></script>


</body>

</html>