<main class="all-width-height">
    <h2>Contáctanos</h2>
    <section class="section-contactar">
        <form action="Contactanos.html" method="GET" id="formulario" class="form">
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input type="text" name="txtNombre"
                        id="txtNombre" class="form-camps" placeholder="Ingrese su nombre"
                        maxlength="60" />
            </div>
            <div class="form-group">
            <label for="txtApellido">Apellido</label>
            <input type="text" name="txtApellido"
                    id="txtApellido" class="form-camps" placeholder="Ingrese su apellido"
                    maxlength="60" />
            </div>
            <div class="form-group">
            <label for="txtCorreo">Correo electronico:</label>
            <input type="text" name="txtCorreo"
                    id="txtCorreo" class="form-camps" placeholder="ejemplo@correo.ec"
                    maxlength="60" />
            </div>
            <div class="form-group">
            <label for="txtCelular">Numero de telefono:</label>
            <input type="text" name="txtCelular"
                    id="txtCelular" class="form-camps" placeholder="00000000">
            </div>
            <div class="myimput">
                <div class="form-group">
                <label for="txtMensaje">Mensaje:</label>
                <textarea name="txtMensaje" id="txtMensaje" placeholder="" cols="50" rows="10"></textarea>
                </div>
            </div>
            <div class="btncontacto">
                <button class="enviar-btn" id="btnEnviar" name="btnEnviar" value="Enviar">Enviar</button>
            </div>
        </form>
        <aside class="info">
            <p class="f-size-m text-center">Información de Contacto</p>
            <p>Telefono: 999-999</p>
            <p>Ubicación: Segunda Ent Colonia Kennedy, Tegucigalpa</p>
            <p>Correo: Parroquia@gmail.com</p>
        </aside>
    </section>
</main>
<script src="./public/js/contactanos.js"></script>
<script src="./public/js/menuBtn.js"></script>