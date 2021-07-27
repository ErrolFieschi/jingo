

<?php  // charger dans le model les requête sql pour charger le code générer par le tiny ?>
    <div class="w-10 bck-c-grey-2 b-r-10">
        <h4 class="color-white tc"> Cours de Laravel </h4>
        <div class="bck-c-white card--shadow h-100 b-r-bg-bd">
            <ol class="bck-c-white h-100 b-r-bg-bd">
                <?php foreach ($lessons as $lesson): ?>
                <li>
                    <a class="pages_card decoration-none  chap-animation-title change-content" ChapterPart="<?=$lesson['id']?>" onclick="changeContent(this)"> Introduction </a>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>