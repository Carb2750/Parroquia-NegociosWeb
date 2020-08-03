<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Lugares de Entrega</h1>
        </div>
        <div class="buscador col-offset-s-1 col-offset-m-2 col-offset-4 no-padding">
            <form action="index.php?page=Entregas" method="post" class="col-s-12">
            <input class="col-s-8 col-5 no-padding"type="text" name="txtFiltar" id="txtFiltar" {{if error}} placeholder="{{error}}" {{endif error}} 
            placeholder="Filtar nombre en Español..">
            <button type="submit" id="btnFiltar" name="btnFiltrar" class="col-s-3 col-m-2 col-1 no-padding"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre del Lugar</th>
                    <th>Costo de Envio</th>
                    <th>Estado</th>
                    <th><a href="index.php?page=Entrega&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach neighborhood}}
                     <tr>
                        <td>{{hoodCod}}</td>
                        <td>{{hoodDsc}}</td>
                        <td>{{hoodShippingFee}}</td>
                        <td>{{hoodState}}</td>
                        <td>
                           <a href="index.php?page=Entrega&act=UPD&cod={{hoodCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Entrega&act=DSP&cod={{hoodCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor neighborhood}}
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
  });
</script>