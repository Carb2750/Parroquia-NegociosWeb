<div class="signin">

</div>
<div class="container-signin flex col-s-12 col-m-12 col-5 no-margin no-padding">
  <form id="formLogin" action="index.php?page=login" method="POST" class="form col-m-6 col-12 no-margin">
    <h1>Iniciar Sesión</h1>

  <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>

    <input name="returnto" value="{{returnto}}" type="hidden"/>
    <input name="tocken" value="{{tocken}}" type="hidden"/>

      <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
        <label for="">Correo Electronico</label><br>
        <input class="col-s-12 col-m-7 col-11" type="text" name="txtEmail" id="txtEmail" placeholder="tuCorreo@ejemplo.com"value="{{txtEmail}}" required/>
     </div>

     <div class="single-input row col-s-12 no-padding col-offset-m-5 col-offset-1">
       <label class="left" for="">Contraseña<br><a href="index.php?page=forgot">¿Olvidaste tu Contraseña?</a></label><br>
       <input class="col-s-12 col-m-7 col-11" type="password" name="txtPswd" id="txtPswd" value="" placeholder="8 Caracteres o más" required/>
     </div>
      <button class="button-3 col-s-12 col-m-4 col-7 no-padding" id="btnSend"><span class="ion-log-in"></span>&nbsp;Iniciar Sesión</button>

    <div class="bar col-s-12 col-m-12 col-12 no-padding"> </div>
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
      <p>¿No tienes una cuenta?</p>
      <button class="button-3 col-s-12 col-m-4 col-7 no-padding" id="btnRegistrate"><a href="index.php?page=signup">Registrate</a></button>
  </form>
</div>
<script>
  $().ready(
    function(){
      $("#btnSend").click(function(e){
          e.preventDefault();
          e.stopPropagation();
          $("#formLogin").submit();
        });
    }
    );
</script>
