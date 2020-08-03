<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Variaciones de {{prdDscES}}</h1>
            <div class="row col-offset-s-3 col-offset-m-8 col-offset-9 no-padding">
              <button class="button-3 col-s-7 col-m-7 col-6 col-l-5" id="btnRegresar">Regresar a Productos</button>
              
            </div>
            <br>
        </div>
        <div class="buscador col-offset-s-1 col-offset-m-2 col-offset-4 no-padding">
            <form action="index.php?page=Variations&prdCod={{prdCod}}" method="post" class="col-s-12">
              <input type="hidden" name="prdCod" value="{{prdCod}}">
              <input class="col-s-8 col-5 no-padding"type="text" name="txtFiltar" id="txtFiltar" 
                {{if error}} placeholder="{{error}}" {{endif error}}!  placeholder="Filtar por Codigo..">
              <button type="submit" id="btnFiltar" name="btnFiltrar" class="col-s-3 col-m-2 col-1 no-padding"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th><a href="index.php?page=Variation&act=INS&cod=&prdCod={{prdCod}}"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach variations}}
                     <tr>
                        <td>{{variationPrice}}</td>
                        <td>{{variationQuantity}}</td>
                        <td>{{variationState}}</td>
                        <td>
                           <a href="index.php?page=Variation&act=UPD&cod={{variationCod}}&prdCod={{prdCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Variation&act=DSP&cod={{variationCod}}&prdCod={{prdCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor variations}}
                </tbody>
            </table>
        </div>
    </div>
<script>
  $().ready(function(){
    $("#btnFiltrar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
    $("#btnRegresar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Productos");
    });
  });
</script>