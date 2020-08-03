<?php
    require_once 'models/security/status.model.php';
    $viewData["error"] = "";
    $viewData["status"] =getStatuses();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getStatusesByFilter($varBody["txtFiltar"]))){
                $viewData["category"] = getStatusesByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Statuses", $viewData);
?>