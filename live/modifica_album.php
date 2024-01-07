<?php

session_start();
$id_album = $_SESSION['id_album'];
$id_fotografo =$_SESSION['id_fotografo'];
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
    <title>Modifica Album - Total Photo</title>
    <script src="../function/funzioni_js.js"></script>
</head>

<body>

    <!-- CODICE PHP -->
    <!-- prime interrogazioni al db per creare la lista clienti -->
    <?php
    include('../main.php');
    include(D20DIR . '/function/funzioni_album.php');
    require_once '../includes/db_pdo-class.php';
    require_once '../includes/button-class.php';
    require_once '../includes/input-class.php';

    $button = new BUTTON_CSI;
    $report = new INPUT_CSI($id_album);
    $db_class = new DB_CSI;


    require_once 'header_side.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['modifica_album']) && $_POST['nome'] != null) {
            $nome_album = $_POST['nome'];
            $sottotitolo = $_POST['sottotitolo'];
            $categoria = $_POST['categoria'];
            $data = $_POST['data_album'];
            $note = $_POST['note'];
           /*  prendo gli id degli operatori */
            $op1=$_POST['operatore'][0];
            $op2=$_POST['operatore'][1];
            $op3=$_POST['operatore'][2];
            $op4=$_POST['operatore'][3];
            $op5=$_POST['operatore'][4];
            $op6=$_POST['operatore'][5];
             $db_class->update('1album','nome',$nome_album,'id_album',$id_album);
             $db_class->update('1album','sottotitolo',$sottotitolo,'id_album',$id_album);
             $db_class->update('1album','categoria',$categoria,'id_album',$id_album);
             $db_class->update('1album','data_album',$data,'id_album',$id_album);  
             $db_class->update('1album','note',$note,'id_album',$id_album);

             $op=$_SESSION['op'];  /* prendo i nomi degli operatori */
            /*  primo operatore obbligatorio cambio direttamente il nome nella tabella clienti */
             $db_class->update('1clienti','nome_cliente',$op1,'id_cliente',$op[0]['id_op1']);

           /*   dal secondo in poi prima controllo se è stato inserito, quindi se c'e' il nome e l'id */
             if(isset($op2) && $op2 != null && $op[0]['id_op2'] == null){
               /* se dunque era un campo vuoto aggiungo un nuovo operatore nella tabella clienti e inserisco il nuovo id nella tabella report */
                $db_class->insert('1clienti',array('id_album','id_fotografo','nome_cliente','ruolo'), array($id_album,$id_fotografo,$op2,'operatore'));
                $new_id=$db_class->select_order('1clienti',array('id_cliente'),'1',array('id_album','nome_cliente','ruolo'),array($id_album,$op2,'operatore'),'DESC');
                $id_new_cliente=$new_id[0]['id_cliente'];
                $db_class->update('1report','id_op2',$id_new_cliente,'id_album',$id_album);
             } else{          /* altrimenti con l'operatore gia inserito vado a modificare solo il nome */
                $db_class->update('1clienti','nome_cliente',$op2,'id_cliente',$op[0]['id_op2']);
             }

             if(isset($op3) && $op3 != null && $op[0]['id_op3'] == null){
                /* se dunque era un campo vuoto aggiungo un nuovo operatore nella tabella clienti e inserisco il nuovo id nella tabella report */
                 $db_class->insert('1clienti',array('id_album','id_fotografo','nome_cliente','ruolo'), array($id_album,$id_fotografo,$op3,'operatore'));
                 $new_id=$db_class->select_order('1clienti',array('id_cliente'),'1',array('id_album','nome_cliente','ruolo'),array($id_album,$op3,'operatore'),'DESC');
                 $id_new_cliente=$new_id[0]['id_cliente'];
                 $db_class->update('1report','id_op3',$id_new_cliente,'id_album',$id_album);
              } else{          /* altrimenti con l'operatore gia inserito vado a modificare solo il nome */
                 $db_class->update('1clienti','nome_cliente',$op3,'id_cliente',$op[0]['id_op3']);

              } if(isset($op4) && $op4 != null && $op[0]['id_op4'] == null){
                /* se dunque era un campo vuoto aggiungo un nuovo operatore nella tabella clienti e inserisco il nuovo id nella tabella report */
                 $db_class->insert('1clienti',array('id_album','id_fotografo','nome_cliente','ruolo'), array($id_album,$id_fotografo,$op4,'operatore'));
                 $new_id=$db_class->select_order('1clienti',array('id_cliente'),'1',array('id_album','nome_cliente','ruolo'),array($id_album,$op4,'operatore'),'DESC');
                 $id_new_cliente=$new_id[0]['id_cliente'];
                 $db_class->update('1report','id_op4',$id_new_cliente,'id_album',$id_album);
              } else{          /* altrimenti con l'operatore gia inserito vado a modificare solo il nome */
                 $db_class->update('1clienti','nome_cliente',$op4,'id_cliente',$op[0]['id_op4']);

              } if(isset($op5) && $op5 != null && $op[0]['id_op5'] == null){
                /* se dunque era un campo vuoto aggiungo un nuovo operatore nella tabella clienti e inserisco il nuovo id nella tabella report */
                 $db_class->insert('1clienti',array('id_album','id_fotografo','nome_cliente','ruolo'), array($id_album,$id_fotografo,$op5,'operatore'));
                 $new_id=$db_class->select_order('1clienti',array('id_cliente'),'1',array('id_album','nome_cliente','ruolo'),array($id_album,$op5,'operatore'),'DESC');
                 $id_new_cliente=$new_id[0]['id_cliente'];
                 $db_class->update('1report','id_op5',$id_new_cliente,'id_album',$id_album);
              } else{          /* altrimenti con l'operatore gia inserito vado a modificare solo il nome */
                 $db_class->update('1clienti','nome_cliente',$op5,'id_cliente',$op[0]['id_op5']);

              } if(isset($op6) && $op6 != null && $op[0]['id_op6'] == null){
                /* se dunque era un campo vuoto aggiungo un nuovo operatore nella tabella clienti e inserisco il nuovo id nella tabella report */
                 $db_class->insert('1clienti',array('id_album','id_fotografo','nome_cliente','ruolo'), array($id_album,$id_fotografo,$op6,'operatore'));
                 $new_id=$db_class->select_order('1clienti',array('id_cliente'),'1',array('id_album','nome_cliente','ruolo'),array($id_album,$op6,'operatore'),'DESC');
                 $id_new_cliente=$new_id[0]['id_cliente'];
                 $db_class->update('1report','id_op6',$id_new_cliente,'id_album',$id_album);
              } else{          /* altrimenti con l'operatore gia inserito vado a modificare solo il nome */
                 $db_class->update('1clienti','nome_cliente',$op6,'id_cliente',$op[0]['id_op6']);
              }
             
         /*  *******************************************************************
             ************************MI DEVO RICORDARE**************************
             ***ricordarsi di scrivere il codice per eliminare i record dalla **
             **tabella clienti nel caso in cui il nome venga eliminatodal form**
             **quindi se un nome viene cancellato togliere l'id operatore e **
             **e il cliente nella tabella clienti*******************************
             ******************************************************************** */
        }
    }

    ?>

    <main id="main" class="main" style="background-color: #bee5fc;">

        <section class="section">
            <div class="row"> <!-- INIZIO ROW PAGINA TOTALE -->
                <div class="col-lg-8" id="centrale">
                    <div class="card"> <!-- INIZIO CARD PARTE SINISTRA -->
                        <div class="card-body"> <!-- INIZIO CARD BODY PARTE SINISTRA -->
                            <div class="row"> <!-- INIZIO ROW BARRA IN ALTO -->
                                <div class="col">
                                    <h6 class="card-title">Gestione Clienti</h6>
                                </div>
                                <div class="col">
                                    <a href="<?php echo "../album/$id_album/pgfotografo/work.php" ?>"> <button type="button" style="margin-top: 1rem;" class="btn btn-outline-success btn-sm">
                                            "Vai nell'area di lavoro" </button></a>
                                </div>
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
                                            <a href="modifica_album.php"> <button class="nav-link w-100 active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-home" type="button" role="tab" aria-controls="home" aria-selected="true" disabled>Modifica Album</button></a>
                                        </li>

                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="<?php echo "../album/$id_album/pgfotografo/report.php" ?>"> <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="report" aria-selected="false">Report</button></a>
                                        </li>

                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="<?php echo "../album/$id_album/pgfotografo/impostazioni.php" ?>"> <button class="nav-link w-100 " id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Impostazioni</button></a>
                                        </li>
                                        <li class="nav-item flex-fill" role="presentation">
                                            <a href="<?php echo "../album/$id_album/pgfotografo/gestione_clienti.php" ?>"> <button class="nav-link w-100 " id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-justified-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Clienti</button></a>
                                        </li>
                                    </ul>

                                    <!-- fine tab alti -->
                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                                        </div>
                                    </div>
                                    <!-- contenuto tab -->
                                    <!-- Form di compilazione dati -->
                                    <?php $result = $db_class->select(array("*"), '1album', 'id_album', $id_album); ?>


                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-2 col-form-label">Nome Album</label>
                                            <div class="col-sm-4">
                                                <input type="text" value="<?php echo $result[0]['nome'] ?>" name="nome" class="form-control" maxlength="30" required>
                                            </div>

                                            <label for="inputText" class="col-sm-2 col-form-label">Sottotitolo</label>
                                            <div class="col-sm-4">
                                                <input type="text" value="<?php echo $result[0]['sottotitolo'] ?>" name="sottotitolo" class="form-control" maxlength="30">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Categoria Servizio</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" value="" name="categoria" aria-label="Default select example">
                                                    <option selected><?php echo $result[0]['categoria'] ?></option>
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
                                                <input type="date" value="<?php echo $result[0]['data_album'] ?>" name="data_album" class="form-control">
                                            </div>
                                        </div>


                                        <!--  <div class="row mb-3">
                                            <label for="inputNumber" class="col-sm-2 col-form-label">Carica
                                                Copertina</label>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="file" name="file" accept=".jpg" required>
                                            </div>
                                            <label for="inputDate" class="col-sm-2 col-form-label">Cartella Locale</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="path_hd" class="form-control" disabled>
                                            </div>
                                        </div> -->



                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Note Album</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" value="<?php echo $result[0]['note'] ?>" name="note" style="height: 100px"><?php echo $result[0]['note'] ?></textarea>
                                            </div>
                                        </div>

                                        <?php
                                        $op = $db_class->select(array('id_op1','id_op2','id_op3','id_op4','id_op5','id_op6'), '1report', 'id_album', $id_album);
                                        $_SESSION['op']=$op;

                                        $op_select = $op[0]['id_op1'];
                                        $op_selezionato = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select);
                                        if(isset($op[0]['id_op2']) && $op[0]['id_op2'] != null){
                                        $op_select2 = $op[0]['id_op2'];
                                        $op_selezionato2 = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select2);
                                        }else{
                                            $op_selezionato2[0]['nome_cliente']= null;
                                        }
                                        if(isset($op[0]['id_op3']) && $op[0]['id_op2'] != null){
                                        $op_select3 = $op[0]['id_op3'];
                                        $op_selezionato3 = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select3);
                                        }else{
                                            $op_selezionato3[0]['nome_cliente']= null;
                                        }
                                        if(isset($op[0]['id_op4']) && $op[0]['id_op2'] != null){
                                        $op_select4 = $op[0]['id_op4'];
                                        $op_selezionato4 = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select4);
                                        }else{
                                            $op_selezionato4[0]['nome_cliente']= null;
                                        }
                                        if(isset($op[0]['id_op5']) && $op[0]['id_op2'] != null){
                                        $op_select5 = $op[0]['id_op5'];
                                        $op_selezionato5 = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select5);
                                        }else{
                                            $op_selezionato5[0]['nome_cliente']= null;
                                        }
                                        if(isset($op[0]['id_op6']) && $op[0]['id_op2'] != null){
                                        $op_select6 = $op[0]['id_op6'];
                                        $op_selezionato6 = $db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti', '1report'), '1clienti.id_cliente', $op_select6);
                                        }else{
                                            $op_selezionato6[0]['nome_cliente']= null;
                                        }



                                        ?>
                                        <div class="row mb-3">
                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato[0]['nome_cliente'] ?>" name="operatore[]" placeholder="<?php echo $op_selezionato[0]['nome_cliente'] ?>" required>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato2[0]['nome_cliente'] ?>" name="operatore[]" placeholder="operatore 2">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato3[0]['nome_cliente'] ?>" name="operatore[]" placeholder="operatore 3">
                                            </div>

                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato4[0]['nome_cliente'] ?>" name="operatore[]" placeholder="operatore 4">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato5[0]['nome_cliente'] ?>" name="operatore[]" placeholder="operatore 5">
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control" value="<?php echo $op_selezionato6[0]['nome_cliente'] ?>" name="operatore[]" placeholder="operatore 6">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Modifica Album</label>
                                            <div class="col-sm-10">
                                                <button type="submit" name="modifica_album" class="btn btn-primary">Invia</button>
                                            </div>
                                        </div>
                                    </form><!-- End General Form Elements -->



                                    <!-- END LINK CLIENTI -->
                                </div>
                            </div> <!-- FINE CARD MADRE DI SNISTRA -->



                            <!--  FINE GESTIONE CLIENTI -->
                        </div> <!-- FINE CARD BODY PARTE SINISTRA -->
                    </div> <!-- FINE CARD PARTE SINISTRA -->
                </div> <!-- fine contenuto tab -->

                <!--       sezione anteprima album -->
                <?php /* include(D20PGF . '/anteprima_album.php'); */ ?>
                <!--   fine anteprima album -->

            </div> <!-- FINE ROW PAGINA TOTALE -->
        </section>

        <?php include('../component/sezione_controllo.php'); ?>

    </main><!-- End #main -->

    <?php include('../live/footer_live.html');  ?>

    <script>
        function link_locale(make_id, text, destinazion) {
            locale = document.getElementById(make_id).value + text;
            document.getElementById(destinazion).value = locale;
            localStorage["link_locale"] = locale;
            console.log(localStorage.getItem("link_locale"));

        }

        addEventListener("load", myFunction);

        function myFunction() {
            console.log(localStorage.getItem("link_locale"));
            document.getElementById("link_locale").value = localStorage.getItem("link_locale");
        }
    </script>


    <script type="text/javascript" src="../script/jquery-3.7.1.min.js"></script>
</body>

</html>