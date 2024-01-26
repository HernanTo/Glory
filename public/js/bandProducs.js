document.addEventListener('DOMContentLoaded', function () {
    var divConsProducs = document.querySelectorAll('.slider__divs__products');
    divConsProducs.forEach(element=>{
        $(window).resize(function() {
            $(leftButton).addClass('btn__slides__hide');

            conCategories.scrollTo({
                left: 0,
                behavior: 'smooth'
            });
            $(rightButton).removeClass('btn__slides__hide');

        });
        const conCategories =  element.childNodes[5];
        const canCategories = (conCategories.childNodes.length - 1) / 2
        const leftButton =  element.childNodes[1];
        const rightButton =  element.childNodes[3];
        let currentScroll = 0;

        leftButton.addEventListener('click', function () {
            let categoryWidth = parseInt(conCategories.childNodes[1].clientWidth);
            currentScroll -= categoryWidth;
            if (currentScroll < 0) {
                currentScroll = 0;
            }
            conCategories.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
            if(currentScroll > 0){
                $(leftButton).removeClass('btn__slides__hide');
            }else if(currentScroll == 0){
                $(leftButton).addClass('btn__slides__hide');
            }
            let wdthCate = ((categoryWidth * canCategories));
            if(wdthCate <= (currentScroll + conCategories.clientWidth)){
                $(rightButton).addClass('btn__slides__hide');
            }else{
                $(rightButton).removeClass('btn__slides__hide');
            }
        });

        rightButton.addEventListener('click', function () {
            let categoryWidth = parseInt(conCategories.childNodes[5].clientWidth);
            currentScroll += categoryWidth;
            conCategories.scrollTo({
                left: currentScroll,
                behavior: 'smooth'
            });
            if(currentScroll > 0){
                $(leftButton).removeClass('btn__slides__hide');
            }else if(currentScroll == 0){
                $(leftButton).addClass('btn__slides__hide');
            }
            let wdthCate = ((categoryWidth * canCategories));
            if(wdthCate <= (currentScroll + conCategories.clientWidth)){
                $(rightButton).addClass('btn__slides__hide');
            }else{
                $(rightButton).removeClass('btn__slides__hide');
            }
        });
    });
});
