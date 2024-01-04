<?php

require_once 'db_pdo-class.php';
class FUNCTION_CSI extends DB_CSI
{

    public $file = '';
    public $id_cliente = "";
    public $id_album = "";


    function __construct($id_album, $id_cliente = 0)
    {

        parent::__construct();
        $this->id_album = $id_album;
        $this->id_cliente = $id_cliente;
    }

    public function save()
    {

        $array_file = $this->take_select($this->id_cliente, $this->id_album);
        $this->file = $array_file;


        var_dump($this->file);

        for ($i = 0; $i < count($this->file); $i++) {
            $path = '../album/' . $this->id_album . '/sottocartelle/' . $this->file[$i]['path'];
            if (file_exists($path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($path) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($path));
                set_time_limit(0);
                readfile($path);
            } else {
                echo "errore";
            }
        }
        exit;
    }

    public function delete_file($id_foto,$nome_foto)
    {
        $this->delete($this->id_album, 'id_foto', $id_foto);
         $this->insert(
            $this->id_album,
            'id_album,id_fotografo,sotto_cartella,path,path_medium,path_small,path_watermark,nome_foto',
            ':id_album,:id_fotografo,:sotto_cartella,:path,:path_medium,:path_small,:path_watermark,:nome_foto',
            array($this->id_album , '0' , 'cestino',"../sottocartelle/cestino/$nome_foto" ,"../sottocartelle/cestino/$nome_foto","../sottocartelle/cestino/$nome_foto","../sottocartelle/cestino/$nome_foto", "$nome_foto" ),
        );
       
        
        
    }
}


if (isset($_POST['delete'])) {

    $valori_ajax = $_POST['delete'];
    $valori = explode(",", $valori_ajax);
    $id_foto = $valori[0];
    $id_album = $valori[1];
    $nome_foto = $valori[2];
    $sotto_cartella = $valori[3];

    $fun = new FUNCTION_CSI($id_album);
    $fun->delete_file($id_foto,$nome_foto);

    copy("../album/$id_album/sottocartelle/$sotto_cartella/small/$nome_foto", "../album/$id_album/sottocartelle/cestino/$nome_foto");
    unlink("../album/$id_album/sottocartelle/$sotto_cartella/small/$nome_foto");
    copy("../album/$id_album/sottocartelle/$sotto_cartella/watermark/$nome_foto", "../album/$id_album/sottocartelle/cestino/$nome_foto");
    unlink("../album/$id_album/sottocartelle/$sotto_cartella/watermark/$nome_foto");
    copy("../album/$id_album/sottocartelle/$sotto_cartella/medium/$nome_foto", "../album/$id_album/sottocartelle/cestino/$nome_foto");
    unlink("../album/$id_album/sottocartelle/$sotto_cartella/medium/$nome_foto");
    copy("../album/$id_album/sottocartelle/$sotto_cartella/large/$nome_foto", "../album/$id_album/sottocartelle/cestino/$nome_foto");
    unlink("../album/$id_album/sottocartelle/$sotto_cartella/large/$nome_foto");
}
/* $fun->save(); */
