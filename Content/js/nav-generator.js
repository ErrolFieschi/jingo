$(document).ready(function () {


    // génération des links form
    function addLink() {
        var inc = getIncrementor();
        var add_link = $("#render_nav_link").children().clone();
        $("#place-point").before("<section class='rend_nav_l' id='render_nav_link_" + inc + "'></section>");
        $("#render_nav_link_" + inc).append(add_link);
        setIncrementor(inc + 1);
    }

    //génération des dropdown form
    function addGroup() {
        var inc = getIncrementor();
        var add_link = $("#render_nav_group").children().clone();
        $("#place-point").before("<section class='rend_nav_g' id='render_nav_group_" + inc + "'></section>");
        $("#render_nav_group_" + inc).append(add_link);
        setIncrementor(inc + 1);
    }

    function addLinkGroup() {
        if ($(event.target).hasClass("add_link_group")) {
            var cloner = $("#render_nav_link").find(".link_reference").clone(); // cloner ok
            $(event.target).parent().parent().before(cloner);
        }
    }

    function addToNav() {
        if ($(event.target).hasClass("fa-check") && $("#" + findSectionParent()).hasClass('rend_nav_g')) {
            var lb_gp_nav = $("#" + findSectionParent()).find(".label_gp_nav").val();
            if (lb_gp_nav == '') {
                alert("Vous ne pouvez pas valider avec un libellé de groupe vide");
            } else if ($("#" + findSectionParent() + "_nav").hasClass('dropdown') == false) {//vérifie si les liens existent
                html = '<div class="dropdown" id="' + findSectionParent() + '_nav">';
                html += '<button class="dropbtn">' + lb_gp_nav;
                html += '<i class="fa fa-caret-down"></i>';
                html += '</button>';
                html += '<div class="dropdown-content">';
                html += '<a href="#">Link 1</a>';
                html += '<a href="#">Link 2</a>';
                html += '<a href="#">Link 3</a>';
                html += '</div>';
                html += '</div>';
                $("#placement_nav").before(html);
            } else {
                $("#" + findSectionParent() + "_nav").remove();
                html = '<div class="dropdown" id="' + findSectionParent() + '_nav">';
                html += '<button class="dropbtn">' + lb_gp_nav;
                html += '<i class="fa fa-caret-down"></i>';
                html += '</button>';
                html += '<div class="dropdown-content">';
                html += '<a href="#">Link 1</a>';
                html += '<a href="#">Link 2</a>';
                html += '<a href="#">Link 3</a>';
                html += '</div>';
                html += '</div>';
                $("#placement_nav").before(html);
            }
        }
    }

    function addLinkDropDown() {
        if ($(event.target).hasClass("fa-check")) {

            console.log("test value : " + $(event.target).closest(".link-reference").find(".label_link_nav").val());
            $(event.target).closest(".link-reference").css("background-color", "red");
            console.log($(event.target).closest(".link-reference").attr("class"));
            var tester = $(event.target).attr('id');

            console.log("tester : " + tester);
            console.log($("#" + tester).closest(".link-reference").children().attr("class"));
        }
    }

    function addSimpleLink() {
        if ($(event.target).hasClass("fa-check") && $("#" + findSectionParent()).hasClass('rend_nav_l')) {

            var lb_link_nav = $(event.target).closest("section").find(".label_link_nav").val();
            if ($(event.target).closest("section").find(".page-link-nav").val() != '' && $(event.target).closest("section").find(".formation-link-nav").val() != '') {
                alert("Vous ne pouvez selectionner 2 url");
            } else if ($(event.target).closest("section").find(".page-link-nav").val() == '' && $(event.target).closest("section").find(".formation-link-nav").val() == '') {
                alert("Vous devez selectionner une url");
            } else {
                $("#" + findSectionParent() + "_nav").remove();
                html = '<a id="' + findSectionParent() + '_nav" href="' + $(event.target).closest("section").find(".page-link-nav").val() + $(event.target).closest("section").find(".formation-link-nav").val() + '">' + lb_link_nav + '</a>';
                $("#placement_nav").before(html);
            }
        }
    }

    function saver() {
        $('#code_save').val('');
        $('#code_save').val($('#export_navbar').html());
        $('#form_save').val('');
        $('#form_save').val($('#export_form').html());
    }

    function suppressSimpleLink() {
        if ($(event.target).hasClass("delete_link")){
            $("#" + findSectionParent() + "_nav").remove();
            $("#" + findSectionParent()).remove()
        }
    }

    function findSectionParent() {
        return $(event.target).closest("section").attr('id');
    }

    function addIdValidator() {
        if ($(event.target).attr('id') == null && $(event.target).hasClass("fa-check")) {
            $(event.target).attr('id', "valid_link_" + getValidatorIncrementor());
            setValidatorIncrementor(getValidatorIncrementor() + 1);
        }
    }

    function getValidatorIncrementor() {
        return inc = parseInt($(".incrementor-validator").attr('id'));
    }

    function setValidatorIncrementor(val) {
        $('.incrementor-validator').attr('id', val);
    }

    function getIncrementor() {
        return inc = parseInt($(".incrementor-nav").attr('id'));
    }

    function setIncrementor(val) {
        $('.incrementor-nav').attr('id', val);
    }

    $("#add_link_nav").click(function (event) {
        addLink();
    });

    $("#add_group_nav").click(function (event) {
        addGroup();
    });

    $(this).click(function (event) {
        addIdValidator();
        addLinkGroup();
        addToNav();
        addLinkDropDown();
        addSimpleLink();
        suppressSimpleLink();
        saver();
    });

})
;


