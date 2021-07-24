$(document).ready(function () {

    // Les 3 fonctions en dessous créer et implémente les id unique de chaque bloc

    function create_bloc() {
        $("#div_choice_1").click(function () {
            var getIncrementor = $('.incrementor').attr('id');
            var count_render = parseInt(getIncrementor);
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';

            count_render += 2;
            $('.incrementor').attr('id', count_render);
            console.log(count_render);

            $('#page').append(html);
            saver();
        });

        $("#div_choice_2").click(function () {
            var getIncrementor = $('.incrementor').attr('id');
            var count_render = parseInt(getIncrementor);
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

            count_render += 3;
            $('.incrementor').attr('id', count_render);
            $('#page').append(html);
            saver();
        });


        $("#div_choice_3").click(function () {
            var getIncrementor = $('.incrementor').attr('id');
            var count_render = parseInt(getIncrementor);
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

            count_render += 4;
            $('.incrementor').attr('id', count_render);
            $('#page').append(html);
            saver();
        });

        $("#div_choice_4").click(function () {
            var getIncrementor = $('.incrementor').attr('id');
            var count_render = parseInt(getIncrementor);
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 col-md-4 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-12 col-md-8 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 2) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';

            count_render += 3;
            $('.incrementor').attr('id', count_render);
            $('#page').append(html);
            saver();
        });

        $("#div_choice_5").click(function () {
            var getIncrementor = $('.incrementor').attr('id');
            var count_render = parseInt(getIncrementor);
            var html = '';
            html += '<section id="render_' + count_render + '">';
            html += '<div class="row">';

            html += '<div class="col-sm-12 col-md-8 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-12 col-md-4 card--inverse">';
            html += '<div class="card-center div_edit" id="render_' + (count_render + 2) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';

            count_render += 3;
            $('.incrementor').attr('id', count_render);
            $('#page').append(html);
            saver();
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
        $("#bloc_options_form").hide();
        $("#link_create").show();

        $("#btn_link").click(function (event) {

            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#add_effect").hide();
            $("#bloc_options_form").hide();
            $("#link_create").show();
        });
        $("#btn_image").click(function (event) {

            $("#style_choice").hide();
            $("#text_create").hide();
            $("#link_create").hide();
            $("#add_effect").hide();
            $("#bloc_options_form").hide();
            $("#image_choice").show();
        });
        $("#btn_text").click(function (event) {

            $("#style_choice").hide();
            $("#image_choice").hide();
            $("#link_create").hide();
            $("#add_effect").hide();
            $("#bloc_options_form").hide();
            $("#text_create").show();
        });
        $("#btn_style_options").click(function (event) {

            $("#text_create").hide();
            $("#link_create").hide();
            $("#image_choice").hide();
            $("#add_effect").hide();
            $("#bloc_options_form").hide();
            $("#style_choice").show();
        });

        $("#btn_effect").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#link_create").hide();
            $("#bloc_options_form").hide();
            $("#add_effect").show();
        });
        $("#bloc_options").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#link_create").hide();
            $("#add_effect").hide();
            $("#bloc_options_form").show();
        });

    }

    //permet d'ajouter un bouton avec un lien sur la page
    function add_button_page() {

        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        if ($("#label_form").val() == "" && ($('#formation-link').find(":selected").val() == "" || $('#lesson-link').find(":selected").val() == "")) {
            alert("les deux champs doivent être remplit");
        } else if ($('#formation-link').find(":selected").val() != "" && $('#lesson-link').find(":selected").val() != "") {
            alert("Vous ne pouvez pas choisir 2 liens");
        } else if ($("#" + id).children().length > 0) {
            alert("Vous devez dabord vider l'interieur du bloc");
            return 0;
        } else {
            $("#" + id).append('<a class="btn_style_submit" href=\'' + $('#formation-link').find(":selected").val() + $('#lesson-link').find(":selected").val() + '\'> ' + $("#label_form").val() + '</a>');
        }

    }


    function on_return() {
        if (confirm('Quitter sans sauvegarder')) {
            window.location.href = "../pages";
        }
    }

    // permet de modifier le css des éléments affiché

    function add_style_options() {

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

            "card-center", "card-center-top", "card-center-bottom",
            "card-center-left", "card-center-right",
            "card-coin-left-top", "card-coin-right-top",
            "card-coin-right-bottom", "card-coin-left-bottom",

            "card--shadow", "card--border", "card--shadow--border"
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
                if (i >= 49 && i <= 58 && $(getId).hasClass("card-text-editor") != true) { //center
                    $(getId).removeClass(mp_options[i]);
                    $("#" + id).addClass($('#element-place').find(":selected").val());
                }
                if (i >= 58 && i <= 61) { //bloc style
                    $(getId).removeClass(mp_options[i]);
                    $("#" + id).addClass($('#bloc-style').find(":selected").val());
                }
                console.log(("mp option : ." + mp_options[i]));
            }
        }

        if ($("#div_height").val() != "" && $.isNumeric($("#div_height").val()) && $("#div_height").val() >= 50) { // taille de la div
            $("#" + id).css("height", $("#div_height").val());
            $("#" + id).css("overflow", "auto");
        } else if ($("#div_height").val() < 50 && $("#div_height").val() != "") {
            alert("Nombre inferieur à 50");
        }

        if ($("#div_border_radius").val() != "" && $.isNumeric($("#div_border_radius").val()) && $("#" + id).children().hasClass("img_page_add")) { // taille de la div
            $("#" + id).children().css("border-radius", $("#div_border_radius").val() + "px");
        } else {
            $("#" + id).css("border-radius", $("#div_border_radius").val() + "px");
        }

        $("#" + id).addClass($('#padding-right-opt').find(":selected").val() + ' '
            + $('#padding-left-opt').find(":selected").val() + ' '
            + $('#padding-top-opt').find(":selected").val() + ' '
            + $('#padding-bottom-opt').find(":selected").val() + ' '
            + $('#margin-top-opt').find(":selected").val() + ' '
            + $('#margin-bottom-opt').find(":selected").val() + ' '
            + $('#margin-right-opt').find(":selected").val() + ' '
            + $('#margin-left-opt').find(":selected").val() + ' '
            + $('#bloc-style').find(":selected").val()
        );
        if ($(getId).hasClass("card-text-editor") != true) {
            $("#" + id).addClass($('#element-place').find(":selected").val());
        } else {
            alert("vous etes en edition de texte vous ne pouvez pas utiliser cette fonctionnalité");
        }
    }

    $("#div_color").change(function () { // <-- use change event
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        $(getId).css('background-color', $("#div_color").val());
    });


    // permet de reinitialiser le css
    function reset_style_options() {

    }

    // a remplacer par le tiny mais permet d'ajouter du texte sur la page

    function add_text_page() {

        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        console.log("je suis ici");
        tinyMCE.triggerSave();
        if ($("#textarea_form").val() == "") {
            alert("les deux champs doivent être remplit");
        } else {
            $("#" + id).removeClass("card-center");
            $("#" + id).addClass("card-text-editor");
            var saveText = $("#" + id).clone();
            $("#" + id).empty();
            $("#" + id).append($("#textarea_form").val());

        }

    }

    // Permet de visualiser le rendu final de la page
    function render_mode() {
        $("#mode_render").click(function (event) {
            if ($("#mode_render").val() == 0) {
                $(".div_edit").css("border", "none");
                $(".border_render").css("border", "none");
                $(".render").css("border", "none");
                $("#btn_id").hide();
                $(".card-icon").hide();
                $("#mode_render").val(1);
            } else {
                $(".div_edit").css("border", "solid 0.5px");
                $(".border_render").css("border", "solid 0.5px");
                $(".render").css("border", "solid 0.5px");
                $("#btn_id").show();
                $(".card-icon").show();
                $("#mode_render").val(0);
            }
        })
    }

    //gestion des images et ajout des images
    $(".image_creator").click(function () {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;

        $(getId).css("background-image", "url(/" + "" + $(this).attr('id') + "");
        $(getId).css("align-items", "unset");
        $(getId).css("background-repeat", "no-repeat");
        $(getId).css("background-size", $('#image_style_editor').find(":selected").val());
        $(getId).css("background-attachment", $('#image_attachment_editor').find(":selected").val());
        $(getId).css("background-position", $('#image_placement').find(":selected").val());
        $(getId).css("filter", $('#image_filter_editor').find(":selected").val());
        if ($('#image_height_editor').val != "") {
            $(getId).css("background-size", $('#image_height_editor').val + "px");
        } else {
            $(getId).css("background-size", "100%");
        }
    });

    // modifie l'image au niveau du submit
    $("#submit_image_choice").click(function () {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        $(getId).css("background-position", $('#image_placement').find(":selected").val());
        $(getId).css("background-attachment", $('#image_attachment_editor').find(":selected").val());
        $(getId).css("filter", $('#image_filter_editor').find(":selected").val());
        if ($('#image_height_editor').val() != "" && $('#image_style_editor').find(":selected").val() == "initial") {
            $(getId).css("background-size", $('#image_height_editor').val() + "px");
        } else {
            $(getId).css("background-size", $('#image_style_editor').find(":selected").val());
        }
    });

    // déplace la div vers le haut
    function div_to_top() {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        var actual_div = $(getId).parent().parent().parent().attr('id');
        var parent_selected = $(getId).parent().parent().parent().prev().attr('id');
        var div_save = $("#" + actual_div).clone();
        console.log("la ou je veux aller : " + $(getId).parent().parent().parent().prev().attr('id'));
        console.log("la ou je suis censé être : " + $(getId).parent().parent().parent().attr('id'));
        if (parent_selected != null) {
            $("#" + actual_div).remove();
            $("#" + parent_selected).before(div_save);
        }
    }

    // déplace la div vers le bas

    function div_to_bottom() {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        var actual_div = $(getId).parent().parent().parent().attr('id');
        var next_place = $(getId).parent().parent().parent().next().attr('id');
        var div_save = $("#" + actual_div).clone();
        console.log("la ou je veux aller : " + $(getId).parent().parent().parent().next().attr('id'));
        console.log("la ou je suis censé être : " + actual_div);
        if (next_place != null) {
            $("#" + actual_div).remove();
            $("#" + next_place).after(div_save);
        }
    }

    // Suppression de la div parent
    function delete_parent_div() {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        // avant chaque suppression faire une insertion en base (enregistrement auto)
        var parent_selected = $(getId).parent().parent().parent().attr('id');
        $("#" + parent_selected).remove();
    }

    // retirer tous les éléments de la div
    function free_div() {
        var id = ($('.label_former').attr('id'));
        id = id.substr(4);
        var getId = "#" + id;
        // mettre à jour les id's recuperer toutes les class avec le nom "bla" et refaire le counter
        // avant chaque suppression faire une insertion en base (enregistrement auto)
        $(getId).children().remove();
        //gerer les images
        //gerer tout le css
    }


    //appliquer le filtre de couleur
    //$(getId).append('<img src="' + $(this).attr('id')+ '" id="'+ $(this).attr('id') +'" class="img_page_add" />');
    //$(getId).css("background-image","url(" + $(this).attr('id'));
    // creer un id unique pour les images

    /*$(getId).css("align-items","unset");
    $(getId).children().css("background-repeat","no-repeat");
    $(getId).children().css("object-fit","cover");
    $(getId).children().css("max-height","100%");
    $(getId).children().css("max-width","100%");
*/
    // gerer les select
    // ajouter height

    console.log($(this).attr('id'));

    function saver() {
        $('#code_save').val('');
        $('#code_save').val($('#page').html());
    }


    create_bloc();
    show_selected_bloc();
    show_popup_options();

    $("#submit_link").click(function (event) {
        add_button_page();
        saver();
    });
    $("#submit_options").click(function (event) {
        add_style_options();
        saver();
    });
    $("#submit_textarea").click(function (event) {
        add_text_page();
        saver();
    });
    $("#free_div_creator").click(function () {
        free_div();
        saver();
    });
    $("#delete_div_creator").click(function () {
        delete_parent_div();
        saver();
    });
    $("#bloc_div_down").click(function () {
        div_to_bottom();
        saver();
    });
    $("#bloc_div_up").click(function () {
        div_to_top();
        saver();
    });

    $("#return_to_pages").click(function () {
        on_return();
    });
    render_mode();
    reset_style_options();

    // replacer les div, prendre l'id du parent (section) et et faire un append juste au dessus

    // effet couleur du hover
    // gerer le problème du clic après ajout d'un éléments
    // replacer les places de la div
    // ajout choix type banner etc //
    // ajout des animations
    // récupérer les données deja enregistrer pour eviter les mauvaises modifications
    // faire des fonctions qui appelle des methodes database
    // derniere formation
    // liste des formation avec limit etc ..
    // rechercher une formation
    // ajouter une classe par élément qui indique que la class mt par exemple a bien été ajouter si c'est le cas on refait
    // retirer container et gérer a la voler de chaque div
    //remove div of class trash . parent
    // Fonction dispo : afficher la moyenne du qcm
    // afficher la derniere formation
    // afficher les formations
    // afficher la derniere lesson
    // Update le text normalement pas trop compliqué
    // carroussel
    // grisé la fonction centrage en mode edition text


    // PRIORITÉ AUJOURD'HUI

    // FAIRE AFFICHAGE DES PAGES
    // SUPPRESSION DES PAGES
    // MODIFICATION DES PAGES
    // ACCES AUX PAGES SUR LE FRONT
    // CRÉER LA PAGE D'ACCUEIL NON SUPPRIMABLE ET MODIFIABLE DE BASE (Bouton retour usine si le gars a fait de la merde)

    // enregistrer la value dans id="code_save"
    // FAIRE LES METAS EN DYNAMIQUE AJOUTER LA TABLE BDD
    // ajouter une vidéo ça sera le feu
});
