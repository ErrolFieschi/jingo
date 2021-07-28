<section class="content-container-title pl-0 pr-0 h-10-em bck-c-white w-100 tc">
    <h6 class="mt-0 mb-0 flex pl-40 "> Accueil > Cours > ... > <?= $title ?> </h6>
    <h1 class="courses-title pb--b-40"> <?= $title ?> </h1>
</section>
<div class="container-fluid">
    <section class="flex flex-end flex-row justify-center h-100 ">
        <div class="bck-c-white flex flex-col card--shadow w-60 container-front content-container p-6">
            <?= $displayCode ?>
        </div>

        <div class="w-20 bck-c-grey-2 b-r-10 position-sticky">
            <h4 class="color-white tc"> <?= $title ?> </h4>
            <div class="bck-c-white card--shadow h-100 b-r-bg-bd">
                <ol class="bck-c-white b-r-bg-bd">
                    <?php foreach ($data as $lesson): ?>
                        <li id="chapter">
                            <a class="pages_card decoration-none  chap-animation-title change-content" ChapterPart="<?=$lesson['id']?>" onclick="changeContent(this)"> <?=$lesson['title']?> </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>
</div>