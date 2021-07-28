<div id="export_navbar">
    <?php
    foreach ($getNavBar as $code): ?>
    <?php endforeach;
    if ($code['code'] == null): ?>
        <div class="navbar">
            <a class="site-title ml-10" style="color: white" href="/dashboard"><?= TITLE ?></a>
            <a href="/page/accueil">Accueil</a>
            <a href="/courses">Formations</a>
            <a href="/login">Connexion</a>
            <a href="/logout">Deconnexion</a>
            <div id="placement_nav"></div>
        </div>
    <?php else: ?>
        <?= $code['code']; ?>
    <?php
    endif;
    ?>
</div>


<div class="container-front">
    <section>
        <div class="row col-sm-12">
            <div class="pt-40">
                <a class="btn" href="pages">
                    <i class="fas fa-angle-double-left" aria-hidden="true"></i>
                    Retour
                </a>
            </div>
        </div>
    </section>

    <div class="nav-form" id="export_form">
        <?php if ($code['form'] == null): ?>

        <div class="incrementor-nav" id="0" style="display: none"></div>
        <div class="incrementor-validator" id="0" style="display: none"></div>
        <div class="mt-16"></div>

        <section style="display: none;" id="render_nav_link" class="rend_nav_l">
            <div class="row">
                <div class="col-sm-12 mt-4 col-md-12">
                    <div class="card-center--shadow card-center pt-20"
                         style="background-color: #333; min-height: 120px;">
                        <div class="row link_reference" style="width: 90%">
                            <div class="col-sm-3">
                                <label style="color: white">Libellé du lien</label>
                                <br>
                                <input id="" type="text" class="popup_form_input label_link_nav"/>
                            </div>
                            <div class="col-sm-2 destroy_list_link_page">
                                <label style="color: white" for="lesson-link">Lien pages</label>
                                <select id="" class="popup_form_input page-link-nav">
                                    <option value="">Aucun</option>
                                    <?php
                                    foreach ($createdPagesList as $urlPages):?>
                                        <option value="<?= $urlPages[0] ?>"><?= $urlPages[0] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-3 destroy_list_link_formation">
                                <label style="color: white" for="formation-link">Lien formations</label>
                                <select id="" class="popup_form_input formation-link-nav">
                                    <option value="">Aucun</option>
                                    <?php
                                    foreach ($trainingUrlList as $trainingList):?>
                                        <option value="<?= $trainingList[0] ?>"><?= $trainingList[0] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="card-button data_actualiser">
                                <div class="card-icon col-sm-1">
                                    <i class="fas fa-check" style="color: #5ff478; font-size: 28px"></i>
                                </div>
                            </div>

                            <div class="card-icon col-sm-1">
                                <img class="delete_link" style="background-position:center" src="/Content/svg/trash.svg"
                                     alt="Trash button">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section style="display: none;" id="render_nav_group" class="rend_nav_g">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="card-center--shadow card-center mt-4 pt-20"
                         style="background-color: #333; min-height: 120px;">
                        <div class="row" style="width: 90%">
                            <div class="col-sm-3" style="float: left!important;">
                                <label style="color: white">Libellé du groupe</label>
                                <br>
                                <input type="text" class="popup_form_input label_gp_nav"/>
                            </div>
                        </div>
                        <div class="row link-reference" style="width: 90%">
                            <div class="col-sm-3">
                                <label style="color: white">Libellé du lien</label>
                                <br>
                                <input type="text" class="popup_form_input label_link_nav"/>
                            </div>
                            <div class="col-sm-2">
                                <label style="color: white" for="lesson-link">Lien pages</label>
                                <select class="popup_form_input pages-link-nav">
                                    <option value="">Aucun</option>
                                    <?php
                                    foreach ($createdPagesList as $urlPages):?>
                                        <option value="<?= $urlPages[0] ?>"><?= $urlPages[0] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label style="color: white" for="formation-link">Lien formations</label>
                                <select class="popup_form_input formation-link-nav">
                                    <option value="">Aucun</option>
                                    <?php
                                    foreach ($trainingUrlList as $trainingList):?>
                                        <option value="<?= $trainingList[0] ?>"><?= $trainingList[0] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="card-button">
                                <div class="card-icon col-sm-1">
                                    <i class="fas fa-check" style="color: #5ff478; font-size: 28px"></i>
                                </div>
                            </div>
                            <div class="card-icon col-sm-1">
                                <img class="delete_link" style="background-position:center" src="/Content/svg/trash.svg"
                                     alt="Trash button">
                            </div>
                        </div>
                        <div class="row" style="width: 90%">
                            <div class="mb-4">
                                <button class="btn add_link_group" style="background-color: #6f6f6f">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="place-point">
            <div class="row col-sm-12 mt-4">
                <div class="mb-4">
                    <button id="add_link_nav" class="btn" style="background-color: #6f6f6f">
                        <i class="fas fa-link"></i>
                        Ajouter un lien
                    </button>
                </div>
                <div class="mb-4 ml-4">
                    <button id="add_group_nav" class="btn" style="background-color: #6f6f6f">
                        <i class="fas fa-layer-group"></i>
                        Ajouter un groupe
                    </button>
                </div>
            </div>
            <div class="mb-4 ml-4">
                <?php App\Core\FormBuilder::render($saveNav);
                if (isset($errors)):
                    foreach ($errors as $error):?>
                        <li style="color:red"><?= $error; ?></li>
                    <?php endforeach;
                endif; ?>
            </div>
        </section>
    </div>
    <?php
    else:
        ?>
        <?= $code['form']; ?>

    <?php endif; ?>
</div>

<div style="display: none" id="get_link_page">
    <div class=" page-link-nav_check">
        <div class="col-sm-2 destroy_list_link_page">
            <label style="color: white" for="lesson-link">Lien pages</label>
            <select id="" class="popup_form_input  page-link-nav">
                <option value="">Aucun</option>
                <?php
                foreach ($createdPagesList as $urlPages):?>
                    <option value="<?= $urlPages[0] ?>"><?= $urlPages[0] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div style="display: none" id="get_link_formation">
    <div class="formation-link-nav_check">
        <div class="col-sm-3 destroy_list_link_formation">
            <label style="color: white" for="formation-link">Lien formations</label>
            <select id="" class="popup_form_input formation-link-nav">
                <option value="">Aucun</option>
                <?php
                foreach ($trainingUrlList as $trainingList):?>
                    <option value="<?= $trainingList[0] ?>"><?= $trainingList[0] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

