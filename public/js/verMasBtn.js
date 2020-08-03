//TODO: Optimiazr esto urgentemente.

var movimientosBtn = document.getElementById("Movimientos-btn");
var movimientoSubCard = document.querySelector(".movimientos-subCard");
var movimientosSvg = document.querySelector("#Movimientos-btn svg");
var movimientosSubcards = document.querySelectorAll(".movimientos-subCard a");

var eventosBtn = document.getElementById("Eventos-btn");
var eventosSubCard = document.querySelector(".eventos-subCard");
var eventosSvg = document.querySelector("#Eventos-btn svg");
var eventosSubCards = document.querySelectorAll(".eventos-subCard a");

var extensionesBtn = document.getElementById("Extensiones-btn");
var extensionesSubCard = document.querySelector(".extensiones-subCard");
var extensionessSvg = document.querySelector("#Extensiones-btn svg");
var extensionesSubCards = document.querySelectorAll(".extensiones-subCard a");

var isMovimientosActive = false;
var isEventosActive = false;
var isExtensionesActive = false;

movimientosBtn.addEventListener("click", function(e)  {
    e.preventDefault();
    e.stopPropagation();

    isMovimientosActive = toggleActive(movimientosBtn, movimientoSubCard, movimientosSvg, movimientosSubcards, isMovimientosActive);

});

eventosBtn.addEventListener("click", function(e) {
    e.preventDefault();
    e.stopPropagation();

    isEventosActive = toggleActive(eventosBtn, eventosSubCard, eventosSvg, eventosSubCards, isEventosActive);
})

extensionesBtn.addEventListener("click", function(e) {
    e.preventDefault();
    e.stopPropagation();

    isExtensionesActive = toggleActive(extensionesBtn, extensionesSubCard, extensionessSvg, extensionesSubCards, isExtensionesActive)
})

function toggleActive(btn, subCard, svg, subCardLinks, isActive) {
    if(isActive === false){
        var gap = 0
        //movimientoSubCard.style.display = "block";
        subCard.style.height = 'auto';
        subCardLinks.forEach((element) => {
            element.style.transition = "opacity 0.5s ease-in-out";
            element.style.transitionDelay = (0 + gap).toString() + "s";
            element.style.opacity = 1;
            gap += 0.25
        });
        btn.className += " ver-mas-btn";
        svg.style.display = "block";
        isActive = true;
    }
    else{
        isActive = false;
        //movimientoSubCard.style.display = "none";
        subCard.style.height = 0;
        subCardLinks.forEach((element) => {
            element.style.transition = "opacity 0s ease-in-out";
            element.style.transitionDelay = "0s";
            element.style.opacity = 0;
        });
        btn.classList.remove("ver-mas-btn");
        svg.style.display = "none";
    }

    return isActive;
}