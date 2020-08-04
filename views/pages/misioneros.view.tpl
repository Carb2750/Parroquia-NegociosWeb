<main class="all-width-height">
    <h2>Misioneros</h1>
    <section class="section-contactar">
        <form action="Misioneros.html" method="GET" id="formulario2" class="form">
            <div class="form-group">
                <label for="txtNombre">Nombre Completo:</label>
                <input type="text" name="txtNombre" class="form-camps"
                        id="txtNombre" placeholder="Ingrese su nombre completo"
                        maxlength="60" size="25" />
            </div>
            <div class="form-group">
            <label for="txtmadre">Nombre del Madre:</label>
            <input type="text" name="txtmadre" class="form-camps"
                    id="txtmadre" placeholder="Ingrese nombre completo de su madre"
                    maxlength="60" size="30"/>
            </div>
            <div class="form-group">
                <label for="txtpadre">Nombre del Padre:</label>
                <input type="text" name="txtpadre" class="form-camps"
                        id="txtpadre" placeholder="Ingrese nombre completo de su padre"
                        maxlength="60" size="30"/>
            </div>
            <div class="form-group">
                <label for="txtCorreo">Correo electronico:</label>
                <input type="text" name="txtCorreo" class="form-camps"
                        id="txtCorreo" placeholder="ejemplo@correo.ec"
                        maxlength="60" />
            </div>
            <div class="form-group">
                <label for="txtedad">Edad:</label>
                <input type="text" name="txtedad" class="form-camps"
                    id="txtedad" placeholder="" size="5"/>
            </div>
            <div class="form-group">
                <label for="txtaños">Años caminando en la iglesia:</label>
                <input type="number" name="txtaños" class="form-camps"
                        id="txtaños" placeholder="" min="1" max="100"/>
            </div>

            <div class="btnmisionero">
                <button class="enviar-btn" id="btnEnviar" name="btnEnviar" value="Enviar">Enviar</button>
            </div>
            </div>

        </form>

        <aside class="info no-padding padding-s inherit">
            <picture>
                <source media="(min-width: 1025px)" srcset="./public/imgs/Desktop/misionero.jpg">
                <source media="(min-width: 461px)" srcset="./public/imgs/Tablet/misionero.jpg">
                <img src="./public/imgs/Phone/misionero.jpg" alt="Imagen de misioneros">
            </picture>
        </aside>
    </section>
</main>

<script src="./public/js/misioneros.js"></script>
<script src="./public/js/menuBtn.js"></script>