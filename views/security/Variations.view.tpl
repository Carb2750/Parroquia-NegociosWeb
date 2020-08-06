<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Variaciones de {{prdDscES}}</h1>
            <div class="row col-offset-s-3 col-offset-m-8 col-offset-9 no-padding">
              <button class="button-3 col-s-7 col-m-7 col-6 col-l-5" id="btnRegresar">Regresar a Productos</button>
              
            </div>
            <br>
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