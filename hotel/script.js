// JavaScript para controlar el slider de imágenes
document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".slide");
    let currentIndex = 0;

    // Función para mostrar la siguiente imagen en el slider
    function showNextSlide() {
        slides[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].classList.add("active");
    }

    // Cambia la imagen cada 5 segundos (5000 milisegundos)
    setInterval(showNextSlide, 5000);
});
    // Muestra la primera imagen al cargar la página
    showSlide(currentSlide);

    const menuButton = document.getElementById("menu-button");
    const menu = document.querySelector(".menu");

    menu.style.display = "none";

    menuButton.addEventListener("click", function () {
        if (menu.style.display === "block") {
            menu.style.display = "none";
        } else {
            menu.style.display = "block";
        }
    });

