$(document).on("input", "#same_billing", function() {
    if ($(this).is(":checked")) {
        $("#billing_form").addClass("d-none");
    } else {
        $("#billing_form").removeClass("d-none");
    }
});

$(document).on("click", "#checkout_btn", function() {
    let formData = $("#shipping_form").serialize();

    if (!$("#billing_form").hasClass("d-none")) {
        formData = formData + "&" + $("#billing_form").serialize();
    }

    $.post("/cart/checkout", formData, function(res) {
        if (res.status === "success") {
            window.location.href = res.url;
        } else if (res.status === "error") {
            $("#order_info_container").html(res.html);
        } else if (res.status === "invalid") {
            $("body").append(res.toast);
        }
        
        if ($("#same_billing").is(":checked")) {
            $("#billing_form").addClass("d-none");
        } else {
            $("#billing_form").removeClass("d-none");
        }
    }, "json");
});