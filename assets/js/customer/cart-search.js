$(document).on("input", "#customer_search", function() {
    $(this).submit();
});

$(document).on("submit", "#customer_form_search", function() {
    $.get("/cart/search", $(this).serialize(), function(res) {
        $("#item_list_container").html(res);
    });

    return false;
});