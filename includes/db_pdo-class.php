<?php


class DB
{

    private $conn = "";
    public $field =array();
    public $table = "";
    public $where = array();
    public $value = array();
    public $db = 'diventi';

    function __construct()
    {

        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=$this->db", "root", "");
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            /* ECHO "CONNESSIONE RIUSCITA"; */
        } catch (PDOException $e) {
            die("ERRORE: Impossibile stabilire una connessione al database");
        }
    }

    public function select_2where($field,$table,$where,$value)
    {
        $result = array();
       
        $this->field = implode(',',$field);
        $this->table = $table;
        $this->where = $where;
        $this->value = $value;

        /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
        $select = $this->conn->prepare("SELECT $this->field FROM $this->table WHERE ({$this->where[0]}= :value0 AND {$this->where[1]}= :value1 )");
        $select->bindparam(":value0", $this->value[0]);
        $select->bindparam(":value1", $this->value[1]);
        $select->execute();

        /*       e li metto all'interno di un array */
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
                
            
        }
         $this->conn ="null";
        return $result;
    }
}
