$(document).on("input", "#customer_search", function() {
    $(this).submit();
});

$(document).on("submit", "#customer_form_search", function() {
    const formData = `id=${$("input[name='product_id']").val()}&${$(this).serialize()}`;
    $.get("/products/similar-search", formData, function(res) {
        $("#similar_products_container").html(res);
    });

    return false;
});