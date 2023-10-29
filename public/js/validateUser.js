var inptsRequired = ['cc', 'ft_name', 'phone', 'role'];

inptsRequired.forEach(element => {
    document.getElementById(element).addEventListener('change', () =>{
        if(document.getElementById(element).value == ''){
            $(`#${element}`).addClass('is-invalid');
        }else{
            $(`#${element}`).removeClass('is-invalid');
        }
    })
});

document.getElementById('subm_user').addEventListener('click', () => {
    let stateValidation = true;
    inptsRequired.forEach(element => {
        if(document.getElementById(element).value == ''){
            $(`#${element}`).addClass('is-invalid');
            stateValidation = false;
        }else{
            $(`#${element}`).removeClass('is-invalid');
        }
    })

    if(stateValidation){
        document.getElementById('form__add__user').submit();
    }
});
