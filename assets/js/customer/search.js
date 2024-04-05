$(document).on("input", "#customer_search", function() {
    $(this).submit();
});

$(document).on("submit", "#customer_form_search", function() {
    const currentCategory = $("li.border-info").children().children("input[name='category']").val();
    $.get(`/products/customer-search/${currentCategory}/1`, $(this).serialize(), function(res) {
        $("#product_container").html(res);
    });

    const formData = $(this).serialize() + '&' + $("li.border-info").children("form").serialize();
    $.get("products/paginate/1", formData, function(res) {
        $("#pagination_container").html(res);
    });

    return false;
});