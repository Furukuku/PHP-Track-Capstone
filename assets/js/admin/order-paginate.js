$.get("orders/paginate/1", function(res) {
    $("#pagination_container").html(res);
});

$(document).on("click", "a.page-link", function() {
    const category = $("li.border-light").children("span.order_status_category").text();
    const searchData = `offset=${$(this).text()}&${$("#admin_form_search").serialize()}`;
    $.get(`/order/search/${category}`, searchData, function(res) {
        $("table.order_table").html(res);
    });
    
    const formData = `status=${$("li.border-light").children("span.order_status_category").text()}` + '&' + $("#admin_form_search").serialize();
    $.get($(this).attr("href"), formData, function(res) {
        $("#pagination_container").html(res);
    });

    return false;
});