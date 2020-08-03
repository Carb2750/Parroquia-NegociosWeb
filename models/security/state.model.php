<?php
require_once "libs/dao.php" ;
function getState(){
    $state = array();
    return $state = obtenerRegistros("select * from state;");
}
function newState($stateCod, $stateDsc){
    $sqlIns = "insert into state (stateCod, stateDsc) values ('%s', '%s');";
    $result = ejecutarNonQuery(sprintf(
        $sqlIns,
        valstr($stateCod),
        $stateDsc
    ));
}
function existState($stateCod){
    $sqlStr = "select * from state where stateCod = '%s';";
    $result = obtenerUnRegistro($sqlStr, valstr($stateCod));
    if(empty($result)){
        return true;
    }
    return false;
}
?>