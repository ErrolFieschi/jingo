<div class="container">
    <section class="flex flex-end flex-row h-100 ">
        <div class="flex card--shadow w-70 container-front content-container">

        </div>


        <div class="w-10 bck-c-grey-2 b-r-10">
            <h4 class="color-white tc"> Cours de Laravel </h4>
            <div class="bck-c-white card--shadow h-100 b-r-bg-bd">
                <ol class="bck-c-white h-100 b-r-bg-bd">
                    <?php foreach ($lessons as $lesson): ?>
                        <li>
                            <a class="pages_card decoration-none  chap-animation-title change-content" ChapterPart="<?=$lesson['id']?>" onclick="changeContent(this)"> <?=$lesson['title']?> </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>
</div>