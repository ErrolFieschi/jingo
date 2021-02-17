<?php if (isset($errors)):
    foreach ($errors as $error):?>
        <li style="color:red"><?= $error; ?></li>
    <?php endforeach;
endif; ?>


<div class="row">
    <div class="col-5 div_colo_register center_center">
        <div class="div_register">
            <h2 class="card_title">INSCRIPTION</h2>
            <?php App\Core\FormBuilder::render($form) ?>
        </div>
    </div>

    <div class="col-7 div_image_register center_center">
        <img src="Content/Images/register.svg" alt="register" class="image_register"/>
    </div>
</div>

<div class="container">
    <div class="row flexer">
        <div class="col-6 col-md-6 col-sm-12 bloc1">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="col-4 col-md-6 col-sm-12 bloc2">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="col-2 col-md-6 col-sm-12 bloc3">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="col-2 col-md-6 col-sm-12 bloc4">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
</div>


