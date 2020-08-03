<?php
    require_once 'models/security/product.model.php';
    $viewData["error"] = "";
    $viewData["product"] =getProducts();
    echo showErrors();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getProductsByFilter($varBody["txtFiltar"]))){
                $viewData["product"] = getProductsByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Productos", $viewData);
?>