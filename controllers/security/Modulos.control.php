<?php
    require_once 'models/security/modules.model.php';
    $viewData["error"] = "";
    $viewData["module"] =getModules();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getModulesByFilter($varBody["txtFiltar"]))){
                $viewData["module"] = getModulesByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Modulos", $viewData);
?>