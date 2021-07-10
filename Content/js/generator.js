$(document).ready(function () {

    // Les 3 fonctions en dessous créer et implémente les id unique de chaque bloc

    function create_bloc() {
        $("#div_choice_1").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';

            $('#page').append(html);

        });

        $("#div_choice_2").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 col-md-6 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-12 col-md-6 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 2) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';
            $('#page').append(html);
        });


        $("#div_choice_3").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 col-md-4 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-12 col-md-4 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 2) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-12 col-md-4 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 3) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';
            $('#page').append(html);
        });
    }


    // croix qui permet de cacher la popup
    $("#cross_form").click(function (event) {
        $("#former").hide();
    });

    // permet d'afficher la popup et sur la popup l'id du bloc de modification en cours et lui ajoute l'id également
    function show_selected_bloc() {
        $(this).click(function (event) {
            if ($(event.target).hasClass('div_edit')) {
                console.log(event.target.id);
                $(".label_former").remove();
                $("#label_div_former").append("<label class='label_former' id=pop_" + event.target.id + ">" + event.target.id + "<label>");
                $("#former").show();
            }
        });
    }

    // permet d'afficher les options de chaque boutons de la popup
    function show_popup_options() {

        $("#style_choice").hide();
        $("#text_create").hide();
        $("#image_choice").hide();
        $("#add_effect").hide();
        $("#link_create").show();

        $("#btn_link").click(function (event) {

            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#add_effect").hide();
            $("#link_create").show();
        });
        $("#btn_image").click(function (event) {

            $("#style_choice").hide();
            $("#text_create").hide();
            $("#link_create").hide();
            $("#add_effect").hide();
            $("#image_choice").show();
        });
        $("#btn_text").click(function (event) {

            $("#style_choice").hide();
            $("#image_choice").hide();
            $("#link_create").hide();
            $("#add_effect").hide();
            $("#text_create").show();
        });
        $("#btn_style_options").click(function (event) {

            $("#text_create").hide();
            $("#link_create").hide();
            $("#image_choice").hide();
            $("#add_effect").hide();
            $("#style_choice").show();
        });

        $("#btn_effect").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#link_create").hide();
            $("#add_effect").show();
        });
    }

    //permet d'ajouter un bouton avec un lien sur la page

    function add_button_page() {
        $("#submit_link").click(function (event) {
            if ($("#label_form").val() == "" && ($('#formation-link').find(":selected").val() == "" || $('#lesson-link').find(":selected").val() == "")) {
                alert("les deux champs doivent être remplit");
            }else if($('#formation-link').find(":selected").val() != "" && $('#lesson-link').find(":selected").val() != ""){
                alert("Vous ne pouvez pas choisir 2 liens");
            }
            else {
                var id = ($('.label_former').attr('id'));
                id = id.substr(4);
                $("#" + id).append('<a class="btn_style_submit" href=\'' + $('#formation-link').find(":selected").val()  + $('#lesson-link').find(":selected").val() + '\'> ' + $("#label_form").val() + '</a>');
            }
        })
    }

    // permet de modifier le css des éléments affiché

    function add_style_options() {
        $("#submit_options").click(function (event) {
            var id = ($('.label_former').attr('id'));
            id = id.substr(4);
            var getId = "#" + id;
            var i;
            var y;
            // faire un get value des enfants et boucler sur les valeurs des select
            console.log();
            var mp_options = [
                "mt-5", "mt-10", "mt-16",
                "mt-24", "mt-32", "mt-40",

                "mb-5", "mb-10", "mb-16",
                "mb-24", "mb-32", "mb-40",

                "ml-5", "ml-10", "ml-16",
                "ml-24", "ml-32", "ml-40",

                "mr-5", "mr-10", "mr-16",
                "mr-24", "mr-32", "mr-40",

                "pt-5", "pt-10", "pt-16",
                "pt-24", "pt-32", "pt-40",

                "pb-5", "pb-10", "pb-16",
                "pb-24", "pb-32", "pb-40",

                "pl-5", "pl-10", "pl-16",
                "pl-24", "pl-32", "pl-40",

                "pr-5", "pr-10", "pr-16",
                "pr-24", "pr-32", "pr-40",

                "card-center","card-center-top","card-center-bottom",
                "card-center-left","card-center-right",

                "card-coin-left-top", "card-coin-right-top",
                "card-coin-right-bottom", "card-coin-left-bottom",

                "card--shadow","card--border","card--shadow--border"
            ];
            for (i = 0; i < mp_options.length; i++) {
                if ($(getId).hasClass(mp_options[i])) {
                    if (i >= 1 && i <= 7) { //margin top
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#margin-top-opt').find(":selected").val());
                    }
                    if (i >= 7 && i <= 13) { //margin bottom
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#margin-bottom-opt').find(":selected").val());
                    }
                    if (i >= 13 && i <= 19) { //margin left
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#margin-left-opt').find(":selected").val());
                    }
                    if (i >= 19 && i <= 25) { //margin right
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#margin-right-opt').find(":selected").val());
                    }
                    if (i >= 25 && i <= 31) { //padding top
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#padding-top-opt').find(":selected").val());
                    }
                    if (i >= 31 && i <= 37) { //padding bottom
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#padding-bottom-opt').find(":selected").val());
                    }
                    if (i >= 37 && i <= 43) { //padding left
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#padding-left-opt').find(":selected").val());
                    }
                    if (i >= 43 && i <= 49) { //padding right
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#padding-right-opt').find(":selected").val());
                    }
                    if (i >= 49 && i <= 58) { //center
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#element-place').find(":selected").val());
                    }
                    if (i >= 58 && i <= 61) { //bloc style
                        $(getId).removeClass(mp_options[i]);
                        $("#" + id).addClass($('#bloc-style').find(":selected").val());
                    }
                    console.log(("." + mp_options[i]));
                }
            }

            if ($("#div_height").val() != "" && $.isNumeric($("#div_height").val()) && $("#div_height").val() >=50) { // taille de la div
                $("#" + id).css("height",$("#div_height").val());
            }

            if ($("#div_border_radius").val() != "" && $.isNumeric($("#div_border_radius").val())) { // taille de la div
                $("#" + id).css("border-radius",$("#div_border_radius").val()+"px");
                console.log("border : " + $("#div_border_radius").val());
            }


            $("#" + id).addClass($('#padding-right-opt').find(":selected").val() + ' '
                + $('#padding-left-opt').find(":selected").val() + ' '
                + $('#padding-top-opt').find(":selected").val() + ' '
                + $('#padding-bottom-opt').find(":selected").val() + ' '
                + $('#margin-top-opt').find(":selected").val() + ' '
                + $('#margin-bottom-opt').find(":selected").val() + ' '
                + $('#margin-right-opt').find(":selected").val() + ' '
                + $('#margin-left-opt').find(":selected").val() + ' '
                + $('#element-place').find(":selected").val() + ' '
                + $('#bloc-style').find(":selected").val()
            );
        })
    }

    $("#div_color").change(function(){ // <-- use change event
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        $(getId).css('background-color', $("#div_color").val());
    });


    // permet de reinitialiser le css

    function reset_style_options() {

    }

    function add_img_page() {
        //recuperer depuis le serveur en php
    }

    // a remplacer par le tiny mais permet d'ajouter du texte sur la page

    function add_text_page() {
        $("#submit_textarea").click(function (event) {
            if ($("#textarea_form").val() == "") {
                alert("les deux champs doivent être remplit");
            } else {
                var id = ($('.label_former').attr('id'));
                id = id.substr(4);
                $("#" + id).append('<p>' + $("#textarea_form").val() + '</p>');
            }
        })
    }

    // Permet de visualiser le rendu final de la page
    function render_mode() {
        $("#mode_render").click(function (event) {
            if ($("#mode_render").val() == 0) {
                $(".div_edit").css("border", "none");
                $(".border_render").css("border", "none");
                $(".render").css("border", "none");
                $("#btn_id").hide();
                $("#mode_render").val(1);
            } else {
                $(".div_edit").css("border", "solid 0.5px");
                $(".border_render").css("border", "solid 0.5px");
                $(".render").css("border", "solid 0.5px");
                $("#btn_id").show();
                $("#mode_render").val(0);
            }
        })
    }

    $(".image_creator").click(function () {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        $(getId).append('<img src="' + $(this).attr('id')+ '" />');
        //$(getId).css("background-image","url(" + $(this).attr('id'));
        $(getId).css(" background-repeat","no-repeat");

        console.log($(this).attr('id'));
    });


    $("#export_json").click(function () {
        //console.log(JSON.stringify({
        //    data: $('#page').html()
        //}));
        console.log($('#page').html())
    });


    create_bloc();
    show_selected_bloc();
    show_popup_options();
    add_button_page();
    render_mode();
    add_img_page();
    add_text_page();
    add_style_options();
    reset_style_options();

    // effet couleur du hover
    // replacer les places de la div
    // ajout choix type banner etc
    // ajout des animations
    // récupérer les données deja enregistrer pour eviter les mauvaises modifications
    // faire des fonctions qui appelle des methodes database
    // derniere formation
    // liste des formation avec limit etc ..
    // rechercher une formation
    // ajouter une classe par élément qui indique que la class mt par exemple a bien été ajouter si c'est le cas on refait
});
