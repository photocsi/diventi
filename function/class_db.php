<?php

class connect{

    private $host="localhost";
    private $user="root";
    private $pass="";
    private $db="tardis";
    private $tabella;
    private $colonna;
    private $valore;
    private $colonna2;
    private $valore2;
    


    public function conn_select_where_s(){
        $connessione= new mysqli($this->host,$this->user,$this->pass,$this->db);
        $select=$connessione->prepare("SELECT * FROM $this->tabella WHERE $this->colonna= ? ");
        $select->bind_param("s", $this->valore);
        $control=$select->execute();
        if($control){
            $result=$select->get_result();
            
        }
        return $result;
    }

    public function conn_select_where_i(){
        $connessione= new mysqli($this->host,$this->user,$this->pass,$this->db);
        $select=$connessione->prepare("SELECT * FROM $this->tabella WHERE $this->colonna= ? ");
        $select->bind_param("s", $this->valore);
        $control=$select->execute();
        if($control){
            $result=$select->get_result();
            
        }
        return $result;
    }

    public function conn_select_where_is(){
        $connessione= new mysqli($this->host,$this->user,$this->pass,$this->db);
        $select=$connessione->prepare("SELECT * FROM $this->tabella WHERE ( $this->colonna= ?  AND $this->colonna2= ? ) ");
        $select->bind_param("is", $this->valore , $this->valore2);
        $control=$select->execute();
        if($control){
            $result=$select->get_result();
            
        }
        return $result;
    }
   
    private function __construct()
    {
    }
    
    public static function select_where_s($tabella, $colonna, $valore)
    {
         $select = new static();
         $select->tabella=$tabella;
         $select->colonna=$colonna;
         $select->valore=$valore;
        return $select;
    }

    public static function select_where_i($tabella, $colonna, $valore)
    {
         $select = new static();
         $select->tabella=$tabella;
         $select->colonna=$colonna;
         $select->valore=$valore;
        return $select;
    }
    
    public static function select_where_is($tabella, $colonna, $valore, $colonna2 , $valore2)
    {
         $select = new static();
         $select->tabella=$tabella;
         $select->colonna=$colonna;
         $select->valore=$valore;
         $select->colonna2=$colonna2;
         $select->valore2=$valore2;
        return $select;
    }

    
    

}

?>