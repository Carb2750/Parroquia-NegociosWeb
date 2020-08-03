<?php
    require_once 'models/security/pagos.model.php';
    $viewData["error"] = "";
    $viewData["payment"] =getPayments();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getPaymentsByFilter($varBody["txtFiltar"]))){
                $viewData["payment"] = getPaymentsByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Pagos", $viewData);
?>