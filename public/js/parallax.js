

document.addEventListener("DOMContentLoaded", function () {
    var books = document.querySelectorAll(".cloud-1");
    var isBookNone = (window.getComputedStyle(books[0]).display !== "none") ? true : false;
    console.log(isBookNone);
    if(isBookNone){
        var index = 0;
        var startPosition = [];
        books.forEach(book => {
            startPosition.push(books[index].getClientRects()[0].left);
            index++;
        });
        console.log(books);
        console.log(startPosition)
        var speed = [60, 80, 30, 20];
        window.addEventListener("scroll", function () {
            var newPos = [0, 0, 0, 0];
            var index2 = 0;
            scrollTop = window.scrollY;
            startPosition.forEach(position => {
                newPos[index2] = (scrollTop * (speed[index2]/100)) + position;
                books[index2].style.left = newPos[index2] + "px";
                index2++;
            })
        });
    }
});