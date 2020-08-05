
<div class="page-store">
    <div class="filter-options col-s-7 col-m-6 col-2 no-padding no-margin center">
        <form action="index.php?page={{page}}" method="post">
                <legend>Categoría</legend>
                <div class="line"></div>
                <button class="left col-s-12 no-padding">&nbsp;{{check}} Todo</button>
                {{foreach categories}}
                    <form action="index.php?page={{page}}" method="post">
                      <input type="hidden" name="catCod"value="{{catCod}}">
                      <button class="left col-s-12 no-padding" type="submit" name="btnFiltro">&nbsp;{{check}}
                         {{catDscES}} </button>
                    </form>
                {{endfor categories}}
                <div class="line cols-12 hide-s hide-m"></div>
            </form>
        </div>
        <div class="filter">
            <a href="#"><i class="fas fa-list-ul"></i></a>
        </div>
        <div class="products">
            <div class="items col-s-12 col-m-8 col-6 col-l-6 center col-offset-m-2 col-offset-5 col-offset-l-5 no-padding">
                {{foreach products}}
                  <form id="formProducts"class="col-s-12 col-m-12 col-11 no-padding product" action="index.php?page={{page}}" method="post">
                    <input type="hidden" name="prdCod" value="{{prdCod}}">
                      <div class="foto col-s-12 col-m-4 col-5 no-padding">
                        <h2 class="center">  {{prdDscES}} </h2>
                        <img class="store-image col-s-9 col-m-6 col-10 col-l-12 no-padding" src="{{prdImageURL}}" alt="">
                      </div>
                      <div class="line-red"></div>
                      
                      <div class="opciones">
                          <h3>Productos</h3>
                            <label>
                              <input name="radio"type="radio" value="{{prdCod}}" checked>{{prdQuantity}} {{prdDscES}} ${{prdPrice}}
                              <span class="checkmark"></span>
                            </label>
                            {{foreach variations}}
                              <label>
                                <input name="radio" type="radio" value="{{variationCod}}">{{variationQuantity}} {{prdDscES}} ${{variationPrice}}
                                <span class="checkmark"></span>
                              </label>
                            {{endfor variations}}

                      </div>
                      <div class="line-red"></div>
                      <div class="opciones">
                          <button name="btnCart" id="btnCart" type="submit">+&nbsp;<i class="fas fa-cart-plus"></i>&nbsp;</button>
                          <button name="btnCheckout" id="btnCheckout" type="submit">Ordenar Ahora</button>
                      </div>    
                  </form>
                {{endfor products}}
            </div>
        </div>
    </div>
    <script>
        $().ready(function(e){
          $(".filter").click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $(".filter-options").toggleClass('show');
            $(".filter").toggleClass('open');
            });
        });
       
      </script>
