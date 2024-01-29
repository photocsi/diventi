
/* function cropped(){ */
function crop(){
    var selectDaVerificare = document.getElementById('ratio');
    var indiceSelezionato = selectDaVerificare.selectedIndex;
    var valoreSelezionato = selectDaVerificare.options[indiceSelezionato];
    var ratio = valoreSelezionato.value;
    
document.getElementById("cropImageBtn").className += "btn btn-danger"; //prima faccio cambiare colore al bottone di conferma
var image = document.getElementById('image');
if(ratio == '4/3O'){
var cropper = new Cropper(image, {
   
    aspectRatio: 8 / 6.05 ,
    viewMode: 0, 
     }); 
   }else if(ratio == '4/3V'){
    var cropper = new Cropper(image, {
       
        aspectRatio: 6 / 7.9 ,
        viewMode: 0, 
         }); 
       }else if(ratio == '2/3O'){
        var cropper = new Cropper(image, {
           
            aspectRatio: 9 / 6.05 ,
            viewMode: 0, 
             }); 
           }else if(ratio == '2/3V'){
            var cropper = new Cropper(image, {
               
                aspectRatio: 6 / 8.9 ,
                viewMode: 0, 
                 }); 
               };


document.getElementById('cropImageBtn').addEventListener('click',
function(){

     croppedImage = cropper.getCroppedCanvas().toDataURL("image/jpg");
    document.getElementById('output').src = croppedImage;
    document.getElementById('textImg').innerHTML += croppedImage;
    document.getElementById("cropImageBtn").className += "btn btn-success";//poi lo faccio diventare verde a ritaglio avvenuto
    document.getElementById("cropImageBtn").innerHTML = "Ritaglio Confermato";//poi lo faccio diventare verde a ritaglio avvenuto
  



});

 
}

 /*  SELEZIONE IN LIVE SALVO L'IMMAGINE MODIFICATA IN JS */
 function save_img64(val){
    var img64 = document.getElementById('textImg').textContent;
    var valore =$('#'+val).val();
    $.ajax({
        type: "POST",
        url: "../../../function/save_img_js.php",
        data: valore + ',' + img64 ,
        success: function(response){
         console.log(response);
         if(response === "Immagine Modificata Salvata"){
        document.getElementById('save_button').className = "btn btn-success btn"; 
        document.getElementById('img_modificata').innerHTML = response;  
         }else{
            document.getElementById('save_button').className = "btn btn-danger btn";
            document.getElementById('img_modificata').innerHTML = response;
            alert("FOTOGRAFIA NON SALVATA - Per salvare la fotografia dopo averla ritoccata applica prima il ritaglio");  
         }
        }
    })    
}


//funzioni caman

const canvas = document.getElementById('image');
/* const ctx = canvas.getContext('2d'); */


let img = new Image();
let fileName = '';

const downloadBtn = document.getElementById('download-btn');
const uploadFile = document.getElementById('upload-file');
const revertBtn = document.getElementById('revert-btn');

//ADD filter
document.addEventListener('click', e =>{
    if(e.target.classList.contains('filter-btn')){
       if(e.target.classList.contains('brightness-add')){
        Caman('#image', img , function() {
            this.brightness(5).render();
        });
       } else if  (e.target.classList.contains('brightness-remove')){
            Caman('#image', img , function() {
                this.brightness(-5).render();
            });
       }else if  (e.target.classList.contains('contrast-add')){
        Caman('#image', img , function() {
            this.contrast(5).render();
        });
   }else if  (e.target.classList.contains('contrast-remove')){
    Caman('#image', img , function() {
        this.contrast(-5).render();
    });
}else if  (e.target.classList.contains('saturation-add')){
    Caman('#image', img , function() {
        this.saturation(8).render();
    });
}else if  (e.target.classList.contains('saturation-remove')){
Caman('#image', img , function() {
    this.saturation(-8).render();
    });
}else if  (e.target.classList.contains('exsposure-remove')){
    Caman('#image', img , function() {
        this.exposure(-5).render();
    });
}else if  (e.target.classList.contains('exposure-add')){
        Caman('#image', img , function() {
            this.exposure(5).render();
        });
}else if  (e.target.classList.contains('channels-yellow')){
    Caman('#image', img , function() {
        this.channels({
            red: 2,
            green: -2,
            blue: -10,

         } ).render();
    });
}else if  (e.target.classList.contains('channels-blu')){
        Caman('#image', img , function() {
            this.channels({
                red: -2,
                green: 2,
                blue: 10,

             } ).render();
        });
    }else if  (e.target.classList.contains('channels-green')){
        Caman('#image', img , function() {
            this.channels({
                red: -2,
                green: 8,
                blue: -1,
    
             } ).render();
        });
    }else if  (e.target.classList.contains('channels-red')){
            Caman('#image', img , function() {
                this.channels({
                    red: 8,
                    green: -2,
                    blue: 2,
    
                 } ).render();
            });
        }else if  (e.target.classList.contains('seppia')){
            Caman('#image', img , function() {
                this.sepia(50).render();
            });
    }else if  (e.target.classList.contains('bw')){
        Caman('#image', img , function() {
            this.greyscale().render();
        });
}
} //close primo if
}); //close prima linea


//Upload file

/* uploadFile.addEventListener('change', (e) => {

    const file = document.getElementById('upload-file').files[0];

    const reader = new FileReader();

    if(file){
        fileName = file.name;

        reader.readAsDataURL(file);
    }

    reader.addEventListener('load' , () => {

        img = new Image();

        img.src = reader.result;

        img.onload = function()
{

    canvas.width = img.width;
    canvas.height = img.height;
    ctx.drawImage(img, 0 , 0 , img.width , img. height);
    canvas.removeAttribute('data-caman-id');
} ;
   }, false)
}) */

function reset() {
    var result = $('#reset').val();

    $.ajax({
        type: 'get',
        url: '../../../function/filtri/reset.php',
        data: 'reset='+result ,
        success: function(response) {
            console.log(response);
            window.location.reload();
        }
    })

}

function stampa(id){
    var valore =$('#' + id).val();
$.ajax({
    type: "post",
    url: "../../../function/contatore.php",
    data: "bottone=" + valore,
    success: function(response){
        var prova = response;
      console.log(prova);
    }
})  
    var printContents = document.getElementById("fotoMod").innerHTML; //ID del div da stampare
var originalContents = document.body.innerHTML; // Contenuto originale del body
document.body.innerHTML = printContents; // Setta contenuto della pagina con il div da stampare
window.print(); //Stampa
 document.body.innerHTML = originalContents;  // ripristina contenuto della pagina originale
  }