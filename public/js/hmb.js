var hamburger = document.querySelector(".burger");
var navLinks = document.querySelector(".nav-links");

hamburger.addEventListener('click',()=>{
  navLinks.classList.toggle('open');
});

