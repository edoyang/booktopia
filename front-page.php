<?php get_header(); ?>

<section class="hero">
    <div class="left">
        <div class="book-detail">
            <h1 class="book-title"></h1>
            <p class="book-description"></p>
        </div>
        <button class="btn-primary"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cart.svg" alt="cart"> Add to Cart</button>
    </div>

    <div class="right">
        <div class="slider">
            <!-- Slider items will be inserted by JavaScript -->
        </div>
        <button id="prev"></button>
        <button id="next"></button>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const products = <?php echo json_encode(get_products_data()); ?>;
    const slider = document.querySelector('.slider');
    const bookTitle = document.querySelector('.book-title');
    const bookDescription = document.querySelector('.book-description');

    // Initialize slider with all images from products
    products.forEach((product, index) => {
        product.images.forEach((image, imageIndex) => {
            const sliderItem = document.createElement('div');
            sliderItem.className = 'slider-item';
            sliderItem.innerHTML = `<img draggable="false" src="${image}" alt="${product.title} ${imageIndex + 1}">`;
            slider.appendChild(sliderItem);
        });
    });

    let currentIndex = 0;
    const slides = Array.from(slider.children);
    const totalSlides = slides.length;

    function updateProductDetails() {
        const productIndex = Math.floor(currentIndex / products[0].images.length); // Adjust based on images per product
        bookTitle.textContent = products[productIndex].title;
        bookDescription.innerHTML = products[productIndex].description;
    }

    function setActiveSlides() {
        slides.forEach((slide, index) => {
            slide.style.opacity = 0;
            slide.style.transform = 'translateX(660px)';
            slide.style.scale = 0.9;
        });

        slides[currentIndex].style.opacity = 1;
        slides[currentIndex].style.scale = 1;
        slides[currentIndex].style.transform = 'translateX(0)';

        if (totalSlides > 1) {
            const nextIndex = (currentIndex + 1) % totalSlides;
            slides[nextIndex].style.opacity = 1;
            slides[nextIndex].style.scale = 0.95;
            slides[nextIndex].style.transform = 'translateX(215px)'; // Position for the second item
        }

        if (totalSlides > 2) {
            const nextNextIndex = (currentIndex + 2) % totalSlides;
            slides[nextNextIndex].style.opacity = 1;
            slides[nextNextIndex].style.scale = 0.9;
            slides[nextNextIndex].style.transform = 'translateX(445px)'; // Position for the third item
        }

        updateProductDetails();
    }

    function moveSlides(direction) {
        currentIndex += direction;
        if (currentIndex >= totalSlides) currentIndex = 0;
        if (currentIndex < 0) currentIndex = totalSlides - 1;
        setActiveSlides();
    }

    document.getElementById('next').addEventListener('click', function() {
        moveSlides(1);
    });

    document.getElementById('prev').addEventListener('click', function() {
        moveSlides(-1);
    });

    setActiveSlides();
});
</script>

<?php get_footer(); ?>
