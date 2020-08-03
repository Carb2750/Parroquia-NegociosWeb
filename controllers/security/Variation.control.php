<?php 
require_once 'models/security/variations.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["variation"] = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nueva Variacion", "UPD"=>"Actualizando Variacion", "DSP"=>"Mostrando la Variación");
    if(isset($_GET["prdCod"])){
        $viewData["prdCod"] = $_GET["prdCod"];
    }
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Variations&prdCod=".$viewData["prdCod"]);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["variation_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Variations&prdCod=".$varBody["prdCod"]);
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        
                         $result=newVariation($varBody["variationPrice"],$varBody["variationQuantity"],$varBody["variationState"],$varBody["prdCod"]);
                        
                        echo showErrors ();
                        if($result){
                            redirectWithMessage("Variacion Creada Correctamente","index.php?page=Variations&prdCod=".$varBody["prdCod"]);
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Variación";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";
                        
                        $result=updateVariation($varBody["variationCod"],$varBody["variationPrice"],$varBody["variationQuantity"],$varBody["variationState"],
                        $varBody["prdCod"]);
                        echo $result;
                        if($result){
                            redirectWithMessage("Variacion Modificada Correctamente","index.php?page=Variations&prdCod=".$varBody["prdCod"]);
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar la Variación";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_variation".time());
    $_SESSION["variation_token"] = $viewData["token"];
    
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $variations = array();
        $variations = getVariationByCode($_GET["cod"]);
        
        mergeFullArrayTo($variations, $viewData);
        $viewData["variationCod"] = $_GET["cod"];
        
    }
    if(isset($viewData["variationState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["variationState"]);
    }
    renderizar("security/Variation", $viewData);
?>