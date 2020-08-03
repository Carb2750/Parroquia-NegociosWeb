<?php
//middleware de verificación

    function mw_estaLogueado(){
        if( isset($_SESSION["userLogged"]) && $_SESSION["userLogged"] == true){
          return true;
        }else{
          $_SESSION["userLogged"] = false;
          $_SESSION["userCod"] = "";
          $_SESSION["userScreenName"] = "";
          $_SESSION["userEmail"] = "";
          $_SESSION["userType"] = "";
          return false;
        }
    }
    function mw_setEstaLogueado($usuario, $nombre, $email,$cell,$tipo, $logueado){
        if($logueado){
            $_SESSION["userLogged"] = true;
            $_SESSION["userCod"] = $usuario;
            $_SESSION["userEmail"] = $email;
            $_SESSION["userScreenName"] = $nombre;
            $_SESSION["userCell"] = $cell;
            $_SESSION["userType"] = $tipo;
        }else{
            $_SESSION["userLogged"] = false;
            $_SESSION["userCod"] = "";
            $_SESSION["userScreenName"] = "";
            $_SESSION["userEmail"] = "";
            $_SESSION["userCell"] = "";
            $_SESSION["userType"] = "";
        }
    }
    function mw_redirectToLogin($to){
        $loginstring = urlencode("?".$to);
        $url = "index.php?page=login&returnUrl=".$loginstring;
        header("Location:" . $url);
        die();
    }

?>
