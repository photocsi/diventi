<?php


class WORK_CSI
{
    public $id_album = "";
    public $id_operatore = "";
    public $conn = "";

    function __construct($id_album, $id_operatore, $conn)
    {
        $this->id_album = $id_album;
        $this->id_operatore = $id_operatore;
        $this->conn = $conn;
    }

    public function prendi_preferiti()
    {
        $preferiti_cliente = array();
        /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
        $select_preferiti = $this->conn->prepare("SELECT id_foto FROM 1preferiti WHERE (id_cliente= :id_cliente AND id_album= :id_album )");
        $select_preferiti->bindparam(":id_cliente", $this->id_operatore);
        $select_preferiti->bindparam(":id_album", $this->id_album);
        $select_preferiti->execute();

        /*       e li metto all'interno di un array */
        while ($row = $select_preferiti->fetch(PDO::FETCH_ASSOC)) {
            $preferiti_cliente[] = $row['id_foto'];
        }

        return $preferiti_cliente;
    }


    public function offcanvas_ricerche()
    {

?>
        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasRicerca" style="margin-left: 20px; margin-right: 10px" role="button" aria-controls="offcanvasExample">
            <i class="bi bi-gear"></i> Strumenti
        </a>


        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRicerca" aria-labelledby="offcanvasRicercaLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Strumenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <?php
                $this->save_select();
                $this->ricerche();
                $this->client();
                $this->size_picture();
                /* include 'upload.php'; */
                ?>


            </div>
        </div>

    <?php


    }


    public function offcanvas_folder()
    {
    ?>
        <a class="btn btn-primary btn-sm" data-bs-toggle="offcanvas" href="#offcanvasFolder" style="margin-left: 20px; margin-right: 10px" role="button" aria-controls="offcanvasFolder">
            <i class="bi bi-list-columns"></i> Cartelle
        </a>


        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasFolder" aria-labelledby="offcanvasFolderLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasFolderLabel">Seleziona Cartelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">


                <div class="card" style="margin: 0px">
                    <div class="card-body" style="padding-top: 20px">
                        <form class="row g-3" method="POST" action="#">
                            <button type="submit" name="mostra" class="btn btn-primary  btn-sm">Mostra Foto</button>
                            <select id="inputState" class="form-select" name="cartella_scelta[]" style="float:left; display:block;" size="16" multiple>

                                <?php
                                /* il percorso dove cercare le cartelle */
                                $path = "../sottocartelle";
                                /*     uso la funzione per scandire le cartelle e inserirle in un array */
                                $cartelle = mostra_cartelle($path);
                                foreach ($cartelle as $cartella) {
                                    $value = html_entity_decode($cartella);
                                    echo "<option value=\"$value\"> $value </option>";
                                }
                                ?>
                            </select>

                        </form>
                    </div>
                </div>

                <?php
                $this->rename_folder();
                $this->move_photo();
                $this->create_folder();
                ?>

            </div>
        </div>

    <?php




    }

    public function slide_upload()
    { ?>


        <a href="javascript:apri('upload.php','upload')" class="btn btn-primary btn-sm waves-effect waves-light " id="workbody"  style="margin-left: 10px; margin-right: 10px">
            <i class="bi bi-file-earmark-arrow-down"></i> Upload</a>


        <a href="javascript:apri('slide.php','slide')" class="btn btn-primary btn-sm waves-effect waves-light me-1" style="margin-left: 10px; margin-right: 10px">
            <i class="bi bi-easel2"></i> Slide</a>


    <?php
    }

    public function mostra_selezione()
    { ?>
        <form method="POST" action="#">
            <button type="submit" name="selezione" value="mostra" class="btn btn-success  btn-sm" style="margin-left: 10px; margin-right: 10px"><i class="bi bi-check2-square"></i> Selezione</Button>
        </form>
    <?php
    }

    public function azzera_selezione()
    { ?>

        <form method="POST" action="#">
            <button type="submit" name="reset" value="resetta" class="btn btn-primary  btn-sm" style="margin-left: 10px; margin-right: 10px"><i class="bi bi-x-square"></i> Deseleziona</button>
        </form>

    <?php
    }

    public function rename_folder()
    { ?>


        <div class="card" style="margin: 0px">
            <div class="card-body" style="padding-top: 20px">
                <form class="row g-3" method="POST" action="#">
                    <button type="submit" name="rename" class="btn btn-primary  btn-sm">Rinomina cartella</button>
                    <select id="inputState" class="form-select" name="cartella_rename" style="float:left; display:block;">

                        <?php
                        /* il percorso dove cercare le cartelle */
                        $path = "../sottocartelle";
                        /*     uso la funzione per scandire le cartelle e inserirle in un array */
                        $cartelle = mostra_cartelle($path);
                        /* creo la prima selezione */
                        echo "<option selected=\"NULL\" value=\"NULL\" >seleziona cartella</option>";
                        foreach ($cartelle as $value) {
                            echo "<option value=\"$value\"> $value </option>";
                        }
                        ?>
                    </select>

                    <input type="text" name="cartella_newname" value="" placeholder="nuovo nome">
                </form>

            </div>
        </div>
    <?php }

