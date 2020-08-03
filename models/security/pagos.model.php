<?php

require_once 'libs/dao.php';


function getPayments()
{
    $payment = array();
    $sqlStr = "SELECT * FROM `payment`;";
    $payment = obtenerRegistros($sqlStr);
    return $payment;
}
function getPaymentsByCode($paymentCod){
    $sqlStr = "SELECT * FROM `payment` where `paymentCod` = '%s';";
    $payments = array();
    $payments = obtenerUnRegistro(sprintf($sqlStr, $paymentCod));
    return $payments;
}
function getActivePayments(){
    $sqlStr = "SELECT * FROM `payment` where `paymentState` = 'ACT';";
    $payments = array();
    $payments = obtenerRegistros($sqlStr);
    return $payments;
}
function getPaymentByFilter($paymentDscES = ""){
    $filter = array();
    $sqlStr = "SELECT * FROM `payment` where paymentDscES like '%s'; ";
    $filter = obtenerRegistros(sprintf($sqlStr, $paymentDscES.'%'));
    return $filter;
}
function newPayment($paymentCod,$paymentDscES,$paymentDscEN,$paymentLib,$paymentState){
    $sqlIns = "INSERT INTO `payment` (`paymentCod`,`paymentDscES`,`paymentDscEN`,`paymentLib`, `paymentState`)
     VALUES ('%s','%s', '%s', '%s','%s');";
     $result = ejecutarNonQuery(sprintf($sqlIns,$paymentCod,$paymentDscES, $paymentDscEN,$paymentLib,$paymentState));
     if($result)
        
        return TRUE;
    else
        return FALSE;
}
function updatePayment($paymentCod,$paymentDscES,$paymentDscEN,$paymentLib,$paymentState){
    $sqlUpd = "UPDATE `payment` SET  `paymentDscES` = '%s' ,`paymentDscEN` = '%s' ,`paymentLib` = '%s', `paymentState` = '%s'  WHERE (`paymentCod` = '%s');";
    $result = ejecutarNonQuery(sprintf($sqlUpd, $paymentDscES,$paymentDscEN,$paymentLib, $paymentState,$paymentCod));
    return ($result > 0);
}
?>
