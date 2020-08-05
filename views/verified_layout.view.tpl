<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parroquia</title>
    <!--<link rel="stylesheet" href="./styles.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css">
    <link rel="stylesheet" href="./styles/Components/Header.css">
    <link rel="stylesheet" href="./styles/Components/Footer.css">
    <link rel="stylesheet" href="./styles/Components/Cards.css">
    <link rel="stylesheet" href="./styles/Components/Carousel.css">
    <link rel="stylesheet" href="./styles/Components/Buttons.css">
    <link rel="stylesheet" href="./styles/Components/Frase.css">
    <link rel="stylesheet" href="./styles/Utils/Utils.css">
    <link rel="stylesheet" href="./styles/Components/Clouds.css">
    <link rel="stylesheet" href="./styles/Utils/Responsive.css">
    <link rel="stylesheet" href="./styles/Components/store.css">
    <link rel="stylesheet" href="./styles/Components/cart.css">
    <script src="public/js/jquery.min.js"></script>
</head>
<body>
    <header class="gray-color">
        <nav>
            <div class="hamburguer-button">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul class="top-zindex">
                <li><a href="index.php?page=start"><h1>Parroquía San Juan Bautista</h1></a></li>
            </ul>
            <ul class="nav-container-links gray-color">
                <li><a href="index.php?page=misioneros" class="nav-links">Misioneros</a></li>
                <li><a href="index.php?page=contactanos" class="nav-links">Contactanos</a></li>
                <li><a href="index.php?page=storeL" class="nav-links">Catalogo</a></li>
                <li><a class="hover nav-links" href="index.php?page=cartL"><i class="fas fa-cart-plus"></i>&nbsp; {{cartItems}}</a></li>
                <li id="btn-menusito" class="button-1"><a href="#" class="nav-links"><i class="fas fa-cog"></i></a></li>
            </ul>
            <ul id="menusito" class="slide center no-padding">
                <div id="btn-menusito2" class="button-2"><i class="fas fa-times-circle"></i></div>
                <li><p><b> <br>{{userName}}</b></p></li>
                    {{if notifnum}}
                <li><a href="index.php?page=notificacion">
                <span class="ion-android-notifications">&nbsp;{{notifnum}}</span></a>
                </li>
                {{endif notifnum}}
                {{foreach appmenu}}
                <li><a href="index.php?page={{mdlCod}}">{{mdlDscES}}</a></li>
                {{endfor appmenu}}
                <li class="logout"><a href="index.php?page=logout">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </nav>
    </header>
   
                {{{page_content}}}
           
                        {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
    <footer class="gray-color">
        <p>Tel: 999-999</p>
        <i><a href="#"><img src="./public/icons/facebook.svg" alt="Icono de facebook"></a></i>
    </footer>

    <script src="./js/carousel.js"></script>
    <!--<script src="./js/verMasBtn.js"></script>-->
    <script src="./js/menuBtn.js"></script>
    <!--<script src="./js/parallax.js"></script>-->
    <!--<script src="./js/moveOnLoad.js"></script>-->
        <script>
        $().ready(function(e){
          $("#btn-menusito").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            console.log("APRETADO");
            $("#menusito").toggleClass('show');
            });

            $("#btn-menusito2").click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $("#menusito").toggleClass('show');
            });
        });
        
       
      </script>
</body>
</html>