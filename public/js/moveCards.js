

var carousel = document.getElementsByClassName('card-carousel');
carousel = Array.from(carousel);
var position = [];
var totalWidth = [];


console.log("SIZE: " + carousel.length);

var totalMargin = Number.parseInt(window.getComputedStyle(carousel[0].children[0]).marginRight) + Number.parseInt(window.getComputedStyle(carousel[0].children[0]).marginLeft);

carousel.map(function(carouselItem, index) {
    console.log("asdsa");
    totalWidth.push(carouselItem.children[0].offsetWidth * carouselItem.children.length - carouselItem.offsetWidth);
    position.push(0);
    console.log(totalMargin);
    console.log(totalWidth[index]);
});

/*for (var i = 0; i < carousel.children.length; i++) {
    totalWidth += carousel.children[i].offsetWidth;
}*/

/*
*/

function moveLeft(index) { 
    /*var intervalID = setInterval(function(){
      carousel.scrollTo({left: position, behavior: 'smooth'});
      if (position > 0)
          position -= 30;
    }, 100);
  
    stopInterval(intervalID);*/

    if(position[index] > 0) {
        position[index] -= carousel[index].children[0].offsetWidth + totalMargin;
    }
    console.log(position[index]);

    carousel[index].scrollTo({
        left: position[index],
        behavior: "smooth"
    })
  }

  function moveRight(index) {
    /*var intervalID = setInterval(function(){
     carousel.scrollTo({left: position, behavior: 'smooth'});
     if (position < totalWidth)
         position += 30;
   }, 100);
 
   stopInterval(intervalID);*/

    if(position[index] < totalWidth[index]) {
        position[index] += carousel[index].children[0].offsetWidth + totalMargin;
    }
    console.log(position[index]);

    carousel[index].scrollTo({
        left: position[index],
        behavior: "smooth"
    })
 }

 function stopInterval(intervalID) {
    setTimeout(function() { clearInterval(intervalID); }, 1000);
 }