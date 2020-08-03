<?php 
require_once 'models/security/security.model.php';
require_once "libs/sendmail.php";
    function run(){
        $viewData = array();
        $viewData["correo"]=false;
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once "libs/validadores.php";
            if(isset($_POST["btnConfirmar"])){
                $varBody = $_POST;
                $validated = true;
                if($varBody["token"]!=$_SESSION["forgot_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=login");
                }
                if(userToken($varBody["txtEmail"])!=''){
                    $validated = false;
                    $viewData["correo"]=true;
                }
                if (!isValidEmail($varBody["txtEmail"])) {
                    $viewData["emaErr"]="Correo Invalido";
                    $viewData["eErr"]="error";
                    $validated=false;
                }
                if(!userExists($varBody["txtEmail"])){
                    $viewData["existErr"] = "Correo no Encontrado";
                    $viewData["xErr"]="error";
                    $validated=false;
                }
                if($validated){
                    $timestamp = time();
                    
                    if($timestamp%2==0){
                        $token = md5($timestamp.'forgot'.$varBody["txtEmail"]);
                      }
                      else{
                        $token = md5($varBody["txtEmail"].'forgot'.$timestamp);
                      }
                      $result =forgotPassword($varBody["txtEmail"],$token);
                    if($result){
                        $html = createHtmlBody($varBody["txtEmail"],$token);
                        sendemail($varBody["txtEmail"], 'Cambio de Contraseña', $html);
                        $viewData["correo"] = true;
                    }else{
                        redirectWithMessage("Sucedio un error, vuelve a intentar", "index.php?page=login");
                    }
                }
            }
        }
        $viewData["token"] = md5("token_forgot".time());
        $_SESSION["forgot_token"] = $viewData["token"];
        renderizar('security/forgot',$viewData);
    }
    function createHtmlBody($email,$token){
        $htmlBody = '<!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Food Service</title>
                <style>
                    * {
                    font-family: "Poppins", sans-serif;
                    }
        
                    .mail {
                    background-color: #d80000;
                    padding: 1em;
                    }
        
                    .action-title {
                    background-color: #7a0202;
                    padding: 0.5em;
                    margin: 1em 0px;
                    border-radius: 9px;
                    }
        
                    .action-title h1 {
                    text-align: center;
                    opacity: 1;
                    color: #fff;
                    font-size: 2em !important;
                    }
        
                    .content {
                    border-radius: 9px;
                    text-align: center;
                    margin: 0em;
                    background-color: #7a0202;
                    padding: 1em;
                    color: #fff;
                    }
        
                    .content h2 {
                    background-color: transparent;
                    font-size: 2em;
                    }
                    .content .messages{
                        padding: 1.5em;
                        border-radius: 9px;
                        background-color: #d80000;
                    }
                    .content .messages li {
                        list-style: none;
                    text-align: center;
                    font-size: 1em;
                    }
                    .thanks{
                        text-align: center;
                        color: #fff;
                        font-size: 1.2em;
                        list-style: none;
                    }
                    @media (min-width: 1024px) {
                    .mail {
                        padding: 10em;
                    }
                    .content {
                        padding: 3em;
                        
                    }
                    .content .messages{
                        padding: 2em;
                        border-radius: 9px;
                        font-size: 1.5em;
                        background-color: #d80000;
                    }
                    }
        
                </style>
            </head>
            <body>
                <div class="mail">
                    <div class="action-title">
                        <h1>Food Service HN</h1>
                    </div>
                    <div class="content">
                    <ul class="messages"> 
                        <li><a href="localhost/nw/foodService/index.php?page=pwsd&userEmail='.$email.'&token='.$token.'">Cambiar Contraseña</a></li> 
                    </ul>                
                    </div>
                </div>
            </body>
            </html>';
        return $htmlBody;       
    }
run();
?>