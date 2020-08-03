<?php
    require_once 'models/security/product.model.php';
    require_once 'models/security/variations.model.php';
    function getCartTotal(){
        $cart = array();
        $cartTotal = 0;
        if(!empty($_SESSION["cart"])){
            array_splice($_SESSION["cart"],0,0);
            /*Convierte la Informacion de la Session["cart] a los productos de la base */
            foreach($_SESSION["cart"] as $key => $value){
                $cart["items"][]=$_SESSION["cart"][$key]["prdCod"];
                if (strpos($cart["items"][$key], '_') !== false) {
                    $str=$cart["items"][$key];
                    $cart["items"][$key]=explode('_',$str);
                }
            }
            foreach($cart["items"] as $key => $value){
                
                if(is_array($cart["items"][$key])){//Si es una variacion del producto
                    $variations=getVariationByCode($cart["items"][$key][1]);
                    $cart["products"][$key]=getProductByCode($variations["prdCod"]);
                    mergeFullArrayTo($variations,$cart["products"][$key]);
                    $cart["products"][$key]["cartQuantity"]=$_SESSION["cart"][$key]["cartQuantity"];
                    $cartTotal+=floatval(floatval($cart["products"][$key]["cartQuantity"])*floatval($cart["products"][$key]["prdPrice"]));
                }
                else{//Si no es una variacion
                    $cart["products"][$key]=getProductByCode($cart["items"][$key]);
                    $cart["products"][$key]["cartQuantity"]=$_SESSION["cart"][$key]["cartQuantity"];
                    $cartTotal+=floatval(floatval($cart["products"][$key]["prdPrice"])*floatval($cart["products"][$key]["cartQuantity"]));
                }
            }//Foreach 
        }
        
        return $cartTotal;
    }
    function getCartItems($page=''){
        $cart = array();
        $cartItems= array();
        if(!empty($_SESSION["cart"])){
            array_splice($_SESSION["cart"],0,0);
            /*Convierte la Informacion de la Session["cart] a los productos de la base */
            foreach($_SESSION["cart"] as $key => $value){
                $cart["items"][]=$_SESSION["cart"][$key]["prdCod"];
                if (strpos($cart["items"][$key], '_') !== false) {
                    $str=$cart["items"][$key];
                    $cart["items"][$key]=explode('_',$str);
                }
            }   
            foreach($cart["items"] as $key => $value){
                if(is_array($cart["items"][$key])){//Si es una variacion del producto

                    $cartItems["products"][$key]=getProductByCode($cart["items"][$key][0]);
                    $variations=getActiveVariationByCode($cart["items"][$key][1]);
                    mergeFullArrayTo($variations,$cartItems["products"][$key]);
                    
                    $cartItems["products"][$key]["cartQuantity"]=$_SESSION["cart"][$key]["cartQuantity"];
                    $cartItems["products"][$key]["cartCod"]=$_SESSION["cart"][$key]["cartCod"];
                    $cartItems["products"][$key]["page"]=$page;
                    $cartItems["products"][$key]["prdDscES"]=$cartItems["products"][$key]["prdDscES"];
                    
                }
                else{//Si no es una variacion
                    $cartItems["products"][$key]=getProductByCode($cart["items"][$key]);
                    $cartItems["products"][$key]["cartQuantity"]=$_SESSION["cart"][$key]["cartQuantity"];
                    $cartItems["products"][$key]["cartCod"]=$_SESSION["cart"][$key]["cartCod"];
                    $cartItems["products"][$key]["variations"]=false;
                    $cartItems["products"][$key]["page"]=$page;
                }
            }//Foreach 
        }
     
        return $cartItems;
    }
    function addCart($prdCod,$cod){
        $array = $prdCod;
        $valid = true;
        if(strpos($array,'_')!==false) {
            $str=$prdCod;
            $prdArray=explode('_',$str);
            $variation=getVariationStock($prdArray[1]);
            removeStock($prdArray[0],$variation["variationQuantity"]);
            $stock = getStock($prdArray[0]);
            if($stock["prdStock"]<0){
                $valid = false;
                addStock($prdArray[0],$variation["variationQuantity"]);
            }
        } else{
            $stock = getStock($prdCod);
            removeStock($prdCod,$stock["prdQuantity"]);
            $stock = getStock($prdCod);
            if($stock["prdStock"]<0){
                echo "hola";
                $valid = false;
                addStock($prdCod,$stock["prdQuantity"]);
            }
                
        }
        if($valid){
            $codeExists = false;
            foreach($_SESSION["cart"] as $key => $value){
                if($_SESSION["cart"][$key]["prdCod"]==$prdCod){
                    $codeExists = true;
                    $cod = $key;
                break;
                }       
            }
            if($codeExists){
                $_SESSION["cart"][$cod]["cartQuantity"]++;
                $_SESSION["cartSize"]++;
            }
            else{
                $size = count($_SESSION["cart"]);
                $_SESSION["cart"][$size+1]["cod"]=$cod;
                $_SESSION["cart"][$size+1]["prdCod"]=$prdCod;
                $_SESSION["cart"][$size+1]["cartQuantity"]=1;
                $_SESSION["cartSize"]++;
                $_SESSION["cart"][$size+1]["cartCod"]=$size+1;
            }
            
            return false;
        }
        return true;
    }
    function plusCart($cartCod,$prdQuantity){
        $valid = true;
        foreach($_SESSION["cart"] as $key => $value){
            if($cartCod == $_SESSION["cart"][$key]["cartCod"]){
                $prdCod = $_SESSION["cart"][$key]["prdCod"];
                break;
            }
        }
        removeStock($prdCod,$prdQuantity);
        $stock = getStock($prdCod);
        if($stock["prdStock"]<0){
            $valid = false;
            addStock($prdCod,$prdQuantity);
        }
        if($valid){
            foreach($_SESSION["cart"] as $key => $value){
                if($_SESSION["cart"][$key]["cartCod"]==$cartCod){
                    $_SESSION["cart"][$key]["cartQuantity"]++;
                    $_SESSION["cartSize"]++;
                }
            }
            return false;    
        }
        return true;
    }
    function removeCart($cartCod){
        $valid = false;
        foreach($_SESSION["cart"] as $key => $value){
            if($cartCod == $_SESSION["cart"][$key]["cartCod"]){
                $prdCod = $_SESSION["cart"][$key]["prdCod"];
                break;
            }
        }
        if(strpos($prdCod,'_') !== false) {
            $str=$prdCod;
            $prdArray=explode('_',$str);
            $variation=getVariationStock($prdArray[1]);
            $valid = true;
            addStock($prdArray[0],$variation["variationQuantity"]);
        } else{
            $stock = getStock($prdCod);
            $valid = true;
            addStock($prdCod,$stock["prdQuantity"]);
        }
        if($valid){
            foreach($_SESSION["cart"] as $key => $value){
                if($_SESSION["cart"][$key]["cartCod"]==$cartCod){
                    $_SESSION["cart"][$key]["cartQuantity"]--;
                    $_SESSION["cartSize"]--;
                }
                if($_SESSION["cart"][$key]["cartQuantity"]<=0){
                    unset($_SESSION["cart"][$key]);
                    array_splice($_SESSION["cart"],0,0);
                }
            }
            return false;    
        }
        return true;
    }
    function trashCart($cartCod,$prdQuantity){
        foreach($_SESSION["cart"] as $key => $value){
            if($_SESSION["cart"][$key]["cartCod"]==$cartCod){
                addStock($_SESSION["cart"][$key]["prdCod"],$_SESSION["cart"][$key]["cartQuantity"]*$prdQuantity);
                $_SESSION["cartSize"]-=$_SESSION["cart"][$key]["cartQuantity"];
                unset($_SESSION["cart"][$key]);
                array_splice($_SESSION["cart"],0,0);
            } 
        }
        
        echo showErrors();
    }
    function resetCart(){
        $products = getCartItems();
        $products=$products["products"];
        foreach($products as $products){                
            addStock($products["prdCod"],$products["prdQuantity"]);
        }
        $_SESSION["cartSize"] = 0;
        unset($_SESSION["cart"]);
    }
    function checkCartStock(){
        $products = getCartItems();
        $invalidStock = array();
        $products=$products["products"];
        foreach($products as $products){
            addStock($products["prdCod"],$products["prdQuantity"]); 
            $stock = getStock($products["prdCod"]);
            $stock = $stock["prdStock"];
            if(($stock - $products["prdQuantity"])<0){
                $invalidStock[] = $products["prdCod"];
            }
            removeStock($products["prdCod"],$products["prdQuantity"]);              
        }
        if(!empty($invalidStock)){
            foreach($_SESSION["cart"] as $keyCart => $cart){
                foreach($invalidStock as $invalidStock){
                    if($cart["cod"]==$invalidStock){
                        unset($_SESSION["cart"][$keyCart]);
                        $_SESSION["cartSize"]--;

                    }
                }
            }
            return true;
        }
        return false; 
    }
    
?>