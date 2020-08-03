
document.addEventListener("DOMContentLoaded", function () {
  showSlides();
})

var slideIndex = 0;

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("carousel-frame");
  var dots = document.getElementsByClassName("frame-dot");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active-frame-dot", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active-frame-dot";
  setTimeout(showSlides, 3000);
}