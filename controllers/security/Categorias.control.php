<?php
    require_once 'models/security/category.model.php';
    $viewData["error"] = "";
    $viewData["category"] =getCategories();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getCategoriesByFilter($varBody["txtFiltar"]))){
                $viewData["category"] = getCategoriesByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Categorias", $viewData);
?>