$(document).ready(function() {
    /**
     * loads the form for adding product
     */
    $.get("forms/add-product", function(res) {
        $("#add_product").html(res);
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
    $(document).on("change", "#images", function() {
        const files = this.files;
        $("#uploaded_img_container").empty();

        if (files.length > 0) {
            $("#uploaded_img_container").parent().removeClass("d-none");
            console.log(files);
        } else {
            $("#uploaded_img_container").parent().addClass("d-none");
        }

        if (files.length > 10) {
            alert("You can only upload 5 images");
            $("#images").val("");
            $("#uploaded_img_container").parent().addClass("d-none");
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            if (file.type.match('image.*')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#uploaded_img_container").append(
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
        $("#default_img").attr("value", $(this).attr("id"));
    });

    /**
     * Submits the form
     */
    $(document).on("click", "#save_product_btn", function() {
        $("#create_product_form").submit();
    });

    $(document).on("submit", "#create_product_form", function() {
        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function(res) {
                $("#add_product").html(res);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

        return false;
    });

    /**
     * Removes the error messages when the modal is closed
     */
    $(document).on("hidden.bs.modal", "#add_product_modal", function() {
        $(".error").remove();
    });
});