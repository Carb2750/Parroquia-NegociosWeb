<?php 
require_once 'models/security/security.model.php';
require_once 'models/security/state.model.php';

    function run(){
      $viewData = array();
      $viewData["states"] = getState() ;
      $viewData["act"] = "";
      $viewData["readonly"]="";
      $viewData["mode"]= "";
      $viewData["token"]="";
      $viewData["hasErros"] = false;
      $viewData["errors"]=array();
      $viewData["userEmail"]="";
      $viewData["userName"]="";
      $viewData["updating"]="";
      $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Usuario", "UPD"=>"Actualizando Usuario", "DSP"=>"Mostrando Usuario");
      
      if(isset($_GET["act"])){
          $viewData["act"] = $_GET["act"];
          $viewData["mode"] = $viewData["modeDsc"][$viewData["act"]];
      }

      switch($viewData["act"]){
          case "INS":
              break;
          case "UPD":
            $viewData["updating"]="updating";
              break;
          case "DSP":
              $viewData["readonly"]="readonly disabled";
              break;
          default:
              redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Users");
      }
      if($_SERVER["REQUEST_METHOD"]=="POST"){

          if(isset($_POST["btnConfirmar"])){
              $varBody = array();
              $varBody = $_POST;
              //echo '<pre>'.print_r($varBody).'</pre>';
              mergeFullArrayTo($varBody, $viewData);
              $validated = true;
              if($varBody["token"]!=$_SESSION["user_token"]){
                  error_log("Critical Token Error");
                  redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Users");
              }
              if($validated){
                  switch($viewData["act"]){
                      case "INS":
                          $result = "";
                          $timestamp = time();
                          $password = "";
                          if($timestamp%2==0){
                            $password = $varBody["userEmail"].$varBody["userPswd"].$timestamp;
                          }
                          else{
                            $password = $timestamp.$varBody["userEmail"].$varBody["userPswd"];
                          }
                          $password = md5($password.$timestamp);
                          $result=newUser($varBody["userEmail"], $varBody["userName"],$password, $timestamp,
                          $varBody["userCell"], $varBody["userState"],$userPswdState='ACT' );
                          if($result){
                              redirectWithMessage("Usuario Creado Correctamente","index.php?page=Users");
                          }else{
                              $viewData["hasErrors"]=true;
                              $viewData["errors"][]="No se pudo crear el Usuario";
                          }
                          
                          break;
                      case "UPD":
                          $result = "";
                          if($varBody["userPswd"]==""){
                            $user = getUserByCode($_GET["cod"]);
                            $password = $user["userPswd"];
                            $userCod = $user["userCod"];
                            $timestamp=$user["userRgstrd"];
                            $result=updateUser($userCod,$varBody["userEmail"], $varBody["userName"], $password, $timestamp,$varBody["userCell"],
                            $varBody["userState"]);
                          }
                          else{
                            $timestamp = time();
                            $password = "";
                            $userCod = $_GET["cod"];
                            if($timestamp%2==0){
                              $password = $varBody["userName"].$varBody["userPswd"].$timestamp;
                            }
                            else{
                              $password = $timestamp.$varBody["userName"].$varBody["userPswd"];
                            }
                            $password = md5($password.$timestamp);
                            $result=updateUser($userCod,$varBody["userEmail"], $varBody["userName"], $password, $timestamp,$varBody["userCell"],
                              $varBody["userState"]);
                          }
                          if($result){
                              redirectWithMessage("Usuario Modificado Correctamente","index.php?page=Users");
                          }else{
                              $viewData["hasErrors"]=true;
                              $viewData["errors"][]="No se pudo modificar el Usuario";
                          }
                          break;
                          
                  }
              }

          }
      }
      $viewData["token"] = md5("token_user".time());
      $_SESSION["user_token"] = $viewData["token"];

      if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
          $user = array();
          $user = getUserByCode($_GET["cod"]);
          mergeFullArrayTo($user, $viewData);
      }
      if(isset($viewData["userState"])){
          $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["userState"]);
      }
      //echo '<pre>'.print_r($viewData).'</pre>';
      renderizar("security/User", $viewData);
    }
    run();
?>