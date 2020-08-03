<?php

require_once 'libs/dao.php';


function getCategories()
{
    $category = array();
    $sqlStr = "SELECT * FROM `category`;";
    $category = obtenerRegistros($sqlStr);
    return $category;
}
function getCategoriesWithActiveProducts(){
    $sqlStr = "SELECT * from `category` c
    where exists (SELECT * from `product` p where c.catCod=p.prdCategory ) and c.catState='ACT';";
    $category = array();
    $category = obtenerRegistros($sqlStr);
    return $category;
}
function getCategoriesWithActiveProductsByCode($catCod){
    $sqlStr = "SELECT * from `category` c
    where exists (SELECT * from `product` p where c.catCod=p.prdCategory ) and c.catState='ACT'; and c.catCod = %d ";
    $category = array();
    $category = obtenerRegistros(sprintf($sqlStr,$catCod));
    return $category;
}
function getCategoryByCode($catCod){
    $sqlStr = "SELECT * FROM `category` where `catCod` = '%s';";
    $categories = array();
    $categories = obtenerUnRegistro(sprintf($sqlStr, $catCod));
    return $categories;
}
function getCategoriesByFilter($catDscES = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `category` where catDscES like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $catDscES.'%'));
    return $filter;
}
function newCategory($catDscES,$catDscEN,$catState){
    $sqlIns = "INSERT INTO `category` (`catDscES`,`catDscEN`, `catState`)
     VALUES ('%s', '%s', '%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$catDscES, $catDscEN,$catState));
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updateCategory($catCod,$catDscES,$catDscEN,$catState){
    $sqlUpd = "UPDATE `category` SET `catDscES` = '%s' ,`catDscEN` = '%s' , `catState` = '%s'  WHERE (`catCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $catDscES,$catDscEN, $catState,$catCod));
    return ($result > 0);
}
?>
