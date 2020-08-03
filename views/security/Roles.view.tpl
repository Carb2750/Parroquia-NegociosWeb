<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Roles del Usuario</h1>
            <div class="row col-offset-s-3 col-offset-m-8 col-offset-9 no-padding">
              <button class="button-3 col-s-7 col-m-7 col-6 col-l-5 no-padding" id="btnRegresar">Regresar</button>  
            </div>
            <br>
        </div>
        
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th></th>
                </thead>
                <tbody>
                   
                   {{foreach userRoles}}
                    
                     <tr>
                         <form action="index.php?page=Roles&cod={{userCodUT}}" method="post">
                            <input type="hidden" name="typeCod" id="typeCod" value="{{typeCod}}">
                            <input type="hidden" name="typeDsc" id="typeDsc" value="{{typeDsc}}">
                            <input type="hidden" name="userCod" id="userCod" value="{{userCodUT}}"> 
                            <td>{{typeCod}}</td>
                            <td>{{typeDsc}}</td>
                            <td class="col-s-2 col-m-3 col-2 no-padding">
                            <button class="button-3 col-s-9 col-m-6" name="btnDenegar" id="btnDenegar" type="submit"><i class="fas fa-ban"></i></button> 
                            </td>
                        </form>
                    </tr>
                     
                   {{endfor userRoles}}
                   
                </tbody>
            </table>
        </div>
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Roles Disponibles</h1>
            
        </div>
        
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th></th>
                </thead>
                <tbody>
                   
                   {{foreach userAvalaibleRoles}}
                     <tr>
                            <form action="index.php?page=Roles&cod={{userCod}}" method="post" class="col-s-12">
                                <input type="hidden" name="typeCod" id="typeCod" value="{{typeCod}}">
                                <input type="hidden" name="typeDsc" id="typeDsc" value="{{typeDsc}}">
                                <input type="hidden" name="userCod" id="userCod" value="{{userCod}}"> 
                                    <td>{{typeCod}}</td>
                                    <td>{{typeDsc}}</td>
                                    <td class="col-s-1 col-m-3 col-2">
                                    <button class="button-3 col-s-9 col-m-6" name="btnAcceder" id="btnAcceder" type="submit"><i class="fas fa-plus-circle"></i></button> 
                                    </td>
                        </form>
                    </tr>
                   {{endfor userAvalaibleRoles}}
                    
                </tbody>
            </table>
        </div>
    </div>
<script>
  $().ready(function(){

    $("#btnRegresar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Users");
    });
  });
</script>