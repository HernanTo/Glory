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


