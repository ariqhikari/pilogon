$(document).ready(function () {
    $("#box-profile").hide();

    $("#img-profile").on("click", function () {
        $("#box-profile").toggle();
    });

    $("#img-mobile-profile").on("click", function () {
        $("#box-mobile-profile").toggle();
    });
});
