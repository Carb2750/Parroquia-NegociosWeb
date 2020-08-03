<?php
    require_once("libs/dao.php");   

    function obtainManagements(){
        $sqlStr = "SELECT * FROM  `Management`";
        $managements = obtenerRegistros($sqlStr);
        return $managements;
    }
    function obtainManagementsByFilter($codManagement = ""){
        $filter = array();
        $sqlStr = "SELECT * FROM `Management` where codManagement like %d; ";
        $filter = obtenerRegistros(sprintf($sqlStr, $codManagement.'%'));
        return $filter;
    }
    function obtainManagementByCode($codManagement){
        $sqlStr = "SELECT * FROM `Management` where codManagement = %d; ";
        $management = array();
        
        $management = obtenerUnRegistro(sprintf($sqlStr, intval($codManagement)));
        return $management;
    }
    function obtainActiveManagement(){
        $sqlStr = "SELECT * FROM `Management` WHERE `stateManagement`='ACT' ";
        return obtenerUnRegistro($sqlStr);
    }
    function newManagement($hourManagement,$daysManagement,$maxOrderManagement){
        $sqlIns = "INSERT INTO `Management`(hourManagement,daysManagement,maxOrderManagement,stateManagement) 
                 VALUES ('%s','%s',%d,'INA');";
        $result = ejecutarNonQuery(sprintf($sqlIns,$hourManagement,$daysManagement,intval($maxOrderManagement)));
        return getLastInserId();
    }
    function UpdateManagement($codManagement,$hourManagement,$daysManagement,$maxOrderManagement){
        $sqlUpd = "UPDATE `Management` SET hourManagement= '%s',daysManagement = '%s',maxOrderManagement= %d
        WHERE codManagement = %d ; ";

        $result = ejecutarNonQuery(sprintf($sqlUpd,$hourManagement,$daysManagement,
        intval($maxOrderManagement),intval($codManagement)));
        return ($result>0);
    }
    function activateManagement($codManagement){
        $sqlUpd = "UPDATE `Management` SET stateManagement = 'ACT' WHERE codManagement = %d ; ";
        $result =  ejecutarNonQuery(sprintf($sqlUpd,$codManagement));
        if($result>0){
            $sqlUpd = "UPDATE `Management` SET stateManagement = 'INA' WHERE codManagement != %d ; ";
            $result = ejecutarNonQuery(sprintf($sqlUpd,$codManagement));
            return ($result>0);
        }
        return FALSE;
    }
?>