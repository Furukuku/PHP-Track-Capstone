$(document).ready(function() {
    $.get("/my-products/categories", function(res) {
        $(".categories").html(res);
    });

    $.get("/my-products/list", function(res) {
        $("table").html(res);
    });

    $(document).on("click", ".form_categories", function() {
        $(this).submit();
    });

    $(document).on("submit", ".form_categories", function() {
        // $.get($(this).attr("action"), $(this).serialize(), function(res) {
        //     $("table").html(res);
        // });
        $.get(`/products/admin-search/${$(this).children("input[name='category']").val()}`, $("#admin_form_search").serialize(), function(res) {
            $("table").html(res);
        });

        return false;
    });

    $(document).on("click", ".form_categories", function() {
        $(this).parent().siblings().removeClass("border-light");
        $(this).parent().addClass("border-light");
    });
});