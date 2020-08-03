<?php 
require_once 'models/security/modules.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["module"] = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["class"]=array(
        array("classCod"=>"MNU", "classDsc"=>"Menu"),
        array("classCod"=>"PGE", "classDsc"=>"Pagina")
    );
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Modulo", "UPD"=>"Actualizando Modulo", "DSP"=>"Mostrando Modulo");
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Modulos");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            //echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["modulos_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Modulos");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";

                        $result=newModule($varBody["mdlCod"],$varBody["mdlDscES"],$varBody["mdlDscEN"],$varBody["mdlState"], $varBody["mdlClass"]);
                        
                        
                        if($result){
                            redirectWithMessage("Modulo Creado Correctamente","index.php?page=Modulos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Tipo de Modulo";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";
                        $result=updateModule($varBody["mdlCod"],$varBody["mdlDscES"],$varBody["mdlDscEN"],$varBody["mdlState"],$varBody["mdlClass"]);

                        
                        if($result){
                            redirectWithMessage("Modulo Modificado Correctamente","index.php?page=Modulos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Tipo de Usuario";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("modulos_token".time());
    $_SESSION["modulos_token"] = $viewData["token"];
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $modules = array();
        $modules = getModulesByCode($_GET["cod"]);
        mergeFullArrayTo($modules, $viewData);
        echo '<pre>'.print_r($modules).'</pre>';
    }
    if(isset($viewData["mdlState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["mdlState"]);
    }
    if(isset($viewData["mdlClass"])){
        $viewData["class"] = addSelectedCmbArray($viewData["class"],'classCod',$viewData["mdlClass"]);
    }
    renderizar("security/Modulo", $viewData);
?>