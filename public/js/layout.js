function formatCurrency(number) {
    if (isNaN(number)) {
      return "Invalid number";
    }
    let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
    formattedNumber = `$${formattedNumber}`;

    return formattedNumber;
}
function showToast(bodyToast){
    $('#toast__general').toast('show');
    $('#toast__body').empty();
    document.getElementById('toast__body').appendChild(bodyToast);
}
if(document.getElementById('user__nav')){
    var dropDown = document.getElementById('user__nav');
    var triggerUser = document.getElementById('con__user_nav');
    var isActiveDrop = false;

    triggerUser.addEventListener('click', event => {
        if(!isActiveDrop){
            $(dropDown).removeClass('user__nav__hide')
            $(dropDown).addClass('user__nav__show')
        }else{
            $(dropDown).removeClass('user__nav__show')
            $(dropDown).addClass('user__nav__hide')
        }
        isActiveDrop = !isActiveDrop;
    });
}
