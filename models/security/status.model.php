<?php

require_once 'libs/dao.php';


function getStatuses()
{
    $status = array();
    $sqlStr = "SELECT * FROM `status`;";
    $status = obtenerRegistros($sqlStr);
    return $status;
}
function getStatusesByCode($statusCod){
    $sqlStr = "SELECT * FROM `status` where `statusCod` = '%s';";
    $statuses = array();
    $statuses = obtenerUnRegistro(sprintf($sqlStr, $statusCod));
    return $statuses;
}
function getStatusesByFilter($statusDscES = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `status` where statusDscES like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $statusDscES.'%'));
    return $filter;
}
function newStatus($statusCod,$statusDscES,$statusDscEN){
    $sqlIns = "INSERT INTO `status` (`statusCod`, `statusDscES`,`statusDscEN`)
     VALUES ('%s', '%s', '%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$statusCod,$statusDscES, $statusDscEN));
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updateStatus($statusCod,$statusDscES,$statusDscEN){
    $sqlUpd = "UPDATE `status` SET `statusDscES` = '%s' ,`statusDscEN` = '%s'   WHERE (`statusCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $statusDscES,$statusDscEN,$statusCod));
    return ($result > 0);
}
?>
