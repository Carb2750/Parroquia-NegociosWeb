<?php 
require_once 'models/security/status.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Estado", "UPD"=>"Actualizando Estado", "DSP"=>"Mostrando Estado");
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Statuses");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            //echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["status_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Statuses");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        $result=newStatus($varBody["statusCod"],$varBody["statusDscES"],$varBody["statusDscEN"]);

                        if($result){
                            redirectWithMessage("Estado Creado Correctamente","index.php?page=Statuses");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Estado";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";

                        $result=updateStatus($varBody["statusCod"], $varBody["statusDscES"], $varBody["statusDscEN"]);
                
                        if($result){
                            redirectWithMessage("Estado Modificad Correctamente","index.php?page=Statuses");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Estado";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_status".time());
    $_SESSION["status_token"] = $viewData["token"];

    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $statuses = array();
        $statuses = getStatusesByCode($_GET["cod"]);
        mergeFullArrayTo($statuses, $viewData);
    }
    renderizar("security/Status", $viewData);
?>