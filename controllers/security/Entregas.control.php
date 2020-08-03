<?php 
include_once 'models/security/neighborhood.model.php';
function run(){
    $viewData["error"] = "";
    $viewData["neighborhood"] =getHoods();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST["btnFiltrar"])){
            $varBody = $_POST;
            if(!empty(getHoodsByFilter($varBody["txtFiltar"]))){
                $viewData["neighborhood"] = getHoodsByFilter($varBody["txtFiltar"]);
            }else{
                $viewData["error"] = "No se encontraron registros";
            }
        }
    }
    renderizar("security/Entregas", $viewData);
}

run();
?>