<?php


class DB
{

    private $conn = "";
    public $field = "";
    public $table = "";
    public $value1 = "";
    public $value2 = "";
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

    public function select_op($id_album, $ruolo)
    {
        $result = array();
       
        $this->value1 = $id_album;
        $this->value2 = $ruolo;

        /*    raccolgo i preferiti di quel cliente in quell'album------------------------------------ */
        $select = $this->conn->prepare("SELECT id_cliente, nome_cliente FROM 1clienti WHERE (id_album= :id_album AND ruolo= :ruolo )");
        $select->bindparam(":id_album", $this->value1);
        $select->bindparam(":ruolo", $this->value2);
        $select->execute();

        /*       e li metto all'interno di un array */
        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
                
            
        }
         $this->conn ="null";
        return $result;
    }
}
