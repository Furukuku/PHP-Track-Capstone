$.get("products/paginate/1", function(res) {
    $("#pagination_container").html(res);
});

$(document).on("click", "a.page-link", function() {
    const currentCategory = $("li.border-info").children().children("input[name='category']").val();
    $.get(`/products/customer-search/${currentCategory}/${$(this).text()}`, $("#customer_form_search").serialize(), function(res) {
        $("#product_container").html(res);
    });
    
    const formData = $("li.border-info").children("form").serialize() + '&' + $("#customer_form_search").serialize();
    $.get($(this).attr("href"), formData, function(res) {
        $("#pagination_container").html(res);
    });

    return false;
});