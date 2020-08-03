<div class="page-checkout">
        <div class="total col-s-12 col-m-4 col-3 no-padding">
            <div class="row">
                {{foreach products}}
                    <p>{{cartQuantity}} x {{prdDscES}} ${{prdPrice}}</p>  
                {{endfor products}}
            </div>
            <div class="line-redDark"></div>
            <div class="row">
                <p>Costo de Entrega : $0.99</p>
            </div>
            <div class="line-redDark"></div>
            <div class="row">
                <h2>Total a Pagar :</h2>
                <h3> ${{total}} </h3>
            </div>
        </div>
        <div class="check-info col-s-12 col-m-8 col-9 no-padding">
            <form action="index.php?page=Checkout" method="POST" class="{{show}}">
                <h2>Direcciones Anteriores</h2>
                <div class="direcciones">
                     {{foreach userHood}}
                        <button id="btnMia" name="btnMia" value="{{directCod}}"> {{hoodDsc}} </button>
                    {{endfor userHood}}
                </div>
                </form>
                <h2>1. &nbsp;&nbsp;Información de Entrega</h2>
                <div class="line-redDark"></div>
                    <form action="index.php?page=Checkout" method="POST">
                    <input type="hidden" name="token" id="token" value="{{token}}">
                    <div class="row">
                        <label for="orderDeliveryTime">Hora de Entrega:</label>&nbsp;<br>
                        <select name="orderDeliveryTime" id="orderDeliveryTime" required>
                            {{foreach hours}}
                                <option value="{{value}}">{{hour}}</option>
                            {{endfor hours}}
                        </select >
                    </div>
                    
                   <div class="row">
                    <label for="hoodCod">Lugar de Residencia:</label>&nbsp;<br>
                    <select class="{{hErr}}"name="hoodCod" id="hoodCod" required>
                        {{foreach hood}}
                            <option value="{{hoodCod}}" {{selected}} >{{hoodDsc}}</option>
                        {{endfor hood}}
                    </select>
                   </div>

                    <div class="row">
                        <label for="orderCell">Número Telefónico:</label>&nbsp;<br>
                        <input class="{{cErr}}" type="text" name="orderCell" id="orderCell" {{if userCell}}value="{{userCell}}"{{endif userCell}} {{if cellErr}}placeholder="{{cellErr}}"{{endif cellErr}}
                        placeholder="Ej. 9875-6543" required>
                    </div>
                    
                    <div class="row">
                        <label for="directStreet">Dirección Especifica:</label>
                        <br>
                        <textarea class="{{dErr}}"name="directStreet" id="directStreet" {{if direErr}}placeholder="{{direErr}}"{{endif direErr}} 
                            placeholder="Ej. Esquina Opuesta al mall premier, tercer casa color roja despues de la pulperia 'Alicia'." required>{{directStreet}}</textarea>
                    </div>
                    <div class="line-redDark"></div>

                    <div class="row">
                        <div class="rules">
                            <h3>Importante</h3>
                            <ul>
                                <li>&nbsp;&nbsp;*Solo hacemos entregas a los Lugares de Residencia Establecidos.</li>
                                <li>&nbsp;&nbsp;*Utilizaremos el Número Telefónico o su Correo Electrónico para Contactarlo.</li>
                                <li>&nbsp;&nbsp;*En caso de no poder Contactarlo la entrega se pospondrá.</li>
                            </ul>
                        </div>
                    </div>
               
                <h2>2.&nbsp;&nbsp;Metodo de Pago</h2>
                <div class="line-redDark"></div>
                &nbsp;&nbsp;
                    <div class="payments">
                        {{foreach payments}}
                            <button type="submit" name="btnPayment" value="{{paymentCod}}"><i class="fab fa-cc-{{paymentLib}}"></i></button>
                        {{endfor payments}}
                        
                        <button type="submit" name="money"><i class="fas fa-money-bill-wave"></i></button>
                    </div>
            </form>
        </div>
    </div>