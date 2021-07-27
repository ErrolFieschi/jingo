$(document).ready(function () {

    // --------------------------------------- Afficher/cacher POP UP

    $(".unshow").click(function(){
        $(".popup-form").hide();
    });
    $(".show").click(function(){
        $(".popup-form").show();
    });

    // --------------------------------------- DataTable
    $.noConflict();
    $(".tab").DataTable();

    // --------------------------------------- Affichage du titre des chapitres
    $(".chap-title").hide();
    $(".chap-link").mouseover(function(){
        $(".chap-title").show();
    });

});
