<?php

require_once 'libs/dao.php';


function getHoods()
{
    $hood = array();
    $sqlStr = "SELECT * FROM `neighborhood`;";
    $hood = obtenerRegistros($sqlStr);
    return $hood;
}
function getActiveHoods()
{
    $hood = array();
    $sqlStr = "SELECT * FROM `neighborhood` where `hoodState`='ACT';";
    $hood = obtenerRegistros($sqlStr);
    return $hood;
}
function getHoodByCode($hoodCod){
    $sqlStr = "SELECT * FROM `neighborhood` where `hoodCod` = %d;";
    $hoods = array();
    $hoods = obtenerUnRegistro(sprintf($sqlStr, $hoodCod));
    return $hoods;
}
function getHoodsByFilter($hoodDsc = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `neighborhood` where hoodDsc like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $hoodDsc.'%'));
    return $filter;
}
function newHood($hoodDsc,$hoodShippingFee,$hoodState){
    $sqlIns = "INSERT INTO `neighborhood` (`hoodDsc`,`hoodShippingFee`, `hoodState`)
     VALUES ('%s', '%s', '%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$hoodDsc, $hoodShippingFee,$hoodState));
     if($result)
        return TRUE;

    return FALSE;
}
function updateHood($hoodCod,$hoodDsc,$hoodShippingFee,$hoodState){
    $sqlUpd = "UPDATE `neighborhood` SET `hoodDsc` = '%s' ,`hoodShippingFee` = '%s' , `hoodState` = '%s'  WHERE (`hoodCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $hoodDsc,$hoodShippingFee, $hoodState,$hoodCod));
    return ($result > 0);
}
function newDirection($userCod, $hoodCod, $directStreet){
    $sqlIns = "INSERT INTO `direction` (`userCodD`,`hoodCodFK`,`directStreet`) VALUES(%d,%d,'%s');";
    $result = ejecutarNonQuery(sprintf($sqlIns,intval($userCod),intval($hoodCod),$directStreet));
    if($result)
        return TRUE;
    
    return FALSE;
}
function getUserDirections($userCod){
    $sqlStr = "SELECT directCod,hoodDsc  FROM direction 
    inner join neighborhood on direction.hoodCodFK = neighborhood.hoodCod
    WHERE userCodD = %d and hoodState = 'ACT';";
    $result = obtenerRegistros(sprintf($sqlStr,$userCod));
    return $result;
}
function getDirectionInfo($directCod){
    $sqlStr = "SELECT directStreet,hoodCodFK FROM direction
    WHERE directCod = %d;";
    $result = obtenerUnRegistro(sprintf($sqlStr,$directCod));
    return $result;
}
function directionExists($userCod,$hoodCodFK){
    $sqlStr="SELECT true from direction WHERE userCodD = %d and hoodCodFK = %d limit 1;";
    $result = obtenerUnRegistro(sprintf($sqlStr,$userCod,$hoodCodFK));
    if($result)
        return true;
    return false;
}
function updateDirectionInfo($directStreet,$hoodCodFK,$userCod){
    $sqlUpd = "UPDATE `direction` SET directStreet = '%s' where `hoodCodFK` = %d and `userCodD` = %d;";
    $result = ejecutarNonQuery(sprintf($sqlUpd,$directStreet,$hoodCodFK,$userCod));
    return ($result > 0);
}
?>
