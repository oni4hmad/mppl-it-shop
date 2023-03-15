document.addEventListener("DOMContentLoaded", function () {
    $(".quantity-right-plus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the local input filed
        let inputElement = e.currentTarget.parentNode.parentNode.childNodes[3];
        let max = parseInt(inputElement.max);
        let quantity = parseInt(inputElement.value);

        console.log('max', max, 'qty', quantity);
        // If is not undefined
        // Increment
        if (quantity < max) {
            inputElement.value = quantity+1;
            inputElement.onchange();
        }
    });

    $(".quantity-left-minus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the local input filed
        let inputElement = e.currentTarget.parentNode.parentNode.childNodes[3];
        let min = parseInt(inputElement.min);
        let quantity = parseInt(inputElement.value);

        console.log('min', min, 'qty', quantity);
        // If is not undefined
        // Decrement
        if (quantity > min) {
            inputElement.value = quantity-1;
            inputElement.onchange();
        }
    });
});
