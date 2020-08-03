<?php 
require_once 'models/security/product.model.php';
require_once 'models/security/category.model.php';
require_once 'models/security/state.model.php';

    $viewData = array();
    $viewData["states"] = getState() ;
    $viewData["categories"]=getCategories();
    $viewData["act"] = "";
    $viewData["readonly"]="";
    $viewData["updating"]="";
    $viewData["mode"]= "";
    $viewData["token"]="";
    $viewData["hasErros"] = false;
    $viewData["errors"]=array();
    $viewData["modeDsc"] = array("INS"=>"Agregando Nuevo Producto", "UPD"=>"Actualizando Producto", "DSP"=>"Mostrando Producto");

    if(isset($_GET["act"])){
        $viewData["act"] = $_GET["act"];
        $viewData["mode"] = $viewData["modeDsc"][$viewData["act"]];
    }

    switch($viewData["act"]){
        case "INS":
            break;
        case "UPD":
            $viewData["updating"]="updating";
            break;
        case "DSP":
            $viewData["readonly"]="readonly disabled";
            break;
        default:
            redirectWithMessage("El cocinero no encontro tu pedido", "index.php?page=Producto");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if(isset($_POST["btnConfirmar"])){
            $varBody = array();
            $varBody = $_POST;
            
            mergeFullArrayTo($varBody, $viewData);
            $validated = true;
            if($varBody["token"]!=$_SESSION["productos_token"]){
                error_log("Critical Token Error");
                redirectWithMessage("Parece que algo se quemo en la cocina, vuelve a intentar", "index.php?page=Productos");
            }
            if($validated){
                switch($viewData["act"]){
                    case "INS":
                        $result = "";

                        $errors= array();
                        $file_name = $_FILES['prdImageURL']['name'];
                        $file_size =$_FILES['prdImageURL']['size'];
                        $file_tmp =$_FILES['prdImageURL']['tmp_name'];
                        $file_type=$_FILES['prdImageURL']['type'];
                        $fileExt = pathinfo($_FILES['prdImageURL']['name'], PATHINFO_EXTENSION);
                        $file_upload_to = "public/imgs/";
                        //echo $fileExt;
                        $extensions= array("jpeg","jpg","png");
                        
                        if(in_array($fileExt,$extensions)=== false){
                            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                        }
                        
                        if($file_size > 2097152){
                            $errors[]='File size must be excately 2 MB';
                        }
                        
                        if(empty($errors)==true){
                            move_uploaded_file($file_tmp,$file_upload_to.$file_name);
                            echo "Success";
                        }else{
                            print_r($errors);
                        }
                    
                        /*
                        $result=newProduct($varBody["prdImageURL"],$varBody["prdDscES"],$varBody["prdDscEN"],$varBody["prdPrice"],$varBody["prdCategory"],
                        $varBody["prdStock"],$varBody["prdState"]);*/

                        $result=newProduct($file_upload_to.$file_name,$varBody["prdDscES"],$varBody["prdDscEN"],$varBody["prdPrice"],$varBody["prdQuantity"],
                        $varBody["prdCategory"],$varBody["prdStock"],$varBody["prdState"]);

                        if($result){
                            redirectWithMessage("Producto Creado Correctamente","index.php?page=Productos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo crear el Producto";
                        }
                        
                        break;
                    case "UPD":
                        $result = "";
                        if(!empty($_FILES['prdImageURL']['name'])){
                            echo '<pre>'.print_r($_FILES).'</pre>';
                            $errors= array();
                            $file_name = $_FILES['prdImageURL']['name'];
                            $file_size =$_FILES['prdImageURL']['size'];
                            $file_tmp =$_FILES['prdImageURL']['tmp_name'];
                            $file_type=$_FILES['prdImageURL']['type'];
                            $fileExt = pathinfo($_FILES['prdImageURL']['name'], PATHINFO_EXTENSION);
                            $file_upload_to = "public/imgs/";
                            //echo $fileExt;
                            $extensions= array("jpeg","jpg","png");
                            
                            if(in_array($fileExt,$extensions)=== false){
                                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                            }
                          
                            
                            if(empty($errors)==true){
                                move_uploaded_file($file_tmp,$file_upload_to.$file_name);
                                echo "Success";
                            }else{
                                print_r($errors);
                            }
                            $result=updateProduct($varBody["prdCod"],$file_upload_to.$file_name,$varBody["prdDscES"],$varBody["prdDscEN"],$varBody["prdPrice"],$varBody["prdQuantity"],
                            $varBody["prdCategory"],$varBody["prdStock"],$varBody["prdState"]);
                        }
                        else{
                            $result=updateProduct($varBody["prdCod"],$varBody["prdImageURL"],$varBody["prdDscES"],$varBody["prdDscEN"],$varBody["prdPrice"],$varBody["prdQuantity"],
                            $varBody["prdCategory"],$varBody["prdStock"],$varBody["prdState"]);
                        }
                        
                       
                
                        if($result){
                            redirectWithMessage("Producto Modificado Correctamente","index.php?page=Productos");
                        }else{
                            $viewData["hasErrors"]=true;
                            $viewData["errors"][]="No se pudo modificar el Producto";
                            echo showErrors();
                        }
                        break;
                        
                }
            }

        }
    }
    $viewData["token"] = md5("token_productos".time());
    $_SESSION["productos_token"] = $viewData["token"];

    if(isset($_GET["cod"]) && $viewData["act"]!="INS"){
        $products = array();
        $products = getProductByCode($_GET["cod"]);
        mergeFullArrayTo($products, $viewData);
    }
    if(isset($viewData["prdState"])){
        $viewData["states"] = addSelectedCmbArray($viewData["states"],'stateCod',$viewData["prdState"]);
    }
    if(isset($viewData["prdCategory"])){
        $viewData["categories"] = addSelectedCmbArray($viewData["categories"],'catCod',$viewData["prdCategory"]);
    }
    
    renderizar("security/Producto", $viewData);
?>