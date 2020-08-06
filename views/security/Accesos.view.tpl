<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Control de Niveles de Acceso</h1>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Dar Acceso</th>
                </thead>
                <tbody>
                   {{foreach types}}
                     <tr>
                        <td>{{typeCod}}</td>
                        <td>{{typeDsc}}</td>
                        <td class="col-s-1 col-m-3 col-2">
                           <a href="index.php?page=Acceso&cod={{typeCod}}"><i class="fas fa-user-check"></i></a> 
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