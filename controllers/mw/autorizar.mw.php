<?php
require 'models/security/security.model.php';

function generarMenu($userEmail)
{
    $menu = array();
    $menu = makeMenu($userEmail);
    addToContext('appmenu', $menu);
}

function isAuthorized($assetCode, $userEmail)
{
    /*$programa = obtenerFuncionPorCodigo($assetCode);
    if (count($programa) == 0) {
        insertFuncion($assetCode, $assetCode, 'ACT', 'PRG');
    }
    if ($_SESSION["userType"] == 'ADM') {
        return true;
    }*/
    return authorized($userEmail, $assetCode);
}
?>
