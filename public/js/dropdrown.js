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
    console.log(isActiveDrop);
});
