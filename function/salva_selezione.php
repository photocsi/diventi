<!-- SALVO LA SELEZIONE E GLI DO UN NOME -->
<?php
  if(isset($_POST['salva_selezione'])){

    $boolean_conferma= 1;
  
      $nome_cliente=$_POST['nome_selezione'];

      $insert_cliente=$connessione->prepare("INSERT INTO 1clienti (id_album, id_fotografo, nome_cliente, conferma_preferiti)
      VALUES (?,?,?,?) ");
      
      $insert_cliente->bind_param("iisi", $id_album, $id_fotografo, $nome_cliente, $boolean_conferma);
      $insert_cliente->execute();

      $select=$connessione->prepare("SELECT `id_cliente` FROM `1clienti` WHERE id_fotografo = $id_fotografo AND `ruolo`= 'operatore';");
      $select->execute();
      $result=$select->get_result();

      while($row=$result->fetch_array()){
        $id_operatore=$row[0];
      }

      $select_cliente=$connessione->prepare("SELECT `id_cliente` FROM `1clienti` ORDER BY id_cliente DESC LIMIT 1;");
      $select_cliente->execute();
      $result=$select_cliente->get_result();

      while($row=$result->fetch_array()){
        $id_cliente_nuovo=$row['id_cliente'];
      }

      $update_preferiti=$connessione->prepare("UPDATE 1preferiti SET id_cliente = $id_cliente_nuovo WHERE id_cliente = $id_operatore");
      $update_preferiti->execute();
     

  }
  ?> <!-- FINE SALVA SELEZIONE -->
