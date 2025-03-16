document.addEventListener("DOMContentLoaded", () => {
    let slides = document.querySelectorAll(".slide");
    let currentIndex = 0;

    document.querySelector(".next").addEventListener("click", () => {
        changeSlide(1);
    });

    document.querySelector(".prev").addEventListener("click", () => {
        changeSlide(-1);
    });

    function changeSlide(direction) {
        slides[currentIndex].classList.remove("active");
        currentIndex = (currentIndex + direction + slides.length) % slides.length;
        slides[currentIndex].classList.add("active");
    }
});

fetch('auth.php')
.then(response => response.json())
.then(data => {
    if (data.logged_in) {
        document.getElementById('auth-links').innerHTML = '<li><a href="logout.php">Вийти</a></li>';
    }
});