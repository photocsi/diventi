<?php


class DB_CSI
{

    public $conn = "";
    public $field = array();
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

    function __destruct()
    {
        $this->conn = null;
    }

    /* prendi la selezione delle foto */
    public function take_select($id_cliente, $id_album)
    {
        $result = array();
        $select = $this->conn->prepare("SELECT * FROM $this->db.$id_album 
  INNER JOIN 1preferiti ON $this->db.$id_album.id_foto=1preferiti.id_foto  WHERE id_cliente= :id_cliente ;");
        $select->bindParam(':id_cliente', $id_cliente);
        $select->execute();

        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        return $result;
    }
    /* seleziona una u piu campi con un where */
    public function select($array_field, $table, $where, $value)
    {
        $result = array();
        $this->field = implode(',', $array_field);
        $this->table = $table;
        $this->where = $where;
        $this->value = $value;


        $select = $this->conn->prepare("SELECT $this->field FROM $this->table WHERE $this->where= :value0 ");
        $select->bindparam(":value0", $this->value);
        $select->execute();


        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
    /* seleziona una u piu campi con 2 where */
    public function select_2where($array_field, $table, $where, $value)
    {
        $result = array();

        $this->field = implode(',', $array_field);
        $this->table = $table;
        $this->where = $where;
        $this->value = $value;

        $select = $this->conn->prepare("SELECT $this->field FROM $this->table WHERE ({$this->where[0]}= :value0 AND {$this->where[1]}= :value1 )");
        $select->bindparam(":value0", $this->value[0]);
        $select->bindparam(":value1", $this->value[1]);
        $select->execute();

        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function select_innerjoin($string_field, $array_table, $where, $value)
    {
        $result = array();
        $select_inner = $this->conn->prepare("SELECT $string_field FROM {$array_table[0]} INNER JOIN {$array_table[1]} WHERE $where = $value ");
        $select_inner->execute();
        while ($row = $select_inner->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
 /*  inserisco un nuovo record con i suoi vari campi */
    public function insert($table, $string_fields, $string_param, $array_values)
    {
        $array_param = explode(",", $string_param);
        $insert = $this->conn->prepare("INSERT INTO $table ($string_fields) VALUES ($string_param) ");
        for ($i = 0; $i < count($array_param); $i++) {
            $insert->bindparam($array_param[$i], $array_values[$i]);
        }

        $insert->execute();
    }

    public function update($field, $value, $id_album, $where_field = "id_album", $table)
    {
        $where_param = ':' . $where_field;
        $param = ':' . $field;
        $insert = $this->conn->prepare("UPDATE $table SET $field=$param WHERE $where_field = $where_param");
        $insert->bindparam($param, $value);
        $insert->bindparam($where_param, $id_album);
        $insert->execute();
    }

    public function delete($table, $where, $field)
    {
        $param = ':' . $where;
        $delete = $this->conn->prepare("DELETE FROM $this->db.$table WHERE $where = $param");
        $delete->bindParam($param, $field);
        $delete->execute();
    }
}
