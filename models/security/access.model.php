<?php
function giveAccess($typeCod,$mdlCod){
    $sqlIns = "INSERT INTO `type_module` (`typeCod`, `mdlCod`) VALUES ('%s', '%s');";
    $result = ejecutarNonQuery(sprintf($sqlIns, $typeCod, $mdlCod));
    if($result)
        
        return TRUE;
    else
        return FALSE;
}
function removeAccess($typeCod,$mdlCod){
    $sqlDel = "DELETE FROM `type_module` WHERE (`typeCod` = '%s') and (`mdlCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlDel, $typeCod, $mdlCod));
    if($result)
        return TRUE;
    else
        return FALSE;
}
function hasAccess($typeCod){
    $sqlStr = "SELECT '%s' as `typeCod`,m.mdlCod, m.mdlDscES, m.mdlClass  FROM type_module tm
                inner join module m on tm.mdlCod = m.mdlCod
                where tm.typeCod='%s';";

    $result = obtenerRegistros(sprintf($sqlStr,$typeCod, $typeCod));
    return $result;
}
function filterHasAccess($typeCod, $mdlCod){
    $sqlStr ="SELECT '%s' as typeCod,m.mdlCod, m.mdlDscES, m.mdlClass  FROM type_module tm
    inner join module m on tm.mdlCod = m.mdlCod
    where tm.typeCod='%s'and m.mdlCod like '%s';";
    $result = obtenerRegistros(sprintf($sqlStr,$typeCod,$typeCod, $mdlCod.'%'));
    return $result;
}
function deniedAccess($typeCod){
    $sqlStr = "SELECT '%s' as `typeCod`,m.mdlCod, m.mdlDscES, m.mdlClass from module m
    where not exists(select * from type_module tm where tm.mdlCod = m.mdlCod and tm.typeCod='%s') and m.mdlState ='ACT' ;";
    $result = obtenerRegistros(sprintf($sqlStr,$typeCod ,$typeCod));
    return $result;
}
function filterDeniedAccess($typeCod, $mdlCod){ 
    $sqlStr ="SELECT '%s' as `typeCod`,m.mdlCod, m.mdlDscES, m.mdlClass from module m
    where not exists(select * from type_module tm where tm.mdlCod = m.mdlCod and tm.typeCod='%s') and m.mdlState ='ACT' and m.mdlCod like '%s' ;";
    $result = obtenerRegistros(sprintf($sqlStr,$typeCod,$typeCod, $mdlCod.'%'));
    return $result;
}
?>