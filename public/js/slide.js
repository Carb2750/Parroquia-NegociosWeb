var button = document.querySelector(".button-1");
var slide = document.querySelector(".slide");

var button2 = document.querySelector(".button-2");

button.addEventListener('click', ()=>{
  slide.classList.toggle('show');
});

button2.addEventListener('click', ()=>{
  slide.classList.remove('show');
});