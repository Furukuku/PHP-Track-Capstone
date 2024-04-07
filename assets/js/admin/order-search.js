$(document).on("input", "#admin_search", function() {
    const category = $("li.border-light").children("span.order_status_category").text();
    // const current_page = parseInt($(".current_page").text());
    const searchData = `offset=1&${$(this).parent().serialize()}`;
    // console.log(current_page);
    $.get(`/order/search/${category}`, searchData, function(res) {
        $("table.order_table").html(res);
    });
});