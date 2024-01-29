



<?php

include_once __DIR__ . '/../includes/function-class.php';
$path = "../sottocartelle";
$function = new FUNCTION_CSI($id_album, $id_cliente);
$cartelle = $function->mostra_cartelle($path);

?>

<form action="#" method="post">
<?php

foreach ($cartelle as $cartella) {
    $value = html_entity_decode($cartella);
    if($value != 'CESTINO'){
    echo "<button type='input' name='folder' value='$value' class='btn btn-primary btn-lg m-2'><i class='bi bi-folder2-open'></i> $value </button>";
    }
}

?>

</form>
