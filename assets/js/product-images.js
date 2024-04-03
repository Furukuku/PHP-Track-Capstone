$(document).ready(function() {
    $(".sub_image").click(function() {
        $(this).parent().siblings().children().removeClass("border border-2 border-info");
        $(this).addClass("border border-2 border-info");
        $("#default_img").attr("src", $(this).attr("src"));
    });
});