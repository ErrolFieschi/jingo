<div class="row no-container h-100">
    <div class="col-lg-5 col-sm-12 mb-0 div_colo_register center_center">
        <div class="div_register">
            <h2 class="card_title">Connexion</h2>
            <?php App\Core\FormBuilder::render($formLogin) ?>
            <?php if (isset($errors)):
                foreach ($errors as $error):?>
                    <li style="color:red"><?= $error; ?></li>
                <?php endforeach;
            endif; ?>
            <hr />
            <div class="flex justify-center">
                <span class="description">Pas de compte ? <a class="text-main" href="/s-inscrire">S’enregister</a></span>
            </div>
        </div>
    </div>

    <div class="col-lg-7 mb-0 div_image_register center_center">
        <img src="Content/Images/register.svg" alt="register" class="image_register"/>
    </div>
</div>


