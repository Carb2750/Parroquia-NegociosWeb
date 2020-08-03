

document.addEventListener("DOMContentLoaded", function () {
    const hamburguer = document.querySelector(".hamburguer-button");
    const navLinks = document.querySelector(".nav-container-links");
    const links = document.querySelectorAll(".nav-container-links li"); 
    
    
    hamburguer.addEventListener("click", () => {
        navLinks.classList.toggle("open");
        console.log(links);
        links.forEach(link => {
            link.classList.toggle("fade");
        });
    }); 
})
