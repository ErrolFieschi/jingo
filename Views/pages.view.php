<?php App\Core\PageBuilder::suppressPage()?>
<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header"
             style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Mes pages</h4>
                <p class="my-0">L'endroit pour créer, modifier ou supprimer des pages</p>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <p>Ajouter une page</p>
                <div class="card-center card--shadow pages_card">
                    <i class="fas fa-plus-circle fas_card"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 ml-20 pages_card">
                <p>Page d'accueil</p>
                <div class="card-center card--shadow">
                    <i class="fas fa-home fas_card"></i>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 ml-20 pages_card">
                <p>Dernière page modifiée</p>
                <div class="card-center card--shadow">
                    <i class="fas fa-pen fas_card"></i>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="row">
            <?php App\Core\PageBuilder::render() ?>
        </div>
    </section>
    <section>
        <div class="row">
            <div class="col-sm-12">
                <p>Ajouter une page</p>
                <div class="card-center card--shadow pages_card">
                    <?php App\Core\FormBuilder::render($form, 'form_input_wrapper') ?>
                    <?php if (isset($errors)):
                        foreach ($errors as $error):?>
                            <li style="color:red"><?= $error; ?></li>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

