<?php
function run(){
    //Deloguearse e ir al Landing page
    mw_setEstaLogueado("","","","","",false);
    unset($_SESSION["cart"]);
    unset($_SESSION["cartSize"]);
    header("Location:index.php?page=home");
}
run();
?>
