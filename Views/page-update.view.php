<div class="container-front">

    <div class="mb-20">
        <h1> Bienvenue sur le créateur de pages </h1>
        <button class="button-con" id="mode_render" style="float: right" value="0">Rendu</button>
    </div>

    <section>
        <div class="row col-sm-12">
            <div class="mb-4">
                <button id="return_to_pages" class="btn">
                    <i class="fas fa-angle-double-left" aria-hidden="true"></i>
                    Retour à l'accueil
                </button>
            </div>
        </div>
    </section>

    <div id="former">
        <div id="label_div_former">
            <label id="label_former"></label>
        </div>
        <br>
        <button class="btn_style" id="btn_link">Lien</button>
        <button class="btn_style" id="btn_text">Editeur de text</button>
        <button class="btn_style" id="btn_image">Image</button>
        <button class="btn_style" id="btn_style_options">Style</button>
        <button class="btn_style" id="btn_effect">Effets</button>
        <button class="btn_style" id="bloc_options">Bloc</button>
        <button class="btn_style" id="btn_function">Fonctions</button>
        <i class="far fa-times-circle unshow" id="cross_form" aria-hidden="true"></i>

        <div id="add_effect">
            <label for="effect-list">Effet d'affichage</label>
            <select id="effect-list" class="popup_form_input">
                <option value="">Aucun</option>
                <option value="effect_fadein">Fade In</option>
                <option value="effect_slidedown">Slide down</option>
                <option value="effect_slideleft">Slide left</option>
                <option value="effect_slideright">Slide right</option>
                <option value="effect_slidetop">Slide top</option>
                <option value="effect_zoom">zoom</option>
            </select>
            <button class="button-con" id="submit_effect">valider</button>
        </div>

        <div id="bloc_options_form" class="edit_page">
            <button class="button-con" id="delete_div_creator" style="background-color: red!important">Supprimer
            </button>
            <button class="button-con" id="free_div_creator" style="background-color: orange!important">Vider</button>
            <i class="fas fa-chevron-up" style="font-size: 23px; cursor: pointer;" id="bloc_div_up"></i>
            <i class="fas fa-chevron-down" style="font-size: 23px; cursor: pointer;" id="bloc_div_down"></i>
        </div>


        <!-- AJout de boutons et de liens-->
        <div id="link_create" class="edit_page">
            <label for="formation-link">Lien formations</label>
            <select id="formation-link" class="popup_form_input">
                <option value="">Aucun</option>
                <?php
                foreach ($trainingUrlList as $trainingList):?>
                    <option value="<?= $trainingList[0] ?>"><?= $trainingList[0] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="lesson-link">Lien leçons</label>
            <select id="lesson-link" class="popup_form_input">
                <option value="">Aucun</option>
                <?php
                foreach ($trainingLessonList as $lessonList):?>
                    <option value="<?= $lessonList[0] ?>"><?= $lessonList[0] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Libellé du lien</label>
            <br>
            <input id="label_form" type="text" class="page_form_input popup_form_input"/>
            <br>
            <button class="button-con" id="submit_link">valider</button>
            <!-- Boucler les proposition de style de boutons et faire un système de choix -->
        </div>


        <!-- Editeur de textes -->

        <div id="text_create" class="edit_page">
            <textarea id="textarea_form" name="textarea_form" class="jingoEditor" aria-hidden="true"
                      style="cursor: text"></textarea>
            <button class="button-con" id="submit_textarea">valider</button>
        </div>


        <!-- Ajout d'images -->
        <div id="image_choice" class="edit_page">
            <label for="image_placement">Placement de l'image</label>
            <select id="image_placement" class="popup_form_input">
                <option value="center">center</option>
                <option value="top">Top</option>
                <option value="left">Left</option>
                <option value="right">Right</option>
                <option value="bottom">Bottom</option>
            </select>
            <label for="image_style_editor">Format de l'image</label>
            <select id="image_style_editor" class="popup_form_input">
                <option value="cover">cover</option>
                <option value="contain">contain</option>
                <option value="initial">initial</option>
            </select>
            <label for="image_attachment_editor">Attacher l'image</label>
            <select id="image_attachment_editor" class="popup_form_input">
                <option value="scroll">non</option>
                <option value="fixed">oui</option>
            </select>
            <label for="image_filter_editor">Filtres</label>
            <select id="image_filter_editor" class="popup_form_input">
                <option value="">Aucun</option>
                <option value="blur(4px)">Blur</option>
                <option value="brightness(100%)">Brightness</option>
                <option value="contrast(180%)">contrast</option>
                <option value="grayscale(100%)">grayscale</option>
                <option value="hue-rotate(180deg)">hue-rotate</option>
                <option value="invert(100%)">invert</option>
                <option value="opacity(50%)">opacity</option>
                <option value="saturate(7)">saturate</option>
                <option value="sepia(100%)">sepia</option>

            </select>
            <label>Taille Image</label>
            <input type="number" id="image_height_editor" name="image_height_editor" class="popup_form_input"
                   min="20" value="">
            <button class="button-con" id="submit_image_choice">valider</button>

            <br>
            <br>
            <?php
            foreach ($img_dir as $img): ?>
                <img class="image_creator" id="<?= $img; ?>" src="/<?= $img; ?>"
                     alt="">
            <?php endforeach; ?>
        </div>

        <div id="style_choice" class="edit_page">
            <!-- SET MARGIN -->
            <label for="margin-top-opt">Exterieur dessus bloc</label>
            <select id="margin-top-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="">10%</option>
                <option value="mt-10">30%</option>
                <option value="mt-16">50%</option>
                <option value="mt-24">70%</option>
                <option value="mt-32">90%</option>
                <option value="mt-40">100%</option>
            </select>
            <label for="margin-bottom-opt">Exterieur bas bloc </label>
            <select id="margin-bottom-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="mb-5">10%</option>
                <option value="mb-10">30%</option>
                <option value="mb-16">50%</option>
                <option value="mb-24">70%</option>
                <option value="mb-32">90%</option>
                <option value="mb-40">100%</option>
            </select>

            <label for="margin-right-opt">Exterieur droit bloc </label>
            <select id="margin-right-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="mr-5">10%</option>
                <option value="mr-10">30%</option>
                <option value="mr16">50%</option>
                <option value="mr-24">70%</option>
                <option value="mr-32">90%</option>
                <option value="mr-40">100%</option>
            </select>
            <label for="margin-left-opt">Exterieur gauche bloc </label>
            <select id="margin-left-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="ml-5">10%</option>
                <option value="ml-10">30%</option>
                <option value="ml-16">50%</option>
                <option value="ml-24">70%</option>
                <option value="ml-32">90%</option>
                <option value="ml-40">100%</option>
            </select>

            <!-- SET PADDING -->
            <label for="padding-top-opt">Interieur dessus bloc</label>
            <select id="padding-top-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="pt-5">10%</option>
                <option value="pt-10">30%</option>
                <option value="pt-16">50%</option>
                <option value="pt-24">70%</option>
                <option value="pt-32">90%</option>
                <option value="pt-40">100%</option>
            </select>
            <label for="padding-bottom-opt">Interieur bas bloc </label>
            <select id="padding-bottom-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="pb-5">10%</option>
                <option value="pb-10">30%</option>
                <option value="pb-16">50%</option>
                <option value="pb-24">70%</option>
                <option value="pb-32">90%</option>
                <option value="pb-40">100%</option>
            </select>
            <label for="padding-left-opt">Côté Interieur gauche </label>
            <select id="padding-left-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="pl-5">10%</option>
                <option value="pl-10">30%</option>
                <option value="pl-16">50%</option>
                <option value="pl-24">70%</option>
                <option value="pl-32">90%</option>
                <option value="pl-40">100%</option>
            </select>
            <label for="padding-right-opt">Côté Interieur droit </label>
            <select id="padding-right-opt" class="popup_form_input">
                <option value="">Choisissez la taille</option>
                <option value="pr-5">10%</option>
                <option value="pr-10">30%</option>
                <option value="pr-16">50%</option>
                <option value="pr-24">70%</option>
                <option value="pr-32">90%</option>
                <option value="pr-40">100%</option>
            </select>

            <label for="element-place">Placement éléments</label>
            <select id="element-place" class="popup_form_input">
                <option value="card-center">centré</option>
                <option value="card-center-top">centré haut</option>
                <option value="card-center-bottom">centré bas</option>
                <option value="card-center-left">centré gauche</option>
                <option value="card-center-right">centré droit</option>
                <option value="card-coin-left-top">coin haut gauche</option>
                <option value="card-coin-right-top">coin haut droit</option>
                <option value="card-coin-right-bottom">coin bas gauche</option>
                <option value="card-coin-left-bottom">coin bas droit</option>
            </select>

            <div>
                <input type="color" id="div_color" name="div_color"
                       value="">
                <label for="div_color">Couleur du bloc</label>
            </div>

            <div>
                <label>Taille</label>
                <input type="number" id="div_height" name="div_height"
                       value="">
                <button class="button-con" id="basic_height_div">Réinitialiser</button>
            </div>

            <div>
                <label>Arrondissement des bordures</label>
                <input type="number" id="div_border_radius" name="div_border_radius" min="0"
                       value="">
            </div>

            <label for="bloc-style">Bordures et ombres</label>
            <select id="bloc-style" class="popup_form_input">
                <option value="">Aucun</option>
                <option value="card--shadow">Ombres</option>
                <option value="card--border">Bordures</option>
                <option value="card--shadow--border">Bordures et ombres</option>
            </select>

            <button class="button-con" id="submit_options">valider</button>
        </div>
    </div>

    <?php
    foreach ($pagesShow as $rowData): ?>
        <h1> <?= $rowData['title'] ?> </h1>
    <?php endforeach; ?>
    <div id="page">
        <?php if ($rowData['code'] == null) { ?>
            <div class="incrementor" id="0" style="display: none"></div>
        <?php }

        foreach ($pagesShow as $rowData): ?>
            <?= $rowData['code'] ?>
        <?php endforeach; ?>
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
                    <div id="div_choice_4" class="col-sm-4">
                        <div class="card--shadow choice_bloc_editor col-sm-2"></div>
                        <div class="card--shadow choice_bloc_editor col-sm-4"></div>
                    </div>
                    <div id="div_choice_5" class="col-sm-4">
                        <div class="card--shadow choice_bloc_editor col-sm-4"></div>
                        <div class="card--shadow choice_bloc_editor col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="float: right">
    <?php App\Core\FormBuilder::render($savePage, "popup_form_builder col-md-6");
    if (isset($errors)):
        foreach ($errors as $error):?>
            <li style="color:red"><?= $error; ?></li>
        <?php endforeach;
    endif; ?>
    </div>
    <div id="show_json"></div>
</div>
