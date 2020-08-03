<?php
//middleware de configuración de todo el sitio
require_once "libs/parameters.php";
function site_init(){
    global $host_server;
    if(isset($_SESSION["userName"])){
        addToContext("userName",$_SESSION["userName"]);
    }
    if(isset($_SESSION["cartSize"])){
        addToContext("cartItems",$_SESSION["cartSize"]);
    }
    else{
        $_SESSION["cartSize"]=0;
        addToContext("cartItems",$_SESSION["cartSize"]);
    }

    addToContext("page_title","Parroquia");
    addToContext("max_file_size",20); // In Megas
    addToContext("host_server",$host_server); 
    date_default_timezone_set ( "America/Tegucigalpa" );
}
site_init();

?>
