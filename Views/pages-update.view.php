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
    <section>
        <?php App\Core\FormBuilder::render($updatePage, "col-md-6");
        ?>
        <i class="far fa-times-circle unshow"></i>
        <?php
        if (isset($errors)):
            foreach ($errors as $error):?>
                <li style="color:red"><?= $error; ?></li>
            <?php endforeach;
        endif; ?>
    </section>
</div>

