<div class="page-single">
            <br>
            <div class="row action-title col-s-12"><h1>Cambio de Contraseña</h1></div>
            <div class="row single-form">
                <form action="index.php?page=pwsd&userEmail={{userEmail}}&token={{urlToken}}" method="POST" class="col-s-10 col-m-6 col-6 no-padding">
                    <input type="hidden" name="token" id="token" value="{{token}}">
                    <input type="hidden" name="userEmail" id="userEmail" value="{{userEmail}}">
                    
                       <input type="hidden" name="btnConfirmar" value="confirmar">
                    <div class="single-input right">
                        <label for="userCell">Nueva Contraseña</label><br>
                        <input class="col-s-12 col-m-12 col-6 no-padding {{wErr}}" type="password" name="newPswd" id="newPswd"{{if pwdsErr}}placeholder="{{pwdsErr}}"{{endif pwdsErr}}
                        placeholder="8 Caracteres o más" required/>
                    </div>
                    <div class="single-input right">
                        <label for="userCell">Repita la Contraseña</label><br>
                        <input class="col-s-12 col-m-12 col-6 no-padding {{pErr}}" type="password" name="retypePswd" id="retypePswd"{{if pasErr}}placeholder="{{pasErr}}"{{endif pasErr}}
                        placeholder="Repita la Contraseña" required/>
                    </div>
                    <div class="single-buttons col-offset-7 no-padding">
                        <button class="button-3"  type="submit" id="btnConfirmar">Realizar Cambio</button>&nbsp;
                        <button type="submit" class="button-3" id="btnCancelar">Cancelar</button>
                    </div>
                    <br>
                    <br>
                </form>
            </div>  <!--single-form-->
</div><!--page-single-->
<script>
  $().ready(function(){

    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=login");
    });
    $("#btnConfirmar").click(function(e){
      
    });
  });
</script>