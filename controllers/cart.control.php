<?php 
    require_once 'models/support/cart.model.php';
    function run(){
        $viewData = array();
        $viewData["hasItems"]=false;
        $viewData["subtotal"]=0;
        $viewData["newCart"]=array();
        $products = array();
        $viewData["products"] = array();
        if(isset($_GET["page"])){
            $viewData["page"]=$_GET["page"];
        }
        if(!isset($_SESSION["cart"])){
            $_SESSION["cart"]=array();
        }
        //echo '<pre>'.print_r($_SESSION["cart"]).'</pre>';
        if(isset($_SESSION["cart"])){
            $products = getCartItems($viewData["page"]);
            mergeFullArrayTo($products,$viewData);
            $viewData["subtotal"]=getCartTotal();
            $viewData["subtotal"]= sprintf('%0.2f', $viewData["subtotal"]);
            if($viewData["subtotal"]>0){
                $viewData["hasItems"]=true;
            }
        //echo '<pre>'.print_r($viewData["products"]).'</pre>';
        }//Cart Session
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $varBody = $_POST;
            //echo '<pre>'.print_r($_POST).'</pre>';
            if(isset($_POST["btnPagar"])){
                if(empty($_SESSION["cart"]) || $_SESSION["cartSize"]==0){
                    redirectWithMessage("Parece que tu canasta esta vacia", "index.php?page=cartL");
                }
                if(checkCartStock()){
                    redirectWithMessage("Parece que algo en tu canasta ya no se encuentra disponible", "index.php?page=cartL");
                }
                redirectToUrl("index.php?page=Checkout");
            }
            if(isset($_POST["btnAdd"])){
                plusCart($varBody["cartCod"],$varBody["prdQuantity"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnAdd
            if(isset($_POST["btnLess"])){
                removeCart($varBody["cartCod"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnLess

            if(isset($_POST["btnTrash"])){
                echo "hola";
                trashCart($varBody["cartCod"],$varBody["prdQuantity"]);
                redirectToUrl("index.php?page=".$viewData["page"]);
            }//btnTrash
        }//Server Request
        
        //echo '<pre>'.print_r($_SESSION["cart"]).'</pre>';
        renderizar("cart", $viewData);
    }
    run();
?>