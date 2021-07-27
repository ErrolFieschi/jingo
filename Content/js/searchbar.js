// Pour écouter l'évenemnet "Entrer" et chaque touche
window.onload=function(){
    var input = document.getElementById("words_input");
    input.value = "";

    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("words_bt").click();
        }else{
            if($(this).val()) {
                // requete
                SendWord(document.getElementById("words_bt"));
                //console.log($(this).val());
            }
        }
    });
}

// Récupère le choix selectionné -------------------------------
function selectedChoice(elem){

    var pdv = checkVal($(elem).attr('data-pdv'));
    perform_focus_commerce(pdv.split('+'));
    $("#suggestion").hide();

}

// Récupère le mots inscrit dans la barre de recherche ---------
function SendWord(button){

    if(!prepare_parent_loader("#suggestion")){
        // création du loader
        var loader = create_loader();
        add_message_loader("#suggestion", "En chargement...");
        prepare_parent_loader("#suggestion");
        $("#suggestion").append(loader);
    }
    $("#suggestion").show();

    // ------------------------------------------------------
    var words = $(button).parent().find("input").val();

    $.ajax({
        dataType: "json",
        method: "POST",
        url: "../design/php/carte/searchpp.php",

        data: {
            words : words
        }
    }).done(function(data){
        $("#suggestion").removeClass("loader");
        $("#suggestion").css('text-align','left');
        $("#suggestion").css('padding', '10px 0px');

        // Fait disparaitre ma div si on clic à l'extérieur de celui-ci
        document.addEventListener("click", function() {
            if ($(event.target).attr("class") != "choice") {
                $("#suggestion").hide();
                $("#suggestion").html("");
            }
        }, {once : true});

        if(data.pdv.success){
            var template   = "{{#pdv}}<div class='choice cursor-1 Tommy-l padctn-13-5' data-pdv='{{Lat}}+{{Lng}}' onclick='selectedChoice(this)'>{{Nom_PdV}}</div>{{/pdv}}";
            var rendered   = Mustache.render(template, data.pdv);
            $("#suggestion").html("<div style='width: 100%; padding:5px; font-family: Tommy-light; font-weight: bold;'> Points de vente : </div>" + rendered);
        }else{
            // Pas de résultat pour le mot rechercher
            $("#suggestion").html("<div style='width: 100%; padding:10px; font-style: italic;'> Aucun point de vente ne correspond à la recherche </div>");
        }

        if(data.produit.success){
            var template2  = "{{#produit}}<div class='choice cursor-1 Tommy-l padctn-13-5' data-commerce={{idCommerce}} onclick='get_infos_commerce(this)'>{{Nom}}</div>{{/produit}}";
            var rendered2  = Mustache.render(template2, data.produit);
            $("#suggestion").append("<div style='width: 100%; padding:5px; font-family: Tommy-light; font-weight: bold;'> Produits : </div>" + rendered2);
        }else{
            // Pas de résultat pour le mot rechercher
            $("#suggestion").append("<div style='width: 100%; padding:10px; font-style: italic;'> Aucun produits ne correspond à la recherche </div>");
        }

    }).fail(function(){
        alert("Erreur IB01CB");
    });
}