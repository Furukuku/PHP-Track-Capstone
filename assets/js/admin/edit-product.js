$(document).ready(function() {
    /**
     * loads the form for adding product
     */

    $(document).on("click", ".edit_product_btn", function() {
        const productId = $(this).parent().siblings(".product_id").text();
        $.get(`/forms/edit-product/${productId}`, function(res) {
            $("#edit_product").html(res);
            $(".error").remove();
        });
    });

    /**
     * Checks if the price and inventory is valid
     */
    $(document).on("input", "#price, #inventory", function() {
        const value = parseInt($(this).val());

        if (value < 1) {
            $(this).val(1);
        }
    });

    /**
     * Handles the uploading of 5 images
     */
    $(document).on("change", "#edit_images", function() {
        const files = this.files;
        $("#edit_uploaded_img_container").empty();

        if (files.length > 0) {
            $("#edit_uploaded_img_container").parent().removeClass("d-none");
        } else {
            $("#edit_uploaded_img_container").parent().addClass("d-none");
        }

        if (files.length > 5) {
            alert("You can only upload 5 images");
            $("#edit_images").val("");
            $("#edit_uploaded_img_container").parent().addClass("d-none");
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            if (file.type.match('image.*')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#edit_uploaded_img_container").append(
                        `<img src="${e.target.result}" id="${files[i].name}" class="rounded uploaded_imgs" alt="product">`
                    );
                }
                reader.readAsDataURL(file);
            }
        }
    });

    /**
     * Adds border to the selected default image and set it to the value of the default image input
     */
    $(document).on("click", ".uploaded_imgs", function() {
        $(this).siblings().removeClass("border border-3 border-info");
        $(this).addClass("border border-3 border-info");
        $("#edit_default_img").attr("value", $(this).attr("id"));
    });

    /**
     * Submits the form
     */
    $(document).on("click", "#save_product_btn", function() {
        $("#edit_product_form").submit();
    });

    $(document).on("submit", "#edit_product_form", function() {
        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData, 
            processData: false, 
            contentType: false, 
            dataType: "json",
            success: function(res) {
                if (res.status == "success") {
                    $("#edit_product_modal").modal("hide");
                    $("body").append(res.html);
                    $("li.border-light").children().submit();
                } else {
                    $("#edit_product").html(res.html);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        return false;
    });

    /**
     * Removes the error messages and values of the inputs when the modal is closed
     */
    $(document).on("hidden.bs.modal", "#edit_product_modal", function() {
        $(".error").remove();
        $("#edit_product").empty();
    });
});