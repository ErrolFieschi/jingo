<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header"
             style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Mes formations</h4>
                <p class="my-0">L’endroit pour créer, modifier ou supprimer des cours</p>
            </div>
        </div>
    </section>
    <!--    Réaliser les inputs thème et barre de recherche-->
    <!--    <section>-->
    <!--        <div class="row">-->
    <!--            <div class="col-12" style="background-color: red;">-->
    <!--                    -->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->

    <section>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse show ">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_courses.svg" alt="register">
                </div>
                <p>Ajouter une formation</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_lesson.svg" alt="lesson">
                </div>
                <p>Formations favoris</p>
            </div>

            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/create_page.svg" alt="import page">
                </div>
                <p>Derniere formation modifié</p>
            </div>
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse">
                <div class="card-center card--shadow">
                    <img class="svg-dashboard--formation" src="/Content/Images/import_file.svg" alt="files">
                </div>
                <p>Formation à la une</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row mb-12 ">
            <div class="col-sm-7 popup-form">

                <?php App\Core\FormBuilder::render($formTraining);
                ?>
                <i class="far fa-times-circle unshow"></i>
                <?php
                $dir = 'Views/FrontTemplate';
                foreach (scandir($dir) as $svg) {
                    $svg_name = substr($svg, 0, strpos($svg, '.'));
                    ?>

                    <img src="<?= $dir . '/' . $svg_name . '.svg' ?>" alt="template" style="object-fit: cover;">
                    <?php
                }
                if (isset($errors)):
                    foreach ($errors as $error):?>
                        <li style="color:red"><?= $error; ?></li>
                    <?php endforeach;
                endif; ?>

            </div>
        </div>
    </section>
    <section>
        <?php
        foreach ($data as $rowData): ?>
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card flex-row flex-wrap card--shadow justify-content-between">
                        <div class="card-header">
                            <img src="/Content/Images/formation.png" alt="title image" style="object-fit: cover;">
                        </div>
                        <div class="card-block">
                            <h4 class="card-title"><?= $rowData['title'] ?></h4>
                            <p class="card-text mb-10"><?= $rowData['description'] ?>
                            </p>
                            <a href="#" style="color: #c56f43;"> </a>
                        </div>
                        <div class="card-button">
                            <?= $rowData['name'] ?>
                            <div class="card-icon">
                                <a href="#"><img src="/Content/svg/edit.svg" alt="edit button"></a>
                            </div>
                            <div class="card-icon">
                                <a href="#"><img src="/Content/svg/setting-bis.svg" alt="setting button"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

