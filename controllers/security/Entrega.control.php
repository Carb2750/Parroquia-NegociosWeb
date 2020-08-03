<?php 
include_once 'models/security/neighborhood.model.php';
require_once 'models/security/state.model.php';
function run(){
    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Lugar de Entrega", "UPD"=>"Actualizando Lugar de Entrega", "DSP"=>"Mostrando Lugar de Entrega");
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Entregas");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            //echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["entregas_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Entregas");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        $result=newHood($varBody["hoodDsc"],$varBody["hoodShippingFee"],$varBody["hoodState"]);

                        if($result){
                            redirectWithMessage("Lugar de Entrega Creado Correctamente","index.php?page=Entregas");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Lugar de Entrega ";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";

                        $result=updateHood($varBody["hoodCod"], $varBody["hoodDsc"], $varBody["hoodShippingFee"],$varBody["hoodState"]);
                
                        if($result){
                            redirectWithMessage("Lugar de Entrega Modificado Correctamente","index.php?page=Entregas");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Lugar de Entrega";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_entregas".time());
    $_SESSION["entregas_token"] = $viewData["token"];

    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $hoods = array();
        $hoods = getHoodByCode($_GET["cod"]);
        mergeFullArrayTo($hoods, $viewData);
    }
    if(isset($viewData["hoodState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["hoodState"]);
    }
    renderizar("security/Entrega", $viewData);
}
run();
?>