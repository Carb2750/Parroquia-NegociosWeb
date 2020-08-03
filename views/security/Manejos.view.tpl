<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Horario</h1>
        </div>
        <div class="buscador col-offset-s-1 col-offset-m-2 col-offset-4 no-padding">
            <form action="index.php?page=Manejos" method="post" class="col-s-12">
            <input class="col-s-8 col-5 no-padding"type="text" name="txtFiltar" id="txtFiltar" {{if error}} placeholder="{{error}}" {{endif error}} 
            placeholder="Filtar por Codigo ....">
            <button type="submit" id="btnFiltar" name="btnFiltrar" class="col-s-3 col-m-2 col-1 no-padding"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Horas Activas</th>
                    <th>Dias Activos</th>
                    <th>Maximo de Orden por Hora</th>
                    <th>Estado</th>
                    <th><a href="index.php?page=Manejo&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach management}}
                     <tr>
                        <td>{{codManagement}}</td>
                        <td>{{hourManagement}}</td>
                        <td>{{daysManagement}}</td>
                        <td>{{maxOrderManagement}}</td>
                        <td>{{stateManagement}}</td>
                        <td class="col-s-2 col-m-3 col-2">
                           <a href="index.php?page=Manejo&act=UPD&cod={{codManagement}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Manejos&cod={{codManagement}}"><i class="fas fa-arrow-alt-circle-up"></i></a>
                        </td>
                    </tr>
                   {{endfor management}}
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