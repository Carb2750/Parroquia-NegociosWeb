<?php
    require_once 'models/security/security.model.php';
    function run(){
        $viewData = array();
        $viewData["userName"] = $_SESSION["userName"];
        $viewData["userCell"] = $_SESSION["userCell"];
        $viewData["userCod"] = $_SESSION["userCod"];
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            
            include_once "libs/validadores.php";
            if(isset($_POST["btnConfirmar"])){
                $varBody = $_POST;
                $validated = true;
                if($varBody["token"]!=$_SESSION["user_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Categorias");
                }
                if(!validPhone($varBody["orderCell"])){
                    $viewData["userCell"] = "";
                    $viewData["cellErr"]="Telefono Invalido";
                    $viewData["cErr"]="error";
                    $validated=false;
                }
                if($validated){
                    $result=updateUserNameCell($varBody["userName"], $varBody["orderCell"],$viewData["userCod"]);
                    if($result){
                        $_SESSION["userCell"] = $varBody["orderCell"];
                        $_SESSION["userName"] = $varBody["userName"];
                        redirectWithMessage("Cambios Realizados Correctamente","index.php?page=start");
                     }else{
                        $viewData["hasErrors"]=true;
                           $viewData["errors"][]="No se pudo realizar los cambios";
                     }
                }
    
            }
        }
        $viewData["token"] = md5("token_user".time());
        $_SESSION["user_token"] = $viewData["token"];    
        renderizar('user/user', $viewData);
    }
    run();
?>