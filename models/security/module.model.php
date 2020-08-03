<?php

require_once "libs/dao.php";

function getModuleByFilter($mdlCod, $mdlClass)
{
    $module = array();
    $sqlstr = "SELECT * from `module` where `mdlCod` like '%s'and `mdlClass` like '%s';";
    $module = obtenerRegistros(sprintf($sqlstr,$mdlCod.'%', $mdlClass));
    return $module;
}

function getModuleByCode($mdlCod)
{
    $module = array();
    $sqlstr = "SELECT * from `module` where mdlCod = '%s';";
    $module = obtenerUnRegistro(sprintf($sqlstr,$mdlCod));
    return $module;
}

function insertModule($mdlCod,$mdlDsc, $mdlState, $mdlClass) {
    $strsql = "INSERT into `module` (`mdlCod`,`mdlDsc`, `mdlState`, `mdlClass`) values ('%s','%s', '%s','%s');";
    if (ejecutarNonQuery(sprintf($strsql, valstr($mdlCod), $mdlDsc, $mdlState, $mdlClass))){
        return true;
    }
    return 0;
}

function updateModule($mdlCod,$mdlDsc, $mdlState, $mdlClass) {
    $strsql = "UPDATE `module` set `mdlDsc` = '%s', `mdlState` = '%s', `mdlClass` = '%s' where `mdlCod` = '%s';";
    $result = ejecutarNonQuery($strsql, $mdlDsc, $mdlState, $mdlClass, valstr($mdlCod));
    return ($result > 0);
} 
function existModule($mdlCod){
    $sqlstr = "SELECT * from `module` where `mdlCod`= '%s';";
    $result = sprintf($sqlstr, valstr($mdlCod));
    if(empty($result)){
        return true;
    }
    return false;
}
function getModuleClass()
{
    return array(
      array("code"=>"PGE","dsc"=>"Página"),
      array("code"=>"FNC","dsc"=>"Función")
    );
}
?>
