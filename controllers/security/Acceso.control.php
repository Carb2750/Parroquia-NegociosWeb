<?php 
    require_once 'models/security/access.model.php';
    $viewData["hasAccess"] = array();
    $viewData["deniedAccess"] = array();
    $viewData["typeCod"] = "";


    if(!isset($viewData["txtFiltrarA"]))
    {
        $viewData["txtFiltrarA"]="";
    }
    if(!isset($viewData["txtFiltrarD"]))
    {
        $viewData["txtFiltrarD"]="";
    }
    
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if(isset($_GET["cod"])){
            $viewData["typeCod"] = $_GET["cod"];

            $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
            $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
        }
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST)){
            $varBody = $_POST;
            $module ="";
            mergeFullArrayTo($varBody,$viewData);
        }
        if(isset($_POST["btnDenegar"])){
            
            $module = $varBody["mdlCod"];
            

            if(removeAccess($varBody["typeCod"],$varBody["mdlCod"])){
                echo "<script>alert('se Quito el Acceso al modulo de $module');</script>";
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
            }
            else{
                echo "<script>alert('Ocurrio un error');</script>";
            }
        }
        if(isset($_POST["btnAcceder"])){
            $module = $varBody["mdlCod"];
            if(giveAccess($varBody["typeCod"],$varBody["mdlCod"])){
                echo "<script>alert('se dio el Acceso al modulo de $module');</script>";
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
            }
            else{
                echo "<script>alert('Ocurrio un error');</script>";
            }
            echo showErrors();
        }
        if(isset($_POST["btnFiltrarA"])){
            if(!empty(filterHasAccess($varBody["typeCod"],$varBody["txtFiltrarA"]))){

                $viewData["hasAccess"] = filterHasAccess($varBody["typeCod"],$varBody["txtFiltrarA"]);

                $viewData["deniedAccess"] = filterDeniedAccess($varBody["typeCod"],$viewData["txtFiltrarD"]);
                
            }else{
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
                $viewData["errorA"] = "No se encontraron registros";
            }
        }//btnFiltrarA

        if(isset($_POST["btnFiltrarD"])){
            if(!empty(filterDeniedAccess($varBody["typeCod"],$varBody["txtFiltrarD"]))){

                $viewData["hasAccess"] = filterHasAccess($varBody["typeCod"],$viewData["txtFiltrarA"]);

                $viewData["deniedAccess"] = filterDeniedAccess($varBody["typeCod"],$varBody["txtFiltrarD"]);
            }else{
                $viewData["hasAccess"] = hasAccess($viewData["typeCod"]);
                $viewData["deniedAccess"] = deniedAccess($viewData["typeCod"]);
                $viewData["errorD"] = "No se encontraron registros";
            }
        }//btnFiltrarA
    }

    renderizar("security/Acceso", $viewData);

?>