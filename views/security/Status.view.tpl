<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Status&act={{act}}&cod={{statusCod}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="statusCod" value="{{statusCod}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">
                <div class="single-input row">
                <br>
                <label class="left" for="text">Codigo de Status</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="statusCod" id="statusCod" placeholder="Codigo de Status" value="{{statusCod}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Status Español</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="statusDscES" id="statusDscES" placeholder="Nombre de Status" value="{{statusDscES}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Status Ingles</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="statusDscEN" id="statusDscEN" placeholder="Nombre de Status" value="{{statusDscEN}}" {{readonly}}>
            </div>
            
            <div class="single-buttons col-offset-s-2 col-offset-m-4 col-8 col-offset-5 no-padding">
                <button class="button-3"  type="submit" id="btnConfirmar" {{readonly}}>Confirmar</button>&nbsp;
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
      window.location.assign("index.php?page=Statuses");
    });


    
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>