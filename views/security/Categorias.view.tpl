<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Categorias</h1>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre Español</th>
                    <th>Nombre Ingles</th>
                    <th>Estado</th>
                    <th><a href="index.php?page=Categoria&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach category}}
                     <tr>
                        <td>{{catCod}}</td>
                        <td>{{catDscES}}</td>
                        <td>{{catDscEN}}</td>
                        <td>{{catState}}</td>
                        <td>
                           <a href="index.php?page=Categoria&act=UPD&cod={{catCod}}"><i class="fas fa-pencil-ruler"></i></a> 
                           <a href="index.php?page=Categoria&act=DSP&cod={{catCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor category}}
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