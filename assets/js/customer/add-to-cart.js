$(document).on("click", "button#increment", function() {
    if ($(this).siblings("input").val() === "") {
        $(this).siblings("input").val(1);
    } else {
        let currValue = parseInt($(this).siblings("input").val());
        currValue++;
        $(this).siblings("input").val(currValue);
        const price = parseFloat($("#price").text());
        const totalPrice = price * currValue;
        $("#total_amount").text(parseFloat(totalPrice.toFixed(2)));
    }
});

$(document).on("click", "button#decrement", function() {
    if ($(this).siblings("input").val() === "") {
        $(this).siblings("input").val(1);
    } else {
        let currValue = parseInt($(this).siblings("input").val());
        currValue--;

        if (currValue < 1) {
            $(this).siblings("input").val(1);
        } else {
            $(this).siblings("input").val(currValue);
            const price = parseFloat($("#price").text());
            const totalPrice = price * currValue;
            $("#total_amount").text(parseFloat(totalPrice.toFixed(2)));
        }
    }
});

$(document).on("input", "input[name='quantity']", function() {
    if ($(this).val() === "") {
        $(this).val(1);
    } else {
        const quantity = Math.floor(parseInt($(this).val()));
        if (quantity < 1) {
            $(this).val(1);
        } else {
            $(this).val(quantity);
            const price = parseFloat($("#price").text());
            const totalPrice = price * quantity;
            $("#total_amount").text(parseFloat(totalPrice.toFixed(2)));
        }
    }
});

$(document).on("submit", "#add_to_cart", function() {
    $.post($(this).attr("action"), $(this).serialize(), function(res) {
        $("body").append(res.toast);
        $("#cart_count").text(res.cart);
        $("input[name='quantity']").val(1);
        const price = parseFloat($("#price").text());
        $("#total_amount").text(parseFloat(price.toFixed(2)));
    }, "json");

    return false;
});