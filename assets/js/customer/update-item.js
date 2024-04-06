$.get("/cart/list", function(res) {
    $("#item_list_container").html(res);
});

$(document).on("click", "button.increment", function() {
    const key = $(this).data("key");

    if ($(this).siblings("input").val() === "") {
        $(this).siblings("input").val(1);
    } else {
        let currValue = parseInt($(this).siblings("input").val());
        currValue++;
        $(this).siblings("input").val(currValue);
        const price = parseFloat($(`#price${key}`).text());
        const totalPrice = price * currValue;
        $(`#total_amount${key}`).text(parseFloat(totalPrice.toFixed(2)));
    }

    $(this).closest("form").submit();
});

$(document).on("click", "button.decrement", function() {
    const key = $(this).data("key");

    if ($(this).siblings("input").val() === "") {
        $(this).siblings("input").val(1);
    } else {
        let currValue = parseInt($(this).siblings("input").val());
        currValue--;

        if (currValue < 1) {
            $(this).siblings("input").val(1);
        } else {
            $(this).siblings("input").val(currValue);
            const price = parseFloat($(`#price${key}`).text());
            const totalPrice = price * currValue;
            $(`#total_amount${key}`).text(parseFloat(totalPrice.toFixed(2)));
        }
    }

    $(this).closest("form").submit();
});

$(document).on("input", "input[name='quantity']", function() {
    const key = $(this).data("key");

    if ($(this).val() === "") {
        $(this).val(1);
    } else {
        const quantity = Math.floor(parseInt($(this).val()));
        if (quantity < 1) {
            $(this).val(1);
        } else {
            $(this).val(quantity);
            const price = parseFloat($(`#price${key}`).text());
            const totalPrice = price * quantity;
            $(`#total_amount${key}`).text(parseFloat(totalPrice.toFixed(2)));
        }
    }

    $(this).closest("form").submit();
});

$(document).on("submit", ".cart_item_update_form", function() {
    $.post($(this).attr("action"), $(this).serialize(), function(res) {
        $("#total_amount").text("$ " + res.total_amount);
        $("#shipping_fee").text("$ " + res.shipping_fee);
        $("#to_pay").text("$ " + res.to_pay);
    }, "json");

    return false;
});

$(document).on("click", "#remove_item_btn", function() {
    $("#remove_form").submit();
});

$(document).on("click", ".remove_to_cart", function() {
    const itemId = $(this).siblings("form").children("input[name='item_id']").val();
    $("#remove_form").children("input[name='item_id']").val(itemId);
    const itemName = $(this).data("name");
    console.log(itemName);
    $("#remove_form").append(`<p>Are you sure you want to remove "${itemName}" from your cart?</p>`);
});

$(document).on("submit", "#remove_form", function() {
    $.post($(this).attr("action"), $(this).serialize(), function(res) {
        $("body").append(res.toast);
        $("#item_list_container").html(res.html);
        $("#cart_count").text(res.cart);
        $("#remove_item_modal").modal("hide");
        $("#total_amount").text("$ " + res.checkout.total_amount);
        $("#shipping_fee").text("$ " + res.checkout.shipping_fee);
        $("#to_pay").text("$ " + res.checkout.to_pay);
    }, "json");

    return false;
});

$("#remove_item_modal").on("hidden.bs.modal", function() {
    $("#remove_form").children("input[name='item_id']").removeAttr("value");
    $("#remove_form").children("p").remove();
});