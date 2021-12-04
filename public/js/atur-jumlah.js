document.addEventListener("DOMContentLoaded", function () {
    $(".quantity-right-plus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the local input filed
        let inputElement = e.currentTarget.parentNode.parentNode.childNodes[3];
        let max = parseInt(inputElement.getAttribute("max"));
        let quantity = parseInt(inputElement.getAttribute("value"));

        // If is not undefined
        // Increment
        if (quantity < max) {
            inputElement.setAttribute("value", quantity+1);
        }
    });

    $(".quantity-left-minus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the local input filed
        let inputElement = e.currentTarget.parentNode.parentNode.childNodes[3];
        let min = parseInt(inputElement.getAttribute("min"));
        let quantity = parseInt(inputElement.getAttribute("value"));

        // If is not undefined
        // Decrement
        if (quantity > min) {
            inputElement.setAttribute("value", quantity-1);
        }
    });
});
