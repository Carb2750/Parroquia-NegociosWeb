<div class="page-cart">
            <div class="cart-list">
                {{if hasItems}}
                    {{foreach products}}
                    <div class="items"> 
                            <img class="" src="{{prdImageURL}}" alt="">
                            <div class="info">
                                <h2> {{prdDscES}} </h2>
                                <form action="index.php?page={{page}}" method="post">
                                    <input type="hidden" name="prdCod" value="{{prdCod}}">
                                    <input type="hidden" name="cartCod" value="{{cartCod}}">
                                    <input type="hidden" name="prdQuantity" value="{{prdQuantity}}">
                                    <p>Cantidad: {{prdQuantity}}</p>
                                    <p>Precio: ${{prdPrice}}</p>
                                    <p>*Incluye Papas Fritas</p>
                                    <p class="add"><button id="btnLess" name="btnLess" type="submit"><i class="fas fa-minus"></i></button>&nbsp;{{cartQuantity}}&nbsp;
                                    <button id="btnAdd" name="btnAdd" type="submit"><i class="fas fa-plus"></i></button></p>
                                    <p class="trash"><button id="btnTrash" name="btnTrash" type="submit"><i class="fas fa-trash-alt"></i></button></p>
                                </form>
                            </div>
                    </div>
                    <div class="line-pink"></div>
                    {{endfor products}}
                {{endif hasItems}} 

                {{ifnot hasItems}}
                            <div class="items">
                                <div class="info col-offset-2" style="font-size: 2em;">
                                    <p>No hay nada en carreta</p>
                                </div>
                                
                            </div>
                {{endifnot hasItems}}
            </div>
            {{if hasItems}}
            <div class="subtotal no-padding">
                <h2>Subtotal:   ${{subtotal}}</h2>
                	&nbsp;
                <div class="line-redDark"></div>
                &nbsp;
                <form action="index.php?page={{page}}" method="post">
                        <input type="hidden" name="btnPagar">
                        <button class="no-padding" id="btnPagar">Pagar</button>
                </form>
            </div>
            {{endif hasItems}}
</div>
<script>
    $().ready(function(){
    $("#btnAdd").click(function(e){
      e.stopPropagation();
    });
  });
</script>