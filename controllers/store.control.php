<?php 
    require_once 'models/security/product.model.php';
    require_once 'models/security/category.model.php';
    require_once 'models/security/variations.model.php';
    require_once 'models/support/cart.model.php';
    function run(){
        $viewData = array();
        $viewData["categories"]=getCategoriesWithActiveProducts();
        
        $viewData["products"] = getActiveProducts();
        $viewData=variations($viewData);
        
        $viewData["activeFilter"]="";
        $viewData["check"]='<i class="fas fa-check"></i>';
        $codeExists = "";
        if(!isset($_SESSION["cart"])){
            $_SESSION["cart"]=array();
        }
        if(isset($_GET["page"])){
            $viewData["page"]=$_GET["page"];
            foreach($viewData["categories"] as $key => $value){
                $viewData["categories"][$key]["page"]=$_GET["page"];
            }
        }
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $varBody = $_POST;
                if(isset($_POST["btnCart"])){
                    if(addCart($varBody["radio"],$varBody["prdCod"])){
                        redirectWithMessage("Lo que ordenaste ya no se encuentra disponible", "index.php?page=".$viewData["page"]);
                    }
                    redirectToUrl("index.php?page=".$viewData["page"]);
                }//btnCart   
                if(isset($_POST["btnCheckout"])){
                    resetCart();
                    if(addCart($varBody["radio"],$varBody["prdCod"])){
                        redirectWithMessage("Lo que ordenaste ya no se encuentra disponible", "index.php?page=".$viewData["page"]);
                    }
                    redirectToUrl("index.php?page=Checkout");     
                }//btnCheckout 
                if(isset($_POST["btnFiltro"])){
                    $viewData["products"]=getActiveProductByCategoryCode($varBody["catCod"]);
                    $viewData=variations($viewData);
                    $viewData["check"]='';
                    foreach($viewData["categories"] as $key => $value){
                        $viewData["categories"][$key]["page"]=$_GET["page"];
                        if($viewData["categories"][$key]["catCod"]===$varBody["catCod"]){
                            $viewData["categories"][$key]["check"]='<i class="fas fa-check"></i>';
                        }
                    }
                }   
        }
        renderizar("store",$viewData);    
    }
    function variations($viewData){
        foreach($viewData["products"] as $key1 => $value){
        $viewData["products"][$key1]["page"]=$_GET["page"];
            if(!empty(getActiveVariations($viewData["products"][$key1]["prdCod"]))){
                $viewData["products"][$key1]["variations"]=getActiveVariations($viewData["products"][$key1]["prdCod"]);
                    foreach($viewData["products"][$key1]["variations"] as $key2 => $value){
                        $viewData["products"][$key1]["variations"][$key2]["prdDscES"]=$viewData["products"][$key1]["prdDscES"];
                        $viewData["products"][$key1]["variations"][$key2]["variationCod"]=
                        $viewData["products"][$key1]["prdCod"].'_'.$viewData["products"][$key1]["variations"][$key2]["variationCod"];
                    }
            }
        }
        return $viewData;
    }
    
    run();

?>