<?php
$id_album=34;
$id_fotografo=34                                    ;


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Header Side - Modul Photo</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../../assets/img/favicon.png" rel="icon">
    <link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css" rel="stylesheet">
    <link href="../../../css/style.css" rel="stylesheet">

</head>

<body id="loadup">

    <!-- END PHP CODE -->
    <main id="main" class="main" style="margin-top: 0; background-color: green">
        <section class="section">
            <div class="row">
                <div class="col-lg-8"> <!-- //larghezza form -->

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Caricamento foto</h5>

                            <!-- inizio tab menu sopra il form -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Bordered Tabs Justified -->

                                    <div class="tab-content pt-2" id="borderedTabJustifiedContent">
                                        <div class="tab-pane fade show active" id="bordered-justified-home" role="tabpanel" aria-labelledby="home-tab">

                                            <!-- contenuto tab -->
                                            <!-- Start Form carica foto -->
                                            <form action="#" method="POST" id="uploadForm" enctype="multipart/form-data">
                                                <!--  INIZIO SCELTA hd -->
                                                <div class="card-body  align-items-center" style="border: 1px solid #0040ff ; padding-top: 1rem; border-radius: 30px ; margin: 1rem ;">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="resolution" id="inlineCheckbox1" value="speed" checked>
                                                        <label class="form-check-label" for="inlineCheckbox1">Speed</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="resolution" id="inlineCheckbox2" value="hd">
                                                        <label class="form-check-label" for="inlineCheckbox2">HD</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="resolution" id="inlineCheckbox3" value="low" disabled>
                                                        <label class="form-check-label" for="inlineCheckbox3">low resolution (disabled)</label>
                                                    </div>
                                                </div>
                                                <!--  FINE SCELTA hd -->
                                                <?php
                                                require_once '../../../includes/db_pdo-class.php';
                                                $db_csi = new DB_CSI();
                                                $tag=$db_csi->select_order($id_album,array('tag'),1,array('id_album'),array($id_album),'id_foto','DESC');
                                              
                                                ?>


                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-3 col-form-label">Seleziona Foto</label>
                                                    <div class="col-sm-9">
                                                        <input onclick="startUpload()" type="file" name="files[]" id="inpFile" multiple class="form-control" accept=".jpg" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText" class="col-sm-3 col-form-label">Nome
                                                        Cartella</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="sotto_cartella" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputDate" class="col-sm-3 col-form-label">TAG</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="tag" value="<?php  echo (isset($tag[0])) ?   $tag[0]['tag'] : '';  ?>" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label"></label>
                                                    <div class="col-sm-9">
                                                        <button type="submit" name="carica" class="btn btn-primary">carica files</button>
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
            <!-- CODICE PHP -->
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include('../../../function/creazione_album.php');
                $array_caricamento = carica_foto($id_album, $id_fotografo);
                /*  echo  '<h4>Fotografie caricate: <img'.$array_caricamento['foto_caricate'].'></h4></br>'. 
  '<h4>Fotografie già presenti nell\'album: <img'.$array_caricamento['foto_non_caricate'].'></h4>' ; */
            }


            ?>

        </section>

        <?php include('../../../component/sezione_controllo.php'); ?>


    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>
    <script src="../../../assets-d20/js/auto_function.js"></script>


</body>

</html>