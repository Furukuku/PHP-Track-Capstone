$(document).ready(function() {
    $("#images").change(uploadImages);

    $("#drag_area").on("dragover", function(e) {
        e.preventDefault();
    });

    $("#drag_area").on("drop", function(e) {
        e.preventDefault();
        $("#images").val("");
        $("#uploaded_img_container").empty();
        $("#images").prop("files", e.originalEvent.dataTransfer.files);
        
        const files = $("#images").prop("files");

        if (files.length > 5) {
            alert("You can only upload 5 images");
            $("#images").val("");
            return;
        }

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            if (file.type.match('image.*')) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#uploaded_img_container").append(
                    `<label for="image${i}">
                    <img src="${e.target.result}" class="rounded" alt="product">
                    </label>
                    <input type="radio" name="default_img" id="image${i}" hidden>`
                );
            }
            reader.readAsDataURL(file);
            }
        }
    });

    $(document).on("input", "input[type='radio']", function() {
        $(this).siblings("input[type='radio']").removeAttr("checked");
        $(this).siblings("label").children("img").removeClass("border border-3 border-info");
        $(this).siblings(`label[for="${$(this).attr("id")}"]`).children("img").addClass("border border-3 border-info");
        $(this).attr("checked", true);
        console.log($(this).val());
    });
});

function uploadImages() {
    const files = this.files;

    if (files.length > 5) {
        alert("You can only upload 5 images");
        $("#images").val("");
        return;
    }

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (file.type.match('image.*')) {
          let reader = new FileReader();
          reader.onload = function(e) {
            $("#uploaded_img_container").append(
                `<label for="image${i}">
                <img src="${e.target.result}" class="rounded" alt="product">
                </label>
                <input type="radio" name="default_img" id="image${i}" hidden>`
            );
          }
          reader.readAsDataURL(file);
        }
    }
}