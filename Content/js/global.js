$(document).ready(function () {

    // POP UP

    $(".unshow").click(function(){
        $(".popup-form").hide();
    });
    $(".show").click(function(){
        $(".popup-form").show();
    });
    $.noConflict();
    $(".tab").DataTable();
});
