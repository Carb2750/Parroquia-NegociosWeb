<?php
/**
 * PHP Version 5
 * Application Router
 *
 * @category Router
 * @package  Router
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @author   Luis Fernando Gomez Figueroa <lgomezf16@gmail.com>
 * @license  Comercial http://
 *
 * @version 1.0.0
 *
 * @link http://url.com
 */
session_start();

require_once "libs/utilities.php";

$pageRequest = "home";


if (isset($_GET["page"])) {
  $pageRequest = $_GET["page"];
}


require_once "controllers/mw/verificar.mw.php";
require_once "controllers/mw/site.mw.php";

$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    generarMenu($_SESSION["userEmail"]);
}
//Este switch se encarga de todo el enrutamiento público
switch ($pageRequest) {
case "home":
    include_once "controllers/home.control.php";
    die();
case "store":
    include_once "controllers/store.control.php";
    die();
case "cart":
    include_once "controllers/cart.control.php";
    die();
case "login":
    include_once "controllers/security/login.control.php";
    die();
case"signup":
    include_once "controllers/security/signup.control.php";
    die();
case"forgot":
    include_once "controllers/security/forgot.control.php";
    die();
case"pwsd":
    include_once "controllers/security/pwsd.control.php";
    die();
case "logout":
    include_once "controllers/security/logout.control.php";
    die();
case "pastoraljuvenil":
        if($logged) {
      addToContext("layoutFile", "verified_layout3");
      renderizar("pages/pastoraljuvenil", array(), "../views/verified_layout3.view.tpl");
    } else {
      renderizar("pages/pastoraljuvenil", array(), "../views/layout2.view.tpl");
    }
    die();
case "acolitos":
    if($logged) {
      addToContext("layoutFile", "verified_layout3");
      renderizar("pages/acolitos", array(), "../views/verified_layout3.view.tpl");
    } else {
      renderizar("pages/acolitos", array(), "../views/layout2.view.tpl");
    }
    die();
case "comunidades":
      if($logged) {
      addToContext("layoutFile", "verified_layout3");
      renderizar("pages/comunidades", array(), "../views/verified_layout3.view.tpl");
    } else {
      renderizar("pages/comunidades", array(), "../views/layout2.view.tpl");
    }
    die();
case "pastoralinfantil":
    if($logged) {
      addToContext("layoutFile", "verified_layout3");
      renderizar("pages/pastoralinfantil", array(), "../views/verified_layout3.view.tpl");
    } else {
      renderizar("pages/pastoralinfantil", array(), "../views/layout2.view.tpl");
    }
    die();
case "sacramentos":
  if($logged) {
    addToContext("layoutFile", "verified_layout3");
    renderizar("pages/sacramentos", array(), "../views/verified_layout3.view.tpl");
  } else {
    renderizar("pages/sacramentos", array(), "../views/layout2.view.tpl");
  }
    die();
case "eventos":
  if($logged) {
    addToContext("layoutFile", "verified_layout3");
    renderizar("pages/eventos", array(), "../views/verified_layout3.view.tpl");
  } else {
    renderizar("pages/eventos", array(), "../views/layout2.view.tpl");
  }
    die();
case "horarios":
  if($logged) {
    addToContext("layoutFile", "verified_layout3");
    renderizar("pages/horarios", array(), "../views/verified_layout3.view.tpl");
  } else {
    renderizar("pages/horarios", array(), "../views/layout2.view.tpl");
  }
    // include_once "controllers/pages/horarios.control.php";
    die();
case "contactanos":
  if($logged) {
    addToContext("layoutFile", "verified_layout3");
    renderizar("pages/contactanos", array(), "../views/verified_layout3.view.tpl");
  }
  else {
    renderizar("pages/contactanos", array(), "../views/layout4.view.tpl");
  }
    die();
case "misioneros":
    if($logged) {
      addToContext("layoutFile", "verified_layout3");
      renderizar("pages/misioneros", array(), "../views/verified_layout3.view.tpl");
    }
    else {
      renderizar("pages/misioneros", array(), "../views/layout4.view.tpl");
    }
    die();
}

//Este switch se encarga de todo el enrutamiento que ocupa login
$logged = mw_estaLogueado();
if ($logged) {
    addToContext("layoutFile", "verified_layout");
    include_once 'controllers/mw/autorizar.mw.php';
    if (!isAuthorized($pageRequest, $_SESSION["userEmail"])) {//Aqui
        include_once "controllers/notauth.control.php";
        die();
    }
    else{
      generarMenu($_SESSION["userEmail"]);
    } 
}


switch ($pageRequest) {

case "start":
    ($logged)?
      include_once "controllers/home.control.php":
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
      die();
case "storeL":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/store.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
      die();
case "cartL":
    if($logged) {
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/cart.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
      die();
case "Users":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Users.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "User":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/User.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Roles":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Roles.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Tipos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Tipos.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Tipo":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Tipo.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Categorias":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Categorias.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Categoria":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Categoria.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Statuses":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Statuses.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Status":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Status.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Pago":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Pago.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Pagos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Pagos.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Modulos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Modulos.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Modulo":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Modulo.control.php";
    }else{ 
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Accesos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Accesos.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Acceso":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Acceso.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Productos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Productos.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Producto":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Producto.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Entregas":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Entregas.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Entrega":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Entrega.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Variations":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Variations.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Variation":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Variation.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Manejos":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Manejos.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Manejo":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Manejo.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Ordenes":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Ordenes.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Orden":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/security/Orden.control.php";
    }else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
            
case "Checkout":
    if($logged) {
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/Checkout.control.php";
    } else {
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Historial":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/history.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Config":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/user.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Change":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/change.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Directions":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/directions.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();        
case "Approved":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/approved.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
case "Canceled":
    if($logged){
      addToContext("layoutFile", "verified_layout2");
      include_once "controllers/user/canceled.control.php";
    }else{
      mw_redirectToLogin($_SERVER["QUERY_STRING"]);
    }
    die();
                             
}

addToContext("pageRequest", $pageRequest);
require_once "controllers/error.control.php";
