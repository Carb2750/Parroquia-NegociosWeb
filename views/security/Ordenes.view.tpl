<div class="page-table">
    
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Ordenes</h1>
        </div>
        <div class="buscador col-offset-s-1 col-offset-m-1 col-offset-3 no-padding">
            <form action="index.php?page=Ordenes" method="post" class="col-s-12">
            <select class="options" name="statusesCMB" id="statusesCMB">
               {{foreach statuses}}
                <option value="{{statusCod}}" {{selected}}>{{statusDscES}}</option>
               {{endfor statuses}}
            </select>
            <select class="options" name="recentCMB" id="recentCMB">
                {{foreach orderBy}}
                    <option value={{cod}} {{selected}}>{{Dsc}}</option>
                {{endfor orderBy}}
            </select>
            <input class="col-s-8 col-m-4 col-5 no-padding"type="text" name="txtFiltar" id="txtFiltar" {{if error}} placeholder="{{error}}" {{endif error}} 
            placeholder="Filtar por nombre..">
            <button type="submit" id="btnFiltar" name="btnFiltrar" class="col-s-2 col-m-1 col-1 no-padding"><i class="fas fa-search"></i></button>
            {{if recentCMB}}
                <button type="submit" id="btnWat" name="btnWat" class="col-s-2 col-m-1 col-1 no-padding"><i class="fas fa-ban"></i></button>
            {{endif recentCMB}}
            </form>
        </div>
        <div class="pagination">
            <ul>
                {{if show}}
                    {{foreach pagination}}
                        <li><a href="index.php?page=Ordenes&n={{cod}}"  class="{{selected}}">{{cod}}</a></li>
                    {{endfor pagination}}
                {{endif show}}
                {{if recentCMB}}
                     {{foreach pagination}}
                        <li><a href="index.php?page=Ordenes&recentCMB={{recentCMB}}&statusesCMB={{statusesCMB}}&txtFiltrar={{txtFiltrar}}&n={{cod}}" class="{{selected}}">{{cod}}</a></li>
                    {{endfor pagination}}
                {{endif recentCMB}}
            </ul>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Nombre</th>
                    <th>Fecha de Entrega</th>
                    <th colspan="4">Estado</th>
                </thead>
                <tbody>
                    {{foreach orders}}
                        <tr>
                            <td> {{userName}} </td>
                            <td> {{orderDeliverTime}} </td>
                            <td colspan="3"> {{statusDscES}} &nbsp;&nbsp;<span class="{{color}}"><i class="fas fa-circle"></i></span>
                            </td>
                            <td>
                                 <a href="index.php?page=Orden&cod={{orderCod}}"><i class="fas fa-pencil-ruler"></i></a> 
                            </td> 
                        </tr>
                        <tr class="order-detail">
                            <td class="data"><b>Telefono<br></b> {{orderCell}} </td>
                            <td class="data"><b>Compra<br></b> {{orderMade}} </td>
                            <td class="data"><b>Pago<br></b> {{paymentDscES}} </td>
                            
                            <td class="data"><b>Envio<br></b> {{orderShippingFee}} </td>  
                            <td class="data"><b>Subtotal<br></b> {{subtotal}} </td>
                            <td class="data"><b>Total<br></b> {{orderTotal}} </td>
                        </tr>
                        <tr class="order-detail">
                            <td class="data" colspan="6"><b>Dirección: <br></b> {{orderDirection}} </td>
                        </tr>
                        {{foreach orderDetail}}
                        <tr class="order-detail">
                            <td class="data"><b>Orden</b></td>
                            <td class="data" colspan="2"><b>Comida<br></b> {{prdDscES}} </td>
                            <td class="data"><b>Cantidad<br></b> {{prdQuantity}} </td>  
                            <td class="data"><b>Precio<br></b> {{prdPrice}} </td>
                            <td class="data"><b>x {{cartQuantity}}<br></b></td>
                        </tr>
                        {{endfor orderDetail}}
                    {{endfor orders}}                   
                    {{ifnot orders}}
                     <tr>
                        <td colspan="6" style="padding: 8em;">No tienes Ordenes Disponibles</td>
                        </td> 
                    </tr>
                    {{endifnot orders}}
                    
                </tbody>
            </table>
        </div>
        
    </div>