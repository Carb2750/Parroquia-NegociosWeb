<?php 
require_once 'models/security/security.model.php';
    function run(){
        $viewData = array();
        if(isset($_SESSION["userEmail"])){
            $info = obtainUserByEmail($_SESSION["userEmail"]);
            mergeFullArrayTo($info,$viewData);
        }
        //echo '<pre>'.print_r($viewData).'</pre>';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once "libs/validadores.php";
            if(isset($_POST["btnConfirmar"])){
                $varBody = $_POST;
                $validated = true;
                if($varBody["token"]!=$_SESSION["change_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=start");
                }
                $timestampOld = $viewData["userRgstrd"];
                $timestampNow = time();
                
                $oldPwsd = pswd($varBody["oldPswd"],$timestampOld);
                $newPswd = pswd($varBody["newPswd"],$timestampOld);


                if($oldPwsd!=$viewData["userPswd"]){
                    $viewData["oldErr"]="Contraseña actual no coincide con la anterior";
                    $viewData["oErr"]="error";
                    $validated=false;
                }
                if($newPswd==$viewData["userPswd"]){
                    $viewData["useErr"]="Contraseña actual es la que ya utiliza";
                    $viewData["oErr"]="error";
                    $validated=false;
                }
                if(!isValidPassword($varBody["newPswd"])){
                    $viewData["pwdsErr"]="Contraseñas Invalida";
                    $viewData["wErr"]="error";
                    $validated=false;
                }
                if($varBody["newPswd"]!=$varBody["retypePswd"]){
                    $viewData["pasErr"]="Contraseñas diferentes";
                    $viewData["pErr"]="error";
                    $validated=false;
                }
                $newPswd = pswd($varBody["newPswd"],$timestampNow);
                if($validated){
                    $result=updatePassword($_SESSION["userCod"], $newPswd,$timestampNow);
                    if($result){
                        redirectWithMessage("Contraseña Actualizada Correctamente","index.php?page=start");
                     }else{
                        $viewData["hasErrors"]=true;
                           $viewData["errors"][]="No se pudo cambiar la Contraseña";
                     }
                }
            }
        }
        $viewData["token"] = md5("token_change".time());
        $_SESSION["change_token"] = $viewData["token"];   
        renderizar('user/Change',$viewData);
    }
    function pswd($password,$timestamp){//Salado de Contraseña
        $passwordSltd = "";
        if($timestamp%2==0)
            $passwordSltd = $_SESSION["userName"].$password.$timestamp;
        else
            $passwordSltd = $timestamp.$_SESSION["userName"].$password;
        
        $passwordSltd = md5($passwordSltd.$timestamp);

        return $passwordSltd;
    }
    run();
?>