<?php 
    require_once 'models/support/management.model.php';
    require_once 'models/support/cart.model.php';
    require_once 'models/security/neighborhood.model.php';
    require_once 'models/security/pagos.model.php'; 
    require_once 'models/orders.model.php';
    require_once 'libs/paypal.php';
    require_once "libs/sendmail.php";
function run(){

    $management = obtainActiveManagement();

    $viewData = array();
    $viewData["userCell"] = false;
    $viewData["subtotal"]=getCartTotal();
    $viewData["shipping"] = 0.99;
    $viewData["total"] = $viewData["subtotal"]+$viewData["shipping"];
    $viewData["hood"]=getActiveHoods();
    $viewData["show"]="hidden";
    $viewData["userCod"] = $_SESSION["userCod"];
    $viewData["userHood"] = getUserDirections($viewData["userCod"]);
    if(!empty($viewData["userHood"])){
        $viewData["show"]="";
    }
    $viewData["payments"]=getActivePayments();

    $hours = explode('-',$management["hourManagement"]);
    $days = explode(',',$management["daysManagement"]);
    
    $viewData["total"]= sprintf('%0.2f', $viewData["total"]);
   
    if(isset($_SESSION["userCell"]) && !empty($_SESSION["userCell"])){
        $viewData["userCell"] = $_SESSION["userCell"];
    }
    $viewData["hours"]=createCmbHours($hours,$days,$management["maxOrderManagement"]);

    if(isset($_GET["page"])){
        $viewData["page"]=$_GET["page"];
    }

    $products = getCartItems($viewData["page"]);
    //echo '<pre>'.print_r($products).'</pre>';

    mergeFullArrayTo($products,$viewData);

    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include_once "libs/validadores.php";
        $varBody = $_POST;
        if(isset($_POST["btnPayment"])){
            
            $validated = true;
            mergeFullArrayTo($varBody, $viewData);
            //echo '<pre>'.print_r($varBody).'</pre>';
            if($varBody["token"]!=$_SESSION["checkout_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Checkout");
            }
            
            if(getTotalHourOrders($varBody["orderDeliveryTime"])>$management["maxOrderManagement"]){
                $validated = false;
                echo "<script>alert(El Horario escogido ya no se encuentra disponible);</script>";
                $viewData["hErr"]="error";
            }
            if(!validPhone($varBody["orderCell"])){
                $viewData["cellErr"]="Telefono Invalido";
                $viewData["cErr"]="error";
                $validated=false;
            }
            if(!validDirection($varBody["directStreet"])){
                $viewData["directStreet"] = "";
                $viewData["direErr"]="La dirección es muy corta, intente una mas especifica con mas de 20 caracteres";
                $viewData["dErr"]="error";
                $validated=false;
            }
            if(empty($_SESSION["cart"]) || $_SESSION["cartSize"]==0){
                redirectWithMessage("Parece que tu canasta esta vacia", "index.php?page=cartL");
            }
            if(checkCartStock()){
                redirectWithMessage("Parece que algo en tu canasta ya no se encuentra disponible", "index.php?page=cartL");
            }
            if($validated){
                //Busca si la direccion Ingresada ya tiene una registrada
                $result = directionExists($viewData["userCod"],$varBody["hoodCod"]);
                //Si Existe solo la actualiza
                if ($result) 
                    $result=updateDirectionInfo($varBody["directStreet"],$varBody["hoodCod"],$viewData["userCod"]);
                else //Si no crea una nueva
                    $result=newDirection($viewData["userCod"],$varBody["hoodCod"],$varBody["directStreet"]);
                //Consigue la informacion de neighboordhood para no ingresar el codigo mandado del formulario si no el nombre
                $hood = getHoodByCode($varBody["hoodCod"]);
                                                     //Este de Abajo
                $orderDirection = "Barrio/Colonia: ".$hood["hoodDsc"]."----> Direccion Especifica: ".$varBody["directStreet"];
                $result2=newOrder($_SESSION["userCod"],$varBody["orderDeliveryTime"],$varBody["btnPayment"],
                $varBody["orderCell"],$orderDirection,$viewData["shipping"],$viewData["total"],$products["products"]);
                echo showErrors().'<br>';
                //Si se pudo crear la orden prosigue
                if($result2){
                    $_SESSION["userCell"] = $varBody["orderCell"];
                    $payPalReturn=createPaypalTransacction($viewData["products"],$viewData["subtotal"],$viewData["shipping"],$viewData["total"]);
                    //Si todo salio bien paypal y tiene un url redirect
                    if ($payPalReturn) {
                        redirectToUrl($payPalReturn);
                    }
                    //si ni a paypal pudo ir
                    $viewData["returndata"] = $payPalReturn;
                    echo $viewData["returndata"];

                }else{
                    $viewData["hasErrors"]=true;
                    $viewData["errors"][]="No se pudo ordenar";
                }
            }
        }
        //Cuando tiene direcciones anteriores para cargar la informacion guardada
        if((isset($_POST["btnMia"]))){
            $info = getDirectionInfo($varBody["btnMia"]);
            mergeFullArrayTo($info,$viewData);
        }
    }
    //cuando carga la informacion guardada manda al cmb que opcion fue la que selecciono
    if(isset($viewData["hoodCodFK"])){
        $viewData["hood"] = addSelectedCmbArray($viewData["hood"],'hoodCod',$viewData["hoodCodFK"]);
    }
    $viewData["token"] = md5("checkout_token".time());
    $_SESSION["checkout_token"] = $viewData["token"];
    
    renderizar("user/Checkout",$viewData);
}
function createCmbHours($activeHours,$activeDays,$maxOrders){
    //Revisar si el negocio sigue abierto un dia despues
   
    //Cuando el negocio esta abierto
    $hourNow = time();//Hora Actual
    $hourNow1 = time()+3600;//Una hora Adelante
    $hourNow2 = time()+7200;//Dos hora adelante

    $totalDays = totalDays($activeDays,$hourNow);
    $startingDay = strtotime('+'.$totalDays.' days',strtotime('today midnight'));
    $startHour = date('H',strtotime($activeHours[0]))*3600;
    $endHour = (date('H',strtotime($activeHours[1])) - date('H',strtotime($activeHours[0])))*3600;
    
    
    $endingDay = $startingDay+$startHour+$endHour;
    $startingDay +=  $startHour;
    $totalHours = ($endingDay-$startingDay)/3600;

    //DATE_RFC2822
    //Si la hora en que el usuario se mete es menor a 2 horas crea el horario completo
    if($hourNow2<$startingDay){
        //echo "wat 1 <br>"   ;
        return makeHoursArray($totalHours,$x=0,$startingDay,$endingDay,$activeHours,$activeDays,$maxOrders);
    }
    //Si la hora en que el usuario se ingresa esta cercano a la hora de operacion para iniciar  1 hora despues
    if($hourNow<$startingDay && $hourNow<$endingDay){
       //echo "wat 2 <br>";
       return makeHoursArray($totalHours,$x=1,$startingDay,$endingDay,$activeHours,$activeDays,$maxOrders);
    }
    //Si entra en la hora de operacion
    if($hourNow>$startingDay && $hourNow2<$endingDay){
        //echo "wat 3 <br>";
        return makeHoursArray($totalHours,$x=2,$hourNow,$endingDay,$activeHours,$activeDays,$maxOrders);
    }
    // si entra horas despues de operacion
     //echo "wat 4 <br>";
     $nextDay = strtotime('tomorrow midnight');
     $totalDays = totalDays($activeDays,$nextDay)+1;
     $startingDay = strtotime('+'.$totalDays.' day',$startingDay);
     $endingDay = strtotime('+'.$totalDays.' day',$endingDay);
     
    return makeHoursArray($totalHours,$x=0,$startingDay,$endingDay,$activeHours,$activeDays,$maxOrders);
}
function makeHoursArray($totalHours,$x,$start,$end,$activeHours,$activeDays,$maxOrders,$z=0){
    for($y=0; $x<=$totalHours ;$x++){
        $timestampFloor = (floor(strtotime('+'.$x.' hours',$start)/3600)*3600);
        if(getTotalHourOrders($timestampFloor)<$maxOrders){
            $hour[] =array("value"=>$timestampFloor, "hour"=>date('d/m/y h:i A',$timestampFloor));
        }else{
            if($y==0)
                $y = -1;
            else
                $y--;  
        }
        if($y>=0){
            if($timestampFloor==$end)
                    return $hour;
        }
    }
    //En caso de que no encuentra un dia con ordenes disponibles busca el siguiente dia operable y vuelve a revisar
    $z++;
    $hour = strtotime('+'.$z.' days today midnight');
    $totalDays = totalDays($activeDays,$hour);
    $start = strtotime('+'.$totalDays+$z.' days',strtotime('today midnight'));
    $startHour = date('H',strtotime($activeHours[0]))*3600;
    $endHour = (date('H',strtotime($activeHours[1])) - date('H',strtotime($activeHours[0])))*3600;
    $end = $start+$startHour+$endHour;
    $start +=  $startHour;
    $totalHours = ($end-$start)/3600;
    return makeHoursArray($totalHours,$x=0,$start,$end,$activeHours,$activeDays,$maxOrders,$z);
}
function totalDays($activeDays,$timestamp){
    for($x = 0 ; $x<=7 ; $x++){
        foreach($activeDays as $value){
            $dayNow = date('D',strtotime('+'.$x.' days',$timestamp));
            if($dayNow == $value)
                return $x;

        }
    }
}

run();
?>