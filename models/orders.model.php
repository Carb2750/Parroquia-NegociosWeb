<?php

require_once 'libs/dao.php';

function newOrder($userCod,$orderDeliverTime,$orderPayment,$orderCell,$orderDirection,$orderShippingFee,$orderTotal,$products,$orderIsv=0.00){
    $orderStatus = 'PND';
    $orderDate = time();
    $sqlIns = "INSERT INTO `orders` (`userCod`,`orderStatus`,`orderDate`, `orderDeliverTime`,`orderPayment`,`orderCell`,`orderDirection`,
    `orderShippingFee`,`orderIsv`,`orderTotal`)
     VALUES (%d,'%s',FROM_UNIXTIME(%s),FROM_UNIXTIME(%s),'%s','%s','%s',%f,%f, %f);";

     $result = ejecutarNonQuery(sprintf($sqlIns,intval($userCod),$orderStatus,$orderDate,$orderDeliverTime,$orderPayment,
     $orderCell,$orderDirection,floatval($orderShippingFee),floatval($orderIsv),floatval($orderTotal)));

     $orderCod= getLastInserId();

     if($orderCod>0){
        if(is_array($products)){
            foreach($products as $key => $value){
                $result=orderDetail($orderCod,$value["prdCod"],$value["prdPrice"],$value["prdQuantity"],$value["cartQuantity"]);
            }
        }else{
            $result=orderDetail($orderCod,$products["prdCod"],$products["prdPrice"],$products["prdQuantity"],$products["cartQuantity"]);
        }
        //echo showErrors();
        if($result)
            return true;
     }
     return FALSE;
}
function getOrders($bottom=0,$top=999){
    $sqlStr = "SELECT orderCod,userName,unix_timestamp(orderDeliverTime) as `orderDeliverTime`, unix_timestamp(orderDate) as `orderMade`,statusCod ,statusDscES,statusDscES,orderCell ,orderDate,paymentDscES,orderShippingFee,orderIsv,orderTotal,orderDirection from `user`
    inner join `orders` on `user`.userCod = `orders`.userCod
    inner join `payment` on `orders`.orderPayment = `payment`.paymentCod 
    inner join `status` on `status`.statusCod = `orders`.orderStatus
    order by orderDate DESC LIMIT %d, %d;";
    $result = obtenerRegistros(sprintf($sqlStr,$bottom,$top));
    return $result;
}
function getOrderStateByCode($orderCod){
    $sqlStr = "SELECT `orderCod`,`orderStatus` FROM `orders`where `orderCod` = %d;";
    $result = obtenerUnRegistro(sprintf($sqlStr,intval($orderCod)));
    return $result;
}
function updateOrderStatus($orderCod,$orderStatus){
    $sqlUpd = "UPDATE `orders` set `orderStatus` = '%s' where `orderCod` = %d ;";
    $result = ejecutarNonQuery(sprintf($sqlUpd,$orderStatus,intval($orderCod)));
    if($result > 0){
        return true;
    }
    return false;
}
function getFilteredOrders($orderby,$statusCod,$userName,$bottom=0,$top=99){
    $sqlStr = "SELECT orderCod,userName,unix_timestamp(orderDeliverTime) as `orderDeliverTime`, unix_timestamp(orderDate) as `orderMade`,statusCod ,statusDscES,statusDscES,orderCell ,orderDate,paymentDscES,orderShippingFee,orderIsv,orderTotal from `user`
    inner join `orders` on `user`.userCod = `orders`.userCod
    inner join `payment` on `orders`.orderPayment = `payment`.paymentCod 
    inner join `status` on `status`.statusCod = `orders`.orderStatus
    where  `statusCod` = '%s' and `userName` like  '%s'
    order by orderDeliverTime %s LIMIT %d, %d;";
    $result = obtenerRegistros(sprintf($sqlStr,$statusCod,$userName.'%',$orderby,$bottom,$top));
    return $result;
}

function getUserOrders($userCod,$bottom=0,$top=999){
    $sqlStr = "SELECT orderCod,userName,unix_timestamp(orderDeliverTime) as `orderDeliverTime`, unix_timestamp(orderDate) as `orderMade`,statusCod ,statusDscES,statusDscES,orderCell ,orderDate,paymentDscES,orderShippingFee,orderIsv,orderTotal from `user`
    inner join `orders` on `user`.userCod = `orders`.userCod
    inner join `payment` on `orders`.orderPayment = `payment`.paymentCod 
    inner join `status` on `status`.statusCod = `orders`.orderStatus
    where `user`.userCod = %d
    order by orderDate DESC LIMIT %d, %d;";
    $result = obtenerRegistros(sprintf($sqlStr,intval($userCod),intval($bottom),intval($top)));
    return $result;
}
function getDetailOrder($orderCod){
    $sqlStr = "SELECT product.prdDscES,order_product.prdPrice,order_product.prdQuantity, order_product.cartQuantity FROM order_product
    inner join product on product.prdCod = order_product.prdCod
    where order_product.orderCod = %d;";
    $result = obtenerRegistros(sprintf($sqlStr,$orderCod));
    return $result;
}
function orderDetail($orderCod,$prdCod,$prdPrice,$prdQuantity,$cartQuantity,$prdDiscount=0.00){
    $sqlIns = "INSERT INTO `order_product`(`orderCod`,`prdCod`,`prdPrice`,`prdQuantity`,`cartQuantity`,`prdDiscount`) 
    VALUES(%d, %d, %f,%d,%d, %f);";
    $result = ejecutarNonQuery(sprintf($sqlIns,intval($orderCod),intval($prdCod),floatval($prdPrice),
    intval($prdQuantity),intval($cartQuantity),floatval($prdDiscount)));
    if($result)
        return TRUE;
    else
        return FALSE;
}
function getOrderMail($orderCod){
    $sqlStr = "SELECT `user`.userEmail from `orders`
    inner join `user` on `user`.userCod = `orders`.userCod
    where `orders`.orderCod = %d;";
    $result = obtenerUnRegistro(sprintf($sqlStr,$orderCod));
    return $result;
}
function getTotalHourOrders($orderDeliverTime){
    $sqlStr = "SELECT count(*) as `totalOrders` FROM `orders`
    where orderDeliverTime = from_unixtime(%s);";
    $result = obtenerUnRegistro(sprintf($sqlStr,$orderDeliverTime));
    if($result)
        return $result["totalOrders"];
    return 999;
}

?>
