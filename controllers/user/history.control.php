<?php 
    require_once 'models/orders.model.php';
    
    function run(){

        $limit = 10;
        $bottom = 0;
        $top = $limit;
        $pagination = 1;
        if(isset($_GET["n"])){
            $pagination = $_GET["n"];
        }
        $viewData = array();
        $viewData["userOrders"]=getUserOrders($_SESSION["userCod"]);
        if(!empty($viewData["userOrders"])){
            
            $totalOrders = count($viewData["userOrders"]);
            $totalOrders = ceil($totalOrders/$limit);
            if($totalOrders>0){
                if(isset($_GET["recentCMB"])){
                    for($x = 0; $x<$totalOrders; $x++)
                        $viewData["pagination"][] = array("cod"=>$x+1, "recentCMB"=>$viewData["recentCMB"],"statusesCMB"=>$viewData["statusesCMB"],"txtFiltar"=>$viewData["txtFiltar"]);                        
                }else{
                    for($x = 0; $x<$totalOrders; $x++)
                        $viewData["pagination"][] = array("cod"=>$x+1);
                }
            }
            $viewData["pagination"] = addSelectedCmbArray($viewData["pagination"],"cod",$pagination);
            $top = $limit*$pagination;
            if($pagination!=1){
                for($x = 1 ; $x<$pagination; $x++){
                    $bottom += $limit;
                }
            }
            $viewData["userOrders"]=getUserOrders($_SESSION["userCod"],$bottom,$top);
            foreach($viewData["userOrders"] as $key => $value){
                $viewData["userOrders"][$key]["orderDeliverTime"] = date('d/m/y h:i A',$viewData["userOrders"][$key]["orderDeliverTime"]);
                $viewData["userOrders"][$key]["orderMade"] = date('d/m/y h:i A',$viewData["userOrders"][$key]["orderMade"]);
                $viewData["userOrders"][$key]["color"] = stateColor($viewData["userOrders"][$key]["statusCod"]);
                $viewData["userOrders"][$key]["subtotal"] = sprintf('%0.2f',$viewData["userOrders"][$key]["orderTotal"] -($viewData["userOrders"][$key]["orderIsv"] + $viewData["userOrders"][$key]["orderShippingFee"]));
                $viewData["userOrders"][$key]["orderDetail"] = getDetailOrder($viewData["userOrders"][$key]["orderCod"]);
            }
        }
        
        
        
        renderizar('user/history', $viewData);
    }
    function stateColor($state){
        switch($state){
            case 'DNY':
                return "orange";
                break;
            case 'PRP':
                return "blue";
                break;
            case 'OMW':
                return "green";
                break;
             case 'DLV':
                return "";
                break;
            default:
                return 'yellow';
                break;
        }
    }
    run();
?>