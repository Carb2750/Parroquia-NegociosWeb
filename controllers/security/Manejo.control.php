<?php 
require_once 'models/support/management.model.php';
require_once 'models/security/state.model.php';


    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
   

    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["days"]=creatCheckDays();

    $viewData["hourStart"]=createCmbHours();
    $viewData["hourEnd"]=createCmbHours();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Horario", "UPD"=>"Actualizando Horario", "DSP"=>"Mostrando Horario");
    if(isset($_GET["cod"])){
        $viewData["cod"] = $_GET["cod"];
    }
    if(isset($_GET["act"])){
        $viewData["act"] = $_GET["act"];
        $viewData["mode"] = $viewData["modeDsc"][$viewData["act"]];
    }

    switch($viewData["act"]){
        case "INS":
            $viewData["insert"]="true";
            break;
        case "UPD":
            $viewData["insert"]="";
            break;
        case "ACT":
            break;
        default:
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Manejos");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;

            echo '<pre>'.print_r($varBody).'</pre>';

            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["manejos_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Manejos");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";
                        if(is_array($varBody["daysManagement"])){
                            $days = implode(',',$varBody["daysManagement"]);
                            $varBody["daysManagement"] = $days;
                        }
                        $viewData["hourManagement"] = $varBody["hourStart"].'-'.$varBody["hourEnd"];
                         $result=newManagement($viewData["hourManagement"],$varBody["daysManagement"],$varBody["maxOrderManagement"]);
                        
                        if($result){
                            redirectWithMessage("Horario Creado Correctamente","index.php?page=Manejos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Horario";
                        }
                        
                        break;
                    case "UPD":
                        $viewData["hourManagement"] = $varBody["hourStart"].'-'.$varBody["hourEnd"];
                        $result = "";
                        if(is_array($varBody["daysManagement"])){
                            $days = implode(',',$varBody["daysManagement"]);
                            $varBody["daysManagement"] = $days;
                        }
                        $result=UpdateManagement($varBody["codManagement"],$viewData["hourManagement"],$varBody["daysManagement"],$varBody["maxOrderManagement"]);
                        if($result){
                            redirectWithMessage("Horario Modificado Correctamente","index.php?page=Manejos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Horario";
                        }
                        break;
                    case "ATI":
                        $result = "";
                        $result=activateManagement($_GET["act"]);
                        echo $result;
                        if($result){
                            redirectWithMessage("Horario Activado Correctamente","index.php?page=Manejos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Horario";
                        }
                        break;

                }
            }

        }
    }
    $viewData["token"] = md5("token_manejo".time());
    $_SESSION["manejos_token"] = $viewData["token"];
    
    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $management = array();
        $management = obtainManagementByCode($_GET["cod"]);
        mergeFullArrayTo($management, $viewData);
       
    }
    if(isset($viewData["stateManagement"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["stateManagement"]);
    }
    if(isset($viewData["hourManagement"])){
        
        $hours = explode('-',$viewData["hourManagement"]);

        $viewData["hourStart"] = addSelectedCmbArray($viewData["hourStart"],'hour',$hours[0]);
        $viewData["hourEnd"] = addSelectedCmbArray($viewData["hourEnd"],'hour',$hours[1]);
        
        //echo '<pre>'.print_r($hours).'</pre>';
        //echo '<pre>'.print_r($viewData["hourStart"]).'</pre>';
    }
    if(isset($viewData["daysManagement"])){
        $days = explode(',',$viewData["daysManagement"]);
       for($x = 0 ; $x<7 ; $x++){
           foreach($days as $key => $value){
               if($viewData["days"][$x]["dayCod"]==$days[$key]){
                   $viewData["days"][$x]["checked"] ="checked";
               }
           }
       }
    }
    function createCmbHours(){
        $hourdate=date('H');
        if((date('H') - 1)>0){
            $hourdate=date('H') - 1;
        }
        
        $hour =array();
        for($x = 0 ; $x<=22; $x++){
            $hour[] = array("hour"=>date('h:00 A',strtotime('-'.$hourdate+$x.' hours')));    
        }
            //echo '<pre>'.print_r($hour).'</pre>';
        return $hour;
    }
    function creatCheckDays(){
        $days =array(array("dayCod"=>"Mon","day"=>"Lunes"),array("dayCod"=>"Tue","day"=>"Martes"),array("dayCod"=>"Wed","day"=>"Miercoles"),
        array("dayCod"=>"Thu","day"=>"Jueves"),array("dayCod"=>"Fri","day"=>"Viernes"),array("dayCod"=>"Sat","day"=>"Sabado"),array("dayCod"=>"Sun","day"=>"Domingo"));
       
        return $days;
        
    }
    renderizar("security/Manejo", $viewData);
?>