<?php
require_once 'models/security/security.model.php'; 
    function run(){
        $viewData=array();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once "libs/validadores.php";
            if(isset($_POST["btnConfirmar"])){
                $varBody = $_POST;
                $validated = true;
                if($varBody["token"]!=$_SESSION["signup_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=home");
                }
                if(userExists($varBody["txtEmail"])){
                    $viewData["existErr"] = "Correo ya Existente";
                    $viewData["xErr"]="error";
                    $validated=false;
                }
                if(!isValidName($varBody["txtNombre"])){
                    $viewData["nameErr"]="Numeros o caracteres especiales";
                    $viewData["nErr"]="error";
                    $validated=false;
                }
                if(!isValidName($varBody["txtApellido"])){
                    $viewData["apeErr"]="Numeros o caracteres especiales";
                    $viewData["aErr"]="error";
                    $validated=false;
                }
                if (!isValidEmail($varBody["txtEmail"])) {
                    $viewData["emaErr"]="Correo Invalido";
                    $viewData["eErr"]="error";
                    $validated=false;
                }
                if($varBody["txtPswd"]!=$varBody["txtRePswd"]){
                    $viewData["pasErr"]="Contraseñas diferentes";
                    $viewData["pErr"]="error";
                    $validated=false;
                }
                if(!isValidPassword($varBody["txtPswd"])){
                    $viewData["pwdsErr"]="Contraseñas Invalida";
                    $viewData["wErr"]="error";
                    $validated=false;
                }
                if($validated){
                    $timestamp = time();
                    $nombreCompleto = $varBody["txtNombre"].' '.$varBody["txtApellido"];
                    $userPswd = pswd($varBody["txtEmail"],$varBody["txtPswd"],$timestamp);
                    $result=newUser($varBody["txtEmail"],$nombreCompleto,$userPswd,$timestamp);
                    $result2 = addRole('CLI',$result);
                    if($result && $result2){
                        mw_setEstaLogueado(
                            $result,
                            $nombreCompleto,
                            $varBody["txtEmail"],
                            '',
                            'CLI',
                            true
                        );
                        header("Location:index.php?page=start");
                    }else{
                        $viewData["hasErrors"]=true;
                        $viewData["errors"][]="No se pudo modificar la Crear el usuario";
                    }
                }
            }
        }
        $viewData["token"] = md5("token_signup".time());
        $_SESSION["signup_token"] = $viewData["token"];
        renderizar("security/signup",$viewData);
    }
    function pswd($userEmail,$password,$timestamp){
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