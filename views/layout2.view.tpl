<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parroquia</title>
    <!--<link rel="stylesheet" href="./styles.css">-->
    <link rel="stylesheet" href="./styles/Components/Header.css">
    <link rel="stylesheet" href="./styles/Components/Footer.css">
    <link rel="stylesheet" href="./styles/Components/Cards.css">
    <link rel="stylesheet" href="./styles/Components/Carousel.css">
    <link rel="stylesheet" href="./styles/Components/Buttons.css">
    <link rel="stylesheet" href="./styles/Components/Frase.css">
    <link rel="stylesheet" href="./styles/Utils/Utils.css">
    <link rel="stylesheet" href="./styles/Components/Clouds.css">
    <link rel="stylesheet" href="./styles/Utils/Responsive.css">
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
                <li><a href="index.php?page=home"><h1>Parroquía San Juan Bautista</h1></a></li>
            </ul>
            <ul class="nav-container-links gray-color">
                <li><a href="index.php?page=misioneros" class="nav-links">Misioneros</a></li>
                <li><a href="index.php?page=contactanos" class="nav-links">Contactanos</a></li>
                <li><a href="index.php?page=login" class="nav-links">Iniciar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="contenido">
                {{{page_content}}}
            </div>
    <footer class="gray-color">
        <p>Tel: 999-999</p>
        <i><a href="#"><img src="./public/icons/facebook.svg" alt="Icono de facebook"></a></i>
    </footer>

    <script src="./js/carousel.js"></script>
    <!--<script src="./js/verMasBtn.js"></script>-->
    <script src="./js/menuBtn.js"></script>
    <!--<script src="./js/parallax.js"></script>-->
    <!--<script src="./js/moveOnLoad.js"></script>-->
</body>
</html>