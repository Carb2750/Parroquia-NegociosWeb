<?php

require_once 'libs/dao.php';


function getModules()
{
    $module = array();
    $sqlStr = "SELECT * FROM `module`;";
    $module = obtenerRegistros($sqlStr);
    return $module;
}
function getModulesByCode($mdlCod){
    $sqlStr = "SELECT * FROM `module` where `mdlCod` = '%s';";
    $modules = array();
    $modules = obtenerUnRegistro(sprintf($sqlStr, $mdlCod));
    return $modules;
}
function getModulesByFilter($mdlCod = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `module` where mdlCod like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $mdlCod.'%'));
    return $filter;
}
function newModule($mdlCod,$mdlDscES,$mdlDscEN,$mdlState, $mdlClass){
    $sqlIns = "INSERT INTO `module` (`mdlCod`,`mdlDscES`,`mdlDscEN`, `mdlState`, `mdlClass`)
     VALUES ('%s','%s', '%s', '%s', '%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$mdlCod,$mdlDscES, $mdlDscEN,$mdlState, $mdlClass));
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updateModule($mdlCod,$mdlDscES,$mdlDscEN,$mdlState, $mdlClass){
    $sqlUpd = "UPDATE `module` SET `mdlDscES` = '%s' ,`mdlDscEN` = '%s' , `mdlState` = '%s', `mdlClass` = '%s'  WHERE (`mdlCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $mdlDscES,$mdlDscEN, $mdlState,$mdlClass,$mdlCod));
    return ($result > 0);
}
?>
