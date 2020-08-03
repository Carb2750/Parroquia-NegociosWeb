<?php 
require_once 'models/security/types.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["type"] = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Tipo de Usuario", "UPD"=>"Actualizando Tipo de Usuario", "DSP"=>"Mostrando Tipo de Usuario");
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Tipos");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            //echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["tipos_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Tipos");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        if($varBody["typeExp"]==""){
                            
                            $result=newType($varBody["typeCod"],$varBody["typeDsc"],$varBody["typeState"]);
                            
                        }
                        else{
                            $varBody["typeExp"] = '"'.$varBody["typeExp"].'"';
                            $result=newType($varBody["typeCod"],$varBody["typeDsc"],$varBody["typeState"], $varBody["typeExp"]);
                        }
                        echo showErrors ();
                        if($result){
                            redirectWithMessage("Tipo Creado Correctamente","index.php?page=Tipos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Tipo de Usuario";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";
                        if($varBody["typeExp"]==""){
                            
                            $result=updateType($varBody["typeCod"],$varBody["typeDsc"],$varBody["typeState"]);
                            
                        }
                        else{
                            $varBody["typeExp"] = '"'.$varBody["typeExp"].'"';
                            $result=updateType($varBody["typeCod"],$varBody["typeDsc"],$varBody["typeState"],$varBody["typeExp"]);
                        }
                        echo $result;
                        if($result){
                            redirectWithMessage("Tipo Modificado Correctamente","index.php?page=Tipos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Tipo de Usuario";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_type".time());
    $_SESSION["tipos_token"] = $viewData["token"];
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $types = array();
        $types = getTypeByCode($_GET["cod"]);
        mergeFullArrayTo($types, $viewData);
        $viewData["typeExp"] = date($viewData["typeExp"]);
    }
    if(isset($viewData["typeState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["typeState"]);
    }
    renderizar("security/Tipo", $viewData);
?>