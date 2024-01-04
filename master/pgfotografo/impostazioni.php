<?php
$id_album=80 ;
$nome_album="citua"                                                                ;



ob_start();
session_start();
if(isset($_GET['id_album'])){
$id_album=$_GET['id_album'];
}
$_SESSION['id_album']=$id_album;
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
    $db_class = new DB_CSI;
    $field = ['id_cliente', 'nome_cliente'];
    $table = '1clienti';
    $where = ['id_album', 'ruolo'];
    $value = [$id_album, 'operatore'];
    $lista_op = $db_class->select_2where($field, $table, $where, $value);

    if (!isset($id_operatore)) {
        $id_operatore = $lista_op[0]['id_cliente'];
        $nome_operatore = $lista_op[0]['nome_cliente'];
        setcookie("id_operatore", $id_operatore, time() + (86400));
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST' && is_string($_POST['dati_operatore'])) {
        $array_op = explode(',', $_POST['dati_operatore']);
        $id_operatore = $array_op[0];
        $nome_operatore = $array_op[1];
        setcookie("id_operatore", $id_operatore, time() + (86400));
        setcookie("nome_operatore", $nome_operatore, time() + (86400));
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
                                            <a href="<?php echo D20.'/live/modifica_album.php' ?>"> <button class="nav-link w-100 " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true" >Modifica Album</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="report.php"> <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="report" aria-selected="false">Report</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="#"> <button class="nav-link w-100 active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Impostazioni</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="gestione_clienti.php"> <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Clienti</button></a>
                                        </li>
                                    </ul>
 <!--   INIZIO CONTENUTO INTERNO CON LE VARIE OPZIONI ALBUM -->
 <div class="row">
                                        <div class="alert alert-primary" style="text-align: center; margin-top: 5px" role="alert">
                                            <b> <i class="bi bi-gear"></i> <i class="bi bi-book"></i> PREFERENZE ALBUM </b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <form class="row gy-2 gx-3 align-items-center" action="#" method="post">
                                                <div class="col-7">
                                                    <select class="form-select" id="inputName" name="dati_operatore">
                                                        <?php
                                                        echo "  <option value=$id_operatore,$nome_operatore>$nome_operatore</option>";
                                                        for ($i = 0; $i < count($lista_op); $i++) {
                                                            echo "  <option value={$lista_op[$i]['id_cliente']},{$lista_op[$i]['nome_cliente']}>{$lista_op[$i]['nome_cliente']}</option>";
                                                        }



                                                        ?>

                                                    </select>
                                                </div>
                                                <div class="col-5">
                                                    <button type="submit" class="btn btn-primary">Seleziona Operatore</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-6" style="text-align:center ">
                                          
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="row">
                                        <span class="badge bg-primary"><i class="bi bi-gear"></i> <i class="bi bi-person-badge"></i> PAGINE CLIENTI</span>
                                        <hr>
                                        <!--  INIZIO SCELTA PREFERITI -->
                                        <div class="col-4" style="border-right: 2px solid #bbb; background-color:aliceblue ">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check form-switch ">
                                                        <!--  //controllo il valore delle opzioni inserite nella tabella album e mostro il pulsante come selezionato o deselezionato -->
                                                        <?php $check = controlla_opzioni($id_album, 's');
                                                        if ($check == TRUE) $check = "checked ";
                                                        else echo $check = ""; ?>
                                                        <input class="form-check-input" type="checkbox" id="s-<?php echo $id_album ?>" onclick="selezione('s-<?php echo $id_album; ?>')" name="impostazioni" <?php echo $check ?>>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <b><label class="form-check-label" for="flexSwitchCheckDefault">Selezione</label></b>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  FINE SCELTA PREFERITI -->

                                        <!--  INIZIO SCELTA CARRELLO -->
                                        <div class="col-4" style="border-right: 2px solid #bbb;">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check form-switch ">
                                                        <?php $check = controlla_opzioni($id_album, 'c');
                                                        if ($check == TRUE) $check = "checked ";
                                                        else echo $check = ""; ?>
                                                        <input class="form-check-input" type="checkbox" id="c-<?php echo $id_album ?>" onclick="selezione('c-<?php echo $id_album ?>')" name="impostazioni" <?php echo $check ?>>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <b><label class="form-check-label" for="mySwitch">Carrello</label></b>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  FINE SCELTA CARRELLO -->

                                        <!--  INIZIO SCELTA MESSAGGIO -->
                                        <div class="col-4" style="border-right: 2px solid #bbb; background-color:aliceblue">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check form-switch ">
                                                        <?php $check = controlla_opzioni($id_album, 'm');
                                                        if ($check == TRUE) $check = "checked ";
                                                        else echo $check = ""; ?>
                                                        <input class="form-check-input" type="checkbox" id="m-<?php echo $id_album ?>" onclick="selezione('m-<?php echo $id_album ?>')" name="impostazioni" <?php echo $check ?>>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <b><label class="form-check-label" for="flexSwitchCheckDefault">Messaggio</label></b>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!--  FINE SCELTA MESSAGGIO -->

                                        <!--  INIZIO SCELTA DOWNLOAD -->
                                        <div class="col-4" style="border-right: 2px solid #bbb;">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check form-switch ">
                                                        <?php $check = controlla_opzioni($id_album, 'd');
                                                        if ($check == TRUE) $check = "checked ";
                                                        else echo $check = ""; ?>
                                                        <input class="form-check-input" type="checkbox" id="d-<?php echo $id_album ?>" onclick="selezione('d-<?php echo $id_album ?>')" name="impostazioni" <?php echo $check ?>>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <b><label class="form-check-label" for="flexSwitchCheckDefault">Download</label></b>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  FINE SCELTA DOWNLOAD -->

                                        <!--  INIZIO SCELTA WATERMARK -->
                                        <div class="col-4" style="border-right: 2px solid #bbb; background-color:aliceblue">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check form-switch ">
                                                        <?php $check = controlla_opzioni($id_album, 'w');
                                                        if ($check == TRUE) $check = "checked ";
                                                        else echo $check = ""; ?>
                                                        <input class="form-check-input" type="checkbox" id="w-<?php echo $id_album ?>" onclick="selezione('w-<?php echo $id_album ?>')" name="impostazioni" <?php echo $check ?>>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <b><label class="form-check-label" for="flexSwitchCheckDefault">Watermark</label></b>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!--  FINE SCELTA WATERMARK-->


                                    <!--   *******************************************
                                           ************* CANCELLA ALBUM **************
                                           ******************************************* -->
                                    <div class="row" style="margin-top: 80px;">
                                        <span class="badge bg-danger"><i class="bi bi-gear"></i> <i class="bi bi-exclamation-octagon"></i> ELIMINA ALBUM</span>
                                        <hr>
                                        </br>
                                        <?php $path_cartella = "../"  ?> <!-- INIZIO PULSANTE CANCELLA ALBUM -->
                                        <!-- General Form Elements -->
                                        <div class="card-body row align-items-center" style="border: 1px solid red ; padding-top: 1rem ; text-align: center ; border-radius: 30px ; margin: 1rem ;">
                                            <div class="col-12">
                                                <h4>ELIMINA ALBUM</h4>
                                                <p style="color: white; background-color:brown">Attenzione eliminando l'album cancellerai tutte le foto e i clienti ad esso registrati</p>
                                                <form id="modulo" action="../../../function/cancella_album.php" method="GET">
                                                    <input type="input" name="id" value="<?php echo $id_album ?>" readonly><i class="bi bi-trash"></i>
                                                    <input type="input" name="cancella" id="cancella" placeholder="scrivi: cancella album" onfocus="resetta()"><i class="bi bi-trash"></i>

                                                </form>
                                                <small>Scrivi qui "cancella album live" </small>
                                                <p> <b>Stai eliminando definitivamente l'album </br> "<?php echo $id_album  ?>"</b> </p>

                                                <!--  Passa prima dalla funzione JS e da li alla pagina  cancella album che si trova all'interno di funzioni-->
                                                <button onclick="conferma_cancellazione_album()" class="btn btn-outline-danger btn-sm">Conferma cancellazione</button>
                                            </div>

                                            <div id="console">

                                            </div>

                                        </div>
                                        <!--  FINE PULSANTE CANCELLA ALBUM -->
                                    </div>
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