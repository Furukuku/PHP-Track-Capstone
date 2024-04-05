$.get("/product/categories", function(res) {
    $(".categories").html(res);
});

$.get("/products/list", function(res) {
    $("#product_container").html(res);
});

$(document).on("click", ".form_categories", function() {
    $(this).submit();
});

$(document).on("submit", ".form_categories", function() {
    const formData = $(this).serialize() + '&' + $("#customer_form_search").serialize();
    $.get("products/paginate/1", formData, function(res) {
        $("#pagination_container").html(res);
    });

    $.get(`/products/customer-search/${$(this).children("input[name='category']").val()}/1`, $("#customer_form_search").serialize(), function(res) {
        $("#product_container").html(res);
    });

    return false;
});

$(document).on("click", ".form_categories", function() {
    $(this).parent().siblings().removeClass("border-info");
    $(this).parent().addClass("border-info");
});