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
    <!--section>
        <div class="row">
            <a href="/page-creator">
                <div class="col-xl-3 col-md-3 col-sm-12 card--inverse ">
                    <div class="card-center card--shadow">
                        <i class="fas fa-plus" style="font-size: 50px;"></i>
                    </div>
            </a>
            <p>Ajouter une Page</p>
        </div>
    </section-->


    <section>
        <div class="row">
            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse show ">
                <div class="card-center card--shadow" style="cursor: pointer;">
                    <i class="fas fa-plus" style="font-size: 50px;"></i>
                </div>
                <p>Ajouter une Page</p>
            </div>


            <div class="col-xl-3 col-md-3 col-sm-12 card--inverse ">
                <div class="card-center card--shadow" style="cursor: pointer;">
                    <i class="fas fa-bars" style="font-size: 50px;"></i>
                </div>
                <p>Editer barre de navigation</p>
            </div>
        </div>

    </section>

    <section>
        <div class="row mb-12 ">
            <div class="row col-sm-7 popup-form">
                <?php App\Core\FormBuilder::render($addPage, "popup_form_builder col-md-6");
                ?>
                <i class="far fa-times-circle unshow"></i>
                <?php
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
        foreach ($pagesShow as $rowData): ?>
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card flex-row flex-nowrap card--shadow justify-content-between">
                        <a href="/page/render?id=<?= $rowData['id'] ?>">
                            <div class="card-header">
                                <img src="/Content/Images/formation.png" alt="title image" style="object-fit: cover;">
                            </div>
                        </a>
                        <div class="card-block">
                            <a href="<?= $rowData['url'] ?>">
                                <h4 class="card-title"><?= $rowData['title'] ?></h4>
                            </a>
                            <a href="#" style="color: #c56f43;"><?= $rowData['name'] ?></a>
                        </div>
                        <div class="card-button">


                            <div class="card-icon">
                                <div class="card-icon">
                                    <a href="/page/update?id=<?= $rowData['id'] ?>"><i class="fas fa-edit"
                                                                                       style="color: black; font-size: 23px;"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card-icon">
                                <a href="#"><img src="/Content/svg/setting-bis.svg" alt="setting button"></a>
                            </div>

                            <div class="card-icon">
                                <a href="/training/delete?id=<?= $rowData['training_id'] ?>"><img
                                            src="/Content/svg/trash.svg"
                                            alt="Trash button"></a>
                            </div>
                        </div>

                        <div class="card-button-validate" onclick="window.location='<?= $rowData['url'] ?>';">
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

