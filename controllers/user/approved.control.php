<?php 
    require_once 'models/support/management.model.php';
    require_once 'models/support/cart.model.php';
    require_once 'models/security/neighborhood.model.php';
    require_once 'models/security/pagos.model.php'; 
    require_once 'models/orders.model.php';
    require_once 'libs/paypal.php';
    require_once "libs/sendmail.php";
    use PayPal\Api\Payment;
    use PayPal\Api\PaymentExecution;
    use PayPal\Api\Transactions;

    function run(){
        $viewData = array();
        $viewData["hasErrors"]=false;
        $viewData["total"]=getCartTotal()+0.99;
        $viewData["total"]= sprintf('%0.2f', $viewData["total"]);
        if(isset($_GET["page"])){
            $viewData["page"]=$_GET["page"];
        }

        $products = getCartItems($viewData["page"]);
        $payment = executePaypal();
        if($payment){
            $viewData["paymentId"] = $payment->getId();
            $viewData["paymentState"] = $payment->getState();
            $viewData["shippingFee"] = $payment->getTransactions()[0]->getAmount()->getDetails()->getShipping();
            $viewData["total"]= $payment->getTransactions()[0]->getAmount()->getTotal();
            $html = makeHtmlReceipt($products["products"], $viewData["shippingFee"], $viewData["total"]);
            sendemail($_SESSION["userEmail"], 'Gracias por tu compra', $html);
            unset($_SESSION["cart"]);
            unset($_SESSION["cartSize"]);
        } else {
            $viewData["hasErrors"]=true;
        }
        mergeFullArrayTo($products,$viewData);
        renderizar('user/Approved', $viewData);
    }
    function executePaypal()
    {
        if (isset($_GET['PayerID'])) {
            $apiContext = getApiContext();

            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            try {
                // error_log($payment->toJSON());
                $result = $payment->execute($execution, $apiContext);
                
                error_log($result);
                try {
                    $payment = Payment::get($paymentId, $apiContext);
                } catch (Exception $ex) {
                    error_log($ex);
                    return false;
                }
            } catch (Exception $ex) {
                error_log($ex);
            }
            return $payment;
        } else {
            error_log("Usuario cancelo transacción o no es un a peticio adecuada");
            return false;
        }
    }
    function makeHtmlReceipt($products, $shipping, $total){
        $htmlBody = '<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Food Service</title>
            <style>
                * {
                font-family: "Poppins", sans-serif;
                }
                .mail {
                background-color: #d80000;
                padding: 1em;
                }
                .action-title {
                background-color: #7a0202;
                padding: 0.5em;
                margin: 1em 0px;
                border-radius: 9px;
                }
                .action-title h1 {
                text-align: center;
                opacity: 1;
                color: #fff;
                font-size: 2em !important;
                }
    
                .content {
                border-radius: 9px;
                text-align: center;
                margin: 0em;
                background-color: #7a0202;
                padding: 1em;
                color: #fff;
                }
                .content h2 {
                background-color: transparent;
                font-size: 2em;
                }
                .content .receipt {
                padding: 1em;
                border-radius: 9px;
                list-style: none;
                background-color: #d80000;
                }
                .content .receipt li {
                text-align: left;
                font-size: 1em;
                }
                .content .receipt .total {
                font-weight: bold;
                }
                .content .messages li {
                text-align: left;
                font-size: 1.2em;
                }
                @media (min-width: 1024px) {
                .mail {
                padding: 10em;
                }
                .content {
                padding: 3em;
                }
                .content .receipt li {
                text-align: left;
                font-size: 1.5em;
                }
                }
            </style>
        </head>
        <body>
            <div class="mail">
                <div class="action-title">
                    <h1>Food Service HN</h1>
                </div>
                <div class="content">
                    <h2>Compra Realizada</h2>
                    <ul class="receipt">';
                    foreach($products as $products){
                        $htmlBody.= '<li>'.$products["prdDscES"].' $'.$products["prdPrice"].' x'.$products["cartQuantity"].'</li>';
                    }
        $htmlBody .= '<li class="total">Costo de Envio: $'.$shipping.'</li>
                      <li class="total">Total: $'.$total.'</li></ul>
        <ul class="messages">
            <li>Su compra fue realizada existosamente</li>
            <li>Este a la Espera de actualizaciones de su pedido</li>
        </ul>
    </div>
    </div>
    </body>
    </html>';
    return $htmlBody;
    }
    run();
?>