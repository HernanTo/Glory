document.addEventListener('DOMContentLoaded', function () {
    let ideProducts = 0;
    var divConsProducs = document.querySelectorAll('.slider__divs__products');
    divConsProducs.forEach(element=>{

        const conCategories =  element.children[1];
        const leftButton =  element.children[0];
        const rightButton =  element.children[2];
        const categoryWidth = 220; // Ancho de cada categoría
        let currentScroll = 0;

        leftButton.addEventListener('click', function () {
            currentScroll -= categoryWidth;
            if (currentScroll < 0) {
                currentScroll = 0;
            }
            conCategories.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
        });

        rightButton.addEventListener('click', function () {
            currentScroll += categoryWidth;
            conCategories.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
        });

        ideProducts = ideProducts + 1;
    });
});
