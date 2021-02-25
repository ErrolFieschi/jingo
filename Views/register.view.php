<div class="row no-container">
    <div class="col-5 div_colo_register center_center">
        <div class="div_register">
            <h2 class="card_title">Inscription</h2>
            <?php App\Core\FormBuilder::render($form) ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
            <hr />
            <div class="flex justify-center">
                <span class="description">Déjà un compte ? <span class="text-main">Se connecter</span></span>
            </div>
        </div>
    </div>

    <div class="col-7 div_image_register center_center">
        <img src="Content/Images/register.svg" alt="register" class="image_register"/>
    </div>
</div>


