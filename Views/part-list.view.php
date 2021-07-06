<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header" style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>List de chapitre</h4>
                <p class="my-0">L’endroit pour créer, modifier ou supprimer des chapitres</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow" id="modal-btn">
                    <a href="javascript:void(0);"><img class="svg-dashboard--formation" src="/Content/Images/create_courses.svg" alt="register"></a>
                </div>
                <p>Ajouter un chapitre</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_lesson.svg" alt="lesson">
                </div>
                <p>Chapitre favoris</p>
            </div>

            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_page.svg" alt="import page">
                </div>
                <p>Dernier chapitre modifié</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/import_file.svg" alt="files">
                </div>
                <p>Chapitre à la une</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="mb-4">
                <a class="btn" href="training"><i class="fas fa-angle-double-left"></i> Retour aux formations</a>
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
                            <img src="/Content/Images/category.png" alt="title image" style="object-fit: cover;height: 100px !important;">
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><?= $rowData['title'] ?></h4>
                        </div>
                        <div class="card-button">
                            <div class="card-icon">
                                <a href="#"><img src="/Content/svg/setting-bis.svg" alt="setting button"></a>
                            </div>
                            <div class="card-icon">
                                <a href="#"><img src="/Content/svg/trash.svg" alt="Trash button"></a>
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
<div class="modal fade show" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-modal="true" style="display: none;">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content" id="modal-content">
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


