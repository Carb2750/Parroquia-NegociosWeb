<?php
require_once 'libs/dao.php';

function getVariations($prdCod){
    $sqlStr = "SELECT * FROM `variation` where `prdCod` = %d;";
    $variations = array();
    $variations = obtenerRegistros(sprintf($sqlStr, intval($prdCod)));
    return $variations;
}
function getActiveVariations($prdCod){
    $sqlStr = "SELECT * FROM `variation` where `prdCod` = %d and `variationState` = '%s';";
    $variations = array();
    $variations = obtenerRegistros(sprintf($sqlStr, intval($prdCod),'ACT'));
    return $variations;
}
function getVariationByCode($variationCod){
    $sqlStr = "SELECT prdCod,variationPrice as prdPrice, variationQuantity as prdQuantity, `variationState` FROM `variation` where `variationCod` = %d;";
    $variations = array();
    $variations = obtenerUnRegistro(sprintf($sqlStr, $variationCod));
    return $variations;
}
function getActiveVariationByCode($variationCod){
    $sqlStr = "SELECT prdCod,variationPrice as prdPrice, variationQuantity as prdQuantity, `variationState` FROM `variation` where `variationCod` = %d and `variationState` = '%s';";
    $variations = array();
    $variations = obtenerUnRegistro(sprintf($sqlStr, $variationCod, 'ACT'));
    return $variations;
}
function getVariationsByFilter($variationCod = '', $prdCod){
    $filter = array();
    $sqlStr = "SELECT * FROM `variation` where variationCod like %d and `prdCod`=%d; ";
    $filter = obtenerRegistros(sprintf($sqlStr, intval($variationCod.'%'),intval($prdCod)));
    return $filter;
}
function newVariation($variationPrice,$variationQuantity,$variationState,$prdCod){
    $sqlIns = "INSERT INTO `variation` (`variationPrice`,`variationQuantity`,`variationState`,`prdCod`)
     VALUES (%f,%d,'%s',%d);";
     $result = ejecutarNonQuery(sprintf($sqlIns,floatval($variationPrice),intval($variationQuantity),$variationState,intval($prdCod)));
     if($result)
        return TRUE;
    else
        return FALSE;
}
function updateVariation($variationCod,$variationPrice,$variationQuantity,$variationState,$prdCod){
    $sqlUpd = "UPDATE `variation` SET `variationPrice` = %f ,`variationQuantity` = %d ,`variationState`='%s',`prdCod` = %d WHERE (`variationCod` = %d);";
    $result = ejecutarNonQuery(sprintf($sqlUpd,floatval($variationPrice),intval($variationQuantity),$variationState,intval($prdCod),intval($variationCod)));
    return ($result > 0);
}
function getVariationStock($variationCod){
    $sqlStr = "SELECT `prdStock`,`variationQuantity` FROM `variation` 
    INNER JOIN `product` on `product`.prdCod = `variation`.prdCod
    WHERE `variation`.prdCod = %d; ";
    $stockInfo = obtenerUnRegistro(sprintf($sqlStr,intval($variationCod)));
    return $stockInfo;
}
?>
