<?php

require_once 'button-class.php';
require_once 'db_pdo-class.php';

class REPORT extends BUTTON
{
  public $lista_op = array();



  public function op($id_album)
  {
    $db_class = new DB();
    $field = ['id_cliente', 'nome_cliente'];
    $table = '1clienti';
    $where = ['id_album', 'ruolo'];
    $value = [$id_album, 'operatore'];
    $this->lista_op = $db_class->select_2where($field, $table, $where, $value);

?> <div class="row g-3">

      <div class="col-md-6">
        <label for="inputName" class="form-label">Seleziona operatore</label>
        <select class="form-select" id="inputName" name="dati_operatore[]">
          <option value="">-</option>";
          <?php for ($i = 0; $i < count($this->lista_op); $i++) {
            echo "  <option value={$this->lista_op[$i]['id_cliente']},{$this->lista_op[$i]['nome_cliente']}>{$this->lista_op[$i]['nome_cliente']}</option>";
          }  ?>

        </select>
      </div>
      <div class="col-md-3">
        <label for="inputStipendio" class="form-label">Stipendio</label>
        <input name="stipendio[]" value="0" type="text" class="form-control" id="inputStipendio">
      </div>
      <div class="col-md-3">
        <label for="inputPercentuale" class="form-label">Percentuale</label>
        <input name="percentuale[]" value="0" type="text" class="form-control" id="inputPercentuale">
      </div>
    </div>
    <hr>
  <?php  }


  public function input_number($name, $name_post, $label)
  {

  ?> <div class="row g-3">
      <label for="inputValue" class="col-sm-6 col-form-label"><?php echo $name ?></label>
      <div class="col-md-3">
        <input name="<?php echo $name_post ?>" value="0" type="number" class="form-control" id="inputValue">
      </div>
      <div class="col-md-3">
        <label class="col-sm-6 col-form-label"><?php echo $label ?></label>
      </div>
    </div>
    <hr>

  <?php
  }

  public function input_text($name, $name_post)
  {

  ?> <div class="row g-3">
      <label for="inputValue" class="col-sm-6 col-form-label"><?php echo $name ?></label>
      <div class="col-md-6">
        <input name="<?php echo $name_post ?>" type="text" class="form-control" id="inputValue">
      </div>

    </div>
    <hr>

  <?php
  }

  public function input_print($name, $name_start, $name_end)
  {

  ?> <div class="row g-3">
      <label for="inputStart" class="col-sm-2 col-form-label"><?php echo $name ?></label>
      <label for="inputEnd" class="col-sm-2 col-form-label">Inizio</label>
      <div class="col-md-3">
        <input name="<?php echo $name_start ?>" value="0" type="number" class="form-control" id="inputStart">
      </div>
      <label for="inputEnd" class="col-sm-2 col-form-label">Fine</label>
      <div class="col-md-3">
        <input name="<?php echo $name_end ?>" value="0" type="number" class="form-control" id="inputEnd">
      </div>

    </div>
    <hr>

<?php
  }

  public function input_select($name, $name_input, $value1,$value2,$value3, $label)
  {

  ?>  <div class="row g-3">
  <label for="inputSelect" class="col-sm-4 col-form-label"><?php echo $name ?></label>
  <div class="col-md-3">
  <select class="form-select" id="inputSelect" name="<?php echo $name_input ?>">
    <option value="<?php echo $value1 ?>"><?php echo $value1 ?></option>";
    <option value="<?php echo $value2 ?>"><?php echo $value2 ?></option>";
    <option value="<?php echo $value3 ?>"><?php echo $value3 ?></option>";
  </select>
  </div>
  <label  class="col-sm-4 col-form-label"><?php echo $label ?></label>
</div>
    <hr>

<?php
  }

  public function input_textarea($name, $name_input)
  {

  ?> <div class="row g-3">
      <label class="col-sm-2 col-form-label"><?php echo $name ?></label>
      <div class="col-md-10">
      <textarea class="form-control" name="<?php echo $name_input ?>" style="height: 100px"></textarea>
      </div>
      

    </div>
    <hr>

<?php
  }
}
