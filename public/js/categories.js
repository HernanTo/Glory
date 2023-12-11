document.addEventListener('DOMContentLoaded', function () {
    const conCategories = document.querySelector('.con__categories');
    const leftButton = document.getElementById('leftButtonC');
    const rightButton = document.getElementById('rightButtonC');

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
});
