/* FUNZIONI JS */

/*   nascondi_anteprima() - funzione che nasconde il div laterale e allarga il div centrale (cambiando la classe del div centrale)
     selezione()          - aggiunge il codice nella tabella album e permette di visualizzare il cuore per far selezionare le foto al cliente
     cancella_selezione() - permette di eliminare la conferma della selezione oppure eliminare la selezione da tutte le foto (elimina conferma o azzera selezione)
     copia()              - copia negli appunti il link che puoi incollare dove vuoi

/*   pulsante per nascondere e mostrare la sezione laterale  */    
/*   creo una variabile per prendere il div da nascondere , poi allargo il div cambiando la sua classe  */           
function nascondi_anteprima(){
    anteprima = document.getElementById('mostra');
    if (anteprima.checked){
    document.getElementById('album').style.display='block';
    var divReference = document.getElementById("centrale");
     divReference.className = "col-lg-8";
    }else{
    document.getElementById('album').style.display='none';
    var divReference = document.getElementById("centrale");
     divReference.className = "col-lg-12";
    }
}



/* FUNZIONI PER LE IMPOSTAZIONI DELL'ALBUM */
/* la funzione manda al php per salvare nella tabella album il codice che permette di selezionare le foto al cliente */
function selezione(id_album){
    var selezione = document.getElementById(id_album);
    if(selezione.checked){
    $.ajax({
        type: "post",
        url: "../../../function/impostazioni_album.php",
        data: "valore=" + id_album ,
        success: function(response){
            var result = response;
            console.log(result);
        }
    })
        }else{ $.ajax({
            type: "post",
            url: "../../../function/impostazioni_album.php",
            data: "valore=" + id_album ,
            success: function(response){
                var result = response;
                console.log(result);
      }
     })
   }
  }

/* funzione per eliminare la conferma della selezione o per eliminare tutte le foto selezionate*/
function cancella_selezione(id,idcuore){
    console.log(id);

    var valore =$('#'+ id).val();
    console.log(valore);
    $.ajax({
        type: "post",
        url: "../../../function/cancella_selezione.php",
        data: "bottone=" + valore,
        success: function(response){
            var prova = response;
          console.log(prova);

          location.reload();
    
        }
    })    
}

function download_files(id){
    console.log(id);

    var valore =$('#'+ id).val();
    console.log(valore);
    $.ajax({
        type: "post",
        url: "../../../includes/function-class.php",
        data: "bottone=" + valore,
        success: function(response){
            var prova = response;
          console.log(prova);

          location.reload();
    
        }
    })    
}

function delete_file(id){
    console.log(id);

    var valore =$('#'+ id).attr('value');
    console.log(valore);
    $.ajax({
        type: "post",
        url: "../../../includes/function-class.php",
        data: "delete=" + valore,
        success: function(response){
            var prova = response;
          console.log(prova);

          location.reload();
    
        }
    })    
}

  /*  SELEZIONE IN LIVE  */
  function seleziona(val){
    var valore =$('#'+val).attr('value');
    $.ajax({
        type: "post",
        url: "../../../function/seleziona.php",
        data: "foto=" + valore,
        success: function(response){
            var prova = response;
          console.log(prova);
    
            var bordo = document.getElementById(val);
            if(prova==0){
                bordo.style.border = 'limegreen 8px solid';
               /*   contorno.style.color= 'white';  */
                 
            }else{
                bordo.style.border = '';
               /*  contorno.style.color= 'black'; */
               
            }
        }
    })    
}

