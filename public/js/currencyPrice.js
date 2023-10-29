function formatPrice(input) {
    let value = input.value;
    value = value.replace(/[^0-9.]/g, '');
    let parts = value.split('.');
    let integerPart = parts[0];
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = integerPart;
}

let inputs = $("input[data-type='currency']");

for (let i = 0; i < inputs.length; i++) {
    formatPrice(inputs[i]);
}

for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener('input', () => {
        formatPrice(inputs[i])
    });
}
