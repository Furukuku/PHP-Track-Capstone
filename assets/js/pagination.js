$(document).ready(function() {
    $.get("my-products/paginate/1", function(res) {
        $("#pagination_container").html(res);
    });

    $(document).on("click", "a.page-link", function() {
        const currentCategory = $("li.border-light").children().children("input[name='category']").val();
        $.get(`/products/admin-search/${currentCategory}/${$(this).text()}`, $("#admin_form_search").serialize(), function(res) {
            $("table").html(res);
        });
        
        $.get($(this).attr("href"), function(res) {
            $("#pagination_container").html(res);
        });

        return false;
    });
});