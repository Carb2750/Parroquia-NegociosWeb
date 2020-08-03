<div class="page-checkout">
        <div class="col-s-12 col-m-4 col-3 no-padding">
        </div>
        {{ifnot hasErrors}}
        <div class="check-info col-s-12 col-m-8 col-10 no-padding">
            <h2 style="font-size: 3em;">&nbsp;&nbsp;Compra Satisfactoria</h2>
            <h2>Orden en Paypal: {{paymentId}} Estado: {{paymentState}}</h2>
             <div class="row">
                <div class="rules">
                    <h3>Importante</h3>
                        <ul>
                        <li>&nbsp;&nbsp;*Utilizaremos el Número Telefónico o su Correo Electrónico para Contactarlo.</li>
                        <li>&nbsp;&nbsp;*Lo estaremos actualizando via correo Electrónico acerca el estado de su orden  </li>
                        <li>&nbsp;&nbsp;*En caso de no poder Contactarlo la entrega se pospondrá.</li>
                        <br>
                        <li><a href="index.php?page=start">Regresar</a></li>
                    </ul>
                </div>
            </div>
            <br> <br><br> <br><br> <br><br> <br><br><br><br><br><br>
        </div>
        {{endifnot hasErrors}}
        {{if hasErrors}}
        <div class="check-info col-s-12 col-m-8 col-12 no-padding">
            <h2 style="font-size: 3em;">&nbsp;&nbsp;Error al procesar la transaccion de Pago</h2>
             
            <br> <br><br> <br><br> <br><br> <br><br><br><br><br><br>
        </div>
        {{endif hasErrors}}
    </div>