<?php

require_once 'db_pdo-class.php';
class FUNCTION_CSI extends DB_CSI {

    public $file = '';
    public $id_cliente ="";
    public $id_album="";


    function __construct($id_album, $id_cliente)
    {

        parent::__construct();
   $this->id_album=$id_album;
   $this->id_cliente=$id_cliente;

    }

    public function save(){

        $array_file=$this->take_select($this->id_cliente, $this->id_album);
    $this->file = $array_file;
    

    var_dump( $this->file);
    
    for ($i=0; $i <count($this->file) ; $i++) { 
        $path='../album/'.$this->id_album.'/sottocartelle/'.$this->file[$i]['path'];
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($path));
            set_time_limit(0);
            readfile($path);
           
        }else{
            echo "errore";
        }
    }  exit;
   
}
        
    }
    


/* $stringa_valori_passati_ajax=$_POST['bottone'];

$valori=explode(",",$stringa_valori_passati_ajax);
$id_cliente=$valori[0];
$id_album=$valori[1];
 */


$fun=new FUNCTION_CSI(1,5);
$fun->save();



?>