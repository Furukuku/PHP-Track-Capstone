$(document).ready(function() {
    $.get("/my-products/categories", function(res) {
        $(".product_categories").html(res);
    });

    $.get("/my-products/list", function(res) {
        $("table#product_table").html(res);
    });

    $(document).on("click", ".form_categories", function(e) {
        $(this).submit();
    });

    $(document).on("submit", ".form_categories", function() {
        const formData = $(this).serialize() + '&' + $("#admin_form_search").serialize();
        $.get("my-products/paginate/1", formData, function(res) {
            $("#pagination_container").html(res);
        });

        $.get(`/products/admin-search/${$(this).children("input[name='category']").val()}/1`, $("#admin_form_search").serialize(), function(res) {
            $("table#product_table").html(res);
        });

        return false;
    });

    $(document).on("click", ".form_categories", function() {
        $(this).parent().siblings().removeClass("border-light");
        $(this).parent().addClass("border-light");
    });
});