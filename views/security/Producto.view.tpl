<div class="page-single" style="height:200vh;">
    <br>

    <div class="row action-title col-s-12"><h1>{{mode}}</h1></div>

    <div class="row single-form col-s-10 col-m-6 col-4 col-offset-s-1 col-offset-m-3 col-offset-4 no-padding">

        <form class="col-s-12 no-padding left" action="index.php?page=Producto&act={{act}}&cod={{prdCod}}" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="token" id="token" value="{{token}}">
            <input type="hidden" name="prdCod" value="{{prdCod}}">
            <input type="hidden" name="btnConfirmar" value="confirmar">
            <input type="hidden" name="prdImageURL"value="{{prdImageURL}}">

            <div class="single-input row">
                <br>
                <label class="left" for="prdImageURL">Imagen de Producto</label><br>
                <img class="col-s-8 no-padding no-margin" src="{{prdImageURL}}" alt="Foto Producto">
                
                <input class="col-s-12 col-m-11 col-12 no-padding" type="file" name="prdImageURL" id="prdImageURL" 
                    placeholder="Codigo de Producto" value="{{prdImageURL}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="prdDscES">Nombre de Producto Español</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="prdDscES" id="prdDscES" 
                    placeholder="Nombre del Producto" value="{{prdDscES}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="prdDscEN">Nombre de Producto Ingles</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="prdDscEN" id="prdDscEN" 
                    placeholder="Nombre del Producto" value="{{prdDscEN}}" {{readonly}}>
            </div>
            
            <div class="single-input row">
                <br>
                <label class="left" for="prdPrice">Precio del Producto</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="prdPrice" id="prdPrice" 
                    placeholder="Precio del Producto" value="{{prdPrice}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="prdPrice">Unidades en Venta</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="prdQuantity" id="prdQuantity" 
                    placeholder="Unidades del Producto" value="{{prdQuantity}}" {{prdQuantity}} {{readonly}}>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="prdCategory">Categoria del Producto</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="prdCategory" id="prdCategory" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach categories}}
                        <option value="{{catCod}}" {{selected}} >{{catDscES}}</option>
                    {{endfor categories}}
                </select>
            </div>
            <div class="single-input row">
                <br>
                <label class="left" for="prdStock">Stock Disponible</label><br>
                <input class="col-s-12 col-m-11 col-12 no-padding" type="text" name="prdStock" id="prdStock" 
                    placeholder="Stock del Producto" value="{{prdStock}}" {{readonly}}>
            </div>
            <div class="single-input row">
                <label for="prdState">Estado</label><br>
                <select class="col-s-12 col-m-11 col-12 no-padding" name="prdState" id="prdState" 
                {{if readonly}} readonly="readonly" disabled {{endif readonly}} >
                    {{foreach states}}
                        <option value="{{stateCod}}" {{selected}} >{{stateDsc}}</option>
                    {{endfor states}}
                </select>
            </div>
            <div class="single-buttons col-offset-s-2 col-offset-m-4 col-12 {{ifnot updating}}col-offset-2 {{endifnot updating}}{{if updating}}col-offset-1 {{endif updating}}no-padding">
                {{if updating}} <button class="button-3 col-offset-" type="submit" id="btnVariaciones">Añadir Variaciones</button>&nbsp; {{endif updating}}
                {{ifnot readonly}}<button class="button-3"  type="submit" id="btnConfirmar" >Confirmar</button>&nbsp; {{endifnot readonly}}
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
      window.location.assign("index.php?page=Productos");
    });


    $("#btnVariaciones").click(function(e){
        e.stopPropagation();
        e.preventDefault();
        window.location.assign("index.php?page=Variations&prdCod={{prdCod}}");
    });
    $("#btnConfirmar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });


  });
</script>