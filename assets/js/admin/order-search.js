$(document).on("input", "#admin_search", function() {
    const category = $("li.border-light").children("span.order_status_category").text();
    const searchData = `offset=1&${$(this).parent().serialize()}`;
    $.get(`/order/search/${category}`, searchData, function(res) {
        $("table.order_table").html(res);
    });
});