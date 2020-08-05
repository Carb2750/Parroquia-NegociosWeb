<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parroquia</title>
    <!--<link rel="stylesheet" href="./styles.css">-->
    <link rel="stylesheet" href="./styles/Components/Header.css">
    <link rel="stylesheet" href="./styles/Components/Footer.css">
    <link rel="stylesheet" href="./styles/Components/layout.css">
    <link rel="stylesheet" href="./styles/Utils/Utils.css">
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

        {{{page_content}}}

    <footer class="gray-color">
        <p>Tel: 999-999</p>
        <i><a href="#"><img src="./public/icons/facebook.svg" alt="Icono de facebook"></a></i>
    </footer>
        {{foreach js_ref}}
                <script src="{{uri}}"></script>
            {{endfor js_ref}}
    
    <script src="public/js/hmb.js"></script> 
</body>
</html>