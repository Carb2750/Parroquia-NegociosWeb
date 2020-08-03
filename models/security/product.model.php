<?php

require_once 'libs/dao.php';


function getProducts()
{
    $product = array();
    $sqlStr = "SELECT * FROM `product`;";
    $product = obtenerRegistros($sqlStr);
    return $product;
}
function getActiveProducts()
{
    $product = array();
    $sqlStr = "SELECT * FROM `product` 
                INNER JOIN `category` on `category`.catCod = `product`.prdCategory
                where prdState ='ACT' and catState = 'ACT';";
    $product = obtenerRegistros($sqlStr);
    return $product;
}
function getProductByCode($prdCod){
    $sqlStr = "SELECT * FROM `product` where `prdCod` = '%s';";
    $products = array();
    $products = obtenerUnRegistro(sprintf($sqlStr, $prdCod));
    return $products;
}
function getActiveProductByCategoryCode($catCod){
    $sqlStr = "SELECT * FROM `product` where `prdState`= 'ACT' and prdCategory = %d;";
    $products = array();
    $products = obtenerRegistros(sprintf($sqlStr, intval($catCod)));
    return $products;
}

function getProductsByFilter($prdDscES = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `product` where prdDscES like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $prdDscES.'%'));
    return $filter;
}
function newProduct($prdImageURL,$prdDscES,$prdDscEN,$prdPrice,$prdQuantity,$prdCategory,$prdStock,$prdState){
    $sqlIns = "INSERT INTO `product` (`prdImageURL`,`prdDscES`,`prdDscEN`,`prdPrice`,`prdQuantity`,`prdCategory`,`prdStock`, `prdState`)
     VALUES ('%s','%s','%s',%f,%d,%d,%d,'%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$prdImageURL,$prdDscES,$prdDscEN,$prdPrice,$prdQuantity,$prdCategory,$prdStock,$prdState));
     echo showErrors();
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updateProduct($prdCod,$prdImageURL,$prdDscES,$prdDscEN,$prdPrice,$prdQuantity,$prdCategory,$prdStock,$prdState){
    $sqlUpd = "UPDATE `product` SET `prdImageURL`='%s',`prdDscES` = '%s' ,`prdDscEN` = '%s',`prdPrice`= %f,`prdQuantity` = %d ,`prdCategory`='%s',
    `prdStock`=%d,`prdState` = '%s'  WHERE (`prdCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd,$prdImageURL,$prdDscES,$prdDscEN,$prdPrice,$prdQuantity,$prdCategory,$prdStock,$prdState,$prdCod));
    return ($result > 0);
}
function getStock($prdCod){
    $sqlStr = "SELECT `prdStock`, `prdQuantity` FROM `product` WHERE prdCod = %d; ";
    $stockInfo = obtenerUnRegistro(sprintf($sqlStr,$prdCod));
    return $stockInfo;
}

function removeStock($prdCod,$prdQuantity){
    $sqlUpd = "UPDATE `product` SET `prdStock` = `prdStock` - %d WHERE `prdCod` = %d; ";
    $result = ejecutarNonQuery(sprintf($sqlUpd,intval($prdQuantity),intval($prdCod)));
    return ($result > 0);
}
function addStock($prdCod,$prdQuantity){
    $sqlUpd = "UPDATE `product` SET `prdStock` = `prdStock` + %d WHERE `prdCod` = %d; ";
    $result = ejecutarNonQuery(sprintf($sqlUpd,intval($prdQuantity),intval($prdCod)));
    return ($result > 0);
}

?>
