<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Modulos</h1>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre Español</th>
                    <th>Nombre Ingles</th>
                    <th>Estado</th>
                    <th>Clase</th>
                    <th><a href="index.php?page=Modulo&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach module}}
                     <tr>
                        <td>{{mdlCod}}</td>
                        <td>{{mdlDscES}}</td>
                        <td>{{mdlDscEN}}</td>
                        <td>{{mdlState}}</td>
                        <td>{{mdlClass}}</td>
                        <td class="col-s-2 col-m-3 col-2">
                           <a href="index.php?page=Modulo&act=UPD&cod={{mdlCod}}"><i class="fas fa-pencil-ruler"></i></a> 
                           <a href="index.php?page=Modulo&act=DSP&cod={{mdlCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor module}}
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