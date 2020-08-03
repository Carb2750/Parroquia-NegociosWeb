<?php
    require_once 'models/support/management.model.php';
    $viewData["error"] = "";
    $viewData["management"] =obtainManagements();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(obtainManagementsByFilter($varBody["txtFiltar"]))){
                $viewData["management"] = obtainManagementsByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    if(isset($_GET["cod"])){
        $result = "";
        $result=activateManagement($_GET["cod"]);
        if($result)
            redirectWithMessage("Horario Activado Correctamente","index.php?page=Manejos");
        else
            redirectWithMessage("Error Horario no Activado","index.php?page=Manejos");
    }
    renderizar("security/Manejos", $viewData);
?>