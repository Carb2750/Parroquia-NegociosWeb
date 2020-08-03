<?php 
require_once 'models/security/security.model.php';
    function run(){
        $viewData = array();
        if(isset($_GET["userEmail"])){
            $info = obtainUserByEmail($_GET["userEmail"]);
            mergeFullArrayTo($info,$viewData);
        }
        $viewData["requested"] = false;
        if(isset($_GET["token"])){
            $viewData["urlToken"] = $_GET["token"];
        }
        if($viewData["urlToken"]!=$viewData["userPswdChg"]){
            error_log("Critical Token Error");
            redirectWithMessage("Pedido Equivocado, vuelve a intentar", "index.php?page=login");
        }
        
        //echo '<pre>'.print_r($viewData).'</pre>';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once "libs/validadores.php";
            if(isset($_POST["btnConfirmar"])){
                $varBody = array();
                $varBody = $_POST;
                $validated = true;
                
                if($varBody["token"]!=$_SESSION["pwsd_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=login");
                }
                if($varBody["newPswd"]!=$varBody["retypePswd"]){
                    $viewData["pasErr"]="Contraseñas diferentes";
                    $viewData["pErr"]="error";
                    $validated=false;
                }
                if(!isValidPassword($varBody["newPswd"])){
                    $viewData["pwdsErr"]="Contraseña Invalida";
                    $viewData["wErr"]="error";
                    $validated=false;
                }
                if($validated){
                    $timestampNow = time();
                    $newPswd = pswd($varBody["userEmail"],$varBody["newPswd"],$timestampNow);
                    $result=updatePasswordByMail($varBody["userEmail"], $newPswd,$timestampNow);
                    if($result){
                        forgotPassword($viewData["userEmail"],'');
                        redirectWithMessage("Contraseña Actualizada Correctamente","index.php?page=login");
                     }else{
                            $viewData["hasErrors"]=true;
                           $viewData["errors"][]="No se pudo cambiar la Contraseña";
                     }
                }
            }
        }
        $viewData["token"] = md5("token_pwsd".time());
        $_SESSION["pwsd_token"] = $viewData["token"];   
        renderizar('security/pwsd',$viewData);
    }
    function pswd($userEmail,$password,$timestamp){//Salado de Contraseña
        $passwordSltd = "";
        if($timestamp%2==0)
            $passwordSltd = $userEmail.$password.$timestamp;
        else
            $passwordSltd = $timestamp.$userEmail.$password;
        
        $passwordSltd = md5($passwordSltd.$timestamp);

        return $passwordSltd;
    }
    run();
?>