const preloader = document.querySelector(".preloader");

window.addEventListener("load", () => {
    setTimeout(() => {
        preloader.style.display = "none";
    }, 2000);
    preloader.classList.add("fade-out");    
});




