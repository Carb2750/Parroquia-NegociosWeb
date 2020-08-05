<!--<div class="hero">
        <div class="ad">
            <h2>Pide tu orden de Alitas ¡Ya!</h2>
            <button id="btnOrder">Ordenar</button>    
        </div>
    </div>
<script>
    $().ready(function(){
    $("#btnOrder").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    window.location.assign("index.php?page={{store}}");
    });
});
</script>-->
<main>
    <div class="carousel-container">
        <div class="carousel-text">
            <h2>Bienvenido a nuestra Familia</h2>
            <div class="formar-parte">
                <h3>¿Deseas formar parte?</h3>
                <a href="index.php?page=signup">
                    <button class="dorado-color">¡Unetenos!</button>
                </a>
            </div>
        </div>
        <div class="black-cap"></div>
        <div class="carousel-frame carousel-fade">
            <picture>
                <source media="(min-width: 1025px)" srcset="./public/imgs/Desktop/img1.jpg">
                <source media="(min-width: 461px)" srcset="./public/imgs/Tablet/img1.jpg">
                <img src="./public/imgs/Phone/img1.jpg" alt="CarouselImg_1">
            </picture>
        </div>
        <div class="carousel-frame carousel-fade">
            <picture>
                <source media="(min-width: 1025px)" srcset="./public/imgs/Desktop/img2.jpg">
                <source media="(min-width: 461px)" srcset="./public/imgs/Tablet/img2.jpg">
                <img src="./public/imgs/Phone/img2.jpg" alt="CarouselImg_2">
            </picture>
        </div>
        <div class="frame-dot-container">
            <span class="frame-dot"></span> 
            <span class="frame-dot"></span> 
        </div>
    </div>
    <section id="section-frase">
        <p>"No seas vencido de lo malo, sino vence con el bien el mal."</p>
    </section>
    <section id="section-conocenos">
        <!--<div class="cloud-1" id="cloud-1">
            <img src="./public/imgs/biblia.png" alt="Biblia">      
        </div>
        <div class="cloud-1" id="cloud-2">
            <img src="./public/imgs/biblia.png" alt="Biblia">                 
        </div>
        <div class="cloud-1" id="cloud-3">
            <img src="./public/imgs/biblia.png" alt="Biblia">                        
        </div>-->
        <h2>¡Unetenos!</h2>
        <div class="section-cards">  
            <div class="card">
                <div class="card-front dorado-color">
                    <h3 class="content-white">Movimientos</h3>
                    <span class="outer-circle blue-color">
                        <span class="inner-circle">
                            <img id="church-img" src="./public/icons/Church.svg" alt="asd">
                        </span>
                    </span>
                    <button class="blue-color"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                    </button>
                </div>
                <div class="card-back">
                    <div class="back-content">
                        <ul>
                            <li><a href="index.php?page=pastoraljuvenil">Pastoral Juvenil</a></li>
                            <li><a href="index.php?page=acolitos">Acolitos</a></li>
                            <li><a href="index.php?page=comunidades">Comunidades</a></li>
                            <li><a href="index.php?page=pastoralinfantil">Pastoral Infantil</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-front dorado-color">
                    <h3 class="content-white">Eventos</h3>
                    <span class="outer-circle blue-color">
                        <span class="inner-circle">
                            <img id="events-img" src="./public/icons/Events.svg" alt="asd">
                        </span>
                    </span>
                    <button class="blue-color"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                    </button> 
                </div>
                <div class="card-back">
                    <div class="back-content">
                        <ul class="height-80">
                            <li class="li-space"><span class="li-title">Prueba</span><span class="li-date">15-mar</span></li>
                            <li class="li-space"><span class="li-title">Prueba</span><span class="li-date">15-mar</span></li>
                            <li class="li-space"><span class="li-title">Prueba</span><span class="li-date">15-mar</span></li>
                            <li class="li-space"><span class="li-title">Prueba</span><span class="li-date">15-mar</span></li>
                        </ul>
                        <a class="no-before" href="index.php?page=eventos">
                            <button class="mas-info-btn blue-color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-front dorado-color">
                    <h3 class="content-white">Horarios</h3>
                    <span class="outer-circle blue-color">
                        <span class="inner-circle">
                            <img id="reloj-img" src="./public/icons/Reloj.svg" alt="#">
                        </span>
                    </span>
                    <button class="blue-color"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                    </button>
                </div>
                <div class="card-back">
                    <div class="back-content">
                        <ul class="height-80">
                            <li class="li-space">Misas</li>
                            <li class="li-space">Pastoral Juvenil</li>
                            <li class="li-space">Comunidades</li>
                            <li class="li-space">Acolitos</li>
                            <li class="li-space">Pastoral Infantil</li>
                        </ul>
                        <a class="no-before" href="index.php?page=horarios">
                            <button class="mas-info-btn blue-color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-image">
        <h2 class="content-white">¡Haz un sacramento!</h2>
        <div class="section-cards" id="section-sacramentos">
            <div class="card sacramentos-card d-none">
                <div class="card-front dorado-color">
                    <h3 class="content-white">Sacramentos</h3>
                    <span class="outer-circle blue-color">
                        <span class="inner-circle">
                            <img id="sacramentos-img" src="./icons/Cup.svg" alt="asdas">
                        </span>
                    </span>
                    <button class="ver-mas-btn voltear-btn blue-color">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"> <g class="nc-icon-wrapper" fill="#444444"> <path d="M14.83 30.83L24 21.66l9.17 9.17L36 28 24 16 12 28z"></path> </g> </svg>  
                    </button>
                </div>
                <div class="card-back">
                    <!--<a href="#">-->
                        <div class="back-content">
                            <ul>
                                <li><a href="index.php?page=sacramentos#Bautismo">Bautismo</a></li>
                                <li><a href="index.php?page=sacramentos#Confesion">Confesión</a></li>
                                <li><a href="index.php?page=sacramentos#Eucaristia">Eucaristía</a></li>
                                <li><a href="index.php?page=sacramentos#Matrimonio">Matrimonio</a></li>
                                <li><a href="index.php?page=sacramentos#Misa">Misa</a></li>
                                <li><a href="index.php?page=sacramentos#Sacerdocio">Sacerdocio</a></li>
                                <li><a href="index.php?page=sacramentos#Uncion">Unción</a></li>
                            </ul>
                        </div>
                    <!--o</a>-->
                </div>
            </div>
            <div class="collage">
                <div>
                    <a href="index.php?page=sacramentos#Bautismo"><img src="./public/imgs/Phone/bautismo.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Confesion"><img src="./public/imgs/Phone/confesion.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Eucaristia"><img src="./public/imgs/Phone/eucaristia.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Matrimonio"><img src="./public/imgs/Phone/matrimonio.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Misa"><img src="./public/imgs/Phone/misa.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Sacerdocio"><img src="./public/imgs/Phone/sacerdocio.jpg" alt="Imagen de bautismo"></a>
                </div>
                <div>
                    <a href="index.php?page=sacramentos#Uncion"><img src="./public/imgs/Phone/uncion.jpg" alt="Imagen de bautismo"></a>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="./public/js/carousel.js"></script>
<script src="./public/js/menuBtn.js"></script>