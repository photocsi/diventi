<?php

/* CONVALIDA EMAIL */
function convalida_email($email){
    $checkemail="";
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $checkemail=TRUE;
  } else {
    $checkemail=FALSE;
  }
  return $checkemail;
}

/* CONVALIDA PASSWORD */
function convalida_pass($password){
    define("INSUFFICENTE","/^[\w\d\S]{1,7}+$/"); /* pass troppo corta */
define("DEBOLE","/^([a-z]+|[A-Z]){8,20}+$/"); /* solo lettere pass debole */
define("BUONA","/^[\w]{8,20}$/");   /*  lettere e numeri minimo 8 caratteri buona */
define("OTTIMA","/^[\w\d\S]{8,20}+$/");


if(preg_match(DEBOLE,$password)) { $checkPass[]=FALSE; $checkPass[]="  Debole usa anche numeri";}
else if(preg_match(BUONA,$password)) { $checkPass[]=TRUE; $checkPass[]=" Pass Buona";}
else if(preg_match(OTTIMA,$password)) { $checkPass[]=TRUE; $checkPass[]=" Pass Ottima";}
else if(preg_match(INSUFFICENTE,$password)) { $checkPass[]=FALSE; $checkPass[]=" Troppo corta minimo 8 caratteri";}
else {$checkPass[]=FALSE; $checkPass[]=" Non valida, rispetta le condizioni";}

return $checkPass;
}

/* CONVALIDA NUMERO DI TELEFONO */

function convalida_telefono($telefono){
  define("TELEFONO","/^[\d]{10,11}+$/");
  if(preg_match(TELEFONO,$telefono)) { $check_telefono[]=TRUE; $check_telefono[]="ok" ;} else { $check_telefono[]=FALSE; $check_telefono[]=" non valido";}
  return $check_telefono;
}

/* CONVALUDA USERNAME */

function convalida_username($username){
 
  if( filter_var($username, FILTER_VALIDATE_REGEXP, [
    "option" =>[
      "regexp" => "/^[a-z|d_]{3,20}$/i"
    
    ]
    ])){
    $check_username=TRUE;
  }else{
    $check_username=FALSE;
}
return $check_username;
}
?>