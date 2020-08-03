<div class="page-single">
            <br>
            <div class="row action-title col-s-12"><h1>Información General</h1></div>
            <div class="row single-form">
                <form action="index.php?page=Config" method="POST" class="col-s-10 col-m-6 col-6 no-padding">
                    <input type="hidden" name="token" id="token" value="{{token}}">
                       <input type="hidden" name="btnConfirmar" value="confirmar">
                    <div class="single-input right">
                        <br>
                        <label class="left" for="userName">Nombre Completo</label><br>
                        <input class="col-s-12 col-m-12 col-6 no-padding" type="text" placeholder="Nombre de Completo" name="userName" id="userName" value="{{userName}}">
                    </div>
                    <div class="single-input right">
                        <label for="userCell">Teléfono</label><br>
                        <input class="col-s-12 col-m-12 col-6 no-padding {{cErr}}" type="text" name="orderCell" id="orderCell" 
                          {{if userCell}}value="{{userCell}}"{{endif userCell}} {{if cellErr}}placeholder="{{cellErr}}"{{endif cellErr}}
                        placeholder="Ej. 9875-6543" required>
                    </div>
                    <div class="single-buttons col-offset-7 no-padding">
                        <button class="button-3"  type="submit" id="btnConfirmar">Realizar Cambio</button>&nbsp;
                        <button type="submit" class="button-3" id="btnCancelar">Cancelar</button>
                    </div>
                    <br>
                    <div class="line-redDark"></div>
                    <div class="single-buttons">
                        <button class="button-3" id="btnChange">Cambiar Contraseña</button>
                    </div>
                    <br>
                </form>
            </div>  <!--single-form-->
</div><!--page-single-->
<script>
  $().ready(function(){

    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=start");
    });

    $("#btnChange").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Change");
    });


  });
</script>