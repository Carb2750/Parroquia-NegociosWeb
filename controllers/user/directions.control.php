<?php
    require_once 'models/security/neighborhood.model.php';
    function run(){
        $viewData = array();
        $viewData["hood"]=getActiveHoods();
        $viewData["show"] = "hidden";
        $viewData["userCod"]=$_SESSION["userCod"];
        $viewData["userHood"] = getUserDirections($viewData["userCod"]);
        if(!empty($viewData["userHood"])){
            $viewData["show"]="";
        }
        //
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once "libs/validadores.php";
            $varBody = $_POST;
            if(isset($_POST["btnMia"])){
                $info = getDirectionInfo($varBody["btnMia"]);
                mergeFullArrayTo($info,$viewData);
            }
            if(isset($_POST["btnConfirmar"])){
                $validated = true;
                if($varBody["token"]!=$_SESSION["directions_token"]){
                    error_log("Critical Token Error");
                    redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=start");
                }
                if(!validDirection($varBody["directStreet"])){
                    $viewData["directStreet"] = "";
                    $viewData["direErr"]="La dirección es muy corta, intente una mas especifica con mas de 20 caracteres";
                    $viewData["dErr"]="error";
                    $validated=false;
                }
                
                if($validated){
                    if(!empty($varBody["hoodCodFK"])){
                        $result=updateDirectionInfo($varBody["directStreet"],$varBody["hoodCodFK"],$viewData["userCod"]);
                        if($result){
                            redirectWithMessage("Dirección Modificada Correctamente","index.php?page=Directions");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Dirección";
                         }
                    }
                    else{
                        $result = directionExists($viewData["userCod"],$varBody["hoodCod"]);
                        if ($result) 
                            $result=updateDirectionInfo($varBody["directStreet"],$varBody["hoodCod"],$viewData["userCod"]);
                        else
                            $result=newDirection($viewData["userCod"],$varBody["hoodCod"],$varBody["directStreet"]);
                        if($result){
                            redirectWithMessage("Dirección Creada Correctamente","index.php?page=Directions");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear la Dirección";
                        }
                    }
                     
                     
                }
            }
            
        }
        if(isset($viewData["hoodCodFK"])){
            $viewData["hood"] = addSelectedCmbArray($viewData["hood"],'hoodCod',$viewData["hoodCodFK"]);
        }
        $viewData["token"] = md5("token_directions".time());
        $_SESSION["directions_token"] = $viewData["token"];
        renderizar('user/Directions',$viewData);
    }
    run();
?>