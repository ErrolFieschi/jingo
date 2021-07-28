<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Liste de leçon</h4>
                <p class="my-0">L’endroit pour créer, modifier ou supprimer des leçons</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow" id="modal-btn">
                    <a href="javascript:void(0);"><img class="svg-dashboard--formation" src="/Content/Images/create_courses.svg" alt="register"></a>
                </div>
                <p>Ajouter une leçon</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row col-sm-12">
            <div class="mb-4">
                <a class="btn" href="/<?= $back; ?>"><i class="fas fa-angle-double-left"></i> Retour aux chapitres</a>
            </div>
            <div class="mb-4 ml-2">
                <span class="btn btn--disable"><i class="fas fa-street-view" style="font-size: 15px; padding-right: 10px;"></i> <?= mb_strtoupper($title); ?></span>
            </div>
            <input type="hidden" id="checkId" value="<?= $partId ?>">
            <input type="hidden" id="uri" value="<?= $back . '/' . $uri ?>">
            <input type="hidden" id="url" value="/lesson/search">
            <div class="mb-4 ml-2">
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control form-control-lg" placeholder="Rechercher une leçon..." autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn rounded-0" type="submit" name="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                <div class="col-md-5 list-display">
                    <div class="list-group" id="show-list">
                        <!-- liste des lessons par recherche -->
                    </div>
                </div>
            </div>
        </div>

        <?php
        if(empty($data)){echo 'Aucune lesson à afficher, il faut en créer une !';} else{
        foreach ($data as $rowData): ?>
        <div class="row mb-4">
            <div class="col-sm-12">
                <div class="card flex-row flex-nowrap card--shadow justify-content-between">
                    <div class="card-header">
                        <img src="/<?= $rowData['image'] ?>" alt="title image" style="object-fit: cover;">
                    </div>
                    <div class="card-block">
                        <h4 class="card-title"><?= $rowData['title'] ?></h4>
                        <p class="card-text mb-10"><?= $rowData['resume'] ?></p>
                        <a href="#" style="color: #c56f43;">Développement </a>
                    </div>
                    <div class="card-button">
                        <div class="card-icon">
                            <form method="post" id="<?=$rowData['id']?>" action="/lesson/delete">
                                <input type="hidden" name="id" value="<?= $rowData['id'] ?>">
                                <input type="hidden" name="uri" value="<?= '/' . $back . '/' . $uri ?>">
                                <a href="javascript:(0)" onclick="document.getElementById(<?=$rowData['id']?>).submit()">
                                    <img src="/Content/svg/trash.svg" alt="edit button">
                                </a>
                            </form>
                        </div>
                        <div class="card-icon">
                            <form method="post" id="update-<?=$rowData['id']?>" action="/lesson/update">
                                <input type="hidden" name="update" value="<?= $rowData['id'] ?>">
                                <input type="hidden" name="uri" value="<?= '/' . $back . '/' . $uri ?>">
                                <a href="javascript:(0)" onclick="document.getElementById('<?= 'update-' . $rowData['id']?>').submit()">
                                    <img src="/Content/svg/setting-bis.svg" alt="setting button">
                                </a>
                            </form>
                        </div>
                    </div>

                    <div class="card-button-validate" onclick="window.location='<?= $uri . '/' . $rowData['url'] ?>';">
                        <div class="card-icon">
                            <i class="fas fa-arrow-circle-right" style="color: #3b3b3b;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;} ?>
    </section>
</div>

<?php if(isset($update) && !empty($update)){ ?>
<div class="modal" id="modal1" role="dialog" aria-modal="true" style="display: block; padding-right: 16px;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php App\Core\FormBuilder::render($formUpdate,'form_input_wrapper') ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</div>
</div>
<?php } ?>

<div class="modal" id="modal" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php App\Core\FormBuilder::render($form,'form_input_wrapper') ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
            </div>
        </div>
    </div>
</div>

