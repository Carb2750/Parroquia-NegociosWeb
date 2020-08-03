<?php 
require_once 'models/security/pagos.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nueva Forma de Pago", "UPD"=>"Actualizando Forma de Pago", "DSP"=>"Mostrando Forma de Pago");
    if(isset($_GET["act"])){
        $viewData["act"] = $_GET["act"];
        $viewData["mode"] = $viewData["modeDsc"][$viewData["act"]];
    }

    switch($viewData["act"]){
        case "INS":
            break;
        case "UPD":
            break;
        case "DSP":
            $viewData["readonly"]="readonly disabled";
            break;
        default:
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Pagos");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["payments_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Pagos");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        $result=newPayment($varBody["paymentCod"],$varBody["paymentDscES"],$varBody["paymentDscEN"],$varBody["paymentLib"],$varBody["paymentState"]);
                        echo showErrors();
                        if($result){
                            redirectWithMessage("Forma de Pago Creada Correctamente","index.php?page=Pagos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Forma de Pago";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";

                        $result=updatePayment($varBody["paymentCod"], $varBody["paymentDscES"], $varBody["paymentDscEN"],$varBody["paymentLib"],
                        $varBody["paymentState"]);
                
                        if($result){
                            redirectWithMessage("Forma de Pago Modificada Correctamente","index.php?page=Pagos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar la Forma de Pago";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("payments_token".time());
    $_SESSION["payments_token"] = $viewData["token"];

    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $payments = array();
        $payments = getPaymentsByCode($_GET["cod"]);
        mergeFullArrayTo($payments, $viewData);
    }
    if(isset($viewData["paymentState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["paymentState"]);
    }
    renderizar("security/Pago", $viewData);
?>