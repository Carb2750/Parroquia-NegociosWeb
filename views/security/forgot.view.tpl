<div class="signin">

</div>
<div class="container-signin flex col-s-12 col-m-12 col-2 no-margin no-padding">
<form id="formLogin" action="index.php?page=forgot" method="POST" class="form col-12 no-margin">
    <br>
    <a href="index.php?page=login">Regresar</a>
    <h1>Olvido de Contaseña</h1>
    <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>
    <br>
    <input type="hidden" name="token" id="token" value="{{token}}">
    <input type="hidden" name="btnConfirmar" value="confirmar">
    
    {{ifnot correo}}
        <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
        <label for="txtEmail">Correo Electronico</label><br>
        <input class="col-s-12 col-m-8 col-11 {{xErr}} {{eErr}}" type="text" name="txtEmail" id="txtEmail"{{if emaErr}}placeholder="{{emaErr}}"{{endif emaErr}} 
            {{if existErr}}placeholder="{{existErr}}"{{endif existErr}}
            placeholder="tuCorreo@ejemplo.com" required value="{{txtEmail}}"/>
        </div>
    {{endifnot correo}}

    {{if correo}} 
        <p class="center">Te hemos enviado un correo para realizar el cambio de contraseña</p>
    {{endif correo}}
    
    <br>
      <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>
    
      <br>
      {{ifnot correo}}
        <button class="button-3 col-s-12 col-m-3 col-7 no-padding" type="submit" id="btnConfirmar"><span class="ion-log-in">Solicitar</span>&nbsp;</button>
      {{endifnot correo}}
      {{if hasErrors}}
        <div class="errors center">
          <ul>
            {{foreach errors}}
              <li>
                <i class="fas fa-times"></i>&nbsp;{{this}}
              </li>
            {{endfor errors}}
          </ul>
        </div>
    {{endif hasErrors}}
  </form>
</div>
