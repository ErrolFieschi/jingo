<?php if (isset($errors)):
    foreach ($errors as $error):?>
        <li style="color:red"><?= $error; ?></li>
    <?php endforeach;
endif; ?>

<section>
    <h2>Se connecter</h2>
    <div class="col-6">
        <?php App\Core\FormBuilder::render($formLogin) ?>
    </div>
</section>
