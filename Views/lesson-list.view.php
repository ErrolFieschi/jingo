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
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_lesson.svg" alt="lesson">
                </div>
                <p>Leçon favoris</p>
            </div>

            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_page.svg" alt="import page">
                </div>
                <p>Dernière leçon modifiée</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/import_file.svg" alt="files">
                </div>
                <p>Leçon à la une</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row col-sm-12">
            <div class="mb-4">
                <a class="btn" href="/<?= $back; ?>"><i class="fas fa-angle-double-left"></i> Retour aux chapitres</a>
            </div>
            <div class="mb-4" style="margin-left: 10px;">
                <span class="btn no-click"><i class="fas fa-street-view" style="font-size: 15px; padding-right: 10px;"></i> <?= strtoupper($title); ?></span>
            </div>
        </div>

        <?php foreach ($data as $rowData): ?>
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
                            <a href="#"><img src="/Content/svg/setting-bis.svg" alt="setting button"></a>
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
        <?php endforeach; ?>
    </section>
</div>

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

