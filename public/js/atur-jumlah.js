document.addEventListener("DOMContentLoaded", function () {
    let max = $("#quantity").attr('max');
    let min = $("#quantity").attr('min');
    $(".quantity-right-plus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#quantity").val());

        // If is not undefined
        // Increment
        if (quantity < max) {
            $("#quantity").val(quantity + 1);
        }
    });

    $(".quantity-left-minus").click(function (e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#quantity").val());

        // If is not undefined
        // Decrement
        if (quantity > min) {
            $("#quantity").val(quantity - 1);
        }
    });
});
