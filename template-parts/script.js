document.addEventListener('DOMContentLoaded', function () {
    const slider = document.querySelector('.slider');
    const slides = Array.from(slider.children);
    const totalSlides = slides.length;
    let currentIndex = 0;

    // Function to set the initial active slides
    function setActiveSlides() {
        slides.forEach(slide => {
            slide.style.opacity = 0;
            slide.style.transform = 'translateX(100%)';
        });
        slides[currentIndex].style.opacity = 1;
        slides[currentIndex].style.scale = 1;
        slides[currentIndex].style.transform = 'translateX(0)';
        if (totalSlides > 1) {
            const nextIndex = (currentIndex + 1) % totalSlides;
            slides[nextIndex].style.opacity = 1;
            slides[nextIndex].style.scale = 0.95;
            slides[nextIndex].style.transform = 'translateX(195px)'; // Position for the second item
        }
        if (totalSlides > 2) {
            const nextNextIndex = (currentIndex + 2) % totalSlides;
            slides[nextNextIndex].style.opacity = 1;
            slides[nextNextIndex].style.scale = 0.9;
            slides[nextNextIndex].style.transform = 'translateX(400px)'; // Position for the third item
        }
    }

    // Move slides function
    function moveSlides(direction) {
        currentIndex += direction;
        if (currentIndex >= totalSlides) currentIndex = 0;
        if (currentIndex < 0) currentIndex = totalSlides - 1;
        setActiveSlides();
    }

    // Event listeners for buttons
    document.getElementById('next').addEventListener('click', function() {
        moveSlides(1);
    });

    document.getElementById('prev').addEventListener('click', function() {
        moveSlides(-1);
    });

    // Initialize the slider
    setActiveSlides();
});
