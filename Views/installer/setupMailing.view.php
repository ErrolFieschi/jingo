<div class="row no-container h-100">
    <div class="col-sm-12 mb-0 log_reg center_center">
        <div class="div_register" style="width: auto;">
            <h2 class="card_title"> Installeur - Gestion du mail automatique </h2>
            <?php App\Core\FormBuilder::render($form, 'form_input_wrapper') ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
            <a href="/install/1">Etape précédente</a>
            <h2>Installation - Etape 2/3</h2>
        </div>
    </div>
</div>