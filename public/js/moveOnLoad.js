

if(window.scrollY === 0){
    setTimeout(() => {
        window.scrollTo({
            top: 100,
            behavior: "smooth"
        });
    }, 1500);
}