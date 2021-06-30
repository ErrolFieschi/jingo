<div class="container-back-wrap">
    <section>
        <div class="banner banner--text banner--header"
             style="background-image: url('https://i.pinimg.com/originals/26/ae/12/26ae1241ca65ba8e8ff4a4d442c92566.png');">
            <div class="bg">
                <h4>Ma leçon associé au chapitre: <?= $chapitre; ?></h4>
                <p class="my-0">L’endroit pour visionner une leçon</p>
            </div>
        </div>
    </section>

    <section>
        <div class="col-xl-3 col-md-3 col-sm-12">
            <a href="/<?= $training; ?>"><p style="color: white !important; background-color: #0f2575;"><< Retour aux chapitres</p></a>
        </div>
        <div class="row mb-4" style="background-color: white;">
            <div class="col-sm-12">
                    <h3><?= $lesson['title'] ?></h3>
                    <p><?= $lesson['code'] ?></p>
            </div>
        </div>
    </section>
</div>


