$(document).ready(function() {
    /**
     * Show the remove confirmation message in the delete modal and set the url for deleting
     */
    $(document).on("click", ".remove",function() {
        const productName = $(this).parent().siblings().children("span").text();
        const productId = $(this).parent().siblings(".product_id").text();
        $("#delete_product").html(`<p>Are you sure you want to remove item ${productName}?</p>`);
        $("#delete_product_btn").attr("href", `product/delete/${productId}`);
    });

    $(document).on("click", "#delete_product_btn", function() {
        $.get($(this).attr("href"), function(res) {
            $("#delete_product_modal").modal("hide");
            $("body").append(res);
            const categoryId = $("li.border-light").attr("id");
            $.get("/my-products/categories", function(res) {
                $(".categories").html(res);
                $(`#${categoryId}`).children().submit();
                $(`#${categoryId}`).siblings().removeClass("border-light");
                $(`#${categoryId}`).addClass("border-light");
            });
        }, "json");

        return false;
    });
});