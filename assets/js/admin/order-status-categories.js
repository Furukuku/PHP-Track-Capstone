$.get("/order/category-filter", function(res) {
    $("table.order_table").html(res);
});

$.get("/order/category-list", function(res) {
    $("ul.order_categories").html(res);
});

$(document).on("click", "li.order_status", function() {
    const status = $(this).children("span.order_status_category").text();
    // $.get(`/order/category-filter?status=${status}`, function(res) {
    //     $("table.order_table").html(res);
    // });

    // const category = $("li.border-light").children("span.order_status_category").text();
    const searchData = `offset=1&${$("#admin_form_search").serialize()}`;
    $.get(`/order/search/${status}`, searchData, function(res) {
        $("table.order_table").html(res);
    });

    // $.get("orders/paginate/1", function(res) {
    //     $("#pagination_container").html(res);
    // });
    const formData = `status=${status}` + '&' + $("#admin_form_search").serialize();
    $.get("orders/paginate/1", formData, function(res) {
        $("#pagination_container").html(res);
    });

    $(this).siblings("li").removeClass("border-light");
    $(this).addClass("border-light");
});

$(document).on("change", ".select_status", function() {
    $(this).parent().submit();
});

$(document).on("submit", "form.update_status_form", function() {
    const status = $("li.border-light").children("span.order_status_category").text();
    const statusId = $("li.border-light").attr("id");

    $.post($(this).attr("action"), $(this).serialize(), function(res) {
        $("body").append(res);
        // $.get(`/order/category-filter?status=${status}`, function(res) {
        //     $("table.order_table").html(res);
        // });
        const searchData = `offset=1&${$("#admin_form_search").serialize()}`;
        $.get(`/order/search/${status}`, searchData, function(res) {
            $("table.order_table").html(res);
        });

        const formData = `status=${$("li.border-light").children("span.order_status_category").text()}` + '&' + $("#admin_form_search").serialize();
        $.get("orders/paginate/1", formData, function(res) {
            $("#pagination_container").html(res);
        });

        $.get("/order/category-list", function(res) {
            $("ul.order_categories").html(res);
            $(`li#${statusId}`).siblings("li").removeClass("border-light");
            $(`li#${statusId}`).addClass("border-light");
        });
    }, "json");

    return false;
});