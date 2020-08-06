<div class="page-table">
    
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Ordenes</h1>
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