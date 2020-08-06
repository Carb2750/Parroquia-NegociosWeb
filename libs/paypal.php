<?php
require_once 'vendor/libPaypal/autoload.php';

function getApiContext()
{
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AQ69Q6wuPIdAPZnPEfGpS74AzQDR0mMwVwQUxjMkclNJ2wTe98SiaH7AlJEkwKHETfvYQQCL4doU8D5Q',     // ClientID
            'EK9lK0RmGgoLyd7Qesx5qYPM4z2zGG6uuC3pQJwL83cXQZV0Oiy6l1_fESn1p6BlAzzWvSstAzQcoh5_'      // ClientSecret
        )
    );
    return $apiContext;
}
function createPaypalTransacction($products, $subtotal,$shipping,$total)
{
    $apiContext = getApiContext();
    $payer = new \PayPal\Api\Payer();
    $payer->setPaymentMethod('paypal');

    $items = new \PayPal\Api\ItemList();
    foreach ($products as $products) {
        $item = new \PayPal\Api\Item();
        $item->setSku($products["prdCod"]);
        $item->setName($products["prdDscES"]);
        $item->setQuantity($products["cartQuantity"]);
        $item->setPrice($products["prdPrice"]);
        $item->setCurrency('USD');
        $items->addItem($item);
    }
    $details = new \PayPal\Api\Details();
    $details->setSubtotal($subtotal);
    $details->setShipping($shipping);

    $amount = new \PayPal\Api\Amount();
    $amount->setDetails($details);
    $amount->setTotal(strval($total));
    $amount->setCurrency('USD');

    $transaction = new \PayPal\Api\Transaction();
    $transaction->setAmount($amount);
    $transaction->setNoteToPayee("Venta de productos por parte de la Parroquia San Juan Bautista");
    $transaction->setItemList($items);

    $redirectUrls = new \PayPal\Api\RedirectUrls();

    $redirectUrls
        ->setReturnUrl("http://127.0.0.1/negociosweb/III%20Parcial/Parroquia-NegociosWeb/index.php?page=Approved") //URL aprovado
        ->setCancelUrl("http://127.0.0.1/negociosweb/III%20Parcial/Parroquia-NegociosWeb/index.php?page=Canceled"); //URL cancelado

    $payment = new \PayPal\Api\Payment();
    $payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions(array($transaction))
        ->setRedirectUrls($redirectUrls);

    try {
        $payment->create($apiContext);
        $_SESSION["paypalTrans"] = $payment;
        return $payment->getApprovalLink();
    } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        // This will print the detailed information on the exception.
        //REALLY HELPFUL FOR DEBUGGING
        error_log($ex->getData());
        return false;
    }
}

?>