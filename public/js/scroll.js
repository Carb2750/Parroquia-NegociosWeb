var menuBar = document.getElementById("menu-barra");
var hmb = document.getElementById("hmb");
// Get the offset position of the navbar
var sticky = menuBar.offsetTop;

window.onscroll = function() {pegarMenuBarra()};

function pegarMenuBarra() {
  if (window.pageYOffset > sticky) {
    menuBar.classList.add("sticky");
    hmb.className = "hmb-sticky";
  } else {
    menuBar.classList.remove("sticky");
    hmb.className = "burger";
  }
}