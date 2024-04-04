$(document).ready(function() {
    $(document).on("input", "#admin_search", function() {
        $(this).submit();
    });

    $(document).on("submit", "#admin_form_search", function() {
        const currentCategory = $("li.border-light").children().children("input[name='category']").val();
        $.get(`/products/admin-search/${currentCategory}/1`, $(this).serialize(), function(res) {
            $("table").html(res);
        });

        $.get("my-products/paginate/1", $(this).serialize(), function(res) {
            $("#pagination_container").html(res);
        });
    });
});