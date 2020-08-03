<div class="page-single">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Pago&act={{act}}&cod={{paymentCod}}" method="POST">
            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="paymentCod" value="{{paymentCod}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">
            <div class="single-input row">
                <br>
                <label class="left" for="text">Codigo de Forma de Pago</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="paymentCod" id="paymentCod" placeholder="Forma de Pago" 
                    value="{{paymentCod}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Forma de Pago Español</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="paymentDscES" id="paymentDscES" placeholder="Nombre de Forma de Pago" 
                    value="{{paymentDscES}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Forma de Pago Ingles</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="paymentDscEN" id="paymentDscEN" placeholder="Nombre de Forma de Pago" 
                    value="{{paymentDscEN}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="text">Nombre de Libreria</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="paymentLib" id="paymentLib" placeholder="Nombre de Libreria" 
                    value="{{paymentLib}}" {{readonly}}>
            </div>
            
            <div class="single-input row">
                <label for="paymentState">Estado</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="paymentState" id="paymentState" 
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
      window.location.assign("index.php?page=Pagos");
    });


    
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>