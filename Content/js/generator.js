$(document).ready(function () {

    // Les 3 fonctions en dessous créer et implémente les id unique de chaque bloc

    function create_bloc() {
        $("#div_choice_1").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section>';
            html += '<div class="row">';

            html += '<div class="col-sm-12 card--inverse">';
                html += '<div class="card-center card--shadow div_edit" id="render_' + count_render + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';

            $('#page').append(html);

        });

        $("#div_choice_2").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section>';
            html += '<div class="row">';

            html += '<div class="col-sm-6 card--inverse">';
                html += '<div class="card-center card--shadow div_edit" id="render_' + count_render + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-6 card--inverse">';
                html += '<div class="card-center card--shadow div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '</div>';
            html += '</section>';
            $('#page').append(html);
        });


        $("#div_choice_3").click(function () {
            var count_render = $("#page div").length;
            var html = '';
            html += '<section>';
            html += '<div class="row">';

            html += '<div class="col-sm-4 card--inverse">';
            html += '<div class="card-center card--shadow div_edit" id="render_' + count_render + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-4 card--inverse">';
            html += '<div class="card-center card--shadow div_edit" id="render_' + (count_render + 1) + '"></div>';
            html += '</div>';

            html += '<div class="col-sm-4 card--inverse">';
            html += '<div class="card-center card--shadow div_edit" id="render_' + (count_render + 2) + '"></div>';
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
        $("#link_create").hide();
        $("#image_choice").hide();
        $("#sepa_create").show();
        $("#btn_sepa").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#link_create").hide();
            $("#image_choice").hide();
            $("#sepa_create").show();
        });
        $("#btn_link").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#image_choice").hide();
            $("#sepa_create").hide();
            $("#link_create").show();
        });
        $("#btn_image").click(function (event) {
            $("#style_choice").hide();
            $("#text_create").hide();
            $("#sepa_create").hide();
            $("#link_create").hide();
            $("#image_choice").show();
        });
        $("#btn_text").click(function (event) {
            $("#style_choice").hide();
            $("#image_choice").hide();
            $("#sepa_create").hide();
            $("#link_create").hide();
            $("#text_create").show();
        });
        $("#btn_style_options").click(function (event) {
            $("#sepa_create").hide();
            $("#text_create").hide();
            $("#link_create").hide();
            $("#image_choice").hide();
            $("#style_choice").show();
        })
    }

    //permet d'ajouter un bouton avec un lien sur la page

    function add_button_page() {
        $("#submit_link").click(function (event) {
            if ($("#link_form").val() == "" || $("#label_form").val() == "") {
                alert("les deux champs doivent être remplit");
            } else {
                var id = ($('.label_former').attr('id'));
                id = id.substr(4);
                $("#" + id).append('<a class="btn_style_submit" href=\'' + $("#link_form").val() + '\'> ' + $("#label_form").val() + '</a>');
            }
        })
    }

    // permet de modifier le css des éléments affiché

    function add_style_options() {
        $("#submit_options").click(function (event) {
            var id = ($('.label_former').attr('id'));
            id = id.substr(4);
            $("#" + id).addClass($('#padding-right-opt').find(":selected").val() + ' '
                + $('#padding-left-opt').find(":selected").val() + ' '
                + $('#padding-top-opt').find(":selected").val() + ' '
                + $('#padding-bottom-opt').find(":selected").val() + ' '

                + $('#margin-top-opt').find(":selected").val() + ' '
                + $('#margin-bottom-opt').find(":selected").val() + ' '
                + $('#margin-right-opt').find(":selected").val() + ' '
                + $('#margin-left-opt').find(":selected").val()
            );
        })
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
                $("#mode_render").val(1);
            } else {
                $(".div_edit").css("border", "solid 0.5px");
                $(".border_render").css("border", "solid 0.5px");
                $(".render").css("border", "solid 0.5px");
                $("#mode_render").val(0);
            }
        })
    }


    $("#export_json").click(function () {
        console.log(JSON.stringify({
            data: $('#page').html()
        }));
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

});


/*
{
    "pages":[
    {
        "classDiv":"sub_div_render col-12",
        "subDiv":[
            {
                "classDiv":"border_render col-3",
                "idDiv":"render_1",
                "type":"",
                "value":""
            },
            {
                "classDiv":"border_render col-3",
                "idDiv":"render_2",
                "type":"",
                "value":""
            },
            {
                "classDiv":"border_render col-3",
                "idDiv":"render_3",
                "type":"",
                "value":""
            }
        ],
        "classDiv":"sub_div_render col-12",
        "subDiv":[
            {
                "classDiv":"border_render col-5",
                "idDiv":"render_4",
                "type":"",
                "value":""
            },
            {
                "classDiv":"border_render col-5",
                "idDiv":"render_5",
                "type":"",
                "value":""
            }
        ]
    }
],

/*
TODO : Gérer unicité des class mt etc ...
TODO : Créer le formulaire permettant d'accéder à l'éditeur, nom de la page, titre de la page etc ...
TODO : Ajouter les images


 */


/*
utilisation du drag and drop seulement pour replacer les éléments de la page
}*/