    public function save_select()
    { ?>
        <div class="card">
            <div class="card-body" style="padding-top: 20px ; ">


                <form method="POST" action="#" class="row g-3">
                    <span class="input-group-text" id="basic-addon1" style="padding: 2px !important;">
                        <button type="submit" class="btn btn-info" name="salva_selezione"><i class="bi bi-save2"></i></button>

                        <input type="text" name="nome_selezione" value="" class="form-control" placeholder="Salva selezione" aria-label="Username" aria-describedby="basic-addon1">
                    </span>
                </form>




            </div>
        </div>
    <?php }

    public function move_photo()
    { ?>
        <div class="card">
            <div class="card-body" style="padding-top: 20px ; ">


                <form method="POST" action="#" class="row g-3">
                    <span class="input-group-text" id="basic-addon1" style="padding: 2px !important;">
                        <button type="submit" class="btn btn-info" name="salva_move_photo"><i class="bi bi-folder-symlink"></i></button>

                        <input type="text" name="move_photo" value="" class="form-control" placeholder="Sposta foto" aria-label="Username" aria-describedby="basic-addon1">
                    </span>
                </form>




            </div>
        </div>
    <?php }

    public function create_folder()
    { ?>
        <div class="card">
            <div class="card-body" style="padding-top: 20px ; ">


                <form method="POST" action="#" class="row g-3">
                    <span class="input-group-text" id="basic-addon1" style="padding: 2px !important;">
                        <button type="submit" class="btn btn-info" name="create_folder"><i class="bi bi-folder-plus"></i></button>

                        <input type="text" name="create_folder" value="" class="form-control" placeholder="Crea nuova cartella" aria-label="Username" aria-describedby="basic-addon1">
                    </span>
                </form>




            </div>
        </div>
    <?php }

    public function ricerche()
    { ?>
        <div class="card">
            <div class="card-body" style="padding-top: 20px ; ">

                <form method="POST" action="#" class="row g-3">
                    <span class="input-group-text" id="basic-addon1">
                        <button type="submit" class="btn btn-info" name="selezione_nome"><i class="bi bi-images"></i></i></button>

                        <input type="text" name="nome_foto" value="" class="form-control" placeholder="ricerca nome foto" aria-label="Username" aria-describedby="basic-addon1">
                    </span>
                </form>

                <hr style="margin: 12px">

                <form method="POST" action="#" class="row g-3">
                    <span class="input-group-text" id="basic-addon1">
                        <button type="submit" class="btn btn-info" name="prendi_cartella"><i class="bi bi-folder2-open"></i></button>

                        <input type="text" name="nome_cartella" class="form-control" placeholder="trova cartella" aria-label="Username" aria-describedby="basic-addon1">
                    </span>
                </form>



            </div>
        </div>

    <?php
    }

    public function client()
    {
    ?>
        <div class="card" style="margin: 0px">
            <div class="card-body" style="padding-top: 20px">

                <!-- No Labels Form -->
                <form class="row g-3" method="POST" action="#">
                    <!--  BOTTONE PER ELIMINARE LA SELEZIONE -->
                    <button type="submit" name="cliente_servito" value='' class="btn btn-danger  btn-sm">Cliente servito</button>

                    <select id="inputState" class="form-select" name="scelta_cliente" value="NULL" style="float:left; display:block;">

                        <?php
                        $clienti = prendi_clienti($this->id_album);


                        /* creo la prima selezione */
                        echo "<option selected=\"NULL\" value=\"NULL\">seleziona cliente</option>";
                        while ($row = $clienti->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=\"{$row['nome_cliente']},{$row['id_cliente']}\"> {$row['nome_cliente']} </option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="mostra_cliente" class="btn btn-primary  btn-sm">Mostra Cliente</button>



                </form>
            </div>
        </div>

    <?php
    }

    public function size_picture()
    {
    ?>
        <div class="card">
            <div class="card-body" style="text-align:center ; padding-top: 20px ; ">
            <p>Dimensioni anteprima (Shift + 1-5)</p>
           
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-bar-graph" onclick="dsmall()" viewBox="0 0 16 16">
                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-bar-graph" onclick="dmedium()" viewBox="0 0 16 16">
                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-bar-graph" onclick="dbig()" viewBox="0 0 16 16">
                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-file-bar-graph" onclick="dfull()" viewBox="0 0 16 16">
                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-file-bar-graph" onclick="dxlfull()" viewBox="0 0 16 16">
                    <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                </svg>
            </div>
        </div>

    <?php
    }

    public function reload()
    {
    ?>
        <form method="POST" action="#">
            <button type="submit" name="reload" value="reload" class="btn btn-primary  btn-sm" style="margin-left: 10px; margin-right: 10px"><i class="bi bi-arrow-clockwise"></i> R</Button>
        </form>


<?php
    }
}
