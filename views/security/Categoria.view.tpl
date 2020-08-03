<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Categoria&act={{act}}&cod={{catCod}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="catCod" value="{{catCod}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">
            {{if readonly}}
                <div class="single-input row">
                <br>
                <label class="left" for="text">Codigo de Categoria</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" disabled readonly="readonly" type="text" name="catCod" id="catCod" placeholder="Codigo de Usuario" value="{{catCod}}" {{readonly}}>
            </div>
            {{endif readonly}}
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Categoria Español</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="catDscES" id="catDscES" placeholder="Nombre de Categoria" value="{{catDscES}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Categoria Ingles</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="catDscEN" id="catDscEN" 
                    placeholder="Nombre de Categoria" value="{{catDscEN}}" {{readonly}}>
            </div>
            
            <div class="single-input row">
                <label for="catState">Estado</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="catState" id="catState" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach states}}
                        <option value="{{stateCod}}" {{selected}} >{{stateDsc}}</option>
                    {{endfor states}}
                </select>
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
                {{endofr errors}}
            </ul>
        {{endif hasErrors}}
    </div>
</div>

<script>
  $().ready(function(){

    $("#btnCancelar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Categorias");
    });


    
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>