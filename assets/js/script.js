document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-button').forEach(button => {
        button.addEventListener('click', function() {
            toggleDisplay(this.getAttribute('data-target'));
        });
    });
});

function toggleDisplay(targetClass) {
    var element = document.querySelector('.' + targetClass);
    if (element.classList.contains('none')) {
        element.classList.remove('none');
        element.classList.add('flex');
    } else {
        element.classList.remove('flex');
        element.classList.add('none');
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.card-slider-items');
    let isDragging = false, startPos = 0, currentTranslate = 0, prevTranslate = 0, animationID = 0, currentIndex = 0;

    slider.childNodes.forEach((child, index) => {
        if (child instanceof HTMLElement) {
            const slideImage = child;

            // Prevent default image drag
            slideImage.addEventListener('dragstart', (e) => e.preventDefault());

            // Touch events
            slideImage.addEventListener('touchstart', (e) => touchStart(index, e));
            slideImage.addEventListener('touchend', touchEnd);
            slideImage.addEventListener('touchmove', touchMove);

            // Mouse events
            slideImage.addEventListener('mousedown', (e) => touchStart(index, e));
            slideImage.addEventListener('mouseup', touchEnd);
            slideImage.addEventListener('mouseleave', touchEnd);
            slideImage.addEventListener('mousemove', touchMove);
        }
    });

    // Disable context menu on long press
    window.oncontextmenu = function (event) {
        event.preventDefault();
        event.stopPropagation();
        return false;
    };

    function touchStart(index, event) {
        currentIndex = index;
        startPos = getPositionX(event);
        isDragging = true;
        animationID = requestAnimationFrame(animation);
        slider.classList.add('grabbing');
    }

    function touchEnd() {
        cancelAnimationFrame(animationID);
        isDragging = false;
        const movedBy = currentTranslate - prevTranslate;
        if (movedBy < -100 && currentIndex < slider.childNodes.length - 1) currentIndex += 1;
        if (movedBy > 100 && currentIndex > 0) currentIndex -= 1;
        setPositionByIndex();
        slider.classList.remove('grabbing');
    }

    function touchMove(event) {
        if (isDragging) {
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
        }
    }

    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }

    function animation() {
        setSliderPosition();
        if (isDragging) requestAnimationFrame(animation);
    }

    function setSliderPosition() {
        slider.style.transform = `translateX(${currentTranslate}px)`;
    }

    function setPositionByIndex() {
        currentTranslate = currentIndex * -window.innerWidth;
        prevTranslate = currentTranslate;
        setSliderPosition();
    }
});
