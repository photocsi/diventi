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

    /* prendi le foto selezionate  */
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


        $select = $this->conn->prepare("SELECT $this->field FROM $this->db.$this->table WHERE $this->where= :value0 ");
        $select->bindparam(":value0", $this->value);
        $select->execute();


        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }
    /* seleziona uno o piu campi con 2 where */
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

    public function select_order($table,$array_field, $quantity, $array_where, $array_value,$field_order,$asc_desc)
    {
        $result = array();

        $this->field = implode(',', $array_field);
        $this->table = $table;
        $this->where = $array_where;
        $this->value = $array_value;

        if(!isset($this->where[1])){
           $this->where[1]=$this->where[0];
           $this->where[2]=$this->where[0];
        }else if(isset($this->where[1]) && !isset($this->where[2])){
            $this->where[2]=$this->where[0];
        }

        if(!isset($this->value[1])){
            $this->value[1]=$this->value[0];
            $this->value[2]=$this->value[0];
         }else if(isset($this->value[1]) && !isset($this->value[2])){
             $this->value[2]=$this->value[0];
         }

        $select = $this->conn->prepare("SELECT $this->field FROM $this->db.$this->table WHERE ({$this->where[0]}= :value0 AND {$this->where[1]}= :value1 AND {$this->where[2]}= :value2 ) ORDER BY $field_order $asc_desc LIMIT $quantity");
        $select->bindparam(":value0", $this->value[0]);
        $select->bindparam(":value1", $this->value[1]);
        $select->bindparam(":value2", $this->value[2]);
        $select->execute();

        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
    }

    public function select_distinct($table,$field){
        $select=$this->conn->prepare("SELECT DISTINCT $field FROM $this->db.$table ORDER BY $field ASC");
        $select->execute();
$result=array();
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
    public function insert($table, $array_fields, $array_values)
    {
        $array_param=array();
        for ($i=0; $i <count($array_fields) ; $i++) { 
            $array_param[$i]=':'.$array_fields[$i];
        }
        $string_fields=implode(",",$array_fields);
        $string_param=implode(",",$array_param);
        $insert = $this->conn->prepare("INSERT INTO $this->db.$table ($string_fields) VALUES ($string_param) ");
        for ($i = 0; $i < count($array_param); $i++) {
            $insert->bindparam($array_param[$i], $array_values[$i]);
        }
       
        $insert->execute();
    }

    public function update($table,$field, $value, $where_field,$where_value)
    {
        $where_param = ':' . $where_field;
        $param = ':' . $field;
        $insert = $this->conn->prepare("UPDATE $this->db.$table SET $field=$param WHERE $where_field = $where_param");
        $insert->bindparam($param, $value);
        $insert->bindparam($where_param, $where_value);
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
