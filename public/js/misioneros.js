var formulario = document.getElementById("formulario2");

window.onload = iniciar;

function iniciar(){
    document.getElementById("btnEnviar").addEventListener('click', validar,false);
}

function validarnombre(){
    var elemento = document.getElementById("txtNombre");
    limpiarerror(elemento)
    if(elemento.value==""){
        alert("Ingrese su nombre completo");
        error(elemento);
        return false;
    }else{
        if((/^[A-Za-z\s]*$/).test(elemento.value)){
        }else{
          alert("No se permite ingresar numeros, solamente letras");
          error(elemento);
          return false;
        }
    }
    return true;
}

function validarmadre(){
    var elemento = document.getElementById("txtmadre");
    limpiarerror(elemento)
    if(elemento.value==""){
        alert("Ingrese nombre completo de su madre");
        error(elemento);
        return false;
    }else{
        if((/^[A-Za-z\s]*$/).test(elemento.value)){
        }else{
          alert("No se permite ingresar numeros, solamente letras");
          error(elemento);
          return false;
        }
    }
    return true;
}

function validarpadre(){
    var elemento = document.getElementById("txtpadre");
    limpiarerror(elemento)
    if(elemento.value==""){
        alert("Ingrese nombre completo de su padre");
        error(elemento);
        return false;
    }else{
        if((/^[A-Za-z\s]*$/).test(elemento.value)){
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

function validaredad(){
    var elemento = document.getElementById("txtedad");
    limpiarerror(elemento)
    var count = elemento.value.length;
    if(elemento.value==""){
        alert("Ingrese su edad");
        error(elemento);
        return false;
    }else{
        if(isNaN(elemento.value)){
            alert("Solamente se aceptan numeros");
            error(elemento);
            return false;
        }else{
            if(elemento.value<18){
                alert("Lo sentimos, al ser usted menor de 18 años no es apto para aplicar")
                error(elemento);
                return false;
            }else{
                if(elemento.value>100){
                    alert("Ingrese una edad valida")
                    error(elemento);
                    return false;
                }
            }
        }
    }
    return true;
}

function validaraños(){
    var elemento = document.getElementById("txtaños");
    limpiarerror(elemento)
    if((/^\s*$/).test(elemento.value)){
        alert("Ingrese la cantidad de años que lleva caminando en la iglesia");
        error(elemento);
        return false;
    }
    return true;
}

function validar(e){
    if(validarnombre() && validarmadre() && validarpadre() && validarcorreo() && validaredad() && validaraños() && confirm("Pulse aceptar para enviar la informacion")){
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
