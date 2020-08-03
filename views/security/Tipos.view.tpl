<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Usuarios</h1>
        </div>
        <div class="buscador col-offset-s-1 col-offset-m-2 col-offset-4 no-padding">
            <form action="" method="post" class="col-s-12">
            <input class="col-s-8 col-5 no-padding"type="text" name="txtFiltar" id="txtFiltar" {{if error}} placeholder="{{error}}" {{endif error}} placeholder="Filtar por Codigo..">
            <button type="submit" id="btnFiltar" name="btnFiltrar" class="col-s-3 col-m-2 col-1 no-padding"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Fecha de Expiracion</th>
                    <th><a href="index.php?page=Tipo&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach types}}
                     <tr>
                        <td>{{typeCod}}</td>
                        <td>{{typeDsc}}</td>
                        <td>{{typeState}}</td>
                        <td>{{typeExp}}</td>
                        <td>
                           <a href="index.php?page=Tipo&act=UPD&cod={{typeCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Tipo&act=DSP&cod={{typeCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor types}}
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