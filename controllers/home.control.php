<?php
/* Home Controller
 * 2014-10-14
 * Created By OJBA
 * Last Modification 2014-10-14 20:04
 */
require_once "libs/sendmail.php";
  function run(){
    $viewData = array();
    if(isset($_GET["page"])){
      switch($_GET["page"]){
        case "start":
            $viewData["store"]="storeL";
            break;
        default:
            $viewData["store"]="store";
      }
    }else
      $viewData["store"]="store";
     renderizar("home",$viewData, "../views/layout2.view.tpl");
  }
  run();
?>
