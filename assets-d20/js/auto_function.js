

let caricamento = document.getElementById('loadup');
let colorAlert = document.getElementById('main');
let control = document.getElementById('main').style.backgroundColor;
caricamento.onload = function(){
   console.log(control);
   if(control == 'red'){
   colorAlert.style.backgroundColor = 'green';
   }
}

function startUpload(){
   let colorAlert = document.getElementById('main'); 
   colorAlert.style.backgroundColor = 'red';
}