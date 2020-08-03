<?php
    require_once 'models/security/types.model.php';
    $viewData["error"] = "";
    $viewData["types"] =getTypes();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getTypeByFilter($varBody["txtFiltar"]))){
                $viewData["types"] = getTypeByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Tipos", $viewData);
?>