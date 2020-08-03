<?php
    require_once 'models/security/security.model.php';
    
    function run(){
      $viewData["error"] = "";

      $viewData["users"]=getUserByFilter('');
      
      if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getUserByFilter($varBody["txtFiltar"]))){
                $viewData["types"] = getUserByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
      }
          
      renderizar("security/Users", $viewData);
    }
    run();
?>