function contatore(id_button){
var valore =$('#' + id_button).val();
$.ajax({
    type: "post",
    url: "../../../function/contatore.php",
    data: "bottone=" + valore,
    success: function(response){
        var prova = response;
      console.log(prova);
    }
})  
}
/* funzione per copiare il link e inviarlo al cliente */
function copia(testo) {
    var input = document.createElement('input');
    var area = document.getElementById(testo).value;
    input.setAttribute('value', area);
    document.body.appendChild(input);
    input.select();
    var risultato = document.execCommand('copy');
    document.body.removeChild(input);
  /*   alert('link copiato: ora puoi inviarlo al cliente '); */
    return risultato;
}


       function cancella_fotografo() {
            //controlla che la casella di testo contenga un valore
            if (document.forms['modulo_fotografo']['cancella_fotografo'].value !== "Elimina Fotografo") {
                document.getElementById('console_fotografo').innerHTML = "Devi scrivere esattamente : Elimina Fotografo.<br/>";
            } else {
                //chiede conferma se eseguire l'operazione
                var ok = confirm("Sei sicuro di voler cancellare il fotografo, i suoi album e i suoi clienti in modo irreversibile?");
                if (ok)
                    //invia il form
                    document.getElementById('modulo_fotografo').submit();
                else
                    document.getElementById('console_fotografo').innerHTML = "Operazione NON confermata.";
            }
        }

        function resetta_fotografo() {
            document.getElementById('console_fotografo').innerHTML = "";
                 document.forms['modulo_fotografo']['cancella_fotografo'].value = "";
              }



        function conferma_cancellazione_album() {
            //controlla che la casella di testo contenga un valore
            if (document.forms['modulo']['cancella'].value !== "cancella album") {
                document.getElementById('console').innerHTML = "Devi scrivere esattamente : cancella album.<br/>";
            } else {
                //chiede conferma se eseguire l'operazione
                var ok = confirm("Sei sicuro di voler cancellare l'intero album in modo irreversibile?");
                if (ok)
                    //invia il form
                    document.getElementById('modulo').submit();
                else
                    document.getElementById('console').innerHTML = "Operazione NON confermata.";
            }
        }

        function cancella_selezione_cliente(){
            var ok = confirm("Sei sicuro di voler cancellare l'intero album in modo irreversibile?");
            if (ok)
                //invia il form
                document.getElementById('modulo').submit();
            else
                document.getElementById('console').innerHTML = "Operazione NON confermata.";
        }
        
function resetta() {
  document.getElementById('console').innerHTML = "";
       document.forms['modulo']['cancella'].value = "";
    }


   /*    SCRIPT JS PER LA DIMENSIONE DELLE IMMAGINI */
   
        function dsmall(){
            var card=(document.getElementsByClassName ("card"));
            for(i=0;i<card.length;i++){
                document.querySelectorAll('#card_foto')[i].style.width = '8rem';
       
                 }
            }
        
        function dmedium(){
            var card=(document.getElementsByClassName ("card"));
            for(i=0;i<card.length;i++){
                document.querySelectorAll('#card_foto')[i].style.width = '12rem';
        
                 }
            }
        function dbig(){
            var card=(document.getElementsByClassName ("card"));
            for(i=0;i<card.length;i++){
                document.querySelectorAll('#card_foto')[i].style.width = '16rem';
        
                 }
            }
            function dfull(){
            var card=(document.getElementsByClassName ("card"));
            for(i=0;i<card.length;i++){
                document.querySelectorAll('#card_foto')[i].style.width = '26rem';
        
                 }
            }

            function dxlfull(){
                var card=(document.getElementsByClassName ("card"));
                for(i=0;i<card.length;i++){
                    document.querySelectorAll('#card_foto')[i].style.width = '36rem';
            
                     }
                }
           
         


       /*    inserisci logo nella grafica */

          function inserisci(prendi,inserisci,oggetto){
            if(oggetto == 'testo'){
var testo=document.getElementById(prendi).value;
document.getElementById(inserisci).innerHTML = testo;
localStorage["testo"]= testo;
console.log(localStorage.getItem("testo"));
            }else if(oggetto == 'logosx'){
              var logo=document.getElementById(prendi).value;
document.getElementById(inserisci).src=logo;
localStorage.setItem("logosx", logo);
console.log(logo);  
            }else if(oggetto == 'logodx'){
              var logo=document.getElementById(prendi).value;
document.getElementById(inserisci).src=logo;
localStorage.setItem("logodx", logo);
console.log(logo); 

/* }else if(oggetto == 'center_size'){
    var center_size=document.getElementById(prendi).value;
document.getElementById(inserisci).style.height=center_size;
localStorage.setItem("center_size", center_size); */
 

}else if(oggetto == 'grafica_color'){
    var center_color=document.getElementById(prendi).value;
document.getElementById(inserisci).src=center_color;
localStorage.setItem("center_color", center_color);


}else if(oggetto == 'text_size'){
    var text_size=document.getElementById(prendi).value;
document.getElementById(inserisci).style.fontSize =text_size;
localStorage.setItem("text_size", text_size);

}else if(oggetto == 'text_color'){
    var text_color=document.getElementById(prendi).value;
document.getElementById(inserisci).style.color=text_color;
localStorage.setItem("text_color", text_color);

}else{
             
    document.getElementById('center').src='';
    /* localStorage.setItem("center_color", ''); */
    document.getElementById('logosx').src='';
   /*  localStorage.setItem("logosx", ''); */
    document.getElementById('logodx').src='';
    /* localStorage.setItem("logodx", ''); */
    document.getElementById('textGrafica').innerHTML='';
    /* localStorage.setItem("testo", ''); */
      
                }
}