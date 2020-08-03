<?php
/* Login  Controller
 * 2017-06-10
 * Created By OJBA
 */
require_once 'models/security/security.model.php';

/**
 * Controlador de Login
 *
 * @return void
 */
function run()
{
    $loginData = array(
      "errors" => array(),
      "tocken" => "",
      "txtEmail"=>"",
      "showerrors"=>false,
      "returnto"=>"?page=start"
    );

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $loginData["tocken"] = md5("loginentry".time());
        $_SESSION["login_tocken"] = $loginData["tocken"];
        if (isset($_GET["returnUrl"])) {
            $loginData["returnto"] = $_GET["returnUrl"];
        }
        renderizar("security/login", $loginData);
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once "libs/validadores.php";
        //Validaciones
        if (isset($_POST["tocken"]) && isset($_SESSION["login_tocken"])) {
            if (($_POST["tocken"] === $_SESSION["login_tocken"]) && (!isEmpty($_SESSION["login_tocken"]))) {
                $loginData["txtEmail"] = $_POST["txtEmail"];
                $loginData["txtPswd"] = $_POST["txtPswd"];
                $loginData["returnto"]= $_POST["returnto"];
                if (isEmpty($loginData["txtEmail"]) || !isValidEmail($loginData["txtEmail"])) {
                    $loginData["errors"][] = "Correo Electrónico con formato incorrecto";
                }
                if (isEmpty($loginData["txtPswd"])) { //se elimina validacion de contraseña || !isValidPassword($loginData["txtPswd"])){
                    $loginData["errors"][] = "Debe ingresar una contraseña.";
                }


                if (count($loginData["errors"]) > 0) {
                    $loginData["tocken"] = md5("loginentry".time());
                    $_SESSION["login_tocken"] = $loginData["tocken"];
                    $loginData["showerrors"] = true;
                    renderizar("security/login", $loginData);
                } else {
                    //Correr Login del modelo de datos
                    $tmperrors = validarLogin($loginData["txtEmail"], $loginData["txtPswd"]);
                    if (count($tmperrors)) {
                        $loginData["tocken"] = md5("loginentry".time());
                        $_SESSION["login_tocken"] = $loginData["tocken"];
                        foreach ($tmperrors as $terr) {
                            $loginData["errors"][] = $terr;
                        }
                        $loginData["showerrors"] = true;
                        renderizar("security/login", $loginData);
                    } else {
                        header("Location:index.php" . $loginData["returnto"]);
                    }
                }
            } else {
                $loginData["tocken"] = md5("loginentry".time());
                $_SESSION["login_tocken"] = $loginData["tocken"];
                $loginData["errors"][] = "Falla al intentar validar credenciales.";
                $loginData["showerrors"] = true;
                renderizar("security/login", $loginData);
            }
        } else {
            $loginData["tocken"] = md5("loginentry".time());
            $_SESSION["login_tocken"] = $loginData["tocken"];
            $loginData["errors"][] = "Falla al intentar validar credenciales.";
            $loginData["showerrors"] = true;
            renderizar("security/login", $loginData);
        }
    }
}

/**
 * Valida el Login de un usuario
 *
 * @param string $loginEmail correo electrónico del usuario
 * @param string $loginPswd  contraseña ingresada para validar
 *
 * @return void
 */
function validarLogin($loginEmail, $loginPswd)
{

    $usuario = obtainUserByEmail($loginEmail);
    $_SESSION["userName"] = $usuario["userName"];
    $errors = array();
    if (!empty($usuario)) {
        //verificacion de contraseña
        $timestamp = $usuario["userRgstrd"];
        if($timestamp%2==0){
            $loginPswd = $usuario["userEmail"].$loginPswd.$timestamp;
        }
        else{
            $loginPswd = $timestamp.$usuario["userEmail"].$loginPswd;
        }
        $loginPswd = md5($loginPswd.$timestamp);


        if ($usuario["userPswd"] == $loginPswd) {
            mw_setEstaLogueado(
                $usuario["userCod"],
                $usuario["userName"],
                $usuario["userEmail"],
                $usuario["userCell"],
                $usuario["userType"],
                true
            );
        } else {
            $errors[] = "E002 : No se pudieron validar las credenciales ingresadas."; //Contraseña Incorrecta
        }
    } else {
        $errors[] = "E001: No se pudieron validar las credenciales ingresadas."; //No existe el usuario
    }
    return $errors;
}
// Se corre la funcion para levantar el controlador
run();
?>
