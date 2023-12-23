<?php

echo "<div class=\"col\" > 
          <div class=\"card\" id='card_foto' style=\"width: 14rem;\" >";
            /*  controllo se esiste il file modificato in quel caso do quel percorso per il path da mostrare */
          if (file_exists("../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}")){
            $row['path_medium']="../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
            $row['path']="../sottocartelle/{$row['sotto_cartella']}/large/modificate/{$row['nome_foto']}";
          }
          echo " <img role=\"button\" src=\"{$row['path_medium']}\" onclick=\"seleziona({$row['id_album']}{$row['id_foto']})\" 
                id=\"{$row['id_album']}{$row['id_foto']}\"  value=\"$id_operatore,{$row['id_album']},{$row['id_foto']}\"
                class=\"card-img-top\" title=\"Cartella:{$row['sotto_cartella']} - Nome:{$row['nome_foto']} \" 
                style=\"border: limegreen 8px solid\" >";


          echo "<div class=\"card-body\" style=\"padding:0px; margin: 0px;\"style=\" margin: 0px;\">";
          echo " <p class=\"card-text\" style=\" margin: 0px;\">{$row['nome_foto']}</br></p>";

          echo " <a href=\"{$row['path']}\" target=\"_blank\" ><button <i class=\"bi bi-zoom-in\"></i></button></a> "; 
            echo "&nbsp&nbsp&nbsp <button onclick=\"ApriImmagini('immagine.php?id={$row['nome_foto']},{$row['sotto_cartella']},{$row['id_foto']}')\">
            <i class=\"bi bi-printer\"></i></button>";
            echo "&nbsp&nbsp&nbsp&nbsp<button><i class=\"bi bi-trash\"></i></button>";
            echo "</div></div></div>";

    ?>