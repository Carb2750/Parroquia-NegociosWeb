<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=User&act={{act}}&cod={{userCod}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">

            <div class="single-input row">
                <br>
                <label class="" for="userEmail">Correo Electronico del Usuario</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="userEmail" id="userEmail" 
                  placeholder="Correo Electronico" value="{{userEmail}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="userName">Nombre del Usuario</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="userName" id="userName" 
                  placeholder="Nombre Completo" value="{{userName}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="userCell">Celular del Usuario</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="userCell" id="userCell" 
                  placeholder="Numero Telefonico" value="{{userCell}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <label for="userState">Estado de Usuario</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="userState" id="userState" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach states}}
                        <option value="{{stateCod}}" {{selected}} >{{stateDsc}}</option>
                    {{endfor states}}
                </select>
            </div>
          
            <div class="single-input row">
                <br>
                <label class="left" for="userPswd">Contraseña del Usuario</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="userPswd" id="userPswd" 
                  placeholder="Contraseña" {{readonly}}>
            </div>
            <div class="single-buttons col-offset-s-2 col-offset-m-4 col-12 {{ifnot updating}}col-offset-3 {{endifnot updating}}{{if updating}}col-offset-2 {{endif updating}}no-padding">
                {{if updating}} <button class="button-3 col-offset-1" type="submit" id="btnVariaciones">Roles</button>&nbsp; {{endif updating}}
                {{ifnot readonly}}<button class="button-3"  type="submit" id="btnConfirmar" >Confirmar</button>&nbsp; {{endifnot readonly}}
                <button class="button-3" type="submit" id="btnCancelar">Cancelar</button>
            </div>
            <br>
        </form>
        {{if hasErrors}}
            <ul>
                {{foreach errors}}
                    <li>{{this}}</li>
                {{endfor errors}}
            </ul>
        {{endif hasErrors}}
    </div>
</div>

<script>
  $().ready(function(){

    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Users");
    });

    $("#btnVariaciones").click(function(e){
        e.stopPropagation();
        e.preventDefault();
        window.location.assign("index.php?page=Roles&cod={{userCod}}");
    });
    
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>