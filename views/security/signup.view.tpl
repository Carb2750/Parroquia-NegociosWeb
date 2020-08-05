<div class="signin">

</div>
<div class="container-signin flex col-s-12 col-m-12 col-2 no-margin no-padding">
<form id="formLogin" action="index.php?page=signup" method="POST" class="form col-12 no-margin">
    <br>
    <a href="index.php?page=login">Regresar</a>
    <h1>Datos Generales</h1>
    <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>
    <br>
    <input type="hidden" name="token" id="token" value="{{token}}">
    <input type="hidden" name="btnConfirmar" value="confirmar">

    <div class="single-buttons row col-s-12 no-padding col-offset-m-5 col-offset-1">
      <label for="txtNombre">Primer Nombre</label><br>
      <input class="col-s-12 col-m-8 col-11 {{nErr}}" type="text" name="txtNombre" id="txtNombre" {{if nameErr}}placeholder="{{nameErr}}"{{endif nameErr}}
      placeholder="Ejem. Juan" required>
    </div>

    <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
      <label for="txtApellido">Primer Apellido</label><br>
      <input class="col-s-12 col-m-8 col-11 {{aErr}}"  type="text" name="txtApellido" id="txtApellido" {{if apeErr}}placeholder="{{apeErr}}"{{endif apeErr}}
        placeholder="Ejem. Perez" required>
    </div>

    <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
      <label for="txtEmail">Correo Electronico</label><br>
      <input class="col-s-12 col-m-8 col-11 {{eErr}}{{xErr}}" type="text" name="txtEmail" id="txtEmail" {{if existErr}}placeholder="{{existErr}}"{{endif existErr}}
        {{if emaErr}}placeholder="{{emaErr}}"{{endif emaErr}}
        placeholder="tuCorreo@ejemplo.com" required value="{{txtEmail}}"/>
    </div>

    <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
      <label for="txtPswd">Contraseña</label><br>
      <input class="col-s-12 col-m-8 col-11 {{wErr}}" type="password" name="txtPswd" id="txtPswd" value="" {{if pwdsErr}}placeholder="{{pwdsErr}}"{{endif pwdsErr}}
        placeholder="8 Caracteres o más" required/>
    </div>

    <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
      <label for="txtRePswd">Repita la Contraseña</label><br>
      <input class="col-s-12 col-m-8 col-11 {{pErr}}" type="password" name="txtRePswd" id="txtRePswd" value="" {{if pasErr}}placeholder="{{pasErr}}"{{endif pasErr}}
        placeholder="Repita la Contraseña" required/>
    </div>
    <br>
      <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>

      <br>
      <button class="button-3 col-s-12 col-m-3 col-7 no-padding" type="submit" id="btnConfirmar"><span class="ion-log-in"></span>&nbsp;Registrarse</button>
      {{if showerrors}}
        <div class="errors center">
          <ul>
            {{foreach errors}}
              <li>
                <i class="fas fa-times"></i>&nbsp;{{this}}
              </li>
            {{endfor errors}}
          </ul>
        </div>
    {{endif showerrors}}
  </form>
</div>
