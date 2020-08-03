<!DOCTYPE html>
    <html>
        <head>
            <title>{{page_title}}</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css">
            <link rel="stylesheet" href="public/scss/style.css">
            <script src="public/js/jquery.min.js"></script>
        </head>
<body>
     <header>
        <nav id="menu-barra" class=" ">
            <div class="title col-s-7 col-m-5 col-12 no-margin no-padding">
                <a href="index.php?page=home">
                    <p><img src="public/imgs/logo.png" alt="">&nbsp;Parroquia San Juan Bautista</p>
                </a>
            </div>
            <div class="burger" id="hmb">
                <div></div>
                <div></div>
                <div></div>
            </div>     
            <ul class="col-s-12 col-m-7 col-12 col-l-7 nav-links no-margin center">
                <li><a href="index.php?page=misioneros" class="hover">Misioneros</a></li>
                <li><a href="index.php?page=contactanos" class="hover">Contactanos</a></li>
                <li><a class="hover" href="index.php?page=store">Catalogo</a></li>
                <li><a class="hover" href="index.php?page=cart"><i class="fas fa-utensils"></i>&nbsp; {{cartItems}}</a></li>
                <li class="button-1" style="font-size:small;"><a href="index.php?page=login">Registrate</a></li>
            </ul>
        </nav>
    </header>
            <div class="contenido">
                {{{page_content}}}
            </div>

            <!--<div class="footer" class="gray-color">
                <p>Tel: 999-999</p>
                <i><a href="#"><img src="./icons/facebook.svg" alt="Icono de facebook"></a></i>
            </div>-->
            {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
    
    <script src="public/js/hmb.js"></script>        
</body>
</html>
