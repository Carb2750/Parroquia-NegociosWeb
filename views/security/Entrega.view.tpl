<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Entrega&act={{act}}&cod={{hoodCod}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="hoodCod" value="{{hoodCod}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">
            <div class="single-input row">
                <br>
                <label class="left" for="hoodDsc">Nombre del Lugar</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="hoodDsc" id="hoodDsc" 
                placeholder="Nombre del Lugar" value="{{hoodDsc}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="hoodShippingFee">Costo de Envio</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="hoodShippingFee" id="hoodShippingFee" 
                    placeholder="Costo de Envio" value="{{hoodShippingFee}}" {{readonly}}>
            </div>
            
            <div class="single-input row">
                <label for="hoodState">Estado</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="hoodState" id="hoodState" 
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
      window.location.assign("index.php?page=Entregas");
    });


    
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>