<?php

require_once 'libs/dao.php';


function getTypes()
{
    $type = array();
    $sqlStr = "SELECT * FROM `type`;";
    $type = obtenerRegistros($sqlStr);
    return $type;
}
function getTypeByCode($typeCod){
    $sqlStr = "SELECT * FROM `type` where `typeCod` = '%s';";
    $types = array();
    $types = obtenerUnRegistro(sprintf($sqlStr, $typeCod));
    return $types;
}
function getTypeByFilter($typeCod = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `type` where typeCod like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $typeCod.'%'));
    return $filter;
}
function newType($typeCod,$typeDsc,$typeState,$typeExp='NULL'){
    $sqlIns = "INSERT INTO `type` (`typeCod`, `typeDsc`, `typeState`, `typeExp`)
     VALUES ('%s', '%s', '%s', %s );";
     $result = ejecutarNonQuery(sprintf($sqlIns, $typeCod, $typeDsc, $typeState, $typeExp));
    echo $result;
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updateType($typeCod,$typeDsc,$typeState,$typeExp='NULL'){
    $sqlUpd = "UPDATE `type` SET `typeDsc` = '%s' , `typeState` = '%s', `typeExp` = %s  WHERE (`typeCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $typeDsc, $typeState, $typeExp,$typeCod));
    echo $result;
    return ($result > 0);
}
?>
