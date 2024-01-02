<?php

require_once 'button-class.php';
require_once 'db_pdo-class.php';

class INPUT_CSI extends BUTTON_CSI
{
  public $lista_op = array();
  public $id_album = "";
  public $db_class = "";
  public $value = 12;

 function __construct($id_album)
 {
  $this->id_album=$id_album;
  $this->db_class = new DB_CSI;
 }


  public function op($op)
  {
 
    $this->lista_op = $this->db_class->select_2where(array('id_cliente','nome_cliente'), '1clienti', array('id_album','ruolo'), array($this->id_album,'operatore'));
  
    $op_selezionato=$this->db_class->select_innerjoin('id_cliente,nome_cliente', array('1clienti','1report'),'1clienti.id_cliente', $op);
?> <div class="row mb-3">

      <div class="col-md-6">
        <label for="inputName" class="form-label">Seleziona operatore</label>
        <select class="form-select form-select-sm" id="inputName" name="dati_operatore[]">
         
          <?php 
           echo " <option value='{$op_selezionato[0]['nome_cliente']},{$op_selezionato[0]['nome_cliente']}'> {$op_selezionato[0]['nome_cliente']}</option>";
          for ($i = 0; $i < count($this->lista_op); $i++) {
            
            echo "  <option value={$this->lista_op[$i]['id_cliente']},{$this->lista_op[$i]['nome_cliente']}>{$this->lista_op[$i]['nome_cliente']}</option>";
          }  ?>

        </select>
      </div>
      <div class="col-md-3">
        <label for="inputStipendio" class="form-label">Stipendio</label>
        <input name="stipendio[]" value="0" type="text" class="form-control form-control-sm" id="inputStipendio">
      </div>
      <div class="col-md-3">
        <label for="inputPercentuale" class="form-label">Percentuale</label>
        <input name="percentuale[]" value="0" type="text" class="form-control form-control-sm" id="inputPercentuale">
      </div>
    </div>
  
  <?php 
   }


  public function input_number($name, $name_post, $label)
  {

  $result=$this->db_class->select(array($name_post), '1report', 'id_album', $this->id_album);
  

  ?> <div class="row mb-3">
      <label for="inputValue" class="col-sm-5 col-form-label col-form-label-sm"><?php echo $name ?></label>
      <div class="col-md-4">
        <input name="<?php echo $name_post ?>" value="<?php echo $result[0][$name_post] ?>" type="number" class="form-control form-control-sm" id="inputValue">
      </div>
        <label class="col-sm-3 col-form-label col-form-label-sm"><?php echo $label ?></label>
    </div>
  <?php 
  }

  public function input_text($name, $name_post)
  {

    $result=$this->db_class->select(array($name_post), '1report', 'id_album', $this->id_album);

  ?> <div class="row mb-3">
      <label for="inputValue" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $name ?></label>
      <div class="col-md-8">
        <input name="<?php echo $name_post ?>" type="text" value="<?php echo $result[0][$name_post] ?>" class="form-control form-control-sm" id="inputValue">
      </div>

    </div>
    

  <?php
  }

  public function input_print($name, $name_start, $name_end)
  {

  ?> <div class="row mb-3">
      <label for="inputStart" class="col-sm-2 col-form-label col-form-label-sm"><?php echo $name ?></label>
      <label for="inputEnd" class="col-sm-2 col-form-label col-form-label-sm">Inizio</label>
      <div class="col-md-3">
        <input name="<?php echo $name_start ?>" value="0" type="number" class="form-control form-control-sm" id="inputStart">
      </div>
      <label for="inputEnd" class="col-sm-2 col-form-label col-form-label-sm">Fine</label>
      <div class="col-md-3">
        <input name="<?php echo $name_end ?>" value="0" type="number" class="form-control form-control-sm" id="inputEnd">
      </div>

    </div>
   

<?php
  }

  public function input_select($name, $name_post, $value1,$value2,$value3, $label)
  {
    $result=$this->db_class->select(array($name_post), '1report', 'id_album', $this->id_album);
  ?>  <div class="row mb-3">
  <label for="inputSelect" class="col-sm-4 col-form-label col-form-label-sm"><?php echo $name ?></label>
  <div class="col-md-3">
  <select class="form-select form-select-sm" id="inputSelect" name="<?php echo $name_post ?>">
  <option value="<?php echo $result[0][$name_post] ?>"><?php echo $result[0][$name_post] ?></option>";
    <option value="<?php echo $value1 ?>"><?php echo $value1 ?></option>";
    <option value="<?php echo $value2 ?>"><?php echo $value2 ?></option>";
    <option value="<?php echo $value3 ?>"><?php echo $value3 ?></option>";
  </select>
  </div>
  <label  class="col-sm-4 col-form-label col-form-label-sm"><?php echo $label ?></label>
</div>
    

<?php
  }

  public function input_textarea($name, $name_post)
  {
    $result=$this->db_class->select(array($name_post), '1report', 'id_album', $this->id_album);
  ?> <div class="row mb-3">
      <label class="col-sm-2 col-form-label col-form-label-sm"><?php echo $name ?></label>
      <div class="col-md-10">
      <textarea class="form-control form-control-sm" aria-valuetext="<?php echo $result ?>" name="<?php echo $name_post ?>" style="height: 100px"></textarea>
      </div>
      

    </div>
    

<?php
  }
}
