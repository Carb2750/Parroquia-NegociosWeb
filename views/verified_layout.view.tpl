<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8" />
            <title>{{page_title}}</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
             <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-1/css/all.css">
            <link rel="stylesheet" href="public/scss/style.css">
            <script src="public/js/jquery.min.js"></script>
            {{foreach css_ref}}
                <link rel="stylesheet" href="{{uri}}" />
            {{endfor css_ref}}
        </head>
        <body>
            <header>
                <nav id="menu-barra" class=" ">
                    <div class="title col-s-1 col-m-5 col-9 no-margin no-padding">
                        <a href="index.php?page=start">
                            <p><img src="public/imgs/logo.png" alt="">&nbsp;Parroquia San Juan Bautista</p>
                        </a>
                    </div>
                    <div class="burger" id="hmb">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>     
                        <ul class="col-s-12 col-m-7 col-12 col-l-6 nav-links no-margin center">
                            <li><a href="index.php?page=misioneros" class="hover">Misioneros</a></li>
                            <li><a href="index.php?page=contactanos" class="hover">Contactanos</a></li>
                            <li><a class="hover" href="index.php?page=storeL">Catalogo</a></li>
                            <li><a class="hover" href="index.php?page=cartL"><i class="fas fa-utensils"></i>&nbsp; {{cartItems}}</a></li>
                            <li class="button-1"><a href="#slide"><i class="fas fa-cog"></i></a></li>
                        </ul>
                        <ul class="slide col-s-12 col-m-4 col-2 center no-padding">
                            <div class="button-2"><i class="fas fa-times-circle"></i></div>
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
            <div class="contenido">
                {{{page_content}}}
            </div>

            {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
            <script src="public/js/hmb.js"></script>
            <script src="public/js/slide.js"></script>
        </body>
    </html>
