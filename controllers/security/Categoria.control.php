<?php 
require_once 'models/security/category.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nueva Categoria", "UPD"=>"Actualizando Categoria", "DSP"=>"Mostrando Categoria");
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
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Categorias");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            //echo '<pre>'.print_r($varBody).'</pre>';
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["categorias_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Categorias");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        $result=newCategory($varBody["catDscES"],$varBody["catDscEN"],$varBody["catState"]);

                        if($result){
                            redirectWithMessage("Categoria Creada Correctamente","index.php?page=Categorias");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Categoria";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";

                        $result=updateCategory($varBody["catCod"], $varBody["catDscES"], $varBody["catDscEN"],$varBody["catState"]);
                
                        if($result){
                            redirectWithMessage("Categoria Modificada Correctamente","index.php?page=Categorias");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar la categoria";
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_categorias".time());
    $_SESSION["categorias_token"] = $viewData["token"];

    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $categories = array();
        $categories = getCategoryByCode($_GET["cod"]);
        mergeFullArrayTo($categories, $viewData);
    }
    if(isset($viewData["catState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["catState"]);
    }
    renderizar("security/Categoria", $viewData);
?>