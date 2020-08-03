<?php
    require_once 'models/security/variations.model.php';
    require_once 'models/security/product.model.php';
    $viewData["error"] = "";
    $viewData["prdCod"]="";
    if(isset($_GET["prdCod"])){
        $viewData["prdCod"] = $_GET["prdCod"];
        $viewData["variations"] = getVariations($viewData["prdCod"]);
        $products = array();
        $products = getProductByCode($viewData["prdCod"]);
        mergeFullArrayTo($products,$viewData);
    }
    


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getVariationsByFilter($varBody["txtFiltar"],$varBody["prdCod"]))){
                $viewData["product"] = getVariationsByFilter($varBody["txtFiltar"],$varBody["prdCod"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    
    renderizar("security/Variations", $viewData);
?>