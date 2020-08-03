<?php

  function isEmpty($value){
    return preg_match('/^\s*$/', $value) ;
  }

  function isValidEmail($value){
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  function isValidPassword($value){
    return preg_match('/^[a-zA-Z áéíóúüÁÉÍÓÚÜÑñ0-9\-\W]{8,}$/', $value) ;
  }

  function isValidText($value){
    return preg_match("/^[a-zA-Z 'áéíóúüÁÉÍÓÚÜÑñ0-9\-&:]*$/",$value);
  }
  function isValidName($value){
    return preg_match("/^[a-zA-Z 'áéíóúüÁÉÍÓÚÜÑñ\-&:]*$/",$value);
  }
  function validPhone($value){
    return preg_match("/^[1-9][0-9]{3}[-][0-9]{4}$/",$value);
  }
  function validDirection($value){
    return preg_match("/^[a-zA-Z áéíóúüÁÉÍÓÚÜÑñ0-9\-\W]{20,}$/",$value);
  }
?>
