<?php
$id_album=165                                              ;








session_start();
$cartella_scelta11=$_SESSION['cartella_scelta11'];
$cartella_scelta12=$_SESSION['cartella_scelta12'];
$id_cliente=$_SESSION['id_cliente6'];




header("Expires: on, 01 Jan 1970 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide6</title>

</head>
<body>

<?php
         include('../../../function/funzioni_album.php');
         include('../../../config_pdo.php');
         /*     faccio una query sql per prendere il percorso delle foto e le inserisco in un array */
         $seleziona_foto=$conn->prepare("SELECT * FROM `$id_album` WHERE sotto_cartella= :cartella_scelta11 OR sotto_cartella= :cartella_scelta12; ");
         $seleziona_foto->bindParam(':cartella_scelta11', $cartella_scelta11);
         $seleziona_foto->bindParam(':cartella_scelta12', $cartella_scelta12);
         $seleziona_foto->execute();
         $conn= null ;
         $listafile=array();
         
         
         while($row=$seleziona_foto->fetch(PDO::FETCH_ASSOC)){
           if (file_exists("../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}")){
             $row['path_medium']="../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
           }
           $listafile["path"][]=$row['path_medium'];
           $listafile["nome"][]=filter_var($row['nome_foto'], FILTER_SANITIZE_NUMBER_INT);
           $listafile["sotto_cartella"][]=$row['sotto_cartella'];
 
}

$selezione=prendi_preferiti($id_album,$id_cliente);
/* aggiungo all'array anche le foto delle selezioni */
while($row=$selezione->fetch(PDO::FETCH_ASSOC)){
  if (file_exists("../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}")){
    $row['path_medium']="../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
  }
  $listafile["path"][]=$row['path_medium'];
  $listafile["nome"][]=filter_var($row['nome_foto'], FILTER_SANITIZE_NUMBER_INT);
  $listafile["sotto_cartella"][]=$row['sotto_cartella'];
 
}
          ?>


  <script>

     
var listafile = <?php echo json_encode($listafile) ?>

console.log(listafile);
var i = 0;
var time = 3000;



function changeImg() {
 
  document.slide.src = listafile["path"][i]; /* faccio apparire l'immagine */

  var paragrafo= document.createElement("testo"); /* aggiungo l'elemento del nome immagine */
  var testo = document.createTextNode(listafile["sotto_cartella"][i] + ' > ' + listafile["nome"][i] + ' <');
  paragrafo.appendChild(testo);
  document.getElementById("testo").appendChild(paragrafo); /* fine aggiunta nome immagine */

  setTimeout("rem()" ,time);
  console.log(listafile["nome"][i]);

  if (i < listafile["path"].length - 1) {
      i++
  } else {
      i = 0;
  }
  setTimeout("changeImg()" ,time);
 


}

function rem(){
  const list = document.getElementById("testo");
list.removeChild(list.firstElementChild);
   
}

window.onload = changeImg;



</script>



<div class="container-fluid" style="text-align: center;">

  <div class="item active">
  <b><div id="testo" style="font-size : 250%;  color:black; font-family: Tahoma ; "   > </div></b>
  <hr>
 
              <div class="container-fluid" >
              <div id="prova" class="row " style="width: auto ; height: 600px">
                 <img name="slide"  style="width: 100% ; height: 100%; object-fit: contain;  border: 4px black solid ; "  alt="..." data-gallery="portfolioGallery"  title="Card 1"><i class="bx bx-plus">
            </div>
            <hr>
            </div>
             
           
        </div></div>


<script>
  var altezza= window.screen.availHeight;
console.log(altezza);

var divReference = document.getElementById("prova");
     divReference.style.height = altezza-160 + 'px';

</script>

</body>
</html>