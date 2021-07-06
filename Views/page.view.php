<div class="container-front">

    <div class="mb-20">
        <h1> Bienvenue sur le créateur de pages </h1>
        <button class="button-con" id="mode_render" style="float: right" value="0">Rendu</button>
    </div>

    <div id="former">
        <div id="label_div_former">
            <label id="label_former"></label>
        </div>
        <br>
        <button class="btn_style" id="btn_sepa">Séparateur</button>
        <button class="btn_style" id="btn_link">Lien</button>
        <button class="btn_style" id="btn_text">Text</button>
        <button class="btn_style" id="btn_image">Image</button>
        <button class="btn_style" id="btn_function">Fonctions</button>
        <button class="btn_style" id="btn_style_options">Style</button>
        <i class="fa fa-times" id="cross_form" aria-hidden="true"></i>
        <br>
        <div id="sepa_create" class="edit_page">
            <label>Choisissez la taille de votre séparateur</label>
            <br>
            <input type="text" class="page_form_input"/>
            <br>
            <button class="btn_style_submit" id="submit_sepa">valider</button>
        </div>
        <div id="link_create" class="edit_page">
            <label>Lien de la page</label>
            <br>
            <input id="link_form" type="text" class="page_form_input"/>
            <br>
            <label>Label du bouton</label>
            <br>
            <input id="label_form" type="text" class="page_form_input"/>
            <br>
            <button class="btn_style_submit" id="submit_link">valider</button>
            <!-- Boucler les proposition de style de boutons et faire un système de choix -->
        </div>

        <div id="text_create" class="edit_page">
                    <textarea id="textarea_form" name="textarea_form" rows="4" cols="40"
                              class="page_form_input"></textarea>
            <br>
            <button class="btn_style_submit" id="submit_textarea">valider</button>
        </div>

        <div id="image_choice" class="edit_page">
            <label>Choisissez une image</label>
            <br>
            <button class="btn_style_submit" id="submit_image_choice">valider</button>
        </div>

        <div id="style_choice" class="edit_page">
            <!-- SET MARGIN -->
            <label for="margin-top-opt">Exterieur dessus bloc</label>
            <select id="margin-top-opt">
                <option value="">Choisissez la taille</option>
                <option value="mt-5">10%</option>
                <option value="mt-10">30%</option>
                <option value="mt-16">50%</option>
                <option value="mt-24">70%</option>
                <option value="mt-32">90%</option>
                <option value="mt-40">100%</option>
            </select>
            <label for="margin-bottom-opt">Exterieur bas bloc </label>
            <select id="margin-bottom-opt">
                <option value="">Choisissez la taille</option>
                <option value="mb-5">10%</option>
                <option value="mb-10">30%</option>
                <option value="mb-16">50%</option>
                <option value="mb-24">70%</option>
                <option value="mb-32">90%</option>
                <option value="mb-40">100%</option>
            </select>
            <br>
            <label for="margin-right-opt">Exterieur droit bloc </label>
            <select id="margin-right-opt">
                <option value="">Choisissez la taille</option>
                <option value="mr-5">10%</option>
                <option value="mr-10">30%</option>
                <option value="mr16">50%</option>
                <option value="mr-24">70%</option>
                <option value="mr-32">90%</option>
                <option value="mr-40">100%</option>
            </select>
            <label for="margin-left-opt">Exterieur gauche bloc </label>
            <select id="margin-left-opt">
                <option value="">Choisissez la taille</option>
                <option value="ml-5">10%</option>
                <option value="ml-10">30%</option>
                <option value="ml-16">50%</option>
                <option value="ml-24">70%</option>
                <option value="ml-32">90%</option>
                <option value="ml-40">100%</option>
            </select>

            <br>
            <br>
            <br>

            <!-- SET PADDING -->
            <label for="padding-top-opt">Interieur dessus bloc</label>
            <select id="padding-top-opt">
                <option value="">Choisissez la taille</option>
                <option value="pt-5">10%</option>
                <option value="pt-10">30%</option>
                <option value="pt-16">50%</option>
                <option value="pt-24">70%</option>
                <option value="pt-32">90%</option>
                <option value="pt-40">100%</option>
            </select>
            <label for="padding-bottom-opt">Interieur bas bloc </label>
            <select id="padding-bottom-opt">
                <option value="">Choisissez la taille</option>
                <option value="pb-5">10%</option>
                <option value="pb-10">30%</option>
                <option value="pb-16">50%</option>
                <option value="pb-24">70%</option>
                <option value="pb-32">90%</option>
                <option value="pb-40">100%</option>
            </select>
            <br>
            <label for="padding-left-opt">Côté Interieur gauche </label>
            <select id="padding-left-opt">
                <option value="">Choisissez la taille</option>
                <option value="pl-5">10%</option>
                <option value="pl-10">30%</option>
                <option value="pl-16">50%</option>
                <option value="pl-24">70%</option>
                <option value="pl-32">90%</option>
                <option value="pl-40">100%</option>
            </select>
            <label for="padding-right-opt">Côté Interieur droit </label>
            <select id="padding-right-opt">
                <option value="">Choisissez la taille</option>
                <option value="pr-5">10%</option>
                <option value="pr-10">30%</option>
                <option value="pr-16">50%</option>
                <option value="pr-24">70%</option>
                <option value="pr-32">90%</option>
                <option value="pr-40">100%</option>
            </select>
            <button class="btn_style_submit" id="submit_options">valider</button>
        </div>
    </div>

    <div id="page">
    </div>


    <section>
        <div class="row" id="btn_id">
            <div class="col-sm-12 card--inverse">
                <div class="card-row card--shadow p-12">
                    <div id="div_choice_1" class="col-4">
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                    </div>
                    <div id="div_choice_2" class="col-4">
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                    </div>
                    <div id="div_choice_3" class="col-4">
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                        <div class="card--shadow choice_bloc_editor col-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <button class="button-con mt-20" id="export_json" style="float: right" value="0">Export</button>
    <div id="show_json"></div>
</div>

