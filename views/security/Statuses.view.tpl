<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Estados</h1>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre Estado Español</th>
                    <th>Nombre Estado Ingles</th>
                    <th><a href="index.php?page=Status&act=INS"><i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach status}}
                     <tr>
                        <td>{{statusCod}}</td>
                        <td>{{statusDscES}}</td>
                        <td>{{statusDscEN}}</td>
                        <td>
                           <a href="index.php?page=Status&act=UPD&cod={{statusCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Status&act=DSP&cod={{statusCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor status}}
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