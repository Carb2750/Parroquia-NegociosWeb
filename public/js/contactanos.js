var formulario = document.getElementById("formulario");

window.onload = iniciar;

function iniciar(){
    document.getElementById("btnEnviar").addEventListener('click', validar,false);
}

function validarnombre(){
    var elemento = document.getElementById("txtNombre");
    limpiarerror(elemento)
    if(elemento.value==""){
        alert("Ingrese su nombre");
        error(elemento);
        return false;
    }else{
        if((/^[A-Za-z\s-'\sáéíóúÁÉÍÓÚüÜñÑ]*$/).test(elemento.value)){
        }else{
          alert("No se permite ingresar numeros, solamente letras");
          error(elemento);
          return false;
        }
    }
    return true;
}

function validarapellido(){
    var elemento = document.getElementById("txtApellido");
    limpiarerror(elemento)
    if(elemento.value==""){
        alert("Ingrese su apellido");
        error(elemento);
        return false;
    }else{
        if((/^[A-Za-z\s-'\sáéíóúÁÉÍÓÚüÜñÑ]*$/).test(elemento.value)){
        }else{
          alert("No se permite ingresar numeros, solamente letras");
          error(elemento);
          return false;
        }
    }
    return true;
}

function validarcorreo(){
    var elemento = document.getElementById("txtCorreo");
    limpiarerror(elemento);
    if(elemento.value==""){
        alert("Ingrese su correo electronico");
        error(elemento);
        return false;
    }else{
        if((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(elemento.value)){
        }else{
          validado = false;
          alert("Correo tiene valores incorrectos");
          error(elemento);
          return false;
        }
    }
    return true;
}

function validartelefono(){
    var elemento = document.getElementById("txtCelular");
    limpiarerror(elemento)
    var count = elemento.value.length;
    if(elemento.value==""){
        alert("Ingrese su numero telefonico");
        error(elemento);
        return false;
    }else{
        if(isNaN(elemento.value)){
            alert("Solamente se aceptan numeros");
            error(elemento);
            return false;
        }else{
            if(count!=8){
                alert("Numero no puede ser diferente a 8 digitos")
                error(elemento);
                return false;
            }
        }
    }
    return true;
}

function validarmensaje(){
    var elemento = document.getElementById("txtMensaje");
    limpiarerror(elemento)
    if((/^\s*$/).test(elemento.value)){
        alert("Escriba su mensaje");
        error(elemento);
        return false;
    }
    return true;
}

function validar(e){
    if(validarnombre() && validarapellido() && validarcorreo() && validartelefono() && validarmensaje() && confirm("Pulse aceptar para enviar la informacion")){
        return true;
    }else{
        e.preventDefault();
        return false;
    }
}

function error(elemento){
    elemento.className += " error";
    elemento.focus();
}

function limpiarerror(elemento){
    elemento.classList.remove("error");
}

/*
var txtnombreD, txtapellidoD, txtcelularD, txtcorreoD, txtmensajeD, btnenviarD, focusTo=null;
window.onload = function(e){
    txtnombreD = document.getElementById('txtNombre');
    txtapellidoD = document.getElementById('txtApellido');
    txtcelularD = document.getElementById('txtCelular');
    txtcorreoD = document.getElementById('txtCorreo');
    txtmensajeD = document.getElementById('txtMensaje');
    btnenviarD = document.getElementById('btnEnviar');
    btnenviarD.addEventListener('click',function(e){
        e.preventDefault();
        e.stopPropagation();
        var txtNombreValue = txtnombreD.value;
        var txtApellidoValue= txtapellidoD.value;
        var txtcelularValue = txtcelularD.value;
        var txtCorreoValue = txtcorreoD.value;
        var txtMensajeValue = txtmensajeD.value;

        
        var validado = true;
        if((/^\s*$/).test(txtNombreValue)){
        validado = false;
        alert("El nombre es requerido");
        if(!focusTo){
            focusTo = txtNombreValue;
          }
          focusTo=focus();
        }

        if((/^[A-Za-z\s]*$/).test(txtNombreValue)){
        }else{
          validado = false;
          alert("Nombre tiene valores incorrectos");
        }
        


        if((/^\s*$/).test(txtApellidoValue)){
        validado = false;
        alert("El apellido es requerido");
        }

        if((/^[A-Za-z\s]*$/).test(txtApellidoValue)){
        }else{
          validado = false;
          alert("Apellido tiene valores incorrectos");
        }


        if((/^\s*$/).test(txtcelularValue)){
        validado = false;
        alert("El numero celular es requerido");
        }

        if((/^[0-9]*$/).test(txtcelularValue)){
        }else{
          validado = false;
          alert("Numero celular tiene valores incorrectos");
        }


        if((/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/).test(txtCorreoValue)){
        }else{
          validado = false;
          alert("Correo tiene valores incorrectos");
        }

        if((/^\s*$/).test(txtMensajeValue)){
            validado = false;
            alert("El mensaje es requerido");
            }
    
            
  
        if(validado){
            alert('Se ha agregado correctamente:' + txtNombreValue + ' , ' + txtApellidoValue + ' , ' + txtcelularValue + ' , ' + txtCorreoValue + ' , ' + txtMensajeValue);
            document.forms[0].submit();
        }else{
            alert("Errores en el ingreso de datos");
        }
        return false;

    });
}
*/
/*
$(function(){
    var txtnombre, txtapellido, txtnumero, txtcorreo, txtmensaje;
    $(".btnEnviar").on('click',function(){
        txtnombre= $(".nombre").val();
        txtapellido= $(".nombre").val();
        txtnumero= $(".nombre").val();
        txtcorreo= $(".nombre").val();
        txtmensaje= $(".nombre").val();
        console.log(txtnombre+txtapellido+txtnumero+txtcorreo+txtmensaje);
    });
});*/


